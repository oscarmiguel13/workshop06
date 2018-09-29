<style type="text/css">
    .padding{
        padding-left: 20px;
        padding-top:  50px;
    }
    .missing{
        padding-left: 20px;
        padding-top:  10px;
        float: left;
    }   
    .title{
        padding-left: 20px;
    }
</style>
<?php
require_once "pdo.php";
require_once "bootstrap.php";

if ( isset($_POST['cancel'] ) ) {
    session_destroy();
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

session_start();
if ( ! isset($_SESSION['login']) ) {
    die('Access Denied');
}
if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year'] )&& isset($_POST['mileage'])) {

    // Data validation
    if ( strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
        $_SESSION['error'] = 'Missing data';
        $_SESSION['required'] = '*';
        header("Location: add.php");
        return;
    }

    /*if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Bad data';
        header("Location: add.php");
        return;
    }*/

    $sql = "INSERT INTO autos (make, model, year, mileage)
              VALUES (:make, :model, :year, :mileage)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':model' => $_POST['model'],
        ':year' => $_POST['year'],
        ':mileage' => $_POST['mileage']));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: index.php' ) ;
    return;
}
echo "<h3 class=title>Petalver's Trucking Automobiles</h3>";
// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<div class=missing><p style="color:red">'.$_SESSION['error']."</p></div>\n";
    unset($_SESSION['error']);
}
?>
<div class="padding">
<form method="post">
<p>Make:
<input type="text" name="make"></p><span></span>
<p>Model:
<input type="text" name="model"></p>
<p>Year:
<input type="text" name="year"></p>
<p>Mileage:
<input type="text" name="mileage"></p>
<p><input type="submit" value="Add"/><input type="submit" name="cancel" value="Cancel"></p>
</form>
</div>
