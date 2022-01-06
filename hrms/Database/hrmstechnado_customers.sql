SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DROP TABLE IF EXISTS `adjustments`;
CREATE TABLE `adjustments` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL DEFAULT 0,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Type` text NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `adjustmenttypes`;
CREATE TABLE `adjustmenttypes` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Type` tinyint(1) DEFAULT 1,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `adjustmenttypes` (`ID`, `Name`, `Type`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Attendance', 1, 1, '2016-01-04 18:47:19', '2016-01-19 13:38:32'),
(2, 'Late_EarlyDepartureDeduction', 1, 1, '2016-01-19 13:38:55', '0000-00-00 00:00:00'),
(3, 'SALARY ON HOLD', 0, 1, '2016-01-19 13:39:05', '0000-00-00 00:00:00'),
(4, 'IOUS', 0, 1, '2016-01-19 13:39:13', '0000-00-00 00:00:00'),
(5, 'Income Tax', 0, 1, '2016-01-19 13:39:20', '0000-00-00 00:00:00'),
(6, 'Investment Saving', 1, 1, '2016-01-19 13:39:27', '2016-03-26 16:44:20'),
(7, 'Last Month Salary Ded', 0, 1, '2016-01-19 13:39:38', '0000-00-00 00:00:00'),
(8, 'Last Month Salary Adj', 1, 1, '2016-01-19 13:39:46', '0000-00-00 00:00:00'),
(9, 'Increment Arrears', 1, 1, '2016-03-11 12:21:03', '2016-03-26 16:56:37'),
(10, 'Attendance Days Adjustment Allowance', 1, 1, '2016-03-26 16:40:43', '0000-00-00 00:00:00'),
(11, 'Attendance Days Adjustment Deduction', 0, 1, '2016-03-26 16:40:43', '0000-00-00 00:00:00'),
(12, 'Mobile Deduction.', 0, 1, '2016-03-26 16:40:43', '0000-00-00 00:00:00'),
(13, 'Other Deduction', 0, 1, '2016-05-25 16:44:48', '0000-00-00 00:00:00'),
(14, 'Other Allowance', 1, 1, '2016-06-10 11:01:21', '0000-00-00 00:00:00'),
(15, 'Tax Refund', 1, 1, '2016-06-16 15:10:20', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `advances`;
CREATE TABLE `advances` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `AdvanceReqID` int(11) NOT NULL DEFAULT 0,
  `Code` text NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `RemainingAmount` float(11,2) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `IsCompleted` tinyint(1) NOT NULL DEFAULT 0,
  `Reason` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `advance_requests`;
CREATE TABLE `advance_requests` (
  `ID` int(11) NOT NULL,
  `Code` text NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `NotificationTo` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `Reason` text NOT NULL,
  `DisapproveReason` text NOT NULL,
  `AdvanceGranted` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `allowances`;
CREATE TABLE `allowances` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL DEFAULT 0,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Type` text NOT NULL,
  `Taxable` text NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `allowancetypes`;
CREATE TABLE `allowancetypes` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `allowancetypes` (`ID`, `Name`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'House Rent', 1, '2016-01-04 17:46:13', '0000-00-00 00:00:00'),
(2, 'Utility', 1, '2016-01-04 17:46:22', '2016-01-04 17:46:51'),
(3, 'Conveyance', 1, '2016-01-04 17:46:29', '0000-00-00 00:00:00'),
(5, 'Annual Bonus Fix Allowance', 1, '2016-01-09 00:00:00', '0000-00-00 00:00:00'),
(6, 'MOBILE ALLOWANCE', 1, '2016-03-28 11:57:36', '0000-00-00 00:00:00'),
(7, 'INTERNET ALLOWANCE', 1, '2016-03-28 11:57:59', '0000-00-00 00:00:00'),
(8, 'Medical', 1, '2020-02-18 01:31:20', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `ID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Answer` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `anual_bonuses`;
CREATE TABLE `anual_bonuses` (
  `ID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Percentage` float(11,1) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `appraisals`;
CREATE TABLE `appraisals` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text NOT NULL,
  `StartTime` text NOT NULL,
  `EndTime` text NOT NULL,
  `Color` text NOT NULL,
  `Test` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Employees` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `appraisals_result`;
CREATE TABLE `appraisals_result` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `SupID` int(11) NOT NULL,
  `AppraisalID` int(11) NOT NULL,
  `EmpMarks` float(11,3) NOT NULL,
  `SupMarks` float(11,3) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `appraisals_result_details`;
CREATE TABLE `appraisals_result_details` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `SupID` int(11) NOT NULL,
  `AppraisalID` int(11) NOT NULL,
  `KPIID` int(11) NOT NULL,
  `KPI` text NOT NULL,
  `WS` float(11,3) NOT NULL,
  `EmpRate` int(11) NOT NULL,
  `EmpScore` float(11,3) NOT NULL,
  `SupRate` int(11) NOT NULL,
  `SupScore` float(11,3) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `NoOfDays` int(11) NOT NULL,
  `OnTime` tinyint(1) NOT NULL DEFAULT 0,
  `Late` tinyint(1) NOT NULL DEFAULT 0,
  `Month` varchar(30) NOT NULL,
  `Year` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `attendance_log`;
CREATE TABLE `attendance_log` (
  `ID` int(11) NOT NULL,
  `FromDate` date NOT NULL,
  `TillDate` date NOT NULL,
  `GenerateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `authorized_employees`;
CREATE TABLE `authorized_employees` (
  `ID` int(11) NOT NULL,
  `Employees` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `LetterHead` text NOT NULL,
  `AccountNo` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banks` (`ID`, `Name`, `LetterHead`, `AccountNo`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Test Bank', 'Test', '12345', 1, '2015-12-17 00:00:00', '2020-01-31 22:20:18');

DROP TABLE IF EXISTS `basicsalary`;
CREATE TABLE `basicsalary` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL DEFAULT 0,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bonus`;
CREATE TABLE `bonus` (
  `ID` int(11) NOT NULL,
  `MonthBonus` text NOT NULL,
  `BonusDate` date NOT NULL,
  `CompanyID` text NOT NULL,
  `Heading` text NOT NULL,
  `Remarks` text NOT NULL,
  `Steps` int(11) NOT NULL DEFAULT 0,
  `Step1ID` int(11) NOT NULL,
  `Step1Date` date NOT NULL,
  `Step2ID` int(11) NOT NULL,
  `Step2Date` date NOT NULL,
  `Step3ID` int(11) NOT NULL,
  `Step3Date` date NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `bonusdetails`;
CREATE TABLE `bonusdetails` (
  `ID` bigint(20) NOT NULL,
  `BonusID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `TotalDays` int(11) NOT NULL,
  `JoiningDate` date NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `LoanBalance` float(11,2) NOT NULL,
  `BonusAmount` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `Remarks` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `businessunits`;
CREATE TABLE `businessunits` (
  `ID` int(11) NOT NULL,
  `BusinessUnit` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `businessunits` (`ID`, `BusinessUnit`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Mines - Mization', 1, '2020-02-14 23:53:58', '0000-00-00 00:00:00'),
(2, 'Logo Nado and Mellow , Majestick', 1, '2020-02-14 23:54:06', '2020-02-17 17:44:17'),
(3, 'Mellow', 1, '2020-02-14 23:54:11', '0000-00-00 00:00:00'),
(4, 'Majestick', 1, '2020-02-14 23:54:17', '0000-00-00 00:00:00'),
(5, 'OIP', 1, '2020-02-14 23:54:32', '2020-02-15 00:02:39'),
(6, 'Logo Nado', 1, '2020-02-17 17:44:30', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE `candidates` (
  `ID` int(11) NOT NULL,
  `ApplyedFor` int(11) NOT NULL,
  `Resume` int(11) DEFAULT NULL,
  `EmailAddress` text NOT NULL,
  `Phone` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `Status` text NOT NULL,
  `IsShortlist` text NOT NULL,
  `IsDisqualified` text NOT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `candidates_answers`;
CREATE TABLE `candidates_answers` (
  `ID` int(11) NOT NULL,
  `CandidateID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Score` int(11) NOT NULL DEFAULT 0,
  `A1` int(11) NOT NULL,
  `A2` int(11) NOT NULL,
  `A3` int(11) NOT NULL,
  `A4` int(11) NOT NULL,
  `A5` int(11) NOT NULL,
  `A6` int(11) NOT NULL,
  `A7` int(11) NOT NULL,
  `A8` int(11) NOT NULL,
  `A9` int(11) NOT NULL,
  `A10` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `cniccopy`;
CREATE TABLE `cniccopy` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `CNIC` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `commissions`;
CREATE TABLE `commissions` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `ID` int(11) NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Abr` text NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Tax` text NOT NULL,
  `BonusType` text NOT NULL,
  `LoanDeductionPercent` int(11) NOT NULL DEFAULT 0,
  `ProvidentFund` text NOT NULL,
  `PerDayHours` int(11) NOT NULL,
  `GraceTime` text NOT NULL,
  `YearStartFrom` int(11) NOT NULL,
  `DeductionOnLates` text NOT NULL,
  `DeductionOnLatesTypes` text NOT NULL,
  `DeductionOnLatesAdjustment` text NOT NULL,
  `SandwitchDeductions` text NOT NULL,
  `NumOfLates` int(11) NOT NULL,
  `LateDeductAmount` text NOT NULL,
  `WorkingDays` text NOT NULL,
  `RefreshQuota` text NOT NULL,
  `CurrencySymbol` text NOT NULL,
  `PassingPercentage` int(11) NOT NULL,
  `NumOfAttempts` int(11) NOT NULL,
  `InterviewPercentage` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL,
  `Days1` int(11) NOT NULL DEFAULT 0,
  `Days2` int(11) NOT NULL DEFAULT 0,
  `Days3` int(11) NOT NULL DEFAULT 0,
  `Days4` int(11) NOT NULL DEFAULT 0,
  `Days5` int(11) NOT NULL DEFAULT 0,
  `Days6` int(11) NOT NULL DEFAULT 0,
  `Days7` int(11) NOT NULL DEFAULT 0,
  `Days8` int(11) NOT NULL DEFAULT 0,
  `Days9` int(11) NOT NULL DEFAULT 0,
  `Days10` int(11) NOT NULL DEFAULT 0,
  `Days11` int(11) NOT NULL DEFAULT 0,
  `Days12` int(11) NOT NULL DEFAULT 0,
  `Days13` int(11) NOT NULL DEFAULT 0,
  `Days14` int(11) NOT NULL DEFAULT 0,
  `Days15` int(11) NOT NULL DEFAULT 0,
  `Days16` int(11) NOT NULL DEFAULT 0,
  `Days17` int(11) NOT NULL DEFAULT 0,
  `Days18` int(11) NOT NULL DEFAULT 0,
  `Days19` int(11) NOT NULL DEFAULT 0,
  `Days20` int(11) NOT NULL DEFAULT 0,
  `Days21` int(11) DEFAULT 0,
  `Days22` int(11) NOT NULL DEFAULT 0,
  `Days23` int(11) NOT NULL DEFAULT 0,
  `Days24` int(11) NOT NULL DEFAULT 0,
  `Days25` int(11) NOT NULL DEFAULT 0,
  `Days26` int(11) NOT NULL DEFAULT 0,
  `Days27` int(11) NOT NULL DEFAULT 0,
  `Days28` int(11) NOT NULL DEFAULT 0,
  `Days29` int(11) NOT NULL DEFAULT 0,
  `Days30` int(11) NOT NULL DEFAULT 0,
  `Days31` int(11) NOT NULL DEFAULT 0,
  `HalfDays1` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays2` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays3` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays4` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays5` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays6` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays7` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays8` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays9` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays10` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays11` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays12` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays13` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays14` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays15` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays16` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays17` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays18` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays19` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays20` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays21` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays22` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays23` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays24` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays25` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays26` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays27` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays28` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays29` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays30` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDays31` tinyint(1) NOT NULL DEFAULT 0,
  `EDays1` int(11) NOT NULL DEFAULT 0,
  `EDays2` int(11) NOT NULL DEFAULT 0,
  `EDays3` int(11) NOT NULL DEFAULT 0,
  `EDays4` int(11) NOT NULL DEFAULT 0,
  `EDays5` int(11) NOT NULL DEFAULT 0,
  `EDays6` int(11) NOT NULL DEFAULT 0,
  `EDays7` int(11) NOT NULL DEFAULT 0,
  `EDays8` int(11) NOT NULL DEFAULT 0,
  `EDays9` int(11) NOT NULL DEFAULT 0,
  `EDays10` int(11) NOT NULL DEFAULT 0,
  `EDays11` int(11) NOT NULL DEFAULT 0,
  `EDays12` int(11) NOT NULL DEFAULT 0,
  `EDays13` int(11) NOT NULL DEFAULT 0,
  `EDays14` int(11) NOT NULL DEFAULT 0,
  `EDays15` int(11) NOT NULL DEFAULT 0,
  `EDays16` int(11) NOT NULL DEFAULT 0,
  `EDays17` int(11) NOT NULL DEFAULT 0,
  `EDays18` int(11) NOT NULL DEFAULT 0,
  `EDays19` int(11) NOT NULL DEFAULT 0,
  `EDays20` int(11) NOT NULL DEFAULT 0,
  `EDays21` int(11) NOT NULL DEFAULT 0,
  `EDays22` int(11) NOT NULL DEFAULT 0,
  `EDays23` int(11) NOT NULL DEFAULT 0,
  `EDays24` int(11) NOT NULL DEFAULT 0,
  `EDays25` int(11) NOT NULL DEFAULT 0,
  `EDays26` int(11) NOT NULL DEFAULT 0,
  `EDays27` int(11) NOT NULL DEFAULT 0,
  `EDays28` int(11) NOT NULL DEFAULT 0,
  `EDays29` int(11) NOT NULL DEFAULT 0,
  `EDays30` int(11) NOT NULL DEFAULT 0,
  `EDays31` int(11) NOT NULL DEFAULT 0,
  `EHalfDays1` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays2` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays3` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays4` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays5` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays6` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays7` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays8` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays9` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays10` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays11` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays12` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays13` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays14` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays15` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays16` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays17` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays18` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays19` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays20` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays21` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays22` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays23` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays24` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays25` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays26` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays27` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays28` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays29` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays30` tinyint(1) NOT NULL DEFAULT 0,
  `EHalfDays31` tinyint(1) NOT NULL DEFAULT 0,
  `BonusPloicy1` text NOT NULL,
  `BonusPloicy2` text NOT NULL,
  `BonusPloicy3` text NOT NULL,
  `BonusPloicy4` text NOT NULL,
  `BonusPloicy5` text NOT NULL,
  `BonusPloicy6` text NOT NULL,
  `BonusPloicy7` text NOT NULL,
  `BonusPloicy8` text NOT NULL,
  `BonusPloicy9` text NOT NULL,
  `BonusPloicy10` text NOT NULL,
  `BonusPloicy11` text NOT NULL,
  `BonusPloicy12` text NOT NULL,
  `BonusPloicy13` text NOT NULL,
  `BonusBaseOn1` text NOT NULL,
  `BonusBaseOn2` text NOT NULL,
  `BonusBaseOn3` text NOT NULL,
  `BonusBaseOn4` text NOT NULL,
  `BonusBaseOn5` text NOT NULL,
  `BonusBaseOn6` text NOT NULL,
  `BonusBaseOn7` text NOT NULL,
  `BonusBaseOn8` text NOT NULL,
  `BonusBaseOn9` text NOT NULL,
  `BonusBaseOn10` text NOT NULL,
  `BonusBaseOn11` text NOT NULL,
  `BonusBaseOn12` text NOT NULL,
  `BonusBaseOn13` text NOT NULL,
  `BonusAmntPer1` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer2` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer3` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer4` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer5` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer6` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer7` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer8` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer9` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer10` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer11` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer12` float(11,2) NOT NULL DEFAULT 0.00,
  `BonusAmntPer13` float(11,2) NOT NULL DEFAULT 0.00,
  `Logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `companies` (`ID`, `UpdatedBy`, `Name`, `Abr`, `Status`, `Tax`, `BonusType`, `LoanDeductionPercent`, `ProvidentFund`, `PerDayHours`, `GraceTime`, `YearStartFrom`, `DeductionOnLates`, `DeductionOnLatesTypes`, `DeductionOnLatesAdjustment`, `SandwitchDeductions`, `NumOfLates`, `LateDeductAmount`, `WorkingDays`, `RefreshQuota`, `CurrencySymbol`, `PassingPercentage`, `NumOfAttempts`, `InterviewPercentage`, `DateAdded`, `DateModified`, `Days1`, `Days2`, `Days3`, `Days4`, `Days5`, `Days6`, `Days7`, `Days8`, `Days9`, `Days10`, `Days11`, `Days12`, `Days13`, `Days14`, `Days15`, `Days16`, `Days17`, `Days18`, `Days19`, `Days20`, `Days21`, `Days22`, `Days23`, `Days24`, `Days25`, `Days26`, `Days27`, `Days28`, `Days29`, `Days30`, `Days31`, `HalfDays1`, `HalfDays2`, `HalfDays3`, `HalfDays4`, `HalfDays5`, `HalfDays6`, `HalfDays7`, `HalfDays8`, `HalfDays9`, `HalfDays10`, `HalfDays11`, `HalfDays12`, `HalfDays13`, `HalfDays14`, `HalfDays15`, `HalfDays16`, `HalfDays17`, `HalfDays18`, `HalfDays19`, `HalfDays20`, `HalfDays21`, `HalfDays22`, `HalfDays23`, `HalfDays24`, `HalfDays25`, `HalfDays26`, `HalfDays27`, `HalfDays28`, `HalfDays29`, `HalfDays30`, `HalfDays31`, `EDays1`, `EDays2`, `EDays3`, `EDays4`, `EDays5`, `EDays6`, `EDays7`, `EDays8`, `EDays9`, `EDays10`, `EDays11`, `EDays12`, `EDays13`, `EDays14`, `EDays15`, `EDays16`, `EDays17`, `EDays18`, `EDays19`, `EDays20`, `EDays21`, `EDays22`, `EDays23`, `EDays24`, `EDays25`, `EDays26`, `EDays27`, `EDays28`, `EDays29`, `EDays30`, `EDays31`, `EHalfDays1`, `EHalfDays2`, `EHalfDays3`, `EHalfDays4`, `EHalfDays5`, `EHalfDays6`, `EHalfDays7`, `EHalfDays8`, `EHalfDays9`, `EHalfDays10`, `EHalfDays11`, `EHalfDays12`, `EHalfDays13`, `EHalfDays14`, `EHalfDays15`, `EHalfDays16`, `EHalfDays17`, `EHalfDays18`, `EHalfDays19`, `EHalfDays20`, `EHalfDays21`, `EHalfDays22`, `EHalfDays23`, `EHalfDays24`, `EHalfDays25`, `EHalfDays26`, `EHalfDays27`, `EHalfDays28`, `EHalfDays29`, `EHalfDays30`, `EHalfDays31`, `BonusPloicy1`, `BonusPloicy2`, `BonusPloicy3`, `BonusPloicy4`, `BonusPloicy5`, `BonusPloicy6`, `BonusPloicy7`, `BonusPloicy8`, `BonusPloicy9`, `BonusPloicy10`, `BonusPloicy11`, `BonusPloicy12`, `BonusPloicy13`, `BonusBaseOn1`, `BonusBaseOn2`, `BonusBaseOn3`, `BonusBaseOn4`, `BonusBaseOn5`, `BonusBaseOn6`, `BonusBaseOn7`, `BonusBaseOn8`, `BonusBaseOn9`, `BonusBaseOn10`, `BonusBaseOn11`, `BonusBaseOn12`, `BonusBaseOn13`, `BonusAmntPer1`, `BonusAmntPer2`, `BonusAmntPer3`, `BonusAmntPer4`, `BonusAmntPer5`, `BonusAmntPer6`, `BonusAmntPer7`, `BonusAmntPer8`, `BonusAmntPer9`, `BonusAmntPer10`, `BonusAmntPer11`, `BonusAmntPer12`, `BonusAmntPer13`, `Logo`) VALUES
(2, 1077, 'Test Company', 'TN', 1, 'No', 'Individual', 0, 'No', 9, '09:15:00', 1, 'Yes', 'Individual', 'Yes', 'AND', 3, 'Full Day Leave', '1,2,3,4,5', 'Clear Previous', 'Rs:', 50, 3, 60, '2015-12-17 00:00:00', '2020-08-07 21:14:58', 0, 0, 0, 0, 0, 1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5, 6, 6, 6, 7, 7, 7, 8, 8, 8, 9, 9, 9, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'None', 'None', 'None', 'None', 'Gross', 'Gross', 'Gross', 'Gross', 'Gross', 'Gross', 'Gross', 'Gross', 'Gross', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Percentage', 'Percentage', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'C2.png');

DROP TABLE IF EXISTS `companiesold`;
CREATE TABLE `companiesold` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Abr` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `iso` char(2) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL DEFAULT '',
  `printable_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `countries` (`iso`, `name`, `printable_name`, `iso3`, `numcode`) VALUES
('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
('AL', 'ALBANIA', 'Albania', 'ALB', 8),
('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
('AD', 'ANDORRA', 'Andorra', 'AND', 20),
('AO', 'ANGOLA', 'Angola', 'AGO', 24),
('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
('AW', 'ARUBA', 'Aruba', 'ABW', 533),
('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
('BY', 'BELARUS', 'Belarus', 'BLR', 112),
('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
('BJ', 'BENIN', 'Benin', 'BEN', 204),
('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
('CA', 'CANADA', 'Canada', 'CAN', 124),
('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
('TD', 'CHAD', 'Chad', 'TCD', 148),
('CL', 'CHILE', 'Chile', 'CHL', 152),
('CN', 'CHINA', 'China', 'CHN', 156),
('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
('KM', 'COMOROS', 'Comoros', 'COM', 174),
('CG', 'CONGO', 'Congo', 'COG', 178),
('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
('CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384),
('HR', 'CROATIA', 'Croatia', 'HRV', 191),
('CU', 'CUBA', 'Cuba', 'CUB', 192),
('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
('DK', 'DENMARK', 'Denmark', 'DNK', 208),
('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
('EG', 'EGYPT', 'Egypt', 'EGY', 818),
('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
('EE', 'ESTONIA', 'Estonia', 'EST', 233),
('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
('FJ', 'FIJI', 'Fiji', 'FJI', 242),
('FI', 'FINLAND', 'Finland', 'FIN', 246),
('FR', 'FRANCE', 'France', 'FRA', 250),
('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
('GA', 'GABON', 'Gabon', 'GAB', 266),
('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
('DE', 'GERMANY', 'Germany', 'DEU', 276),
('GH', 'GHANA', 'Ghana', 'GHA', 288),
('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
('GR', 'GREECE', 'Greece', 'GRC', 300),
('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
('GD', 'GRENADA', 'Grenada', 'GRD', 308),
('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
('GU', 'GUAM', 'Guam', 'GUM', 316),
('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
('GN', 'GUINEA', 'Guinea', 'GIN', 324),
('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
('GY', 'GUYANA', 'Guyana', 'GUY', 328),
('HT', 'HAITI', 'Haiti', 'HTI', 332),
('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
('HN', 'HONDURAS', 'Honduras', 'HND', 340),
('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
('IS', 'ICELAND', 'Iceland', 'ISL', 352),
('IN', 'INDIA', 'India', 'IND', 356),
('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
('IE', 'IRELAND', 'Ireland', 'IRL', 372),
('IL', 'ISRAEL', 'Israel', 'ISR', 376),
('IT', 'ITALY', 'Italy', 'ITA', 380),
('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
('JP', 'JAPAN', 'Japan', 'JPN', 392),
('JO', 'JORDAN', 'Jordan', 'JOR', 400),
('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
('KE', 'KENYA', 'Kenya', 'KEN', 404),
('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
('KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408),
('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
('LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418),
('LV', 'LATVIA', 'Latvia', 'LVA', 428),
('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
('MO', 'MACAO', 'Macao', 'MAC', 446),
('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
('MW', 'MALAWI', 'Malawi', 'MWI', 454),
('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
('ML', 'MALI', 'Mali', 'MLI', 466),
('MT', 'MALTA', 'Malta', 'MLT', 470),
('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
('MX', 'MEXICO', 'Mexico', 'MEX', 484),
('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
('MC', 'MONACO', 'Monaco', 'MCO', 492),
('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
('NR', 'NAURU', 'Nauru', 'NRU', 520),
('NP', 'NEPAL', 'Nepal', 'NPL', 524),
('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
('NE', 'NIGER', 'Niger', 'NER', 562),
('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
('NU', 'NIUE', 'Niue', 'NIU', 570),
('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
('NO', 'NORWAY', 'Norway', 'NOR', 578),
('OM', 'OMAN', 'Oman', 'OMN', 512),
('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
('PW', 'PALAU', 'Palau', 'PLW', 585),
('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
('PA', 'PANAMA', 'Panama', 'PAN', 591),
('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
('PE', 'PERU', 'Peru', 'PER', 604),
('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
('PL', 'POLAND', 'Poland', 'POL', 616),
('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
('QA', 'QATAR', 'Qatar', 'QAT', 634),
('RE', 'REUNION', 'Reunion', 'REU', 638),
('RO', 'ROMANIA', 'Romania', 'ROM', 642),
('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
('WS', 'SAMOA', 'Samoa', 'WSM', 882),
('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
('ES', 'SPAIN', 'Spain', 'ESP', 724),
('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
('SD', 'SUDAN', 'Sudan', 'SDN', 736),
('SR', 'SURINAME', 'Suriname', 'SUR', 740),
('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),
('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
('TH', 'THAILAND', 'Thailand', 'THA', 764),
('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
('TG', 'TOGO', 'Togo', 'TGO', 768),
('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
('TO', 'TONGA', 'Tonga', 'TON', 776),
('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
('TR', 'TURKEY', 'Turkey', 'TUR', 792),
('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
('UG', 'UGANDA', 'Uganda', 'UGA', 800),
('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
('US', 'UNITED STATES', 'United States', 'USA', 840),
('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
('YE', 'YEMEN', 'Yemen', 'YEM', 887),
('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

DROP TABLE IF EXISTS `current_leaves_quota`;
CREATE TABLE `current_leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `AnualLeaves` float(11,1) NOT NULL,
  `SickLeaves` float(11,1) NOT NULL,
  `CasualLeaves` float(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `current_leaves_quota2`;
CREATE TABLE `current_leaves_quota2` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `AnualLeaves` float(11,1) NOT NULL,
  `SickLeaves` float(11,1) NOT NULL,
  `CasualLeaves` float(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `current_leaves_quota_encashment`;
CREATE TABLE `current_leaves_quota_encashment` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `AnualLeaves` float(11,1) NOT NULL,
  `SickLeaves` float(11,1) NOT NULL,
  `CasualLeaves` float(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `deductions`;
CREATE TABLE `deductions` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL DEFAULT 0,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Type` text NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `deductiontypes`;
CREATE TABLE `deductiontypes` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `deductiontypes` (`ID`, `Name`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Employee Contribution', 0, '2016-01-11 11:43:05', '2016-07-26 17:15:48'),
(2, 'Income Tax', 1, '2016-02-26 14:55:49', '0000-00-00 00:00:00'),
(3, 'Other Deduction', 1, '2016-05-25 16:42:57', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `Department` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `departments` (`ID`, `Department`, `Status`, `DateAdded`, `DateModified`) VALUES
(24, 'Web-Video-Server - Production', 1, '2016-04-01 11:13:38', '2020-07-21 22:53:38'),
(25, 'PMO', 1, '2020-06-11 23:58:09', '0000-00-00 00:00:00'),
(26, 'Creative - Production', 1, '2020-07-21 22:21:28', '0000-00-00 00:00:00'),
(27, 'Mobile Application - Production', 1, '2020-07-23 18:53:07', '0000-00-00 00:00:00'),
(28, 'Digital Marketing', 1, '2020-07-23 21:27:17', '0000-00-00 00:00:00'),
(29, 'Total Quality Management', 1, '2020-07-23 23:10:12', '0000-00-00 00:00:00'),
(30, 'App Agency (App Sales)', 1, '2020-07-31 19:10:43', '0000-00-00 00:00:00'),
(31, 'Business Development Outsourcing', 1, '2020-07-31 19:10:51', '0000-00-00 00:00:00'),
(32, 'Email Marketing', 1, '2020-07-31 19:11:06', '0000-00-00 00:00:00'),
(33, 'Design and Development', 1, '2020-07-31 19:11:24', '0000-00-00 00:00:00'),
(34, 'Human Resources', 1, '2020-07-31 19:11:32', '0000-00-00 00:00:00'),
(35, 'Logo Design Office', 1, '2020-07-31 19:11:41', '0000-00-00 00:00:00'),
(36, 'Marketing PPC', 1, '2020-07-31 19:11:49', '0000-00-00 00:00:00'),
(37, 'Mines / Fictive (Design)', 1, '2020-07-31 19:11:56', '0000-00-00 00:00:00'),
(38, 'Mization & Majestick (Design)', 1, '2020-07-31 19:12:04', '0000-00-00 00:00:00'),
(39, 'Nado (Design)', 1, '2020-07-31 19:12:12', '0000-00-00 00:00:00'),
(40, 'Prismatic', 1, '2020-07-31 19:12:19', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `designations`;
CREATE TABLE `designations` (
  `ID` int(11) NOT NULL,
  `Designation` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `designations` (`ID`, `Designation`, `Status`, `DateAdded`, `DateModified`) VALUES
(102, 'Team Lead - Custom Development', 1, '2020-01-31 22:31:42', '2020-01-31 22:32:08'),
(103, 'Team Lead - UI / UX', 1, '2020-01-31 22:32:32', '0000-00-00 00:00:00'),
(104, 'Team Lead - Graphic Designer', 1, '2020-01-31 22:32:50', '0000-00-00 00:00:00'),
(105, 'Team Lead - CMS', 1, '2020-01-31 22:33:02', '0000-00-00 00:00:00'),
(106, 'Team Lead - Video', 1, '2020-01-31 22:33:13', '0000-00-00 00:00:00'),
(107, 'Team Lead - Server Administrator', 1, '2020-01-31 22:33:30', '0000-00-00 00:00:00'),
(108, 'Team Lead - 3D', 1, '2020-01-31 22:33:47', '0000-00-00 00:00:00'),
(109, 'Team Lead - IOS', 1, '2020-01-31 22:34:00', '0000-00-00 00:00:00'),
(110, 'Team Lead - Application', 1, '2020-01-31 22:34:24', '0000-00-00 00:00:00'),
(111, 'Team Lead - Front End', 1, '2020-01-31 22:35:36', '0000-00-00 00:00:00'),
(112, 'Project Manager', 1, '2020-01-31 22:35:48', '0000-00-00 00:00:00'),
(113, 'Business Analyst', 1, '2020-01-31 22:35:57', '0000-00-00 00:00:00'),
(114, 'Head Of Production', 1, '2020-01-31 22:36:19', '0000-00-00 00:00:00'),
(115, 'Head Of UI / UX', 1, '2020-01-31 22:36:29', '0000-00-00 00:00:00'),
(116, 'Head Of Application', 1, '2020-01-31 22:36:41', '0000-00-00 00:00:00'),
(117, 'Head Of Digital Marketing', 1, '2020-01-31 22:37:04', '0000-00-00 00:00:00'),
(118, 'Head Of Department', 1, '2020-01-31 22:37:15', '2020-08-04 18:26:48'),
(119, 'Senior Developer', 1, '2020-01-31 22:42:41', '0000-00-00 00:00:00'),
(120, 'Junior Developer', 1, '2020-01-31 22:42:50', '0000-00-00 00:00:00'),
(121, 'Mid-Level Developer', 1, '2020-01-31 22:43:02', '0000-00-00 00:00:00'),
(122, 'Senior Designer', 1, '2020-01-31 22:43:38', '0000-00-00 00:00:00'),
(123, 'Junior Designer', 1, '2020-01-31 22:43:52', '0000-00-00 00:00:00'),
(124, 'Linux System Engineer', 1, '2020-01-31 22:44:53', '2020-02-03 20:44:16'),
(125, 'Animator', 1, '2020-02-03 18:28:17', '0000-00-00 00:00:00'),
(126, 'Story Board Artist', 1, '2020-02-03 18:28:27', '0000-00-00 00:00:00'),
(127, 'Editor', 1, '2020-02-03 18:28:33', '0000-00-00 00:00:00'),
(128, 'Sr. Wordpress Developer', 1, '2020-02-03 21:22:19', '2020-02-03 21:23:09'),
(129, 'Jr. Wordpress Developer', 1, '2020-02-03 21:22:43', '0000-00-00 00:00:00'),
(130, 'Data Entry Officer', 1, '2020-02-06 23:25:06', '0000-00-00 00:00:00'),
(131, 'Team Lead - Game Development', 1, '2020-07-21 23:03:09', '0000-00-00 00:00:00'),
(132, 'Sr - Story Board Artist', 1, '2020-07-21 23:04:57', '0000-00-00 00:00:00'),
(133, 'Sr - Animator', 1, '2020-07-21 23:10:22', '0000-00-00 00:00:00'),
(134, 'Jr - Animator', 1, '2020-07-21 23:10:38', '0000-00-00 00:00:00'),
(135, 'Senior SEO Executive', 1, '2020-07-23 21:29:25', '0000-00-00 00:00:00'),
(136, 'Junior SEO Executive', 1, '2020-07-23 21:29:30', '0000-00-00 00:00:00'),
(137, 'Senior SMM Executive', 1, '2020-07-23 21:29:42', '0000-00-00 00:00:00'),
(138, 'Junior SMM Executive', 1, '2020-07-23 21:29:49', '0000-00-00 00:00:00'),
(139, 'Content Writer', 1, '2020-07-23 21:30:16', '0000-00-00 00:00:00'),
(140, 'Manager Quality Analyst', 1, '2020-07-23 23:12:50', '2020-07-23 23:14:19'),
(141, 'Sr Quality Analyst Officer', 1, '2020-07-23 23:13:08', '2020-07-23 23:14:42'),
(142, 'HRBP', 1, '2020-08-04 18:18:06', '0000-00-00 00:00:00'),
(143, 'Account Manager', 1, '2020-08-04 19:10:20', '0000-00-00 00:00:00'),
(144, 'Sales Executive', 1, '2020-08-04 19:15:23', '0000-00-00 00:00:00'),
(145, 'Team Lead', 1, '2020-08-04 19:43:04', '0000-00-00 00:00:00'),
(146, 'HR Executive', 1, '2020-08-04 21:06:14', '0000-00-00 00:00:00'),
(147, 'PPC Executive', 1, '2020-08-04 21:17:44', '0000-00-00 00:00:00'),
(148, 'Consultant', 1, '2020-08-04 21:28:19', '0000-00-00 00:00:00'),
(149, 'Business Process Executive', 1, '2020-08-04 21:59:50', '0000-00-00 00:00:00'),
(150, 'Assistant Manager IT Service', 1, '2020-08-04 22:00:00', '0000-00-00 00:00:00'),
(151, 'Internee WP', 1, '2020-08-04 22:00:23', '0000-00-00 00:00:00'),
(152, 'Sales & Account Manager', 1, '2020-08-04 22:03:19', '0000-00-00 00:00:00'),
(153, 'Divisional Head', 1, '2020-08-04 22:22:46', '0000-00-00 00:00:00'),
(154, 'Social Media Manager', 1, '2020-08-04 22:24:47', '0000-00-00 00:00:00'),
(155, 'Out staffing Agent', 1, '2020-08-04 22:32:58', '0000-00-00 00:00:00'),
(156, 'Internee Graphic Designer', 1, '2020-08-04 22:39:17', '0000-00-00 00:00:00'),
(157, 'Server Administrator', 1, '2020-08-19 17:46:17', '0000-00-00 00:00:00'),
(158, 'Intern', 1, '2020-08-19 20:02:06', '0000-00-00 00:00:00'),
(159, 'Social Media Executive', 1, '2020-08-19 21:08:02', '0000-00-00 00:00:00'),
(160, 'Web QA Executive', 1, '2020-09-11 13:12:52', '0000-00-00 00:00:00'),
(161, 'VA Reception Executive', 1, '2020-10-27 13:19:12', '2020-10-27 13:22:44'),
(162, 'Project Co-ordinator', 1, '2020-11-02 12:42:23', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `developers`;
CREATE TABLE `developers` (
  `ID` int(11) NOT NULL,
  `Role` text NOT NULL,
  `AllowEmpLogin` text NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `JoiningDate` date NOT NULL,
  `EmpID` text NOT NULL,
  `Status` text NOT NULL,
  `Photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `developers` (`ID`, `Role`, `AllowEmpLogin`, `UserName`, `Password`, `FirstName`, `LastName`, `JoiningDate`, `EmpID`, `Status`, `Photo`) VALUES
(1, 'Administrator', 'Yes', 'developer', 'admin', 'Muhammad', 'Zeeshan', '2020-01-01', 'developer-001', 'Active', '');

DROP TABLE IF EXISTS `dincometax`;
CREATE TABLE `dincometax` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `NewAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `FileName` text NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `ID` int(11) NOT NULL,
  `EmpID` text DEFAULT NULL,
  `Salutation` text DEFAULT NULL,
  `FirstName` text DEFAULT NULL,
  `LastName` text DEFAULT NULL,
  `FatherName` text DEFAULT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `Location` int(11) DEFAULT NULL,
  `Designation` text DEFAULT NULL,
  `Department` text DEFAULT NULL,
  `SubDepartment` int(11) NOT NULL,
  `BusinessUnit` int(11) NOT NULL,
  `Status` text DEFAULT NULL,
  `ChatStatus` enum('0','1','2') NOT NULL DEFAULT '1',
  `Role` text NOT NULL,
  `EmpType` text DEFAULT NULL,
  `EmpTypeDate` date NOT NULL,
  `Grade` text DEFAULT NULL,
  `Salary` float(11,2) NOT NULL DEFAULT 0.00,
  `GetSalary` text NOT NULL,
  `Supervisor` text DEFAULT NULL,
  `AllowEmpLogin` text NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `EmailAddress` text NOT NULL,
  `PersonalEmailAddress` text NOT NULL,
  `Notifications` text NOT NULL,
  `DOB` date NOT NULL,
  `MaritalStatus` text DEFAULT NULL,
  `Gender` text NOT NULL,
  `BloodGroup` text DEFAULT NULL,
  `Nationality` text NOT NULL,
  `JoiningDate` date NOT NULL,
  `ResignationDate` date NOT NULL,
  `LeavingDate` date DEFAULT NULL,
  `ResignationAccepted` text NOT NULL,
  `ResignationRemarks` text NOT NULL,
  `CNICNumber` text DEFAULT NULL,
  `CNICIssueDate` date NOT NULL,
  `CNICExpiration` date DEFAULT NULL,
  `IqamaNumber` text NOT NULL,
  `PassportNumber` text DEFAULT NULL,
  `PassportIssueDate` date NOT NULL,
  `PassportExpiration` date DEFAULT NULL,
  `DrivingLicenseNumber` text NOT NULL,
  `DrivingLicenseIssueDate` date NOT NULL,
  `DrivingLicenseExpiration` date NOT NULL,
  `VisaIssueDate` date NOT NULL,
  `VisaExpiration` date NOT NULL,
  `NOY` int(11) DEFAULT NULL,
  `NOM` int(11) DEFAULT NULL,
  `LastCompany` text DEFAULT NULL,
  `LastDesignation` text DEFAULT NULL,
  `LastSalary` text DEFAULT NULL,
  `LastWorkingDay` date DEFAULT NULL,
  `IsFirstJob` text NOT NULL,
  `Address` text NOT NULL,
  `MachineID` text NOT NULL,
  `EmploymentType` text NOT NULL,
  `SalaryDisbursmintPeriod` text NOT NULL,
  `SESSINo` text NOT NULL,
  `EOBINo` text NOT NULL,
  `Bonus` text NOT NULL,
  `CanTakeLoan` text NOT NULL,
  `CanTakeAdvance` text NOT NULL,
  `PayFullSalary` text NOT NULL,
  `SalePersonOutdoorPerson` text NOT NULL,
  `StopSalary` text NOT NULL,
  `EmployeeContribution` int(11) NOT NULL,
  `EmployerContribution` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `OvertimePolicy` int(11) NOT NULL,
  `AttendanceAllowance` text NOT NULL,
  `AttAllAmount` float(11,2) NOT NULL,
  `LateArrivalPolicy` text NOT NULL,
  `EarlyDeparturePolicy` text NOT NULL,
  `ArrivalHalfDay` text NOT NULL,
  `DepartHalfDay` text NOT NULL,
  `AverageWorkingHours` text NOT NULL,
  `WorkingType` text NOT NULL,
  `LeavesDays` text NOT NULL,
  `SandwichLeaves` text NOT NULL,
  `HalfDays` text NOT NULL,
  `Religion` text NOT NULL,
  `Bank` text NOT NULL,
  `AccountTitle` text NOT NULL,
  `AccountNumber` text NOT NULL,
  `LastEducationDegree` text NOT NULL,
  `UniversityCollege` text NOT NULL,
  `EducationCompletionYear` int(11) NOT NULL,
  `GradeMarksPercentage` text NOT NULL,
  `LastTechnicalEducationCertificate` text NOT NULL,
  `UniversityInstitute` text NOT NULL,
  `TechnicalEducationCompletionYear` int(11) NOT NULL,
  `GradePercentageMarks` text NOT NULL,
  `HomeNumber` text DEFAULT NULL,
  `OfficeNumber` text DEFAULT NULL,
  `MobileNumber` text DEFAULT NULL,
  `EmergencyPerson` text DEFAULT NULL,
  `Relationship` text DEFAULT NULL,
  `EmergencyNumber` text DEFAULT NULL,
  `Photo` text DEFAULT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `employees` (`ID`, `EmpID`, `Salutation`, `FirstName`, `LastName`, `FatherName`, `CompanyID`, `Location`, `Designation`, `Department`, `SubDepartment`, `BusinessUnit`, `Status`, `ChatStatus`, `Role`, `EmpType`, `EmpTypeDate`, `Grade`, `Salary`, `GetSalary`, `Supervisor`, `AllowEmpLogin`, `UserName`, `Password`, `EmailAddress`, `PersonalEmailAddress`, `Notifications`, `DOB`, `MaritalStatus`, `Gender`, `BloodGroup`, `Nationality`, `JoiningDate`, `ResignationDate`, `LeavingDate`, `ResignationAccepted`, `ResignationRemarks`, `CNICNumber`, `CNICIssueDate`, `CNICExpiration`, `IqamaNumber`, `PassportNumber`, `PassportIssueDate`, `PassportExpiration`, `DrivingLicenseNumber`, `DrivingLicenseIssueDate`, `DrivingLicenseExpiration`, `VisaIssueDate`, `VisaExpiration`, `NOY`, `NOM`, `LastCompany`, `LastDesignation`, `LastSalary`, `LastWorkingDay`, `IsFirstJob`, `Address`, `MachineID`, `EmploymentType`, `SalaryDisbursmintPeriod`, `SESSINo`, `EOBINo`, `Bonus`, `CanTakeLoan`, `CanTakeAdvance`, `PayFullSalary`, `SalePersonOutdoorPerson`, `StopSalary`, `EmployeeContribution`, `EmployerContribution`, `ScheduleID`, `OvertimePolicy`, `AttendanceAllowance`, `AttAllAmount`, `LateArrivalPolicy`, `EarlyDeparturePolicy`, `ArrivalHalfDay`, `DepartHalfDay`, `AverageWorkingHours`, `WorkingType`, `LeavesDays`, `SandwichLeaves`, `HalfDays`, `Religion`, `Bank`, `AccountTitle`, `AccountNumber`, `LastEducationDegree`, `UniversityCollege`, `EducationCompletionYear`, `GradeMarksPercentage`, `LastTechnicalEducationCertificate`, `UniversityInstitute`, `TechnicalEducationCompletionYear`, `GradePercentageMarks`, `HomeNumber`, `OfficeNumber`, `MobileNumber`, `EmergencyPerson`, `Relationship`, `EmergencyNumber`, `Photo`, `DateAdded`, `DateModified`, `token`) VALUES
(1077, '01077', 'Mr', 'Test User', '', 'Test', 2, 1, 'Head Of Department', 'Web-Video-Server - Production', 2, 0, 'Active', '1', 'Administrator', 'Permanent', '2017-04-03', 'Manager', 250000.00, 'Yes', '', 'Yes', 'User_01077', 'password', 'test@user.com', 'test@user.com', 'Yes', '1987-09-15', 'Married', 'Male', '', 'PAK', '2016-12-23', '0000-00-00', '0000-00-00', 'No', '', '0', '0000-00-00', '0000-00-00', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '0000-00-00', 'Yes', 'test address', '1077', 'Management Staff', 'Monthly', '', '', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 0, 0, 1, 0, 'None', 0.00, 'Not Allowed', 'Not Allowed', 'Not Allowed', 'Not Allowed', '9', 'Shift Base', '6,7', '1,5', '', 'ISLAM', 'Meezan Bank', 'Test', '', 'BBA Hons', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '1077.jpg', '2020-02-01 00:00:00', '2020-10-19 17:46:50', '');

DROP TABLE IF EXISTS `employees2`;
CREATE TABLE `employees2` (
  `ID` int(11) NOT NULL,
  `EmpID` text DEFAULT NULL,
  `Salutation` text DEFAULT NULL,
  `FirstName` text DEFAULT NULL,
  `LastName` text DEFAULT NULL,
  `FatherName` text DEFAULT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `Location` int(11) DEFAULT NULL,
  `Designation` text DEFAULT NULL,
  `Department` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `Role` text NOT NULL,
  `EmpType` text DEFAULT NULL,
  `EmpTypeDate` date NOT NULL,
  `Grade` text DEFAULT NULL,
  `Salary` float(11,2) NOT NULL DEFAULT 0.00,
  `GetSalary` text NOT NULL,
  `Supervisor` text DEFAULT NULL,
  `AllowEmpLogin` text NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `EmailAddress` text NOT NULL,
  `PersonalEmailAddress` text NOT NULL,
  `Notifications` text NOT NULL,
  `DOB` date NOT NULL,
  `MaritalStatus` text DEFAULT NULL,
  `Gender` text NOT NULL,
  `BloodGroup` text DEFAULT NULL,
  `Nationality` text NOT NULL,
  `JoiningDate` date NOT NULL,
  `ResignationDate` date NOT NULL,
  `LeavingDate` date DEFAULT NULL,
  `ResignationAccepted` text NOT NULL,
  `ResignationRemarks` text NOT NULL,
  `CNICNumber` text DEFAULT NULL,
  `CNICIssueDate` date NOT NULL,
  `CNICExpiration` date DEFAULT NULL,
  `IqamaNumber` text NOT NULL,
  `PassportNumber` text DEFAULT NULL,
  `PassportIssueDate` date NOT NULL,
  `PassportExpiration` date DEFAULT NULL,
  `DrivingLicenseNumber` text NOT NULL,
  `DrivingLicenseIssueDate` date NOT NULL,
  `DrivingLicenseExpiration` date NOT NULL,
  `VisaIssueDate` date NOT NULL,
  `VisaExpiration` date NOT NULL,
  `NOY` int(11) DEFAULT NULL,
  `NOM` int(11) DEFAULT NULL,
  `LastCompany` text DEFAULT NULL,
  `LastDesignation` text DEFAULT NULL,
  `LastSalary` text DEFAULT NULL,
  `LastWorkingDay` date DEFAULT NULL,
  `IsFirstJob` text NOT NULL,
  `Address` text NOT NULL,
  `MachineID` text NOT NULL,
  `EmploymentType` text NOT NULL,
  `SalaryDisbursmintPeriod` text NOT NULL,
  `SESSINo` text NOT NULL,
  `EOBINo` text NOT NULL,
  `Bonus` text NOT NULL,
  `CanTakeLoan` text NOT NULL,
  `CanTakeAdvance` text NOT NULL,
  `PayFullSalary` text NOT NULL,
  `SalePersonOutdoorPerson` text NOT NULL,
  `StopSalary` text NOT NULL,
  `EmployeeContribution` int(11) NOT NULL,
  `EmployerContribution` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `OvertimePolicy` int(11) NOT NULL,
  `AttendanceAllowance` text NOT NULL,
  `AttAllAmount` float(11,2) NOT NULL,
  `LateArrivalPolicy` text NOT NULL,
  `EarlyDeparturePolicy` text NOT NULL,
  `ArrivalHalfDay` text NOT NULL,
  `DepartHalfDay` text NOT NULL,
  `AverageWorkingHours` text NOT NULL,
  `WorkingType` text NOT NULL,
  `LeavesDays` text NOT NULL,
  `SandwichLeaves` text NOT NULL,
  `HalfDays` text NOT NULL,
  `Religion` text NOT NULL,
  `Bank` text NOT NULL,
  `AccountTitle` text NOT NULL,
  `AccountNumber` text NOT NULL,
  `LastEducationDegree` text NOT NULL,
  `UniversityCollege` text NOT NULL,
  `EducationCompletionYear` int(11) NOT NULL,
  `GradeMarksPercentage` text NOT NULL,
  `LastTechnicalEducationCertificate` text NOT NULL,
  `UniversityInstitute` text NOT NULL,
  `TechnicalEducationCompletionYear` int(11) NOT NULL,
  `GradePercentageMarks` text NOT NULL,
  `HomeNumber` text DEFAULT NULL,
  `OfficeNumber` text DEFAULT NULL,
  `MobileNumber` text DEFAULT NULL,
  `EmergencyPerson` text DEFAULT NULL,
  `Relationship` text DEFAULT NULL,
  `EmergencyNumber` text DEFAULT NULL,
  `Photo` text DEFAULT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `employeesbackup`;
CREATE TABLE `employeesbackup` (
  `ID` int(11) NOT NULL,
  `EmpID` text DEFAULT NULL,
  `Salutation` text DEFAULT NULL,
  `FirstName` text DEFAULT NULL,
  `LastName` text DEFAULT NULL,
  `FatherName` text DEFAULT NULL,
  `CompanyID` int(11) DEFAULT NULL,
  `Location` int(11) DEFAULT NULL,
  `Designation` text DEFAULT NULL,
  `Department` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `Role` text NOT NULL,
  `EmpType` text DEFAULT NULL,
  `EmpTypeDate` date NOT NULL,
  `Grade` text DEFAULT NULL,
  `Salary` float(11,2) NOT NULL DEFAULT 0.00,
  `GetSalary` text NOT NULL,
  `Supervisor` text DEFAULT NULL,
  `AllowEmpLogin` text NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `EmailAddress` text NOT NULL,
  `PersonalEmailAddress` text NOT NULL,
  `Notifications` text NOT NULL,
  `DOB` date NOT NULL,
  `MaritalStatus` text DEFAULT NULL,
  `Gender` text NOT NULL,
  `BloodGroup` text DEFAULT NULL,
  `Nationality` text NOT NULL,
  `JoiningDate` date NOT NULL,
  `ResignationDate` date NOT NULL,
  `LeavingDate` date DEFAULT NULL,
  `ResignationAccepted` text NOT NULL,
  `ResignationRemarks` text NOT NULL,
  `CNICNumber` text DEFAULT NULL,
  `CNICIssueDate` date NOT NULL,
  `CNICExpiration` date DEFAULT NULL,
  `IqamaNumber` text NOT NULL,
  `PassportNumber` text DEFAULT NULL,
  `PassportIssueDate` date NOT NULL,
  `PassportExpiration` date DEFAULT NULL,
  `DrivingLicenseNumber` text NOT NULL,
  `DrivingLicenseIssueDate` date NOT NULL,
  `DrivingLicenseExpiration` date NOT NULL,
  `VisaIssueDate` date NOT NULL,
  `VisaExpiration` date NOT NULL,
  `NOY` int(11) DEFAULT NULL,
  `NOM` int(11) DEFAULT NULL,
  `LastCompany` text DEFAULT NULL,
  `LastDesignation` text DEFAULT NULL,
  `LastSalary` text DEFAULT NULL,
  `LastWorkingDay` date DEFAULT NULL,
  `IsFirstJob` text NOT NULL,
  `Address` text NOT NULL,
  `MachineID` text NOT NULL,
  `EmploymentType` text NOT NULL,
  `SalaryDisbursmintPeriod` text NOT NULL,
  `SESSINo` text NOT NULL,
  `EOBINo` text NOT NULL,
  `Bonus` text NOT NULL,
  `CanTakeLoan` text NOT NULL,
  `CanTakeAdvance` text NOT NULL,
  `PayFullSalary` text NOT NULL,
  `SalePersonOutdoorPerson` text NOT NULL,
  `StopSalary` text NOT NULL,
  `EmployeeContribution` int(11) NOT NULL,
  `EmployerContribution` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `OvertimePolicy` int(11) NOT NULL,
  `AttendanceAllowance` text NOT NULL,
  `AttAllAmount` float(11,2) NOT NULL,
  `LateArrivalPolicy` text NOT NULL,
  `EarlyDeparturePolicy` text NOT NULL,
  `ArrivalHalfDay` text NOT NULL,
  `DepartHalfDay` text NOT NULL,
  `AverageWorkingHours` text NOT NULL,
  `WorkingType` text NOT NULL,
  `LeavesDays` text NOT NULL,
  `SandwichLeaves` text NOT NULL,
  `HalfDays` text NOT NULL,
  `Religion` text NOT NULL,
  `Bank` text NOT NULL,
  `AccountTitle` text NOT NULL,
  `AccountNumber` text NOT NULL,
  `LastEducationDegree` text NOT NULL,
  `UniversityCollege` text NOT NULL,
  `EducationCompletionYear` int(11) NOT NULL,
  `GradeMarksPercentage` text NOT NULL,
  `LastTechnicalEducationCertificate` text NOT NULL,
  `UniversityInstitute` text NOT NULL,
  `TechnicalEducationCompletionYear` int(11) NOT NULL,
  `GradePercentageMarks` text NOT NULL,
  `HomeNumber` text DEFAULT NULL,
  `OfficeNumber` text DEFAULT NULL,
  `MobileNumber` text DEFAULT NULL,
  `EmergencyPerson` text DEFAULT NULL,
  `Relationship` text DEFAULT NULL,
  `EmergencyNumber` text DEFAULT NULL,
  `Photo` text DEFAULT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `encashment`;
CREATE TABLE `encashment` (
  `ID` int(11) NOT NULL,
  `MonthEncashment` text NOT NULL,
  `EncashmentDate` date NOT NULL,
  `CompanyID` text NOT NULL,
  `Heading` text NOT NULL,
  `Remarks` text NOT NULL,
  `Steps` int(11) NOT NULL DEFAULT 0,
  `Step1ID` int(11) NOT NULL,
  `Step1Date` date NOT NULL,
  `Step2ID` int(11) NOT NULL,
  `Step2Date` date NOT NULL,
  `Step3ID` int(11) NOT NULL,
  `Step3Date` date NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `encashmentdetails`;
CREATE TABLE `encashmentdetails` (
  `ID` bigint(20) NOT NULL,
  `EncashmentID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `TotalDays` int(11) NOT NULL,
  `JoiningDate` date NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `LoanBalance` float(11,2) NOT NULL,
  `BonusAmount` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `Remarks` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text NOT NULL,
  `StartTime` text NOT NULL,
  `EndTime` text NOT NULL,
  `Color` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `externalusers`;
CREATE TABLE `externalusers` (
  `ID` int(11) NOT NULL,
  `Role` text NOT NULL,
  `Rights` text NOT NULL,
  `Companies` text NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `JoiningDate` date NOT NULL,
  `EmpID` text NOT NULL,
  `Status` text NOT NULL,
  `Photo` text DEFAULT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `fullnfinal`;
CREATE TABLE `fullnfinal` (
  `ID` bigint(20) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `PreviousSalary` float(11,2) NOT NULL,
  `RemainingLoan` float(11,2) NOT NULL,
  `GrandNetPay` float(11,2) NOT NULL,
  `MonthPayroll` text NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `AllowanceBreakup` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Present` int(11) NOT NULL,
  `Lates` int(11) NOT NULL,
  `Earlies` int(11) NOT NULL,
  `LEDeductions` float(11,1) NOT NULL DEFAULT 0.0,
  `HalfDays` int(11) NOT NULL,
  `OffDays` int(11) NOT NULL,
  `Leaves` int(11) NOT NULL,
  `Absent` int(11) NOT NULL,
  `TotalDays` float(11,1) NOT NULL,
  `GrossOfDays` float(11,2) NOT NULL,
  `WOvertimeH` int(11) NOT NULL,
  `WOvertimeA` float(11,2) NOT NULL,
  `LOvertimeH` int(11) NOT NULL,
  `LOvertimeA` float(11,2) NOT NULL,
  `OvertimeHolidayDays` int(11) NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `IncomeTax` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `PayFullSalary` text NOT NULL,
  `StopSalary` text NOT NULL,
  `Resignation` text NOT NULL,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `LeaveOpening` float(11,1) DEFAULT 0.0,
  `LeaveGrant` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveUtilize` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveWriteoff` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveBalance` float(11,1) NOT NULL DEFAULT 0.0,
  `Remarks` text NOT NULL,
  `SpecialRemarks` text NOT NULL,
  `Title1` text NOT NULL,
  `Title1check` tinyint(1) NOT NULL DEFAULT 0,
  `Title1amount` float(11,2) NOT NULL,
  `Title2` text NOT NULL,
  `Title2check` tinyint(1) NOT NULL DEFAULT 0,
  `Title2amount` float(11,2) NOT NULL,
  `Title3` text NOT NULL,
  `Title3check` tinyint(1) NOT NULL DEFAULT 0,
  `Title3amount` float(11,2) NOT NULL,
  `Title4` text NOT NULL,
  `Title4check` tinyint(1) NOT NULL DEFAULT 0,
  `Title4amount` float(11,2) NOT NULL,
  `Title5` text NOT NULL,
  `Title5check` tinyint(1) NOT NULL DEFAULT 0,
  `Title5amount` float(11,2) NOT NULL,
  `Title6` text NOT NULL,
  `Title6check` tinyint(1) NOT NULL DEFAULT 0,
  `Title6amount` float(11,2) NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `gazetted_holidays`;
CREATE TABLE `gazetted_holidays` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `ID` int(11) NOT NULL,
  `Grade` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `grades` (`ID`, `Grade`, `Status`, `DateAdded`, `DateModified`) VALUES
(3, 'Manager', 1, '2015-11-12 17:46:33', '0000-00-00 00:00:00'),
(4, 'AVP', 1, '2015-11-12 17:46:40', '0000-00-00 00:00:00'),
(6, 'SVP', 1, '2015-11-12 17:54:12', '0000-00-00 00:00:00'),
(7, 'VP', 1, '2020-08-04 19:42:03', '0000-00-00 00:00:00'),
(8, 'BU Manager', 1, '2020-08-04 19:43:46', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `grant_leaves_quota`;
CREATE TABLE `grant_leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LeaveType` text NOT NULL,
  `LeaveDate` date NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `Reason` text NOT NULL,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `grossupdate`;
CREATE TABLE `grossupdate` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Basic` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `grossupdate2`;
CREATE TABLE `grossupdate2` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Basic` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `increments`;
CREATE TABLE `increments` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Date` date NOT NULL,
  `EffectiveDate` date NOT NULL,
  `ArrearMonths` int(11) NOT NULL,
  `ArrearAmount` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `individual_bonuses`;
CREATE TABLE `individual_bonuses` (
  `ID` int(11) NOT NULL,
  `EmpID` text NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `institutes`;
CREATE TABLE `institutes` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `interviews`;
CREATE TABLE `interviews` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text NOT NULL,
  `StartTime` text NOT NULL,
  `EndTime` text NOT NULL,
  `Color` text NOT NULL,
  `Post` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Candidates` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `jobposts`;
CREATE TABLE `jobposts` (
  `ID` int(11) NOT NULL,
  `PostName` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `kpi`;
CREATE TABLE `kpi` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `WS` float(11,3) NOT NULL DEFAULT 0.000,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `leaveadjust_requests`;
CREATE TABLE `leaveadjust_requests` (
  `ID` int(11) NOT NULL,
  `Type` text NOT NULL,
  `Date` date NOT NULL,
  `Adjust` text NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `RosterID` int(11) NOT NULL,
  `NotificationTo` text NOT NULL,
  `Reason` text NOT NULL,
  `DisapproveReason` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `leaves_quota`;
CREATE TABLE `leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `AnualLeaves` int(11) NOT NULL,
  `SickLeaves` int(11) NOT NULL,
  `CasualLeaves` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `leaves_quota2`;
CREATE TABLE `leaves_quota2` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `AnualLeaves` int(11) NOT NULL,
  `SickLeaves` int(11) NOT NULL,
  `CasualLeaves` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `leave_approvals`;
CREATE TABLE `leave_approvals` (
  `ID` int(11) NOT NULL,
  `Type` text NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `FromDate` text NOT NULL,
  `ToDate` text NOT NULL,
  `Approval` tinyint(1) NOT NULL DEFAULT 0,
  `Sender` int(11) NOT NULL,
  `ApproveBy` text NOT NULL,
  `Reason` text NOT NULL,
  `DisapprovedRemarks` text NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loans`;
CREATE TABLE `loans` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanReqID` int(11) NOT NULL DEFAULT 0,
  `Code` text NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `DuductionType` text NOT NULL,
  `LoanType` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentMonths` int(11) NOT NULL,
  `RepaymentAmount` float(11,2) NOT NULL,
  `DisbursementDate` date NOT NULL,
  `RepaymentDate` date NOT NULL,
  `RemainingAmount` float(11,2) NOT NULL,
  `RemainingMonths` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `IsCompleted` tinyint(1) NOT NULL DEFAULT 0,
  `Reason` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL,
  `DateCompleted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loans_manualrecovery`;
CREATE TABLE `loans_manualrecovery` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `PaymentType` tinyint(1) DEFAULT NULL,
  `Reason` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `PaymentDate` date NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loans_schedule`;
CREATE TABLE `loans_schedule` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loans_schedule_copy`;
CREATE TABLE `loans_schedule_copy` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loans_schedule_copy2`;
CREATE TABLE `loans_schedule_copy2` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `ApprovedBy` int(11) NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `loantypes`;
CREATE TABLE `loantypes` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `loantypes` (`ID`, `Name`, `Status`, `DateAdded`, `DateModified`) VALUES
(2, 'Staff Loan', 1, '2020-01-02 14:27:39', '2020-01-26 20:08:21'),
(3, 'Vehicle Loan', 0, '2020-01-02 14:27:47', '2020-01-31 22:17:38');

DROP TABLE IF EXISTS `loan_requests`;
CREATE TABLE `loan_requests` (
  `ID` int(11) NOT NULL,
  `Code` text NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `NotificationTo` text NOT NULL,
  `DuductionType` text NOT NULL,
  `LoanType` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `ActualAmount` float(11,2) NOT NULL,
  `RepaymentAmount` float(11,2) NOT NULL,
  `RepaymentDate` date NOT NULL,
  `Reason` text NOT NULL,
  `DisapproveReason` text NOT NULL,
  `LoanGranted` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `locations` (`ID`, `Name`, `CompanyID`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Head Office', 2, 1, '2015-12-17 00:00:00', '2020-01-31 22:15:05');

DROP TABLE IF EXISTS `machines`;
CREATE TABLE `machines` (
  `ID` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = In and 1 = Out',
  `IPAdress` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int(11) UNSIGNED NOT NULL,
  `from_id` varchar(40) NOT NULL DEFAULT '',
  `to_id` varchar(50) NOT NULL DEFAULT '',
  `from_uname` varchar(225) NOT NULL DEFAULT '',
  `to_uname` varchar(255) NOT NULL DEFAULT '',
  `message_content` longtext NOT NULL,
  `message_date` datetime NOT NULL,
  `recd` tinyint(1) NOT NULL DEFAULT 0,
  `seen` enum('0','1') NOT NULL DEFAULT '0',
  `message_type` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `messages2`;
CREATE TABLE `messages2` (
  `ID` int(11) NOT NULL,
  `Sender` int(11) NOT NULL,
  `Receivers` text NOT NULL,
  `Subject` text NOT NULL,
  `Contents` text NOT NULL,
  `ReceivedBy` int(11) NOT NULL,
  `IsCheck` tinyint(1) NOT NULL DEFAULT 0,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `minus_leaves_quota`;
CREATE TABLE `minus_leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LeaveType` text NOT NULL,
  `Qty` float(11,1) NOT NULL DEFAULT 1.0,
  `FromRoster` int(11) NOT NULL DEFAULT 0,
  `LeaveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `minus_leaves_quota_payroll`;
CREATE TABLE `minus_leaves_quota_payroll` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LeaveType` text NOT NULL,
  `LeaveQty` float(11,1) NOT NULL,
  `PayID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg` (
  `id` int(100) NOT NULL,
  `to` text NOT NULL,
  `from` text NOT NULL,
  `msg` text NOT NULL,
  `status` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `author` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `page_url` text NOT NULL,
  `image_url` text NOT NULL,
  `publishedAt` text NOT NULL,
  `News_type` enum('techcrunch','nytimes','abcnews','mashable') DEFAULT NULL,
  `fetchtime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news` (`ID`, `author`, `title`, `description`, `page_url`, `image_url`, `publishedAt`, `News_type`, `fetchtime`) VALUES
(27661, 'Sasha Lekach', 'How to make iPhone\'s Screen Time actually helpful', 'Maybe this year we\'ll actually spend less time staring at a phone screen.', 'https://mashable.com/article/screen-time-ios-iphone-wwdc-2019-improve/', 'https://mondrian.mashable.com/2019%252F05%252F29%252F2b%252Fc28429efe72d4cd6ae4e1f36a6d5bcb6.7e8a8.jpg%252F1200x630.jpg?signature=_KJ1rjuTpolkLOy9GFR88GbTg80=', '2019-05-29T15:00:00Z', 'mashable', '2020-09-25 17:00:01'),
(27662, 'Marcus Gilmer', 'AOC opens up about death threats after baseball team shows offensive video of her', '\'Words matter, and can have consequences for safety.\'', 'https://mashable.com/article/aoc-fresno-grizzlies-video-castro-kim-jon-un-death-threats/', 'https://mondrian.mashable.com/2019%252F05%252F29%252F4b%252Fe87b5ba10314494b8f529c9f05407c4c.4c53f.png%252F1200x630.png?signature=YzkiA_GKka3YNKLqxb6fvKifNKo=', '2019-05-29T14:51:29Z', 'mashable', '2020-09-25 17:00:01'),
(27663, 'Sasha Lekach', 'Uber will now kick off riders with low ratings', 'Drivers can get deactivated, and now so can you.', 'https://mashable.com/article/uber-us-canada-rider-ratings-deactivation/', 'https://mondrian.mashable.com/2019%252F05%252F29%252F62%252F019202836dda42f9a508830e94ef2f41.cd2aa.jpg%252F1200x630.jpg?signature=GVUvqiudwXUBp1yp9WeEcM9FwOk=', '2019-05-29T14:00:00Z', 'mashable', '2020-09-25 17:00:01'),
(66850, 'Lucas Matney', 'Google shutting down Poly 3D content platform', 'Google is almost running out of AR/VR projects to kill off. The company announced today in an email to Poly users that they will be shutting 3D-object creation and library platform â€œforeverâ€ next year. The service will shut down on June 30, 2021 and users wonâ€¦', 'https://techcrunch.com/2020/12/02/google-shutting-down-poly-3d-content-platform/', 'https://techcrunch.com/wp-content/uploads/2020/12/Screen-Shot-2020-12-02-at-3.40.15-PM.jpg?w=657', '2020-12-02T23:54:05Z', 'techcrunch', '2020-12-03 00:40:02'),
(66851, 'Sarah Perez', 'Hulu officially launches its co-viewing feature Watch Party', 'Huluâ€™s social viewing feature, Watch Party, has now launched to all on-demand subscribers, the company announced today. The co-viewing feature was first introduced during the earlier days of the pandemic in 2020, allowing Hulu users to watch shows together frâ€¦', 'https://techcrunch.com/2020/12/02/hulu-officially-launches-its-co-viewing-feature-watch-party/', 'https://techcrunch.com/wp-content/uploads/2020/05/Screen-Shot-2020-05-28-at-11.48.52-AM.png?w=679', '2020-12-02T23:17:13Z', 'techcrunch', '2020-12-03 00:40:02'),
(66852, 'Alex Wilhelm, Ron Miller', 'Salesforce slumps 8.5% as its post-Slack selloff continues', 'Shares of Salesforce traded lower today, despite the company hosting a multi-hour keynote that included a buffet of Marc Benioff. Whatâ€™s going on? Essentially, since the Salesforce-Slack deal reached the ears of the public, shares of the CRM giant have fallenâ€¦', 'https://techcrunch.com/2020/12/02/salesforce-slumps-8-5-as-its-post-slack-selloff-continues/', 'https://techcrunch.com/wp-content/uploads/2020/06/IMG_3027.jpg?w=533', '2020-12-02T23:16:29Z', 'techcrunch', '2020-12-03 00:40:02'),
(66853, 'Melanie Groves', 'Backyard chooks popular during COVID-19 lockdown, but where do they come from?', 'Meet the couple who have been scrambling throughout this year to keep up with your iso chicken and egg needs.', 'http://www.abc.net.au/news/rural/2020-12-03/backyard-hens-popular-during-lockdown-had-to-come-from-somewhere/12938338', 'https://www.abc.net.au/cm/rimage/12942854-16x9-large.jpg?v=2', '2020-12-02T23:46:48Z', 'abcnews', '2020-12-03 00:40:02'),
(66854, 'Matthew Doran', 'Tasmanian Liberal MP speaks out against Government\'s cashless welfare scheme', 'A Federal Liberal backbencher has hit out at the Coalition\'s plan to make a controversial scheme a permanent fixture of Australia\'s social welfare framework, labelling it as \"punitive\" and arguing her community could never support it.', 'http://www.abc.net.au/news/2020-12-03/cashless-welfare-card-liberal-vote/12945704', 'https://www.abc.net.au/cm/rimage/10876706-16x9-large.jpg?v=3', '2020-12-02T23:44:05Z', 'abcnews', '2020-12-03 00:40:02'),
(66855, 'Olivia Willis', 'Failure to tackle health impacts of climate change putting lives at risk, major report warns', 'The Federal Government\'s failure to address the growing health impacts of climate change is putting Australian lives at risk, a major new report warns.', 'http://www.abc.net.au/news/health/2020-12-03/health-climate-change-bushfires-black-summer-report-lancet/12942978', 'https://www.abc.net.au/cm/rimage/12943460-16x9-large.jpg?v=2', '2020-12-02T23:42:56Z', 'abcnews', '2020-12-03 00:40:02'),
(66856, 'By Peter Baker', 'Trump Hints at Another Act in Four Years, Just Like Grover Cleveland', 'The president is eying a comeback in 2024 aimed at making him the only person other than Cleveland to win another term after losing the White House.', 'https://www.nytimes.com/2020/12/02/us/politics/trump-2024.html', 'https://static01.nyt.com/images/2020/12/02/us/politics/02dc-trump-1/merlin_180657060_c0d7940c-26ba-4bee-8794-df5d17472265-superJumbo.jpg', '2020-12-02T19:37:55-05:00', 'nytimes', '2020-12-03 00:40:03'),
(66857, 'By Emily Cochrane and Jim Tankersley', 'Top Democrats Back Compromise Plan to Revive Stimulus Talks', 'The Democratic leaders in Congress endorsed a $908 billion plan put forth by moderates in both parties, offering a significant concession in efforts to jump-start negotiations.', 'https://www.nytimes.com/2020/12/02/us/politics/coronavirus-stimulus-talks-congress.html', 'https://static01.nyt.com/images/2020/12/02/us/politics/02dc-cong-1/merlin_180730281_75e0d962-c123-437b-8eef-cb8b5d06a498-superJumbo.jpg', '2020-12-02T19:28:38-05:00', 'nytimes', '2020-12-03 00:40:03'),
(66858, 'By Richard Fausset', 'Georgia Republicans Seek Cover From Trumpâ€™s Fury Over Loss', 'Many in the state G.O.P. are expending significant effort â€” and contorting themselves into political pretzels â€” to navigate the presidentâ€™s outrage over his loss, hoping to retain the support of his base.', 'https://www.nytimes.com/2020/12/02/us/politics/georgia-republicans-election-trump.html', 'https://static01.nyt.com/images/2020/12/02/us/politics/02georgia-repubs1/merlin_180407805_b63591e1-adc4-44f6-82c6-df9060f6d0c6-superJumbo.jpg', '2020-12-02T19:25:46-05:00', 'nytimes', '2020-12-03 00:40:03');

DROP TABLE IF EXISTS `news2`;
CREATE TABLE `news2` (
  `ID` int(11) NOT NULL,
  `author` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `page_url` text NOT NULL,
  `image_url` text NOT NULL,
  `publishedAt` text NOT NULL,
  `News_type` enum('techcrunch','nytimes','abcnews') DEFAULT NULL,
  `fetchtime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news2` (`ID`, `author`, `title`, `description`, `page_url`, `image_url`, `publishedAt`, `News_type`, `fetchtime`) VALUES
(4, 'By New York Times', 'California Fires Live Updates: Blazes Burn Through 500,000 Acres', 'Northern California faces another day under siege, with the huge blazes ripping across the region still growing and still almost completely uncontained.', 'https://www.nytimes.com/2020/08/21/us/ca-fires.html', 'https://static01.nyt.com/images/2020/08/21/us/21fires-briefing01/merlin_175974189_55e6128a-4612-406e-99b8-3f6893540ca7-superJumbo.jpg', '2020-08-21T09:36:01-04:00', 'nytimes', '2020-08-21 01:12:10'),
(5, 'By Audra D. S. Burch, Jennifer Medina and Evan Nicole Brown', '‘Finally the Country Sees Us’: Some Women of Color Cheer Harris’s Rise', 'In Kamala Harris, many women of color see a successful vice-presidential candidate standing atop a mountain of firsts — but also facing a gender and racial minefield.', 'https://www.nytimes.com/2020/08/19/us/kamala-harris-women-voters.html', 'https://static01.nyt.com/images/2020/08/19/us/politics/19harris-women1/merlin_175867791_53c490c3-d59b-464a-8953-5ff49a8a7190-superJumbo.jpg', '2020-08-19T03:00:10-04:00', 'nytimes', '2020-08-21 01:12:10'),
(6, 'By Patricia Mazzei and Manny Fernandez', '‘All In, All the Time’: Reopening Florida Schools Is Likened to Military Operation', 'Gov. Ron DeSantis, faced with reluctance by local schools to reopen during the coronavirus pandemic, compared it to the campaign to get Osama bin Laden.', 'https://www.nytimes.com/2020/08/19/us/coronavirus-schools-florida-local-control.html', 'https://static01.nyt.com/images/2020/08/18/us/00VIRUS-HOTSPOTSCHOOLS-classroom/merlin_175846017_71c53e42-b50f-4520-87e3-b3153aff10fa-superJumbo.jpg', '2020-08-19T05:00:25-04:00', 'nytimes', '2020-08-21 01:12:10'),
(7, 'Emily Olson, Peter Marsh', 'Democratic National Convention live updates: Joe Biden to deliver acceptance speech on final night', 'Donald Trump hits out at Joe Biden just hours before the former vice-president is due to speak live on the final night of the Democratic National Convention. Follow live.', 'http://www.abc.net.au/news/2020-08-21/democratic-national-convention-live-coverage-joe-biden-speech/12565894', 'https://www.abc.net.au/cm/rimage/12565964-16x9-large.jpg?v=2', '2020-08-20T23:36:36Z', 'abcnews', '2020-08-21 01:15:53'),
(8, 'ABC News', 'Victoria\'s coronavirus cases rise by 179 as state reports nine further COVID-19 deaths', 'Victoria records 179 new coronavirus cases and nine further deaths. It is the lowest daily number of new cases reported in the state since July 13.', 'http://www.abc.net.au/news/2020-08-21/victoria-coronavirus-update-179-new-cases-9-covid-19-deaths/12581616', 'https://www.abc.net.au/cm/rimage/12450392-16x9-large.jpg?v=2', '2020-08-20T23:03:41Z', 'abcnews', '2020-08-21 01:15:53'),
(9, 'ABC News', 'Eddie Woo, maths teacher and YouTube sensation, discusses teaching in a coronavirus pandemic with Kurt Fearnley on One Plus One', 'The teacher and YouTube star says the COVID-19 pandemic has given him a whole new appreciation for his fellow teachers.', 'http://www.abc.net.au/news/2020-08-21/one-plus-one-eddie-woo-homeschooling/12578726', 'https://www.abc.net.au/cm/rimage/8480412-16x9-large.jpg?v=3', '2020-08-20T23:03:41Z', 'abcnews', '2020-08-21 01:15:53'),
(10, 'Greg Kumparak', 'Gather helps teams streamline things like onboarding, offboarding, and parental leave over Slack', 'Adding a new employee to a team tends to involve more than saying â€œYouâ€™re hired!â€ and tossing them into the company Slack. Youâ€™ve got to get them trained, ship them any hardware they might need, get them setup on all of your internal tools, and check in regulâ€¦', 'https://techcrunch.com/2020/08/21/gather-helps-teams-streamline-things-like-onboarding-offboarding-and-parental-leave-over-slack/', 'https://techcrunch.com/wp-content/uploads/2020/08/gather-header.png?w=596', '2020-08-21T22:25:17Z', 'techcrunch', '2020-08-21 23:28:52'),
(11, 'Anthony Ha', 'Daily Crunch: Palantir docs show $579M net loss', 'We dive into Palantirâ€™s finances, Apple fires back against Epic Games and Lambda School raises funding. This is your Daily Crunch for August 21, 2020. The big story: Palantir docs show $579M net loss Danny Crichton got a hold of the confidential S-1 filing foâ€¦', 'https://techcrunch.com/2020/08/21/daily-crunch-palantir-s-1/', 'https://techcrunch.com/wp-content/uploads/2019/05/palantir.jpg?w=750', '2020-08-21T22:10:09Z', 'techcrunch', '2020-08-21 23:28:52'),
(12, 'Danny Crichton', 'Palantir targeting 3 class voting structure according to leaked S-1, giving founders 49.999999% control in perpetuity', 'We are continuing to make progress through Palantirâ€™s leaked S-1 filing, which TechCrunch attained a copy of recently. We have covered the companyâ€™s financials this morning, and this afternoon we talked about the companyâ€™s customer concentration. Now I want tâ€¦', 'https://techcrunch.com/2020/08/21/palantir-three-class-voting/', 'https://techcrunch.com/wp-content/uploads/2020/08/GettyImages-1183198457.jpg?w=600', '2020-08-21T21:21:27Z', 'techcrunch', '2020-08-21 23:28:52');

DROP TABLE IF EXISTS `organization_settings`;
CREATE TABLE `organization_settings` (
  `ID` int(11) NOT NULL,
  `UpdatedBy` int(11) NOT NULL,
  `UpdatedTime` datetime NOT NULL,
  `CompanyName` text NOT NULL,
  `Tax` text NOT NULL,
  `BonusType` text NOT NULL,
  `ProvidentFund` text NOT NULL,
  `PerDayHours` int(11) NOT NULL,
  `GraceTime` text NOT NULL,
  `YearStartFrom` int(11) NOT NULL,
  `DeductionOnLates` text NOT NULL,
  `NumOfLates` int(11) NOT NULL,
  `LateDeductAmount` text NOT NULL,
  `WorkingDays` text NOT NULL,
  `RefreshQuota` text NOT NULL,
  `CurrencySymbol` text NOT NULL,
  `PassingPercentage` int(11) NOT NULL,
  `NumOfAttempts` int(11) NOT NULL,
  `InterviewPercentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `organization_settings` (`ID`, `UpdatedBy`, `UpdatedTime`, `CompanyName`, `Tax`, `BonusType`, `ProvidentFund`, `PerDayHours`, `GraceTime`, `YearStartFrom`, `DeductionOnLates`, `NumOfLates`, `LateDeductAmount`, `WorkingDays`, `RefreshQuota`, `CurrencySymbol`, `PassingPercentage`, `NumOfAttempts`, `InterviewPercentage`) VALUES
(1, 1077, '2016-09-19 12:06:51', 'CIM Shipping Inc', 'No', 'Individual', 'No', 9, '09:15:00', 1, 'Yes', 3, 'Deduct From Oneday Salary', '1,2,3,4,5', 'Clear Previous', 'Rs:', 50, 3, 60);

DROP TABLE IF EXISTS `overtimes`;
CREATE TABLE `overtimes` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Hours` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `overtime_policies`;
CREATE TABLE `overtime_policies` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `ApplyAfter` int(11) NOT NULL DEFAULT 0,
  `CompanyID` int(11) NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL,
  `OTHourType` text NOT NULL,
  `OTHourBase` text NOT NULL,
  `OTHourValue` int(11) NOT NULL,
  `OTHolidayType` text NOT NULL,
  `OTHolidayBase` text NOT NULL,
  `OTHolidayValue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `overtime_policies` (`ID`, `Name`, `ApplyAfter`, `CompanyID`, `Status`, `DateAdded`, `DateModified`, `OTHourType`, `OTHourBase`, `OTHourValue`, `OTHolidayType`, `OTHolidayBase`, `OTHolidayValue`) VALUES
(1, 'NO Policy', 30, 0, 1, '2016-01-04 17:15:57', '2020-01-31 22:16:53', 'Percentage', 'Gross Per Hour', 100, 'Percentage', 'Gross Per Day', 200);

DROP TABLE IF EXISTS `paid_leaves_quota`;
CREATE TABLE `paid_leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Leaves` int(11) NOT NULL,
  `MonthYear` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE `payroll` (
  `ID` int(11) NOT NULL,
  `MonthPayroll` text NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `CompanyID` text NOT NULL,
  `Remarks` text NOT NULL,
  `Steps` int(11) NOT NULL DEFAULT 0,
  `Step1ID` int(11) NOT NULL,
  `Step1Date` datetime NOT NULL,
  `Step2ID` int(11) NOT NULL,
  `Step2Date` datetime NOT NULL,
  `Step3ID` int(11) NOT NULL,
  `Step3Date` datetime NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolladvancedetails`;
CREATE TABLE `payrolladvancedetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `AdvID` int(11) NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrollallowancedetails`;
CREATE TABLE `payrollallowancedetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Type` text NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrollcontributiondetails`;
CREATE TABLE `payrollcontributiondetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Type` text NOT NULL,
  `EmployeeContribution` float(11,2) NOT NULL,
  `EmployerContribution` float(11,2) NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolldeductiondetails`;
CREATE TABLE `payrolldeductiondetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Type` text NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolldetails`;
CREATE TABLE `payrolldetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Location` int(11) NOT NULL,
  `Designation` text NOT NULL,
  `Department` text NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `AllowanceBreakup` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Present` int(11) NOT NULL,
  `Lates` int(11) NOT NULL,
  `Earlies` int(11) NOT NULL,
  `LEDeductions` float(11,1) NOT NULL DEFAULT 0.0,
  `HalfDays` int(11) NOT NULL,
  `OffDays` int(11) NOT NULL,
  `Leaves` int(11) NOT NULL,
  `Absent` int(11) NOT NULL,
  `TotalDays` float(11,1) NOT NULL,
  `GrossOfDays` float(11,2) NOT NULL,
  `WOvertimeH` int(11) NOT NULL,
  `WOvertimeA` float(11,2) NOT NULL,
  `LOvertimeH` int(11) NOT NULL,
  `LOvertimeA` float(11,2) NOT NULL,
  `OvertimeHolidayDays` int(11) NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `IncomeTax` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `PayFullSalary` text NOT NULL,
  `StopSalary` text NOT NULL,
  `Resignation` text NOT NULL,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `LeaveOpening` float(11,1) DEFAULT 0.0,
  `LeaveGrant` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveUtilize` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveWriteoff` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveBalance` float(11,1) NOT NULL DEFAULT 0.0,
  `Remarks` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolldetailsbackup`;
CREATE TABLE `payrolldetailsbackup` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Location` int(11) NOT NULL,
  `Designation` text NOT NULL,
  `Department` text NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `AllowanceBreakup` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Present` int(11) NOT NULL,
  `Lates` int(11) NOT NULL,
  `Earlies` int(11) NOT NULL,
  `LEDeductions` float(11,1) NOT NULL DEFAULT 0.0,
  `HalfDays` int(11) NOT NULL,
  `OffDays` int(11) NOT NULL,
  `Leaves` int(11) NOT NULL,
  `Absent` int(11) NOT NULL,
  `TotalDays` float(11,1) NOT NULL,
  `GrossOfDays` float(11,2) NOT NULL,
  `WOvertimeH` int(11) NOT NULL,
  `WOvertimeA` float(11,2) NOT NULL,
  `LOvertimeH` int(11) NOT NULL,
  `LOvertimeA` float(11,2) NOT NULL,
  `OvertimeHolidayDays` int(11) NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `IncomeTax` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `PayFullSalary` text NOT NULL,
  `StopSalary` text NOT NULL,
  `Resignation` text NOT NULL,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `LeaveOpening` float(11,1) DEFAULT 0.0,
  `LeaveGrant` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveUtilize` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveWriteoff` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveBalance` float(11,1) NOT NULL DEFAULT 0.0,
  `Remarks` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolldetailscopy`;
CREATE TABLE `payrolldetailscopy` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Basic` float(11,2) NOT NULL,
  `AllowanceBreakup` float(11,2) NOT NULL,
  `Gross` float(11,2) NOT NULL,
  `Present` int(11) NOT NULL,
  `Lates` int(11) NOT NULL,
  `Earlies` int(11) NOT NULL,
  `LEDeductions` float(11,1) NOT NULL DEFAULT 0.0,
  `HalfDays` int(11) NOT NULL,
  `OffDays` int(11) NOT NULL,
  `Leaves` int(11) NOT NULL,
  `Absent` int(11) NOT NULL,
  `TotalDays` float(11,1) NOT NULL,
  `GrossOfDays` float(11,2) NOT NULL,
  `WOvertimeH` int(11) NOT NULL,
  `WOvertimeA` float(11,2) NOT NULL,
  `LOvertimeH` int(11) NOT NULL,
  `LOvertimeA` float(11,2) NOT NULL,
  `OvertimeHolidayDays` int(11) NOT NULL,
  `OtherAllowances` float(11,2) NOT NULL,
  `OtherDeductions` float(11,2) NOT NULL,
  `IncomeTax` float(11,2) NOT NULL,
  `NetPay` float(11,2) NOT NULL DEFAULT 0.00,
  `PayFullSalary` text NOT NULL,
  `StopSalary` text NOT NULL,
  `Resignation` text NOT NULL,
  `BankorCash` text NOT NULL,
  `AccountNum` text NOT NULL,
  `LeaveOpening` float(11,1) DEFAULT 0.0,
  `LeaveGrant` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveUtilize` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveWriteoff` float(11,1) NOT NULL DEFAULT 0.0,
  `LeaveBalance` float(11,1) NOT NULL DEFAULT 0.0,
  `Remarks` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrollloandetails`;
CREATE TABLE `payrollloandetails` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LoanID` int(11) NOT NULL,
  `LoanScheduleID` int(11) NOT NULL,
  `Type` text NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrollold`;
CREATE TABLE `payrollold` (
  `ID` int(11) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedTime` datetime NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Month` varchar(30) NOT NULL,
  `Year` varchar(30) NOT NULL,
  `BasicSalary` float(11,2) NOT NULL,
  `TotalAmount` float(11,2) NOT NULL,
  `Loans` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `payrolltaxes`;
CREATE TABLE `payrolltaxes` (
  `ID` bigint(20) NOT NULL,
  `PayID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Amount` float(11,1) NOT NULL DEFAULT 0.0,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `provident_funds`;
CREATE TABLE `provident_funds` (
  `ID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Type` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `Question` text NOT NULL,
  `AnswerType` text NOT NULL,
  `AnswerID` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes` (
  `ID` int(11) NOT NULL,
  `Quote` text DEFAULT NULL,
  `Author` text DEFAULT NULL,
  `Quote_type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `quotes` (`ID`, `Quote`, `Author`, `Quote_type`) VALUES
(1, 'Genius is one percent inspiration and ninety-nine percent perspiration.', 'Thomas Edison', '1'),
(2, 'You can observe a lot just by watching.', 'Yogi Berra', '1'),
(3, 'A house divided against itself cannot stand.', 'Abraham Lincoln', '1'),
(4, 'Difficulties increase the nearer we get to the goal.', 'Johann Wolfgang von Goethe', '1'),
(5, 'Fate is in your hands and no one elses', 'Byron Pulsifer', '1'),
(6, 'Be the chief but never the lord.', 'Lao Tzu', '1'),
(7, 'Nothing happens unless first we dream.', 'Carl Sandburg', '1'),
(8, 'Well begun is half done.', 'Aristotle', '1'),
(9, 'Life is a learning experience, only if you learn.', 'Yogi Berra', '1'),
(10, 'Self-complacency is fatal to progress.', 'Margaret Sangster', '1'),
(11, 'Peace comes from within. Do not seek it without.', 'Buddha', '1'),
(12, 'What you give is what you get.', 'Byron Pulsifer', '1'),
(13, 'We can only learn to love by loving.', 'Iris Murdoch', '1'),
(14, 'Life is change. Growth is optional. Choose wisely.', 'Karen Clark', '1'),
(15, 'You\'ll see it when you believe it.', 'Wayne Dyer', '1'),
(16, 'Today is the tomorrow we worried about yesterday.', 'Anonymous', '1'),
(17, 'It\'s easier to see the mistakes on someone else\'s paper.', 'Anonymous', '1'),
(18, 'Every man dies. Not every man really lives.', 'Anonymous', '1'),
(19, 'To lead people walk behind them.', 'Lao Tzu', '1'),
(20, 'Having nothing, nothing can he lose.', 'William Shakespeare', '1'),
(21, 'Trouble is only opportunity in work clothes.', 'Henry J. Kaiser', '1'),
(22, 'A rolling stone gathers no moss.', 'Publilius Syrus', '1'),
(23, 'Ideas are the beginning points of all fortunes.', 'Napoleon Hill', '1'),
(24, 'Everything in life is luck.', 'Donald Trump', '1'),
(25, 'Doing nothing is better than being busy doing nothing.', 'Lao Tzu', '1'),
(26, 'Trust yourself. You know more than you think you do.', 'Benjamin Spock', '1'),
(27, 'Study the past, if you would divine the future.', 'Confucius', '1'),
(28, 'The day is already blessed, find peace within it.', 'Anonymous', '1'),
(29, 'From error to error one discovers the entire truth.', 'Sigmund Freud', '1'),
(30, 'Well done is better than well said.', 'Benjamin Franklin', '1'),
(31, 'Bite off more than you can chew, then chew it.', 'Ella Williams', '1'),
(32, 'Work out your own salvation. Do not depend on others.', 'Buddha', '1'),
(33, 'One today is worth two tomorrows.', 'Benjamin Franklin', '1'),
(34, 'Once you choose hope, anythings possible.', 'Christopher Reeve', '1'),
(35, 'God always takes the simplest way.', 'Albert Einstein', '1'),
(36, 'One fails forward toward success.', 'Charles Kettering', '1'),
(37, 'From small beginnings come great things.', 'Anonymous', '1'),
(38, 'Learning is a treasure that will follow its owner everywhere', 'Chinese proverb', '1'),
(39, 'Be as you wish to seem.', 'Socrates', '1'),
(40, 'The world is always in movement.', 'V. Naipaul', '1'),
(41, 'Never mistake activity for achievement.', 'John Wooden', '1'),
(42, 'What worries you masters you.', 'Haddon Robinson', '1'),
(43, 'One faces the future with ones past.', 'Pearl Buck', '1'),
(44, 'Goals are the fuel in the furnace of achievement.', 'Brian Tracy', '1'),
(45, 'Who sows virtue reaps honour.', 'Leonardo da Vinci', '1'),
(46, 'Be kind whenever possible. It is always possible.', 'Dalai Lama', '1'),
(47, 'Talk doesn\'t cook rice.', 'Chinese proverb', '1'),
(48, 'He is able who thinks he is able.', 'Buddha', '1'),
(49, 'A goal without a plan is just a wish.', 'Larry Elder', '1'),
(50, 'To succeed, we must first believe that we can.', 'Michael Korda', '1'),
(51, 'Learn from yesterday, live for today, hope for tomorrow.', 'Albert Einstein', '1'),
(52, 'A weed is no more than a flower in disguise.', 'James Lowell', '1'),
(53, 'Do, or do not. There is no try.', 'Yoda', '1'),
(54, 'All serious daring starts from within.', 'Harriet Beecher Stowe', '1'),
(55, 'The best teacher is experience learned from failures.', 'Byron Pulsifer', '1'),
(56, 'Think how hard physics would be if particles could think.', 'Murray Gell-Mann', '1'),
(57, 'Love is the flower you\'ve got to let grow.', 'John Lennon', '1'),
(58, 'Don\'t wait. The time will never be just right.', 'Napoleon Hill', '1'),
(59, 'Time is the wisest counsellor of all.', 'Pericles', '1'),
(60, 'You give before you get.', 'Napoleon Hill', '1'),
(61, 'Wisdom begins in wonder.', 'Socrates', '1'),
(62, 'Without courage, wisdom bears no fruit.', 'Baltasar Gracian', '1'),
(63, 'Change in all things is sweet.', 'Aristotle', '1'),
(64, 'What you fear is that which requires action to overcome.', 'Byron Pulsifer', '1'),
(65, 'When performance exceeds ambition, the overlap is called success.', 'Cullen Hightower', '1'),
(66, 'When deeds speak, words are nothing.', 'African proverb', '1'),
(67, 'Real magic in relationships means an absence of judgement of others.', 'Wayne Dyer', '1'),
(68, 'I never think of the future. It comes soon enough.', 'Albert Einstein', '1'),
(69, 'Skill to do comes of doing.', 'Ralph Emerson', '1'),
(70, 'Wisdom is the supreme part of happiness.', 'Sophocles', '1'),
(71, 'I believe that every person is born with talent.', 'Maya Angelou', '1'),
(72, 'Important principles may, and must, be inflexible.', 'Abraham Lincoln', '1'),
(73, 'The undertaking of a new action brings new strength.', 'Richard Evans', '1'),
(74, 'The years teach much which the days never know.', 'Ralph Emerson', '1'),
(75, 'Our distrust is very expensive.', 'Ralph Emerson', '1'),
(76, 'All know the way; few actually walk it.', 'Bodhidharma', '1'),
(77, 'Great talent finds happiness in execution.', 'Johann Wolfgang von Goethe', '1'),
(78, 'Faith in oneself is the best and safest course.', 'Michelangelo', '1'),
(79, 'Courage is going from failure to failure without losing enthusiasm.', 'Winston Churchill', '1'),
(80, 'The two most powerful warriors are patience and time.', 'Leo Tolstoy', '1'),
(81, 'Anticipate the difficult by managing the easy.', 'Lao Tzu', '1'),
(82, 'Those who are free of resentful thoughts surely find peace.', 'Buddha', '1'),
(83, 'A short saying often contains much wisdom.', 'Sophocles', '1'),
(84, 'It takes both sunshine and rain to make a rainbow.', 'Anonymous', '1'),
(85, 'A beautiful thing is never perfect.', 'Anonymous', '1'),
(86, 'Only do what your heart tells you.', 'Princess Diana', '1'),
(87, 'Life is movement-we breathe, we eat, we walk, we move!', 'John Pierrakos', '1'),
(88, 'No one can make you feel inferior without your consent.', 'Eleanor Roosevelt', '1'),
(89, 'Argue for your limitations, and sure enough theyre yours.', 'Richard Bach', '1'),
(90, 'Luck is what happens when preparation meets opportunity.', 'Seneca', '1'),
(91, 'Victory belongs to the most persevering.', 'Napoleon Bonaparte', '1'),
(92, 'Love all, trust a few, do wrong to none.', 'William Shakespeare', '1'),
(93, 'In order to win, you must expect to win.', 'Richard Bach', '1'),
(94, 'A goal is a dream with a deadline.', 'Napoleon Hill', '1'),
(95, 'You can do it if you believe you can!', 'Napoleon Hill', '1'),
(96, 'Set your goals high, and don\'t stop till you get there.', 'Bo Jackson', '1'),
(97, 'Every new day is another chance to change your life.', 'Anonymous', '1'),
(98, 'Smile, breathe, and go slowly.', 'Thich Nhat Hanh', '1'),
(99, 'Nobody will believe in you unless you believe in yourself.', 'Liberace', '1'),
(100, 'Do more than dream: work.', 'William Arthur Ward', '1'),
(101, 'No man was ever wise by chance.', 'Seneca', '1'),
(102, 'Some pursue happiness, others create it.', 'Anonymous', '1'),
(103, 'He that is giddy thinks the world turns round.', 'William Shakespeare', '1'),
(104, 'Don\'t ruin the present with the ruined past.', 'Ellen Gilchrist', '1'),
(105, 'Do something wonderful, people may imitate it.', 'Albert Schweitzer', '1'),
(106, 'We do what we do because we believe.', 'Anonymous', '1'),
(107, 'Do one thing every day that scares you.', 'Eleanor Roosevelt', '1'),
(108, 'If you cannot be silent be brilliant and thoughtful.', 'Byron Pulsifer', '1'),
(109, 'Who looks outside, dreams; who looks inside, awakes.', 'Carl Jung', '1'),
(110, 'What we think, we become.', 'Buddha', '1'),
(111, 'The shortest answer is doing.', 'Lord Herbert', '1'),
(112, 'All our knowledge has its origins in our perceptions.', 'Leonardo da Vinci', '1'),
(113, 'The harder you fall, the higher you bounce.', 'Anonymous', '1'),
(114, 'Trusting our intuition often saves us from disaster.', 'Anne Wilson Schaef', '1'),
(115, 'Truth is powerful and it prevails.', 'Sojourner Truth', '1'),
(116, 'Light tomorrow with today!', 'Elizabeth Browning', '1'),
(117, 'Silence is a fence around wisdom.', 'German proverb', '1'),
(118, 'Society develops wit, but its contemplation alone forms genius.', 'Madame de Stael', '1'),
(119, 'The simplest things are often the truest.', 'Richard Bach', '1'),
(120, 'Everyone smiles in the same language.', 'Anonymous', '1'),
(121, 'Yesterday I dared to struggle. Today I dare to win.', 'Bernadette Devlin', '1'),
(122, 'No alibi will save you from accepting the responsibility.', 'Napoleon Hill', '1'),
(123, 'If you can dream it, you can do it.', 'Walt Disney', '1'),
(124, 'It is better to travel well than to arrive.', 'Buddha', '1'),
(125, 'Life shrinks or expands in proportion to one\'s courage.', 'Anais Nin', '1'),
(126, 'You have to believe in yourself.', 'Sun Tzu', '1'),
(127, 'Our intention creates our reality.', 'Wayne Dyer', '1'),
(128, 'Silence is a true friend who never betrays.', 'Confucius', '1'),
(129, 'Character develops itself in the stream of life.', 'Johann Wolfgang von Goethe', '1'),
(130, 'From little acorns mighty oaks do grow.', 'American proverb', '1'),
(131, 'You can\'t stop the waves, but you can learn to surf.', 'Jon Kabat-Zinn', '1'),
(132, 'Reality does not conform to the ideal, but confirms it.', 'Gustave Flaubert', '1'),
(133, 'Speak low, if you speak love.', 'William Shakespeare', '1'),
(134, 'A really great talent finds its happiness in execution.', 'Johann Wolfgang von Goethe', '1'),
(135, 'Reality leaves a lot to the imagination.', 'John Lennon', '1'),
(136, 'The greatest remedy for anger is delay.', 'Seneca', '1'),
(137, 'Growth itself contains the germ of happiness.', 'Pearl Buck', '1'),
(138, 'You can do what\'s reasonable or you can decide what\'s possible.', 'Anonymous', '1'),
(139, 'Nothing strengthens authority so much as silence.', 'Leonardo da Vinci', '1'),
(140, 'Wherever you go, go with all your heart.', 'Confucius', '1'),
(141, 'The only real valuable thing is intuition.', 'Albert Einstein', '1'),
(142, 'Good luck is another name for tenacity of purpose.', 'Ralph Emerson', '1'),
(143, 'Rainbows apologize for angry skies.', 'Sylvia Voirol', '1'),
(144, 'Friendship isn\'t a big thing. It\'s a million little things.', 'Anonymous', '1'),
(145, 'Time is the most valuable thing a man can spend.', 'Theophrastus', '1'),
(146, 'Whatever happens, take responsibility.', 'Tony Robbins', '1'),
(147, 'Experience is simply the name we give our mistakes.', 'Oscar Wilde', '1'),
(148, 'I think and that is all that I am.', 'Wayne Dyer', '1'),
(149, 'A good plan today is better than a perfect plan tomorrow.', 'Anonymous', '1'),
(150, 'If the shoe doesn\'t fit, must we change the foot?', 'Gloria Steinem', '1'),
(151, 'Each day provides its own gifts.', 'Marcus Aurelius', '1'),
(152, 'While we stop to think, we often miss our opportunity.', 'Publilius Syrus', '1'),
(153, 'Life isn\'t about finding yourself. Life is about creating yourself.', 'Bernard Shaw', '1'),
(154, 'To bring anything into your life, imagine that it\'s already there.', 'Richard Bach', '1'),
(155, 'Begin to weave and God will give you the thread.', 'German proverb', '1'),
(156, 'The more you know yourself, the more you forgive yourself.', 'Confucius', '1'),
(157, 'Someone remembers, someone cares; your name is whispered in someone\'s prayers.', 'Anonymous', '1'),
(158, 'Without faith, nothing is possible. With it, nothing is impossible.', 'Mary Bethune', '1'),
(159, 'Once we accept our limits, we go beyond them.', 'Albert Einstein', '1'),
(160, 'Don\'t be pushed by your problems; be led by your dreams.', 'Anonymous', '1'),
(161, 'Whatever we expect with confidence becomes our own self-fulfilling prophecy.', 'Brian Tracy', '1'),
(162, 'Everything you can imagine is real.', 'Pablo Picasso', '1'),
(163, 'Fear is a darkroom where negatives develop.', 'Usman Asif', '1'),
(164, 'The truest wisdom is a resolute determination.', 'Napoleon Bonaparte', '1'),
(165, 'Life is the flower for which love is the honey.', 'Victor Hugo', '1'),
(166, 'Freedom is the right to live as we wish.', 'Epictetus', '1'),
(167, 'Change your thoughts, change your life!', 'Anonymous', '1'),
(168, 'Never ignore a gut feeling, but never believe that it\'s enough.', 'Robert Heller', '1'),
(169, 'Loss is nothing else but change,and change is Natures delight.', 'Marcus Aurelius', '1'),
(170, 'Someone is special only if you tell them.', 'Byron Pulsifer', '1'),
(171, 'Today is the tomorrow you worried about yesterday.', 'Anonymous', '1'),
(172, 'There is no way to happiness, happiness is the way.', 'Thich Nhat Hanh', '1'),
(173, 'The day always looks brighter from behind a smile.', 'Anonymous', '1'),
(174, 'A stumble may prevent a fall.', 'Anonymous', '1'),
(175, 'He who talks more is sooner exhausted.', 'Lao Tzu', '1'),
(176, 'He who is contented is rich.', 'Lao Tzu', '1'),
(177, 'What we achieve inwardly will change outer reality.', 'Plutarch', '1'),
(178, 'Our strength grows out of our weaknesses.', 'Ralph Waldo Emerson', '1'),
(179, 'We must become the change we want to see.', 'Mahatma Gandhi', '1'),
(180, 'Happiness is found in doing, not merely possessing.', 'Napoleon Hill', '1'),
(181, 'Put your future in good hands your own.', 'Anonymous', '1'),
(182, 'We choose our destiny in the way we treat others.', 'Wit', '1'),
(183, 'No snowflake in an avalanche ever feels responsible.', 'Voltaire', '1'),
(184, 'Fortune favours the brave.', 'Virgil', '1'),
(185, 'I believe in one thing only, the power of human will.', 'Joseph Stalin', '1'),
(186, 'The best way out is always through.', 'Robert Frost', '1'),
(187, 'The mind unlearns with difficulty what it has long learned.', 'Seneca', '1'),
(188, 'I destroy my enemies when I make them my friends.', 'Abraham Lincoln', '1'),
(189, 'No garden is without its weeds.', 'Thomas Fuller', '1'),
(190, 'There is no failure except in no longer trying.', 'Elbert Hubbard', '1'),
(191, 'Kind words will unlock an iron door.', 'Turkish proverb', '1'),
(192, 'Problems are only opportunities with thorns on them.', 'Hugh Miller', '1'),
(193, 'Life is just a chance to grow a soul.', 'A. Powell Davies', '1'),
(194, 'Mountains cannot be surmounted except by winding paths.', 'Johann Wolfgang von Goethe', '1'),
(195, 'May our hearts garden of awakening bloom with hundreds of flowers.', 'Thich Nhat Hanh', '1'),
(196, 'Fortune befriends the bold.', 'John Dryden', '1'),
(197, 'Keep true to the dreams of thy youth.', 'Friedrich von Schiller', '1'),
(198, 'You\'re never a loser until you quit trying.', 'Mike Ditka', '1'),
(199, 'Science is organized knowledge. Wisdom is organized life.', 'Immanuel Kant', '1'),
(200, 'Knowing is not enough; we must apply!', 'Johann Wolfgang von Goethe', '1'),
(201, 'Strong beliefs win strong men, and then make them stronger.', 'Richard Bach', '1'),
(202, 'Autumn is a second spring when every leaf is a flower.', 'Albert Camus', '1'),
(203, 'If you surrender to the wind, you can ride it.', 'Toni Morrison', '1'),
(204, 'Keep yourself to the sunshine and you cannot see the shadow.', 'Helen Keller', '1'),
(205, 'Write your plans in pencil and give God the eraser.', 'Paulo Coelho', '1'),
(206, 'Inspiration exists, but it has to find us working.', 'Pablo Picasso', '1'),
(207, 'Pick battles big enough to matter, small enough to win.', 'Jonathan Kozol', '1'),
(208, 'Don\'t compromise yourself. You are all you\'ve got.', 'Janis Joplin', '1'),
(209, 'A short saying oft contains much wisdom.', 'Sophocles', '1'),
(210, 'Difficulties are things that show a person what they are.', 'Epictetus', '1'),
(211, 'When you doubt your power, you give power to your doubt.', 'Honore de Balzac', '1'),
(212, 'The cause is hidden. The effect is visible to all.', 'Ovid', '1'),
(213, 'A prudent question is one half of wisdom.', 'Francis Bacon', '1'),
(214, 'The path to success is to take massive, determined action.', 'Tony Robbins', '1'),
(215, 'I allow my intuition to lead my path.', 'Manuel Puig', '1'),
(216, 'Nature takes away any faculty that is not used.', 'William R. Inge', '1'),
(217, 'If you wish to be a writer, write.', 'Epictetus', '1'),
(218, 'There is no way to prosperity, prosperity is the way.', 'Wayne Dyer', '1'),
(219, 'Either you run the day or the day runs you.', 'Jim Rohn', '1'),
(220, 'Better be ignorant of a matter than half know it.', 'Publilius Syrus', '1'),
(221, 'Follow your instincts. That is where true wisdom manifests itself.', 'Oprah Winfrey', '1'),
(222, 'There never was a good knife made of bad steel.', 'Benjamin Franklin', '1'),
(223, 'To accomplish great things, we must dream as well as act.', 'Anatole France', '1'),
(224, 'Patience is the companion of wisdom.', 'Saint Augustine', '1'),
(225, 'The mind is everything. What you think you become.', 'Buddha', '1'),
(226, 'To enjoy life, we must touch much of it lightly.', 'Voltaire', '1'),
(227, 'To fly, we have to have resistance.', 'Maya Lin', '1'),
(228, 'What you see depends on what you\'re looking for.', 'Anonymous', '1'),
(229, 'The heart has its reasons which reason knows not of.', 'Blaise Pascal', '1'),
(230, 'Be great in act, as you have been in thought.', 'William Shakespeare', '1'),
(231, 'Imagination rules the world.', 'Napoleon Bonaparte', '1'),
(232, 'Kind words do not cost much. Yet they accomplish much.', 'Blaise Pascal', '1'),
(233, 'There is no greater harm than that of time wasted.', 'Michelangelo', '1'),
(234, 'Intuition will tell the thinking mind where to look next.', 'Jonas Salk', '1'),
(235, 'Worry gives a small thing a big shadow.', 'Anonymous', '1'),
(236, 'Fears are nothing more than a state of mind.', 'Napoleon Hill', '1'),
(237, 'The journey of a thousand miles begins with one step.', 'Lao Tzu', '1'),
(238, 'Efficiency is doing things right; effectiveness is doing the right things.', 'Peter Drucker', '1'),
(239, 'Blaze with the fire that is never extinguished.', 'Luisa Sigea', '1'),
(240, 'Don\'t cry because it\'s over. Smile because it happened.', 'Dr. Seuss', '1'),
(241, 'No is easier to do. Yes is easier to say.', 'Jason Fried', '1'),
(242, 'To be wrong is nothing unless you continue to remember it.', 'Confucius', '1'),
(243, 'Yesterdays home runs don\'t win today\'s games.', 'Babe Ruth', '1'),
(244, 'Silence is deep as Eternity, Speech is shallow as Time.', 'Carlyle', '1'),
(245, 'Don\'t smother each other. No one can grow in the shade.', 'Leo F. Buscaglia', '1'),
(246, 'An ant on the move does more than a dozing ox', 'Lao Tzu', '1'),
(247, 'You can\'t shake hands with a clenched fist.', 'Indira Gandhi', '1'),
(248, 'A good decision is based on knowledge and not on numbers.', 'Plato', '1'),
(249, 'The cautious seldom err.', 'Confucius', '1'),
(250, 'If there is no struggle, there is no progress.', 'Frederick Douglass', '1'),
(251, 'Where there is great love, there are always miracles.', 'Willa Cather', '1'),
(252, 'Time you enjoy wasting, was not wasted.', 'John Lennon', '1'),
(253, 'Every problem has a gift for you in its hands.', 'Richard Bach', '1'),
(254, 'Sadness flies away on the wings of time.', 'Jean de la Fontaine', '1'),
(255, 'I have often regretted my speech, never my silence.', 'Publilius Syrus', '1'),
(256, 'Never put off till tomorrow what you can do today.', 'Thomas Jefferson', '1'),
(257, 'Minds are like parachutes. They only function when open.', 'Thomas Dewar', '1'),
(258, 'If a man does his best, what else is there?', 'George Patton', '1'),
(259, 'The secret of success is constancy to purpose.', 'Benjamin Disraeli', '1'),
(260, 'Life is a progress, and not a station.', 'Ralph Emerson', '1'),
(261, 'All seasons are beautiful for the person who carries happiness within.', 'Horace Friess', '1'),
(262, 'To avoid criticism, do nothing, say nothing, be nothing.', 'Elbert Hubbard', '1'),
(263, 'All things change; nothing perishes.', 'Ovid', '1'),
(264, 'Absence makes the heart grow fonder.', 'Haynes Bayly', '1'),
(265, 'Imagination is the highest kite one can fly.', 'Lauren Bacall', '1'),
(266, 'The beginning of knowledge is the discovery of something we do not understand.', 'Frank Herbert', '1'),
(267, 'Love doesn\'t make the world go round, love is what makes the ride worthwhile.', 'Elizabeth Browning', '1'),
(268, 'Whenever you have eliminated the impossible, whatever remains, however improbable, must be the truth.', 'Arthur Conan Doyle', '1'),
(269, 'Good timber does not grow with ease; the stronger the wind, the stronger the trees.', 'J. Willard Marriott', '1'),
(270, 'I believe that we are fundamentally the same and have the same basic potential.', 'Dalai Lama', '1'),
(271, 'The winds and waves are always on the side of the ablest navigators.', 'Edward Gibbon', '1'),
(272, 'The future belongs to those who believe in the beauty of their dreams.', 'Eleanor Roosevelt', '1'),
(273, 'To get something you never had, you have to do something you never did.', 'Anonymous', '1'),
(274, 'Be thankful when you don\'t know something for it gives you the opportunity to learn.', 'Anonymous', '1'),
(275, 'Strength does not come from physical capacity. It comes from an indomitable will.', 'Mahatma Gandhi', '1'),
(276, 'Each misfortune you encounter will carry in it the seed of tomorrows good luck.', 'Og Mandino', '1'),
(277, 'To forgive is to set a prisoner free and realize that prisoner was you.', 'Lewis B. Smedes', '1'),
(278, 'In separateness lies the world\'s great misery, in compassion lies the world\'s true strength.', 'Buddha', '1'),
(279, 'By believing passionately in something that does not yet exist, we create it.', 'Nikos Kazantzakis', '1'),
(280, 'Letting go is not the end of the world; it is the beginning of a new life.', 'Anonymous', '1'),
(281, 'All the great performers I have worked with are fuelled by a personal dream.', 'John Eliot', '1'),
(282, 'One of the advantages of being disorderly is that one is constantly making exciting discoveries.', 'A. A. Milne', '1'),
(283, 'I never see what has been done; I only see what remains to be done.', 'Marie Curie', '1'),
(284, 'Begin at once to live and count each separate day as a separate life.', 'Seneca', '1'),
(285, 'If you don\'t know where you are going, you will probably end up somewhere else.', 'Lawrence Peter', '1'),
(286, 'It is not so important to know everything as to appreciate what we learn.', 'Hannah More', '1'),
(287, 'The bird of paradise alights only upon the hand that does not grasp.', 'John Berry', '1'),
(288, 'Think as a wise man but communicate in the language of the people.', 'William Yeats', '1'),
(289, 'Practice yourself, for heavens sake in little things, and then proceed to greater.', 'Epictetus', '1'),
(290, 'If one does not know to which port is sailing, no wind is favorable.', 'Seneca', '1'),
(291, 'Our greatest glory is not in never failing but rising everytime we fall.', 'Anonymous', '1'),
(292, 'Being right is highly overrated. Even a stopped clock is right twice a day.', 'Anonymous', '1'),
(293, 'To be upset over what you don\'t have is to waste what you do have.', 'Ken S. Keyes', '1'),
(294, 'If we did the things we are capable of, we would astound ourselves.', 'Thomas Edison', '1'),
(295, 'Nothing in life is to be feared. It is only to be understood.', 'Marie Curie', '1'),
(296, 'Successful people ask better questions, and as a result, they get better answers.', 'Tony Robbins', '1'),
(297, 'Love is not blind; it simply enables one to see things others fail to see.', 'Anonymous', '1'),
(298, 'Life is a process. We are a process. The universe is a process.', 'Anne Schaef', '1'),
(299, 'I think somehow we learn who we really are and then live with that decision.', 'Eleanor Roosevelt', '1'),
(300, 'We learn what we have said from those who listen to our speaking.', 'Kenneth Patton', '1'),
(301, 'A little knowledge that acts is worth infinitely more than much knowledge that is idle.', 'Kahlil Gibran', '1'),
(302, 'If you get up one more time than you fall, you will make it through.', 'Anonymous', '1'),
(303, 'The doors we open and close each day decide the lives we live.', 'Flora Whittemore', '1'),
(304, 'The worst bankrupt in the world is the person who has lost his enthusiasm.', 'H. W. Arnold', '1'),
(305, 'Happiness comes when your work and words are of benefit to yourself and others.', 'Buddha', '1'),
(306, 'Don\'t focus on making the right decision, focus on making the decision the right one.', 'Anonymous', '1'),
(307, 'Everything is perfect in the universe even your desire to improve it.', 'Wayne Dyer', '1'),
(308, 'The universe is full of magical things, patiently waiting for our wits to grow sharper.', 'Eden Phillpotts', '1'),
(309, 'Just as a candle cannot burn without fire, men cannot live without a spiritual life.', 'Buddha', '1'),
(310, 'A thing long expected takes the form of the unexpected when at last it comes.', 'Mark Twain', '1'),
(311, 'Action may not always bring happiness; but there is no happiness without action.', 'Benjamin Disraeli', '1'),
(312, 'I don\'t believe in failure. It is not failure if you enjoyed the process.', 'Oprah Winfrey', '1'),
(313, 'What you do not want done to yourself, do not do to others.', 'Confucius', '1'),
(314, 'Short words are best and the old words when short are best of all.', 'Winston Churchill', '1'),
(315, 'If you light a lamp for somebody, it will also brighten your path.', 'Buddha', '1'),
(316, 'I have done my best: that is about all the philosophy of living one needs.', 'Lin-yutang', '1'),
(317, 'Through perseverance many people win success out of what seemed destined to be certain failure.', 'Benjamin Disraeli', '1'),
(318, 'Give thanks for the rain of life that propels us to reach new horizons.', 'Byron Pulsifer', '1'),
(319, 'Love is just a word until someone comes along and gives it meaning.', 'Anonymous', '1'),
(320, 'We all have problems. The way we solve them is what makes us different.', 'Anonymous', '1'),
(321, 'The secret to a rich life is to have more beginnings than endings.', 'Dave Weinbaum', '1'),
(322, 'It is only when the mind and character slumber that the dress can be seen.', 'Ralph Waldo Emerson', '1'),
(323, 'If you don\'t like something, change it. If you can\'t change it, change your attitude.', 'Maya Angelou', '1'),
(324, 'Reviewing what you have learned and learning anew, you are fit to be a teacher.', 'Confucius', '1'),
(325, 'The world is a book, and those who do not travel read only a page.', 'Augustinus Sanctus', '1'),
(326, 'So long as a person is capable of self-renewal they are a living being.', 'Henri-Frederic Amiel', '1'),
(327, 'I\'m not afraid of storms, for I\'m learning how to sail my ship.', 'Louisa Alcott', '1'),
(328, 'Think for yourselves and let others enjoy the privilege to do so too.', 'Voltaire', '1'),
(329, 'How we spend our days is, of course, how we spend our lives.', 'Annie Dillard', '1'),
(330, 'It has never been my object to record my dreams, just to realize them.', 'Man Ray', '1'),
(331, 'The most complicated achievements of thought are possible without the assistance of consciousness.', 'Sigmund Freud', '1'),
(332, 'Be miserable. Or motivate yourself. Whatever has to be done, it\'s always your choice.', 'Wayne Dyer', '1'),
(333, 'Most great people have attained their greatest success just one step beyond their greatest failure.', 'Napoleon Hill', '1'),
(334, 'If you think you can, you can. And if you think you can\'t, you\'re right.', 'Henry Ford', '1'),
(335, 'Better to have loved and lost, than to have never loved at all.', 'St. Augustine', '1'),
(336, 'Everyone thinks of changing the world, but no one thinks of changing himself.', 'Leo Tolstoy', '1'),
(337, 'The best way to pay for a lovely moment is to enjoy it.', 'Richard Bach', '1'),
(338, 'You have enemies? Good. That means you\'ve stood up for something, sometime in your life.', 'Winston Churchill', '1'),
(339, 'Slow down and everything you are chasing will come around and catch you.', 'John De Paola', '1'),
(340, 'Your worst enemy cannot harm you as much as your own unguarded thoughts.', 'Buddha', '1'),
(341, 'I always wanted to be somebody, but I should have been more specific.', 'Lily Tomlin', '1'),
(342, 'Yeah we all shine on, like the moon, and the stars, and the sun.', 'John Lennon', '1'),
(343, 'Knowledge is a process of piling up facts; wisdom lies in their simplification.', 'Martin Fischer', '1'),
(344, 'Life is like riding a bicycle. To keep your balance you must keep moving.', 'Albert Einstein', '1'),
(345, 'We should all be thankful for those people who rekindle the inner spirit.', 'Albert Schweitzer', '1'),
(346, 'Opportunity is missed by most because it is dressed in overalls and looks like work.', 'Thomas Edison', '1'),
(347, 'Feeling and longing are the motive forces behind all human endeavor and human creations.', 'Albert Einstein', '1'),
(348, 'In the end we retain from our studies only that which we practically apply.', 'Johann Wolfgang von Goethe', '1'),
(349, 'If you correct your mind, the rest of your life will fall into place.', 'Lao Tzu', '1'),
(350, 'The world makes way for the man who knows where he is going.', 'Ralph Emerson', '1'),
(351, 'When your desires are strong enough you will appear to possess superhuman powers to achieve.', 'Napoleon Hill', '1'),
(352, 'Patience and perseverance have a magical effect before which difficulties disappear and obstacles vanish.', 'John Adams', '1'),
(353, 'I cannot make my days longer so I strive to make them better.', 'Henry David Thoreau', '1'),
(354, 'Tension is who you think you should be. Relaxation is who you are.', 'Chinese proverb', '1'),
(355, 'Never bend your head. Always hold it high. Look the world right in the eye.', 'Helen Keller', '1'),
(356, 'One who gains strength by overcoming obstacles possesses the only strength which can overcome adversity.', 'Albert Schweitzer', '1'),
(357, 'We cannot do everything at once, but we can do something at once.', 'Calvin Coolidge', '1'),
(358, 'You have to do your own growing no matter how tall your grandfather was.', 'Abraham Lincoln', '1'),
(359, 'Invent your world. Surround yourself with people, color, sounds, and work that nourish you.', 'Anonymous', '1'),
(360, 'It is fatal to enter any war without the will to win it.', 'General Douglas MacArthur', '1'),
(361, 'Be what you are. This is the first step toward becoming better than you are.', 'Julius Charles Hare', '1'),
(362, 'There is nothing in a caterpillar that tells you it\'s going to be a butterfly.', 'Buckminster Fuller', '1'),
(363, 'Love and compassion open our own inner life, reducing stress, distrust and loneliness.', 'Dalai Lama', '1'),
(364, 'Ideals are an imaginative understanding of that which is desirable in that which is possible.', 'Walter Lippmann', '1'),
(365, 'The superior man is satisfied and composed; the mean man is always full of distress.', 'Confucius', '1'),
(366, 'If you spend too much time thinking about a thing, you\'ll never get it done.', 'Bruce Lee', '1'),
(367, 'The way is not in the sky. The way is in the heart.', 'Buddha', '1'),
(368, 'Most people are about as happy as they make up their minds to be', 'Abraham Lincoln', '1'),
(369, 'Three things cannot be long hidden: the sun, the moon, and the truth.', 'Buddha', '1'),
(370, 'More often than not, anger is actually an indication of weakness rather than of strength.', 'Dalai Lama', '1'),
(371, 'Before you put on a frown, make absolutely sure there are no smiles available.', 'Jim Beggs', '1'),
(372, 'A man of ability and the desire to accomplish something can do anything.', 'Donald Kircher', '1'),
(373, 'You, yourself, as much as anybody in the entire universe, deserve your love and affection.', 'Buddha', '1'),
(374, 'It is not uncommon for people to spend their whole life waiting to start living.', 'Eckhart Tolle', '1'),
(375, 'Don\'t be afraid to go out on a limb. That\'s where the fruit is.', 'H. Jackson Browne', '1'),
(376, 'Wicked people are always surprised to find ability in those that are good.', 'Marquis Vauvenargues', '1'),
(377, 'Life is so constructed that an event does not, cannot, will not, match the expectation.', 'Charlotte Bronte', '1'),
(378, 'If you change the way you look at things, the things you look at change.', 'Wayne Dyer', '1'),
(379, 'No man can succeed in a line of endeavor which he does not like.', 'Napoleon Hill', '1'),
(380, 'You will not be punished for your anger, you will be punished by your anger.', 'Buddha', '1'),
(381, 'Don\'t judge each day by the harvest you reap but by the seeds you plant.', 'Robert Stevenson', '1'),
(382, 'They say that time changes things, but you actually have to change them yourself.', 'Andy Warhol', '1'),
(383, 'Never apologize for showing feelings. When you do so, you apologize for the truth.', 'Benjamin Disraeli', '1'),
(384, 'The truth you believe and cling to makes you unavailable to hear anything new.', 'Pema Chodron', '1'),
(385, 'Adversity has the effect of eliciting talents, which in prosperous circumstances would have lain dormant.', 'Horace', '1'),
(386, 'If you spend your whole life waiting for the storm, you\'ll never enjoy the sunshine.', 'Morris West', '1'),
(387, 'The only limit to our realization of tomorrow will be our doubts of today.', 'Franklin Roosevelt', '1'),
(388, 'Every action of our lives touches on some chord that will vibrate in eternity.', 'Edwin Chapin', '1'),
(389, 'Shoot for the moon. Even if you miss, you\'ll land among the stars.', 'Les Brown', '1'),
(390, 'It does not matter how slowly you go as long as you do not stop.', 'Confucius', '1'),
(391, 'Every day may not be good, but there\'s something good in every day.', 'Anonymous', '1'),
(392, 'Most folks are about as happy as they make up their minds to be.', 'Abraham Lincoln', '1'),
(393, 'If you would take, you must first give, this is the beginning of intelligence.', 'Lao Tzu', '1'),
(394, 'Some people think it\'s holding that makes one strong sometimes it\'s letting go.', 'Anonymous', '1'),
(395, 'It is on our failures that we base a new and different and better success.', 'Havelock Ellis', '1'),
(396, 'Quality is never an accident; it is always the result of intelligent effort.', 'John Ruskin', '1'),
(397, 'To study and not think is a waste. To think and not study is dangerous.', 'Confucius', '1'),
(398, 'Life is a succession of lessons, which must be lived to be understood.', 'Ralph Emerson', '1'),
(399, 'Time changes everything except something within us which is always surprised by change.', 'Thomas Hardy', '1'),
(400, 'You are important enough to ask and you are blessed enough to receive back.', 'Wayne Dyer', '1'),
(401, 'If you cannot do great things, do small things in a great way.', 'Napoleon Hill', '1'),
(402, 'If you want your life to be more rewarding, you have to change the way you think.', 'Oprah Winfrey', '1'),
(403, 'Transformation doesn\'t take place with a vacuum; instead, it occurs when we are indirectly and directly connected to all those around us.', 'Byron Pulsifer', '1'),
(404, 'The only difference between your abilities and others is the ability to put yourself in their shoes and actually try.', 'Leonardo Ruiz', '1'),
(405, 'The free man is he who does not fear to go to the end of his thought.', 'Leon Blum', '1'),
(406, 'Great are they who see that spiritual is stronger than any material force, that thoughts rule the world.', 'Ralph Emerson', '1'),
(407, 'A life spent making mistakes is not only more honourable but more useful than a life spent in doing nothing.', 'Bernard Shaw', '1'),
(408, 'The wise man does not lay up his own treasures. The more he gives to others, the more he has for his own.', 'Lao Tzu', '1'),
(409, 'Don\'t leave a stone unturned. It\'s always something, to know you have done the most you could.', 'Charles Dickens', '1'),
(410, 'By going beyond your own problems and taking care of others, you gain inner strength, self-confidence, courage, and a greater sense of calm.', 'Dalai Lama', '1'),
(411, 'We come to love not by finding a perfect person, but by learning to see an imperfect person perfectly.', 'Sam Keen', '1'),
(412, 'What lies behind us and what lies before us are tiny matters compared to what lies within us.', 'Walt Emerson', '1'),
(413, 'There are things so deep and complex that only intuition can reach it in our stage of development as human beings.', 'John Astin', '1'),
(414, 'A little more persistence, a little more effort, and what seemed hopeless failure may turn to glorious success.', 'Elbert Hubbard', '1'),
(415, 'There is no retirement for an artist, it\'s your way of living so there is no end to it.', 'Henry Moore', '1'),
(416, 'I will not be concerned at other men is not knowing me;I will be concerned at my own want of ability.', 'Confucius', '1'),
(417, 'Why worry about things you cannot control when you can keep yourself busy controlling the things that depend on you?', 'Anonymous', '1'),
(418, 'When you are content to be simply yourself and don\'t compare or compete, everybody will respect you.', 'Laozi', '1'),
(419, 'Be not afraid of greatness: some are born great, some achieve greatness, and some have greatness thrust upon them.', 'William Shakespeare', '1'),
(420, 'Success means having the courage, the determination, and the will to become the person you believe you were meant to be.', 'George Sheehan', '1'),
(421, 'Do you want to know who you are? Don\'t ask. Act! Action will delineate and define you.', 'Thomas Jefferson', '1'),
(422, 'It is only with the heart that one can see rightly, what is essential is invisible to the eye.', 'Antoine de Saint-Exupery', '1'),
(423, 'Let us be grateful to people who make us happy; they are the charming gardeners who make our souls blossom.', 'Marcel Proust', '1'),
(424, 'Make the best use of what is in your power, and take the rest as it happens.', 'Epictetus', '1'),
(425, 'The thoughts we choose to think are the tools we use to paint the canvas of our lives.', 'Louise Hay', '1'),
(426, 'No matter how carefully you plan your goals they will never be more that pipe dreams unless you pursue them with gusto.', 'W. Clement Stone', '1'),
(427, 'The reason most goals are not achieved is that we spend our time doing second things first.', 'Robert McKain', '1'),
(428, 'If your actions inspire others to dream more, learn more, do more and become more, you are a leader.', 'John Quincy Adams', '1'),
(429, 'I\'m a great believer in luck and I find the harder I work, the more I have of it.', 'Thomas Jefferson', '1'),
(430, 'Do not waste yourself in rejection, nor bark against the bad, but chant the beauty of the good.', 'Ralph Emerson', '1'),
(431, 'The person born with a talent they are meant to use will find their greatest happiness in using it.', 'Johann Wolfgang von Goethe', '1'),
(432, 'Good people are good because they\'ve come to wisdom through failure. We get very little wisdom from success, you know.', 'William Saroyan', '1'),
(433, 'Your destiny isn\'t just fate; it is how you use your own developed abilities to get what you want.', 'Byron Pulsifer', '1'),
(434, 'Iron rusts from disuse; water loses its purity from stagnation... even so does inaction sap the vigour of the mind.', 'Leonardo da Vinci', '1'),
(435, 'A subtle thought that is in error may yet give rise to fruitful inquiry that can establish truths of great value.', 'Isaac Asimov', '1'),
(436, 'Be glad of life because it gives you the chance to love, to work, to play, and to look up at the stars.', 'Henry Van Dyke', '1'),
(437, 'You got to be careful if you don\'t know where you\'re going, because you might not get there.', 'Yogi Berra', '1'),
(438, 'You can tell whether a man is clever by his answers. You can tell whether a man is wise by his questions.', 'Naguib Mahfouz', '1'),
(439, 'Life is a gift, and it offers us the privilege, opportunity, and responsibility to give something back by becoming more', 'Anthony Robbins', '1'),
(440, 'You can\'t let praise or criticism get to you. It\'s a weakness to get caught up in either one.', 'John Wooden', '1'),
(441, 'I will love the light for it shows me the way, yet I will endure the darkness because it shows me the stars.', 'Og Mandino', '1'),
(442, 'Our doubts are traitors and make us lose the good we often might win, by fearing to attempt.', 'Jane Addams', '1'),
(443, 'By nature man hates change; seldom will he quit his old home till it has actually fallen around his ears.', 'Thomas Carlyle', '1'),
(444, 'Until you value yourself, you won\'t value your time. Until you value your time, you won\'t do anything with it.', 'M. Scott Peck', '1'),
(445, 'The minute you settle for less than you deserve, you get even less than you settled for.', 'Maureen Dowd', '1'),
(446, 'The highest stage in moral ure at which we can arrive is when we recognize that we ought to control our thoughts.', 'Charles Darwin', '1'),
(447, 'It is better to take many small steps in the right direction than to make a great leap forward only to stumble backward.', 'Anonymous', '1'),
(448, 'If we have a positive mental attitude, then even when surrounded by hostility, we shall not lack inner peace.', 'Dalai Lama', '1'),
(449, 'There is only one success to be able to spend your life in your own way.', 'Christopher Morley', '1'),
(450, 'Promises are the uniquely human way of ordering the future, making it predictable and reliable to the extent that this is humanly possible.', 'Hannah Arendt', '1'),
(451, 'Appreciation is the highest form of prayer, for it acknowledges the presence of good wherever you shine the light of your thankful thoughts.', 'Alan Cohen', '1'),
(452, 'There is only one corner of the universe you can be certain of improving, and that\'s your own self.', 'Aldous Huxley', '1'),
(453, 'You\'re not obligated to win. You\'re obligated to keep trying to do the best you can every day.', 'Marian Edelman', '1'),
(454, 'Everyone can taste success when the going is easy, but few know how to taste victory when times get tough.', 'Byron Pulsifer', '1'),
(455, 'Deep listening is miraculous for both listener and speaker.When someone receives us with open-hearted, non-judging, intensely interested listening, our spirits expand.', 'Sue Patton Thoele', '1'),
(456, 'You may be deceived if you trust too much, but you will live in torment if you don\'t trust enough.', 'Frank Crane', '1'),
(457, 'Great indeed is the sublimity of the Creative, to which all beings owe their beginning and which permeates all heaven.', 'Lao Tzu', '1'),
(458, 'All that is necessary is to accept the impossible, do without the indispensable, and bear the intolerable.', 'Kathleen Norris', '1'),
(459, 'Choose a job you love, and you will never have to work a day in your life.', 'Confucius', '1'),
(460, 'You cannot find yourself by going into the past. You can find yourself by coming into the present.', 'Eckhart Tolle', '1'),
(461, 'All our talents increase in the using, and the every faculty, both good and bad, strengthen by exercise.', 'Anne Bronte', '1'),
(462, 'In order to live free and happily you must sacrifice boredom. It is not always an easy sacrifice.', 'Richard Bach', '1'),
(463, 'The fox has many tricks. The hedgehog has but one. But that is the best of all.', 'Desiderius Erasmus', '1'),
(464, 'Of course there is no formula for success except perhaps an unconditional acceptance of life and what it brings.', 'Arthur Rubinstein', '1'),
(465, 'Let me tell you the secret that has led me to my goal: my strength lies solely in my tenacity', 'Louis Pasteur', '1'),
(466, 'Something opens our wings. Something makes boredom and hurt disappear. Someone fills the cup in front of us: We taste only sacredness.', 'Rumi', '1'),
(467, 'We must never forget that it is through our actions, words, and thoughts that we have a choice.', 'Sogyal Rinpoche', '1'),
(468, 'We see things not as they are, but as we are. Our perception is shaped by our previous experiences.', 'Dennis Kimbro', '1'),
(469, 'True silence is the rest of the mind; it is to the spirit what sleep is to the body, nourishment and refreshment.', 'William Penn', '1'),
(470, 'All our knowledge begins with the senses, proceeds then to the understanding, and ends with reason. There is nothing higher than reason.', 'Immanuel Kant', '1'),
(471, 'The thought manifests as the word. The word manifests as the deed. The deed develops into habit. And the habit hardens into character.', 'Buddha', '1'),
(472, 'As the rest of the world is walking out the door, your best friends are the ones walking in.', 'Anonymous', '1'),
(473, 'Patience is a virtue but you will never ever accomplish anything if you don\'t exercise action over patience.', 'Byron Pulsifer', '1'),
(474, 'Any of us can achieve virtue, if by virtue we merely mean the avoidance of the vices that do not attract us.', 'Robert Lynd', '1'),
(475, 'If the single man plant himself indomitably on his instincts, and there abide, the huge world will come round to him.', 'Ralph Emerson', '1'),
(476, 'Money was never a big motivation for me, except as a way to keep score. The real excitement is playing the game.', 'Donald Trump', '1'),
(477, 'Friendship with oneself is all important because without it one cannot be friends with anybody else in the world.', 'Eleanor Roosevelt', '1'),
(478, 'Peace is not something you wish for. It\'s something you make, something you do, something you are, and something you give away.', 'Robert Fulghum', '1'),
(479, 'A wise man can learn more from a foolish question than a fool can learn from a wise answer.', 'Bruce Lee', '1'),
(480, 'Every man takes the limits of his own field of vision for the limits of the world.', 'Arthur Schopenhauer', '1'),
(481, 'One does not discover new lands without consenting to lose sight of the shore for a very long time.', 'Andre Gide', '1'),
(482, 'What is new in the world? Nothing. What is old in the world? Nothing. Everything has always been and will always be.', 'Sai Baba', '1'),
(483, 'Genuine love should first be directed at oneself if we do not love ourselves, how can we love others?', 'Dalai Lama', '1'),
(484, 'Life is like a sewer. What you get out of it depends on what you put into it.', 'Tom Lehrer', '1'),
(485, 'Notice that the stiffest tree is most easily cracked, while the bamboo or willow survives by bending with the wind.', 'Bruce Lee', '1'),
(486, 'Learn all you can from the mistakes of others. You won\'t have time to make them all yourself.', 'Alfred Sheinwold', '1'),
(487, 'Judge nothing, you will be happy. Forgive everything, you will be happier. Love everything, you will be happiest.', 'Sri Chinmoy', '1'),
(488, 'People are so constituted that everybody would rather undertake what they see others do, whether they have an aptitude for it or not.', 'Johann Wolfgang von Goethe', '1'),
(489, 'We are either progressing or retrograding all the while. There is no such thing as remaining stationary in this life.', 'James Freeman Clarke', '1'),
(490, 'The possession of knowledge does not kill the sense of wonder and mystery. There is always more mystery.', 'Anais Nin', '1'),
(491, 'Everything that happens happens as it should, and if you observe carefully, you will find this to be so.', 'Marcus Aurelius', '1'),
(492, 'What we think determines what happens to us, so if we want to change our lives, we need to stretch our minds.', 'Wayne Dyer', '1'),
(493, 'In a controversy the instant we feel anger we have already ceased striving for the truth, and have begun striving for ourselves.', 'Buddha', '1'),
(494, 'It is the greatest of all mistakes to do nothing because you can only do little do what you can.', 'Sydney Smith', '1'),
(495, 'When you see a man of worth, think of how you may emulate him. When you see one who is unworthy, examine yourself.', 'Confucius', '1'),
(496, 'Aerodynamically the bumblebee shouldn\'t be able to fly, but the bumblebee doesn\'t know that so it goes on flying anyway.', 'Mary Kay Ash', '1'),
(497, 'Those who try to do something and fail are infinitely better than those who try nothing and succeed.', 'Lloyd Jones', '1'),
(498, 'Snowflakes are one of natures most fragile things, but just look what they can do when they stick together.', 'Vista Kelly', '1'),
(499, 'The first step to getting the things you want out of life is this: decide what you want.', 'Ben Stein', '1'),
(500, 'Why compare yourself with others? No one in the entire world can do a better job of being you than you.', 'Anonymous', '1'),
(501, 'Experience is not what happens to a man. It is what a man does with what happens to him.', 'Aldous Huxley', '1'),
(502, 'A good teacher is like a candle it consumes itself to light the way for others.', 'Anonymous', '1'),
(503, 'The only thing to do with good advice is to pass it on. It is never of any use to oneself.', 'Oscar Wilde', '1'),
(504, 'Life is not measured by the breaths we take, but by the moments that take our breath.', 'Anonymous', '1'),
(505, 'The smallest flower is a thought, a life answering to some feature of the Great Whole, of whom they have a persistent intuition.', 'Honore de Balzac', '1'),
(506, 'Consider how hard it is to change yourself and you\'ll understand what little chance you have in trying to change others.', 'Jacob Braude', '1'),
(507, 'If you\'ll not settle for anything less than your best, you will be amazed at what you can accomplish in your lives.', 'Vince Lombardi', '1'),
(508, 'What lies behind us and what lies before us are small matters compared to what lies within us.', 'Oliver Holmes', '1'),
(509, 'With the realization of ones own potential and self-confidence in ones ability, one can build a better world.', 'Dalai Lama', '1'),
(510, 'There is nothing like returning to a place that remains unchanged to find the ways in which you yourself have altered.', 'Nelson Mandela', '1'),
(511, 'Forget about all the reasons why something may not work. You only need to find one good reason why it will.', 'Robert Anthony', '1'),
(512, 'It is the mark of an educated mind to be able to entertain a thought without accepting it.', 'Aristotle', '1'),
(513, 'Love is never lost. If not reciprocated, it will flow back and soften and purify the heart.', 'Washington Irving', '1'),
(514, 'We all live with the objective of being happy; our lives are all different and yet the same.', 'Anne Frank', '1'),
(515, 'Many people think of prosperity that concerns money only to forget that true prosperity is of the mind.', 'Byron Pulsifer', '1');
INSERT INTO `quotes` (`ID`, `Quote`, `Author`, `Quote_type`) VALUES
(516, 'To be beautiful means to be yourself. You do not need to be accepted by others. You need to accept yourself.', 'Thich Nhat Hanh', '1'),
(517, 'Do not overrate what you have received, nor envy others. He who envies others does not obtain peace of mind.', 'Buddha', '1'),
(518, 'It is very easy to forgive others their mistakes; it takes more grit to forgive them for having witnessed your own.', 'Jessamyn West', '1'),
(519, 'Bodily exercise, when compulsory, does no harm to the body; but knowledge which is acquired under compulsion obtains no hold on the mind.', 'Plato', '1'),
(520, 'Always be yourself, express yourself, have faith in yourself, do not go out and look for a successful personality and duplicate it.', 'Bruce Lee', '1'),
(521, 'Let us revere, let us worship, but erect and open-eyed, the highest, not the lowest; the future, not the past!', 'Charlotte Gilman', '1'),
(522, 'Every time you smile at someone, it is an action of love, a gift to that person, a beautiful thing.', 'Mother Teresa', '1'),
(523, 'Silences make the real conversations between friends. Not the saying but the never needing to say is what counts.', 'Margaret Runbeck', '1'),
(524, 'The key to transforming our hearts and minds is to have an understanding of how our thoughts and emotions work.', 'Dalai Lama', '1'),
(525, 'If you must tell me your opinions, tell me what you believe in. I have plenty of douts of my own.', 'Johann Wolfgang von Goethe', '1'),
(526, 'Chance is always powerful. Let your hook be always cast; in the pool where you least expect it, there will be a fish.', 'Ovid', '1'),
(527, 'I seek constantly to improve my manners and graces, for they are the sugar to which all are attracted.', 'Og Mandino', '1'),
(528, 'We never understand how little we need in this world until we know the loss of it.', 'James Barrie', '1'),
(529, 'The real measure of your wealth is how much youd be worth if you lost all your money.', 'Anonymous', '1'),
(530, 'To keep the body in good health is a duty... otherwise we shall not be able to keep our mind strong and clear.', 'Buddha', '1'),
(531, 'Take no thought of who is right or wrong or who is better than. Be not for or against.', 'Bruce Lee', '1'),
(532, 'I am a man of fixed and unbending principles, the first of which is to be flexible at all times.', 'Everett Dirksen', '1'),
(533, 'Today, give a stranger a smile without waiting for it may be the joy they need to have a great day.', 'Byron Pulsifer', '1'),
(534, 'The moment one gives close attention to anything, even a blade of grass, it becomes a mysterious, awesome, indescribably magnificent world in itself.', 'Henry Miller', '1'),
(535, 'At the center of your being you have the answer; you know who you are and you know what you want.', 'Lao Tzu', '1'),
(536, 'How wonderful that we have met with a paradox. Now we have some hope of making progress.', 'Niels Bohr', '1'),
(537, 'Everyone is a genius at least once a year. A real genius has his original ideas closer together.', 'Georg Lichtenberg', '1'),
(538, 'Dreams pass into the reality of action. From the actions stems the dream again; and this interdependence produces the highest form of living.', 'Anais Nin', '1'),
(539, 'Without leaps of imagination, or dreaming, we lose the excitement of possibilities. Dreaming, after all, is a form of planning.', 'Gloria Steinem', '1'),
(540, 'Sadness may be part of life but there is no need to let it dominate your entire life.', 'Byron Pulsifer', '1'),
(541, 'Keeping a little ahead of conditions is one of the secrets of business, the trailer seldom goes far.', 'Charles Schwab', '1'),
(542, 'Nature gave us one tongue and two ears so we could hear twice as much as we speak.', 'Epictetus', '1'),
(543, 'Don\'t wait for your feelings to change to take the action. Take the action and your feelings will change.', 'Barbara Baron', '1'),
(544, 'You are always free to change your mind and choose a different future, or a different past.', 'Richard Bach', '1'),
(545, 'You were not born a winner, and you were not born a loser. You are what you make yourself be.', 'Lou Holtz', '1'),
(546, 'Cherish your visions and your dreams as they are the children of your soul, the blueprints of your ultimate achievements.', 'Napoleon Hill', '1'),
(547, 'Cherish your visions and your dreams as they are the children of your soul; the blueprints of your ultimate achievements.', 'Napoleon Hill', '1'),
(548, 'To be what we are, and to become what we are capable of becoming, is the only end of life.', 'Robert Stevenson', '1'),
(549, 'The road leading to a goal does not separate you from the destination; it is essentially a part of it.', 'Charles DeLint', '1'),
(550, 'Take things as they are. Punch when you have to punch. Kick when you have to kick.', 'Bruce Lee', '1'),
(551, 'I believe that a simple and unassuming manner of life is best for everyone, best both for the body and the mind.', 'Albert Einstein', '1'),
(552, 'Though no one can go back and make a brand new start, anyone can start from now and make a brand new ending.', 'Anonymous', '1'),
(553, 'Mind is everything: muscle, pieces of rubber. All that I am, I am because of my mind.', 'Paavo Nurmi', '1'),
(554, 'How wonderful it is that nobody need wait a single moment before starting to improve the world.', 'Anne Frank', '1'),
(555, 'A friend is someone who understands your past, believes in your future, and accepts you just the way you are.', 'Anonymous', '1'),
(556, 'It is one of the blessings of old friends that you can afford to be stupid with them.', 'Ralph Emerson', '1'),
(557, 'He that never changes his opinions, never corrects his mistakes, and will never be wiser on the morrow than he is today.', 'Tryon Edwards', '1'),
(558, 'Give me six hours to chop down a tree and I will spend the first four sharpening the axe.', 'Abraham Lincoln', '1'),
(559, 'One must be fond of people and trust them if one is not to make a mess of life.', 'E. M. Forster', '1'),
(560, 'We cannot change our memories, but we can change their meaning and the power they have over us.', 'David Seamans', '1'),
(561, 'Being in humaneness is good. If we select other goodness and thus are far apart from humaneness, how can we be the wise?', 'Confucius', '1'),
(562, 'To give hope to someone occurs when you teach them how to use the tools to do it for themselves.', 'Byron Pulsifer', '1'),
(563, 'Id rather regret the things that I have done than the things that I have not done.', 'Lucille Ball', '1'),
(564, 'The past has no power to stop you from being present now. Only your grievance about the past can do that.', 'Eckhart Tolle', '1'),
(565, 'If the stars should appear but one night every thousand years how man would marvel and adore.', 'Ralph Emerson', '1'),
(566, 'There are two kinds of failures: those who thought and never did, and those who did and never thought.', 'Laurence J. Peter', '1'),
(567, 'I\'m not interested in age. People who tell me their age are silly. You\'re as old as you feel.', 'Elizabeth Arden', '1'),
(568, 'I find hope in the darkest of days, and focus in the brightest. I do not judge the universe.', 'Dalai Lama', '1'),
(569, 'When it is obvious that the goals cannot be reached, don\'t adjust the goals, adjust the action steps.', 'Confucius', '1'),
(570, 'Our virtues and our failings are inseparable, like force and matter. When they separate, man is no more.', 'Nikola Tesla', '1'),
(571, 'Blessed is the person who is too busy to worry in the daytime, and too sleepy to worry at night.', 'Leo Aikman', '1'),
(572, 'He can who thinks he can, and he can\'t who thinks he can\'t. This is an inexorable, indisputable law.', 'Pablo Picasso', '1'),
(573, 'These days people seek knowledge, not wisdom. Knowledge is of the past, wisdom is of the future.', 'Vernon Cooper', '1'),
(574, 'One secret of success in life is for a man to be ready for his opportunity when it comes.', 'Benjamin Disraeli', '1'),
(575, 'People take different roads seeking fulfilment and happiness. Just because theyre not on your road doesn\'t mean they\'ve gotten lost.', 'Dalai Lama', '1'),
(576, 'The shoe that fits one person pinches another; there is no recipe for living that suits all cases.', 'Carl Jung', '1'),
(577, 'There are only two mistakes one can make along the road to truth; not going all the way, and not starting.', 'Buddha', '1'),
(578, 'Very little is needed to make a happy life; it is all within yourself, in your way of thinking.', 'Marcus Aurelius', '1'),
(579, 'Giving up doesn\'t always mean you are weak. Sometimes it means that you are strong enough to let go.', 'Anonymous', '1'),
(580, 'Treat people as if they were what they ought to be and you help them to become what they are capable of being.', 'Johann Wolfgang von Goethe', '1'),
(581, 'The most precious gift we can offer anyone is our attention. When mindfulness embraces those we love, they will bloom like flowers.', 'Thich Nhat Hanh', '1'),
(582, 'If you focus on results, you will never change. If you focus on change, you will get results.', 'Jack Dixon', '1'),
(583, 'I would maintain that thanks are the highest form of thought, and that gratitude is happiness doubled by wonder.', 'G. K. Chesterton', '1'),
(584, 'There are two primary choices in life: to accept conditions as they exist, or accept the responsibility for changing them.', 'Denis Waitley', '1'),
(585, 'All difficult things have their origin in that which is easy, and great things in that which is small.', 'Lao-Tzu', '1'),
(586, 'You can be what you want to be. You have the power within and we will help you always.', 'Byron Pulsifer', '1'),
(587, 'To speak gratitude is courteous and pleasant, to enact gratitude is generous and noble, but to live gratitude is to touch Heaven.', 'Johannes Gaertner', '1'),
(588, 'Wisdom is the reward you get for a lifetime of listening when you\'d have preferred to talk.', 'Doug Larson', '1'),
(589, 'The greatest pleasure I know is to do a good action by stealth, and to have it found out by accident.', 'Charles Lamb', '1'),
(590, 'When one tugs at a single thing in nature, he finds it attached to the rest of the world.', 'John Muir', '1'),
(591, 'Courage is what it takes to stand up and speak; courage is also what it takes to sit down and listen.', 'Winston Churchill', '1'),
(592, 'The most beautiful things in the world cannot be seen or even touched. They must be felt with the heart.', 'Helen Keller', '1'),
(593, 'To live a pure unselfish life, one must count nothing as ones own in the midst of abundance.', 'Buddha', '1'),
(594, 'Many of life\'s failures are people who did not realize how close they were to success when they gave up.', 'Thomas Edison', '1'),
(595, 'When we seek to discover the best in others, we somehow bring out the best in ourselves.', 'William Ward', '1'),
(596, 'If you accept the expectations of others, especially negative ones, then you never will change the outcome.', 'Michael Jordan', '1'),
(597, 'A man may fulfil the object of his existence by asking a question he cannot answer, and attempting a task he cannot achieve.', 'Oliver Holmes', '1'),
(598, 'I am not bothered by the fact that I am unknown. I am bothered when I do not know others.', 'Confucius', '1'),
(599, 'He is a wise man who does not grieve for the things which he has not, but rejoices for those which he has.', 'Epictetus', '1'),
(600, 'I am always doing that which I cannot do, in order that I may learn how to do it.', 'Pablo Picasso', '1'),
(601, 'If you\'re walking down the right path and you\'re willing to keep walking, eventually you\'ll make progress.', 'Barack Obama', '1'),
(602, 'The world is round and the place which may seem like the end may also be the beginning.', 'Ivy Baker Priest', '1'),
(603, 'Never miss an opportunity to make others happy, even if you have to leave them alone in order to do it.', 'Anonymous', '1'),
(604, 'Give it all you\'ve got because you never know if there\'s going to be a next time.', 'Danielle Ingrum', '1'),
(605, 'You have to take it as it happens, but you should try to make it happen the way you want to take it.', 'Old German proverb', '1'),
(606, 'Nothing is predestined: The obstacles of your past can become the gateways that lead to new beginnings.', 'Ralph Blum', '1'),
(607, 'I\'m not in this world to live up to your expectations and you\'re not in this world to live up to mine.', 'Bruce Lee', '1'),
(608, 'Sometimes your joy is the source of your smile, but sometimes your smile can be the source of your joy.', 'Thich Nhat Hanh', '1'),
(609, 'I can\'t imagine a person becoming a success who doesn\'t give this game of life everything hes got.', 'Walter Cronkite', '1'),
(610, 'The greatest way to live with honor in this world is to be what we pretend to be.', 'Socrates', '1'),
(611, 'The conditions of conquest are always easy. We have but to toil awhile, endure awhile, believe always, and never turn back.', 'Seneca', '1'),
(612, 'The grand essentials of happiness are: something to do, something to love, and something to hope for.', 'Chalmers', '1'),
(613, 'By living deeply in the present moment we can understand the past better and we can prepare for a better future.', 'Thich Nhat Hanh', '1'),
(614, 'Do not be too timid and squeamish about your reactions. All life is an experiment. The more experiments you make the better.', 'Ralph Emerson', '1'),
(615, 'Do not go where the path may lead, go instead where there is no path and leave a trail.', 'Ralph Emerson', '1'),
(616, 'There is no duty we so underrate as the duty of being happy. By being happy we sow anonymous benefits upon the world.', 'Robert Louis Stevenson', '1'),
(617, 'Edison failed 10,000 times before he made the electric light. Do not be discouraged if you fail a few times.', 'Napoleon Hill', '1'),
(618, 'Yesterday is history. Tomorrow is a mystery. And today? Today is a gift that\'s why they call it the present.', 'Anonymous', '1'),
(619, 'The only way to tell the truth is to speak with kindness. Only the words of a loving man can be heard.', 'Henry Thoreau', '1'),
(620, 'The greatest good you can do for another is not just to share your riches but to reveal to him his own.', 'Benjamin Disraeli', '1'),
(621, 'You can only grow if you\'re willing to feel awkward and uncomfortable when you try something new.', 'Brian Tracy', '1'),
(622, 'To free us from the expectations of others, to give us back to ourselves there lies the great, singular power of self-respect.', 'Joan Didion', '1'),
(623, 'It is more important to know where you are going than to get there quickly. Do not mistake activity for achievement.', 'Mabel Newcomber', '1'),
(624, 'When you don\'t know what you believe, everything becomes an argument. Everything is debatable. But when you stand for something, decisions are obvious.', 'Anonymous', '1'),
(625, 'Intuition is the supra-logic that cuts out all the routine processes of thought and leaps straight from the problem to the answer.', 'Robert Graves', '1'),
(626, 'The thing always happens that you really believe in; and the belief in a thing makes it happen.', 'Frank Wright', '1'),
(627, 'A true friend is the most precious of all possessions and the one we take the least thought about acquiring.', 'Francois de La Rochefoucauld', '1'),
(628, 'There is only one way to happiness and that is to cease worrying about things which are beyond the power of our will.', 'Epictetus', '1'),
(629, 'Appreciation can make a day, even change a life. Your willingness to put it into words is all that is necessary.', 'Margaret Cousins', '1'),
(630, 'Every sixty seconds you spend angry, upset or mad, is a full minute of happiness you will never get back.', 'Anonymous', '1'),
(631, 'This world, after all our science and sciences, is still a miracle; wonderful, inscrutable, magical and more, to whosoever will think of it.', 'Thomas Carlyle', '1'),
(632, 'Every great mistake has a halfway moment, a split second when it can be recalled and perhaps remedied.', 'Pearl Buck', '1'),
(633, 'You can adopt the attitude there is nothing you can do, or you can see the challenge as your call to action.', 'Catherine Pulsifer', '1'),
(634, 'The happiness of a man in this life does not consist in the absence but in the mastery of his passions.', 'Alfred Tennyson', '1'),
(635, 'Never doubt that a small group of thoughtful, committed people can change the world. Indeed. It is the only thing that ever has.', 'Margaret Mead', '1'),
(636, 'Let your hook always be cast; in the pool where you least expect it, there will be a fish.', 'Ovid', '1'),
(637, 'You get peace of mind not by thinking about it or imagining it, but by quietening and relaxing the restless mind.', 'Remez Sasson', '1'),
(638, 'Your friends will know you better in the first minute you meet than your acquaintances will know you in a thousand years.', 'Richard Bach', '1'),
(639, 'When you are content to be simply yourself and don\'t compare or compete, everybody will respect you.', 'Lao Tzu', '1'),
(640, 'When you begin to touch your heart or let your heart be touched, you begin to discover that it\'s bottomless.', 'Pema Chodron', '1'),
(641, 'If you love someone, set them free. If they come back they\'re yours; if they don\'t they never were.', 'Richard Bach', '1'),
(642, 'Wisdom is knowing what to do next; Skill is knowing how ot do it, and Virtue is doing it.', 'David Jordan', '1'),
(643, 'Bad things are not the worst things that can happen to us. Nothing is the worst thing that can happen to us!', 'Richard Bach', '1'),
(644, 'No valid plans for the future can be made by those who have no capacity for living now.', 'Alan Watts', '1'),
(645, 'The aim of life is self-development. To realize ones nature perfectly that is what each of us is here for.', 'Oscar Wilde', '1'),
(646, 'To accomplish great things, we must not only act, but also dream; not only plan, but also believe.', 'Anatole France', '1'),
(647, 'The first requisite for success is the ability to apply your physical and mental energies to one problem incessantly without growing weary.', 'Thomas Edison', '1'),
(648, 'If we could learn to like ourselves, even a little, maybe our cruelties and angers might melt away.', 'John Steinbeck', '1'),
(649, 'If we are facing in the right direction, all we have to do is keep on walking.', 'Anonymous', '1'),
(650, 'Remember always that you not only have the right to be an individual, you have an obligation to be one.', 'Eleanor Roosevelt', '1'),
(651, 'There are two primary choices in life: to accept conditions as they exist, or accept responsibility for changing them.', 'Denis Waitley', '1'),
(652, 'If you seek truth you will not seek victory by dishonourable means, and if you find truth you will become invincible.', 'Epictetus', '1'),
(653, 'Through meditation and by giving full attention to one thing at a time, we can learn to direct attention where we choose.', 'Eknath Easwaran', '1'),
(654, 'We could never learn to be brave and patient if there were only joy in the world.', 'Helen Keller', '1'),
(655, 'If it is not right do not do it; if it is not true do not say it.', 'Marcus Aurelius', '1'),
(656, 'The truth of the matter is that you always know the right thing to do. The hard part is doing it.', 'Norman Schwarzkopf', '1'),
(657, 'Some people thrive on huge, dramatic change. Some people prefer the slow and steady route. Do what\'s right for you.', 'Julie Morgenstern', '1'),
(658, 'Man is equally incapable of seeing the nothingness from which he emerges and the infinity in which he is engulfed.', 'Blaise Pascal', '1'),
(659, 'Arrogance and rudeness are training wheels on the bicycle of life for weak people who cannot keep their balance without them.', 'Laura Teresa Marquez', '1'),
(660, 'If you are patient in one moment of anger, you will escape one hundred days of sorrow.', 'Chinese proverb', '1'),
(661, 'When you have got an elephant by the hind legs and he is trying to run away, it\'s best to let him run.', 'Abraham Lincoln', '1'),
(662, 'Courage is not about taking risks unknowingly, but putting your own being in front of challenges that others may not be able to.', 'Byron Pulsifer', '1'),
(663, 'Can miles truly separate you from friends... If you want to be with someone you love, aren\'t you already there?', 'Richard Bach', '1'),
(664, 'The poor man is not he who is without a cent, but he who is without a dream.', 'Harry Kemp', '1'),
(665, 'The greatest good you can do for another is not just share your riches, but reveal to them their own.', 'Benjamin Disraeli', '1'),
(666, 'Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment.', 'Buddha', '1'),
(667, 'Peace of mind is not the absence of conflict from life, but the ability to cope with it.', 'Anonymous', '1'),
(668, 'Face your deficiencies and acknowledge them; but do not let them master you. Let them teach you patience, sweetness, insight.', 'Helen Keller', '1'),
(669, 'Change is the law of life. And those who look only to the past or present are certain to miss the future.', 'John Kennedy', '1'),
(670, 'You have power over your mind not outside events. Realize this, and you will find strength.', 'Marcus Aurelius', '1'),
(671, 'Let me tell you the secret that has led me to my goal: my strength lies solely in my tenacity.', 'Louis Pasteur', '1'),
(672, 'We are what we think. All that we are arises with our thoughts. With our thoughts, we make the world.', 'Buddha', '1'),
(673, 'He that respects himself is safe from others; he wears a coat of mail that none can pierce.', 'Henry Longfellow', '1'),
(674, 'I cannot always control what goes on outside. But I can always control what goes on inside.', 'Wayne Dyer', '1'),
(675, 'What matters is the value we\'ve created in our lives, the people we\'ve made happy and how much we\'ve grown as people.', 'Daisaku Ikeda', '1'),
(676, 'When you are offended at any man\'s fault, turn to yourself and study your own failings. Then you will forget your anger.', 'Epictetus', '1'),
(677, 'Everyone has been made for some particular work, and the desire for that work has been put in every heart.', 'Rumi', '1'),
(678, 'Take time to deliberate, but when the time for action has arrived, stop thinking and go in.', 'Napoleon Bonaparte', '1'),
(679, 'With realization of ones own potential and self-confidence in ones ability, one can build a better world.', 'Dalai Lama', '1'),
(680, 'Happiness is not in the mere possession of money; it lies in the joy of achievement, in the thrill of creative effort.', 'Franklin Roosevelt', '1'),
(681, 'You cannot make yourself feel something you do not feel, but you can make yourself do right in spite of your feelings.', 'Pearl Buck', '1'),
(682, 'Those who are blessed with the most talent don\'t necessarily outperform everyone else. It\'s the people with follow-through who excel.', 'Mary Kay Ash', '1'),
(683, 'Try not to become a man of success, but rather try to become a man of value.', 'Albert Einstein', '1'),
(684, 'All difficult things have their origin in that which is easy, and great things in that which is small.', 'Lao Tzu', '1'),
(685, 'Men of perverse opinion do not know the excellence of what is in their hands, till some one dash it from them.', 'Sophocles', '1'),
(686, 'It is not enough to have a good mind; the main thing is to use it well.', 'Rene Descartes', '1'),
(687, 'Responsibility is not inherited, it is a choice that everyone needs to make at some point in their life.', 'Byron Pulsifer', '1'),
(688, 'Never do things others can do and will do, if there are things others cannot do or will not do.', 'Amelia Earhart', '1'),
(689, 'I can\'t change the direction of the wind, but I can adjust my sails to always reach my destination.', 'Jimmy Dean', '1'),
(690, 'People of mediocre ability sometimes achieve outstanding success because they don\'t know when to quit. Most men succeed because they are determined to.', 'George Allen', '1'),
(691, 'A fine quotation is a diamond on the finger of a man of wit, and a pebble in the hand of a fool.', 'Joseph Roux', '1'),
(692, 'Life\'s challenges are not supposed to paralyse you, they\'re supposed to help you discover who you are.', 'Bernice Reagon', '1'),
(693, 'The greatest way to live with honour in this world is to be what we pretend to be.', 'Socrates', '1'),
(694, 'To exist is to change, to change is to mature, to mature is to go on creating oneself endlessly.', 'Henri Bergson', '1'),
(695, 'Try not to become a man of success but rather try to become a man of value.', 'Albert Einstein', '1'),
(696, 'You can\'t create in a vacuum. Life gives you the material and dreams can propel new beginnings.', 'Byron Pulsifer', '1'),
(697, 'Your work is to discover your world and then with all your heart give yourself to it.', 'Buddha', '1'),
(698, 'The person who lives life fully, glowing with life\'s energy, is the person who lives a successful life.', 'Daisaku Ikeda', '1'),
(699, 'Don\'t turn away from possible futures before you\'re certain you don\'t have anything to learn from them.', 'Richard Bach', '1'),
(700, 'A successful person is one who can lay a firm foundation with the bricks that others throw at him or her.', 'David Brinkley', '1'),
(701, 'All that we are is the result of what we have thought. The mind is everything. What we think we become.', 'Buddha', '1'),
(702, 'Work while you have the light. You are responsible for the talent that has been entrusted to you.', 'Henri-Frederic Amiel', '1'),
(703, 'How far that little candle throws its beams! So shines a good deed in a naughty world.', 'William Shakespeare', '1'),
(704, 'Every adversity, every failure, every heartache carries with it the seed of an equal or greater benefit.', 'Napoleon Hill', '1'),
(705, 'It is in your moments of decision that your destiny is shaped.', 'Tony Robbins', '1'),
(706, 'An obstacle may be either a stepping stone or a stumbling block.', 'Anonymous', '1'),
(707, 'The pain passes, but the beauty remains.', 'Pierre Auguste Renoir', '1'),
(708, 'All I can say about life is, Oh God, enjoy it!', 'Bob Newhart', '1'),
(709, 'Creativity comes from trust. Trust your instincts. And never hope more than you work.', 'Rita Mae Brown', '1'),
(710, 'Your outlook on life is a direct reflection on how much you like yourself.', 'Lululemon', '1'),
(711, 'I have just three things to teach: simplicity, patience, compassion. These three are your greatest treasures.', 'Lao Tzu', '1'),
(712, 'You won\'t skid if you stay in a rut.', 'Kin Hubbard', '1'),
(713, 'You block your dream when you allow your fear to grow bigger than your faith.', 'Mary Morrissey', '1'),
(714, 'Happiness depends upon ourselves.', 'Aristotle', '1'),
(715, 'Wherever a man turns he can find someone who needs him.', 'Albert Schweitzer', '1'),
(716, 'If one is lucky, a solitary fantasy can totally transform one million realities.', 'Maya Angelou', '1'),
(717, 'Never idealize others. They will never live up to your expectations.', 'Leo Buscaglia', '1'),
(718, 'When you realize there is nothing lacking, the whole world belongs to you.', 'Lao Tzu', '1'),
(719, 'Happiness is not something ready made. It comes from your own actions.', 'Dalai Lama', '1'),
(720, 'Meaning is not what you start with but what you end up with.', 'Peter Elbow', '1'),
(721, 'No one has ever become poor by giving.', 'Anne Frank', '1'),
(722, 'Be faithful in small things because it is in them that your strength lies.', 'Mother Teresa', '1'),
(723, 'All is flux; nothing stays still.', 'Heraclitus', '1'),
(724, 'He who is fixed to a star does not change his mind.', 'Leonardo da Vinci', '1'),
(725, 'He who lives in harmony with himself lives in harmony with the universe.', 'Marcus Aurelius', '1'),
(726, 'Ignorant men don\'t know what good they hold in their hands until they\'ve flung it away.', 'Sophocles', '1'),
(727, 'When the solution is simple, God is answering.', 'Albert Einstein', '1'),
(728, 'All achievements, all earned riches, have their beginning in an idea.', 'Napoleon Hill', '1'),
(729, 'Do not turn back when you are just at the goal.', 'Publilius Syrus', '1'),
(730, 'You can\'t trust without risk but neither can you live in a cocoon.', 'Byron Pulsifer', '1'),
(731, 'All perceiving is also thinking, all reasoning is also intuition, all observation is also invention.', 'Rudolf Arnheim', '1'),
(732, 'Error is discipline through which we advance.', 'Channing', '1'),
(733, 'The truth is always exciting. Speak it, then. Life is dull without it.', 'Pearl Buck', '1'),
(734, 'The superior man is modest in his speech, but exceeds in his actions.', 'Confucius', '1'),
(735, 'The longer we dwell on our misfortunes, the greater is their power to harm us.', 'Voltaire', '1'),
(736, 'Those who will play with cats must expect to be scratched.', 'Cervantes', '1'),
(737, 'I\'ve never seen a smiling face that was not beautiful.', 'Anonymous', '1'),
(738, 'In all things of nature there is something of the marvellous.', 'Aristotle', '1'),
(739, 'The universe is transformation; our life is what our thoughts make it.', 'Marcus Aurelius', '1'),
(740, 'Memory is the mother of all wisdom.', 'Samuel Johnson', '1'),
(741, 'Silence is the true friend that never betrays.', 'Confucius', '1'),
(742, 'You might well remember that nothing can bring you success but yourself.', 'Napoleon Hill', '1'),
(743, 'Watch the little things; a small leak will sink a great ship.', 'Benjamin Franklin', '1'),
(744, 'God has given you one face, and you make yourself another.', 'William Shakespeare', '1'),
(745, 'To be wronged is nothing unless you continue to remember it.', 'Confucius', '1'),
(746, 'Kindness is the greatest wisdom.', 'Anonymous', '1'),
(747, 'Action will remove the doubts that theory cannot solve.', 'Tehyi Hsieh', '1'),
(748, 'Don\'t miss all the beautiful colors of the rainbow looking for that pot of gold.', 'Anonymous', '1'),
(749, 'Your big opportunity may be right where you are now.', 'Napoleon Hill', '1'),
(750, 'People who say it cannot be done should not interrupt those who are doing it.', 'Chinese proverb', '1'),
(751, 'The day you decide to do it is your lucky day.', 'Japanese proverb', '1'),
(752, 'We must not say every mistake is a foolish one.', 'Cicero', '1'),
(753, 'Accept challenges, so that you may feel the exhilaration of victory.', 'George Patton', '1'),
(754, 'It is better to understand a little than to misunderstand a lot.', 'Anatole France', '1'),
(755, 'You don\'t drown by falling in water. You drown by staying there.', 'Anonymous', '1'),
(756, 'Never be afraid to try, remember... Amateurs built the ark, Professionals built the Titanic.', 'Anonymous', '1'),
(757, 'Correction does much, but encouragement does more.', 'Johann Wolfgang von Goethe', '1'),
(758, 'Know, first, who you are, and then adorn yourself accordingly.', 'Epictetus', '1'),
(759, 'The biggest adventure you can ever take is to live the life of your dreams.', 'Oprah Winfrey', '1'),
(760, 'Life is 10% what happens to you and 90% how you react to it.', 'Charles Swindoll', '1'),
(761, 'To want to be what one can be is purpose in life.', 'Cynthia Ozick', '1'),
(762, 'Remember that sometimes not getting what you want is a wonderful stroke of luck.', 'Dalai Lama', '1'),
(763, 'History will be kind to me for I intend to write it.', 'Winston Churchill', '1'),
(764, 'Our lives are a sum total of the choices we have made.', 'Wayne Dyer', '1'),
(765, 'Time stays long enough for anyone who will use it.', 'Leonardo da Vinci', '1'),
(766, 'You must welcome change as the rule but not as your ruler.', 'Denis Waitley', '1'),
(767, 'Give whatever you are doing and whoever you are with the gift of your attention.', 'Jim Rohn', '1'),
(768, 'Always be smarter than the people who hire you.', 'Lena Horne', '1'),
(769, 'Formula for success: under promise and over deliver.', 'Tom Peters', '1'),
(770, 'The eye sees only what the mind is prepared to comprehend.', 'Henri Bergson', '1'),
(771, 'People seldom notice old clothes if you wear a big smile.', 'Lee Mildon', '1'),
(772, 'The more light you allow within you, the brighter the world you live in will be.', 'Shakti Gawain', '1'),
(773, 'Nothing diminishes anxiety faster than action.', 'Walter Anderson', '1'),
(774, 'Man cannot discover new oceans unless he has the courage to lose sight of the shore.', 'Andre Gide', '1'),
(775, 'Everything that irritates us about others can lead us to an understanding about ourselves.', 'Carl Jung', '1'),
(776, 'Can you imagine what I would do if I could do all I can?', 'Sun Tzu', '1'),
(777, 'Ignorance never settle a question.', 'Benjamin Disraeli', '1'),
(778, 'The awareness of our own strength makes us modest.', 'Paul Cezanne', '1'),
(779, 'They must often change, who would be constant in happiness or wisdom.', 'Confucius', '1'),
(780, 'There are no failures. Just experiences and your reactions to them.', 'Tom Krause', '1'),
(781, 'Your future depends on many things, but mostly on you.', 'Frank Tyger', '1'),
(782, 'Fear grows in darkness; if you think theres a bogeyman around, turn on the light.', 'Dorothy Thompson', '1'),
(783, 'The most important point is to accept yourself and stand on your two feet.', 'Shunryu Suzuki', '1'),
(784, 'Do not expect the world to look bright, if you habitually wear gray-brown glasses.', 'Tomas Eliot', '1'),
(785, 'As long as your going to be thinking anyway, think big.', 'Donald Trump', '1'),
(786, 'Without some goals and some efforts to reach it, no man can live.', 'John Dewey', '1'),
(787, 'He who obtains has little. He who scatters has much.', 'Richard Braunstein', '1'),
(788, 'Myths which are believed in tend to become true.', 'George Orwell', '1'),
(789, 'The foot feels the foot when it feels the ground.', 'Buddha', '1'),
(790, 'Not what we have but what we enjoy constitutes our abundance.', 'John Petit-Senn', '1'),
(791, 'It is never too late to be what you might have been.', 'George Eliot', '1'),
(792, 'The beginning is always today.', 'Mary Wollstonecraft', '1'),
(793, 'In the long run we get no more than we have been willing to risk giving.', 'Sheldon Kopp', '1'),
(794, 'Self-trust is the first secret of success.', 'Ralph Emerson', '1'),
(795, 'Don\'t look back. Something might be gaining on you.', 'Satchel Paige', '1'),
(796, 'Look back over the past, with its changing empires that rose and fell, and you can foresee the future, too.', 'Marcus Aurelius', '1'),
(797, 'A life spent making mistakes is not only more honourable, but more useful than a life spent doing nothing.', 'George Bernard Shaw', '1'),
(798, 'Men are disturbed not by things, but by the view which they take of them.', 'Epictetus', '1'),
(799, 'Imagination disposes of everything; it creates beauty, justice, and happiness, which are everything in this world.', 'Blaise Pascal', '1'),
(800, 'Happiness is a Swedish sunset it is there for all, but most of us look the other way and lose it.', 'Mark Twain', '1'),
(801, 'A smile is a light in the window of your face to show your heart is at home.', 'Anonymous', '1'),
(802, 'Look forward to spring as a time when you can start to see what nature has to offer once again.', 'Byron Pulsifer', '1'),
(803, 'Trust your own instinct. Your mistakes might as well be your own, instead of someone elses.', 'Billy Wilder', '1'),
(804, 'The least movement is of importance to all nature. The entire ocean is affected by a pebble.', 'Blaise Pascal', '1'),
(805, 'I am always doing that which I can not do, in order that I may learn how to do it.', 'Pablo Picasso', '1'),
(806, 'Men in general judge more from appearances than from reality. All men have eyes, but few have the gift of penetration.', 'Niccolo Machiavelli', '1'),
(807, 'You may only be someone in the world, but to someone else, you may be the world.', 'Anonymous', '1'),
(808, 'Every artist dips his brush in his own soul, and paints his own nature into his pictures.', 'Henry Ward Beecher', '1'),
(809, 'If you take each challenge one step at a time, with faith in every footstep, your strength and understanding will increase.', 'James Faust', '1'),
(810, 'Happiness cannot be travelled to, owned, earned, worn or consumed. Happiness is the spiritual experience of living every minute with love, grace and gratitude.', 'Denis Waitley', '1'),
(811, 'Everyone should carefully observe which way his heart draws him, and then choose that way with all his strength.', 'Hasidic saying', '1'),
(812, 'When we quit thinking primarily about ourselves and our own self-preservation, we undergo a truly heroic transformation of consciousness.', 'Joseph Campbell', '1'),
(813, 'Follow effective action with quiet reflection. From the quiet reflection will come even more effective action.', 'Peter Drucker', '1'),
(814, 'Life\'s challenges are not supposed to paralyze you, they\'re supposed to help you discover who you are.', 'Bernice Reagon', '1'),
(815, 'There is one thing you have got to learn about our movement. Three people are better than no people.', 'Fannie Hamer', '1'),
(816, 'Happiness is a perfume you cannot pour on others without getting a few drops on yourself.', 'Ralph Waldo Emerson', '1'),
(817, 'It is not the mistake that has the most power, instead, it is learning from the mistake to advance your own attributes.', 'Byron Roberts', '1'),
(818, 'The amount of happiness that you have depends on the amount of freedom you have in your heart.', 'Thich Nhat Hanh', '1'),
(819, 'Your vision will become clear only when you look into your heart. Who looks outside, dreams. Who looks inside, awakens.', 'Carl Jung', '1'),
(820, 'Yesterday is history. Tomorrow is a mystery. And today? Today is a gift. That is why we call it the present.', 'Babatunde Olatunji', '1'),
(821, 'The way we communicate with others and with ourselves ultimately determines the quality of our lives.', 'Tony Robbins', '1'),
(822, 'Sometimes it is better to lose and do the right thing than to win and do the wrong thing.', 'Tony Blair', '1'),
(823, 'Let us always meet each other with smile, for the smile is the beginning of love.', 'Mother Teresa', '1'),
(824, 'A bend in the road is not the end of the road...unless you fail to make the turn.', 'Anonymous', '1'),
(825, 'We are what we repeatedly do. Excellence, then, is not an act, but a habit.', 'Aristotle', '1'),
(826, 'Living at risk is jumping off the cliff and building your wings on the way down.', 'Ray Bradbury', '1'),
(827, 'In the depth of winter, I finally learned that there was within me an invincible summer.', 'Albert Camus', '1'),
(828, 'Wit lies in recognizing the resemblance among things which differ and the difference between things which are alike.', 'Madame de Stael', '1'),
(829, 'A failure is a man who has blundered but is not capable of cashing in on the experience.', 'Elbert Hubbard', '1'),
(830, 'I cannot give you the formula for success, but I can give you the formula for failure: which is: Try to please everybody.', 'Herbert Swope', '1'),
(831, 'One who asks a question is a fool for five minutes; one who does not ask a question remains a fool forever.', 'Anonymous', '1'),
(832, 'The power of intuitive understanding will protect you from harm until the end of your days.', 'Laozi', '1'),
(833, 'The best thing about the future is that it only comes one day at a time.', 'Abraham Lincoln', '1'),
(834, 'We have two ears and one mouth so that we can listen twice as much as we speak.', 'Epictetus', '1'),
(835, 'Fear of failure is one attitude that will keep you at the same point in your life.', 'Byron Pulsifer', '1'),
(836, 'Friends are those rare people who ask how we are and then wait to hear the answer.', 'Ed Cunningham', '1'),
(837, 'If we learn to open our hearts, anyone, including the people who drive us crazy, can be our teacher.', 'Pema Chodron', '1'),
(838, 'People grow through experience if they meet life honestly and courageously. This is how character is built.', 'Eleanor Roosevelt', '1'),
(839, 'A hero is no braver than an ordinary man, but he is braver five minutes longer.', 'Ralph Waldo Emerson', '1'),
(840, 'While we try to teach our children all about life, our children teach us what life is all about.', 'Angela Schwindt', '1'),
(841, 'When you dance, your purpose is not to get to a certain place on the floor. It\'s to enjoy each step along the way.', 'Wayne Dyer', '1'),
(842, 'The Creator has not given you a longing to do that which you have no ability to do.', 'Orison Marden', '1'),
(843, 'It\'s so simple to be wise. Just think of something stupid to say and then don\'t say it.', 'Sam Levenson', '1'),
(844, 'Consider that not only do negative thoughts and emotions destroy our experience of peace, they also undermine our health.', 'Dalai Lama', '1'),
(845, 'Until you make peace with who you are, you will never be content with what you have.', 'Doris Mortman', '1'),
(846, 'No one saves us but ourselves. No one can and no one may. We ourselves must walk the path.', 'Buddha', '1'),
(847, 'The moment one gives close attention to anything, it becomes a mysterious, awesome, indescribably magnificent world in itself.', 'Henry Miller', '1'),
(848, 'Happiness is when what you think, what you say, and what you do are in harmony.', 'Mohandas Gandhi', '1'),
(849, 'The greatest antidote to insecurity and the sense of fear is compassion it brings one back to the basis of one\'s inner strength', 'Dalai Lama', '1'),
(850, 'Courage is the discovery that you may not win, and trying when you know you can lose.', 'Anonymous', '1'),
(851, 'To be thoughtful and kind only takes a few seconds compared to the timeless hurt caused by one rude gesture.', 'Byron Pulsifer', '1'),
(852, 'The purpose of learning is growth, and our minds, unlike our bodies, can continue growing as we continue to live.', 'Mortimer Adler', '1'),
(853, 'When you realize how perfect everything is you will tilt your head back and laugh at the sky.', 'Buddha', '1'),
(854, 'For every failure, there\'s an alternative course of action. You just have to find it. When you come to a roadblock, take a detour.', 'Mary Kay Ash', '1'),
(855, 'It is surprising what a man can do when he has to, and how little most men will do when they don\'t have to.', 'Walter Linn', '1'),
(856, 'To be aware of a single shortcoming in oneself is more useful than to be aware of a thousand in someone else.', 'Tenzin Gyatso', '1'),
(857, 'Nobody made a greater mistake than he who did nothing because he could do only a little.', 'Edmund Burke', '1'),
(858, 'Constant kindness can accomplish much. As the sun makes ice melt, kindness causes misunderstanding, mistrust, and hostility to evaporate.', 'Albert Schweitzer', '1'),
(859, 'The greatest minds are capable of the greatest vices as well as of the greatest virtues.', 'Rene Descartes', '1'),
(860, 'A man should look for what is, and not for what he thinks should be.', 'Albert Einstein', '1'),
(861, 'Difficulties are meant to rouse, not discourage. The human spirit is to grow strong by conflict.', 'William Channing', '1'),
(862, 'If you have no respect for your own values how can you be worthy of respect from others.', 'Byron Pulsifer', '1'),
(863, 'Some people are always grumbling because roses have thorns; I am thankful that thorns have roses.', 'Alphonse Karr', '1'),
(864, 'To choose what is difficult all ones days, as if it were easy, that is faith.', 'W. H. Auden', '1'),
(865, 'Ability is what you\'re capable of doing. Motivation determines what you do.Attitude determines how well you do it.', 'Lou Holtz', '1'),
(866, 'Do not be embarrassed by your mistakes. Nothing can teach us better than our understanding of them. This is one of the best ways of self-education.', 'Thomas Carlyle', '1'),
(867, 'Thousands of candles can be lighted from a single candle, and the life of the candle will not be shortened. Happiness never decreases by being shared.', 'Buddha', '1'),
(868, 'I care not so much what I am to others as what I am to myself. I will be rich by myself, and not by borrowing.', 'Michel de Montaigne', '1'),
(869, 'Know that although in the eternal scheme of things you are small, you are also unique and irreplaceable, as are all your fellow humans everywhere in the world.', 'Margaret Laurence', '1'),
(870, 'To do all that one is able to do, is to be a man; to do all that one would like to do, is to be a god.', 'Napoleon Bonaparte', '1'),
(871, 'If you let go a little, you will have a little peace. If you let go a lot, you will have a lot of peace.', 'Ajahn Chah', '1'),
(872, 'There is no need for temples, no need for complicated philosophies. My brain and my heart are my temples; my philosophy is kindness.', 'Dalai Lama', '1'),
(873, 'The spirit, the will to win, and the will to excel, are the things that endure. These qualities are so much more important than the events that occur.', 'Vincent Lombardi', '1'),
(874, 'Man is not sum of what he has already, but rather the sum of what he does not yet have, of what he could have.', 'Jean-Paul Sartre', '1'),
(875, 'Don\'t believe what your eyes are telling you. All they show is limitation. Look with your understanding, find out what you already know, and you\'ll see the way to fly.', 'Richard Bach', '1'),
(876, 'I believe that we are solely responsible for our choices, and we have to accept the consequences of every deed, word, and thought throughout our lifetime.', 'Elisabeth Kubler-Ross', '1'),
(877, 'Wishes can be your best avenue of getting what you want when you turn wishes into action. Action moves your wish to the forefront from thought to reality.', 'Byron Pulsifer', '1'),
(878, 'To understand the heart and mind of a person, look not at what he has already achieved, but at what he aspires to do.', 'Kahlil Gibran', '1'),
(879, 'I am of the opinion that my life belongs to the community, and as long as I live it is my privilege to do for it whatever I can.', 'Bernard Shaw', '1'),
(880, 'Imagination is more important than knowledge. For while knowledge defines all we currently know and understand, imagination points to all we might yet discover and create.', 'Albert Einstein', '1'),
(881, 'When you see a good person, think of becoming like him. When you see someone not so good, reflect on your own weak points.', 'Confucius', '1'),
(882, 'If one is estranged from oneself, then one is estranged from others too. If one is out of touch with oneself, then one cannot touch others.', 'Anne Lindbergh', '1'),
(883, 'Most of the important things in the world have been accomplished by people who have kept on trying when there seemed to be no hope at all.', 'Dale Carnegie', '1'),
(884, 'You may say I\'m a dreamer, but I\'m not the only one, I hope someday you will join us, and the world will live as one.', 'John Lennon', '1'),
(885, 'Happiness is as a butterfly which, when pursued, is always beyond our grasp, but which if you will sit down quietly, may alight upon you.', 'Nathaniel Hawthorne', '1'),
(886, 'He who experiences the unity of life sees his own Self in all beings, and all beings in his own Self, and looks on everything with an impartial eye.', 'Buddha', '1'),
(887, 'In the sky, there is no distinction of east and west; people create distinctions out of their own minds and then believe them to be true.', 'Buddha', '1'),
(888, 'You cannot change anything in your life with intention alone, which can become a watered-down, occasional hope that you\'ll get to tomorrow. Intention without action is useless.', 'Caroline Myss', '1'),
(889, 'Before you can inspire with emotion, you must be swamped with it yourself. Before you can move their tears, your own must flow. To convince them, you must yourself believe.', 'Winston Churchill', '1'),
(890, 'The greatest discovery of our generation is that human beings can alter their lives by altering their attitudes of mind. As you think, so shall you be.', 'William James', '1'),
(891, 'If one advances confidently in the direction of his dream, and endeavours to live the life which he had imagines, he will meet with a success unexpected in common hours.', 'Henry David Thoreau', '1'),
(892, 'The secret of joy in work is contained in one word excellence. To know how to do something well is to enjoy it.', 'Pearl Buck', '1'),
(893, 'When you meet someone better than yourself, turn your thoughts to becoming his equal. When you meet someone not as good as you are, look within and examine your own self.', 'Confucius', '1'),
(894, 'We must overcome the notion that we must be regular. It robs you of the chance to be extraordinary and leads you to the mediocre.', 'Uta Hagen', '1'),
(895, 'Most of our obstacles would melt away if, instead of cowering before them, we should make up our minds to walk boldly through them.', 'Orison Marden', '1'),
(896, 'Everything can be taken from a man but ... the last of the human freedoms to choose ones attitude in any given set of circumstances, to choose ones own way.', 'Victor Frankl', '1'),
(897, 'It is better to have enough ideas for some of them to be wrong, than to be always right by having no ideas at all.', 'Edward de Bono', '1'),
(898, 'Character is like a tree and reputation like a shadow. The shadow is what we think of it; the tree is the real thing.', 'Abraham Lincoln', '1'),
(899, 'By letting it go it all gets done. The world is won by those who let it go. But when you try and try. The world is beyond the winning.', 'Lao Tzu', '1'),
(900, 'I am like a falling star who has finally found her place next to another in a lovely constellation, where we will sparkle in the heavens forever.', 'Amy Tan', '1'),
(901, 'Not every difficult and dangerous thing is suitable for training, but only that which is conducive to success in achieving the object of our effort.', 'Epictetus', '1'),
(902, 'We are not animals. We are not a product of what has happened to us in our past. We have the power of choice.', 'Stephen Covey', '1'),
(903, 'The most dangerous way to lose time is not to spend it having fun, but to spend it doing fake work. When you spend time having fun, you know you\'re being self-indulgent.', 'Paul Graham', '1'),
(904, 'Thousands of candles can be lit from a single, and the life of the candle will not be shortened. Happiness never decreases by being shared.', 'Buddha', '1'),
(905, 'A lot of times people look at the negative side of what they feel they can\'t do. I always look on the positive side of what I can do.', 'Chuck Norris', '1'),
(906, 'Without passion man is a mere latent force and possibility, like the flint which awaits the shock of the iron before it can give forth its spark.', 'Amiel', '1'),
(907, 'Love at first sight is easy to understand; its when two people have been looking at each other for a lifetime that it becomes a miracle.', 'Amy Bloom', '1');
INSERT INTO `quotes` (`ID`, `Quote`, `Author`, `Quote_type`) VALUES
(908, 'With courage you will dare to take risks, have the strength to be compassionate, and the wisdom to be humble. Courage is the foundation of integrity.', 'Keshavan Nair', '1'),
(909, 'The right way is not always the popular and easy way. Standing for right when it is unpopular is a true test of moral character.', 'Margaret Smith', '1'),
(910, 'I prefer to be true to myself, even at the hazard of incurring the ridicule of others, rather than to be false, and to incur my own abhorrence.', 'Frederick Douglass', '1'),
(911, 'No pessimist ever discovered the secrets of the stars, or sailed to an uncharted land, or opened a new heaven to the human spirit.', 'Helen Keller', '1'),
(912, 'When you arise in the morning, think of what a precious privilege it is to be alive to breathe, to think, to enjoy, to love.', 'Marcus Aurelius', '1'),
(913, 'Character cannot be developed in ease and quiet. Only through experience of trial and suffering can the soul be strengthened, vision cleared, ambition inspired, and success achieved.', 'Helen Keller', '1'),
(914, 'Although there may be tragedy in your life, there\'s always a possibility to triumph. It doesn\'t matter who you are, where you come from. The ability to triumph begins with you. Always.', 'Oprah Winfrey', '1'),
(915, 'You must train your intuition you must trust the small voice inside you which tells you exactly what to say, what to decide.', 'Ingrid Bergman', '1'),
(916, 'Accept the things to which fate binds you, and love the people with whom fate brings you together, but do so with all your heart.', 'Marcus Aurelius', '1'),
(917, 'Let us resolve to be masters, not the victims, of our history, controlling our own destiny without giving way to blind suspicions and emotions.', 'John Kennedy', '1'),
(918, 'Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less.', 'Marie Curie', '1'),
(919, 'Parents can only give good advice or put them on the right paths, but the final forming of a persons character lies in their own hands.', 'Anne Frank', '1'),
(920, 'Adversity isn\'t set against you to fail; adversity is a way to build your character so that you can succeed over and over again through perseverance.', 'Byron Pulsifer', '1'),
(921, 'If you break your neck, if you have nothing to eat, if your house is on fire, then you got a problem. Everything else is inconvenience.', 'Robert Fulghum', '1'),
(922, 'Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful.', 'Albert Schweitzer', '1'),
(923, 'If A is success in life, then A equals x plus y plus z. Work is x; y is play; and z is keeping your mouth shut.', 'Albert Einstein', '1'),
(924, 'My advice to you is not to inquire why or whither, but just enjoy your ice cream while its on your plate that\'s my philosophy.', 'Thornton Wilder', '1'),
(925, 'Conflict is the gadfly of thought. It stirs us to observation and memory. It instigates to invention. It shocks us out of sheeplike passivity, and sets us at noting and contriving.', 'John Dewey', '1'),
(926, 'He who conquers others is strong; He who conquers himself is mighty.', 'Lao Tzu', '1'),
(927, 'Anything you really want, you can attain, if you really go after it.', 'Wayne Dyer', '1'),
(928, 'Arriving at one point is the starting point to another.', 'John Dewey', '1'),
(929, 'The foolish man seeks happiness in the distance, the wise grows it under his feet.', 'James Oppenheim', '1'),
(930, 'The greatest part of our happiness depends on our dispositions, not our circumstances.', 'Martha Washington', '1'),
(931, 'It is only possible to live happily ever after on a day to day basis.', 'Margaret Bonnano', '1'),
(932, 'A man sees in the world what he carries in his heart.', 'Goethe', '1'),
(933, 'Action may not always bring happiness, but there is no happiness without action.', 'Benjamin Disraeli', '1'),
(934, 'Believe deep down in your heart that you\'re destined to do great things.', 'Joe Paterno', '1'),
(935, 'Sooner or later, those who win are those who think they can.', 'Richard Bach', '1'),
(936, 'The only limit to your impact is your imagination and commitment.', 'Tony Robbins', '1'),
(937, 'You are special, you are unique, you are the best!', 'Cathy Pulsifer', '1'),
(938, 'Four steps to achievement: Plan purposefully. Prepare prayerfully. Proceed positively. Pursue persistently.', 'William Arthur Ward', '1'),
(939, 'To know oneself is to study oneself in action with another person.', 'Bruce Lee', '1'),
(940, 'We must not allow ourselves to become like the system we oppose.', 'Bishop Desmond Tutu', '1'),
(941, 'Smile, breathe and go slowly.', 'Thich Nhat Hanh', '1'),
(942, 'Reality is merely an illusion, albeit a very persistent one.', 'Albert Einstein', '1'),
(943, 'When you come to the end of your rope, tie a knot and hang on.', 'Franklin Roosevelt', '1'),
(944, 'Always be mindful of the kindness and not the faults of others.', 'Buddha', '1'),
(945, 'Everything that irritates us about others can lead us to an understanding of ourselves.', 'Carl Jung', '1'),
(946, 'When fate hands us a lemon, lets try to make lemonade.', 'Dale Carnegie', '1'),
(947, 'The weak can never forgive. Forgiveness is the attribute of the strong.', 'Mohandas Gandhi', '1'),
(948, 'A man is great by deeds, not by birth.', 'Chanakya', '1'),
(949, 'Success is getting what you want. Happiness is wanting what you get.', 'Dale Carnegie', '1'),
(950, 'Truth isn\'t all about what actually happens but more about how what has happened is interpreted.', 'Byron Pulsifer', '1'),
(951, 'A good rest is half the work.', 'Anonymous', '1'),
(952, 'Don\'t judge each day by the harvest you reap but by the seeds that you plant.', 'Robert Stevenson', '1'),
(953, 'Small opportunities are often the beginning of great enterprises.', 'Demosthenes', '1'),
(954, 'To be tested is good. The challenged life may be the best therapist.', 'Gail Sheehy', '1'),
(955, 'Take heed: you do not find what you do not seek.', 'English proverb', '1'),
(956, 'Happiness is the reward we get for living to the highest right we know.', 'Richard Bach', '1'),
(957, 'Be slow of tongue and quick of eye.', 'Cervantes', '1'),
(958, 'Freedom is not worth having if it does not connote freedom to err.', 'Mohandas Gandhi', '1'),
(959, 'I have always thought the actions of men the best interpreters of their thoughts.', 'John Locke', '1'),
(960, 'He who obtains has little. He who scatters has much.', 'Lao Tzu', '1'),
(961, 'To dare is to lose ones footing momentarily. To not dare is to lose oneself.', 'Soren Kierkegaard', '1'),
(962, 'No day in which you learn something is a complete loss.', 'David Eddings', '1'),
(963, 'Peace cannot be kept by force. It can only be achieved by understanding.', 'Albert Einstein', '1'),
(964, 'Real success is finding your lifework in the work that you love.', 'David McCullough', '1'),
(965, 'Better than a thousand hollow words, is one word that brings peace.', 'Buddha', '1'),
(966, 'All the flowers of all the tomorrows are in the seeds of today.', 'Anonymous', '1'),
(967, 'Your sacred space is where you can find yourself again and again.', 'Joseph Campbell', '1'),
(968, 'As you think, so shall you become.', 'Bruce Lee', '1'),
(969, 'In seed time learn, in harvest teach, in winter enjoy.', 'William Blake', '1'),
(970, 'Happiness does not come from having much, but from being attached to little.', 'Cheng Yen', '1'),
(971, 'Every gift from a friend is a wish for your happiness.', 'Richard Bach', '1'),
(972, 'Go put your creed into the deed. Nor speak with double tongue.', 'Ralph Emerson', '1'),
(973, 'The wisest men follow their own direction.', 'Euripides', '1'),
(974, 'Hope arouses, as nothing else can arouse, a passion for the possible.', 'William Sloane Coffin', '1'),
(975, 'Everything has beauty, but not everyone sees it.', 'Confucius', '1'),
(976, 'Nothing ever goes away until it has taught us what we need to know.', 'Pema Chodron', '1'),
(977, 'When you learn, teach. When you get, give.', 'Maya Angelou', '1'),
(978, 'Only when we are no longer afraid do we begin to live.', 'Dorothy Thompson', '1'),
(979, 'If you smile when no one else is around, you really mean it.', 'Andy Rooney', '1'),
(980, 'Love is the only force capable of transforming an enemy into friend.', 'Martin Luther King, Jr.', '1'),
(981, 'In all chaos there is a cosmos, in all disorder a secret order.', 'Carl Jung', '1'),
(982, 'A man is not where he lives but where he loves.', 'Anonymous', '1'),
(983, 'The price of greatness is responsibility.', 'Winston Churchill', '1'),
(984, 'Decision is a risk rooted in the courage of being free.', 'Paul Tillich', '1'),
(985, 'Your mind will answer most questions if you learn to relax and wait for the answer.', 'William Burroughs', '1'),
(986, 'The world does not happen to you it happens from you.', 'Anonymous', '1'),
(987, 'We cannot solve our problems with the same thinking we used when we created them.', 'Albert Einstein', '1'),
(988, 'More powerful than the will to win is the courage to begin.', 'Anonymous', '1'),
(989, 'Learning is finding out what you already know.', 'Richard Bach', '1'),
(990, 'Saying thank you is more than good manners. It is good spirituality.', 'Alfred Painter', '1'),
(991, 'Silence is a source of great strength.', 'Lao Tzu', '1'),
(992, 'Joy is the best makeup.', 'Anne Lamott', '1'),
(993, 'There is no great genius without some touch of madness.', 'Seneca', '1'),
(994, 'A jug fills drop by drop.', 'Buddha', '1'),
(995, 'Until you make peace with who you are, you\'ll never be content with what you have.', 'Doris Mortman', '1'),
(996, 'We aim above the mark to hit the mark.', 'Ralph Emerson', '1'),
(997, 'Being angry never solves anything.', 'Catherine Pulsifer', '1'),
(998, 'All men who have achieved great things have been great dreamers.', 'Orison Marden', '1'),
(999, 'Mediocrity knows nothing higher than itself, but talent instantly recognizes genius.', 'Arthur Conan Doyle', '1'),
(1000, 'Where all think alike, no one thinks very much.', 'Walter Lippmann', '1'),
(1001, 'Everything that exists is in a manner the seed of that which will be.', 'Marcus Aurelius', '1'),
(1002, 'Be less curious about people and more curious about ideas.', 'Marie Curie', '1'),
(1003, 'The heart has eyes which the brain knows nothing of.', 'Charles Perkhurst', '1'),
(1004, 'Only those who dare to fail greatly can ever achieve greatly.', 'Robert Kennedy', '1'),
(1005, 'Lose an hour in the morning, and you will spend all day looking for it.', 'Richard Whately', '1'),
(1006, 'Mistakes are always forgivable, if one has the courage to admit them.', 'Bruce Lee', '1'),
(1007, 'Go to your bosom: Knock there, and ask your heart what it doth know.', 'William Shakespeare', '1'),
(1008, 'Happiness mainly comes from our own attitude, rather than from external factors.', 'Dalai Lama', '1'),
(1009, 'If you do not change direction, you may end up where you are heading.', 'Lao Tzu', '1'),
(1010, 'What we see is mainly what we look for.', 'Anonymous', '1'),
(1011, 'Stay away from what might have been and look at what will be.', 'Marsha Petrie Sue', '1'),
(1012, 'Act as if what you do makes a difference. It does.', 'William James', '1'),
(1013, 'Passion creates the desire for more and action fuelled by passion creates a future.', 'Byron Pulsifer', '1'),
(1014, 'Do good by stealth, and blush to find it fame.', 'Alexander Pope', '1'),
(1015, 'Opportunity often comes disguised in the form of misfortune, or temporary defeat.', 'Napoleon Hill', '1'),
(1016, 'Don\'t talk about what you have done or what you are going to do.', 'Thomas Jefferson', '1'),
(1017, 'Most powerful is he who has himself in his own power.', 'Seneca', '1'),
(1018, 'We don\'t stop playing because we grow old; we grow old because we stop playing.', 'Bernard Shaw', '1'),
(1019, 'Experience can only be gained by doing not by thinking or dreaming.', 'Byron Pulsifer', '1'),
(1020, 'Always tell the truth. That way, you don\'t have to remember what you said.', 'Mark Twain', '1'),
(1021, 'From wonder into wonder existence opens.', 'Lao Tzu', '1'),
(1022, 'He who fears being conquered is sure of defeat.', 'Napoleon Bonaparte', '1'),
(1023, 'Life is what happens while you are making other plans.', 'John Lennon', '1'),
(1024, 'Doing what you love is the cornerstone of having abundance in your life.', 'Wayne Dyer', '1'),
(1025, 'Kindness is the golden chain by which society is bound together.', 'Johann Wolfgang von Goethe', '1'),
(1026, 'You need chaos in your soul to give birth to a dancing star.', 'Nietzsche', '1'),
(1027, 'It can\'t be spring if your heart is filled with past failures.', 'Byron Pulsifer', '1'),
(1028, 'No yesterdays are ever wasted for those who give themselves to today.', 'Brendan Francis', '1'),
(1029, 'There are no failures just experiences and your reactions to them.', 'Tom Krause', '1'),
(1030, 'Action is the foundational key to all success.', 'Pablo Picasso', '1'),
(1031, 'What is necessary to change a person is to change his awareness of himself.', 'Abraham Maslow', '1'),
(1032, 'Positive thinking will let you do everything better than negative thinking will.', 'Zig Ziglar', '1'),
(1033, 'We shall never know all the good that a simple smile can do.', 'Mother Teresa', '1'),
(1034, 'Nothing is so strong as gentleness. Nothing is so gentle as real strength.', 'Frances de Sales', '1'),
(1035, 'Imagination is not a talent of some men but is the health of every man.', 'Ralph Waldo Emerson', '1'),
(1036, 'We must embrace pain and burn it as fuel for our journey.', 'Kenji Miyazawa', '1'),
(1037, 'Don\'t wait for people to be friendly. Show them how.', 'Anonymous', '1'),
(1038, 'A gem cannot be polished without friction, nor a man perfected without trials.', 'Chinese proverb', '1'),
(1039, 'Each day can be one of triumph if you keep up your interests.', 'George Matthew Adams', '1'),
(1040, 'The place to improve the world is first in one\'s own heart and head and hands.', 'Robert M. Pirsig', '1'),
(1041, 'The pessimist sees difficulty in every opportunity. The optimist sees the opportunity in every difficulty.', 'Winston Churchill', '1'),
(1042, 'Winners have simply formed the habit of doing things losers don\'t like to do.', 'Albert Gray', '1'),
(1043, 'Nature is a mutable cloud which is always and never the same.', 'Ralph Emerson', '1'),
(1044, 'Life is what you make of it. Always has been, always will be.', 'Grandma Moses', '1'),
(1045, 'Worry often gives a small thing a big shadow.', 'Swedish proverb', '1'),
(1046, 'I want you to be everything that\'s you, deep at the center of your being.', 'Confucius', '1'),
(1047, 'We know what we are, but know not what we may be.', 'William Shakespeare', '1'),
(1048, 'Freedom is what you do with what\'s been done to you.', 'Jean-Paul Sartre', '1'),
(1049, 'The truth which has made us free will in the end make us glad also.', 'Felix Adler', '1'),
(1050, 'He who has imagination without learning has wings but no feet.', 'Joseph Joubert', '1'),
(1051, 'Whoso loves, believes the impossible.', 'Elizabeth Browning', '1'),
(1052, 'It isn\'t where you come from, it\'s where you\'re going that counts.', 'Ella Fitzgerald', '1'),
(1053, 'The greatest obstacle to connecting with our joy is resentment.', 'Pema Chodron', '1'),
(1054, 'When anger use your energy to do something productive.', 'C. Pulsifer', '1'),
(1055, 'We are all something, but none of us are everything.', 'Blaise Pascal', '1'),
(1056, 'If you can\'t explain it simply, you don\'t understand it well enough.', 'Albert Einstein', '1'),
(1057, 'He who lives in harmony with himself lives in harmony with the world.', 'Marcus Aurelius', '1'),
(1058, 'He who knows himself is enlightened.', 'Lao Tzu', '1'),
(1059, 'Build a better mousetrap and the world will beat a path to your door.', 'Ralph Emerson', '1'),
(1060, 'As our case is new, we must think and act anew.', 'Abraham Lincoln', '1'),
(1061, 'If you can\'t feed a hundred people, then feed just one.', 'Mother Teresa', '1'),
(1062, 'In three words I can sum up everything Ive learned about life: it goes on.', 'Robert Frost', '1'),
(1063, 'Don\'t let today\'s disappointments cast a shadow on tomorrow\'s dreams.', 'Anonymous', '1'),
(1064, 'You always succeed in producing a result.', 'Tony Robbins', '1'),
(1065, 'Everything you are against weakens you. Everything you are for empowers you.', 'Wayne Dyer', '1'),
(1066, 'As we risk ourselves, we grow. Each new experience is a risk.', 'Fran Watson', '1'),
(1067, 'Who we are never changes. Who we think we are does.', 'Mary Almanac', '1'),
(1068, 'The final proof of greatness lies in being able to endure criticism without resentment.', 'Elbert Hubbard', '1'),
(1069, 'An invasion of armies can be resisted, but not an idea whose time has come.', 'Victor Hugo', '1'),
(1070, 'Never let lack of money interfere with having fun.', 'Anonymous', '1'),
(1071, 'Excellence is not a skill. It is an attitude.', 'Ralph Marston', '1'),
(1072, 'People may doubt what you say, but they will believe what you do.', 'Lewis Cass', '1'),
(1073, 'The most formidable weapon against errors of every kind is reason.', 'Thomas Paine', '1'),
(1074, 'It\'s important to know that words don\'t move mountains. Work, exacting work moves mountains.', 'Danilo Dolci', '1'),
(1075, 'Beware of missing chances; otherwise it may be altogether too late some day.', 'Franz Liszt', '1'),
(1076, 'You only lose what you cling to.', 'Buddha', '1'),
(1077, 'Life is a succession of moments. To live each one is to succeed.', 'Corita Kent', '1'),
(1078, 'Most of the shadows of life are caused by standing in our own sunshine.', 'Ralph Waldo Emerson', '1'),
(1079, 'Good actions give strength to ourselves and inspire good actions in others.', 'Plato', '1'),
(1080, 'I know but one freedom and that is the freedom of the mind.', 'Antoine de Saint-Exupery', '1'),
(1081, 'In the middle of every difficulty lies opportunity.', 'Albert Einstein', '1'),
(1082, 'Every human being is the author of his own health or disease.', 'Buddha', '1'),
(1083, 'When in doubt, tell the truth.', 'Mark Twain', '1'),
(1084, 'Every great advance in science has issued from a new audacity of the imagination.', 'John Dewey', '1'),
(1085, 'The path to success is to take massive, determined action.', 'Anthony Robbins', '1'),
(1086, 'The ladder of success is never crowded at the top.', 'Napoleon Hill', '1'),
(1087, 'He who has health has hope, and he who has hope has everything.', 'Anonymous', '1'),
(1088, 'All great achievements require time.', 'Maya Angelou', '1'),
(1089, 'No person is your friend who demands your silence, or denies your right to grow.', 'Alice Walker', '1'),
(1090, 'Impossibilities are merely things which we have not yet learned.', 'Charles Chesnutt', '1'),
(1091, 'Vision without action is a daydream. Action without vision is a nightmare.', 'Japanese proverb', '1'),
(1092, 'The Superior Man is aware of Righteousness, the inferior man is aware of advantage.', 'Confucius', '1'),
(1093, 'He who angers you conquers you.', 'Elizabeth Kenny', '1'),
(1094, 'I never worry about action, but only inaction.', 'Winston Churchill', '1'),
(1095, 'No man is free who is not master of himself.', 'Epictetus', '1'),
(1096, 'Those that know, do. Those that understand, teach.', 'Aristotle', '1'),
(1097, 'If we are not fully ourselves, truly in the present moment, we miss everything.', 'Thich Nhat Hanh', '1'),
(1098, 'No act of kindness, no matter how small, is ever wasted.', 'Aesop', '1'),
(1099, 'Every man is a volume if you know how to read him.', 'Channing', '1'),
(1100, 'The difficulties of life are intended to make us better, not bitter.', 'Anonymous', '1'),
(1101, 'Quality means doing it right when no one is looking.', 'Henry Ford', '1'),
(1102, 'Change your words. Change your world.', 'Anonymous', '1'),
(1103, 'Great acts are made up of small deeds.', 'Lao Tzu', '1'),
(1104, 'The odds of hitting your target go up dramatically when you aim at it.', 'Mal Pancoast', '1'),
(1105, 'Open minds lead to open doors.', 'Anonymous', '1'),
(1106, 'They can do all because they think they can.', 'Virgil', '1'),
(1107, 'You have to think anyway, so why not think big?', 'Donald Trump', '1'),
(1108, 'On every thorn, delightful wisdom grows, In every rill a sweet instruction flows.', 'Edward Young', '1'),
(1109, 'Your body is precious. It is our vehicle for awakening. Treat it with care.', 'Buddha', '1'),
(1110, 'The one who always loses, is the only person who gets the reward.', 'Claire Charmont', '1'),
(1111, 'The future is completely open, and we are writing it moment to moment.', 'Pema Chodron', '1'),
(1112, 'Each time we face a fear, we gain strength, courage, and confidence in the doing.', 'Anonymous', '1'),
(1113, 'Ask yourself the secret of your success. Listen to your answer, and practice it.', 'Richard Bach', '1'),
(1114, 'Don\'t frown because you never know who is falling in love with your smile.', 'Sinvyest Tan', '1'),
(1115, 'Trust your hunches. They\'re usually based on facts filed away just below the conscious level.', 'Joyce Brothers', '1'),
(1116, 'Nothing is at last sacred but the integrity of your own mind.', 'Ralph Emerson', '1'),
(1117, 'Listen to your intuition. It will tell you everything you need to know.', 'Anthony D\'Angelo', '1'),
(1118, 'The personal life deeply lived always expands into truths beyond itself.', 'Anais Nin', '1'),
(1119, 'Whenever something negative happens to you, there is a deep lesson concealed within it.', 'Eckhart Tolle', '1'),
(1120, 'What is not started today is never finished tomorrow.', 'Goethe', '1'),
(1121, 'Our kindness may be the most persuasive argument for that which we believe.', 'Gordon Hinckley', '1'),
(1122, 'Chaos is inherent in all compounded things. Strive on with diligence.', 'Buddha', '1'),
(1123, 'Be sure you put your feet in the right place, then stand firm.', 'Abraham Lincoln', '1'),
(1124, 'Nothing great was ever achieved without enthusiasm.', 'Ralph Emerson', '1'),
(1125, 'The meaning I picked, the one that changed my life: Overcome fear, behold wonder.', 'Richard Bach', '1'),
(1126, 'Know how to listen, and you will profit even from those who talk badly.', 'Plutarch', '1'),
(1127, 'A man is not old as long as he is seeking something.', 'Edmond Rostand', '1'),
(1128, 'The time you think you\'re missing, misses you too.', 'Ymber Delecto', '1'),
(1129, 'Life is not measured by the breaths you take, but by its breathtaking moments.', 'Michael Vance', '1'),
(1130, 'Much wisdom often goes with fewer words.', 'Sophocles', '1'),
(1131, 'If you love life, don\'t waste time, for time is what life is made up of.', 'Bruce Lee', '1'),
(1132, 'Imagination is the living power and prime agent of all human perception.', 'Samuel Taylor Coleridge', '1'),
(1133, 'It is impossible to feel grateful and depressed in the same moment.', 'Naomi Williams', '1'),
(1134, 'Progress always involves risks. You can\'t steal second base and keep your foot on first.', 'Frederick Wilcox', '1'),
(1135, 'Liberty, taking the word in its concrete sense, consists in the ability to choose.', 'Simone Weil', '1'),
(1136, 'A thing well said will be wit in all languages.', 'John Dryden', '1'),
(1137, 'Always do your best. What you plant now, you will harvest later.', 'Og Mandino', '1'),
(1138, 'My mama always said: life\'s like a box of chocolate you never know what you gonna get.', 'Forrest Gump', '1'),
(1139, 'We are the leaves of one branch, the drops of one sea, the flowers of one garden.', 'Jean Lacordaire', '1'),
(1140, 'If you come to a fork in the road, take it.', 'Anonymous', '1'),
(1141, 'It is not only for what we do that we are held responsible, but also for what we do not do.', 'Moliere', '1'),
(1142, 'Nobody can do everything, but everybody can do something.', 'Anonymous', '1'),
(1143, 'The world has the habit of making room for the man whose actions show that he knows where he is going.', 'Napoleon Hill', '1'),
(1144, 'You cannot step twice into the same river, for other waters are continually flowing in.', 'Heraclitus', '1'),
(1145, 'Excellence is to do a common thing in an uncommon way.', 'Booker Washington', '1'),
(1146, 'No matter how hard the past, you can always begin again.', 'Buddha', '1'),
(1147, 'I begin with an idea and then it becomes something else.', 'Pablo Picasso', '1'),
(1148, 'Whoever is happy will make others happy, too.', 'Mark Twain', '1'),
(1149, 'Your work is to discover your work and then with all your heart to give yourself to it.', 'Buddha', '1'),
(1150, 'It\'s not what happens to you, but how you react to it that matters.', 'Epictetus', '1'),
(1151, 'Take it easy, but take it.', 'Woody Guthrie', '1'),
(1152, 'Never apologize for showing feeling. When you do so, you apologize for truth.', 'Benjamin Disraeli', '1'),
(1153, 'Take rest; a field that has rested gives a bountiful crop.', 'Ovid', '1'),
(1154, 'Age does not protect you from love. But love, to some extent, protects you from age.', 'Anais Nin', '1'),
(1155, 'Do what you can. Want what you have. Be who you are.', 'Forrest Church', '1'),
(1156, 'There are people who have money and people who are rich.', 'Coco Chanel', '1'),
(1157, 'Why worry about tomorrow, when today is all we have?', 'Anonymous', '1'),
(1158, 'Speak when you are angry and you will make the best speech you will ever regret.', 'Ambrose Bierce', '1'),
(1159, 'Things do not change, we change.', 'Henry Thoreau', '1'),
(1160, 'The exercise of an extraordinary gift is the supremest pleasure in life.', 'Mark Twain', '1'),
(1161, 'Sometimes the most important thing in a whole day is the rest we take between two deep breaths.', 'Etty Hillesum', '1'),
(1162, 'Forgiveness is choosing to love. It is the first skill of self-giving love.', 'Mohandas Gandhi', '1'),
(1163, 'To ensure good health: eat lightly, breathe deeply, live moderately, cultivate cheerfulness, and maintain an interest in life.', 'William Londen', '1'),
(1164, 'Most smiles are started by another smile.', 'Anonymous', '1'),
(1165, 'Nothing is softer or more flexible than water, yet nothing can resist it.', 'Lao Tzu', '1'),
(1166, 'It is difficult to achieve a spirit of genuine cooperation as long as people remain indifferent to the feelings and happiness of others.', 'Dalai Lama', '1'),
(1167, 'Experience keeps a dear school, but fools will learn in no other.', 'Benjamin Franklin', '1'),
(1168, 'We can only be said to be alive in those moments when our hearts are conscious of our treasures.', 'Thornton Wilder', '1'),
(1169, 'Fine words and an insinuating appearance are seldom associated with true virtue', 'Confucius', '1'),
(1170, 'We do not quit playing because we grow old, we grow old because we quit playing.', 'Oliver Holmes', '1'),
(1171, 'You can\'t choose up sides on a round world.', 'Wayne Dyer', '1'),
(1172, 'My advice to you is not to inquire why or whither, but just enjoy your ice cream while its on your plate, that\'s my philosophy.', 'Thornton Wilder', '1'),
(1173, 'Kindness is the language which the deaf can hear and the blind can see.', 'Mark Twain', '1'),
(1174, 'I may not know everything, but everything is not known yet anyway.', 'Byron Pulsifer', '1'),
(1175, 'If we could see the miracle of a single flower clearly, our whole life would change.', 'Buddha', '1'),
(1176, 'Without this playing with fantasy no creative work has ever yet come to birth. The debt we owe to the play of the imagination is incalculable.', 'Carl Jung', '1'),
(1177, 'You cannot travel the path until you have become the path itself.', 'Buddha', '1'),
(1178, 'Keep your eyes on the stars and your feet on the ground.', 'Theodore Roosevelt', '1'),
(1179, 'I am not afraid of tomorrow, for I have seen yesterday and I love today.', 'William White', '1'),
(1180, 'Limitations live only in our minds. But if we use our imaginations, our possibilities become limitless.', 'Jamie Paolinetti', '1'),
(1181, 'When you lose, don\'t lose the lesson.', 'Anonymous', '1'),
(1182, 'If you want a thing done well, do it yourself.', 'Napoleon Bonaparte', '1'),
(1183, 'The greatest barrier to success is the fear of failure.', 'Eriksson', '1'),
(1184, 'Sunshine is delicious, rain is refreshing, wind braces us up, snow is exhilarating; there is really no such thing as bad weather, only different kinds of good weather.', 'John Ruskin', '1'),
(1185, 'If you aren\'t going all the way, why go at all?', 'Joe Namath', '1'),
(1186, 'Our greatest glory is not in never falling, but in rising every time we fall.', 'Confucius', '1'),
(1187, 'The beginning of wisdom is found in doubting; by doubting we come to the question, and by seeking we may come upon the truth.', 'Pierre Abelard', '1'),
(1188, 'If I could reach up and hold a star for every time you\'ve made me smile, the entire evening sky would be in the palm of my hand.', 'Anonymous', '1'),
(1189, 'We are shaped by our thoughts; we become what we think. When the mind is pure, joy follows like a shadow that never leaves.', 'Buddha', '1'),
(1190, 'Stay committed to your decisions, but stay flexible in your approach.', 'Tony Robbins', '1'),
(1191, 'An optimist is a person who sees a green light everywhere, while the pessimist sees only the red spotlight... The truly wise person is colour-blind.', 'Albert Schweitzer', '1'),
(1192, 'What separates the winners from the losers is how a person reacts to each new twist of fate.', 'Donald Trump', '1'),
(1193, 'Each man has his own vocation; his talent is his call. There is one direction in which all space is open to him.', 'Ralph Emerson', '1'),
(1194, 'To change ones life, start immediately, do it flamboyantly, no exceptions.', 'William James', '1'),
(1195, 'As we express our gratitude, we must never forget that the highest appreciation is not to utter words, but to live by them.', 'John F. Kennedy', '1'),
(1196, 'The world cares very little about what a man or woman knows; it is what a man or woman is able to do that counts.', 'Booker Washington', '1'),
(1197, 'The steeper the mountain the harder the climb the better the view from the finishing line', 'Anonymous', '1'),
(1198, 'Aim for success, not perfection. Never give up your right to be wrong, because then you will lose the ability to learn new things and move forward with your life.', 'Dr. David M. Burns', '1'),
(1199, 'When I let go of what I am, I become what I might be.', 'Lao Tzu', '1'),
(1200, 'Transformation does not start with some one else changing you; transformation is an inner self reworking of what you are now to what you will be.', 'Byron Pulsifer', '1'),
(1201, 'Time is not a measure the length of a day or month or year but more a measure of what you have accomplished.', 'Byron Pulsifer', '1'),
(1202, 'Wherever a man may happen to turn, whatever a man may undertake, he will always end up by returning to the path which nature has marked out for him.', 'Johann Wolfgang von Goethe', '1'),
(1203, 'Holding on to anger is like grasping a hot coal with the intent of throwing it at someone else; you are the one who gets burned.', 'Buddha', '1'),
(1204, 'When there is no enemy within, the enemies outside cannot hurt you.', 'African proverb', '1'),
(1205, 'He who controls others may be powerful, but he who has mastered himself is mightier still.', 'Lao Tzu', '1'),
(1206, 'There is no scarcity of opportunity to make a living at what you love; theres only scarcity of resolve to make it happen.', 'Wayne Dyer', '1'),
(1207, 'Neither a lofty degree of intelligence nor imagination nor both together go to the making of genius. Love, love, love, that is the soul of genius.', 'Wolfgang Amadeus Mozart', '1'),
(1208, 'The happy and efficient people in this world are those who accept trouble as a normal detail of human life and resolve to capitalize it when it comes along.', 'H. Bertram Lewis', '1'),
(1209, 'As an organizer I start from where the world is, as it is, not as I would like it to be.', 'Saul Alinsky', '1'),
(1210, 'You are the only person on Earth who can use your ability.', 'Zig Ziglar', '1'),
(1211, 'Don\'t let what you can\'t do stop you from doing what you can do.', 'Anonymous', '1'),
(1212, 'Complaining doesn\'t change a thing only taking action does.', 'Byron Pulsifer', '1'),
(1213, 'Life a culmination of the past, an awareness of the present, an indication of the future beyond knowledge, the quality that gives a touch of divinity to matter.', 'Charles A. Lindbergh', '1'),
(1214, 'Enjoy the little things, for one day you may look back and realize they were the big things.', 'Robert Brault', '1'),
(1215, 'With every experience, you alone are painting your own canvas, thought by thought, choice by choice.', 'Oprah Winfrey', '1'),
(1216, 'Let the beauty of what you love be what you do.', 'Rumi', '1'),
(1217, 'The world turns aside to let any man pass who knows where he is going.', 'Epictetus', '1'),
(1218, 'Beauty is not in the face; beauty is a light in the heart.', 'Kahlil Gibran', '1'),
(1219, 'A day of worry is more exhausting than a day of work.', 'John Lubbock', '1'),
(1220, 'Truth, and goodness, and beauty are but different faces of the same all.', 'Ralph Emerson', '1'),
(1221, 'To be great is to be misunderstood.', 'Ralph Emerson', '1'),
(1222, 'Trust only movement. Life happens at the level of events, not of words. Trust movement.', 'Alfred Adler', '1'),
(1223, 'Never, never, never give up.', 'Winston Churchill', '1'),
(1224, 'The most decisive actions of our life... are most often unconsidered actions.', 'Andre Gide', '1'),
(1225, 'As we grow as unique persons, we learn to respect the uniqueness of others.', 'Robert Schuller', '1'),
(1226, 'Failure doesn\'t mean you are a failure it just means you haven\'t succeeded yet.', 'Robert Schuller', '1'),
(1227, 'It is the quality of our work which will please God, not the quantity.', 'Mahatma Gandhi', '1'),
(1228, 'Try and fail, but don\'t fail to try.', 'Stephen Kaggwa', '1'),
(1229, 'First say to yourself what you would be; and then do what you have to do.', 'Epictetus', '1'),
(1230, 'Through pride we are ever deceiving ourselves. But deep down below the surface of the average conscience a still, small voice says to us, Something is out of tune.', 'Carl Jung', '1'),
(1231, 'Keep silence for the most part, and speak only when you must, and then briefly.', 'Epictetus', '1'),
(1232, 'Fear not for the future, weep not for the past.', 'Percy Shelley', '1'),
(1233, 'We are Divine enough to ask and we are important enough to receive.', 'Wayne Dyer', '1'),
(1234, 'If you kick a stone in anger, you\'ll hurt your own foot.', 'Korean proverb', '1'),
(1235, 'To see things in the seed, that is genius.', 'Lao Tzu', '1'),
(1236, 'The happiness that is genuinely satisfying is accompanied by the fullest exercise of our faculties and the fullest realization of the world in which we live.', 'Bertrand Russell', '1'),
(1237, 'Human beings, who are almost unique in having the ability to learn from the experience of others, are also remarkable for their apparent disinclination to do so.', 'Douglas Adams', '1'),
(1238, 'Make the most of yourself, for that is all there is of you.', 'Ralph Emerson', '1'),
(1239, 'The universe is made of stories, not atoms.', 'Muriel Rukeyser', '1'),
(1240, 'Respect should be earned by actions, and not acquired by years.', 'Frank Wright', '1'),
(1241, 'I hear and I forget. I see and I remember. I do and I understand.', 'Confucius', '1'),
(1242, 'The trouble with most people is that they think with their hopes or fears or wishes rather than with their minds.', 'Will Durant', '1'),
(1243, 'A lot of people give up just before theyre about to make it. You know you never know when that next obstacle is going to be the last one.', 'Chuck Norris', '1'),
(1244, 'Sometimes the biggest act of courage is a small one.', 'Lauren Raffo', '1'),
(1245, 'People are not lazy. They simply have impotent goals that is, goals that do not inspire them.', 'Tony Robbins', '1'),
(1246, 'You do not become good by trying to be good, but by finding the goodness that is already within you.', 'Eckhart Tolle', '1'),
(1247, 'Waste no more time arguing about what a good man should be. Be one.', 'Marcus Aurelius', '1'),
(1248, 'Happiness often sneaks in through a door you didn\'t know you left open.', 'John Barrymore', '1'),
(1249, 'There are basically two types of people. People who accomplish things, and people who claim to have accomplished things. The first group is less crowded.', 'Mark Twain', '1'),
(1250, 'The things that one most wants to do are the things that are probably most worth doing.', 'Winifred Holtby', '1'),
(1251, 'Always bear in mind that your own resolution to succeed is more important than any one thing.', 'Abraham Lincoln', '1'),
(1252, 'Setting an example is not the main means of influencing another, it is the only means.', 'Albert Einstein', '1'),
(1253, 'Chaos and Order are not enemies, only opposites.', 'Richard Garriott', '1'),
(1254, 'Perseverance is a great element of success. If you only knock long enough and loud enough at the gate, you are sure to wake up somebody.', 'Henry Longfellow', '1'),
(1255, 'Only through our connectedness to others can we really know and enhance the self. And only through working on the self can we begin to enhance our connectedness to others.', 'Harriet Lerner', '1'),
(1256, 'He who deliberates fully before taking a step will spend his entire life on one leg.', 'Chinese proverb', '1'),
(1257, 'Peace begins with a smile.', 'Mother Teresa', '1'),
(1258, 'Be your own hero, it\'s cheaper than a movie ticket.', 'Doug Horton', '1'),
(1259, 'Turn your face toward the sun and the shadows will fall behind you.', 'Maori proverb', '1'),
(1260, 'Things turn out best for those who make the best of the way things turn out.', 'Jack Buck', '1'),
(1261, 'Were here for a reason. I believe a bit of the reason is to throw little torches out to lead people through the dark.', 'Whoopi Goldberg', '1'),
(1262, 'To effectively communicate, we must realize that we are all different in the way we perceive the world and use this understanding as a guide to our communication with others.', 'Anthony Robbins', '1'),
(1263, 'Ability will never catch up with the demand for it.', 'Confucius', '1'),
(1264, 'Never say there is nothing beautiful in the world any more. There is always something to make you wonder in the shape of a tree, the trembling of a leaf.', 'Albert Schweitzer', '1'),
(1265, 'Intuition is the very force or activity of the soul in its experience through whatever has been the experience of the soul itself.', 'Henry Reed', '1'),
(1266, 'Setting goals is the first step in turning the invisible into the visible.', 'Tony Robbins', '1'),
(1267, 'Courage is not the absence of fear, but simply moving on with dignity despite that fear.', 'Pat Riley', '1'),
(1268, 'All truths are easy to understand once they are discovered; the point is to discover them.', 'Galileo Galilei', '1'),
(1269, 'The smallest act of kindness is worth more than the grandest intention.', 'Oscar Wilde', '1'),
(1270, 'We know from science that nothing in the universe exists as an isolated or independent entity.', 'Margaret Wheatley', '1'),
(1271, 'Everything in the universe goes by indirection. There are no straight lines.', 'Ralph Emerson', '1'),
(1272, 'What do we live for, if it is not to make life less difficult for each other?', 'George Eliot', '1'),
(1273, 'When we feel love and kindness toward others, it not only makes others feel loved and cared for, but it helps us also to develop inner happiness and peace.', 'Tenzin Gyatso', '1'),
(1274, 'We may encounter many defeats but we must not be defeated.', 'Maya Angelou', '1'),
(1275, 'Every person, all the events of your life are there because you have drawn them there. What you choose to do with them is up to you.', 'Richard Bach', '1'),
(1276, 'Logic will get you from A to B. Imagination will take you everywhere.', 'Albert Einstein', '1'),
(1277, 'Our deepest wishes are whispers of our authentic selves. We must learn to respect them. We must learn to listen.', 'Sarah Breathnach', '1'),
(1278, 'The world is but a canvas to the imagination.', 'Henry Thoreau', '1'),
(1279, 'Thats the risk you take if you change: that people you\'ve been involved with won\'t like the new you. But other people who do will come along.', 'Lisa Alther', '1'),
(1280, 'To be happy is to be able to become aware of oneself without fright.', 'Walter Benjamin', '1'),
(1281, 'Strength to carry on despite the odds means you have faith in your own abilities and know how.', 'Byron Pulsifer', '1'),
(1282, 'Make the most of yourself for that is all there is of you.', 'Ralph Emerson', '1'),
(1283, 'Be gentle first with yourself if you wish to be gentle with others.', 'Lama Yeshe', '1'),
(1284, 'A man who doesn\'t trust himself can never really trust anyone else.', 'Cardinal Retz', '1'),
(1285, 'We make our own fortunes and we call them fate.', 'Benjamin Disraeli', '1'),
(1286, 'Leaders aren\'t born they are made. And they are made just like anything else, through hard work. And that\'s the price well have to pay to achieve that goal, or any goal.', 'Vince Lombardi', '1'),
(1287, 'It takes courage to grow up and become who you really are.', 'E. E. Cummings', '1'),
(1288, 'Always seek out the seed of triumph in every adversity.', 'Og Mandino', '1'),
(1289, 'Rather than wishing for change, you first must be prepared to change.', 'Catherine Pulsifer', '1'),
(1290, 'I do not believe in a fate that falls on men however they act; but I do believe in a fate that falls on them unless they act.', 'Buddha', '1'),
(1291, 'Fame usually comes to those who are thinking about something else.', 'Holmes', '1'),
(1292, 'First comes thought; then organization of that thought, into ideas and plans; then transformation of those plans into reality. The beginning, as you will observe, is in your imagination.', 'Napoleon Hill', '1'),
(1293, 'The superior man acts before he speaks, and afterwards speaks according to his action.', 'Confucius', '1'),
(1294, 'A single conversation across the table with a wise person is worth a months study of books.', 'Chinese proverb', '1'),
(1295, 'The difference between what we do and what we are capable of doing would suffice to solve most of the worlds problems.', 'Mohandas Gandhi', '1'),
(1296, 'You can never cross the ocean unless you have the courage to lose sight of the shore.', 'Anonymous', '1'),
(1297, 'Work for something because it is good, not just because it stands a chance to succeed.', 'Vaclav Havel', '1'),
(1298, 'Knowledge rests not upon truth alone, but upon error also.', 'Carl Jung', '1'),
(1299, 'Make it a rule of life never to regret and never to look back. Regret is an appalling waste of energy; you can\'t build on it; it\'s only for wallowing in.', 'Katherine Mansfield', '1'),
(1300, 'Never regret. If it\'s good, it\'s wonderful. If it\'s bad, it\'s experience.', 'Victoria Holt', '1'),
(1301, 'When deeds and words are in accord, the whole world is transformed.', 'Chuang Tzu', '1'),
(1302, 'Kind words can be short and easy to speak but their echoes are truly endless.', 'Mother Teresa', '1'),
(1303, 'For everything that lives is holy, life delights in life.', 'William Blake', '1'),
(1304, 'The most important thing is transforming our minds, for a new way of thinking, a new outlook: we should strive to develop a new inner world.', 'Dalai Lama', '1'),
(1305, 'Our passion is our strength.', 'Billie Armstrong', '1'),
(1306, 'In rivers, the water that you touch is the last of what has passed and the first of that which comes; so with present time.', 'Leonardo da Vinci', '1'),
(1307, 'Spring is a time for rebirth and the fulfilment of new life.', 'Byron Pulsifer', '1'),
(1308, 'There is nothing happens to any person but what was in his power to go through with.', 'Marcus Aurelius', '1'),
(1309, 'There are two ways to slide easily through life: to believe everything or to doubt everything; both ways save us from thinking.', 'Alfred Korzybski', '1'),
(1310, 'The art of progress is to preserve order amid change, and to preserve change amid order.', 'Alfred Whitehead', '1'),
(1311, 'We make a living by what we get, but we make a life by what we give.', 'Winston Churchill', '1'),
(1312, 'If you want to study yourself look into the hearts of other people. If you want to study other people look into your own heart.', 'Friedrich von Schiller', '1'),
(1313, 'Maxim for life: You get treated in life the way you teach people to treat you.', 'Wayne Dyer', '1'),
(1314, 'The first duty of a human being is to assume the right functional relationship to society more briefly, to find your real job, and do it.', 'Charlotte Perkins Gilman', '1'),
(1315, 'The key to growth is the introduction of higher dimensions of consciousness into our awareness.', 'Lao Tzu', '1'),
(1316, 'Thought is the blossom; language the bud; action the fruit behind it.', 'Ralph Emerson', '1'),
(1317, 'True happiness means forging a strong spirit that is undefeated, no matter how trying our circumstances.', 'Daisaku Ikeda', '1'),
(1318, 'There is nothing so useless as doing efficiently that which should not be done at all.', 'Peter Drucker', '1'),
(1319, 'I have been impressed with the urgency of doing. Knowing is not enough; we must apply. Being willing is not enough; we must do.', 'Leonardo da Vinci', '1'),
(1320, 'All the world is a stage, And all the men and women merely players.They have their exits and entrances; Each man in his time plays many parts.', 'William Shakespeare', '1'),
(1321, 'As we are liberated from our own fear, our presence automatically liberates others.', 'Nelson Mandela', '1'),
(1322, 'The most successful people are those who are good at plan B.', 'James Yorke', '1'),
(1323, 'Criticism is something you can easily avoid by saying nothing, doing nothing, and being nothing.', 'Aristotle', '1'),
(1324, 'To fly as fast as thought, you must begin by knowing that you have already arrived.', 'Richard Bach', '1'),
(1325, 'Obstacles are those things you see when you take your eyes off the goal.', 'Hannah More', '1'),
(1326, 'The greatest danger for most of us is not that our aim is too high and we miss it, but that it is too low and we reach it.', 'Michelangelo', '1'),
(1327, 'Great ideas often receive violent opposition from mediocre minds.', 'Albert Einstein', '1'),
(1328, 'We can change our lives. We can do, have, and be exactly what we wish.', 'Tony Robbins', '1'),
(1329, 'You are the only person on earth who can use your ability.', 'Zig Ziglar', '1'),
(1330, 'Neither genius, fame, nor love show the greatness of the soul. Only kindness can do that.', 'Jean Lacordaire', '1'),
(1331, 'The least of things with a meaning is worth more in life than the greatest of things without it.', 'Carl Jung', '1'),
(1332, 'The noblest worship is to make yourself as good and as just as you can.', 'Isocrates', '1'),
(1333, 'Though no one can go back and make a brand new start, anyone can start from not and make a brand new ending.', 'Carl Bard', '1'),
(1334, 'A dream is your creative vision for your life in the future. You must break out of your current comfort zone and become comfortable with the unfamiliar and the unknown.', 'Denis Waitley', '1'),
(1335, 'Don\'t think of it as failure. Think of it as time-released success.', 'Robert Orben', '1'),
(1336, 'We are what we repeatedly do. Excellence, then, is not an act but a habit.', 'Aristotle', '1'),
(1337, 'I walk slowly, but I never walk backward.', 'Abraham Lincoln', '1'),
(1338, 'Divide each difficulty into as many parts as is feasible and necessary to resolve it.', 'Rene Descartes', '1'),
(1339, 'The best place to find a helping hand is at the end of your own arm.', 'Anonymous', '1'),
(1340, 'We know the truth, not only by the reason, but by the heart.', 'Blaise Pascal', '1'),
(1341, 'We choose our joys and sorrows long before we experience them.', 'Kahlil Gibran', '1'),
(1342, 'Anybody can make history. Only a great man can write it.', 'Oscar Wilde', '1'),
(1343, 'If I know what love is, it is because of you.', 'Hermann Hesse', '1'),
(1344, 'Allow the world to live as it chooses, and allow yourself to live as you choose.', 'Richard Bach', '1'),
(1345, 'Focusing your life solely on making a buck shows a poverty of ambition. It asks too little of yourself. And it will leave you unfulfilled.', 'Barack Obama', '1'),
(1346, 'Compassion and happiness are not a sign of weakness but a sign of strength.', 'Dalai Lama', '1'),
(1347, 'It is common sense to take a method and try it. If it fails, admit it frankly and try another. But above all, try something.', 'Franklin D. Roosevelt', '1'),
(1348, 'Be here now. Be someplace else later. Is that so complicated?', 'David Bader', '1'),
(1349, 'To be able to give away riches is mandatory if you wish to possess them. This is the only way that you will be truly rich.', 'Mahummad Ali', '1'),
(1350, 'Learning without reflection is a waste, reflection without learning is dangerous.', 'Confucius', '1'),
(1351, 'Don\'t fear failure so much that you refuse to try new things. The saddest summary of life contains three descriptions: could have, might have, and should have.', 'Anonymous', '1'),
(1352, 'All fixed set patterns are incapable of adaptability or pliability. The truth is outside of all fixed patterns.', 'Bruce Lee', '1'),
(1353, 'I don\'t believe in failure. It\'s not failure if you enjoyed the process.', 'Oprah Winfrey', '1'),
(1354, 'The best and most beautiful things in the world cannot be seen, nor touched... but are felt in the heart.', 'Helen Keller', '1'),
(1355, 'Success in business requires training and discipline and hard work. But if you\'re not frightened by these things, the opportunities are just as great today as they ever were.', 'David Rockefeller', '1'),
(1356, 'The man who trusts men will make fewer mistakes than he who distrusts them.', 'Cavour', '1'),
(1357, 'The less effort, the faster and more powerful you will be.', 'Bruce Lee', '1'),
(1358, 'We must be as courteous to a man as we are to a picture, which we are willing to give the advantage of a good light.', 'Ralph Emerson', '1'),
(1359, 'The dream was always running ahead of me. To catch up, to live for a moment in unison with it, that was the miracle.', 'Anais Nin', '1'),
(1360, 'The cure for boredom is curiosity. There is no cure for curiosity.', 'Ellen Parr', '1'),
(1361, 'We can do no great things, only small things with great love.', 'Mother Teresa', '1'),
(1362, 'Be like the flower, turn your face to the sun.', 'Kahlil Gibran', '1'),
(1363, 'Remembering a wrong is like carrying a burden on the mind.', 'Buddha', '1'),
(1364, 'The foolish man seeks happiness in the distance; the wise grows it under his feet.', 'James Openheim', '1'),
(1365, 'Gratitude is the fairest blossom which springs from the soul.', 'Henry Beecher', '1');
INSERT INTO `quotes` (`ID`, `Quote`, `Author`, `Quote_type`) VALUES
(1366, 'If you look into your own heart, and you find nothing wrong there, what is there to worry about? What is there to fear?', 'Confucius', '1'),
(1367, 'You cannot have what you do not want.', 'John Acosta', '1'),
(1368, 'Do not follow where the path may lead. Go, instead, where there is no path and leave a trail.', 'Ralph Waldo Emerson', '1'),
(1369, 'It is not fair to ask of others what you are unwilling to do yourself.', 'Eleanor Roosevelt', '1'),
(1370, 'Knowing your own darkness is the best method for dealing with the darknesses of other people.', 'Carl Jung', '1'),
(1371, 'The best thing in every noble dream is the dreamer...', 'Moncure Conway', '1'),
(1372, 'Weve got to have a dream if we are going to make a dream come true.', 'Walt Disney', '1'),
(1373, 'If you want things to be different, perhaps the answer is to become different yourself.', 'Norman Peale', '1'),
(1374, 'There is nothing impossible to him who will try.', 'Alexander the Great', '1'),
(1375, 'Kindness is more important than wisdom, and the recognition of this is the beginning of wisdom.', 'Theodore Rubin', '1'),
(1376, 'Every great dream begins with a dreamer. Always remember, you have within you the strength, the patience, and the passion to reach for the stars to change the world.', 'Harriet Tubman', '1'),
(1377, 'The only real failure in life is not to be true to the best one knows.', 'Buddha', '1'),
(1378, 'Anyone who doesn\'t take truth seriously in small matters cannot be trusted in large ones either.', 'Albert Einstein', '1'),
(1379, 'Change will not come if we wait for some other person or some other time. We are the ones weve been waiting for. We are the change that we seek.', 'Barack Obama', '1'),
(1380, 'Those who cannot learn from history are doomed to repeat it.', 'George Santayan', '1'),
(1381, 'The trick is in what one emphasizes. We either make ourselves miserable, or we make ourselves happy. The amount of work is the same.', 'Carlos Castaneda', '1'),
(1382, 'Just as a flower, which seems beautiful has color but no perfume, so are the fruitless words of a man who speaks them but does them not.', 'Dhammapada', '1'),
(1383, 'Things that were hard to bear are sweet to remember.', 'Seneca', '1'),
(1384, 'Three things in human life are important. The first is to be kind. The second is to be kind. The third is to be kind.', 'Henry James', '1'),
(1385, 'However many holy words you read, However many you speak, What good will they do you If you do not act on upon them?', 'Buddha', '1'),
(1386, 'They can conquer who believe they can.', 'Virgil', '1'),
(1387, 'Learn to listen. Opportunity could be knocking at your door very softly.', 'Frank Tyger', '1'),
(1388, 'All action results from thought, so it is thoughts that matter.', 'Sai Baba', '1'),
(1389, 'There are only two ways to live your life. One is as though nothing is a miracle. The other is as though everything is a miracle.', 'Albert Einstein', '1'),
(1390, 'I love my past. I love my present. I\'m not ashamed of what Ive had, and I\'m not sad because I have it no longer.', 'Colette', '1'),
(1391, 'Prejudice is a burden that confuses the past, threatens the future and renders the present inaccessible.', 'Maya Angelou', '1'),
(1392, 'Just as much as we see in others we have in ourselves.', 'William Hazlitt', '1'),
(1393, 'Prosperity depends more on wanting what you have than having what you want.', 'Geoffrey F. Abert', '1'),
(1394, 'How many cares one loses when one decides not to be something but to be someone.', 'Coco Chanel', '1'),
(1395, 'He who knows, does not speak. He who speaks, does not know.', 'Lao Tzu', '1'),
(1396, 'We cannot direct the wind but we can adjust the sails.', 'Anonymous', '1'),
(1397, 'One may say the eternal mystery of the world is its comprehensibility.', 'Albert Einstein', '1'),
(1398, 'The self is not something ready-made, but something in continuous formation through choice of action.', 'John Dewey', '1'),
(1399, 'Our greatness lies not so much in being able to remake the world as being able to remake ourselves.', 'Mahatma Gandhi', '1'),
(1400, 'Moments of complete apathy are the best for new creations.', 'Philip Breedveld', '1'),
(1401, 'The only real mistake is the one from which we learn nothing.', 'John Powell', '1'),
(1402, 'To dream of the person you would like to be is to waste the person you are.', 'Tim Menchen', '1'),
(1403, 'The important thing is this: to be able at any moment to sacrifice what we are for what we could become.', 'Charles Dubois', '1'),
(1404, 'Gratitude is not only the greatest of virtues, but the paren\'t of all the others.', 'Cicero', '1'),
(1405, 'It is never too late. Even if you are going to die tomorrow, keep yourself straight and clear and be a happy human being today.', 'Lama Yeshe', '1'),
(1406, 'Respect is not something that you can ask for, buy or borrow. Respect is what you earn from each person no matter their background or status.', 'Byron Pulsifer', '1'),
(1407, 'Things do not change; we change.', 'Henry Thoreau', '1'),
(1408, 'We must learn our limits. We are all something, but none of us are everything.', 'Blaise Pascal', '1'),
(1409, 'Learn wisdom from the ways of a seedling. A seedling which is never hardened off through stressful situations will never become a strong productive plant.', 'Stephen Sigmund', '1'),
(1410, 'We are all faced with a series of great opportunities brilliantly disguised as impossible situations.', 'Charles R. Swindoll', '1'),
(1411, 'All men have a sweetness in their life. That is what helps them go on. It is towards that they turn when they feel too worn out.', 'Albert Camus', '1'),
(1412, 'Be a good listener. Your ears will never get you in trouble.', 'Frank Tyger', '1'),
(1413, 'Meditation brings wisdom; lack of mediation leaves ignorance. Know well what leads you forward and what hold you back, and choose the path that leads to wisdom.', 'Buddha', '1'),
(1414, 'You learn to speak by speaking, to study by studying, to run by running, to work by working; in just the same way, you learn to love by loving.', 'Anatole France', '1'),
(1415, 'To listen well is as powerful a means of communication and influence as to talk well.', 'John Marshall', '1'),
(1416, 'There is only one happiness in life, to love and be loved.', 'George Sand', '1'),
(1417, 'Live through feeling and you will live through love. For feeling is the language of the soul, and feeling is truth.', 'Matt Zotti', '1'),
(1418, 'Kindness in words creates confidence. Kindness in thinking creates profoundness. Kindness in giving creates love.', 'Lao Tzu', '1'),
(1419, 'Reason and free inquiry are the only effectual agents against error.', 'Thomas Jefferson', '1'),
(1420, 'The best cure for the body is a quiet mind.', 'Napoleon Bonaparte', '1'),
(1421, 'See the positive side, the potential, and make an effort.', 'Dalai Lama', '1'),
(1422, 'By accepting yourself and being fully what you are, your presence can make others happy.', 'Jane Roberts', '1'),
(1423, 'Never deny a diagnosis, but do deny the negative verdict that may go with it.', 'Norman Cousins', '1'),
(1424, 'The really unhappy person is the one who leaves undone what they can do, and starts doing what they don\'t understand; no wonder they come to grief.', 'Johann Wolfgang von Goethe', '1'),
(1425, 'You cannot be lonely if you like the person you\'re alone with.', 'Wayne Dyer', '1'),
(1426, 'I do not believe in a fate that falls on men however they act; but I do believe in a fate that falls on man unless they act.', 'G. K. Chesterton', '1'),
(1427, 'If you propose to speak, always ask yourself, is it true, is it necessary, is it kind.', 'Buddha', '1'),
(1428, 'Risk more than others think is safe. Care more than others think is wise. Dream more than others think is practical.Expect more than others think is possible.', 'Cadet Maxim', '1'),
(1429, 'Failure will never overtake me if my determination to succeed is strong enough.', 'Og Mandino', '1'),
(1430, 'Let go of your attachment to being right, and suddenly your mind is more open. You\'re able to benefit from the unique viewpoints of others, without being crippled by your own judgement.', 'Ralph Marston', '1'),
(1431, 'Wrinkles should merely indicate where smiles have been.', 'Mark Twain', '1'),
(1432, 'Your attitude, not your aptitude, will determine your altitude.', 'Zig Ziglar', '1'),
(1433, 'Let yourself be silently drawn by the stronger pull of what you really love.', 'Rumi', '1'),
(1434, 'I gave my life to become the person I am right now. Was it worth it?', 'Richard Bach', '1'),
(1435, 'Give thanks for a little and you will find a lot.', 'Hausa', '1'),
(1436, 'Your ability to learn faster than your competition is your only sustainable competitive advantage.', 'Arie de Gues', '1'),
(1437, 'Forgiveness does not change the past, but it does enlarge the future.', 'Paul Boese', '1'),
(1438, 'Let the future tell the truth, and evaluate each one according to his work and accomplishments. The present is theirs; the future, for which I have really worked, is mine.', 'Nikola Tesla', '1'),
(1439, 'Moral excellence comes about as a result of habit. We become just by doing just acts, temperate by doing temperate acts, brave by doing brave acts.', 'Aristotle', '1'),
(1440, 'The deepest craving of human nature is the need to be appreciated.', 'William James', '1'),
(1441, 'Love does not consist of gazing at each other, but in looking together in the same direction.', 'Antoine de Saint-Exupery', '1'),
(1442, 'We have committed the Golden Rule to memory; let us now commit it to life.', 'Edwin Markham', '1'),
(1443, 'It is with words as with sunbeams. The more they are condensed, the deeper they burn.', 'Robert Southey', '1'),
(1444, 'When people are like each other they tend to like each other.', 'Tony Robbins', '1'),
(1445, 'Sincerity is the way of Heaven. The attainment of sincerity is the way of men.', 'Confucius', '1'),
(1446, 'Be the change that you want to see in the world.', 'Mohandas Gandhi', '1'),
(1447, 'The more you care, the stronger you can be.', 'Jim Rohn', '1'),
(1448, 'Lots of people want to ride with you in the limo, but what you want is someone who will take the bus with you when the limo breaks down.', 'Oprah Winfrey', '1'),
(1449, 'Just trust yourself, then you will know how to live.', 'Goethe', '1'),
(1450, 'To be fully alive, fully human, and completely awake is to be continually thrown out of the nest.', 'Pema Chodron', '1'),
(1451, 'If you don\'t design your own life plan, chances are you\'ll fall into someone else\'s plan. And guess what they have planned for you? Not much.', 'Jim Rohn', '1'),
(1452, 'It all depends on how we look at things, and not how they are in themselves.', 'Carl Jung', '1'),
(1453, 'Giving up doesn\'t always mean you are weak; sometimes it means that you are strong enough to let go.', 'Anonymous', '1'),
(1454, 'To climb steep hills requires a slow pace at first.', 'William Shakespeare', '1'),
(1455, 'An idea that is developed and put into action is more important than an idea that exists only as an idea.', 'Buddha', '1'),
(1456, 'It is not the possession of truth, but the success which attends the seeking after it, that enriches the seeker and brings happiness to him.', 'Max Planck', '1'),
(1457, 'Truth is generally the best vindication against slander.', 'Abraham Lincoln', '1'),
(1458, 'To follow, without halt, one aim: There is the secret of success.', 'Anna Pavlova', '1'),
(1459, 'And as we let our own light shine, we unconsciously give other people permission to do the same.', 'Nelson Mandela', '1'),
(1460, 'What is a weed? A plant whose virtues have not yet been discovered.', 'Ralph Emerson', '1'),
(1461, 'Belief consists in accepting the affirmations of the soul; Unbelief, in denying them.', 'Ralph Emerson', '1'),
(1462, 'Many people have gone further than they thought they could because someone else thought they could.', 'Anonymous', '1'),
(1463, 'We read the world wrong and say that it deceives us.', 'Rabindranath Tagore', '1'),
(1464, 'If only wed stop trying to be happy wed have a pretty good time.', 'Edith Wharton', '1'),
(1465, 'You must do the things you think you cannot do.', 'Eleanor Roosevelt', '1'),
(1466, 'Be yourself; everyone else is already taken.', 'Oscar Wilde', '1'),
(1467, 'The mark of your ignorance is the depth of your belief in injustice and tragedy. What the caterpillar calls the end of the world, the Master calls the butterfly.', 'Richard Bach', '1'),
(1468, 'I am glad that I paid so little attention to good advice; had I abided by it I might have been saved from some of my most valuable mistakes.', 'Edna Millay', '1'),
(1469, 'Most folks are as happy as they make up their minds to be.', 'Abraham Lincoln', '1'),
(1470, 'Love is the master key that opens the gates of happiness.', 'Oliver Holmes', '1'),
(1471, 'The person who makes a success of living is the one who see his goal steadily and aims for it unswervingly. That is dedication.', 'Cecil B. DeMille', '1'),
(1472, 'My reputation grows with every failure.', 'George Shaw', '1'),
(1473, 'Good thoughts are no better than good dreams, unless they be executed.', 'Ralph Emerson', '1'),
(1474, 'Happiness does not come about only due to external circumstances; it mainly derives from inner attitudes.', 'Dalai Lama', '1'),
(1475, 'However many holy words you read, however many you speak, what good will they do you if you do not act on upon them?', 'Buddha', '1'),
(1476, 'For success, attitude is equally as important as ability.', 'Harry Banks', '1'),
(1477, 'If you are going to achieve excellence in big things, you develop the habit in little matters. Excellence is not an exception, it is a prevailing attitude.', 'Colin Powell', '1'),
(1478, 'A person who never made a mistake never tried anything new.', 'Albert Einstein', '1'),
(1479, 'Better than a thousand hollow words is one word that brings peace.', 'Buddha', '1'),
(1480, 'The possibilities are numerous once we decide to act and not react.', 'George Bernard Shaw', '1'),
(1481, 'Almost everything comes from nothing.', 'Henri Amiel', '1'),
(1482, 'Sometimes by losing a battle you find a new way to win the war.', 'Donald Trump', '1'),
(1483, 'Listen to what you know instead of what you fear.', 'Richard Bach', '1'),
(1484, 'It is easier to live through someone else than to become complete yourself.', 'Betty Friedan', '1'),
(1485, 'If you\'re in a bad situation, don\'t worry it\'ll change. If you\'re in a good situation, don\'t worry it\'ll change.', 'John Simone', '1'),
(1486, 'Remember that failure is an event, not a person.', 'Zig Ziglar', '1'),
(1487, 'Don\'t settle for a relationship that won\'t let you be yourself.', 'Oprah Winfrey', '1'),
(1488, 'What the caterpillar calls the end of the world, the master calls a butterfly.', 'Richard Bach', '1'),
(1489, 'Instead of saying that man is the creature of circumstance, it would be nearer the mark to say that man is the architect of circumstance.', 'Thomas Carlyle', '1'),
(1490, 'If you do what you\'ve always done, you\'ll get what youve always gotten.', 'Tony Robbins', '1'),
(1491, 'Do not wait for leaders; do it alone, person to person.', 'Mother Teresa', '1'),
(1492, 'Knowledge has three degrees opinion, science, illumination. The means or instrument of the first is sense; of the second, dialectic; of the third, intuition.', 'Plotinus', '1'),
(1493, 'Love vanquishes time. To lovers, a moment can be eternity, eternity can be the tick of a clock.', 'Mary Parrish', '1'),
(1494, 'We never live; we are always in the expectation of living.', 'Voltaire', '1'),
(1495, 'Think like a man of action; act like a man of thought.', 'Henri L. Bergson', '1'),
(1496, 'You can complain because roses have thorns, or you can rejoice because thorns have roses.', 'Ziggy', '1'),
(1497, 'There is not one big cosmic meaning for all, there is only the meaning we each give to our life.', 'Anais Nin', '1'),
(1498, 'A leader is best when people barely know he exists, when his work is done, his aim fulfilled, they will say: we did it ourselves.', 'Lao Tzu', '1'),
(1499, 'Time you enjoyed wasting was not wasted.', 'John Lennon', '1'),
(1500, 'You will never be happy if you continue to search for what happiness consists of. You will never live if you are looking for the meaning of life.', 'Albert Camus', '1'),
(1501, 'Genuine sincerity opens people\'s hearts, while manipulation causes them to close.', 'Daisaku Ikeda', '1'),
(1502, 'To give ones self earnestly to the duties due to men, and, while respecting spiritual beings, to keep aloof from them, may be called wisdom.', 'Confucius', '1'),
(1503, 'A man\'s dreams are an index to his greatness.', 'Zadok Rabinowitz', '1'),
(1504, 'This is the final test of a gentleman: his respect for those who can be of no possible value to him.', 'William Lyon Phelps', '1'),
(1505, 'You teach best what you most need to learn.', 'Richard Bach', '1'),
(1506, 'Continuous effort, not strength or intelligence is the key to unlocking our potential.', 'Winston Churchill', '1'),
(1507, 'Obstacles are those frightful things you see when you take your eyes off your goal.', 'Henry Ford', '1'),
(1508, 'Go for it now. The future is promised to no one.', 'Wayne Dyer', '1'),
(1509, 'Never tell a young person that anything cannot be done. God may have been waiting centuries for someone ignorant enough of the impossible to do that very thing.', 'John Holmes', '1'),
(1510, 'Bold is not the act of foolishness but the attribute and inner strength to act when others will not so as to move forward not backward.', 'Byron Pulsifer', '1'),
(1511, 'If we look at the world with a love of life, the world will reveal its beauty to us.', 'Daisaku Ikeda', '1'),
(1512, 'In skating over thin ice our safety is in our speed.', 'Ralph Emerson', '1'),
(1513, 'When you discover your mission, you will feel its demand. It will fill you with enthusiasm and a burning desire to get to work on it.', 'W. Clement Stone', '1'),
(1514, 'Never promise more than you can perform.', 'Publilius Syrus', '1'),
(1515, 'If you don\'t go after what you want, you\'ll never have it. If you don\'t ask, the answer is always no. If you don\'t step forward, you\'re always in the same place.', 'Nora Roberts', '1'),
(1516, 'I can\'t believe that God put us on this earth to be ordinary.', 'Lou Holtz', '1'),
(1517, 'There are no limitations to the mind except those we acknowledge.', 'Napoleon Hill', '1'),
(1518, 'It is through science that we prove, but through intuition that we discover.', 'Jules Poincare', '1'),
(1519, 'Don\'t be dismayed by good-byes. A farewell is necessary before you can meet again. And meeting again, after moments or lifetimes, is certain for those who are friends.', 'Richard Bach', '1'),
(1520, 'If someone in your life talked to you the way you talk to yourself, you would have left them long ago.', 'Carla Gordon', '1'),
(1521, 'The cosmos is neither moral or immoral; only people are. He who would move the world must first move himself.', 'Edward Ericson', '1'),
(1522, 'If you lose today, win tomorrow. In this never-ending spirit of challenge is the heart of a victor.', 'Daisaku Ikeda', '1'),
(1523, 'There is a way that nature speaks, that land speaks. Most of the time we are simply not patient enough, quiet enough, to pay attention to the story.', 'Linda Hogan', '1'),
(1524, 'Never tell me the sky is the limit when there are footprints on the moon.', 'Anonymous', '1'),
(1525, 'I cannot say whether things will get better if we change; what I can say is they must change if they are to get better.', 'Georg Lichtenberg', '1'),
(1526, 'The greater part of human pain is unnecessary. It is self-created as long as the unobserved mind runs your life.', 'Eckhart Tolle', '1'),
(1527, 'Take it easy but take it.', 'Woody Guthrie', '1'),
(1528, 'Blessed is the man who expects nothing, for he shall never be disappointed.', 'Alexander Pope', '1'),
(1529, 'He who knows others is wise. He who knows himself is enlightened.', 'Lao Tzu', '1'),
(1530, 'The best way to predict your future is to create it.', 'Peter Drucker', '1'),
(1531, 'A garden is always a series of losses set against a few triumphs, like life itself.', 'May Sarton', '1'),
(1532, 'If facts are the seeds that later produce knowledge and wisdom, then the emotions and the impressions of the senses are the fertile soil in which the seeds must grow.', 'Rachel Carson', '1'),
(1533, 'Never mistake motion for action.', 'Ernest Hemingway', '1'),
(1534, 'One needs something to believe in, something for which one can have whole-hearted enthusiasm. One needs to feel that ones life has meaning, that one is needed in this world.', 'Hannah Senesh', '1'),
(1535, 'One who is too insistent on his own views, finds few to agree with him.', 'Lao Tzu', '1'),
(1536, 'Translation is the paradigm, the exemplar of all writing. It is translation that demonstrates most vividly the yearning for transformation that underlies every act involving speech, that supremely human gift.', 'Harry Burchell Mathews', '1'),
(1537, 'Meditation is the dissolution of thoughts in eternal awareness or Pure consciousness without objectification, knowing without thinking, merging finitude in infinity.', 'Voltaire', '1'),
(1538, 'The reasonable man adapts himself to the world; the unreasonable man persists in trying to adapt the world to himself. Therefore, all progress depends on the unreasonable man.', 'George Shaw', '1'),
(1539, 'Good instincts usually tell you what to do long before your head has figured it out.', 'Michael Burke', '1'),
(1540, 'It isn\'t what happens to us that causes us to suffer; it\'s what we say to ourselves about what happens.', 'Pema Chodron', '1'),
(1541, 'Those who dream by day are cognizant of many things which escape those who dream only by night.', 'Edgar Allan Poe', '1'),
(1542, 'We cannot hold a torch to light another\'s path without brightening our own.', 'Ben Sweetland', '1'),
(1543, 'You are never given a wish without also being given the power to make it come true. You may have to work for it, however.', 'Richard Bach', '1'),
(1544, 'Kind words can be short and easy to speak, but their echoes are truly endless.', 'Mother Teresa', '1'),
(1545, 'Count your joys instead of your woes. Count your friends instead of your foes.', 'Anonymous', '1'),
(1546, 'Dreams come true. Without that possibility, nature would not incite us to have them.', 'John Updike', '1'),
(1547, 'Staying in one place is the best path to be taken over and surpassed by many.', 'Byron Pulsifer', '1'),
(1548, 'Imagination will often carry us to worlds that never were. But without it we go nowhere.', 'Carl Sagan', '1'),
(1549, 'When one door of happiness closes, another opens; but often we look so long at the closed door that we do not see the one which has been opened for us.', 'Helen Keller', '1'),
(1550, 'A leader or a man of action in a crisis almost always acts subconsciously and then thinks of the reasons for his action.', 'Jawaharlal Nehru', '1'),
(1551, 'I have no special talent. I am only passionately curious.', 'Albert Einstein', '1'),
(1552, 'I endeavour to be wise when I cannot be merry, easy when I cannot be glad, content with what cannot be mended and patient when there is no redress.', 'Elizabeth Montagu', '1'),
(1553, 'The height of your accomplishments will equal the depth of your convictions.', 'William Scolavino', '1'),
(1554, 'If I am not for myself, who will be for me? If I am not for others, what am I? And if not now, when?', 'Rabbi Hillel', '1'),
(1555, 'When I dare to be powerful, to use my strength in the service of my vision, then it becomes less and less important whether I am afraid.', 'Audre Lorde', '1'),
(1556, 'All great men are gifted with intuition. They know without reasoning or analysis, what they need to know.', 'Alexis Carrel', '1'),
(1557, 'To get the full value of joy you must have someone to divide it with.', 'Mark Twain', '1'),
(1558, 'Sometimes our fate resembles a fruit tree in winter. Who would think that those branches would turn green again and blossom, but we hope it, we know it.', 'Johann Wolfgang von Goethe', '1'),
(1559, 'We lost because we told ourselves we lost.', 'Leo Tolstoy', '1'),
(1560, 'Success is determined by those whom prove the impossible, possible.', 'James Pence', '1'),
(1561, 'Good advice is always certain to be ignored, but that\'s no reason not to give it.', 'Agatha Christie', '1'),
(1562, 'The winner ain\'t the one with the fastest car it\'s the one who refuses to lose.', 'Dale Earnhardt', '1'),
(1563, 'Spirituality can be severed from both vicious sectarianism and thoughtless banalities. Spirituality, I have come to see, is nothing less than the thoughtful love of life.', 'Robert C. Solomon', '1'),
(1564, 'No one has a finer command of language than the person who keeps his mouth shut.', 'Sam Rayburn', '1'),
(1565, 'The only person who never makes mistakes is the person who never does anything.', 'Denis Waitley', '1'),
(1566, 'Life is what happens to you while you\'re busy making other plans.', 'John Lennon', '1'),
(1567, 'Discovery consists of seeing what everybody has seen and thinking what nobody else has thought.', 'Jonathan Swift', '1'),
(1568, 'If you have knowledge, let others light their candles in it.', 'Margaret Fuller', '1'),
(1569, 'It is impossible for a man to learn what he thinks he already knows.', 'Epictetus', '1'),
(1570, 'If you find yourself in a hole, the first thing to do is stop digging.', 'Will Rogers', '1'),
(1571, 'To make no mistakes is not in the power of man; but from their errors and mistakes the wise and good learn wisdom for the future.', 'Plutarch', '1'),
(1572, 'I think you can have moderate success by copying something else, but if you really want to knock it out of the park, you have to do something different and take chances.', 'Lee Womack', '1'),
(1573, 'Everything we hear is an opinion, not a fact. Everything we see is a perspective, not the truth.', 'Marcus Aurelius', '1'),
(1574, 'Six essential qualities that are the key to success: Sincerity, personal integrity, humility, courtesy, wisdom, charity.', 'William Menninger', '1'),
(1575, 'I have an everyday religion that works for me. Love yourself first, and everything else falls into line.', 'Lucille Ball', '1'),
(1576, 'Flow with whatever is happening and let your mind be free. Stay centred by accepting whatever you are doing. This is the ultimate.', 'Chuang Tzu', '1'),
(1577, 'Nothing could be worse than the fear that one had given up too soon, and left one unexpended effort that might have saved the world.', 'Jane Addams', '1'),
(1578, 'The energy of the mind is the essence of life.', 'Aristotle', '1'),
(1579, 'Begin, be bold, and venture to be wise.', 'Horace', '1'),
(1580, 'Give a man a fish and you feed him for a day. Teach him how to fish and you feed him for a lifetime.', 'Lao Tzu', '1'),
(1581, 'A wise man will make more opportunities than he finds.', 'Francis Bacon', '1'),
(1582, 'Slow down and enjoy life. It\'s not only the scenery you miss by going too fast you also miss the sense of where you are going and why.', 'Eddie Cantor', '1'),
(1583, 'Miracles come in moments. Be ready and willing.', 'Wayne Dyer', '1'),
(1584, 'Numberless are the worlds wonders, but none more wonderful than man.', 'Sophocles', '1'),
(1585, 'So is cheerfulness, or a good temper, the more it is spent, the more remains.', 'Ralph Emerson', '1'),
(1586, 'The true way to render ourselves happy is to love our work and find in it our pleasure.', 'Francoise de Motteville', '1'),
(1587, 'When you judge another, you do not define them, you define yourself.', 'Wayne Dyer', '1'),
(1588, 'Argue for your limitations, and sure enough they\'re yours.', 'Richard Bach', '1'),
(1589, 'He who wishes to secure the good of others, has already secured his own.', 'Confucius', '1'),
(1590, 'Wise men talk because they have something to say; fools, because they have to say something.', 'Plato', '1'),
(1591, 'Life is really simple, but we insist on making it complicated.', 'Confucius', '1'),
(1592, 'The future is an opaque mirror. Anyone who tries to look into it sees nothing but the dim outlines of an old and worried face.', 'Jim Bishop', '1'),
(1593, 'Everything that irritates us about others can lead us to a better understanding of ourselves.', 'Carl Jung', '1'),
(1594, 'Beware of the half truth. You may have gotten hold of the wrong half.', 'Anonymous', '1'),
(1595, 'The greatest mistake you can make in life is to be continually fearing you will make one.', 'Elbert Hubbard', '1'),
(1596, 'I have never been hurt by anything I didn\'t say.', 'Calvin Coolidge', '1'),
(1597, 'Be not angry that you cannot make others as you wish them to be, since you cannot make yourself as you wish to be.', 'Thomas Kempis', '1'),
(1598, 'Adversity causes some men to break, others to break records.', 'William Ward', '1'),
(1599, 'An invincible determination can accomplish almost anything and in this lies the great distinction between great men and little men.', 'Thomas Fuller', '1'),
(1600, 'The industrial landscape is already littered with remains of once successful companies that could not adapt their strategic vision to altered conditions of competition.', 'Abernathy', '1'),
(1601, 'Example has more followers than reason.', 'Christian Bovee', '1'),
(1602, 'One that desires to excel should endeavour in those things that are in themselves most excellent.', 'Epictetus', '1'),
(1603, 'If you have made mistakes, there is always another chance for you. You may have a fresh start any moment you choose.', 'Mary Pickford', '1'),
(1604, 'The only Zen you find on the tops of mountains is the Zen you bring up there.', 'Robert Pirsig', '1'),
(1605, 'Gratitude is riches. Complaint is poverty.', 'Doris Day', '1'),
(1606, 'Strong people make as many mistakes as weak people. Difference is that strong people admit their mistakes, laugh at them, learn from them. That is how they become strong.', 'Richard Needham', '1'),
(1607, 'To know your purpose is to live a life of direction, and in that direction is found peace and tranquillity.', 'Byron Pulsifer', '1'),
(1608, 'You can stand tall without standing on someone. You can be a victor without having victims.', 'Harriet Woods', '1'),
(1609, 'Bad times have a scientific value. These are occasions a good learner would not miss.', 'Ralph Emerson', '1'),
(1610, 'It\'s not who you are that holds you back, it\'s who you think you\'re not.', 'Anonymous', '1'),
(1611, 'All children are artists. The problem is how to remain an artist once he grows up.', 'Pablo Picasso', '1'),
(1612, 'Either I will find a way, or I will make one.', 'Philip Sidney', '1'),
(1613, 'He who knows that enough is enough will always have enough.', 'Lao Tzu', '1'),
(1614, 'The only way to have a friend is to be one.', 'Ralph Emerson', '1'),
(1615, 'If we had no winter, the spring would not be so pleasant; if we did not sometimes taste of adversity, prosperity would not be so welcome.', 'Anne Bradstreet', '1'),
(1616, 'Joy is what happens to us when we allow ourselves to recognize how good things really are.', 'Marianne Williamson', '1'),
(1617, 'Your vision will become clear only when you can look into your own heart. Who looks outside, dreams; who looks inside, awakes.', 'Carl Jung', '1'),
(1618, 'There is never enough time to do everything, but there is always enough time to do the most important thing.', 'Brian Tracy', '1'),
(1619, 'You really can change the world if you care enough.', 'Marian Edelman', '1'),
(1620, 'What you are is what you have been. What you will be is what you do now.', 'Buddha', '1'),
(1621, 'Our lives are the only meaningful expression of what we believe and in Whom we believe. And the only real wealth, for any of us, lies in our faith.', 'Gordon Hinckley', '1'),
(1622, 'There surely is in human nature an inherent propensity to extract all the good out of all the evil.', 'Benjamin Haydon', '1'),
(1623, 'Music in the soul can be heard by the universe.', 'Lao Tzu', '1'),
(1624, 'What we see depends mainly on what we look for.', 'John Lubbock', '1'),
(1625, 'To hell with circumstances; I create opportunities.', 'Bruce Lee', '1'),
(1626, 'The truest greatness lies in being kind, the truest wisdom in a happy mind.', 'Ella Wilcox', '1'),
(1627, 'An ounce of emotion is equal to a ton of facts.', 'John Junor', '1'),
(1628, 'We need to find the courage to say NO to the things and people that are not serving us if we want to rediscover ourselves and live our lives with authenticity.', 'Barbara De Angelis', '1'),
(1629, 'Great is the art of beginning, but greater is the art of ending.', 'Lazurus Long', '1'),
(1630, 'Simply put, you believer that things or people make you unhappy, but this is not accurate. You make yourself unhappy.', 'Wayne Dyer', '1'),
(1631, 'Nothing will work unless you do.', 'Maya Angelou', '1'),
(1632, 'Our ability to achieve happiness and success depends on the strength of our wings.', 'Catherine Pulsifer', '1'),
(1633, 'To go against the dominant thinking of your friends, of most of the people you see every day, is perhaps the most difficult act of heroism you can perform.', 'Theodore H. White', '1'),
(1634, 'Gratitude makes sense of our past, brings peace for today, and creates a vision for tomorrow.', 'Melody Beattie', '1'),
(1635, 'Into each life rain must fall but rain can be the giver of life and it is all in your attitude that makes rain produce sunshine.', 'Byron Pulsifer', '1'),
(1636, 'We are all inclined to judge ourselves by our ideals; others, by their acts.', 'Harold Nicolson', '1'),
(1637, 'Nothing is a waste of time if you use the experience wisely.', 'Rodin', '1'),
(1638, 'If one way be better than another, that you may be sure is natures way.', 'Aristotle', '1'),
(1639, 'Here is one quality that one must possess to win, and that is definiteness of purpose, the knowledge of what one wants, and a burning desire to possess it.', 'Napoleon Hill', '1'),
(1640, 'It is not in the stars to hold our destiny but in ourselves.', 'William Shakespeare', '1'),
(1641, 'Using the power of decision gives you the capacity to get past any excuse to change any and every part of your life in an instant.', 'Tony Robbins', '1'),
(1642, 'I will prepare and some day my chance will come.', 'Abraham Lincoln', '1'),
(1643, 'Sometimes the cards we are dealt are not always fair. However you must keep smiling and moving on.', 'Tom Jackson', '1'),
(1644, 'The best among you is the one who doesn’t harm others with his tongue and hands.', 'Prophet Muhammad (PBUH)', '2'),
(1645, 'I leave behind me two things, The Quran and My Sunnah and if you follow these you will never go astray.', 'Prophet Muhammad (PBUH)', '2'),
(1646, 'Do not wish to be like anyone except in two cases. The first is a person, whom Allah has given wealth & he spends it righteously; (the second is) the one whom Allah has given wisdom (the Holy Quran) and he acts according to it and teaches it to others.', 'Prophet Muhammad (PBUH)', '2'),
(1647, 'Do not waste water even if you were at a running stream.', 'Prophet Muhammad (PBUH)', '2'),
(1648, 'Four things support the world: the learning of the wise, the justice of the great, the prayers of the good, and the valor of the brave.', 'Prophet Muhammad (PBUH)', '2'),
(1649, 'Leave me as I leave you, for the people who were before you were ruined because their questions and their differences over the prophets. So, if I forbid you to do something, then keep away from it. And if I order you to do something, then do of it as much as you can.', 'Prophet Muhammad (PBUH)', '2'),
(1650, 'Do you know what is better than charity and fasting and prayer? It is keeping peace and good relations between people, as quarrels and bad feelings destroy mankind.', 'Prophet Muhammad (PBUH)', '2'),
(1651, 'It is better to sit alone than in company with the bad; and it is better still to sit with the good than alone. It is better to speak to a seeker of knowledge than to remain silent; but silence is better than idle words.', 'Prophet Muhammad (PBUH)', '2'),
(1652, 'Modesty brings nothing except good.', 'Prophet Muhammad (PBUH)', '2'),
(1653, 'Richness is not having many belongings, but richness is contentment of the soul.', 'Prophet Muhammad (PBUH)', '2'),
(1654, 'There is reward for kindness to every living thing.', 'Prophet Muhammad (PBUH)', '2'),
(1655, 'The best among you are those who have the best manners and character.', 'Prophet Muhammad (PBUH)', '2'),
(1656, 'Seek knowledge from cradle to the grave.', 'Prophet Muhammad (PBUH)', '2'),
(1657, 'Verily, Allah is mild and is fond of mildness, and He gives to the mild what He does not give to the harsh.', 'Prophet Muhammad (PBUH)', '2'),
(1658, 'When two persons are together, two of them must not whisper to each other, without letting the third hear; because it would hurt him.', 'Prophet Muhammad (PBUH)', '2'),
(1659, 'He, who wishes to enter paradise at the best gate, must please his father and mother.', 'Prophet Muhammad (PBUH)', '2'),
(1660, 'He who has in his heart the weight of a mustard seed of pride shall not enter paradise.', 'Prophet Muhammad (PBUH)', '2'),
(1661, 'How wonderful is the situation of a believer. There is good for him in everything and this applies only to a believer. If prosperity comes to him, he expresses gratitude to God and that is good for him; and if adversity befalls him, he endures it patiently and that is better for him.', 'Prophet Muhammad (PBUH)', '2'),
(1662, 'Be not like the hypocrite who, when he talks, tells lies; when he gives a promise, he breaks it; and when he is trusted, he proves dishonest.', 'Prophet Muhammad (PBUH)', '2'),
(1663, 'Kindness is a mark of faith and whoever is not kind has no faith.', 'Prophet Muhammad (PBUH)', '2'),
(1664, 'He is not of us who is not affectionate to the little ones and does not respect the old; and he is not of us, who does not order which is lawful, and prohibits that which is unlawful.', 'Prophet Muhammad (PBUH)', '2'),
(1665, 'Every religion has its distinct characteristic, and the distinct characteristic of Islam is modesty.', 'Prophet Muhammad (PBUH)', '2'),
(1666, 'Richness is not having many possessions, but richness is being content with oneself.', 'Prophet Muhammad (PBUH)', '2'),
(1667, 'When someone spends on his family seeking His Reward for it from Allah, it is counted as a charity from him.', 'Prophet Muhammad (PBUH)', '2'),
(1668, 'Keep yourself far from envy; because it eats up and takes away good actions, like a fire eats up and burn woods.', 'Prophet Muhammad (PBUH)', '2'),
(1669, 'Allah will cover up on the day of resurrection the defects (faults) of the one who covers up the faults of the others in this world.', 'Prophet Muhammad (PBUH)', '2'),
(1670, 'When you see a person who has been given more than you in money & beauty, then look at those who have been given less.', 'Prophet Muhammad (PBUH)', '2'),
(1671, 'Be afraid of nothing but sins.', 'Prophet Muhammad (PBUH)', '2'),
(1672, 'The greatest Jihad is to battle your own soul. To fight the evil within yourself.', 'Prophet Muhammad (PBUH)', '2'),
(1673, 'In 3 situations, if you pray dua, it will be definitely be accepted:\r\n1.When your body starts shaking.\r\n2.When you got fear in your heart.\r\n3.When you got tears in your eyes. The Prophet also said: “Whoever shares this knowledge, he will have a house in front of me in Jannah.', 'Prophet Muhammad (PBUH)', '2'),
(1674, 'Indeed, sustenance (rizq) searches for the slave more than his appointed time of death searches for him.', 'Prophet Muhammad (PBUH)', '2'),
(1675, 'It is also charity to utter a good word.', 'Prophet Muhammad (PBUH)', '2'),
(1676, 'Best way to defend Islam, is to practice Islam.', 'Prophet Muhammad (PBUH)', '2'),
(1677, 'He (PBUH) treated his enemies better than we treat those who love us.', 'Prophet Muhammad (PBUH)', '2'),
(1678, 'When a husband and wife look at each other with love, Allah looks at both of them with mercy.', 'Prophet Muhammad (PBUH)', '2'),
(1679, 'You will die the way you lived.', 'Prophet Muhammad (PBUH)', '2'),
(1680, 'Fear Allah wherever you are, follow a bad deed with a good deed to erase it, and treat people with a good attitude.', 'Prophet Muhammad (PBUH)', '2'),
(1681, 'In the morning, charity is due on every joint bone of the body of everyone of you. Every utterance of Allah’s glorification (i.e. saying Subhan Allah) is an act of charity, and two rakath prayers which one performs in the forenoon is equal to all this (in reward).', 'Prophet Muhammad (PBUH)', '2'),
(1682, 'What actions are most excellent? To gladden the heart of human beings, to feed the hungry, to help the afflicted, to lighten the sorrow of the sorrowful, and to remove the sufferings of the injured.', 'Prophet Muhammad (PBUH)', '2'),
(1683, 'The first matter that the slave will be brought to account for on the day of judgement is the prayer. If it is sound, then the rest of his deeds will be sound. And if it is bad, then the rest of his deeds will be bad.', 'Prophet Muhammad (PBUH)', '2'),
(1684, 'Beware! Whoever is cruel and harsh to a non-Muslim minority, curtailing their rights, overburdening them, or stealing from them, I will complain [to God] about that person on the Day of Judgement.', 'Prophet Muhammad (PBUH)', '2'),
(1685, 'The world is a prison for a believer and paradise for a disbeliever.', 'Prophet Muhammad (PBUH)', '2'),
(1686, 'When Allah s.w.t. wishes good for someone, He bestows upon him the understanding of Deen.', 'Prophet Muhammad (PBUH)', '2'),
(1687, 'The people whom I hate the most and who are the farthest from me on the Day of Judgement are those who talk uselessly, and those who put down others, and those who show off when they talk.', 'Prophet Muhammad (PBUH)', '2'),
(1688, 'Shall I not tell you who will be forbidden from fire? It will be forbidden for every gentle, soft-hearted and kind person.', 'Prophet Muhammad (PBUH)', '2'),
(1689, 'A Muslim who plants a tree or sows a field, from which man, birds and animals can eat, is committing an act of charity.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1690, 'There is a polish for everything that takes away rust; and the polish for the heart is the remembrance of Allah.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1691, 'What actions are most excellent ? To gladden the heart of human beings, to feed the hungry, to help the afflicted, to lighten the sorrow of the sorrowful, and to remove the sufferings of the injured.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1692, 'The most excellent Jihad is that for the conquest of self.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1693, 'If you put your whole trust in Allah, as you ought, He most certainly will satisfy your needs, as He satisfies those of the birds . They come out hungry in the morning, but return full to their nests.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1694, 'Allah will not give mercy to anyone, except those who give mercy to other creatures.', 'Prophet Muhammad (PBUH) - (Abdullah b . Amr: Abu Dawud & Tirmidhi)', '2'),
(1695, 'Say what is true, although it may be bitter and displeasing to people.', 'Prophet Muhammad (PBUH) - (Baihaqi)', '2'),
(1696, 'Kindness is a mark of faith, and whoever is not kind has no faith.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1697, 'When you see a person who has been given more than you in money and beauty, look to those, who have been given less.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1698, 'If you do not feel ashamed of anything, then you can do whatever you like.', 'Prophet Muhammad (PBUH) - (Abu-Masud: Bukhari)', '2'),
(1699, 'It is better to sit alone than in company with the bad; and it is better still to sit with the good than alone . It is better to speak to a seeker of knowledge than to remain silent; but silence is better than idle words.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1700, 'Verily, a man teaching his child manners is better than giving one bushel of grain in alms.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1701, 'Whoever is kind, Allah will be kind to him; therefore be kind to man on the earth . He who is in heaven will show mercy on you.', 'Prophet Muhammad (PBUH) - (Abu Dawud: Tirmidhi)', '2'),
(1702, 'It is difficult for a man laden with riches to climb the steep path, that leads to bliss.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1703, 'The best of you are those who are best to the women.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1704, 'Whoever loveth to meet God, God loveth to meet him', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1705, 'Once a man, who was passing through a road, found a branch of a tree with thorns obstructing it . The man removed the thorns from the way. Allah thanked him and forgave his sins.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1706, 'Who are the learned? Those who practice what they know.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1707, 'Allah has revealed to me, that you must be humble . No one should boast over one another, and no one should oppress another.', 'Prophet Muhammad (PBUH) - (Iyad b. Hinar al-Mujashi: Muslim)', '2'),
(1708, 'A true Muslim is thankful to Allah in prosperity, and resigned to His will in adversity.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1709, 'A Muslim who meets with others and shares their burdens is better than one who lives a life of seclusion and contemplation.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1710, 'Serve Allah, as you would if you could see Him; although you cannot see Him, He can see you.', 'Prophet Muhammad (PBUH) - (Umar: Muslim)', '2'),
(1711, 'Allah does not look at your appearance or your possessions; but He looks at your heart and your deeds.', 'Prophet Muhammad (PBUH) - (Abu Huraira: Muslim)', '2'),
(1712, 'The best richness is the richness of the soul.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1713, 'Keep yourselves far from envy; because it eats up and takes away good actions, like a fire eats up and burns wood.', 'Prophet Muhammad (PBUH) - (Abu Dawud)', '2'),
(1714, 'Much silence and a good disposition, there are no two things better than these.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1715, 'Verily, Allah is mild and is fond of mildness, and He gives to the mild what He does not give to the harsh.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1716, 'Once the Prophet was asked: “Tell us, which action is dearest to Allah?” He answered: “To say your prayer at its proper time.” Again he was asked: “What comes next?” Mohammad said: “To show kindness to parents.” “Then what?” he was asked, “To strive for the cause of Allah!', 'Prophet Muhammad (PBUH) - (Ibn Masad: Bukhari)', '2'),
(1717, 'When two persons are together, two of them must not whisper to each other, without letting the third hear; because it would hurt him.', 'Prophet Muhammad (PBUH) - (Bukhari & Muslim)', '2'),
(1718, 'Verily, it is one of the respects to Allah to honor an old man.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1719, 'I command you to treat women kindly…', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1720, 'All Muslims are like a foundation, each strengthening the other; in such a way they do support each other.', 'Prophet Muhammad (PBUH) - (Abu Musa: Bukhari & Muslim)', '2'),
(1721, 'Strive always to excel in virtue and truth.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1722, 'You will not enter paradise until you have faith; and you will not complete your faith till you love one another.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1723, 'He, who wishes to enter paradise at the best gate, must please his father and mother.', 'Prophet Muhammad (PBUH) - (Bukhari & Muslim)', '2'),
(1724, 'I am leaving two things among you, and if you cling to them firmly you will never go astray; one is the Book of Allah and the other is my way of life.', 'Prophet Muhammad (PBUH) - (Last Sermon on the Mount)', '2'),
(1725, 'Allah is One and likes Unity.', 'Prophet Muhammad (PBUH) - (Muslim)', '2'),
(1726, 'The best of alms is that, which the right hand gives and the left hand knows not of.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1727, 'The perfect Muslim is not a perfect Muslim, who eats till he is full and leaves his neighbors hungry.', 'Prophet Muhammad (PBUH) - (Ibn Abbas: Baihaqi)', '2'),
(1728, 'He is not of us who is not affectionate to the little ones, and does not respect the old; and he is not of us, who does not order which is lawful, and prohibits that which is unlawful.', 'Prophet Muhammad (PBUH) - (Ibn Abbas: Tirmidhi)', '2'),
(1729, 'No man is a true believer unless he desires for his brother that, what he desires for himself.', 'Prophet Muhammad (PBUH) - (Abu Hamza Anas: Bukhari & Muslim)', '2'),
(1730, 'To strive for the cause of Allah from daybreak to noon and sunset is better than the goods and enjoyment of the whole worldly life.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1731, 'Be not like the hypocrite who, when he talks, tells lies; when he gives a promise, he breaks it; and when he is trusted, he proves dishonest.', 'Prophet Muhammad (PBUH) - (Bukhari & Muslim)', '2'),
(1732, 'The proof of a Muslim’s sincerity is, that he pays no heed to that, which is not his business.', 'Prophet Muhammad (PBUH) - (Abu Hureira: Tirmidhi)', '2'),
(1733, 'Do you know what is better than charity and fasting and prayer ? It is keeping peace and good relations between people as quarrels and bad feelings destroy mankind.', 'Prophet Muhammad (PBUH) - (Muslims & Bukhari)', '2'),
(1734, 'Conduct yourself in this world as if you are here to stay forever; prepare for eternity as if you have to die tomorrow.', 'Prophet Muhammad (PBUH) - (Bukhari)', '2'),
(1735, 'The human being does not fill up any vessel worse than his stomach.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1736, 'The worldly comforts are not for me. I am like a traveler, who takes a rest under a tree in the shade and then goes on his way.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1737, 'Women are the twin halves of men.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1738, 'A father gives his child nothing better than a good education.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2'),
(1739, 'The strong person is not the one who can wrestle someone else down. The strong person is the one who can control himself when he is angry.', 'Prophet Muhammad (PBUH) - (Bukhari & Muslim)', '2'),
(1740, 'The seeking of knowledge is obligatory for every Muslim.', 'Prophet Muhammad (PBUH) - (Tirmidhi)', '2');

DROP TABLE IF EXISTS `rate_analysis`;
CREATE TABLE `rate_analysis` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `One` text NOT NULL,
  `Two` text NOT NULL,
  `Three` text NOT NULL,
  `Four` text NOT NULL,
  `Five` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `refresh_leave_quota`;
CREATE TABLE `refresh_leave_quota` (
  `ID` int(11) NOT NULL,
  `Year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `reimbursements`;
CREATE TABLE `reimbursements` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Type` text NOT NULL,
  `Receipt` text NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `resumes`;
CREATE TABLE `resumes` (
  `ID` int(11) NOT NULL,
  `Resume` text NOT NULL,
  `PostID` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `rewards`;
CREATE TABLE `rewards` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Amount` float(11,2) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `roster`;
CREATE TABLE `roster` (
  `ID` int(11) NOT NULL,
  `FromDate` text NOT NULL,
  `ToDate` text NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `CompanyID` text NOT NULL,
  `LocationID` text NOT NULL,
  `What` text NOT NULL,
  `Reason` text NOT NULL,
  `PerformedBy` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `roster_login_history`;
CREATE TABLE `roster_login_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LoginTime` time DEFAULT NULL,
  `MLoginTime` time DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `Late` tinyint(1) NOT NULL DEFAULT 0,
  `EarlyDep` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDay` tinyint(1) NOT NULL DEFAULT 0,
  `ScheduleArrival` text DEFAULT NULL,
  `ScheduleDepart` text DEFAULT NULL,
  `LateArrival` text DEFAULT NULL,
  `EarlyDepart` text DEFAULT NULL,
  `Status` varchar(15) DEFAULT NULL,
  `MStatus` text DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `LastModified` int(11) NOT NULL,
  `Updated` int(11) NOT NULL DEFAULT 0,
  `DateModified` datetime NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `roster_logout_history`;
CREATE TABLE `roster_logout_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LogoutTime` time DEFAULT NULL,
  `MLogoutTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL,
  `ArrivalTime` text NOT NULL,
  `DepartTime` text NOT NULL,
  `LateArrival` text NOT NULL,
  `EarlyDepart` text NOT NULL,
  `ArrivalHalfDay` text NOT NULL,
  `DepartHalfDay` text NOT NULL,
  `DayNight` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = day and 1 = night'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `schedules` (`ID`, `Name`, `CompanyID`, `Status`, `DateAdded`, `DateModified`, `ArrivalTime`, `DepartTime`, `LateArrival`, `EarlyDepart`, `ArrivalHalfDay`, `DepartHalfDay`, `DayNight`) VALUES
(1, '09:00 PM to 06:00 AM', 1, 1, '2020-12-17 00:00:00', '2020-07-22 20:45:11', '21:00:00', '06:00:00', '21:31:00', '05:30:00', '23:00:00', '04:00:00', 1),
(3, '08:00 PM to 05:00AM', 1, 1, '2020-01-06 18:40:17', '2020-07-22 20:51:29', '20:00:00', '05:00:00', '20:31:00', '04:30:00', '22:01:00', '03:00:00', 1),
(4, '03:00 PM to 12:00 AM', 1, 1, '2016-01-06 18:43:32', '2020-07-29 19:52:28', '15:00:00', '00:00:00', '15:31:00', '23:30:00', '17:01:00', '22:00:00', 1),
(5, '08:00 AM to 05:00 PM', 1, 1, '2016-01-06 18:46:08', '2020-07-22 21:10:51', '08:00:00', '17:00:00', '08:31:00', '16:30:00', '10:01:00', '15:00:00', 0),
(6, '07:00 AM to 04:00 PM', 1, 1, '2016-03-14 18:50:53', '2020-07-22 20:41:26', '07:00:00', '16:00:00', '07:31:00', '15:30:00', '09:01:00', '14:00:00', 0),
(7, '11:00 AM to 08:00 PM', 1, 1, '2016-03-14 18:52:50', '2020-07-22 20:40:22', '11:00:00', '20:00:00', '11:31:00', '19:30:00', '13:01:00', '18:00:00', 0),
(10, '04:00 PM to 01:00 AM', 1, 1, '2016-07-26 12:18:41', '2020-07-30 22:45:06', '16:00:00', '01:00:00', '16:31:00', '00:30:00', '18:01:00', '00:00:00', 1),
(11, '09:00 AM to 06:00 PM', 0, 1, '2020-07-25 18:13:45', '2020-07-30 21:30:28', '09:00:00', '18:00:00', '09:31:00', '17:30:00', '11:00:00', '16:00:00', 0),
(12, '11:30 AM to 08:30 PM', 0, 1, '2020-07-29 20:35:49', '0000-00-00 00:00:00', '11:30:00', '20:30:00', '12:01:00', '20:00:00', '13:31:00', '18:30:00', 0),
(13, '10:00 AM to 07:00 PM', 0, 1, '2020-07-30 21:31:48', '0000-00-00 00:00:00', '10:00:00', '19:00:00', '10:31:00', '18:30:00', '12:00:00', '17:00:00', 0),
(14, '07:00 PM to 04:00 AM', 0, 1, '2020-08-05 20:29:29', '0000-00-00 00:00:00', '19:00:00', '04:00:00', '19:31:00', '03:30:00', '21:01:00', '02:00:00', 1),
(15, '06:00 PM to 03:00 AM', 0, 1, '2020-08-14 18:18:53', '0000-00-00 00:00:00', '18:00:00', '03:00:00', '18:31:00', '02:30:00', '20:00:00', '01:00:00', 1),
(16, '11:00 PM to 08:00 AM', 0, 1, '2020-08-14 18:25:55', '0000-00-00 00:00:00', '23:00:00', '08:00:00', '23:31:00', '06:30:00', '23:59:00', '06:00:00', 1),
(17, '12:00 AM to 09:00 AM', 0, 1, '2020-08-14 18:39:58', '0000-00-00 00:00:00', '00:00:00', '09:00:00', '00:31:00', '08:30:00', '02:01:00', '07:00:00', 1),
(18, '03:00 AM to 12:00 PM (OIP)', 0, 1, '2020-08-14 18:45:50', '2020-09-28 16:52:28', '03:00:00', '12:00:00', '03:31:00', '11:30:00', '05:01:00', '10:00:00', 1),
(19, '10:00 PM to 07:00 AM', 0, 1, '2020-08-14 18:53:11', '0000-00-00 00:00:00', '22:00:00', '07:00:00', '22:31:00', '06:30:00', '23:59:00', '05:00:00', 1),
(20, '12:00 AM to 12:00 PM', 0, 1, '2020-08-14 18:55:32', '0000-00-00 00:00:00', '00:00:00', '12:00:00', '01:01:00', '11:00:00', '02:31:00', '09:30:00', 1),
(21, '09:30 PM to 06:30 AM', 0, 1, '2020-08-14 18:59:18', '0000-00-00 00:00:00', '21:30:00', '06:30:00', '22:01:00', '06:00:00', '23:31:00', '04:30:00', 1),
(22, '01:00 PM - 10:00 PM', 0, 1, '2020-08-19 20:17:56', '0000-00-00 00:00:00', '13:00:00', '22:00:00', '13:30:00', '09:31:00', '13:31:00', '21:30:00', 0),
(23, '03:30 PM to 11:30 AM', 0, 1, '2020-08-14 18:59:18', '0000-00-00 00:00:00', '13:30:00', '11:30:00', '23:01:00', '07:00:00', '23:59:00', '05:30:00', 1),
(24, '02:00 PM - 11:00 PM', 0, 1, '2020-09-22 17:46:17', '0000-00-00 00:00:00', '14:00:00', '23:00:00', '14:31:00', '22:30:00', '16:00:00', '21:00:00', 0),
(25, '03:00 AM to 12:00 PM', 0, 1, '2020-08-14 18:45:50', '2020-09-28 16:52:28', '03:00:00', '12:00:00', '03:31:00', '11:30:00', '05:01:00', '10:00:00', 0),
(26, '12:00pm to 9:00pm', 0, 1, '2020-11-05 17:23:30', '2020-11-16 13:29:44', '12:00:00', '21:00:00', '::00', '00:00:00', '::00', '::00', 0),
(27, '6:00 AM to 3:00 PM', 0, 1, '2020-11-06 15:07:52', '0000-00-00 00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0);

DROP TABLE IF EXISTS `security`;
CREATE TABLE `security` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `Rights` text NOT NULL,
  `Companies` text NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `stud_answers`;
CREATE TABLE `stud_answers` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `MaxMarks` int(11) NOT NULL,
  `ObtMarks` int(11) NOT NULL,
  `Grade` text NOT NULL,
  `Attempts` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stud_answers` (`ID`, `StudentID`, `TestID`, `MaxMarks`, `ObtMarks`, `Grade`, `Attempts`, `DateAdded`) VALUES
(1, 2166, 1, 3, 2, 'Passed', 1, '2020-02-18 18:27:19'),
(2, 1202, 1, 3, 0, 'Failed', 1, '2020-02-19 17:05:40');

DROP TABLE IF EXISTS `subdepartments`;
CREATE TABLE `subdepartments` (
  `ID` int(11) NOT NULL,
  `SubDepartment` text NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `Status` tinyint(11) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `subdepartments` (`ID`, `SubDepartment`, `DepartmentID`, `Status`, `DateAdded`, `DateModified`) VALUES
(1, 'Wordpress', 24, 1, '2020-02-15 01:06:32', '2020-02-15 01:53:33'),
(2, 'Custom PHP', 24, 1, '2020-02-15 01:53:49', '0000-00-00 00:00:00'),
(3, 'Video Animations', 24, 1, '2020-02-17 17:40:30', '0000-00-00 00:00:00'),
(4, 'UI/UX', 26, 1, '2020-02-17 17:40:53', '2020-07-22 20:09:28'),
(5, 'Front End Developer', 26, 1, '2020-02-17 17:41:06', '2020-07-22 20:09:49'),
(6, 'Graphics Designer', 26, 1, '2020-02-17 17:41:52', '2020-07-22 20:10:04'),
(7, 'Server Administrator', 24, 1, '2020-02-17 17:42:16', '0000-00-00 00:00:00'),
(8, 'Game Development', 24, 1, '2020-07-21 23:03:29', '0000-00-00 00:00:00'),
(9, 'iOS', 27, 1, '2020-07-23 18:54:01', '0000-00-00 00:00:00'),
(10, 'Android', 27, 1, '2020-07-23 18:54:16', '0000-00-00 00:00:00'),
(11, 'Hybrid', 27, 1, '2020-07-23 18:54:29', '0000-00-00 00:00:00'),
(12, 'PHP App Services', 27, 1, '2020-07-23 18:55:01', '0000-00-00 00:00:00'),
(13, 'Quality Assurance Mobile App', 27, 1, '2020-07-23 18:55:58', '0000-00-00 00:00:00'),
(14, 'Search Engine Optimization', 28, 1, '2020-07-23 21:30:45', '0000-00-00 00:00:00'),
(15, 'Social Media Marketing', 28, 1, '2020-07-23 21:31:00', '0000-00-00 00:00:00'),
(16, 'Content Writing', 28, 1, '2020-07-23 21:31:11', '0000-00-00 00:00:00'),
(17, 'Quality Assurance (TQM)', 29, 1, '2020-07-23 23:10:44', '2020-07-23 23:11:25'),
(18, 'Sales', 31, 1, '2020-07-31 20:36:30', '0000-00-00 00:00:00'),
(19, 'HR', 34, 1, '2020-08-04 18:18:38', '0000-00-00 00:00:00'),
(20, 'Support', 30, 1, '2020-08-04 19:13:02', '0000-00-00 00:00:00'),
(21, 'Front', 30, 1, '2020-08-04 19:13:14', '0000-00-00 00:00:00'),
(22, 'Front', 35, 1, '2020-08-04 19:26:49', '0000-00-00 00:00:00'),
(23, 'Support', 37, 1, '2020-08-04 19:45:13', '0000-00-00 00:00:00'),
(24, 'Front', 37, 1, '2020-08-04 19:45:23', '0000-00-00 00:00:00'),
(25, 'Front', 39, 1, '2020-08-04 19:52:21', '0000-00-00 00:00:00'),
(26, 'Support', 39, 1, '2020-08-04 19:52:28', '0000-00-00 00:00:00'),
(27, 'Front', 38, 1, '2020-08-04 21:41:14', '0000-00-00 00:00:00'),
(28, 'Support', 38, 1, '2020-08-04 21:41:20', '0000-00-00 00:00:00'),
(29, 'Production', 31, 1, '2020-08-04 21:53:24', '0000-00-00 00:00:00');

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE `taxes` (
  `ID` int(11) NOT NULL,
  `FrwdEmpID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Percentage` float(11,2) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tempatt`;
CREATE TABLE `tempatt` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `DateAdded` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `temp_emp`;
CREATE TABLE `temp_emp` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `temp_login_history`;
CREATE TABLE `temp_login_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LoginTime` time DEFAULT NULL,
  `MLoginTime` time DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `Late` tinyint(1) NOT NULL DEFAULT 0,
  `EarlyDep` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDay` tinyint(1) NOT NULL DEFAULT 0,
  `ScheduleArrival` text DEFAULT NULL,
  `ScheduleDepart` text DEFAULT NULL,
  `LateArrival` text DEFAULT NULL,
  `EarlyDepart` text DEFAULT NULL,
  `Status` varchar(15) DEFAULT NULL,
  `MStatus` text DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `LastModified` int(11) NOT NULL,
  `Updated` int(11) NOT NULL DEFAULT 0,
  `DateModified` datetime NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `temp_logout_history`;
CREATE TABLE `temp_logout_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LogoutTime` time DEFAULT NULL,
  `MLogoutTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `ID` int(11) NOT NULL,
  `TestName` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `timeadjust_requests`;
CREATE TABLE `timeadjust_requests` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `RosterID` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT 0,
  `ApprovedBy` int(11) NOT NULL,
  `NotificationTo` text NOT NULL,
  `LoginTime` text NOT NULL,
  `LogoutTime` text NOT NULL,
  `Reason` text NOT NULL,
  `DisapproveReason` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE `trainings` (
  `ID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `StartDate` text NOT NULL,
  `EndDate` text NOT NULL,
  `StartTime` text NOT NULL,
  `EndTime` text NOT NULL,
  `Color` text NOT NULL,
  `Test` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Employees` text NOT NULL,
  `DateAdded` datetime NOT NULL,
  `DateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `twitter`;
CREATE TABLE `twitter` (
  `ID` int(11) NOT NULL,
  `Tweet` text NOT NULL,
  `Tweet_url` text NOT NULL,
  `Tweet_count` text DEFAULT NULL,
  `tweet_type` enum('united-states','pakistan') NOT NULL DEFAULT 'united-states'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `twitter` (`ID`, `Tweet`, `Tweet_url`, `Tweet_count`, `tweet_type`) VALUES
(43542, 'Steelers', 'https://twitter.com/search?q=Steelers', '142K', 'united-states'),
(43543, '#HereWeGo', 'https://twitter.com/search?q=%23HereWeGo', '37K', 'united-states'),
(43544, 'TraceMcSorley', 'https://twitter.com/search?q=%22Trace+McSorley%22', '11K', 'united-states'),
(43545, '#BALvsPIT', 'https://twitter.com/search?q=%23BALvsPIT', '12K', 'united-states'),
(43546, '#hellokittyxcolourpop', 'https://twitter.com/search?q=%23hellokittyxcolourpop', '16K', 'united-states'),
(43547, '#VisibleNonbinary', 'https://twitter.com/search?q=%23VisibleNonbinary', '24K', 'united-states');

DROP TABLE IF EXISTS `user_login_history`;
CREATE TABLE `user_login_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LoginTime` time DEFAULT NULL,
  `MLoginTime` time DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `Late` tinyint(1) NOT NULL DEFAULT 0,
  `EarlyDep` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDay` tinyint(1) NOT NULL DEFAULT 0,
  `Status` varchar(15) DEFAULT NULL,
  `MStatus` text DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `IPAdress` text NOT NULL,
  `ConditionBit` tinyint(1) NOT NULL DEFAULT 0,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_login_history1`;
CREATE TABLE `user_login_history1` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LoginTime` time DEFAULT NULL,
  `MLoginTime` time DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `Late` tinyint(1) NOT NULL DEFAULT 0,
  `EarlyDep` tinyint(1) NOT NULL DEFAULT 0,
  `HalfDay` tinyint(1) NOT NULL DEFAULT 0,
  `Status` varchar(15) DEFAULT NULL,
  `MStatus` text DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `IPAdress` text NOT NULL,
  `ConditionBit` tinyint(1) NOT NULL DEFAULT 0,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_logout_history`;
CREATE TABLE `user_logout_history` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LogoutTime` time DEFAULT NULL,
  `MLogoutTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `IPAdress` text NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_logout_history1`;
CREATE TABLE `user_logout_history1` (
  `ID` int(11) NOT NULL,
  `UserID` bigint(20) DEFAULT 0,
  `LogoutTime` time DEFAULT NULL,
  `MLogoutTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `DateAdded` date NOT NULL,
  `IPAdress` text NOT NULL,
  `ActualDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `writeoff_leaves_quota`;
CREATE TABLE `writeoff_leaves_quota` (
  `ID` int(11) NOT NULL,
  `EmpID` int(11) NOT NULL,
  `LeaveType` text NOT NULL,
  `LeaveDate` date NOT NULL,
  `NumOfDays` int(11) NOT NULL,
  `Reason` text NOT NULL,
  `PerformedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `adjustmenttypes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `advances`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `advance_requests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `allowances`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `allowancetypes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `answers`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `anual_bonuses`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `appraisals`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `appraisals_result`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `appraisals_result_details`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `attendance_log`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `authorized_employees`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `banks`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `basicsalary`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `bonus`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `bonusdetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `businessunits`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `candidates`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `candidates_answers`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `commissions`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `companies`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `companiesold`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `countries`
  ADD PRIMARY KEY (`iso`);

ALTER TABLE `current_leaves_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `current_leaves_quota2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `current_leaves_quota_encashment`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `deductions`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `deductiontypes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `designations`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `developers`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `documents`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `employees2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `employeesbackup`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `encashment`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `encashmentdetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `externalusers`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `fullnfinal`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `gazetted_holidays`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `grades`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `grant_leaves_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `grossupdate`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `grossupdate2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `increments`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `individual_bonuses`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `institutes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `interviews`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `jobposts`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `kpi`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `leaveadjust_requests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `leaves_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `leaves_quota2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `leave_approvals`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loans`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loans_manualrecovery`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loans_schedule`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loans_schedule_copy`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loans_schedule_copy2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loantypes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `locations`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `machines`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

ALTER TABLE `messages2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `minus_leaves_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `minus_leaves_quota_payroll`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `news2`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `organization_settings`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `overtime_policies`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `paid_leaves_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payroll`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolladvancedetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrollallowancedetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrollcontributiondetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolldeductiondetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolldetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolldetailsbackup`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolldetailscopy`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrollloandetails`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrollold`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `payrolltaxes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `provident_funds`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `quotes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rate_analysis`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `refresh_leave_quota`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `reimbursements`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `resumes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `rewards`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roster`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roster_login_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `roster_logout_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `schedules`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `security`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `stud_answers`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `subdepartments`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `taxes`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `tempatt`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `temp_emp`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `temp_login_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `temp_logout_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `tests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `timeadjust_requests`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `trainings`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `twitter`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user_login_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user_login_history1`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user_logout_history`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `user_logout_history1`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `writeoff_leaves_quota`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `adjustments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `adjustmenttypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `advances`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `advance_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `allowances`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `allowancetypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `anual_bonuses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `appraisals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `appraisals_result`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `appraisals_result_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `attendance_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `authorized_employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `banks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `basicsalary`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bonus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `bonusdetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `businessunits`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `candidates`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `candidates_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `commissions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `companies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `companiesold`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `current_leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `current_leaves_quota2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `current_leaves_quota_encashment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `deductions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `deductiontypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

ALTER TABLE `designations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

ALTER TABLE `developers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `documents`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `employees`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26137;

ALTER TABLE `employees2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `employeesbackup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `encashment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `encashmentdetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `externalusers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `fullnfinal`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `gazetted_holidays`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `grades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `grant_leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `grossupdate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `grossupdate2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `increments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `individual_bonuses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `institutes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `interviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `jobposts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kpi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `leaveadjust_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `leaves_quota2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `leave_approvals`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loans_manualrecovery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loans_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loans_schedule_copy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loans_schedule_copy2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `loantypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `loan_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `locations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `machines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `message_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `minus_leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `minus_leaves_quota_payroll`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66859;

ALTER TABLE `news2`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `organization_settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `overtimes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `overtime_policies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `paid_leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payroll`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolladvancedetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrollallowancedetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrollcontributiondetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolldeductiondetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolldetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolldetailsbackup`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolldetailscopy`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrollloandetails`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrollold`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payrolltaxes`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `provident_funds`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `quotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1741;

ALTER TABLE `rate_analysis`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `refresh_leave_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `reimbursements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `resumes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `rewards`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roster`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roster_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `roster_logout_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `schedules`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `security`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `stud_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `subdepartments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `taxes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tempatt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `temp_emp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `temp_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `temp_logout_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `timeadjust_requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `trainings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `twitter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43548;

ALTER TABLE `user_login_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_login_history1`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_logout_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_logout_history1`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `writeoff_leaves_quota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
