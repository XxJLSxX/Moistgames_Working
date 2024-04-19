-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moisturegames`
--

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `Developer_ID` int(10) NOT NULL,
  `Developer_Name` varchar(100) NOT NULL,
  `Developer_Email` varchar(100) NOT NULL,
  `Developer_Address` varchar(200) NOT NULL,
  `Developer_Desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`Developer_ID`, `Developer_Name`, `Developer_Email`, `Developer_Address`, `Developer_Desc`) VALUES
(1, 'Activision Blizzard', 'activision_blizzard@moist.com', ' Santa Monica, 2701 Olympic Blvd # B, United States', 'Activision is a leading worldwide developer, publisher, and distributor of interactive entertainment for various gaming consoles, handheld platforms, and PC, including blockbuster franchises like Call of Duty®, Crash®, and SpyroTM.'),
(2, 'Bethesda', 'bethesda@moist.com', 'Bethesda Softworks LLC 1370 Piccard Drive, Suite 120 Rockville, MD 20850', 'Bethesda Softworks is a developer and publisher of computer and video games founded in 1986 by Christopher Weaver, owned by ZeniMax Media and through it, Xbox Game Studios since 2021.'),
(3, 'CD Projekt RED', 'projektred@moist.com', 'Poland, ul. Jagiellońska 74, 03-301 Warsaw', 'CD PROJEKT RED is a game development studio founded in 2002. It develops and publishes video games for personal computers and video game consoles. The studio flagship titles include The Witcher series of games and Cyberpunk 2077.'),
(4, 'Epic Games', 'epicgames@moist.com', '620 Crossroads Blvd., Cary, NC 27518, USA', 'Founded in 1991, Epic Games is an American company founded by CEO Tim Sweeney. The company is headquartered in Cary, North Carolina and has dozens of offices worldwide. Epic is a leading interactive entertainment company and provider of 3D engine technology.'),
(5, 'Paradox Interactive', 'paradoxint@moist.com', 'AB (publ), Magnus Ladulåsgatan 4, 118 66 Stockholm', 'Paradox Interactive is one of the premier developers and publishers of strategy and management games on PC and consoles. The group today consists of publishing and seven studios in six countries that develop gaming experiences for the over five million monthly active users of the company.'),
(6, 'Ubisoft Entertainment', 'ubisoft@moist.com', 'Saint-Mandé, France', 'Ubisoft is the creator and distributor of interactive entertainment and services and the maker of blockbuster favorites Assassins Creed and Wii Just Dance. The company was founded by the five Guillemot brothers in 1986 in Brittany, France.'),
(7, 'Valve Corporation', 'valvecorp@moist.com', '10400 Northeast Fourth Street Floor 14 Bellevue, WA 98004 USA', 'Valve Corporation is an American video game developer, publisher and digital distribution company headquartered in Bellevue, Washington. It is the developer of the software distribution platform Steam and the Half-Life, Counter-Strike, Portal, Day of Defeat, Team Fortress, Left 4 Dead, and Dota 2 games.');

-- --------------------------------------------------------

--
-- Table structure for table `featured_post`
--

CREATE TABLE `featured_post` (
  `Featured_ID` int(10) NOT NULL,
  `Game_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `Game_ID` int(10) NOT NULL,
  `Game_Name` varchar(100) NOT NULL,
  `Game_Desc` text NOT NULL,
  `Game_Downloads` int(10) NOT NULL,
  `Game_Rating` int(10) NOT NULL,
  `Upload_Date` date NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Category` enum('Action','Adventure','RPG','Simulation','Strategy') DEFAULT NULL,
  `Developer_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`Game_ID`, `Game_Name`, `Game_Desc`, `Game_Downloads`, `Game_Rating`, `Upload_Date`, `Price`, `Category`, `Developer_ID`) VALUES
(1, 'Call of Duty - Modern Warfare', 'A first-person shooter game that serves as a soft reboot of the Modern Warfare sub-series within the Call of Duty franchise, featuring a gritty and realistic single-player campaign, intense multiplayer modes, and cooperative Special Ops missions.', 0, 0, '2024-04-17', 65.00, 'Action', 1),
(2, 'Diablo - Immortal', 'A dark fantasy action role-playing game set in the world of Sanctuary, where players battle hordes of demons and monsters while exploring dungeons, collecting loot, and leveling up their characters.', 0, 0, '2024-04-17', 0.00, 'RPG', 1),
(3, 'Hearthstone - Heroes of Warcraft', 'A digital collectible card game set in the Warcraft universe, where players build decks and compete in turn-based battles against each other, using spells, minions, and other Warcraft-themed cards to achieve victory.', 0, 0, '2024-04-17', 0.00, 'Strategy', 1),
(4, 'Heroes of the Storm', 'A multiplayer online battle arena (MOBA) game featuring characters from various Blizzard Entertainment franchises, where teams of heroes compete in fast-paced, objective-based battles across themed battlegrounds.', 0, 0, '2024-04-17', 39.99, 'Action', 1),
(5, 'Overwatch', 'A team-based multiplayer first-person shooter game where players choose from a diverse cast of heroes with unique abilities and roles, competing in objective-based game modes across various maps in a futuristic world.', 0, 0, '2024-04-17', 0.00, 'Action', 1),
(6, 'StarCraft II', 'A real-time strategy game set in a science fiction universe, where players control one of three factions (Terran, Protoss, or Zerg) and compete in strategic battles for dominance of the galaxy.', 0, 0, '2024-04-17', 0.00, 'Strategy', 1),
(7, 'World of Warcarft', 'A massively multiplayer online role-playing game (MMORPG) set in the Warcraft universe, where players create characters and explore the fantasy world of Azeroth, completing quests, battling monsters, and interacting with other players.', 0, 0, '2024-04-17', 49.99, 'RPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(10) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `User_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `Rate_ID` int(10) NOT NULL,
  `Rate_Score` int(1) NOT NULL,
  `Review` text NOT NULL,
  `Review_Date` date DEFAULT NULL,
  `Review_Time` time DEFAULT NULL,
  `User_ID` int(10) NOT NULL,
  `Game_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `Receipt_ID` int(10) NOT NULL,
  `Receipt_Date` date DEFAULT NULL,
  `Receipt_Time` time DEFAULT NULL,
  `Payment_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Game_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Payment_Method` enum('Card Payment','EWallet Payment') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Name`, `User_Name`, `Email`, `Password`, `Payment_Method`) VALUES
(1, 'Administrator', 'Admin', 'admin@moist.com', '$2y$10$xvQb5.9yh0o/ipasmr6eLOJXp4R.T0WQe1D7bx81D.phlEdkOcmuO', 'EWallet Payment'),
(100000, 'Gian Paulo R. Saito', 'S_ythezzz', 'gsaito.1201@gmail.com', '$2y$10$rT4wdls1co0CGEsAP0j7VeVw77/x8Co50gcCd7neLJIgk0sxkxwv2', 'EWallet Payment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`Developer_ID`);

--
-- Indexes for table `featured_post`
--
ALTER TABLE `featured_post`
  ADD PRIMARY KEY (`Featured_ID`),
  ADD KEY `Game_ID` (`Game_ID`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`Game_ID`),
  ADD KEY `Developer_ID` (`Developer_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`Rate_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Game_ID` (`Game_ID`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`Receipt_ID`),
  ADD KEY `Payment_ID` (`Payment_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Transaction_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Game_ID` (`Game_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `Developer_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `featured_post`
--
ALTER TABLE `featured_post`
  MODIFY `Featured_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `Game_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `Rate_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `Receipt_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `featured_post`
--
ALTER TABLE `featured_post`
  ADD CONSTRAINT `featured_post_ibfk_1` FOREIGN KEY (`Game_ID`) REFERENCES `games` (`Game_ID`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`Developer_ID`) REFERENCES `developer` (`Developer_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`Game_ID`) REFERENCES `games` (`Game_ID`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`Payment_ID`) REFERENCES `payment` (`Payment_ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`Game_ID`) REFERENCES `games` (`Game_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
