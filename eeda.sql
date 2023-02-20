-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 08:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eeda`
--

-- --------------------------------------------------------

--
-- Table structure for table `bigsale`
--

CREATE TABLE `bigsale` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL DEFAULT '',
  `bigtext` varchar(150) NOT NULL DEFAULT '',
  `normaltext` varchar(200) NOT NULL DEFAULT '',
  `smalltext` varchar(150) NOT NULL DEFAULT '',
  `publish` varchar(3) NOT NULL DEFAULT 'no',
  `address` varchar(500) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bigsale`
--

INSERT INTO `bigsale` (`id`, `banner`, `bigtext`, `normaltext`, `smalltext`, `publish`, `address`) VALUES
(1, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/cat-banner-1.jpg', 'Big Sale', 'Save up to 49% off', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `subcategory` int(10) UNSIGNED NOT NULL,
  `title` varchar(400) NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `guestname` varchar(150) NOT NULL DEFAULT '',
  `guestemail` varchar(150) NOT NULL DEFAULT '',
  `postbody` longtext NOT NULL,
  `cover` varchar(500) NOT NULL,
  `postedon` datetime NOT NULL DEFAULT current_timestamp(),
  `approved` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `category`, `subcategory`, `title`, `userid`, `guestname`, `guestemail`, `postbody`, `cover`, `postedon`, `approved`) VALUES
(1, 2, 2, 'Test Blog Title', 2, 'GuestName', 'testmail@gmail.com', 'No body nobody', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/blog_big_01-355x145.jpg', '2020-06-25 11:47:06', 'yes'),
(2, 1, 1, 'Test Post 2', 1, 'TypedWhileCommenting', 'testmail@gmail.com', 'test test post post body body two', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/blog_big_03.jpg', '2020-06-25 12:28:12', 'yes'),
(3, 2, 2, 'Test Post THREE', 2, '', '', 'THREE test test post post body body', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/blog_big_01-355x145.jpg', '2020-06-25 12:28:12', 'yes'),
(4, 3, 11, 'BLOG POST 4', 1, 'Another Guest User', 'guestmail@sitamet.dolor', 'FOUR FOUR FOUR', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/blog_big_01-355x145.jpg', '2020-06-25 12:30:01', 'yes'),
(5, 1, 1, '5 5 five five', 2, '', '', 'Everything is fiver here', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/blog_big_03-355x145.jpg', '2020-06-25 12:30:01', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `blogcomments`
--

CREATE TABLE `blogcomments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `postid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `guestname` varchar(150) NOT NULL DEFAULT '',
  `guestemail` varchar(150) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `comment` varchar(3000) NOT NULL DEFAULT '',
  `postedon` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogcomments`
--

INSERT INTO `blogcomments` (`id`, `postid`, `userid`, `guestname`, `guestemail`, `title`, `comment`, `postedon`) VALUES
(1, 1, 1, 'Test Writer', '', 'Test Title', 'This is the comment body added in the DB', '2020-06-27 19:17:55'),
(5, 1, 1, 'Another Test', 'a@fg.com', 'test title', 'dsafadsfrty', '2020-06-29 22:11:26'),
(7, 2, 1, 'Guest User', 'guest@lorem.ipsum.dolor', 'Test Title', 'Test Comment', '2020-06-30 07:17:45'),
(8, 2, 1, 'John Doe', 'a@fg.com', 'test title', 'asdfrtwbert', '2020-06-30 07:34:23'),
(17, 2, 1, 'Another Test', 'a@fg.com', 'test title', 'asynwy', '2020-06-30 07:58:10'),
(18, 2, 1, 'Last last one', 'last@last.com', 'last', 'last last last', '2020-06-30 08:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `blogsidebanner`
--

CREATE TABLE `blogsidebanner` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL DEFAULT '',
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogsidebanner`
--

INSERT INTO `blogsidebanner` (`id`, `banner`, `address`, `publish`) VALUES
(1, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/LHS-banner.jpg', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT '',
  `banner` varchar(1000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `banner`) VALUES
(1, 'Fashion & Clothing', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/banner-side.png'),
(2, 'Food & Drinks', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/banner-side.png'),
(3, 'Finance & Banking', ''),
(4, 'Entertainment and Hospitality', ''),
(5, 'Services and Supplies', ''),
(6, 'Decoration and furnishing', ''),
(7, 'Printing and Publishing', ''),
(8, 'Beauty and Cosmetics', ''),
(9, 'Music and Movies', '');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comingsoonform`
--

CREATE TABLE `comingsoonform` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` varchar(600) NOT NULL,
  `organization` varchar(500) NOT NULL,
  `isowner` varchar(20) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `couponallowed`
--

CREATE TABLE `couponallowed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allowedto` bigint(20) UNSIGNED NOT NULL,
  `coupon` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL DEFAULT '',
  `type` varchar(100) NOT NULL,
  `applicableto` varchar(200) NOT NULL DEFAULT '',
  `applicabletoid` bigint(20) UNSIGNED NOT NULL,
  `deallink` varchar(1000) NOT NULL DEFAULT '/deals-grid.php',
  `storelink` varchar(1000) NOT NULL DEFAULT '',
  `off` int(11) NOT NULL,
  `minorder` int(11) NOT NULL DEFAULT 0,
  `maxdiscount` int(11) NOT NULL DEFAULT 0,
  `end` date NOT NULL,
  `code` varchar(150) NOT NULL,
  `icon` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `description`, `type`, `applicableto`, `applicabletoid`, `deallink`, `storelink`, `off`, `minorder`, `maxdiscount`, `end`, `code`, `icon`) VALUES
(1, 'Testing New Coupon', 'Lorem Ipsum sit amet dolor', 'all', 'Amazon', 2, '/deals-grid.php', '', 23, 0, 0, '2020-08-31', 'ABC-ASDF-XYZQ', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/img3-60x60.jpg'),
(2, 'Test Coupon Two', 'Lorem Ipsum sit amet dolor', 'product', 'Baseball', 0, '/deals-grid.php', '', 10, 0, 0, '2020-06-26', 'ABC-XYZW-IPSUM', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/img3-60x60.jpg'),
(3, 'Test Coupon Three', 'test description test description test description description', 'vendor', 'Amazon', 0, '/deals-grid.php', '', 13, 0, 0, '2020-06-28', 'SO-R-TING', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/img3-60x60.jpg'),
(4, 'TEST 4', 'No Not applicable to ICANN fees, taxes, transfers,or gift cards. Cannot be used in conjunction with any other offer, sale, discount or promotion.', 'item', 'Amazon', 0, '/deals-grid.php', 'http://butabox.com', 60, 0, 0, '2020-06-30', 'ABC-XYZW-IPSUM', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/img1-60x60.jpg'),
(5, 'TEST FIVE', 'Not applicable to ICANN fees, taxes, transfers,or gift cards. Cannot be used in conjunction with any other offer, sale, discount or promotion.', 'category', 'Amazon', 0, '/deals-grid.php', '', 49, 0, 0, '2020-06-29', 'adsf-adsfj-fasdf', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/img1-60x60.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dealsgridsidebarbanner`
--

CREATE TABLE `dealsgridsidebarbanner` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL DEFAULT '',
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealsgridsidebarbanner`
--

INSERT INTO `dealsgridsidebarbanner` (`id`, `banner`, `address`, `publish`) VALUES
(1, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/LHS-banner.jpg', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `flashdealitems`
--

CREATE TABLE `flashdealitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL,
  `flashdeal` int(10) UNSIGNED NOT NULL,
  `flashprice` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flashdealitems`
--

INSERT INTO `flashdealitems` (`id`, `product`, `flashdeal`, `flashprice`) VALUES
(1, 5, 1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `flashdeals`
--

CREATE TABLE `flashdeals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flashdeals`
--

INSERT INTO `flashdeals` (`id`, `name`, `start`, `end`, `publish`) VALUES
(1, 'Summer Flash Deals', '2020-06-24 02:22:53', '2020-06-25 23:22:53', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `heroslider`
--

CREATE TABLE `heroslider` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL,
  `header` varchar(200) NOT NULL,
  `bigtext` varchar(150) NOT NULL,
  `excerpt` varchar(250) NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `heroslider`
--

INSERT INTO `heroslider` (`id`, `product`, `banner`, `header`, `bigtext`, `excerpt`, `active`) VALUES
(1, 4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/03.jpg', 'header1', 'bigtext1', 'excerpt1', 'yes'),
(2, 4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/01.jpg', 'header2', 'bigtext2', 'excerpt2', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderno` varchar(200) NOT NULL,
  `billingemail` varchar(100) NOT NULL DEFAULT '',
  `status` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderno`, `billingemail`, `status`) VALUES
(1, 'TESTORD122321', 'test@tmail.com', 'On Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(500) NOT NULL,
  `cover` varchar(3) NOT NULL DEFAULT 'no',
  `uploadtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `publish` varchar(3) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`id`, `product`, `source`, `cover`, `uploadtime`, `publish`) VALUES
(1, 4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/p2-600x394.jpg', 'no', '2020-06-28 20:53:03', 'yes'),
(2, 4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/p6-600x394.jpg', 'yes', '2020-06-28 20:53:03', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `vendor` int(10) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `oldprice` int(11) NOT NULL DEFAULT 0,
  `dateadded` datetime NOT NULL DEFAULT current_timestamp(),
  `available` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(500) NOT NULL,
  `imagefolder` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `subcategory` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `sale` varchar(4) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `vendor`, `price`, `oldprice`, `dateadded`, `available`, `cover`, `imagefolder`, `description`, `category`, `subcategory`, `sale`) VALUES
(4, 'Lorem', 2, 12, 14, '2020-06-23 12:10:57', 5, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/p7-260x170.jpg\" alt=\"The Crash Bad Instant Folding long Twin Bed', 'ipsum', 'sit amet dolor', 1, 3, 'yes'),
(5, 'For Another Tab', 2, 245, 0, '2020-06-24 02:57:33', 2, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/p11-260x170.jpg', '', 'Test Description', 1, 4, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `summary` varchar(300) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quality` double NOT NULL,
  `price` double NOT NULL,
  `value` double NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `approved` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product`, `username`, `userid`, `summary`, `description`, `quality`, `price`, `value`, `time`, `approved`) VALUES
(15, 4, 'Another Test', 1, 'Another Test', 'another test', 5, 3, 1, '2020-06-29 01:36:54', 'yes'),
(17, 4, 'Test Name', 1, 'Test Summary', 'This review if for test purpose.', 5, 5, 4, '2020-06-29 01:42:33', 'yes'),
(23, 4, 'Noiem', 1, 'Testing for Cart', 'Testing for Cart', 1, 2, 3, '2020-07-02 15:14:06', 'no'),
(24, 4, 'Noiem', 1, 'Testing for Cart', 'Testing for Cart', 1, 2, 3, '2020-07-02 15:14:21', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `category`) VALUES
(2, 'dummy - don\'t delete', 1),
(3, 'sub2', 1),
(4, 'sub3', 1),
(5, 'sub4', 1),
(6, 'sub5', 1),
(7, 'sub6', 1),
(8, 'sub7', 1),
(9, 'sub8', 1),
(10, 'sub9', 1),
(11, 'Test2 Sub1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(150) NOT NULL,
  `company` varchar(200) NOT NULL DEFAULT '',
  `statement` varchar(1000) NOT NULL,
  `photo` varchar(500) NOT NULL DEFAULT '',
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `author`, `company`, `statement`, `photo`, `publish`) VALUES
(1, 'Saraha Smith', 'Xperia Designs', 'TEST TEXT TEST TEXT Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.TE', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/member2.png', 'yes'),
(2, 'John Doe', 'ABC Company', 'TEXT TWO TEXT TWO Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.', 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/member3.png', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `topbanner`
--

CREATE TABLE `topbanner` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor` int(10) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL,
  `active` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topbanner`
--

INSERT INTO `topbanner` (`id`, `vendor`, `banner`, `active`) VALUES
(1, 2, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/top-banner.png', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'buyer',
  `token` varchar(300) NOT NULL DEFAULT '',
  `token_exp` varchar(200) NOT NULL,
  `designation` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `user_type`, `token`, `token_exp`, `designation`, `description`) VALUES
(1, 'guest', 'donotdelete', '', '', 'buyer', '', '', '', ''),
(2, 'Jodu', 'Modu', '', '', 'buyer', '', '', 'Test Designation', 'Test description or bio of the user.'),
(3, 'asdf', '', 'S@gm.com', '$2y$12$XYED1Semi2PggxNnfsY3jeIPA5buJQOdeK.DfowZfQfWsuP9MgXYC', 'buyer', 'e48a900a95c8e0a3db31da9fbad6866e47fd849232', '2020-07-03 18:51:00', '', ''),
(4, 'Noiem', '', 'test@gmail.com', '$2y$10$Vr9SV4YPCiC5VAFcKPygV.63JlCVnGxINPcmyVEgz0j4bgYmTJKL2', 'seller', '', '2020-07-03 19:53:37', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `fb` varchar(500) NOT NULL DEFAULT '',
  `twitter` varchar(500) NOT NULL DEFAULT '',
  `rss` varchar(500) NOT NULL DEFAULT '',
  `verified` varchar(3) NOT NULL DEFAULT 'no',
  `approved` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `email`, `password`, `token`, `description`, `logo`, `icon`, `fb`, `twitter`, `rss`, `verified`, `approved`) VALUES
(2, 'Baseball', 'johndoe@jd.com', 'test', '', 'This is a test description. Retrieving from the DB.', 'https://klbtheme.com/dealsdot/wp-content/uploads/2020/02/store.png', '/assets/images/brands/store-3.png', 'http://fb.com/test', '', '', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wideproducts`
--

CREATE TABLE `wideproducts` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL,
  `bigtext` varchar(100) NOT NULL DEFAULT '',
  `smalltext` varchar(150) NOT NULL DEFAULT '',
  `label` varchar(20) NOT NULL DEFAULT '',
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wideproducts`
--

INSERT INTO `wideproducts` (`id`, `banner`, `bigtext`, `smalltext`, `label`, `publish`) VALUES
(3, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/home-banner1.jpg', 'banner1', 'banner1', 'old', 'yes'),
(4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/home-banner3.jpg', 'banner2', 'banner2', 'OLD', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wideproductslarge`
--

CREATE TABLE `wideproductslarge` (
  `id` int(10) UNSIGNED NOT NULL,
  `product` bigint(20) UNSIGNED NOT NULL,
  `banner` varchar(500) NOT NULL,
  `bigtext` varchar(100) NOT NULL,
  `smalltext` varchar(150) NOT NULL,
  `label` varchar(20) NOT NULL,
  `hovertext` varchar(200) NOT NULL,
  `publish` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wideproductslarge`
--

INSERT INTO `wideproductslarge` (`id`, `product`, `banner`, `bigtext`, `smalltext`, `label`, `hovertext`, `publish`) VALUES
(1, 4, 'https://klbtheme.com/dealsdot/wp-content/uploads/2019/12/home-banner.jpg', 'bigtext', 'smalltext', 'LABEL', 'test hover', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bigsale`
--
ALTER TABLE `bigsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogtouser` (`userid`);

--
-- Indexes for table `blogcomments`
--
ALTER TABLE `blogcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commenttopost` (`postid`),
  ADD KEY `commenttouser` (`userid`);

--
-- Indexes for table `blogsidebanner`
--
ALTER TABLE `blogsidebanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comingsoonform`
--
ALTER TABLE `comingsoonform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couponallowed`
--
ALTER TABLE `couponallowed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpnallwtocpn` (`coupon`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealsgridsidebarbanner`
--
ALTER TABLE `dealsgridsidebarbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flashdealitems`
--
ALTER TABLE `flashdealitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fditemtoprod` (`product`),
  ADD KEY `fditemtofd` (`flashdeal`);

--
-- Indexes for table `flashdeals`
--
ALTER TABLE `flashdeals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heroslider`
--
ALTER TABLE `heroslider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `heroslidetoproduct` (`product`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productimages_ibfk_1` (`product`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pdtocat` (`category`),
  ADD KEY `pdtosubcat` (`subcategory`),
  ADD KEY `pdtovendors` (`vendor`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewtoprod` (`product`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtocat` (`category`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tagtoprod` (`product`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topbanner`
--
ALTER TABLE `topbanner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topbannertovendors` (`vendor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wideproducts`
--
ALTER TABLE `wideproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wideproductslarge`
--
ALTER TABLE `wideproductslarge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wlargetoproduct` (`product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bigsale`
--
ALTER TABLE `bigsale`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogcomments`
--
ALTER TABLE `blogcomments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blogsidebanner`
--
ALTER TABLE `blogsidebanner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comingsoonform`
--
ALTER TABLE `comingsoonform`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `couponallowed`
--
ALTER TABLE `couponallowed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dealsgridsidebarbanner`
--
ALTER TABLE `dealsgridsidebarbanner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flashdealitems`
--
ALTER TABLE `flashdealitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flashdeals`
--
ALTER TABLE `flashdeals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `heroslider`
--
ALTER TABLE `heroslider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topbanner`
--
ALTER TABLE `topbanner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wideproducts`
--
ALTER TABLE `wideproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wideproductslarge`
--
ALTER TABLE `wideproductslarge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blogtouser` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blogcomments`
--
ALTER TABLE `blogcomments`
  ADD CONSTRAINT `commenttopost` FOREIGN KEY (`postid`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `commenttouser` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `couponallowed`
--
ALTER TABLE `couponallowed`
  ADD CONSTRAINT `cpnallwtocpn` FOREIGN KEY (`coupon`) REFERENCES `coupons` (`id`);

--
-- Constraints for table `flashdealitems`
--
ALTER TABLE `flashdealitems`
  ADD CONSTRAINT `fditemtofd` FOREIGN KEY (`flashdeal`) REFERENCES `flashdeals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fditemtoprod` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `heroslider`
--
ALTER TABLE `heroslider`
  ADD CONSTRAINT `heroslidetoproduct` FOREIGN KEY (`product`) REFERENCES `products` (`id`);

--
-- Constraints for table `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `pdtocat` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pdtosubcat` FOREIGN KEY (`subcategory`) REFERENCES `subcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pdtovendors` FOREIGN KEY (`vendor`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviewtoprod` FOREIGN KEY (`product`) REFERENCES `products` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subtocat` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tagtoprod` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topbanner`
--
ALTER TABLE `topbanner`
  ADD CONSTRAINT `topbannertovendors` FOREIGN KEY (`vendor`) REFERENCES `vendors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wideproductslarge`
--
ALTER TABLE `wideproductslarge`
  ADD CONSTRAINT `wlargetoproduct` FOREIGN KEY (`product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
