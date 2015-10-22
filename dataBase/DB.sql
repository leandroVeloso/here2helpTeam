# Creates help desk database

DROP DATABASE IF EXISTS Helpdesk;

CREATE DATABASE Helpdesk;

USE Helpdesk;

# Create table to store users address and location of help request.
CREATE TABLE ADDRESS (
    addressID INT AUTO_INCREMENT,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    postcode INT(4),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (addressID)
);

# Create table to store user types. User may be a [1] Customer, [2] Volunteer or [3] ServiceProvider
CREATE TABLE USERTYPE (
    typeID INT AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (typeID)
);

# Create table to store user details
CREATE TABLE USER (
    userID INT AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    hash VARCHAR(60) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    addressID INT,
    phoneNo INT,
    typeID INT,
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
    serviceID INT AUTO_INCREMENT,
    service VARCHAR(100) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(serviceID)
);

# Create table to store priority level of help request.
CREATE TABLE PRIORITY(
    priorityID INT AUTO_INCREMENT,
    priority VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(priorityID)
);

# Create table to store status of help request.
CREATE TABLE STATUS(
    statusID INT AUTO_INCREMENT,
    status VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(statusID)
);

# Create table to store help request
CREATE TABLE REQUEST(
    requestID INT AUTO_INCREMENT,
    clientID INT NOT NULL,
    volunteerID INT,
    serviceID INT,
    requestName VARCHAR(50) NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE,
    startTime TIME,
    endTime TIME,
    minPrice DECIMAL(8,2),
    maxPrice DECIMAL (8,2),
    comment VARCHAR(500), # General information about the request
    priorityID INT,
    locationID INT,
    statusID INT DEFAULT 1,
    creationDate TIMESTAMP,
    lastModified TIMESTAMP,
    PRIMARY KEY (requestID),
    FOREIGN KEY (locationID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (clientID) REFERENCES USER(userID)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
      FOREIGN KEY (volunteerID) REFERENCES USER(userID)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
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

# Create table to store status of service provider details.
CREATE TABLE SERVICEPROVIDER(
    serviceProviderID INT AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    serviceID INT,
    description VARCHAR(250),
    addressID INT,
    phoneNo INT,
    website VARCHAR(1000),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(serviceProviderID),
    FOREIGN KEY (addressID) REFERENCES ADDRESS(addressID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (serviceID) REFERENCES SERVICE(serviceID)
      ON UPDATE CASCADE
      ON DELETE SET NULL
);

# Create table to store feedback on service providers
CREATE TABLE SERVICEFEEDBACK(
    feedbackID INT AUTO_INCREMENT,
    requestID INT,
    serviceProviderID INT NOT NULL,
    rating INT(1) NOT NULL,
    comment VARCHAR(500),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(feedbackID),
    FOREIGN KEY (requestID) REFERENCES REQUEST(requestID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (serviceProviderID) REFERENCES SERVICEPROVIDER(serviceProviderID)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);

# Create table to store volunteer feedback.
CREATE TABLE VOLUNTEERFEEDBACK(
    feedbackID INT AUTO_INCREMENT,
    requestID INT,
    volunteerID INT NOT NULL,
    rating INT(1) NOT NULL,
    comment VARCHAR(500),
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(feedbackID),
    FOREIGN KEY (requestID) REFERENCES REQUEST(requestID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (volunteerID) REFERENCES USER(userID)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);

# Create table to store quotes.
CREATE TABLE QUOTE(
    quoteID INT AUTO_INCREMENT,
    requestID INT NOT NULL,
    serviceProviderID INT,
    startDateTime DATETIME NOT NULL,
    endDateTime DATETIME,
    startTime TIME,
    endTime TIME,
    approved TINYINT(1),
    description VARCHAR(500),
    minPrice DECIMAL(8,2) NOT NULL,
    maxPrice DECIMAL (8,2),
    volunteerComment VARCHAR(500),
    clientComment VARCHAR(500),
    creationDate TIMESTAMP,
    lastModified TIMESTAMP,
    PRIMARY KEY(quoteID),
    FOREIGN KEY (requestID) REFERENCES REQUEST(requestID)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (serviceProviderID) REFERENCES SERVICEPROVIDER(serviceProviderID)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);

/*
# Create table to store bookings.
CREATE TABLE BOOKING(
    bookingID INT AUTO_INCREMENT,
    quoteID INT,
    requestID INT NOT NULL,
    serviceProviderID INT NOT NULL,
    startDateTime DATETIME,
    endDateTime DATETIME,
    description VARCHAR(500),
    price DECIMAL(8,2),
    comment VARCHAR(500),
    creationDate TIMESTAMP NOT NULL,
    lastModified TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (bookingID),
    FOREIGN KEY (requestID) REFERENCES REQUEST(requestID)
      ON UPDATE CASCADE
      ON DELETE CASCADE,
    FOREIGN KEY (quoteID) REFERENCES QUOTE(quoteID)
      ON UPDATE CASCADE
      ON DELETE SET NULL,
    FOREIGN KEY (serviceProviderID) REFERENCES SERVICEPROVIDER(serviceProviderID)
      ON UPDATE CASCADE
      ON DELETE CASCADE
);
*/
# Insert user types [1] Customer, [2] Volunteer, [3] Service Provider and [4] Someone requesting a volunteer account.
INSERT INTO USERTYPE (typeID, type)
VALUES  (1, 'Customer'),
        (2, 'Volunteer'),
        (4, 'Requesting Volunteer Account'),
        (5, 'Admin');

# Insert status of request [1] Open, [2] Closed, [3] Waiting approval from customer, [4] In progress and [5] Cancelled.
INSERT INTO STATUS (status)
VALUES  ('Open'),
        ('Finished'),
        ('Waiting Aproval'),
        ('In Progress'),
        ('Cancelled'),
        ('Waiting Booking');

# Insert priorities [1] High, [2] Medium and [3] Low.
INSERT INTO PRIORITY (priority) VALUES ('High'), ('Medium'), ('Low');

# Insert addresses.
INSERT INTO ADDRESS (unitNumber, street, suburb, state, postcode)
VALUES  (1, 'Picadilly St', 'Boronia Heights', 'Queensland', 4122),
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
INSERT INTO `Helpdesk`.`USER` (`email`, `hash`, `firstName`, `lastName`, `addressID`, `phoneNo`, `typeID`)
VALUES  ('banana@mail.com', '72b302bf297a228a75730123efef7c41', 'Stevie', 'Kat', '2', '33239876', '1'),
        ('carrot@mail.com', '005d05de29487ec44cd07bd9d757d4e1', 'Melissa', 'Carr', '3', '049999998', '2'),
        ('apple@mail.com', '1f3870be274f6c49b3e31a0c6728957f', 'Nick', 'Were', '10', '33339999', '1'),
        ('pear@mail.com', '8893dc16b1b2534bab7b03727145a2bb', 'Sally', 'Malik', '4', '0456789876', '2'),
        ('larry@mail.com', '66f4b449b3a98abf87f2521e35513542', 'Geoff', 'Var', '5', '0456765809', '2'),
        ('vamp@mail.com', '7d5b84f1f2a17e718a3aba8ea4b73773', 'Nick', 'Were', '6', '34562234', '2'),
        ('ghost@mail.com', '71144850f4fb4cc55fc0ee6935badddf', 'Susannah', 'Graham', '7', '34232313', '4'),
        ('zombie@mail.com', '0eda241fc65ccf35d9743309ac395215', 'Nora', 'Fooran', '7', '30988776', '4'),
        ('witch@mail.com', '4bf5348e602347ad7311a5da50af5bee', 'Peter', 'Puck', '3', '32111123', '4'),
        ('wizard@mail.com', 'd8d3a01ba7e5d44394b6f0a8533f4647', 'John', 'Johnson', '2', '31111234', '4'),
        ('dragon@mail.com', '8621ffdbc5698829397d97767ac13db3', 'Karl', 'Bart', '4', '39098987', '4'),
        ('admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '4', '39098987', '5'),
        ('testVolunteer@email.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'Test', 'Volunteer', '3', '39111111', '2'),
        ('testClient@email.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'Test', 'Client', '5', '3911100', '1'),
        ('testAdmin@email.com', 'ae2b1fca515949e5d54fb22b8ed95575', 'Test', 'Admin', '6', '39111000', '5');

# Insert services
INSERT INTO `Helpdesk`.`SERVICE` (`service`)
VALUES  ('Painting'),
        ('Plumbing'),
        ('Sewing'),
        ('Dry Cleaning'),
        ('Mowing'),
        ('Cleaning'),
        ('Carpet Cleaning'),
        ('Shopping'),
        ('Building'),
        ('Driving');

# Insert requests
INSERT INTO `Helpdesk`.`REQUEST` (`clientID`, `serviceID`, `requestName`, `startDate`, `endDate`, `startTime`, `endTime`, `minPrice`, `maxPrice`, `comment`, `priorityID`, `locationID`, `statusID`, `creationDate`, `lastModified`)
VALUES  ('1', '1', 'Paint Roof', '2015-10-18', '2015-10-20', '12:05', '13:10', '100', '200', 'Need someone to paint my roof blue.', '2', '2', '1', NOW(), NOW()),
        ('2', '1', 'Fix toilet', '2015-10-18', '2015-10-25', '12:05', '17:10', '1500', '2000', 'My toilet is blocked.', '3', '4', '1', NOW(), NOW()),
        ('3', '5', 'Mow Yard', '2015-10-30', '2015-11-25', '05:05', '17:10', '20', '780', 'Yard is overgrown. 1 acre. Need mowing.', '3', '4', '1', NOW(), NOW());

# Insert service providers.
INSERT INTO SERVICEPROVIDER (name, serviceID, description, addressID, phoneNo, website)
VALUES  ('Bell Plumbing Maintenance', 2, 'Provide gas fitting, hot water repair and fix blocked drains. Available 24/7.', 4, '(07) 3354 3300', 'www.bellplumbing.com.au'),
        ('Fallon Solutions', 2, 'Service domestic, commercial and industrial. Available 24/7.', 9, '1300 762 260', 'www.fallonsolutions.com.au'),
        ('PaintPaintersPainting', 1, 'Indoor painting of houses only. Available Monday to friday, 9 to 5.', 8, '1800 999 987', 'www.paintingpaint.com.au'),
        ('Cha clean', 4, 'Dry cleaning only. Open Tuesday to Saturdays 9am to 5pm.', 6, '1300 000 260', 'www.chaclean.com.au'),
        ('Yellow Cabs', 10, 'Taxi service servicing South East Queensland. State preferred taxi type (standard or maxi).', NULL, '1800555432', 'www.yellowcabs.com');


/*
# Insert quotes.
INSERT INTO QUOTE (requestID, serviceProviderID, startDateTime, endDateTime, description, minPrice, maxPrice, volunteerComment, clientComment)
VALUES (1, 1, '2015-10-23 12:00:00', '2015-10-23 14:00:00', '1 Bedroom only', '200', '300', 'Willing to do 2 rooms for cheaper.', NULL),
(1, 1, '2015-10-23 12:00:00', '2015-10-23 14:00:00', '2 Bedroom', '250', '400', 'Cheaper price only available until March 2015.', NULL),
(1, 2, '2015-10-20 09:00:00', '2015-10-25 14:00:00', 'Whole House', '500', NULL, 'Client must provide the paint.', NULL),
(1, 2, '2015-10-28 14:00:00', '2015-10-30 17:30:00', 'Toilet issue', '20', '1000', 'Price will vary. Initial consult is $20 but additional work will cost more.', NULL);


/*
# Insert bookings.
INSERT INTO BOOKING (quoteID, requestID, serviceProviderID, startDateTime, endDateTime, description, price, comment)
VALUES (1, 1, 1, '2015-10-23 12:00:00', '2015-10-23 13:00:00', 'PaintPaintings 1 Bedroom only', '200', 'Booked for the loungeroom. They will bring all materials'),
(4, 2, 2, '2015-10-30 14:00:00', '2015-10-30 17:30:00', 'Consultation', '20', 'Booked to identify issue. Will fix on date if job isn\'t too large and provide you with a new quote');
*/

INSERT INTO VOLUNTEERFEEDBACK (requestID, volunteerID, rating, comment)
VALUES  (1, 3, 4,'Friendly and helpful.'),
        (2, 3, 5, 'Efficient.'),
        (3, 5, 3, NULL);
