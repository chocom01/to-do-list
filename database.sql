CREATE DATABASE todo;

CREATE TABLE users (
                       id INT NOT NULL AUTO_INCREMENT,
                       name VARCHAR(14),
                       email VARCHAR(40),
                       password VARCHAR(14),
                       PRIMARY KEY (id)
);

CREATE TABLE statuses (
                          id INT NOT NULL AUTO_INCREMENT,
                          name VARCHAR(20) NOT NULL,
                          slug VARCHAR(20) NOT NULL,
                          PRIMARY KEY (id),
                          INDEX (name)
);

CREATE TABLE priorities (
                            id INT NOT NULL AUTO_INCREMENT,
                            name VARCHAR(20) NOT NULL,
                            slug VARCHAR(20) NOT NULL,
                            PRIMARY KEY (id),
                            INDEX (name)
);

CREATE TABLE tasks (
                       id INT NOT NULL AUTO_INCREMENT,
                       user_id INT NOT NULL,
                       status_id INT NOT NULL,
                       priority_id INT NOT NULL,
                       name VARCHAR(50) NOT NULL,
                       start_date TIMESTAMP,
                       end_date TIMESTAMP,
                       PRIMARY KEY (id),
                       FOREIGN KEY (user_id) REFERENCES users (id),
                       FOREIGN KEY (status_id) REFERENCES statuses (id),
                       FOREIGN KEY (priority_id) REFERENCES priorities (id),
                       INDEX (name)
);

CREATE TABLE categories (
                            id INT NOT NULL AUTO_INCREMENT,
                            name VARCHAR(14) NOT NULL,
                            slug VARCHAR(20) NOT NULL,
                            PRIMARY KEY (id),
                            INDEX (name)
);

CREATE TABLE categories_tasks (
                                  id INT NOT NULL AUTO_INCREMENT,
                                  task_id INT NOT NULL,
                                  category_id INT NOT NULL,
                                  PRIMARY KEY (id),
                                  FOREIGN KEY (task_id) REFERENCES tasks(id),
                                  FOREIGN KEY (category_id) REFERENCES categories(id)
);