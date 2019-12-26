<?php
$id = $_GET["id"];
include_once("database.php");
include_once("db.php");

$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);


$approve_comment_sql = "UPDATE comments SET approved=1 WHERE comment_id=:id";
$approve_comment_stmt = $conn->prepare($approve_comment_sql);
$approve_comment_stmt->execute([":id"=>$id]);
header("Location: /comments.php?id=".$_GET['news_id']);