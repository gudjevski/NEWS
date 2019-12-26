<?php
include("database.php");
include("db.php");


$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);


$query = "
SELECT *
FROM news;";

$rows = $conn->query($query);


?>

    <html>
    <head>

    </head>
    <body>
    <form method="post" action="">
        <?php
           if ($_GET['id']!="") {
               ?>
               <label for="news_id" > news id </label ><input type = "text" id = "news_id" name = "news_id" value = "<?= $_GET["id"]; ?>" ><br />
          <?php
          }else{
               $i=0;
               ?>
                                  <label for="news_id"></label><select id="news_id" name="news_id">

        <?php

               foreach ($rows as $elem){
                   ?>
                        <option><?=$elem['news_id'] ?></option>

                   <?php
                   $i++;
               }
               ?>
                   </select>
               <?php

           }
        ?>
        <label for="author">author</label><input type="text" id="author" name="author"><br/>
        <label for="text">comment</label><textarea id="comment" name="comment"></textarea><br/>
        <input type="hidden" name="submitted" value="submitted"/>
        <input type="submit"/>

    </form>
    </body>
    </html>
<?php

if (!empty($_POST['submitted'])) {

    echo "ne e eempty";
    try {

        $insert_c = "INSERT INTO comments (news_id,author,comment,approved)
VALUES (:id, :author, :c, 0)";

        $st = $conn->prepare($insert_c);

        $st->bindParam(':id', $_POST['news_id'], PDO::PARAM_INT);
        $st->bindParam(':author', $_POST['author'], PDO::PARAM_STR);
        $st->bindParam(':c', $_POST['comment'], PDO::PARAM_STR);

        $st->execute();

        header("Location: comments.php?id=".$_POST['news_id']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}