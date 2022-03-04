-- --------------------------------------------------------
-- Διακομιστής:                  127.0.0.1
-- Έκδοση διακομιστή:            5.7.31 - MySQL Community Server (GPL)
-- Λειτ. σύστημα διακομιστή:     Linux
-- HeidiSQL Έκδοση:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table vocondo.booking: ~0 rows (approximately)
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` (`id`, `room_id`, `created_at`, `starting_at`, `ending_at`) VALUES
	(1, 1, '2022-03-03 12:47:40', '2022-03-03 00:00:00', '2022-03-11 00:00:00'),
	(2, 2, '2022-03-03 12:48:31', '2022-03-06 00:00:00', '2022-03-09 00:00:00'),
	(3, 5, '2022-03-03 12:49:09', '2022-03-11 00:00:00', '2022-03-12 00:00:00'),
	(4, 7, '2022-03-03 12:49:39', '2022-03-15 00:00:00', '2022-03-31 00:00:00'),
	(5, 8, '2022-03-03 12:50:21', '2022-03-16 00:00:00', '2022-03-20 00:00:00'),
	(6, 9, '2022-03-03 12:50:43', '2022-03-30 00:00:00', '2022-04-02 00:00:00'),
	(7, 1, '2022-03-03 15:07:53', '2022-03-18 00:00:00', '2022-03-21 00:00:00'),
	(8, 8, '2022-03-03 17:26:01', '2022-03-20 00:00:00', '2022-03-22 00:00:00'),
	(9, 10, '2022-03-03 17:53:37', '2022-03-06 00:00:00', '2022-03-08 00:00:00'),
	(10, 10, '2022-03-03 17:54:28', '2022-03-03 00:00:00', '2022-03-06 00:00:00');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;

-- Dumping data for table vocondo.doctrine_migration_versions: ~1 rows (approximately)
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20220303104417', '2022-03-03 10:44:35', 1661);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

-- Dumping data for table vocondo.room: ~0 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id`, `type_id`, `number`) VALUES
	(1, 1, 110),
	(2, 1, 111),
	(3, 1, 112),
	(4, 1, 113),
	(5, 1, 114),
	(6, 1, 115),
	(7, 1, 116),
	(8, 2, 117),
	(9, 2, 118),
	(10, 2, 119);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Dumping data for table vocondo.room_type: ~0 rows (approximately)
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` (`id`, `beds`, `amenity1`, `amenity2`) VALUES
	(1, 2, 'foo', 'bar'),
	(2, 3, 'foo', 'bar');
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
