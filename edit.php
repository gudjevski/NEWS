<?php

include_once("database.php");
include_once("db.php");

$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);


$naslov = "";
$statija = "";
$id = $_GET["id"];
$sql = 'SELECT * FROM news WHERE news_id=:id';
$statement = $conn->prepare($sql);
$statement->execute([':id' => $id ]);
$data = $statement->fetch(PDO::FETCH_ASSOC);
if(!empty($_POST["submitted"])){
    if(!empty($_POST["naslov"]) && !empty($_POST["statija"])){
        $naslov=$_POST["naslov"];
        $statija=$_POST["statija"];
        $edit_sql = "UPDATE news SET news_title = :naslov, full_text = :statija WHERE news_id = :id";
        $stmt=$conn->prepare($edit_sql);
        $stmt->execute([':naslov'=>$naslov,':statija'=>$statija,':id'=>$id]);
        header("Location: /index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<h1>Edit POST</h1>
<form action="" method="POST">
    <div class="input-group">
        <label for="naslov">Naslov na novosta</label>
        <input type="text" id="naslov" name="naslov" value="<?= $data["news_title"]; ?>">
    </div>
    <div class="input-group">
        <label for="statija">Celosen text na novosta</label>
        <textarea type="text" id="statija" name="statija"><?= $data["full_text"]; ?></textarea>
    </div>
    <input type="hidden" name="submitted" value="submitted">
    <input type="submit">
</form>
</body>
</html>
