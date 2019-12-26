<?php
$DB_HOST = 'dimchedb.mysql.database.azure.com';
$DB_NAME = 'news'; //TODO
$DB_USER = 'gudjevski@dimchedb'; //TODO
$DB_PASS = 'Viktorija@01'; //TODO
$DB_TYPE = 'mysql';

try {
    $conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);
}catch (PDOException $pEx) {
    print ("Error:" . $pEx->getMessage() . '<br />');
    die();
} catch (Exception $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit();
}