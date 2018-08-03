

CREATE TABLE `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` int(11) NOT NULL,
  `cust_name` varchar(200) NOT NULL,
  `cust_state` varchar(50) NOT NULL,
  `state_code` varchar(11) NOT NULL,
  `cust_gst` varchar(30) NOT NULL,
  `cust_address` varchar(200) NOT NULL,
  `cust_phone` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `creditbill` int(11) NOT NULL,
  `credit` decimal(15,2) NOT NULL,
  `paid` decimal(15,2) NOT NULL,
  `items` longtext NOT NULL,
  `created` date NOT NULL,
  `file_url` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;


INSERT INTO bill VALUES
("44","0","","","","","","","0","39.00","0","0.00","39.00","{\"1\":{\"id\":\"2\",\"uniqueid\":\"1232131\",\"title\":\"new1\",\"tax\":\"16\",\"qty\":\"3\",\"price\":\"11.24\"}}","2018-02-04","bills/44.txt",""),
("45","0","","","","","","","0","3888.00","0","0.00","3888.00","{\"1\":{\"id\":\"4\",\"uniqueid\":\"111225\",\"title\":\"new3\",\"tax\":\"0\",\"qty\":\"1\",\"price\":\"54.50\"},\"2\":{\"uniqueid\":\"1001\",\"title\":\"10 stock\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"123.25\"},\"3\":{\"uniqueid\":\"1234546789\",\"title\":\"New Test produc 2*3\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"13.00\"},\"4\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"},\"5\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"250.00\"},\"6\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"5\",\"price\":\"250.00\"},\"7\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"4\",\"price\":\"250.00\"},\"8\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"250.00\"},\"9\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"}}","2018-02-04","bills/45.txt",""),
("46","9999","","","","","","","2","6700.00","0","0.00","6700.00","{\"1\":{\"id\":\"6\",\"uniqueid\":\"1000\",\"title\":\"qwerty\",\"tax\":\"5\",\"qty\":\"1\",\"price\":\"35.00\"},\"2\":{\"uniqueid\":\"4534534\",\"title\":\"new2\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"5.24\"},\"3\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"},\"4\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"4\",\"price\":\"250.00\"},\"5\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"250.00\"},\"6\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"},\"7\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"14\",\"price\":\"250.00\"},\"8\":{\"uniqueid\":\"4534534\",\"title\":\"new2\",\"tax\":\"20\",\"qty\":\"10\",\"price\":\"5.24\"},\"9\":{\"uniqueid\":\"111225\",\"title\":\"new3\",\"tax\":\"0\",\"qty\":\"1\",\"price\":\"54.50\"},\"10\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"}}","2018-02-04","bills/46.txt",""),
("47","0","","","","","","","0","2994.00","0","0.00","2994.00","{\"1\":{\"id\":\"4\",\"uniqueid\":\"111225\",\"title\":\"new3\",\"tax\":\"0\",\"qty\":\"1\",\"price\":\"54.50\"},\"2\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"5\",\"price\":\"250.00\"},\"3\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"4\",\"price\":\"250.00\"},\"4\":{\"uniqueid\":\"1\",\"title\":\"qwerty\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"35.00\"},\"5\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"250.00\"}}","2018-02-04","bills/47.txt",""),
("48","0","","","","","","","0","717.00","0","0.00","717.00","{\"1\":{\"id\":\"3\",\"uniqueid\":\"4534534\",\"title\":\"new2\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"5.24\"},\"2\":{\"uniqueid\":\"1234546789\",\"title\":\"New Test produc 2*3\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"13.00\"},\"3\":{\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"},\"4\":{\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"250.00\"},\"5\":{\"uniqueid\":\"1\",\"title\":\"qwerty\",\"tax\":\"12\",\"qty\":\"2\",\"price\":\"35.00\"},\"6\":{\"uniqueid\":\"1000\",\"title\":\"qwerty\",\"tax\":\"5\",\"qty\":\"1\",\"price\":\"35.00\"}}","2018-02-04","bills/48.txt",""),
("49","0","","","","","","","0","1726.00","0","0.00","1726.00","{\"1\":{\"id\":\"3\",\"uniqueid\":\"4534534\",\"title\":\"new2\",\"tax\":\"20\",\"qty\":\"1\",\"price\":\"5.24\"},\"2\":{\"id\":\"9\",\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"250.00\"},\"3\":{\"id\":\"8\",\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"3\",\"price\":\"250.00\"},\"4\":{\"id\":\"10\",\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"2\",\"price\":\"250.00\"}}","2018-02-04","bills/49.txt",""),
("50","51","","","","","","","0","1593.00","0","0.00","1593.00","{\"1\":{\"id\":\"6\",\"uniqueid\":\"1000\",\"title\":\"qwerty\",\"tax\":\"5\",\"qty\":\"1\",\"price\":\"35.00\"},\"2\":{\"id\":\"10\",\"uniqueid\":\"AC98798789\",\"title\":\"Product Test\",\"tax\":\"20\",\"qty\":\"4\",\"price\":\"250.00\"},\"3\":{\"id\":\"4\",\"uniqueid\":\"111225\",\"title\":\"new3\",\"tax\":\"0\",\"qty\":\"4\",\"price\":\"54.50\"},\"4\":{\"id\":\"5\",\"uniqueid\":\"1001\",\"title\":\"10 stock\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"123.25\"}}","2018-02-04","bills/50.txt",""),
("51","50","","","","","","","1","782.00","0","0.00","782.00","{\"1\":{\"id\":\"1\",\"uniqueid\":\"1234546789\",\"title\":\"New Test produc 2*3\",\"tax\":\"20\",\"qty\":\"3\",\"price\":\"13.00\"},\"2\":{\"id\":\"6\",\"uniqueid\":\"1000\",\"title\":\"qwerty\",\"tax\":\"5\",\"qty\":\"1\",\"price\":\"35.00\"},\"3\":{\"id\":\"5\",\"uniqueid\":\"1001\",\"title\":\"10 stock\",\"tax\":\"12\",\"qty\":\"1\",\"price\":\"123.25\"},\"4\":{\"id\":\"9\",\"uniqueid\":\"AB987987\",\"title\":\"Product new\",\"tax\":\"12\",\"qty\":\"2\",\"price\":\"250.00\"}}","2018-02-05","bills/0051.txt",""),
("52","0","","","","","","","0","0.00","0","0.00","0.00","","0000-00-00","",""),
("53","51","","","","","","","1","0.00","1","0.00","0.00","{\"1\":{\"id\":\"\",\"uniqueid\":\"\",\"title\":\"\",\"tax\":\"0\",\"qty\":\"1\",\"price\":\"0\"}}","2018-02-05","bills/0051.txt",""),
("54","52","","","","","","","1","0.00","0","0.00","0.00","{\"1\":{\"id\":\"\",\"uniqueid\":\"\",\"title\":\"\",\"tax\":\"0\",\"qty\":\"1\",\"price\":\"0\"}}","2018-02-05","bills/0052.txt",""),
("55","0","","","","","","","0","0.00","0","0.00","0.00","","0000-00-00","","");




CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(400) NOT NULL,
  `gst` varchar(30) NOT NULL,
  `pan` varchar(30) NOT NULL,
  `phone1` varchar(30) NOT NULL,
  `phone2` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `website` varchar(200) NOT NULL,
  `street` varchar(400) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `statecode` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin` int(11) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `bankaccno` varchar(100) NOT NULL,
  `bankifsc` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL,
  `logo` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO company VALUES
("1","sam enterprises","--","--","--","87897494","--","","--","--","--","Kerala","0","India","695001","--","--","--","2018-01-03","2018-02-04","img/company-logo.jpg","Password");




CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(10) NOT NULL,
  `title` varchar(300) NOT NULL,
  `buy_price` decimal(15,2) NOT NULL,
  `sell_price` decimal(15,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `tax` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL,
  `remarks` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


INSERT INTO products VALUES
("1","1234546789","New Test produc 2*3","12.00","13.00","12","5","2018-01-15","2018-01-17","0"),
("2","1002","new1","3.22","11.24","300","4","2018-01-16","2018-02-04","0"),
("3","4534534","new2","3.24","5.24","-1","5","2018-01-16","2018-01-16","0"),
("4","111225","new3","32.22","54.50","-389","0","2018-01-16","2018-01-16","0"),
("5","1001","10 stock","0.00","123.25","248","3","2018-01-17","2018-02-04","0"),
("6","1000","qwerty","30.00","35.00","197","2","2018-01-17","2018-02-04","0"),
("7","1","qwerty","30.00","35.00","12","3","2018-01-17","2018-01-17","0"),
("8","AB987987","Product new","200.00","250.00","-1904","3","2018-02-04","2018-02-04","0"),
("9","AB987987","Product new","200.00","250.00","-3904","3","2018-02-04","2018-02-04","0"),
("10","AC98798789","Product Test","150.00","250.00","99","5","2018-02-04","2018-02-04","0");




CREATE TABLE `tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `value` int(11) NOT NULL,
  `created` date NOT NULL,
  `updated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO tax VALUES
("1","0","0","2018-01-15","2018-01-15"),
("2","GST 5","5","2018-01-15","2018-01-15"),
("3","GST12","12","2018-01-15","2018-01-15"),
("4","GST 16","16","2018-01-15","2018-01-15"),
("5","GST 20","20","2018-01-15","2018-01-15");




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `created` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




