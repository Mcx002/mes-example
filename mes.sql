-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5173
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mes
DROP DATABASE IF EXISTS `mes`;
CREATE DATABASE IF NOT EXISTS `mes` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mes`;

-- Dumping structure for table mes.mes_defect
DROP TABLE IF EXISTS `mes_defect`;
CREATE TABLE IF NOT EXISTS `mes_defect` (
  `seq` bigint(20) unsigned NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `wo_no` varchar(50) NOT NULL,
  `defect_date` datetime NOT NULL,
  `input_date` datetime NOT NULL,
  `defect_id` varchar(50) NOT NULL,
  `defect_qty` double NOT NULL,
  `create_by` varchar(50) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_defect: ~0 rows (approximately)
DELETE FROM `mes_defect`;
/*!40000 ALTER TABLE `mes_defect` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_defect` ENABLE KEYS */;

-- Dumping structure for table mes.mes_defect_info
DROP TABLE IF EXISTS `mes_defect_info`;
CREATE TABLE IF NOT EXISTS `mes_defect_info` (
  `seq` bigint(20) unsigned NOT NULL,
  `part_no` varchar(50) NOT NULL,
  `defect_type` varchar(50) NOT NULL,
  `defect_id` varchar(50) NOT NULL,
  `defect_desc` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_defect_info: ~0 rows (approximately)
DELETE FROM `mes_defect_info`;
/*!40000 ALTER TABLE `mes_defect_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_defect_info` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_bom
DROP TABLE IF EXISTS `mes_m_bom`;
CREATE TABLE IF NOT EXISTS `mes_m_bom` (
  `bom_components` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `bom_parent` varchar(50) DEFAULT NULL,
  `create_by` varchar(20) NOT NULL,
  `update_by` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bom_components`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_bom: ~8 rows (approximately)
DELETE FROM `mes_m_bom`;
/*!40000 ALTER TABLE `mes_m_bom` DISABLE KEYS */;
INSERT INTO `mes_m_bom` (`bom_components`, `description`, `bom_parent`, `create_by`, `update_by`, `created_at`, `updated_at`) VALUES
	('123456-100-05M-000', '1', '', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-100', '1', '123456-100-05M-000', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-120', '1', '123456-100-05M-100', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-180', '1', '123456-100-05M-100', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-500', '1', '123456-100-05M-000', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-510', '1', '123456-100-05M-500', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-590', '1', '123456-100-05M-500', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00'),
	('123456-100-05M-800', '1', '123456-100-05M-000', 'UU13050617', 'UU13050617', '2020-05-01 00:00:00', '2020-05-01 00:00:00');
/*!40000 ALTER TABLE `mes_m_bom` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_line
DROP TABLE IF EXISTS `mes_m_line`;
CREATE TABLE IF NOT EXISTS `mes_m_line` (
  `line_id` varchar(50) NOT NULL,
  `op_id` varchar(50) NOT NULL,
  `line_code` varchar(50) NOT NULL,
  `line_desc` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`line_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_line: ~0 rows (approximately)
DELETE FROM `mes_m_line`;
/*!40000 ALTER TABLE `mes_m_line` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_m_line` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_op
DROP TABLE IF EXISTS `mes_m_op`;
CREATE TABLE IF NOT EXISTS `mes_m_op` (
  `op_id` varchar(50) NOT NULL,
  `op_desc` varchar(255) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_op: ~0 rows (approximately)
DELETE FROM `mes_m_op`;
/*!40000 ALTER TABLE `mes_m_op` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_m_op` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_part
DROP TABLE IF EXISTS `mes_m_part`;
CREATE TABLE IF NOT EXISTS `mes_m_part` (
  `part_no` varchar(50) NOT NULL,
  `part_desc` varchar(255) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`part_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_part: ~0 rows (approximately)
DELETE FROM `mes_m_part`;
/*!40000 ALTER TABLE `mes_m_part` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_m_part` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_prod_plan
DROP TABLE IF EXISTS `mes_m_prod_plan`;
CREATE TABLE IF NOT EXISTS `mes_m_prod_plan` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL,
  `wo_no` varchar(50) NOT NULL,
  `d_create` datetime NOT NULL,
  `d_start` datetime NOT NULL,
  `d_end` datetime NOT NULL,
  `model` varchar(50) NOT NULL,
  `c_style` varchar(50) NOT NULL,
  `c_size` varchar(50) NOT NULL,
  `part_no` varchar(50) NOT NULL,
  `assy_date` datetime NOT NULL,
  `prod_line` varchar(50) NOT NULL,
  `wo_type` varchar(50) NOT NULL,
  `assy_line` varchar(50) NOT NULL,
  `s_op` varchar(50) NOT NULL,
  `e_op` varchar(50) NOT NULL,
  `o_qty` double NOT NULL,
  `p_qty` double NOT NULL,
  `d_qty` double NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `release_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_prod_plan: ~0 rows (approximately)
DELETE FROM `mes_m_prod_plan`;
/*!40000 ALTER TABLE `mes_m_prod_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_m_prod_plan` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_routing
DROP TABLE IF EXISTS `mes_m_routing`;
CREATE TABLE IF NOT EXISTS `mes_m_routing` (
  `part_no` varchar(20) NOT NULL,
  `c_op` varchar(50) NOT NULL,
  `operation_id` varchar(50) NOT NULL,
  `next_operation_id` varchar(50) DEFAULT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`part_no`,`operation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_routing: ~14 rows (approximately)
DELETE FROM `mes_m_routing`;
/*!40000 ALTER TABLE `mes_m_routing` DISABLE KEYS */;
INSERT INTO `mes_m_routing` (`part_no`, `c_op`, `operation_id`, `next_operation_id`, `create_by`, `update_by`, `created_at`, `updated_at`) VALUES
	('000', 'ASY', '10', '', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('100', 'UCT', '10', 'STT', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('100', 'STT', '20', '', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('120', 'CPC', '10', 'NSW', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('120', 'NSW', '20', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('180', 'CPC', '10', 'EMB', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('180', 'EMB', '20', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('500', 'STF', '10', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('510', 'SCT', '10', 'PRS', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('510', 'PRS', '20', 'TRM', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('510', 'TRM', '30', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('590', 'IPH', '10', 'TRM', 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('590', 'TRM', '20', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00'),
	('800', 'ICT', '10', NULL, 'UU13050617', 'UU13050617', '2020-05-28 00:00:00', '2020-05-28 00:00:00');
/*!40000 ALTER TABLE `mes_m_routing` ENABLE KEYS */;

-- Dumping structure for table mes.mes_m_wip
DROP TABLE IF EXISTS `mes_m_wip`;
CREATE TABLE IF NOT EXISTS `mes_m_wip` (
  `seq` bigint(20) unsigned NOT NULL,
  `wo_no` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `prod_line` varchar(50) NOT NULL,
  `wip_qty` varchar(50) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_m_wip: ~0 rows (approximately)
DELETE FROM `mes_m_wip`;
/*!40000 ALTER TABLE `mes_m_wip` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_m_wip` ENABLE KEYS */;

-- Dumping structure for table mes.mes_transaction
DROP TABLE IF EXISTS `mes_transaction`;
CREATE TABLE IF NOT EXISTS `mes_transaction` (
  `seq` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `txn_date` datetime NOT NULL,
  `wo_no` varchar(50) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `txn_qty` double NOT NULL,
  `prod_line` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_transaction: ~0 rows (approximately)
DELETE FROM `mes_transaction`;
/*!40000 ALTER TABLE `mes_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_transaction` ENABLE KEYS */;

-- Dumping structure for table mes.mes_user
DROP TABLE IF EXISTS `mes_user`;
CREATE TABLE IF NOT EXISTS `mes_user` (
  `emp_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('1','2','3','4') NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mes_user: ~0 rows (approximately)
DELETE FROM `mes_user`;
/*!40000 ALTER TABLE `mes_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `mes_user` ENABLE KEYS */;

-- Dumping structure for table mes.mtl_system_item
DROP TABLE IF EXISTS `mtl_system_item`;
CREATE TABLE IF NOT EXISTS `mtl_system_item` (
  `inventory_item_id` varchar(50) NOT NULL,
  `inventory_desc` varchar(255) NOT NULL,
  `organization_id` varchar(50) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `enable_flag` enum('true','false') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`inventory_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table mes.mtl_system_item: ~0 rows (approximately)
DELETE FROM `mtl_system_item`;
/*!40000 ALTER TABLE `mtl_system_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `mtl_system_item` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
