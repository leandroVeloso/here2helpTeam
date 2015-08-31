CREATE DATABASE Helpdesk;

USE Helpdesk;

CREATE TABLE ADDRESS (
    addressID INT AUTO_INCREMENT,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    postcode INT(4),
    PRIMARY KEY (addressID)
);

CREATE TABLE PHONE (
    phoneID INT AUTO_INCREMENT,
    home INT(15),
    mobile INT(15),
    work INT(15),
    PRIMARY KEY (phoneID)
);

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
    addressID INT,
    phoneID INT,
    typeID INT,
    PRIMARY KEY (userID),
    FOREIGN KEY (addressID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (phoneID) REFERENCES PHONE(phoneID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
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
