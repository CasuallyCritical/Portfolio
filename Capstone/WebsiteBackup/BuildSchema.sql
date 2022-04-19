CREATE TABLE `FlashCard` (
  `Card_ID` int(11) NOT NULL,
  `Front` varchar(250) NOT NULL,
  `Back` varchar(250) NOT NULL,
  PRIMARY KEY (`Card_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Note` (
  `Note_ID` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  PRIMARY KEY (`Note_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `User` (
  `User_Number` int(11) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`User_Number`),
  UNIQUE KEY `name_UNIQUE` (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Notes` (
  `Notes_ID` int(11) NOT NULL,
  `Note_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Notes_ID`),
  KEY `Note_ID` (`Note_ID`),
  CONSTRAINT `Notes_ibfk_1` FOREIGN KEY (`Note_ID`) REFERENCES `Note` (`Note_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `CardStack` (
  `Card_ID` int(11) DEFAULT NULL,
  `Stack_ID` int(11) NOT NULL,
  PRIMARY KEY (`Stack_ID`),
  KEY `Card_ID` (`Card_ID`),
  CONSTRAINT `CardStack_ibfk_1` FOREIGN KEY (`Card_ID`) REFERENCES `FlashCard` (`Card_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Content` (
  `Content_ID` int(11) NOT NULL,
  `User_Post` int(11) NOT NULL,
  `User_Number` int(11) NOT NULL,
  `Last_Update` date NOT NULL,
  `Notes_ID` int(11) NOT NULL,
  `Stack_ID` int(11) NOT NULL,
  PRIMARY KEY (`Content_ID`),
  KEY `User_Number` (`User_Number`),
  KEY `Notes_ID` (`Notes_ID`),
  KEY `Stack_ID` (`Stack_ID`),
  CONSTRAINT `Content_ibfk_1` FOREIGN KEY (`User_Number`) REFERENCES `User` (`User_Number`),
  CONSTRAINT `Content_ibfk_2` FOREIGN KEY (`Notes_ID`) REFERENCES `Notes` (`Notes_ID`),
  CONSTRAINT `Content_ibfk_3` FOREIGN KEY (`Stack_ID`) REFERENCES `CardStack` (`Stack_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `metadata` (
  `Content_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `subject` tinytext NOT NULL,
  `school` tinytext NOT NULL,
  `ID` int(11) NOT NULL,
  `Likes` int(11) NOT NULL,
  `Dislikes` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Content_ID` (`Content_ID`),
  CONSTRAINT `metadata_ibfk_1` FOREIGN KEY (`Content_ID`) REFERENCES `Content` (`Content_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
