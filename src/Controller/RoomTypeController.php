<?php

namespace App\Controller;

use App\Entity\RoomType;
use App\Form\RoomTypeType;
use App\Repository\RoomTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room/type")
 */
class RoomTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_room_type_index", methods={"GET"})
     */
    public function index(RoomTypeRepository $roomTypeRepository): Response
    {
        return $this->render('room_type/index.html.twig', [
            'room_types' => $roomTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_room_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RoomTypeRepository $roomTypeRepository): Response
    {
        $roomType = new RoomType();
        $form = $this->createForm(RoomTypeType::class, $roomType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomTypeRepository->add($roomType);
            return $this->redirectToRoute('app_room_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('room_type/new.html.twig', [
            'room_type' => $roomType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_room_type_show", methods={"GET"})
     */
    public function show(RoomType $roomType): Response
    {
        return $this->render('room_type/show.html.twig', [
            'room_type' => $roomType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_room_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, RoomType $roomType, RoomTypeRepository $roomTypeRepository): Response
    {
        $form = $this->createForm(RoomTypeType::class, $roomType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomTypeRepository->add($roomType);
            return $this->redirectToRoute('app_room_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('room_type/edit.html.twig', [
            'room_type' => $roomType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_room_type_delete", methods={"POST"})
     */
    public function delete(Request $request, RoomType $roomType, RoomTypeRepository $roomTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$roomType->getId(), $request->request->get('_token'))) {
            $roomTypeRepository->remove($roomType);
        }

        return $this->redirectToRoute('app_room_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
