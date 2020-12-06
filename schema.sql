CREATE TABLE user(
  user_id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL unique,
  name VARCHAR(255),
  password VARCHAR(255) DEFAULT NULL, 
  address VARCHAR(255),
  phone_number VARCHAR(255),
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  role VARCHAR(255) DEFAULT 'user',
  PRIMARY KEY (user_id)
);

CREATE TABLE gym(
  gym_id INT NOT NULL AUTO_INCREMENT,
  owner_id INT NOT NULL,
  name VARCHAR(255) NOT NULL ,
  address VARCHAR(255),
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (gym_id),
  FOREIGN KEY (owner_id) REFERENCES user(user_id)
);

CREATE TABLE class_type(
  class_type_id int NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (class_type_id)
);

CREATE TABLE session(
  session_id INT NOT NULL AUTO_INCREMENT,
  gym_id INT NOT NULL,
  class_type_id INT NOT NULL,
  start_time DATETIME NOT NULL,
  end_time DATETIME NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  PRIMARY KEY (session_id),
  FOREIGN KEY (gym_id) REFERENCES gym(gym_id),
  FOREIGN KEY (class_type_id) REFERENCES class_type(class_type_id)
);

CREATE TABLE register(
  user_id int NOT NULL,
  session_id int NOT NULL,
  created DATETIME NOT NULL DEFAULT now(),
  modified DATETIME NOT NULL DEFAULT now() ON UPDATE now(),
  CONSTRAINT register_user_sess PRIMARY KEY (user_id, session_id)
);