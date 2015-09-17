USE Helpdesk;

# Create table to store users address and location of help request.
DROP TABLE IF EXISTS ADDRESS;

CREATE TABLE ADDRESS (
    addressID INT(4) AUTO_INCREMENT,
    unitNumber INT(10),
    street VARCHAR(50),
    suburb VARCHAR(50),
    state VARCHAR(20),
    postcode INT(4),
    PRIMARY KEY (addressID)
);

# Create table to store user types. User may be a [1] Customer, [2] Volunteer or [3] ServiceProvider
DROP TABLE IF EXISTS USERTYPE;

CREATE TABLE USERTYPE (
    typeID INT,
    type VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY (typeID)
);

# Insert user types.
INSERT INTO USERTYPE (typeID, type) VALUES (1, 'Customer'),
    (2, 'Volunteer'),
    (3, 'Service Provider');

# Create table to store user details
DROP TABLE IF EXISTS USER;

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
