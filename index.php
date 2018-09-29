<!DOCTYPE html>
<html>
<head>
<title>Carlo Petalver - Autos Database</title>
<?php require_once "bootstrap.php"; 
?>
</head>
<style type="text/css">
    table{
        margin-top: 10px;
    }
    td{
        padding: 8px;
    }
    .padleft{
        padding-top: 10px;
    }
    .del{
        color: red;
    }
    .del:hover{
        color: red;
    }
    th{
        padding: 8px;
        color: #696969;
    }
</style>
<body>
<div class="container">
<!--<a href="http://www.wa4e.com/code/rps.zip"
 target="_blank">Source Code for this Application</a>-->
<?php
require_once "pdo.php";
//session_start();
?>
<html>
<head></head><body>
<?php
session_start();
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
if($_SESSION['login']){
echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT * FROM autos");
 echo "<th>Make</th>";
 echo "<th>Model</th>";
 echo "<th>Year</th>";
 echo "<th>Mileage</th>";
 echo "<th>Action</th>";
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['model']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> | ');
    echo('<a class=del href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
    echo'</table>';
    echo'<div class="padleft"><a href="add.php">Add New Entry</a></div>';
    echo'<div class="padleft"><a href="unset.php">Logout</a></div>';
    //unset($_SESSION['login']);
}
else{
    echo'<h1>Welcome to Autos Database</h1>';
    echo'<p>';
    echo'<a href="login.php">Please Log In</a>';
    echo'<p>Attempt to <a href="add.php">add data</a> without logging in <p>';
}
?>
</p>
</div>
</body>