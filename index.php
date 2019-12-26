<?php
include("database.php");
include("db.php");

$conn = new PDO("{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);

$query = <<<HERE
SELECT n.news_id,n.date, n.news_title, n.full_text
FROM news as n LEFT JOIN comments c on n.news_id = c.news_id;
HERE;

$stat = $conn->prepare($query);

$stat->execute();
?>

<html>
<head>

</head>
<body>
<a href="/new.php">Add new News</a>
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
                <a href="/comments.php?id="<?= $row['news_id']?>><?= $row['news_id']?></a>
            </td>
            <td>
                <?=$row['date']?>
            </td>
            <td>
                <?= $row['news_title']?>
            </td>
            <td>
                <?= $row['full_text']?>
            </td>
            <td>
                <a href="/new-comment.php?id=<?=$row['news_id']?>">New Comment(<?= $row['br_comments']?>)</a>
            </td>
            <td>
                <a href="/edit.php?id=<?=$row['news_id']?>">Edit</a>
            </td>
            <td>
                <a href="/delete.php?id=<?=$row['news_id']?>">Delete</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</body>
</html>

