-- Author : Stefano Corra 

--Delete myDB database if exist
DROP DATABASE myDB;

-- Create myDB database
CREATE DATABASE myDB;

-- Select myDB database
USE myDB;

-- Create Reservation table
CREATE TABLE Reservation (
	transactID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(30)  NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	transactDate DATE NOT NULL,
	seatID VARCHAR(3) NOT NULL
    )
