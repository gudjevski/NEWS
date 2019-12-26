<?php
include_once("db.php");

// Try to connect to the database using PDO
try {

    //echo "{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}";

    $sql = "
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `news_title` VARCHAR(45) NOT NULL,
  `full_text` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`news_id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `comment` TINYTEXT NOT NULL,
  `approved` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`comment_id`),
  INDEX `nid_idx` (`news_id` ASC),
  CONSTRAINT `news_id`
    FOREIGN KEY (`news_id`)
    REFERENCES `news` (`news_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB ;
    ";

    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);

    //echo "Success";
} catch (PDOException $pEx) {
    print ("Error:" . $pEx->getMessage() . '<br />');
    die();
} catch (Exception $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}
