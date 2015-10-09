# Creates help desk database

DROP DATABASE IF EXISTS Helpdesk;

CREATE DATABASE Helpdesk;

USE Helpdesk;

# Delete previous versions of Address table
DROP TABLE IF EXISTS ADDRESS;

# Create table to store users address and location of help request.
CREATE TABLE ADDRESS (
    addressID INT(4) AUTO_INCREMENT,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    zone VARCHAR(10) NOT NULL UNIQUE,
    postcode INT(4),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (addressID)
);

# Delete previous versions of Usertype table
DROP TABLE IF EXISTS USERTYPE;

# Create table to store user types. User may be a [1] Customer, [2] Volunteer or [3] ServiceProvider
CREATE TABLE USERTYPE (
    typeID INT AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (typeID)
);

# Delete previous versions of User table
DROP TABLE IF EXISTS USER;

# Create table to store user details
CREATE TABLE USER (
    userID INT(4) AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    hash VARCHAR(60) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    addressID INT(4),
    phoneNo INT,
    typeID INT(1),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (userID),
    FOREIGN KEY (addressID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (typeID) REFERENCES USERTYPE(typeID)
      ON UPDATE CASCADE
      ON DELETE SET NULL
);

# Create table to store service types.
CREATE TABLE SERVICE(
    serviceID INT(4) AUTO_INCREMENT,
    service VARCHAR(100) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(serviceID)
);

# Create table to store priority level of help request.
CREATE TABLE PRIORITY(
    priorityID INT(2) AUTO_INCREMENT,
    priority VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(priorityID)
);



# Create table to store status of help request.
CREATE TABLE STATUS(
    statusID INT(1) AUTO_INCREMENT,
    status VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(statusID)
);

# Create table to store help request
CREATE TABLE REQUEST(
    requestID INT(4) AUTO_INCREMENT,
    clientID INT(4) NOT NULL,
    serviceID INT(4),
    requestName VARCHAR(50) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    startTime TIME,
    endTime TIME,
    minPrice DECIMAL(8,2),
    maxPrice DECIMAL (8,2),
    comment TEXT, # General information about the request
    priorityID INT(2),
    locationID INT(4),
    statusID INT(1) DEFAULT 1,
    creationDate TIMESTAMP NOT NULL,
    lastModified TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (requestID),
    FOREIGN KEY (locationID) REFERENCES ADDRESS(addressID)
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
      ON DELETE SET NULL,
    FOREIGN KEY (statusID) REFERENCES STATUS(statusID)
      ON UPDATE CASCADE
      ON DELETE SET NULL
);

# Insert user types [1] Customer, [2] Volunteer and [3] Service Provider.
INSERT INTO USERTYPE (type) VALUES ('Customer'),
    ('Volunteer'),
    ('Service Provider'),
    ('Applicant'),
    ('Admin');


# Insert status of request [1] Open, [2] Closed, [3] Waiting approval from customer, [4] In progress and [5] Cancelled.
INSERT INTO STATUS (status) VALUES ('Open'), ('Closed'), ('Waiting Aproval'), ('In Progress'), ('Cancelled');

# Insert priorities [1] High, [2] Medium and [3] Low.
INSERT INTO PRIORITY (priority) VALUES ('High'), ('Medium'), ('Low');

# Insert zones for resquests [1] North, [2] South, [3] East, [4] West
INSERT INTO ADDRESS (zone) VALUES ('North'), ('South'), ('East'), ('West'), ('Inner');