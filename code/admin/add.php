<?php
    require_once("../../expaDB.php");
?>

<?php
    $url = $mysqli->real_escape_string($_POST["odkaz"]);
    $popis = $mysqli->real_escape_string($_POST["popis"]);
    $yaw = $mysqli->real_escape_string($_POST["yaw"]);
    $pitch = $mysqli->real_escape_string($_POST["pitch"]);

    $sql = "INSERT INTO expa (url, popis, yaw, pitch, valid) VALUES ('$url', '$popis', '$yaw', '$pitch', 1)";
    if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: ./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
?>