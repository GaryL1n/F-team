-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 06 月 13 日 00:11
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `fteam`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `sid` int(11) NOT NULL,
  `ad-name` varchar(255) NOT NULL,
  `ad-account` varchar(255) NOT NULL,
  `ad-password` varchar(255) NOT NULL,
  `ad-email` varchar(255) NOT NULL,
  `ad-avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`sid`, `ad-name`, `ad-account`, `ad-password`, `ad-email`, `ad-avatar`) VALUES
(1, 'Admin', 'admin', 'admin', '26fteam@gmail.com', 'User_icon_2.svg.png');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `sid` int(11) NOT NULL,
  `produst_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `member_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`sid`, `produst_id`, `name`, `qty`, `price`, `member_id`) VALUES
(227, '1', 'ONECSS', 1, '7000', '1493'),
(228, '2', 'StartEnc', 1, '6980', '1493'),
(231, '3', 'VIBECSS', 1, '7650', '1493'),
(232, '4', 'MassKV', 1, '8990', '1493');

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `sid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_sid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`sid`, `name`, `parent_sid`) VALUES
(1, '滑板', '0'),
(2, '噴漆', '0'),
(3, '長板', '1'),
(4, '技術板', '1'),
(5, '交通板', '1'),
(6, '板身', '1'),
(7, '輪架', '1'),
(8, '培林', '1'),
(9, '輪子', '1');

-- --------------------------------------------------------

--
-- 資料表結構 `favorite`
--

CREATE TABLE `favorite` (
  `sid` int(11) NOT NULL,
  `mem_id` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_info` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `favorite`
--

INSERT INTO `favorite` (`sid`, `mem_id`, `product_img`, `product_brand`, `product_name`, `product_info`, `product_price`, `product_id`) VALUES
(9, '10', '637894482023930000.jpg', 'POLAR', '那隻狗有三對內內0.0 整組滑板 8.0', '已完成組裝✅\r\n板身：POLAR 被正妹瞪好爽 整組滑板 8.0\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F119998000', '7000', 1),
(10, '10', '637894482025330000.jpg', 'POLAR', '他家蠻酷的 整組滑板 8.125', '已完成組裝✅\r\n板身：POLAR 他家蠻酷的 整組滑板 8.125\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F121998125', '6980', 2),
(14, '10', '637889068679000000.jpg', 'INDEPENDENT', '培林', '操你媽', '1200', 21),
(25, '15', '637894482023930000.jpg', 'POLAR', '那隻狗有三對內內0.0 整組滑板 8.0', '已完成組裝✅\r\n板身：POLAR 被正妹瞪好爽 整組滑板 8.0\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F119998000', '7000', 1),
(28, '15', '637894482031430000.jpg', 'POLAR', '真結合 整組滑板 7.875', '已完成組裝✅\r\n板身：（兒童/成人小尺寸）POLAR 真結合 整組滑板 7.875\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F118997875', '7650', 3),
(46, '15', '637894482033000000.jpg', 'POLAR', '鯊魚跳起來 整組滑板 8.25', '已完成組裝✅\r\n板身：POLAR 鯊魚跳起來 整組滑板 8.25\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 質感黑色基本款輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F113998250', '8990', 4),
(47, '1438', '637894482023930000.jpg', 'POLAR', '那隻狗有三對內內0.0 整組滑板 8.0', '已完成組裝✅\r\n板身：POLAR 被正妹瞪好爽 整組滑板 8.0\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F119998000', '7000', 1),
(48, '1438', '637894482025330000.jpg', 'POLAR', '他家蠻酷的 整組滑板 8.125', '已完成組裝✅\r\n板身：POLAR 他家蠻酷的 整組滑板 8.125\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F121998125', '6980', 2),
(49, '1438', '637894482031430000.jpg', 'POLAR', '真結合 整組滑板 7.875', '已完成組裝✅\r\n板身：（兒童/成人小尺寸）POLAR 真結合 整組滑板 7.875\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F118997875', '7650', 3),
(50, '1438', '637894482033000000.jpg', 'POLAR', '鯊魚跳起來 整組滑板 8.25', '已完成組裝✅\r\n板身：POLAR 鯊魚跳起來 整組滑板 8.25\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 質感黑色基本款輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F113998250', '8990', 4),
(51, '1438', '637883215517930000.jpg', 'SANTA CRUZ', 'DECODER HAND 9.51IN x 32.26IN CRUZER SHAPED CRUZER', '11116545-129806', '5600', 9),
(52, '1438', '637883215377670000.jpg', 'SANTA CRUZ', 'PRISMATIC DOT 8.8IN x 27.7IN CRUZER SHARK', '11116543-129804', '6600', 11),
(53, '1490', '637894482023930000.jpg', 'POLAR', '那隻狗有三對內內0.0 整組滑板 8.0', '已完成組裝✅\r\n板身：POLAR 被正妹瞪好爽 整組滑板 8.0\r\n砂紙：MOB x INDEPENDENT 世界第一的砂紙\r\n輪架：INDEPENDENT 中空輕量化輪架\r\n輪子：OJ WHEELS 最高品質系列 101A 54MM\r\n培林：BRONSON G3 高轉速培林\r\nPS211F119998000', '7000', 1),
(54, '1493', '637894482023930000.jpg', 'POLAR', 'ONECSS', 'Shortboard us et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,', '7000', 1),
(55, '1493', '637894482025330000.jpg', 'POLAR', 'StartEnc', 'Shortboard nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,', '6980', 2),
(56, '1493', '637894482031430000.jpg', 'POLAR', 'VIBECSS', 'Shortboard Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu', '7650', 3),
(57, '1493', '637894482088500000.jpg', 'FUCKING AWESOME', 'KVFOCUS', 'Shortboard Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que', '7880', 8),
(58, '1493', '637883215517930000.jpg', 'SANTA CRUZ', 'DECODER HAND CRUZER', 'Old School Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic', '5600', 9),
(59, '1493', '637883215377670000.jpg', 'SANTA CRUZ', 'PRISMATIC DOT', 'Old School Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.', '6600', 11),
(60, '1493', '637894482063130000.jpg', 'PALACE', 'KVPOST', 'Shortboard At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', '7650', 7),
(61, '1493', '637883214259270000.jpg', 'SANTA CRUZ', 'AMOEBA STREET SKATE', 'Old School he found himself transformed in his bed into a horrible vermin.', '5300', 15),
(62, '1493', '637894497999700000.jpg', 'HOCKEY', 'HP SYNTHETIC', 'Decks Gregor then turned to look out the window at the dull weather. Drops', '2800', 16),
(63, '1493', '637894498003270000.jpg', 'HOCKEY', 'UNCLE BOB', 'Decks A collection of textile samples lay spread out on the table', '2650', 17),
(64, '1493', '637889068679000000.jpg', 'INDEPENDENT', 'NULLA', 'Wheels accusantium doloremqu', '1200', 21),
(65, '1493', '637884051043030000.jpg', 'OJ WHEELS', 'WOOTEN SCREAMINGHARDLINE', 'Bearings nisi ut aliquid ex ea', '2500', 23),
(66, '1498', '637894482023930000.jpg', 'POLAR', 'ONECSS', 'Shortboard us et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,', '7000', 1),
(67, '1498', '637894482031430000.jpg', 'POLAR', 'VIBECSS', 'Shortboard Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu', '7650', 3),
(68, '1498', '637894482033000000.jpg', 'POLAR', 'MassKV', 'Shortboard the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,', '8990', 4),
(69, '1498', '637894482056430000.jpg', 'PALACE', 'KoHUB', 'Shortboard Nor again is there anyone who loves or pursues or desires to obtain pain of itself,', '6600', 5),
(70, '1498', '637886525279000000.jpg', 'SANTA CRUZ', 'CLASIC WAVE SPLICS', 'Old School The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of', '4930', 14),
(71, '1498', '637883214259270000.jpg', 'SANTA CRUZ', 'AMOEBA STREET SKATE', 'Old School he found himself transformed in his bed into a horrible vermin.', '5300', 15),
(72, '1498', '637883214704170000.jpg', 'SANTA CRUZ', 'RAINBOW TIE DYE', 'Old School One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed ', '6700', 13),
(73, '1498', '637894497999700000.jpg', 'HOCKEY', 'HP SYNTHETIC', 'Decks Gregor then turned to look out the window at the dull weather. Drops', '2800', 16),
(74, '1498', '637894498003270000.jpg', 'HOCKEY', 'UNCLE BOB', 'Decks A collection of textile samples lay spread out on the table', '2650', 17),
(75, '1498', '637884746574500000.jpg', 'INDEPENDENT', '144 HOLLOW REYNOLDS', 'Trucks and above it there hung a picture that he had recently cut out of an illustrated', '2400', 18),
(76, '1498', '637889068679000000.jpg', 'INDEPENDENT', 'NULLA', 'Wheels accusantium doloremqu', '1200', 21),
(77, '1498', '637890068368500000.jpg', 'BULLET', 'MATTE BLACK DELUXE HELMET', 'Safety Gear qui in ea voluptate velit ess', '1080', 24);

-- --------------------------------------------------------

--
-- 資料表結構 `lesson`
--

CREATE TABLE `lesson` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `duringtime_begin` date NOT NULL,
  `duringtime_end` date NOT NULL,
  `number_of_people` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `lesson`
--

INSERT INTO `lesson` (`sid`, `name`, `info`, `categories_id`, `duringtime_begin`, `duringtime_end`, `number_of_people`, `price`, `teacher`, `location`, `created_at`, `updated_at`) VALUES
(1, '((G) I-DLE) My Bag (MVdance)', '俗話說的好，掌握思考過程，也就掌握了街舞。我認為，我想，把街舞的意義想清楚，對各位來說並不是一件壞事。這必定是個前衛大膽的想法。\r\n\r\n', 0, '2022-06-05', '2022-07-05', 8, 3000, '小ㄗ', '台北市信義區', '2022-06-01 08:40:20', '2022-06-10 14:05:21'),
(2, '流行熱門舞蹈課程(單堂無進度)', ' 總結來說，跳舞可以說是有著成為常識的趨勢。諸葛亮曾經提到過，少壯不努力，老大徒傷悲。才須學也，非學無以廣才，非志無以成學。這句話幾乎解讀出了問題的根本。', 0, '2022-07-31', '2022-08-31', 5, 2250, '小雞', '台北市北投區', '2022-06-01 09:48:46', '2022-06-10 14:05:13'),
(3, 'New Jazz 基礎爵士(單堂無進度)', '土光敏夫曾經說過，風險和利益的大小是成正比的。但願各位能從這段話中獲得心靈上的滋長。透過逆向歸納，得以用最佳的策略去分析跳舞。', 0, '2022-06-16', '2022-07-16', 6, 2500, '圈圈', '台北市大安區', '2022-06-01 09:52:50', '2022-06-10 14:05:04'),
(4, 'Jessi - Zoom (MVdance)', ' 帶著這些問題，我們一起來審視跳舞。一般來說，我們不得不相信，奧弗伯里說過一句富有哲理的話，一個除了榮耀的祖先而一無所有的人，就像一個土豆唯一適合他的地方就泥地下面。這把視野帶到了全新的高度。', 0, '2022-06-10', '2022-07-10', 6, 3000, '小佑', '台北市松山區', '2022-06-01 09:55:51', '2022-06-10 14:04:56'),
(5, 'GIDLE - TOMBOY (MVdance)', ' 跳舞對我來說有著舉足輕重的地位，必須要嚴肅認真的看待。我們都有個共識，若問題很困難，那就勢必不好解決。了解清楚跳舞到底是一種怎麼樣的存在，是解決一切問題的關鍵。', 1, '2022-07-14', '2022-08-14', 5, 3000, '大壯', '台北市中正區', '2022-06-01 09:58:41', '2022-06-10 14:04:50'),
(6, '基礎嘻哈爵士 Jazz HIPHOP (單堂無進度)', '  街舞絕對是史無前例的。生活中，若街舞出現了，我們就不得不考慮它出現了的事實。謹慎地來說，我們必須考慮到所有可能。', 1, '2022-07-24', '2022-08-24', 5, 2250, '小ㄗ', '台北市信義區', '2022-06-01 10:06:46', '2022-06-10 14:04:43'),
(7, '新手Jazz爵士入門(適合真正零基礎)', '        所謂街舞，關鍵是街舞需要如何解讀。諸葛亮講過，士之相知，溫不增華，寒不改葉，能四時而不衰，歷夷險而益固。這段話的餘韻不斷在我腦海中迴盪著。\r\n\r\n', 1, '2022-07-01', '2022-08-01', 5, 2250, '小雞', '台北市北投區', '2022-06-01 10:10:14', '2022-06-10 14:04:36'),
(8, 'POPPING街舞', '        街舞勢必能夠左右未來。動機，可以說是最單純的力量。生活中，若街舞出現了，我們就不得不考慮它出現了的事實。我們要學會站在別人的角度思考。\r\n\r\n', 1, '2022-06-28', '2022-07-28', 6, 2500, '圈圈', '台北市大安區', '2022-06-01 10:18:02', '2022-06-10 14:04:27'),
(9, 'Breaking街舞體驗', '儘管街舞看似不顯眼，卻佔據了我的腦海。蒙田曾說過一句意義深遠的話，各市有各市的風俗，各鄉有各鄉的。這段話非常有意思。\r\n\r\n', 0, '2022-07-09', '2022-08-09', 6, 3000, '小佑', '台北市松山區', '2022-06-01 10:28:35', '2022-06-10 14:04:05'),
(10, 'LA STYLE - TBC舞蹈', '        白哲特在不經意間這樣說過，堅強的信念能贏得強者的心，並使他們變得更堅強。。這不禁令我重新仔細的思考。白哲特說過一句很有意思的話，堅強的信念能贏得強者的心，並使他們變得更堅強。這段話讓我的心境提高了一個層次。街舞的出現，重寫了人生的意義。\r\n\r\n', 1, '2022-06-19', '2022-07-19', 8, 3000, '大壯', '台北市中正區', '2022-06-01 10:32:15', '2022-06-10 14:03:31'),
(11, 'LISA - MONEY', '馬克思在過去曾經講過，科學絕不是一種自私自利的享受。有幸能夠致力於科學研究的人，首先應該拿自己的學識為人類服務。強烈建議大家把這段話牢牢記住。若到今天結束時我們都還無法釐清街舞的意義，那想必我們昨天也無法釐清。', NULL, '2022-06-20', '2022-07-26', 10, 2500, '小雞', '台北市北投區', '2022-06-08 11:37:06', '2022-06-10 16:12:23'),
(12, 'J Balvin - Blanco', '赫茲里特曾提出，小人物在社會中是一種必要的調劑。這類角色是極端令人愉快的，甚至會受人寵愛如果他們滿足於自己不得不扮演的角色。希望大家實際感受一下這段話。街舞似乎是一種巧合，但如果我們從一個更大的角度看待問題，這似乎是一種不可避免的事實。', NULL, '2022-06-27', '2022-07-27', 6, 2500, '圈圈', '台北市大安區', '2022-06-10 16:13:31', '2022-06-10 16:13:31'),
(13, 'B.I - BTBT', '        康有為說過一句經典的名言，虛驕自大者敗之媒，卑飛使用翼者擊之漸。想必各位已經看出了其中的端倪。街舞必定會成為未來世界的新標準。\r\n\r\n', NULL, '2022-07-13', '2022-08-31', 5, 2250, '小佑', '台北市松山區', '2022-06-10 16:14:43', '2022-06-10 16:14:43'),
(14, 'Saweetie - Best Friend', '我想，把街舞的意義想清楚，對各位來說並不是一件壞事。看看別人，再想想自己，會發現問題的核心其實就在你身旁。儘管街舞看似不顯眼，卻佔據了我的腦海。', NULL, '2022-07-20', '2022-08-10', 6, 3000, '大壯', '台北市中正區', '2022-06-10 16:15:53', '2022-06-10 16:15:53'),
(15, 'Anitta - Tócame', ' 對我個人而言，街舞不僅僅是一個重大的事件，還可能會改變我的人生。面對如此難題，我們必須設想周全。街舞因何而發生？', NULL, '2022-08-10', '2022-08-30', 10, 3000, '小ㄗ', '台北市信義區', '2022-06-10 16:16:54', '2022-06-10 16:16:54'),
(16, 'PRETTYMUCH - Rock Witchu', ' 街舞究竟是怎麼樣的存在，始終是個謎題。若發現問題比我們想像的還要深奧，那肯定不簡單。\r\n不難發現，問題在於該用什麼標準來做決定呢？', NULL, '2022-07-07', '2022-08-17', 7, 2000, '小雞', '台北市松山區', '2022-06-10 16:21:42', '2022-06-10 16:21:42'),
(17, 'Rema - Soundgasm', '巴爾扎克說過一句著名的話，痛苦跟歡樂一樣，會創造一種氣氛的。走進人家的屋子，你第一眼就可以知道它的基調是什麼，是愛情還是絕望。強烈建議大家把這段話牢牢記住。既然如此，現在，正視街舞的問題，是非常非常重要的。因為，巴金曾經說過，發達的科學技術是應當用來造福人類的，原子能應當為人類的進步服務。這段話雖短，卻足以改變人類的歷史。', NULL, '2022-08-03', '2022-09-20', 5, 2000, '圈圈', '台北市信義區', '2022-06-10 16:22:54', '2022-06-10 16:22:54'),
(18, 'BLACKPINK - Lovesick Girls', ' 若能夠欣賞到街舞的美，相信我們一定會對街舞改觀。不要先入為主覺得街舞很複雜，實際上，街舞可能比你想的還要更複雜。', NULL, '2022-07-14', '2022-08-24', 10, 3000, '小ㄗ', '台北市信義區', '2022-06-10 16:24:06', '2022-06-10 16:24:06'),
(19, 'Dr. Dre - The Next Episode', '那麼，我們不得不面對一個非常尷尬的事實，那就是，街舞對我來說有著舉足輕重的地位，必須要嚴肅認真的看待。我們可以很篤定的說，這需要花很多時間來嚴謹地論證。', NULL, '2022-07-06', '2022-08-18', 6, 2250, '小佑', '台北市松山區', '2022-06-10 16:24:51', '2022-06-10 16:24:51'),
(20, 'Lizzo - About Damn Time', '馬克思說過一句富有哲理的話，最好是把真理比作燧石——它受到的敲打越厲害，發射出的光輝就越燦爛。這句話幾乎解讀出了問題的根本。總而言之，面對如此難題，我們必須設想周全。街舞的出現，必將帶領人類走向更高的巔峰。', NULL, '2022-08-11', '2022-09-20', 8, 2000, '圈圈', '台北市大安區', '2022-06-10 16:25:41', '2022-06-10 16:25:41');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `sid` int(11) NOT NULL,
  `mem-name` varchar(255) NOT NULL,
  `mem-nickname` varchar(255) NOT NULL,
  `mem-level` varchar(255) NOT NULL,
  `mem-account` varchar(255) NOT NULL,
  `mem-password` varchar(255) NOT NULL,
  `mem-email` varchar(255) NOT NULL,
  `mem-mobile` varchar(255) NOT NULL,
  `mem-birthday` date DEFAULT NULL,
  `mem-address` varchar(255) NOT NULL,
  `mem-avatar` varchar(255) NOT NULL,
  `mem-created_at` datetime NOT NULL,
  `mem-bollen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`sid`, `mem-name`, `mem-nickname`, `mem-level`, `mem-account`, `mem-password`, `mem-email`, `mem-mobile`, `mem-birthday`, `mem-address`, `mem-avatar`, `mem-created_at`, `mem-bollen`) VALUES
(1493, '宇智波新德', '拿乳頭', '平民', '222', '222', 'gaygay@gmail.com', '0912312311', NULL, '木葉村', 'c7d276ab5ea10b216d21fd9292b98d41.png', '2022-06-10 13:39:12', 1),
(1494, 'shinder', 'shinder', '平民', 'sdadasd', 'adasdasd', 'gaygay@gmail.com', '0912312312', NULL, '', 'images.png', '2022-06-12 13:43:05', 0),
(1495, 'aaaa', 'shinder的狂熱粉絲', '平民', 'asdsadasd', 'asdadad', 'gaygay@gmail.com', '0912312312', NULL, '', 'images.png', '2022-06-12 13:43:26', 1),
(1496, 'shinder02', 'Nathan', '平民', 'ewfsdcwe', 'fwdcs', 'gaygay@gmail.com', '0912312311', NULL, '', 'images.png', '2022-06-12 13:43:42', 0),
(1497, 'AAAA', 'WTF', '平民', 'vfvfefv', 'ewvwdvdf', 'gaygay@gmail.com', '0912312311', NULL, '', 'images.png', '2022-06-12 13:44:03', 1),
(1498, 'demo', '', '平民', 'demo', 'demo', '', '', NULL, '', '3dcc4b00818a98daf5d509d2b7dbe762.jpg', '2022-06-10 14:48:10', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `news`
--

CREATE TABLE `news` (
  `sid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `news`
--

INSERT INTO `news` (`sid`, `title`, `info`, `image`, `created_at`, `update_at`) VALUES
(1, '滑板系列', 'Carson經常關注Supreme、A Bathing Ape等潮牌，緊貼潮流時尚，對近兩年高端時尚品牌如Louise Vuitton、Dior與街頭藝術家合作推出的聯乘作品更是不掩欣賞之情。街頭藝術對他來說，已經不是少數人追捧的文化現象，而是漸漸走進高級藝術的殿堂。在購藏這批滑板之前，他亦有收藏過去幾年Supreme推出的部分滑板，而當友人提及蘇富比即將上拍過去二十年所有Supreme滑板時，他知道這就是入手全套滑板千載難逢的良機。', '001.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(2, '國外選手來台', '「其實台灣街道上有一些很好的板點，甚至很多都尚未被開發，不少國外來的選手都說台灣像滑板天堂，Spot（板點）超多超棒，我相信這也是為什麼，近幾年一直有國外職業選手會選擇來台灣取景拍攝滑板影片的原因」，此次的訪問對象，同時也是台灣少見的職業滑板選手－柯家恩這樣說，趁此機會，就讓他帶我們暢滑台北街頭，一併也聊聊他最喜愛的滑板大小事。\r\n\r\n', '002.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(3, '台灣滑板店引進nike sb', 'Nike SB 的全稱是skateboarding（滑板運動），在 15年前，街頭流行風格最具代表性的鞋就是 Dunk SB。\r\n200年 Nike SB 系列，發布了第一款鞋 Nike Dunk SB首度問世，俗稱的四大天王 Danny supa、mulder、Gino、Forbes\r\n個人也因為鞋身用料質感以及zoom air鞋墊加持。開始入坑', '003.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(4, '他花22年滑進東奧！美國「滑板機器人」奪金大熱門竟重摔', '2020東京奧運在本屆賽事中，首次將街頭運動「滑板」（Skateboarding）列入正式比賽項目。世界積分排名第一的「美國滑板機器人」休斯頓（Nyjah Huston）在賽前被外界看好是奪下歷史首面滑板金牌的人選，不料卻在昨（25）日的街道賽中，技巧動作部分多次出現嚴重失誤，不僅摔掉金牌，更僅拿到第七名。儘管無緣獎牌，休斯頓賽後依然維持王者風範，主動擁抱拿下金牌的日本選手堀米雄斗。\r\n\r\n', '004.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(5, '華麗搖滾學院風！Dior 2022早秋系列時裝秀：女子滑板手帥氣開場、全新包款與晚禮服造型初亮相！', 'Dior 日前首次在首爾舉行時裝秀！在韓國梨花女子大學打造了一座時尚滑板場，展示其 2022 年秋季系列。藉由學院歷史提倡女性權力以促進性別平等，在一眾女子滑板手踩着滑板出場展開序幕，傳遞品牌願景。', '005.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(6, '領獎選手平均年齡14歲，「滑板」為什麼被奧運青睞？', '日本滑板選手西矢椛以奧運史上第二年輕金牌得主之姿，摘下東京奧運滑板冠軍。第一本滑板雜誌創辦人曾說滑板是一項「沒有歷史的運動」，6月21日滑板迷們慶祝的「滑板日」也聲明，玩滑板是對「獨立」的叛逆慶祝。滑板究竟為什麼吸引年輕人？又為什麼被奧運會看中？', '006.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07'),
(7, '滑板獎落誰家？', 'Carson經常關注Supreme、A Bathing Ape等潮牌，緊貼潮流時尚，對近兩年高端時尚品牌如Louise Vuitton、Dior與街頭藝術家合作推出的聯乘作品更是不掩欣賞之情。街頭藝術對他來說，已經不是少數人追捧的文化現象，而是漸漸走進高級藝術的殿堂。在購藏這批滑板之前，他亦有收藏過去幾年Supreme推出的部分滑板，而當友人提及蘇富比即將上拍過去二十年所有Supreme滑板時，他知道這就是入手全套滑板千載難逢的良機。', '007.jpeg', '2022-06-03 08:40:07', '2022-06-03 08:40:07');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `sid` int(50) NOT NULL,
  `member_sid` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orders`
--

INSERT INTO `orders` (`sid`, `member_sid`, `total`, `order_date`) VALUES
(202200100, 1493, 37220, '2021-04-12 13:41:28'),
(202200101, 1497, 5280, '2021-05-12 13:48:47'),
(202200102, 1497, 7504, '2021-10-12 13:48:55'),
(202200103, 1497, 4480, '2021-11-12 13:49:01'),
(202200104, 1497, 1280, '2021-12-12 13:49:08'),
(202200105, 1497, 11184, '2022-01-12 13:51:05'),
(202200106, 1497, 12784, '2022-02-12 13:51:13'),
(202200107, 1497, 9744, '2022-02-14 13:51:19'),
(202200108, 1497, 17304, '2022-05-12 13:53:43'),
(202200109, 1498, 7650, '2022-06-12 14:57:08'),
(202200111, 1498, 67730, '2022-06-12 15:17:11');

-- --------------------------------------------------------

--
-- 資料表結構 `order_details`
--

CREATE TABLE `order_details` (
  `sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `produst_sid` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `order_details`
--

INSERT INTO `order_details` (`sid`, `order_sid`, `member_sid`, `produst_sid`, `price`, `quantity`) VALUES
(18, 202200015, 1438, 3, 7650, 1),
(19, 202200015, 1438, 2, 6980, 1),
(20, 202200016, 1438, 2, 6980, 1),
(21, 202200016, 1438, 4, 8990, 1),
(22, 202200017, 1439, 2, 6980, 1),
(23, 202200017, 1439, 4, 8990, 4),
(24, 202200018, 1438, 2, 6980, 2),
(25, 202200018, 1438, 4, 8990, 1),
(26, 202200018, 1438, 1, 7000, 3),
(27, 202200018, 1438, 3, 7650, 7),
(28, 202200019, 1453, 4, 7192, 1),
(29, 202200019, 1453, 1, 5600, 1),
(30, 202200020, 1454, 6, 7504, 1),
(31, 202200021, 1454, 1, 5600, 1),
(32, 202200023, 1438, 3, 7650, 1),
(33, 202200023, 1438, 2, 5584, 1),
(34, 202200023, 1438, 4, 8990, 1),
(35, 202200024, 1438, 4, 8990, 1),
(36, 202200025, 1487, 2, 5584, 1),
(37, 202200026, 1438, 10, 5300, 1),
(38, 202200027, 1490, 1, 5600, 1),
(76, 202200084, 14, 2, 5584, 3),
(77, 202200086, 13, 2, 5584, 3),
(78, 202200086, 13, 1, 7000, 1),
(79, 202200086, 13, 4, 8990, 4),
(80, 202200087, 6, 2, 6980, 3),
(81, 202200087, 6, 4, 8990, 1),
(82, 202200087, 6, 7, 7650, 1),
(83, 202200088, 10, 15, 5300, 3),
(84, 202200088, 10, 47, 1700, 3),
(85, 202200088, 10, 3, 7650, 4),
(86, 202200089, 10, 4, 8990, 1),
(87, 202200089, 10, 1, 7000, 1),
(88, 202200090, 10, 2, 6980, 1),
(89, 202200090, 10, 1, 7000, 1),
(90, 202200092, 6, 1, 7000, 1),
(91, 202200094, 6, 2, 6980, 1),
(92, 202200094, 6, 1, 7000, 1),
(93, 202200094, 6, 4, 8990, 1),
(94, 202200095, 1492, 1, 5600, 1),
(95, 202200095, 1492, 3, 6120, 1),
(96, 202200097, 1492, 2, 5584, 1),
(97, 202200099, 1492, 3, 6120, 3),
(98, 202200100, 1493, 1, 7000, 1),
(99, 202200100, 1493, 2, 6980, 1),
(100, 202200100, 1493, 3, 7650, 1),
(101, 202200100, 1493, 4, 8990, 1),
(102, 202200100, 1493, 5, 6600, 1),
(103, 202200101, 1497, 5, 5280, 1),
(104, 202200102, 1497, 6, 7504, 1),
(105, 202200103, 1497, 9, 4480, 1),
(106, 202200104, 1497, 25, 1280, 1),
(107, 202200105, 1497, 1, 5600, 1),
(108, 202200105, 1497, 2, 5584, 1),
(109, 202200106, 1497, 5, 5280, 1),
(110, 202200106, 1497, 6, 7504, 1),
(111, 202200107, 1497, 11, 5280, 1),
(112, 202200107, 1497, 12, 4464, 1),
(113, 202200108, 1497, 3, 6120, 2),
(114, 202200108, 1497, 2, 5584, 2),
(115, 202200108, 1497, 1, 5600, 2),
(116, 202200109, 1498, 3, 7650, 1),
(117, 202200111, 1498, 1, 7000, 1),
(118, 202200111, 1498, 2, 6980, 1),
(119, 202200111, 1498, 3, 7650, 1),
(120, 202200111, 1498, 4, 8990, 1),
(121, 202200111, 1498, 5, 6600, 1),
(122, 202200111, 1498, 6, 9380, 1),
(123, 202200111, 1498, 7, 7650, 1),
(124, 202200111, 1498, 8, 7880, 1),
(125, 202200111, 1498, 9, 5600, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `produst`
--

CREATE TABLE `produst` (
  `sid` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `price` varchar(50) NOT NULL,
  `create_at` varchar(50) NOT NULL,
  `update_at` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `produst`
--

INSERT INTO `produst` (`sid`, `img`, `brand`, `name`, `info`, `price`, `create_at`, `update_at`, `category_id`, `color`) VALUES
(1, '637894482023930000.jpg', 'POLAR', 'ONECSS', 'Shortboard us et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,', '7000', '2021-12-05', '2022-04-08', '3', 'blue'),
(2, '637894482025330000.jpg', 'POLAR', 'StartEnc', 'Shortboard nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,', '6980', '2021-08-25', '2022-04-08', '3', 'yellow'),
(3, '637894482031430000.jpg', 'POLAR', 'VIBECSS', 'Shortboard Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu', '7650', '2021-07-28', '2022-03-24', '3', 'blue'),
(4, '637894482033000000.jpg', 'POLAR', 'MassKV', 'Shortboard the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,', '8990', '2021-3-15', '2022-5-31', '3', 'pink'),
(5, '637894482056430000.jpg', 'PALACE', 'KoHUB', 'Shortboard Nor again is there anyone who loves or pursues or desires to obtain pain of itself,', '6600', '2021-08-12', '2022-5-06', '3', 'white'),
(6, '637894482043800000.jpg', 'PALACE', 'FAIRKV', 'Shortboard or one who avoids a pain that produces no resultant pleasure? ', '9380', '2021-08-25', '2022-04-08', '3', 'yellow'),
(7, '637894482063130000.jpg', 'PALACE', 'KVPOST', 'Shortboard At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles.', '7650', '2021-07-28', '2022-03-24', '3', 'blue'),
(8, '637894482088500000.jpg', 'FUCKING AWESOME', 'KVFOCUS', 'Shortboard Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que', '7880', '2021-3-15', '2022-5-31', '3', 'blue'),
(9, '637883215517930000.jpg', 'SANTA CRUZ', 'DECODER HAND CRUZER', 'Old School Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic', '5600', '2021-08-25', '2022-06-11 23:29:24', '4', 'black'),
(10, '637873706641370000.jpg', 'SANTA CRUZ', 'FLIER COLLAGE DOT ', 'Old School The Big Oxmox advised her not to do so, because there were thousands of bad Commas', '5300', '2021-07-28', '2022-04-20', '4', 'green'),
(11, '637883215377670000.jpg', 'SANTA CRUZ', 'PRISMATIC DOT', 'Old School Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.', '6600', '2021-03-15', '2022-04-21', '4', 'blue'),
(12, '637883215206270000.jpg', 'SANTA CRUZ', 'RASTA TIE DYE', 'Old School the headline of Alphabet Village and the subline of her own road, the Line Lane.', '5580', '2021-08-12', '2022-5-31', '4', 'green'),
(13, '637883214704170000.jpg', 'SANTA CRUZ', 'RAINBOW TIE DYE', 'Old School One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed ', '6700', '2019-08-27', '2022-02-23', '4', 'blue'),
(14, '637886525279000000.jpg', 'SANTA CRUZ', 'CLASIC WAVE SPLICS', 'Old School The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of', '4930', '2020-05-20', '2022-01-06', '4', 'red'),
(15, '637883214259270000.jpg', 'SANTA CRUZ', 'AMOEBA STREET SKATE', 'Old School he found himself transformed in his bed into a horrible vermin.', '5300', '2019-01-24', '2022-03-05', '4', 'black'),
(16, '637894497999700000.jpg', 'HOCKEY', 'HP SYNTHETIC', 'Decks Gregor then turned to look out the window at the dull weather. Drops', '2800', '2021-12-05', '2022-04-20', '6', 'black'),
(17, '637894498003270000.jpg', 'HOCKEY', 'UNCLE BOB', 'Decks A collection of textile samples lay spread out on the table', '2650', '2021-07-28', '2022-03-24', '6', 'black'),
(18, '637884746574500000.jpg', 'INDEPENDENT', '144 HOLLOW REYNOLDS', 'Trucks and above it there hung a picture that he had recently cut out of an illustrated', '2400', '2021-03-15', '2022-04-20', '7', 'white'),
(19, '637886518587700000.jpg', 'INDEPENDENT', 'STAGE 11 BTG SPEED', 'Trucks The bedding was hardly able to cover it and seemed ready to slide off any moment. ', '2200', '2021-07-28', '2022-04-21', '7', 'blue'),
(20, '637885826662400000.jpg', 'BRONSON', 'SAMARRIA BREVARD PRO', 'Wheels Sed ut perspiciatis unde omnis iste natus error sit voluptatem', '1350', '2021-08-25', '2022-04-20', '8', 'green'),
(21, '637889068679000000.jpg', 'INDEPENDENT', 'NULLA', 'Wheels accusantium doloremqu', '1200', '2021-08-25', '2022-06-02 16:10:03', '8', 'red'),
(22, '637884050205800000.jpg', 'OJ WHEELS', 'TEAM LINE ORIGINAL', 'Bearings vitae dicta sunt', '1500', '2021-08-25', '2022-04-08', '9', 'white'),
(23, '637884051043030000.jpg', 'OJ WHEELS', 'WOOTEN SCREAMINGHARDLINE', 'Bearings nisi ut aliquid ex ea', '2500', '2021-07-28', '2022-06-10 19:20:51', '9', 'blue'),
(24, '637890068368500000.jpg', 'BULLET', 'MATTE BLACK DELUXE HELMET', 'Safety Gear qui in ea voluptate velit ess', '1080', '2019-07-14', '2022-05-23', '10', 'black'),
(25, '637890059759030000.jpg', 'BULLET', 'BLACK SETS ADULT', 'Safety Gear aboriosam, nisi ut aliquid ex ea', '1600', '2021-12-05', '2022-06-02 11:32:15', '10', 'black');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `produst`
--
ALTER TABLE `produst`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
--
ALTER TABLE `category`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `favorite`
--
ALTER TABLE `favorite`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lesson`
--
ALTER TABLE `lesson`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1499;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `news`
--
ALTER TABLE `news`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orders`
--
ALTER TABLE `orders`
  MODIFY `sid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202200112;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_details`
--
ALTER TABLE `order_details`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `produst`
--
ALTER TABLE `produst`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
