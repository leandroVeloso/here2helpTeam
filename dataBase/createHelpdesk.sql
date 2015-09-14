CREATE DATABASE Helpdesk;

USE Helpdesk;

CREATE TABLE USERTYPE (
    typeID INT,
    type VARCHAR(50) NOT NULL,
    PRIMARY KEY (typeID)
);

CREATE TABLE USER (
    userID INT AUTO_INCREMENT,
    hash VARCHAR(60) NOT NULL,
    email VARCHAR(100) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    postcode INT(4),
    phone VARCHAR(15),
    typeID INT,
    PRIMARY KEY (userID),
    FOREIGN KEY (typeID) REFERENCES USERTYPE(typeID)
      ON UPDATE CASCADE
      ON DELETE SET NULL
);

CREATE TABLE VOLUNTEER (
    volunteerID INT,
    location VARCHAR(50),
    PRIMARY KEY (volunteerID),
    FOREIGN KEY (volunteerID) REFERENCES USER (userID)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE AVAILABILITIES (
    availID INT,
    volunteerID INT,
    startTime DATETIME NOT NULL,
    endTime DATETIME NOT NULL,
    available TINYINT(1) UNSIGNED NOT NULL COMMENT 'Option: YES/NO',
    PRIMARY KEY (availID),
    FOREIGN KEY (volunteerID) REFERENCES VOLUNTEER (volunteerID)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

INSERT INTO USERTYPE (typeID, type) VALUES (1, 'Customer'),
    (2, 'Volunteer'),
    (3, 'Service Provider');
