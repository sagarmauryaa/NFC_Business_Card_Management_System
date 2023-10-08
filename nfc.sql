-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2023 at 09:00 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incincme_febbleCard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Febble Spot', 'febblespot23@gmail.com', '7020355294', 'cae11581a5b97fe48d38278cc5add7ea4bc4264d');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pass_code` varchar(255) NOT NULL,
  `banner_img` varchar(255) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `company_img` varchar(255) NOT NULL,
  `card_color` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `self_bio` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `work_number` varchar(255) NOT NULL,
  `gst` varchar(255) NOT NULL,
  `address_link` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `bank_details` longtext NOT NULL,
  `fb_link` varchar(255) NOT NULL,
  `yt_link` varchar(255) NOT NULL,
  `ln_link` varchar(255) NOT NULL,
  `insta_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `whats_number` varchar(255) NOT NULL,
  `isVerified` int(11) NOT NULL,
  `is_enabaled` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `color_code`, `slug`, `pass_code`, `banner_img`, `profile_img`, `company_img`, `card_color`, `full_name`, `occupation`, `company`, `self_bio`, `email`, `site_link`, `mobile`, `work_number`, `gst`, `address_link`, `address`, `bank_details`, `fb_link`, `yt_link`, `ln_link`, `insta_link`, `twitter_link`, `whats_number`, `isVerified`, `is_enabaled`, `created_on`) VALUES
(8, '', 'rustabhchauhan', '', '9c32867775984a10d82a4d0bc8870021_profile_banenr_img.jpg ', '9c32867775984a10d82a4d0bc8870021_profile_img.JPG', '9c32867775984a10d82a4d0bc8870021_company_img.jpg', '#000', 'Rustabh Chauhan', 'Director & Co-Founder', 'Febble Digital Solutions, Incinc Media', '&lt;p&gt;I&amp;rsquo;m&amp;nbsp;&lt;a href=&quot;http://www.rustabhchauhan.com/&quot; target=&quot;_blank&quot;&gt;Rustabh Chauhan&lt;/a&gt;, the founder of&amp;nbsp;&lt;a href=&quot;http://www.incincmedia.com/&quot; target=&quot;_blank&quot;&gt;Incinc Media&lt;/a&gt;, an IT company established in 2021 that specializes in building websites, applications, and software. I&amp;rsquo;m also a co-founder of&amp;nbsp;&lt;a href=&quot;http://www.febble.in/&quot; target=&quot;_blank&quot;&gt;Febble Digital Solutions LLP&lt;/a&gt;, where we provide innovative digital solutions to businesses.&lt;/p&gt;\r\n', 'rustabh@febble.in', 'https://febble.in, https://www.incincmedia.com, https://rustabhchauhan.com', '7498847799', '7498847799', '27AAIFF7237N1ZV, 27BXVPC3577P1ZH', 'https://www.google.com/search?q=febble+digital+solutions+llp&rlz=1C1CHBF_enIN1047IN1047&oq=febble+dig&gs_lcrp=EgZjaHJvbWUqCAgCEEUYJxg7MgYIABBFGDkyCAgBEEUYJxg7MggIAhBFGCcYOzIMCAMQABgKGA0YDxgeMgYIBBBFGDzSAQg1Njk1ajBqOagCALACAA&sourceid=chrome&ie=UTF-8#', '', '&lt;p&gt;Account Holder&amp;#39;s Name :- Rustabh Chandrashekhar Chauhan&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;IFSC Code :- HDFC0001425&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;VPA/UPI :- rustabhchauhan-1@okhdfcbank&lt;/p&gt;\r\n\r\n&lt;p&gt;Gpay/Paytm : +91 7498847799&lt;/p&gt;\r\n', 'https://www.facebook.com/rustabhchauhan/', 'https://www.youtube.com/@rustabhchauhan', 'https://www.linkedin.com/in/rustabhchauhan/', 'https://www.instagram.com/rustabhchauhan/', 'https://twitter.com/incincmedia', '7498847799', 1, 1, '2023-10-01 11:56:51'),
(9, '', 'akashsharma', '', '017129596b25450741fb43793f843864_profile_banenr_img.jpg ', '017129596b25450741fb43793f843864_profile_img.jpeg', '017129596b25450741fb43793f843864_company_img.jpg', '#000', 'Akash Sharma', 'Director & Co-Founder', 'Febble Digital Solutions LLP', '', 'akash@febble.in', 'https://febble.in', '8291651762', '8291651762', '27AAIFF7237N1ZV', '', '', '', '', '', '', '', '', '8291651762', 1, 1, '2023-10-01 13:16:47'),
(10, '', 'durgeshtiwari', '', 'f9e06dec4e752c8a433d7c63497d871f_profile_banenr_img.jpg ', 'f9e06dec4e752c8a433d7c63497d871f_profile_img.jpeg', 'f9e06dec4e752c8a433d7c63497d871f_company_img.jpg', '#000', 'Durgesh Tiwari', 'Director & Co-Founder', 'Febble Digital Solutions LLP', '', 'durgesh@febble.in', 'https://febble.in', '7208331519', '7208331519', '27AAIFF7237N1ZV', '', '', '', '', '', '', '', '', '7208331519', 1, 1, '2023-10-01 13:26:05'),
(11, '', 'Fahad_Azoz', '', '6f6adcaa4782d04433275b47949dc788_profile_banenr_img.jpg ', '6f6adcaa4782d04433275b47949dc788_profile_img.jpg', '6f6adcaa4782d04433275b47949dc788_company_img.jpeg', '#000', 'Fahad Chaudhary', 'Sales Manager', 'Azoz Operable Wall ', '&lt;p&gt;We are manufacturers and suppliers of operable acoustic sliding and folding partitions, Room Divider partitions, Movable Wall Partitions, Operable Wall Partitions and Collapsible wall partition in india Expert in Wall Partition&lt;/p&gt;\r\n', 'info@azozoperablewall.com', 'https://azozoperablewall.com', '9820046353', '9820046353', '27AAFCD4996E1ZD', '', '', '', 'https://www.facebook.com/Azoz-Operable-Wall-102264125747788', 'https://www.youtube.com/channel/UCAc0OZKhzKLhiUnTewPhAmQ', 'https://www.linkedin.com/in/azoz-operable-wall-india-9b4815233', 'https://www.instagram.com/azoz.operablewall', '', '9820046353', 1, 1, '2023-10-03 07:30:15'),
(12, '', 'harishchauhan', '', '2e26337ea3bbf4e54b38d1578c8fc0ad_profile_banenr_img.jpg ', '2e26337ea3bbf4e54b38d1578c8fc0ad_profile_img.jpg', '2e26337ea3bbf4e54b38d1578c8fc0ad_company_img.jpg', '#000000', 'Harish Chauhan', 'Head Technician', 'Chauhan Electrical & Civil Works', '&lt;p&gt;Chauhan Electrician is a privately-owned business By Chandrashekhar Chauhan. We are proud of the reputation we have built for being a reliable and trustworthy electrical contractor, offering quality with affordability. With an extensive range of projects covering the domestic, retail, commercial and industrial sectors, we boast a wealth of experience that we are able to apply to projects regardless of size or end-use. At Chauhan Electrician, we aim to go beyond the call of duty and build strong, long-lasting relationships with our clients. This friendly, hands-on approach means that each electrical job is tailored to meet individual requirements on every aspect of the project.&lt;/p&gt;\r\n', 'chauhanharishc@gmail.com', 'https://search.google.com/local/writereview?placeid=ChIJxW_IpPDJ5zsRcNzwQNe86nk', '7666939853', '7666939853', '', 'https://www.google.com/maps/place/Chauhan+Electrical+%26+Civil+Works+%7C+Marol+%7C+Andheri+%7C+Mumbai/@19.1170206,72.8895292,17.63z/data=!4m6!3m5!1s0x3be7c9f0a4c86fc5:0x79eabcd740f0dc70!8m2!3d19.1172454!4d72.8912878!16s%2Fg%2F11j6g_rt21?entry=ttu', '&lt;p&gt;Tunga Village, Marol, Andheri East, Mumbai, Maharashtra 400076&lt;/p&gt;\r\n', '', 'https://www.facebook.com/Chauhancivilworks', '', '', 'https://www.instagram.com/chauhancivilworks', '', '7666939853', 1, 1, '2023-10-03 18:39:06'),
(25, '', 'sagar', '2e613822b14051530b69ae5b82492e809cfdae79', '91bc7c5d98d7d59e3448a291fe701d32_profile_banenr_img.jpg ', '91bc7c5d98d7d59e3448a291fe701d32_profile_img.jpg', '91bc7c5d98d7d59e3448a291fe701d32_company_img.jpg', '#000000', 'Sagar Maurya', '', '', '', 'sagar68742@gmail.com', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, '2023-10-08 15:19:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
