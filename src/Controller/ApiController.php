<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/allbookings", name="app_api_all_bookings", methods={"GET"})
     */
    public function allbookings(Request $request): Response
    {

        $start_dt = $request->query->get('start');
        $end_dt = $request->query->get('end');
        $data = $this->getBookings($start_dt, $end_dt);

        $begin = new \DateTime($start_dt);
        $end = new \DateTime($end_dt);
        $end = $end->modify( '+1 day' );

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        $availabilityArray = $this->arrayLoop2($period, $data);

        
        return $this->json($availabilityArray);

    }

    /**
     * @Route("/availability", name="app_api_availability", methods={"GET"})
     */
    public function availability(Request $request): Response
    {

        $start_dt = $request->query->get('start');
        $end_dt = $request->query->get('end');
        $data = $this->getBookings($start_dt, $end_dt);

        $begin = new \DateTime($start_dt);
        $end = new \DateTime($end_dt);
        $end = $end->modify( '+1 day' );

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        $availabilityArray = $this->arrayLoop2($period, $data);

        foreach($availabilityArray as $singleElement){
            $twoBedCounter = 0;
            $threeBedCounter = 0;
            foreach($singleElement->rooms as $room){
                if($room['availability'] && $room['bedNum'] === 2){
                    $twoBedCounter++;
                }elseif($room['availability'] && $room['bedNum'] === 3){
                    $threeBedCounter++;
                }
            }
            $availabilityPerBed[] = ['date' => $singleElement->date, 'twoBeds' => $twoBedCounter, 'threeBeds' => $threeBedCounter];

        }

        return $this->json($availabilityPerBed);

    }

    /*
     * Initial data iteration replaced by arrayLoop2   
     */
    private function arrayLoop($period, $data) {
        $rooms = [];
        $availabilityArray = [];
        foreach ($period as $dt) {
            $availabilityArray[$dt->format('Ymd')] = [];
            foreach ($data as $singleElement) {
                if(($dt < $singleElement['starting_at']  || $dt >= $singleElement['ending_at']) && !isset($availabilityArray[$dt->format('Ymd')][$singleElement['number']])){
                    $availabilityArray[$dt->format('Ymd')][$singleElement['number']] = ['availability' => true, 'bedNo' => $singleElement['beds']];
                }elseif($dt >= $singleElement['starting_at']  && $dt < $singleElement['ending_at']){
                    $availabilityArray[$dt->format('Ymd')][$singleElement['number']] = ['availability' => false, 'bedNo' => $singleElement['beds']];
                }
                if(array_search($singleElement['number'], $rooms) === false){
                    $rooms[] = $singleElement['number'];
                }
            }
        }
        $availabilityArray['dates'] = array_keys($availabilityArray);
        $availabilityArray['rooms'] = $rooms;
        return $availabilityArray;
    }

    private function arrayLoop2($period, $data) {
        $rooms = [];
        $availabilityArray = [];
        foreach ($period as $dt) {
            $bookings = new \stdClass();
            $bookings->date = $dt->format('Ymd');
            foreach ($data as $singleElement) {
                if(($dt < $singleElement['starting_at']  || $dt >= $singleElement['ending_at']) && !isset($bookings->rooms[$singleElement['number']])){
                    $bookings->rooms[$singleElement['number']] = ['roomNo' => $singleElement['number'], 'availability' => true, 'bedNum' => $singleElement['beds']];
                }elseif($dt >= $singleElement['starting_at']  && $dt < $singleElement['ending_at']){
                    $bookings->rooms[$singleElement['number']] = ['roomNo' => $singleElement['number'], 'availability' => false, 'bedNum' => $singleElement['beds']];
                }
                // var_dump($bookings->rooms);
                //  var_dump(array_column($bookings->rooms, 'roomNo'));
                // if(array_search($singleElement['number'], $rooms) === false){
                //     $rooms[] = $singleElement['number'];
                // }
            }
            $bookings->rooms = array_values($bookings->rooms);
            $availabilityArray[] = $bookings;
        }
        return $availabilityArray;
    }


    private function getBookings($start_dt, $end_dt){
        $qb = $this->getDoctrine()->getManager();

        $qb = $qb->createQueryBuilder();
    
        $qb->select('r.number, rt.beds, b.starting_at, b.ending_at, COALESCE(b.starting_at, b.id) as columnOrder')
            ->from('App\Entity\Room', 'r')
            ->join('App\Entity\RoomType', 'rt', 'WITH', 'r.type = rt.id')
            ->leftJoin('App\Entity\Booking' ,'b', 'WITH', 'r.id = b.room AND (b.starting_at BETWEEN :start_dt AND :end_dt OR b.ending_at BETWEEN :start_dt AND :end_dt)')
            ->setParameters(['start_dt' => $start_dt, 'end_dt' => $end_dt])
            ->addOrderBy('r.number', 'ASC')
            ->addOrderBy('columnOrder', 'ASC');
        return $qb->getQuery()->getResult();
    }


}
