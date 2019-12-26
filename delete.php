<?php
include_once("database.php");
include_once("db.php");

$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);

$delete_sql = "DELETE FROM news WHERE news_id = :id";
$stmt = $conn->prepare($delete_sql);
$stmt->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
$stmt->execute();

header("Location: /index.php");