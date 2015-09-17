CREATE DATABASE Helpdesk;

USE Helpdesk;

CREATE TABLE ADDRESS (
    addressID INT(4) AUTO_INCREMENT,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    postcode INT(4),
    PRIMARY KEY (addressID)
);

CREATE TABLE USERTYPE (
    typeID INT,
    type VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (typeID)
);

CREATE TABLE USER (
    userID INT(4) AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    hash VARCHAR(60) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    addressID INT(4),
    phoneNo INT,
    typeID INT(1),
    lastModified DATETIME,
    PRIMARY KEY (userID),
    FOREIGN KEY (addressID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (typeID) REFERENCES USERTYPE(typeID)
      ON UPDATE CASCADE
      ON DELETE SET NULL
);

CREATE TABLE SERVICE(
    serviceID INT(4),
    service VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY(serviceID)
);

CREATE TABLE PRIORITY(
    priorityID INT(2) AUTO_INCREMENT,
    priority VARCHAR(50) NOT NULL,
    PRIMARY KEY(priorityID)
);

CREATE TABLE REQUEST(
    requestID INT(4) AUTO_INCREMENT,
    clientID INT(4) NOT NULL,
    serviceID INT(4),
    startDate DATE NOT NULL,
    endDate DATE,
    startTime TIME,
    endTime TIME,
    minPrice DECIMAL(8,2),
    maxPrice DECIMAL (8,2),
    comment TEXT,
    priorityID INT(2),
    locationID INT(4),
    lastModified DATETIME NOT NULL,
    PRIMARY KEY (requestID),
    FOREIGN KEY (addressID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (clientID) REFERENCES USER(userID)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (serviceID) REFERENCES SERVICE(serviceID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (priorityID) REFERENCES PRIORITY(priorityID)
      ON UPDATE CASCADE
      ON DELETE SET NULL    
);    
    

#--------------------------------------------------------------------------------------------------
INSERT INTO USERTYPE (typeID, type) VALUES (1, 'Customer'),
    (2, 'Volunteer'),
    (3, 'Service Provider');