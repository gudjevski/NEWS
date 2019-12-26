<?php
include("database.php");
include("db.php");
?>

<html>
<head>

</head>
<body>
<form method="post" action="">
<label for="title">Naslov na novosta</label><input type="text" id="title" name="title"><br/>
        <label for="text">Celosen text na novosta</label><textarea id="text" name="text"></textarea><br/>
    <input type="hidden" name="submitted" value="submitted"/>
    <input type="submit"/>

</form>
</body>
</html>
<?php

if (!empty($_POST['submitted'])){

    echo "ne e eempty";
try {

    $insert_q = "INSERT INTO news (date,news_title,full_text)
VALUES (NOW(), :title, :full_text)";

    $st = $conn->prepare($insert_q);

     $st->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
     $st->bindParam(':full_text', $_POST['text'], PDO::PARAM_STR);

     $st->execute();

    header("Location: index.php");
}
catch (Exception $e) {
    echo $e->getMessage();
}
//
//
//+--------------------------------
//    if (!empty($_POST['submit'])){
//        $insert_q = <<<INSERT
//INSERT INTO `messages`(`message_text`, `sender_username`, `sender_email`, `channel`, `time_sent`, is_unread)
//VALUES(:msg, :un, :eml, :cid, NOW(), 1)
//INSERT;
//
//
//        $st = $dbo->prepare($insert_q);
//        $st->bindParam(":msg", $_POST['msg'], PDO::PARAM_STR);
//        $st->bindParam(":un", $_POST['username'], PDO::PARAM_STR);
//        $st->bindParam(":eml", $_COOKIE['email'], PDO::PARAM_STR);
//        $st->bindParam(":cid", $channel_id, PDO::PARAM_INT);
//
//        $st->execute();
//
//    }




}