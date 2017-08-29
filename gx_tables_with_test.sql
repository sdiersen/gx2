DROP TABLE IF EXISTS scheduled_classes;
DROP TABLE IF EXISTS class_with_types;
DROP TABLE IF EXISTS class_with_levels;
DROP TABLE IF EXISTS class_types;
DROP TABLE IF EXISTS class_levels;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS employee_emails;
DROP TABLE IF EXISTS employee_addresses;
DROP TABLE IF EXISTS employee_phone_numbers;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS credentials;
DROP TABLE IF EXISTS credential_body_phone_numbers;
DROP TABLE IF EXISTS credential_body_locations;
DROP TABLE IF EXISTS credential_body_emails;
DROP TABLE IF EXISTS credential_bodies;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS addresses;


CREATE TABLE class_levels (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 description text DEFAULT NULL,
 PRIMARY KEY (id)
);

INSERT INTO class_levels VALUES 
 (1, 'beginner', 'New to fitness classes'),
 (2, 'intermediate', 'Has done fitness classes for a few months'),
 (3, 'advanced', 'Has been doing fitness classes for years'),
 (4, 'all', 'This class is suited to all levels of ability');

CREATE TABLE class_types (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 description text DEFAULT NULL,
 PRIMARY KEY (id)
);

INSERT INTO class_types VALUES
 (1, 'strength', 'TODO'),
 (2, 'mind-body', 'TODO'),
 (3, 'cardio', 'TODO'),
 (4, 'dance', 'TODO'),
 (5, 'spin', 'TODO'),
 (6, 'aoa', 'TODO'),
 (7, 'aquatic', 'TODO');

CREATE TABLE classes (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 short_desc text DEFAULT NULL,
 long_desc text DEFAULT NULL,
 duration int(11) DEFAULT NULL,
 PRIMARY KEY (id)
);

INSERT INTO classes VALUES
 (1, 'Body Pump', 'Signature Les Mills strength training program using bars, plates, and the bench', 'TODO', 0),
 (2, 'Core Pilates', 'Working on the entire core to improve posture, increase flexibility, and strengthen muscles', 'TODO', 0),
 (3, 'Step', 'Choreographed class using platform step and risers', 'TODO', 0),
 (4, 'Core X', '30 minute class focusing solely on strengthening your core with a bit more', 'TODO', 0),
 (5, 'TBC', 'Total body Conditioning. Free Style class focusing on cario and strength for your entire body.', 'TODO', 0);

CREATE TABLE class_with_levels (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 level_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (class_id),
 INDEX (level_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id)
  ON DELETE CASCADE,
 FOREIGN KEY (level_id)
  REFERENCES class_levels(id)
  ON DELETE CASCADE
);

INSERT INTO class_with_levels VALUES
 (1, 1, 4),
 (2, 2, 4),
 (3, 3, 1),
 (4, 3, 2),
 (5, 4, 4),
 (6, 5, 2),
 (7, 5, 3);

CREATE TABLE class_with_types (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 type_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (class_id),
 INDEX (type_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id)
  ON DELETE CASCADE,
 FOREIGN KEY (type_id)
  REFERENCES class_types(id)
  ON DELETE CASCADE
);

INSERT INTO class_with_types VALUES
 (1, 1, 1),
 (2, 2, 2),
 (3, 3, 3),
 (4, 4, 1),
 (5, 5, 1);

CREATE TABLE addresses (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 street_number int(11) DEFAULT NULL,
 street VARCHAR(255) DEFAULT NULL,
 room VARCHAR(255) DEFAULT NULL,
 city VARCHAR(255) DEFAULT NULL,
 state VARCHAR(2) DEFAULT NULL,
 zip_code VARCHAR(5) DEFAULT NULL,
 route_code VARCHAR(4) DEFAULT NULL,
 po_box tinyint(1) DEFAULT 0,
 PRIMARY KEY (id)
);

INSERT INTO addresses VALUES
 (1, 'home', 109, 'mills woods trail', NULL, 'buffalo', 'mn', '55313', NULL, 0),
 (2, 'main office', 12800, 'industrial park blvd', 'ste 220', 'minneapolis', 'mn', '55441', '3929', 0);

CREATE TABLE employees (
 id int(11) NOT NULL AUTO_INCREMENT,
 first_name VARCHAR(255) DEFAULT NULL,
 middle_name VARCHAR(255) DEFAULT NULL,
 last_name VARCHAR(255) DEFAULT NULL,
 birth_date DATE DEFAULT NULL,
 date_hired DATE DEFAULT NULL,
 PRIMARY KEY (id)
);

INSERT INTO employees VALUES
 (1, 'Jennifer', 'Marie', 'Diersen', '1974-11-06', '1995-01-01');

CREATE TABLE employee_phone_numbers (
 id int(11) NOT NULL AUTO_INCREMENT,
 phone_number VARCHAR(12) NOT NULL,
 employee_id int(11) NOT NULL,
 type VARCHAR(25) NOT NULL,
 primary_phone tinyint(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (id),
 INDEX (employee_id),
 FOREIGN KEY (employee_id)
  REFERENCES employees(id)
);

INSERT INTO employee_phone_numbers VALUES
 (1, '763-412-4234', 1, 'mobile', 1);

CREATE TABLE employee_emails (
 id int(11) NOT NULL AUTO_INCREMENT,
 email VARCHAR(255) NOT NULL,
 employee_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (employee_id),
 FOREIGN KEY (employee_id)
  REFERENCES employees(id)
);

INSERT INTO employee_emails VALUES
 (1, 'guertinjen@hotmail.com', 1);

CREATE TABLE employee_addresses (
 id int(11) NOT NULL AUTO_INCREMENT,
 employee_id int(11) NOT NULL,
 address_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (employee_id),
 FOREIGN KEY (employee_id)
  REFERENCES employees(id),
 FOREIGN KEY (address_id)
  REFERENCES addresses(id)
);

INSERT INTO employee_addresses VALUES
 (1, 1, 1);

CREATE TABLE credential_bodies (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 abbreviation VARCHAR(255) DEFAULT NULL,
 website VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY (id)
);

INSERT INTO credential_bodies VALUES 
 (1, 'national exercise trainers association', 'neta', 'www.netafit.org');

CREATE TABLE credential_body_emails (
 id int(11) NOT NULL AUTO_INCREMENT,
 email VARCHAR(255) NOT NULL,
 body_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (body_id),
 FOREIGN KEY (body_id)
  REFERENCES credential_bodies(id)
);

INSERT INTO credential_body_emails VALUES
 (1, 'neta@netafit.org', 1);

CREATE TABLE credential_body_locations (
 id int(11) NOT NULL AUTO_INCREMENT,
 address_id int(11) NOT NULL,
 body_id int(11) NOT NULL,
 name VARCHAR(255) NOT NULL,
 PRIMARY KEY (id),
 INDEX (body_id),
 FOREIGN KEY (body_id)
  REFERENCES credential_bodies(id),
 FOREIGN KEY (address_id)
  REFERENCES addresses(id)
);

INSERT INTO credential_body_locations VALUES
 (1, 2, 1, 'home office');

CREATE TABLE credential_body_phone_numbers (
 id int(11) NOT NULL AUTO_INCREMENT,
 phone_number VARCHAR(12) NOT NULL,
 body_id int(11) NOT NULL,
 type VARCHAR(25) NOT NULL,
 location_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (body_id),
 FOREIGN KEY (body_id)
  REFERENCES credential_bodies(id),
 FOREIGN KEY (location_id)
  REFERENCES credential_body_locations(id)
);

INSERT INTO credential_body_phone_numbers VALUES
 (1, '800-237-6242', 1, 'customer service', 1),
 (2, '763-545-2524', 1, 'credential help', 1);

CREATE TABLE credentials (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 body_id int(11) NOT NULL,
 employee_id int(11) NOT NULL,
 expires DATE NOT NULL,
 PRIMARY KEY (id),
 INDEX (employee_id),
 INDEX (body_id),
 FOREIGN KEY (employee_id)
  REFERENCES employees(id),
 FOREIGN KEY (body_id)
  REFERENCES credential_bodies(id)
);

INSERT INTO credentials VALUES
 (1, 'yoga', 1, 1, '2018-08-31');

 CREATE TABLE rooms (
 id int(11) NOT NULL AUTO_INCREMENT,
 address_id int(11) NOT NULL,
 name VARCHAR(255),
 PRIMARY KEY (id),
 FOREIGN KEY (address_id)
  REFERENCES addresses(id)
  ON DELETE CASCADE
);

CREATE TABLE scheduled_classes (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 employee_id int(11) NOT NULL,
 address_id int(11) NOT NULL,
 room_id int(11) NOT NULL,
 start_date DATE DEFAULT NULL,
 end_date DATE DEFAULT NULL,
 start_time TIME DEFAULT NULL,
 PRIMARY KEY (id),
 INDEX (class_id),
 INDEX (employee_id),
 INDEX (address_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id)
  ON DELETE CASCADE,
 FOREIGN KEY (employee_id)
  REFERENCES employees(id),
 FOREIGN KEY (address_id)
  REFERENCES addresses(id)
  ON DELETE CASCADE
);