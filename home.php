<?php
require_once "pdo.php";
require_once "bootstrap.php";
session_start();
if ( ! isset($_SESSION['login']) ) {
    die('Access Denied');
}
?>
<html>
<head></head>
<style type="text/css">
    table{
        margin-top: 50px;
        margin-left: 50px;
    }
    td{
        padding: 10px;
    }
    .padleft{
        margin-left: 50px;
        padding-top: 10px;
    }
    .del{
        color: red;
    }
    .del:hover{
        color: red;
    }
</style><body>
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> | ');
    echo('<a class=del href="delete.php?user_id='.$row['user_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
?>
</table>
<div class="padleft"><a href="add.php">Add New</a></div>
