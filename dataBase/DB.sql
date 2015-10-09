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

# Insert user types [1] Customer, [2] Volunteer, [3] Service Provider and [4] Someone requesting a volunteer account.
INSERT INTO USERTYPE (type) VALUES ('Customer'),
    ('Volunteer'),
    ('Service Provider'),
    ('Requesting Volunteer Account');

# Insert status of request [1] Open, [2] Closed, [3] Waiting approval from customer, [4] In progress and [5] Cancelled.
INSERT INTO STATUS (status) VALUES ('Open'), ('Closed'), ('Waiting Aproval'), ('In Progress'), ('Cancelled');

# Insert priorities [1] High, [2] Medium and [3] Low.
INSERT INTO PRIORITY (priority) VALUES ('High'), ('Medium'), ('Low');

# Insert addresses.
INSERT INTO ADDRESS (unitNumber, street, suburb, state, postcode)
VALUES (1, 'Picadilly St', 'Boronia Heights', 'Queensland', 4122),
(10, 'Starins St', 'Boronia Heights', 'Queensland', 4122),
(2, 'Body Ct', 'Redcliffe', 'Queensland', 4102),
(3, 'Nick St', 'Sunnybank', 'Queensland', 4121),
(4, 'Whiting St', 'Buranda', 'Queensland', 4029),
(5, 'Alington St', 'Boronia Heights', 'Queensland', 4122),
(6, 'Werei Rd', 'Woodridge', 'Queensland', 4120),
(7, 'Maling St', 'Ferris', 'Queensland', 4304),
(8, 'Plansa St', 'Everton Park', 'Queensland', 4208),
(9, 'Mayfair Rd', 'New Market', 'Queensland', 4002);

# Insert users.
INSERT INTO `helpdesk`.`USER` (`email`, `hash`, `firstName`, `lastName`, `addressID`, `phoneNo`, `typeID`)
VALUES ('banana@mail.com', 'kkkkkkkk', 'Stevie', 'Kat', '2', '33239876', '1'),
('carrot@mail.com', 'llllooo', 'Melissa', 'Carr', '3', '049999998', '2'),
('apple@mail.com', 'jjjjjjjjj', 'Nick', 'Were', '10', '33339999', '1'),
('pear@mail.com', 'maoaoa', 'Sally', 'Malik', '4', '0456789876', '2'),
('larry@mail.com', 'oiuhoiu', 'Geoff', 'Var', '5', '0456765809', '2'),
('vamp@mail.com', 'lkjhoiu', 'Nick', 'Were', '6', '34562234', '2'),
('ghost@mail.com', 'niogbgy', 'Susannah', 'Graham', '7', '34232313', '4'),
('zombie@mail.com', 'mnbvuyt', 'Nora', 'Fooran', '7', '30988776', '4'),
('witch@mail.com', 'xdrdcjh', 'Peter', 'Puck', '3', '32111123', '4'),
('wizard@mail.com', 'buygvxs', 'John', 'Johnson', '2', '31111234', '4'),
('dragon@mail.com', 'zaswrfhy', 'Karl', 'Bart', '4', '39098987', '4');
