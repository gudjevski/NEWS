<?php
include("database.php");
include("db.php");

//$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);

$query = <<<HERE
SELECT *
FROM comments
WHERE news_id = :id;
HERE;

$stat = $conn->prepare($query);

$stat->bindParam(':id',$_GET['id'],PDO::PARAM_INT);

$stat->execute();
?>

<html>
<head>

</head>
<body>
<a href="/new-comment.php">Add new Comment</a>
<table border="solid">
    <thead>
    <th>News id</th>
    <th>Date</th>
    <th>News title</th>
    <th>News article</th>
    <th>Add comment</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>
    <?php
    while ($row = $stat->fetch()) {
        ?>
        <tr>
            <td>
                <?= $row['comment_id']?>
            </td>
            <td>
                <?=$row['news_id']?>
            </td>
            <td>
                <?= $row['author']?>
            </td>
            <td>
                <?= $row['comment']?>
            </td>
            <td>
                <a href="/approve.php?id=<?= $row['comment_id']?>&news_id=<?= $row['news_id']?>"><?= $row['approved']?></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>
