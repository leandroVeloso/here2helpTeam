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
    priority VARCHAR(50) NOT NULL,
    PRIMARY KEY(priorityID)
);

# Create table to store help request
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
