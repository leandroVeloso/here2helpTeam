USE Helpdesk;

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

# Insert priorities [1] High, [2] Medium and [3] Low.
INSERT INTO PRIORITY VALUES ('High'), ('Medium'), ('Low');

# Create table to store status of help request.
CREATE TABLE STATUS(
    statusID INT(1) AUTO_INCREMENT,
    status VARCHAR(50) NOT NULL UNIQUE,
    lastModified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(statusID)
);

# Insert status of request [1] Open, [2] Closed, [3] Waiting approval from customer, [4] In progress and [5] Cancelled.
INSERT INTO STATUS VALUES ('Open'), ('Closed'), ('Waiting Aproval'), ('In Progress'), ('Cancelled');

# Create table to store help request
CREATE TABLE REQUEST(
    requestID INT(4) AUTO_INCREMENT,
    clientID INT(4) NOT NULL,
    serviceID INT(4) NOT NULL,
    requestName VARCHAR(50) NOT NULL, # Name of request
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
