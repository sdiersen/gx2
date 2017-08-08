DROP TABLE IF EXISTS scheduled_classes;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS instructors;
DROP TABLE IF EXISTS locations;

CREATE TABLE classes (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 description text DEFAULT NULL,
 class_level ENUM('beginner', 'intermediate', 'advanced', 'all') DEFAULT 'all',
 class_type ENUM('strength', 'cardio', 'mind-body', 'dance') DEFAULT 'strength',
 PRIMARY KEY (id)
);

CREATE TABLE instructors (
 id int(11) NOT NULL AUTO_INCREMENT,
 first_name VARCHAR(255) DEFAULT NULL,
 last_name VARCHAR(255) DEFAULT NULL,
 email VARCHAR(255) DEFAULT NULL,
 primary_phone VARCHAR(14) DEFAULT NULL,
 secondary_phone VARCHAR(14) DEFAULT NULL,
 PRIMARY KEY (id)
);

CREATE TABLE locations (
 id int(11) NOT NULL AUTO_INCREMENT,
 name VARCHAR(255) DEFAULT NULL,
 street VARCHAR(255) DEFAULT NULL,
 city VARCHAR(255) DEFAULT NULL,
 state VARCHAR(2) DEFAULT NULL,
 zip_code VARCHAR(10) DEFAULT NULL,
 phone VARCHAR(14) DEFAULT NULL,
 fax VARCHAR(14) DEFAULT NULL,
 PRIMARY KEY (id)
);

CREATE TABLE rooms (
 id int(11) NOT NULL AUTO_INCREMENT,
 location_id int(11) NOT NULL,
 name VARCHAR(255),
 PRIMARY KEY (id),
 FOREIGN KEY (location_id)
  REFERENCES locations(id)
);

CREATE TABLE scheduled_classes (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 instructor_id int(11) NOT NULL,
 location_id int(11) NOT NULL,
 room_id int(11) NOT NULL,
 day ENUM('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun') DEFAULT NULL,
 start_date DATE DEFAULT NULL,
 end_date DATE DEFAULT NULL,
 start_time TIME DEFAULT NULL,
 end_time TIME DEFAULT NULL,
 PRIMARY KEY (ID),
 INDEX (class_id),
 INDEX (instructor_id),
 INDEX (location_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id),
 FOREIGN KEY (instructor_id)
  REFERENCES instructors(id),
 FOREIGN KEY (location_id)
  REFERENCES locations(id)
);