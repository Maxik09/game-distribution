-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2024 at 11:10 PM
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
-- Database: `GameDistribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
                           `CompanyID` int(11) NOT NULL,
                           `Name` varchar(255) NOT NULL,
                           `Type` varchar(100) DEFAULT NULL,
                           `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`CompanyID`, `Name`, `Type`, `Address`) VALUES
                                                                   (1, 'Epic Games', 'Developer', '123 Game St, Raleigh, NC'),
                                                                   (2, 'Ubisoft', 'Developer', '456 Developer Dr, Montreal, QC'),
                                                                   (3, 'Electronic Arts', 'Publisher', '789 Publisher Ln, Redwood City, CA'),
                                                                   (4, 'Activision', 'Publisher', '101 Game Blvd, Santa Monica, CA'),
                                                                   (5, 'Bethesda', 'Developer', '202 Elder St, Rockville, MD');

-- --------------------------------------------------------

--
-- Table structure for table `Game`
--

CREATE TABLE `Game` (
                        `GameID` int(11) NOT NULL,
                        `Title` varchar(255) NOT NULL,
                        `Genre` varchar(100) DEFAULT NULL,
                        `Price` decimal(10,2) DEFAULT NULL,
                        `PublisherID` int(11) DEFAULT NULL,
                        `AgeRating` enum('Everyone','Everyone10+','Teen','Mature17+','AdultsOnly') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Game`
--

INSERT INTO `Game` (`GameID`, `Title`, `Genre`, `Price`, `PublisherID`, `AgeRating`) VALUES
                                                                                         (1, 'Fortnite', 'Battle Royale', 10.00, 1, 'Teen'),
                                                                                         (2, 'Assassin\'s Creed', 'Action', 59.99, 2, 'Mature17+'),
                                                                                         (3, 'FIFA 22', 'Sports', 49.99, 3, 'Everyone'),
                                                                                         (4, 'Call of Duty', 'Shooter', 59.99, 4, 'Mature17+'),
                                                                                         (5, 'Skyrim', 'RPG', 39.99, 5, 'Mature17+'),
                                                                                         (7, 'Dream League Soccer', 'Sports', 10.99, 4, 'AdultsOnly');

-- --------------------------------------------------------

--
-- Table structure for table `GamePlatform`
--

CREATE TABLE `GamePlatform` (
                                `GameID` int(11) NOT NULL,
                                `PlatformID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GamePlatform`
--

INSERT INTO `GamePlatform` (`GameID`, `PlatformID`) VALUES
                                                        (1, 1),
                                                        (1, 2),
                                                        (1, 3),
                                                        (1, 4),
                                                        (1, 5),
                                                        (2, 1),
                                                        (2, 2),
                                                        (2, 3),
                                                        (2, 4),
                                                        (2, 5),
                                                        (3, 3),
                                                        (3, 4),
                                                        (3, 5),
                                                        (4, 1),
                                                        (4, 2),
                                                        (4, 3),
                                                        (4, 4),
                                                        (4, 5),
                                                        (5, 3),
                                                        (5, 4),
                                                        (5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Gamer`
--

CREATE TABLE `Gamer` (
                         `GamerID` int(11) NOT NULL,
                         `Username` varchar(255) NOT NULL,
                         `Age` int(11) DEFAULT NULL,
                         `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Gamer`
--

INSERT INTO `Gamer` (`GamerID`, `Username`, `Age`, `Email`) VALUES
                                                                (1, 'PlayerOne', 20, 'playerone@gamedistro.com'),
                                                                (2, 'GamerGirl', 25, 'gamergirl@gamedistro.com'),
                                                                (3, 'NoobMaster', 18, 'noobmaster@gamedistro.com'),
                                                                (4, 'ElitePro', 30, 'elitepro@gamedistro.com'),
                                                                (5, 'ConsoleCowboy', 35, 'consolecowboy@gamedistro.com');

-- --------------------------------------------------------

--
-- Table structure for table `GamerGame`
--

CREATE TABLE `GamerGame` (
                             `GamerID` int(11) NOT NULL,
                             `GameID` int(11) NOT NULL,
                             `PurchaseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GamerGame`
--

INSERT INTO `GamerGame` (`GamerID`, `GameID`, `PurchaseDate`) VALUES
                                                                  (1, 1, '2023-01-15'),
                                                                  (1, 2, '2023-03-01'),
                                                                  (1, 3, '2023-01-20'),
                                                                  (1, 4, '2023-03-15'),
                                                                  (2, 1, '2023-02-20'),
                                                                  (2, 2, '2023-02-25'),
                                                                  (2, 3, '2023-03-05'),
                                                                  (2, 4, '2023-02-28'),
                                                                  (3, 2, '2023-04-01'),
                                                                  (3, 3, '2023-03-10'),
                                                                  (3, 4, '2023-03-25'),
                                                                  (3, 5, '2023-03-20'),
                                                                  (4, 1, '2023-04-20'),
                                                                  (4, 2, '2023-04-25'),
                                                                  (4, 4, '2023-04-10'),
                                                                  (4, 5, '2023-04-15'),
                                                                  (5, 1, '2023-05-15'),
                                                                  (5, 2, '2023-05-20'),
                                                                  (5, 3, '2023-05-10'),
                                                                  (5, 5, '2023-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `GamerPlatform`
--

CREATE TABLE `GamerPlatform` (
                                 `GamerID` int(11) NOT NULL,
                                 `PlatformID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GamerPlatform`
--

INSERT INTO `GamerPlatform` (`GamerID`, `PlatformID`) VALUES
                                                          (1, 1),
                                                          (1, 2),
                                                          (1, 3),
                                                          (1, 4),
                                                          (1, 5),
                                                          (2, 1),
                                                          (2, 3),
                                                          (2, 4),
                                                          (2, 5),
                                                          (3, 2),
                                                          (3, 3),
                                                          (3, 4),
                                                          (3, 5),
                                                          (4, 1),
                                                          (4, 2),
                                                          (4, 3),
                                                          (4, 4),
                                                          (4, 5),
                                                          (5, 1),
                                                          (5, 2),
                                                          (5, 4),
                                                          (5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `GameStore`
--

CREATE TABLE `GameStore` (
                             `GameID` int(11) NOT NULL,
                             `StoreID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `GameStore`
--

INSERT INTO `GameStore` (`GameID`, `StoreID`) VALUES
                                                  (1, 1),
                                                  (1, 2),
                                                  (1, 3),
                                                  (1, 4),
                                                  (1, 5),
                                                  (2, 1),
                                                  (2, 2),
                                                  (2, 3),
                                                  (2, 4),
                                                  (2, 5),
                                                  (3, 1),
                                                  (3, 2),
                                                  (3, 3),
                                                  (4, 1),
                                                  (4, 2),
                                                  (4, 3),
                                                  (4, 4),
                                                  (4, 5),
                                                  (5, 3),
                                                  (5, 4),
                                                  (5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Platform`
--

CREATE TABLE `Platform` (
                            `PlatformID` int(11) NOT NULL,
                            `Name` varchar(255) NOT NULL,
                            `Manufacturer` varchar(255) DEFAULT NULL,
                            `Type` enum('Console','PC','Mobile') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Platform`
--

INSERT INTO `Platform` (`PlatformID`, `Name`, `Manufacturer`, `Type`) VALUES
                                                                          (1, 'PlayStation 5', 'Sony', 'PC'),
                                                                          (2, 'Xbox Series X', 'Microsoft', 'Console'),
                                                                          (3, 'PC', 'Various', 'PC'),
                                                                          (4, 'Nintendo Switch', 'Nintendo', 'Console'),
                                                                          (5, 'Mobile', 'Various', 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `Store`
--

CREATE TABLE `Store` (
                         `StoreID` int(11) NOT NULL,
                         `Name` varchar(255) NOT NULL,
                         `Location` varchar(255) DEFAULT NULL,
                         `Type` enum('Physical','Digital') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Store`
--

INSERT INTO `Store` (`StoreID`, `Name`, `Location`, `Type`) VALUES
                                                                (1, 'GameStop', 'USA', 'Physical'),
                                                                (2, 'Steam', 'International', 'Digital'),
                                                                (3, 'Amazon', 'International', 'Physical'),
                                                                (4, 'Google Play', 'International', 'Digital'),
                                                                (5, 'Microsoft Store', 'International', 'Digital'),
                                                                (8, 'Ebay', 'USA', 'Digital');

-- --------------------------------------------------------

--
-- Table structure for table `Support`
--

CREATE TABLE `Support` (
                           `SupportID` int(11) NOT NULL,
                           `IssueDescription` text DEFAULT NULL,
                           `DateReported` date DEFAULT NULL,
                           `ResolutionStatus` varchar(100) DEFAULT NULL,
                           `GamerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Support`
--

INSERT INTO `Support` (`SupportID`, `IssueDescription`, `DateReported`, `ResolutionStatus`, `GamerID`) VALUES
                                                                                                           (1, 'Game crashes on start', '2023-04-01', 'Resolved', 1),
                                                                                                           (2, 'Payment not processed', '2023-04-02', 'Resolved', 2),
                                                                                                           (3, 'Account hacked', '2023-04-03', 'Resolved', 3),
                                                                                                           (4, 'DLC not available after purchase', '2023-04-04', 'Pending', 4),
                                                                                                           (5, 'Server connectivity issue', '2023-04-05', 'Resolved', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
    ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `Game`
--
ALTER TABLE `Game`
    ADD PRIMARY KEY (`GameID`),
    ADD KEY `PublisherID` (`PublisherID`);

--
-- Indexes for table `GamePlatform`
--
ALTER TABLE `GamePlatform`
    ADD PRIMARY KEY (`GameID`,`PlatformID`),
    ADD KEY `PlatformID` (`PlatformID`);

--
-- Indexes for table `Gamer`
--
ALTER TABLE `Gamer`
    ADD PRIMARY KEY (`GamerID`);

--
-- Indexes for table `GamerGame`
--
ALTER TABLE `GamerGame`
    ADD PRIMARY KEY (`GamerID`,`GameID`),
    ADD KEY `GameID` (`GameID`);

--
-- Indexes for table `GamerPlatform`
--
ALTER TABLE `GamerPlatform`
    ADD PRIMARY KEY (`GamerID`,`PlatformID`),
    ADD KEY `PlatformID` (`PlatformID`);

--
-- Indexes for table `GameStore`
--
ALTER TABLE `GameStore`
    ADD PRIMARY KEY (`GameID`,`StoreID`),
    ADD KEY `StoreID` (`StoreID`);

--
-- Indexes for table `Platform`
--
ALTER TABLE `Platform`
    ADD PRIMARY KEY (`PlatformID`);

--
-- Indexes for table `Store`
--
ALTER TABLE `Store`
    ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `Support`
--
ALTER TABLE `Support`
    ADD PRIMARY KEY (`SupportID`),
    ADD KEY `GamerID` (`GamerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
    MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Game`
--
ALTER TABLE `Game`
    MODIFY `GameID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Gamer`
--
ALTER TABLE `Gamer`
    MODIFY `GamerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Platform`
--
ALTER TABLE `Platform`
    MODIFY `PlatformID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Store`
--
ALTER TABLE `Store`
    MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Support`
--
ALTER TABLE `Support`
    MODIFY `SupportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Game`
--
ALTER TABLE `Game`
    ADD CONSTRAINT `Game_ibfk_1` FOREIGN KEY (`PublisherID`) REFERENCES `Company` (`CompanyID`);

--
-- Constraints for table `GamePlatform`
--
ALTER TABLE `GamePlatform`
    ADD CONSTRAINT `GamePlatform_ibfk_1` FOREIGN KEY (`GameID`) REFERENCES `Game` (`GameID`),
    ADD CONSTRAINT `GamePlatform_ibfk_2` FOREIGN KEY (`PlatformID`) REFERENCES `Platform` (`PlatformID`);

--
-- Constraints for table `GamerGame`
--
ALTER TABLE `GamerGame`
    ADD CONSTRAINT `GamerGame_ibfk_1` FOREIGN KEY (`GamerID`) REFERENCES `Gamer` (`GamerID`),
    ADD CONSTRAINT `GamerGame_ibfk_2` FOREIGN KEY (`GameID`) REFERENCES `Game` (`GameID`);

--
-- Constraints for table `GamerPlatform`
--
ALTER TABLE `GamerPlatform`
    ADD CONSTRAINT `GamerPlatform_ibfk_1` FOREIGN KEY (`GamerID`) REFERENCES `Gamer` (`GamerID`),
    ADD CONSTRAINT `GamerPlatform_ibfk_2` FOREIGN KEY (`PlatformID`) REFERENCES `Platform` (`PlatformID`);

--
-- Constraints for table `GameStore`
--
ALTER TABLE `GameStore`
    ADD CONSTRAINT `GameStore_ibfk_1` FOREIGN KEY (`GameID`) REFERENCES `Game` (`GameID`),
    ADD CONSTRAINT `GameStore_ibfk_2` FOREIGN KEY (`StoreID`) REFERENCES `Store` (`StoreID`);

--
-- Constraints for table `Support`
--
ALTER TABLE `Support`
    ADD CONSTRAINT `Support_ibfk_1` FOREIGN KEY (`GamerID`) REFERENCES `Gamer` (`GamerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;