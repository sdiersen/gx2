DROP TABLE IF EXISTS scheduled_classes;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS instructors;
DROP TABLE IF EXISTS locations;
DROP TABLE IF EXISTS class_levels;
DROP TABLE IF EXISTS class_types;
DROP TABLE IF EXISTS class_with_types;
DROP TABLE IF EXISTS class_with_levels;

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
 PRIMARY KEY (id)
);

INSERT INTO classes VALUES
 (1, 'Body Pump', 'Signature Les Mills strength training program using bars, plates, and the bench', 'TODO'),
 (2, 'Core Pilates', 'Working on the entire core to improve posture, increase flexibility, and strengthen muscles', 'TODO'),
 (3, 'Step', 'Choreographed class using platform step and risers', 'TODO');

CREATE TABLE class_with_levels (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 level_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (class_id),
 INDEX (level_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id),
 FOREIGN KEY (level_id)
  REFERENCES class_levels(id)
);

INSERT INTO class_with_levels VALUES
 (1, 1, 4),
 (2, 2, 4),
 (3, 3, 1),
 (4, 3, 2);

CREATE TABLE class_with_types (
 id int(11) NOT NULL AUTO_INCREMENT,
 class_id int(11) NOT NULL,
 type_id int(11) NOT NULL,
 PRIMARY KEY (id),
 INDEX (class_id),
 INDEX (type_id),
 FOREIGN KEY (class_id)
  REFERENCES classes(id),
 FOREIGN KEY (type_id)
  REFERENCES class_types(id)
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