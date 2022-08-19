<?php
    require_once("../../expaDB.php");
?>

<?php
    $changeID = $mysqli->real_escape_string($_GET["changeID"]);

    $newYaw = $mysqli->real_escape_string($_GET["newYaw"]);
    $newPitch = $mysqli->real_escape_string($_GET["newPitch"]);
    $newPopis = $mysqli->real_escape_string($_GET["newPopis"]);
    $newUrl = $mysqli->real_escape_string($_GET["newUrl"]);

    //$sql = "UPDATE expa SET yaw = '$newYaw', pitch = '$newPitch', popis = '$newPopis', url = '$newUrl' WHERE id = '$changeID'";

    $sql = "UPDATE expa SET ";
    $sql .= $newYaw != "" ? "yaw = '$newYaw', " : "";
    $sql .= $newPitch != "" ? "pitch = '$newPitch', " : "";
    $sql .= $newPopis != "" ? "popis = '$newPopis', " : "";
    $sql .= $newUrl != "" ? "url = '$newUrl', " : "";

    $sql1 = rtrim($sql, ", ");

    $sql1 .= " WHERE id = '$changeID'";

    $result = $mysqli->query($sql1);
    if ($mysqli->query($sql1) === TRUE) {
        echo "New record created successfully";
        header("Location: ./index.php");
    } else {
        echo "Error: " . $sql1 . "<br>" . $mysqli->error;
    }
    
?>