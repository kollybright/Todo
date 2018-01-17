 CREATE DATABASE todo;
 CREATE TABLE reg_users(
  user_id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
  email VARCHAR(50),
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);

CREATE  TABLE  todo (
  event_id INT  NOT  NULL AUTO_INCREMENT PRIMARY KEY ,
  event VARCHAR (100) NOT  NULL ,
  the_time VARCHAR(10) NOT  NULL ,
  user_id INT NOT NULL,
  CONSTRAINT fk_todo_user_id FOREIGN KEY (user_id) REFERENCES reg_users(user_id) ON DELETE CASCADE
);
