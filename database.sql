
/**
 * Create database if not exist
 */
CREATE DATABASE IF NOT EXISTS mundial;

USE mundial;


/**
 * [Create table user]
 * 
 */
CREATE TABLE user(
  id INT(255) AUTO_INCREMENT NOT NULL PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  avatar VARCHAR(70),
  name VARCHAR(255),
  password CHAR(32) NOT NULL,
  createdAt DATETIME,
  status BOOLEAN
)ENGINE=INNODB;


/**
 * [Create table files]
 * 
 */
CREATE TABLE files(
	id INT(255) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name VARCHAR(255),
	gallery INT(255) NOT NULL,
	user INT(255) NOT NULL,
	avatar BOOLEAN,
	createdAt DATETIME,
	FOREIGN KEY(user) REFERENCES user(id)
)ENGINE=INNODB;

/**
 * [Create table figurita]
 * 
 */
CREATE TABLE figurita(
	id INT(255) AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name VARCHAR(255),
	citie VARCHAR(255),
	user INT(255) NOT NULL,
	file INT(255),
	createdAt DATETIME,
	FOREIGN KEY (user) REFERENCES user(id),
	FOREIGN KEY (file) REFERENCES files(id)
)ENGINE=INNODB;








