 DROP TABLE IF EXISTS cosmelog;

CREATE TABLE cosmelog (
  id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255),
  product_maker VARCHAR(255),
  use_by_date  VARCHAR(10),
  suggestion INTEGER(10) ,
    etc VARCHAR(255)
) DEFAULT CHARACTER SET =utf8mb4;
