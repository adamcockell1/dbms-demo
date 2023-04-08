DROP DATABASE IF EXISTS restaurantdb;
CREATE DATABASE restaurantdb;
USE restaurantdb;


-- Strong Entities

CREATE TABLE food (
    name VARCHAR(100) PRIMARY KEY
);

CREATE TABLE restaurant (
    name       VARCHAR(100) PRIMARY KEY,
    url        VARCHAR(200),
    city       VARCHAR(100),
    postalCode CHAR(6),
    address    VARCHAR(100)
);

CREATE TABLE customer (
    email      VARCHAR(320) PRIMARY KEY,
    firstName  VARCHAR(100),
    lastName   VARCHAR(100),
    phone      INTEGER,
    city       VARCHAR(100),
    postalCode CHAR(6),
    address    VARCHAR(100),
    credit     DECIMAL(6, 2)
);

CREATE TABLE orderId (
    id    INTEGER PRIMARY KEY,
    total DECIMAL(6, 2),
    tip   DECIMAL(6, 2)
);

CREATE TABLE orderinfo (
	orderId        INTEGER NOT NULL,
	customerEmail  VARCHAR(320) NOT NULL,
	restaurantName VARCHAR(100) NOT NULL,
	date           DATE NOT NULL,
	PRIMARY KEY (orderId, customerEmail, restaurantName),
	FOREIGN KEY (orderId) REFERENCES orderId(id) ON DELETE CASCADE,
	FOREIGN KEY (customerEmail) REFERENCES customer(email) ON DELETE CASCADE,
	FOREIGN KEY (restaurantName) REFERENCES restaurant(name) ON DELETE CASCADE
);


-- Superclass

CREATE TABLE employee (
	id             INTEGER PRIMARY KEY,
	email          VARCHAR(320),
	firstName      VARCHAR(100),
	lastName       VARCHAR(100),
	restaurantName VARCHAR(100),
	FOREIGN KEY (restaurantName) REFERENCES restaurant(name)
);


-- Subclasses

CREATE TABLE manageremployee (
	employeeId INTEGER PRIMARY KEY,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);

CREATE TABLE chefemployee (
	employeeId INTEGER PRIMARY KEY,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);

CREATE TABLE serveremployee (
	employeeId INTEGER PRIMARY KEY,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);

CREATE TABLE deliveryemployee (
	employeeId INTEGER PRIMARY KEY,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);


-- Weak Entities

CREATE TABLE payment (
	customerEmail VARCHAR(320) NOT NULL,
	paymentId     INTEGER NOT NULL,
	amount        DECIMAL(6, 2) NOT NULL,
	date          DATE NOT NULL,
	PRIMARY KEY (customerEmail, paymentId),
	FOREIGN KEY (customerEmail) REFERENCES customer(email) ON DELETE CASCADE
);

CREATE TABLE shift (
	employeeId INTEGER NOT NULL,
	day        VARCHAR(15) NOT NULL,
	startTime  TIME NOT NULL,
	endTime    TIME NOT NULL,
	PRIMARY KEY (employeeId, day),
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);


-- M:N Relationships

CREATE TABLE worksat (
	employeeId     INTEGER NOT NULL,
	restaurantName VARCHAR(100) NOT NULL,
	PRIMARY KEY (employeeId, restaurantName),
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE,
	FOREIGN KEY (restaurantName) REFERENCES restaurant(name) ON DELETE CASCADE
);

CREATE TABLE contains (
	orderId  INTEGER NOT NULL,
	foodName VARCHAR(100) NOT NULL,
	PRIMARY KEY (orderId, foodName),
	FOREIGN KEY (orderId) REFERENCES orderId(id) ON DELETE CASCADE,
	FOREIGN KEY (foodName) REFERENCES food(name) ON DELETE CASCADE
);

CREATE TABLE relatedto (
	customerEmail VARCHAR(320) NOT NULL,
	employeeId    INTEGER NOT NULL,
	relationship  VARCHAR(100),
	PRIMARY KEY (customerEmail, employeeId),
	FOREIGN KEY (customerEmail) REFERENCES customer(email) ON DELETE CASCADE,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);

CREATE TABLE offersonmenu (
	restaurantName VARCHAR(100) NOT NULL,
	menuItemName   VARCHAR(100) NOT NULL,
	price          DECIMAL(6, 2),
	PRIMARY KEY (restaurantName, menuItemName),
	FOREIGN KEY (restaurantName) REFERENCES restaurant(name) ON DELETE CASCADE,
	FOREIGN KEY (menuItemName) REFERENCES food(name) ON DELETE CASCADE
);

CREATE TABLE delivers (
	orderId      INTEGER NOT NULL,
	employeeId   INTEGER NOT NULL,
	deliveryTime TIME,
	PRIMARY KEY (orderId, employeeId),
	FOREIGN KEY (orderId) REFERENCES orderId(id) ON DELETE CASCADE,
	FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
);


-- Multi-valued Attributes

CREATE TABLE credentials
  (
     employeeId  INTEGER NOT NULL,
     credentials VARCHAR(100),
     PRIMARY KEY (employeeId, credentials),
     FOREIGN KEY (employeeId) REFERENCES employee(id) ON DELETE CASCADE
  );


/* Test Data (Add an asterisk here to enable ->) */

INSERT INTO food
			(name)
VALUES      ('Pizza'), ('Burger'), ('Salad'), ('Poke'), ('Taco'), ('Cement');

INSERT INTO restaurant
			(name, url,
			 city, postalCode, address)
VALUES      ('The Pizzaplex', 'http://www.pizzaplex.com',
			 'Kingston', '10001', '123 Main St'),
            ('Burger Joint', 'http://www.burgerjoint.com',
			 'Edmonton', '90001', '456 Elm St'),
            ('Salad Spot', 'http://www.saladspot.com',
			 'Vancouver', '94101', '789 Maple St'),
            ('Poke Paradise', 'http://www.pokeparadise.com',
			 'Ottawa', '60601', '321 Oak St'),
            ('Taco Bell', 'http://www.tacobell.com',
			 'Toronto','77001', '555 Pine St'),
            ('The Mixer', 'http://www.mixer.com',
			 'Montreal', '33101', '777 Cedar St');

INSERT INTO customer
			(email, firstName, lastName, phone,
			 city, postalCode, address, credit)
VALUES      ('johndoe@example.com', 'John', 'Doe', '5551234',
			'New York', '10001', '456 Maple St', 70.00),
            ('janedoe@example.com', 'Jane', 'Doe', '5555678',
             'Los Angeles', '90001', '789 Elm St', 50.00),
            ('bobsmith@example.com', 'Bob', 'Smith', '5552468',
             'San Francisco', '94101', '321 Pine St', 90.00),
            ('maryjones@example.com', 'Mary', 'Jones', '5553690',
             'Chicago', '60601', '654 Oak St', 70.00),
            ('davidlee@example.com', 'David', 'Lee', '5551357',
             'Houston', '77001', '987 Cedar St', 40.00),
            ('sarahkim@example.com', 'Sarah', 'Kim', '5555792',
             'Miami', '33101', '741 Maple St', 40.00);

INSERT INTO orderId
            (id, total, tip)
VALUES      (1, 20.00, 4.10),
            (2, 15.30, 3.00),
            (3, 30.80, 6.20),
            (4, 25.50, 5.40),
            (5, 40.00, 8.70),
            (6, 35.20, 7.00);

INSERT INTO orderinfo
            (orderId, customerEmail, restaurantName, date)
VALUES      (1, 'johndoe@example.com', 'Burger Joint', '2022-01-01'),
            (2, 'janedoe@example.com', 'Poke Paradise', '2022-01-02'),
            (3, 'bobsmith@example.com', 'The Pizzaplex', '2022-01-03'),
            (4, 'maryjones@example.com', 'Salad Spot', '2022-01-04'),
            (5, 'davidlee@example.com', 'The Mixer', '2022-01-05'),
            (6, 'sarahkim@example.com', 'Taco Bell', '2022-01-06');

INSERT INTO employee
            (id, email, firstName, lastName, restaurantName)
VALUES      (11, 'marynguyen@example.com', 'Mary', 'Nguyen', 'The Mixer'),
            (22, 'jasonwilson@example.com', 'Jason', 'Wilson', 'Burger Joint'),
            (33, 'sarajones@example.com', 'Sara', 'Jones', 'Taco Bell'),
            (44, 'karenng@example.com', 'Karen', 'Ng', 'Salad Spot'),
            (55, 'lisawhite@example.com', 'Lisa', 'White', 'The Pizzaplex'),
            (66, 'peterbrown@example.com', 'Peter', 'Brown', 'Poke Paradise');

INSERT INTO payment
            (customerEmail, paymentId, amount, date)
VALUES      ('johndoe@example.com', 111, 20.00, '2022-03-15'),
            ('janedoe@example.com', 222, 35.50, '2022-03-16'),
            ('bobsmith@example.com', 333, 45.00, '2022-03-17'),
            ('maryjones@example.com', 444, 15.75, '2022-03-18'),
            ('davidlee@example.com', 555, 27.80, '2022-03-19'),
            ('sarahkim@example.com', 666, 30.60, '2022-03-20');

INSERT INTO shift
            (employeeId, day, startTime, endTime)
VALUES      (11, 'Monday', '08:00:00', '16:00:00'),
            (22, 'Tuesday', '12:00:00', '20:00:00'),
            (33, 'Monday', '16:00:00', '23:00:00'),
            (44, 'Wednesday', '18:00:00', '22:00:00'),
            (55, 'Thursday', '08:00:00', '12:00:00'),
            (66, 'Wednesday', '10:00:00', '18:00:00');

INSERT INTO worksat
            (employeeId, restaurantName)
VALUES      (11, 'The Mixer'),
            (22, 'Burger Joint'),
            (33, 'Taco Bell'),
            (44, 'Salad Spot'),
            (55, 'The Pizzaplex'),
            (66, 'Poke Paradise');

INSERT INTO contains
            (orderId, foodName)
VALUES      (1, 'Burger'),
            (2, 'Poke'),
            (3, 'Pizza'),
            (4, 'Salad'),
            (5, 'Cement'),
            (6, 'Taco');

INSERT INTO relatedto
            (customerEmail, employeeId, relationship)
VALUES      ('johndoe@example.com', 22, 'server'),
            ('janedoe@example.com', 66, 'chef'),
            ('bobsmith@example.com', 55, 'manager'),
            ('maryjones@example.com', 44, 'delivery'),
            ('davidlee@example.com', 11, 'server'),
            ('sarahkim@example.com', 33, 'delivery');

INSERT INTO offersonmenu
            (restaurantName, menuItemName, price)
VALUES      ('The Pizzaplex', 'Pizza', 30.80),
            ('Burger Joint', 'Burger', 20.00),
            ('Salad Spot', 'Salad', 25.50),
            ('Poke Paradise', 'Poke', 15.30),
            ('Taco Bell', 'Taco', 35.20),
            ('The Mixer', 'Cement', 40.00);

INSERT INTO delivers
            (orderId, employeeId, deliveryTime)
VALUES      (4, 44, '18:30:00'),
            (6, 33, '19:15:00');

INSERT INTO credentials
            (employeeId, credentials)
VALUES      (66, 'Previously head chef at 3 separate Michelin star restaurants');

/* End of Test Data */
