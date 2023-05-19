-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 02:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Role` varchar(150),
  `isEmployee` boolean NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `product` (
  `id` bigint(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_desc` varchar(1000),
  `price` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `imageLink` varchar(3500)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `carts` (
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int (5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`, `Role`) VALUES
(1, 6338, 'shawn', '1234', '2023-03-30 00:03:48',''),
(10, 2429, 'shawn', '1234', '2023-04-08 05:32:26','sales');

INSERT INTO `product`(`id`, `product_name`, `product_desc`, `price`, `quantity`, `imageLink`) VALUES
(1, 'Computer', 'C910 computer with advanced hardware and computing capabilities', 2000, 20, "https://media.4rgos.it/s/Argos/4708229_R_SET?w=270&h=270&qlt=75&fmt.jpeg.interlaced=true"),
(2, 'Elon Musk', 'A 2210 model of Elon complete with advanced programming ', 20000, 4, "https://i.insider.com/6437c80e5f081b0019c0f40c?width=700"),
(3, 'Iphone', 'Iphone version 6 with built in security features', 350, 100, "https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/iphone-14-pro-model-unselect-gallery-2-202209?wid=5120&hei=2880&fmt=p-jpg&qlt=80&.v=1660753617559"),
(4,'Ipad','A simple, high-tech Ipad wth modern capabilities',700,15,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCysXkiwwN0GZ8nyCi7VRDv4vkTHaXM4pEmg&usqp=CAU"),
(5,'Android','A high quality, state of the art phone',500,55,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpiHQ5sx5PC5JqzduetnCEEUdPnqU8U_RGgg&usqp=CAU"),
(6,'Upgraded android','A higher quality, state of the art phone',700,25,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpiHQ5sx5PC5JqzduetnCEEUdPnqU8U_RGgg&usqp=CAU"),
(7,'Top Notch Android','A highest quality, state of the art phone',2500,5,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpiHQ5sx5PC5JqzduetnCEEUdPnqU8U_RGgg&usqp=CAU"),
(8,'Low-tier Laptop','A low quality, basic laptop',1500,40,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfFICCXOn1LyMxeEcAaZEYhfnUvDhBxvW817n5imlDlijhjasCeMRgj1pnZJbUxXIwmI&usqp=CAU"),
(9,'Processing laptop','A mid quality laptop good for computation',3500,10,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfFICCXOn1LyMxeEcAaZEYhfnUvDhBxvW817n5imlDlijhjasCeMRgj1pnZJbUxXIwmI&usqp=CAU"),
(10,'Database Laptop','A mid quality, laptop good for storage',3000,10,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfFICCXOn1LyMxeEcAaZEYhfnUvDhBxvW817n5imlDlijhjasCeMRgj1pnZJbUxXIwmI&usqp=CAU"),
(11,'Mid-tier standard Laptop','A mid quality, basic laptop',3500,20,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfFICCXOn1LyMxeEcAaZEYhfnUvDhBxvW817n5imlDlijhjasCeMRgj1pnZJbUxXIwmI&usqp=CAU"),
(12,'High-tier standard Laptop','A high quality, state of the art laptop',8500,10,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdfFICCXOn1LyMxeEcAaZEYhfnUvDhBxvW817n5imlDlijhjasCeMRgj1pnZJbUxXIwmI&usqp=CAU"),
(13,'USB','A USB',20,200,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgyj9mVIFMGrM3pmehTR0tm6wErtMgF7itAQ&usqp=CAU"),
(14,'High tech USB','A better USB',50,100,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgyj9mVIFMGrM3pmehTR0tm6wErtMgF7itAQ&usqp=CAU"),
(15,'Very high tech USB','An even better USB',150,50,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgyj9mVIFMGrM3pmehTR0tm6wErtMgF7itAQ&usqp=CAU"),
(16,'Best USB','A top of the notch USB',550,10,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgyj9mVIFMGrM3pmehTR0tm6wErtMgF7itAQ&usqp=CAU"),
(17,'Cheap mouse','A cheap mouse',20,100,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW6bDYxK7rRnGW2jcI_4znJIPE0_2453fdLcFc3LQ-CeDW1PYVqSIKmSVJA-ST1yRNzpo&usqp=CAU"),
(18,'Mid tier mouse','A mid tier mouse',30,100,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW6bDYxK7rRnGW2jcI_4znJIPE0_2453fdLcFc3LQ-CeDW1PYVqSIKmSVJA-ST1yRNzpo&usqp=CAU"),
(19,'High tier mouse','A high tier mouse',50,50,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW6bDYxK7rRnGW2jcI_4znJIPE0_2453fdLcFc3LQ-CeDW1PYVqSIKmSVJA-ST1yRNzpo&usqp=CAU"),
(20,'Gamer mouse','A gamer mouse',150,30,"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSW6bDYxK7rRnGW2jcI_4znJIPE0_2453fdLcFc3LQ-CeDW1PYVqSIKmSVJA-ST1yRNzpo&usqp=CAU");

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
