--
-- Table structure rebuilding. First: drop all tables.
--

DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `guestbook`;
DROP TABLE IF EXISTS `member`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `order_detail`;
DROP TABLE IF EXISTS `pemesanan`;
DROP TABLE IF EXISTS `product`;
DROP TABLE IF EXISTS `produk`;
DROP TABLE IF EXISTS `temp`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `validasi`;
DROP TABLE IF EXISTS `webcontent`;

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL DEFAULT '',
  `catstring` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(1, 'accessories', 'Accessories');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(2, 'bench', 'Bench');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(3, 'decoration', 'Decoration');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(4, 'petrified-wood', 'Petrified-Wood');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(5, 'stool-chair', 'Stool-Chair');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(6, 'table', 'Table');
INSERT INTO `category` (`idx`, `category`, `catstring`) VALUES(7, 'wood-art', 'Woodart');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamatemail` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `pesan` text NOT NULL,
  `xstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `pesan` text NOT NULL,
  `xstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `kd_member` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL DEFAULT '',
  `pswd` varchar(255) NOT NULL DEFAULT '',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `alamat` varchar(255) NOT NULL DEFAULT '',
  `kota` varchar(255) NOT NULL DEFAULT '',
  `tlp` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `pekerjaan` varchar(255) NOT NULL DEFAULT '',
  `ktp` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`kd_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL DEFAULT '0000-00-00',
  `order_code` varchar(255) NOT NULL DEFAULT '',
  `nama` varchar(255) NOT NULL DEFAULT '',
  `email_address` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `duedate` date NOT NULL DEFAULT '0000-00-00',
  `xstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerid` int(10) unsigned NOT NULL DEFAULT '0',
  `itemid` int(10) unsigned NOT NULL DEFAULT '0',
  `itemname` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(14,2) NOT NULL DEFAULT '0.00',
  `qty` decimal(6,2) NOT NULL DEFAULT '0.00',
  `charged` decimal(14,2) NOT NULL DEFAULT '0.00',
  `xstatus` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_trans` varchar(255) NOT NULL DEFAULT '',
  `kd_produk` varchar(255) NOT NULL DEFAULT '',
  `nm_produk` varchar(255) NOT NULL DEFAULT '',
  `harga` int(10) unsigned NOT NULL DEFAULT '0',
  `jumlah` int(10) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL DEFAULT '',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `summary` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(1, 'PA-001', 'accessories', 'accessories001.jpg', 12, 'Mangkok buah, 30x30 cm, kayu mahoni');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(2, 'PA-002', 'accessories', 'accessories002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(3, 'PA-003', 'accessories', 'accessories003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(4, 'PA-004', 'accessories', 'accessories004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(5, 'PA-005', 'accessories', 'accessories005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(6, 'PA-006', 'accessories', 'accessories006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(7, 'PA-007', 'accessories', 'accessories007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(8, 'PA-008', 'accessories', 'accessories008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(9, 'PA-009', 'accessories', 'accessories009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(10, 'PA-010', 'accessories', 'accessories010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(11, 'PA-011', 'accessories', 'accessories011.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(12, 'PA-012', 'accessories', 'accessories012.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(13, 'PA-013', 'accessories', 'accessories013.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(14, 'PA-014', 'accessories', 'accessories014.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(15, 'PA-015', 'accessories', 'accessories015.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(16, 'PA-016', 'accessories', 'accessories016.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(17, 'PA-017', 'accessories', 'accessories017.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(18, 'PA-018', 'accessories', 'accessories018.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(19, 'PA-019', 'accessories', 'accessories019.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(20, 'PB-001', 'bench', 'bench001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(21, 'PB-002', 'bench', 'bench002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(22, 'PB-003', 'bench', 'bench003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(23, 'PB-004', 'bench', 'bench004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(24, 'PB-005', 'bench', 'bench005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(25, 'PB-006', 'bench', 'bench006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(26, 'PB-007', 'bench', 'bench007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(27, 'PB-008', 'bench', 'bench008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(28, 'PB-009', 'bench', 'bench009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(29, 'PB-010', 'bench', 'bench010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(30, 'PD-001', 'decoration', 'decoration001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(31, 'PD-002', 'decoration', 'decoration002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(32, 'PD-003', 'decoration', 'decoration003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(33, 'PD-004', 'decoration', 'decoration004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(34, 'PD-005', 'decoration', 'decoration005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(35, 'PD-006', 'decoration', 'decoration006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(36, 'PD-007', 'decoration', 'decoration007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(37, 'PD-008', 'decoration', 'decoration008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(38, 'PD-009', 'decoration', 'decoration009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(39, 'PD-010', 'decoration', 'decoration010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(40, 'PD-011', 'decoration', 'decoration011.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(41, 'PD-012', 'decoration', 'decoration012.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(42, 'PD-013', 'decoration', 'decoration013.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(43, 'PD-014', 'decoration', 'decoration014.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(44, 'PD-015', 'decoration', 'decoration015.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(45, 'PD-016', 'decoration', 'decoration016.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(46, 'PD-017', 'decoration', 'decoration017.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(47, 'PD-018', 'decoration', 'decoration018.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(48, 'PD-019', 'decoration', 'decoration019.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(49, 'PD-020', 'decoration', 'decoration020.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(50, 'PD-021', 'decoration', 'decoration021.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(51, 'PD-022', 'decoration', 'decoration022.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(52, 'PD-023', 'decoration', 'decoration023.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(53, 'PD-024', 'decoration', 'decoration024.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(54, 'PD-025', 'decoration', 'decoration025.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(55, 'PD-026', 'decoration', 'decoration026.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(56, 'PD-027', 'decoration', 'decoration027.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(57, 'PD-028', 'decoration', 'decoration028.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(58, 'PD-029', 'decoration', 'decoration029.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(59, 'PD-030', 'decoration', 'decoration030.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(60, 'PD-031', 'decoration', 'decoration031.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(61, 'PD-032', 'decoration', 'decoration032.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(62, 'PD-033', 'decoration', 'decoration033.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(63, 'PD-034', 'decoration', 'decoration034.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(64, 'PW-001', 'petrified-wood', 'petrified-wood001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(65, 'PW-002', 'petrified-wood', 'petrified-wood002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(66, 'PW-003', 'petrified-wood', 'petrified-wood003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(67, 'PW-004', 'petrified-wood', 'petrified-wood004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(68, 'PW-005', 'petrified-wood', 'petrified-wood005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(69, 'PW-006', 'petrified-wood', 'petrified-wood006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(70, 'PW-007', 'petrified-wood', 'petrified-wood007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(71, 'PW-008', 'petrified-wood', 'petrified-wood008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(72, 'PW-009', 'petrified-wood', 'petrified-wood009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(73, 'PW-010', 'petrified-wood', 'petrified-wood010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(74, 'PW-011', 'petrified-wood', 'petrified-wood011.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(75, 'PW-012', 'petrified-wood', 'petrified-wood012.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(76, 'PW-013', 'petrified-wood', 'petrified-wood013.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(77, 'PW-014', 'petrified-wood', 'petrified-wood014.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(78, 'PW-015', 'petrified-wood', 'petrified-wood015.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(79, 'PW-016', 'petrified-wood', 'petrified-wood016.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(80, 'PW-017', 'petrified-wood', 'petrified-wood017.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(81, 'PW-018', 'petrified-wood', 'petrified-wood018.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(82, 'PW-019', 'petrified-wood', 'petrified-wood019.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(83, 'PW-020', 'petrified-wood', 'petrified-wood020.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(84, 'SC-001', 'stool-chair', 'stool-chair001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(85, 'SC-002', 'stool-chair', 'stool-chair002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(86, 'SC-003', 'stool-chair', 'stool-chair003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(87, 'SC-004', 'stool-chair', 'stool-chair004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(88, 'SC-005', 'stool-chair', 'stool-chair005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(89, 'SC-004', 'stool-chair', 'stool-chair006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(90, 'SC-005', 'stool-chair', 'stool-chair007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(91, 'SC-006', 'stool-chair', 'stool-chair008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(92, 'SC-007', 'stool-chair', 'stool-chair009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(93, 'SC-008', 'stool-chair', 'stool-chair010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(94, 'SC-009', 'stool-chair', 'stool-chair011.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(95, 'SC-010', 'stool-chair', 'stool-chair012.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(96, 'SC-011', 'stool-chair', 'stool-chair013.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(97, 'SC-012', 'stool-chair', 'stool-chair014.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(98, 'SC-013', 'stool-chair', 'stool-chair015.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(99, 'SC-014', 'stool-chair', 'stool-chair016.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(100, 'SC-015', 'stool-chair', 'stool-chair017.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(101, 'SC-016', 'stool-chair', 'stool-chair018.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(102, 'SC-017', 'stool-chair', 'stool-chair019.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(103, 'SC-018', 'stool-chair', 'stool-chair020.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(104, 'SC-019', 'stool-chair', 'stool-chair021.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(105, 'SC-020', 'stool-chair', 'stool-chair022.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(106, 'SC-021', 'stool-chair', 'stool-chair023.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(107, 'SC-022', 'stool-chair', 'stool-chair024.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(108, 'SC-023', 'stool-chair', 'stool-chair025.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(109, 'SC-024', 'stool-chair', 'stool-chair026.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(110, 'SC-025', 'stool-chair', 'stool-chair027.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(111, 'SC-026', 'stool-chair', 'stool-chair028.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(112, 'SC-027', 'stool-chair', 'stool-chair029.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(113, 'SC-028', 'stool-chair', 'stool-chair030.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(114, 'SC-029', 'stool-chair', 'stool-chair031.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(115, 'SC-030', 'stool-chair', 'stool-chair032.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(116, 'TB-001', 'table', 'table001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(117, 'TB-002', 'table', 'table002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(118, 'TB-003', 'table', 'table003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(119, 'TB-004', 'table', 'table004.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(120, 'TB-005', 'table', 'table005.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(121, 'TB-006', 'table', 'table006.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(122, 'TB-007', 'table', 'table007.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(123, 'TB-008', 'table', 'table008.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(124, 'TB-009', 'table', 'table009.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(125, 'TB-010', 'table', 'table010.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(126, 'TB-011', 'table', 'table011.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(127, 'TB-012', 'table', 'table012.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(128, 'TB-013', 'table', 'table013.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(129, 'TB-014', 'table', 'table014.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(130, 'TB-015', 'table', 'table015.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(131, 'TB-016', 'table', 'table016.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(132, 'TB-017', 'table', 'table017.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(133, 'TB-018', 'table', 'table018.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(134, 'TB-019', 'table', 'table019.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(135, 'TB-020', 'table', 'table020.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(136, 'TB-021', 'table', 'table021.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(137, 'TB-022', 'table', 'table022.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(138, 'TB-023', 'table', 'table023.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(139, 'TB-024', 'table', 'table024.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(140, 'TB-025', 'table', 'table025.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(141, 'TB-026', 'table', 'table026.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(142, 'TB-027', 'table', 'table027.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(143, 'TB-028', 'table', 'table028.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(144, 'TB-029', 'table', 'table029.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(145, 'TB-030', 'table', 'table030.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(146, 'WA-001', 'wood-art', 'woodart001.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(147, 'WA-002', 'wood-art', 'woodart002.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');
INSERT INTO `product` (`idx`, `code`, `category`, `filename`, `price`, `summary`) VALUES(148, 'WA-003', 'wood-art', 'woodart003.jpg', 0, 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `kd_produk` int(11) NOT NULL,
  `nm_produk` varchar(255) NOT NULL DEFAULT '',
  `jenis` varchar(255) NOT NULL DEFAULT '',
  `harga` int(10) unsigned NOT NULL DEFAULT '0',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `stok` int(10) unsigned NOT NULL DEFAULT '0',
  `gambar` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idx` varchar(255) NOT NULL DEFAULT '',
  `kd_produk` varchar(255) NOT NULL DEFAULT '',
  `nm_produk` varchar(255) NOT NULL DEFAULT '',
  `harga` int(10) unsigned NOT NULL DEFAULT '0',
  `jumlah` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` char(40) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idx`, `username`, `password`) VALUES(1, 'admin', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e');

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE IF NOT EXISTS `validasi` (
  `kd_validasi` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `no_trans` varchar(255) NOT NULL DEFAULT '',
  `no_rek_bank` varchar(255) NOT NULL DEFAULT '',
  `transfer` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`kd_validasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `webcontent`
--

CREATE TABLE IF NOT EXISTS `webcontent` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `context` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `xstatus` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `webcontent`
--

INSERT INTO `webcontent` (`idx`, `context`, `content`, `xstatus`) VALUES(1, 'about', '<div class="span12" style=''padding-top:10px''><h3>About Tokoku WoodArt</h3><p style=''text-align:justify''>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p></div>', 1);
INSERT INTO `webcontent` (`idx`, `context`, `content`, `xstatus`) VALUES(2, 'address', '<h3>Tokoku WoodArt</h3><p><strong>Jl. Raya Blabak - Magelang No. 111</strong></p><p><strong>Blabak - Magelang, INDONESIA</strong></p>', 1);
