USE Helpdesk;

# create table to store service types.
CREATE TABLE SERVICE(
    serviceID INT(4),
    service VARCHAR(100) NOT NULL UNIQUE,
    PRIMARY KEY(serviceID)
);

# Create table to store priority level of help request.
CREATE TABLE PRIORITY(
    priorityID INT(2) AUTO_INCREMENT,
    priority VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(priorityID)
);

# Create table to store status of help request.
CREATE TABLE STATUS(
    statusID INT(1),
    status VARCHAR(50) NOT NULL UNIQUE,
    PRIMARY KEY(statusID)
);

# Create table to store help request
CREATE TABLE REQUEST(
    requestID INT(4) AUTO_INCREMENT,
    clientID INT(4) NOT NULL,
    serviceID INT(4),
    requestName VARCHAR(50), # Name of request
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
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    lastModified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,
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

INSERT INTO PRIORITY VALUES (1, 'High'), (2, 'Medium'), (3, 'Low');
INSERT INTO STATUS VALUES (1, 'Open'), (2, 'Closed'), (3, 'Waiting Aproval'), (4, 'In Progress'), (5, 'Cancelled');
