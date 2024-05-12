CREATE TABLE tasks (
    task_id INT(255) NOT NULL AUTO_INCREMENT,
    owner_id INT(11) NOT NULL
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    deadline DATETIME NULL,
    completed TINYINT(1) NOT NULL DEFAULT 0,
    tag VARCHAR(255),
    PRIMARY KEY(task_id)
      
);
