use pentas_bakat;

CREATE TABLE contestants (
   id INT UNSIGNED AUTO_INCREMENT,
   name VARCHAR(100),
   video_url VARCHAR(120) DEFAULT NULL,
   vote_count BIGINT UNSIGNED DEFAULT 0,
   created DATETIME DEFAULT NULL,
   modified DATETIME DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE votes(
   id BIGINT UNSIGNED AUTO_INCREMENT,
   receipt_reference VARCHAR(100) UNIQUE NOT NULL,
   email VARCHAR(100) NOT NULL,
   assigned_vote INT NOT NULL,
   remaining_vote INT NOT NULL,
   created DATETIME DEFAULT NULL,
   modified DATETIME DEFAULT NULL,
   PRIMARY KEY(id, receipt_reference)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE contestants_votes (
   id BIGINT UNSIGNED AUTO_INCREMENT,
   contestant_id INT UNSIGNED NOT NULL,
   vote_id BIGINT UNSIGNED NOT NULL,
   created DATETIME DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (contestant_id) REFERENCES contestants(id),
   FOREIGN KEY (vote_id) REFERENCES votes(id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;