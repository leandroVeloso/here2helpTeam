# List of All Volunteers used in processViewVolunteers.php
SELECT U.userID, U.email, U.firstName, U.lastName, A.suburb, U.phoneNo, U.lastModified
FROM USER U
INNER JOIN
ADDRESS A
ON U.addressID = A.addressID
WHERE U.typeID = 2;
