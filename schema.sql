CREATE TABLE user(
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL unique,
  name VARCHAR(255),
  password VARCHAR(255) DEFAULT NULL,
  address VARCHAR(255),
  phone_number VARCHAR(255),
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  role VARCHAR(255) DEFAULT 'user',
  PRIMARY KEY (id)
);

CREATE TABLE gym(
  id INT NOT NULL AUTO_INCREMENT,
  owner_id INT NOT NULL,
  name VARCHAR(255) NOT NULL ,
  address VARCHAR(255),
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (id),
  FOREIGN KEY (owner_id) REFERENCES user(id)
);

CREATE TABLE class_type(
  id int NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (id)
);

CREATE TABLE session(
  id INT NOT NULL AUTO_INCREMENT,
  gym_id INT NOT NULL,
  class_type_id INT NOT NULL,
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (id),
  FOREIGN KEY (gym_id) REFERENCES gym(id),
  FOREIGN KEY (class_type_id) REFERENCES class_type(id)
);

CREATE TABLE register(
  id INT NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  session_id int NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (session_id) REFERENCES session(id)
);