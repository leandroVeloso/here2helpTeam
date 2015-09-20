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

# Insert user types [1] Customer, [2] Volunteer and [3] Service Provider.
INSERT INTO USERTYPE (type) VALUES ('Customer'),
    ('Volunteer'),
    ('Service Provider');

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
