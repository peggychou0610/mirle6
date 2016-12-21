-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2016-12-21 09:23:37
-- 伺服器版本: 10.1.13-MariaDB
-- PHP 版本： 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `last`
--

-- --------------------------------------------------------

--
-- 資料表結構 `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `content` varchar(10) NOT NULL,
  `index` int(11) NOT NULL,
  `num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `card`
--

INSERT INTO `card` (`id`, `content`, `index`, `num`) VALUES
(1, '1', 2, 1),
(8, '8', 2, 1),
(9, '1', 3, 1),
(10, '6', 2, 2),
(11, '4', 2, 1),
(12, '4', 3, 1),
(13, '7', 3, 1),
(14, '3', 3, 1),
(29, '2', 4, 2),
(30, '3', 4, 1),
(31, '4', 4, 2),
(32, '5', 4, 2),
(33, '6', 4, 1),
(34, '7', 4, 1),
(35, '8', 4, 1),
(36, '1', 4, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `count`
--

CREATE TABLE `count` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `count`
--

INSERT INTO `count` (`id`, `count`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `money` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `money`) VALUES
(2, 'user1', '123456', 1800),
(3, 'user2', '123456', 600),
(4, 'user3', '123456', 1776);

-- --------------------------------------------------------

--
-- 資料表結構 `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `content` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `seller` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `money` int(100) NOT NULL,
  `base` int(100) NOT NULL,
  `buy` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `sell`
--

INSERT INTO `sell` (`id`, `content`, `seller`, `money`, `base`, `buy`, `expire`) VALUES
(21, '1', '2', 202, 200, 'user3', '2016-12-23 14:00:00'),
(31, '', '4', 0, 50, NULL, '2016-12-21 14:32:00'),
(33, '6', '2', 0, 100, NULL, '2016-12-22 12:59:00'),
(36, '禮包', '電腦', 200, 177, 'user3', '2016-12-21 16:37:38');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `count`
--
ALTER TABLE `count`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- 使用資料表 AUTO_INCREMENT `count`
--
ALTER TABLE `count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用資料表 AUTO_INCREMENT `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
