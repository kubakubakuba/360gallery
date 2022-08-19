<?php
    require_once("../../expaDB.php");
?>

<?php
if(isset($_GET["id"])){
    $id = mysqli_real_escape_string($mysqli, $_GET["id"]);
    $sql = "UPDATE expa SET valid = '0' WHERE id = '$id'";
    $result = $mysqli->query($sql);

    header("Location: ./index.php");
}
?>