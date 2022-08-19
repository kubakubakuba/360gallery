<?php
    require_once("../expaDB.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie Astronomické Expedice</title>
    <link rel="stylesheet" href="./pannellum/pannellum.css"/>
    <script type="text/javascript" src="./pannellum/pannellum.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="https://astronomickaexpedice.cz/wp-content/uploads/2021/02/cropped-expa-preloader-32x32.png" type="image/x-icon">
    <style>
        #panorama {
            width: 97.5vw;
            height: 95vh;
            margin:auto;
            margin-top: 2.5vh;
        }

        body{
            background-color: #000000;
        }

        #footer {
            width: 97.5vw;
            display: flex;
            justify-content: space-between;
        }

        .whitetext{
            font-family: 'Righteous', cursive;
            color: white;
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4SVEVVKG8L"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-4SVEVVKG8L');
    </script>
</head>
<body>

    <div id="panorama"></div>
    <script>
    pannellum.viewer('panorama', {
        "type": "equirectangular",
        "panorama": "./assets/nightsky_edit.jpg",
        "autoLoad": true,
        "hotSpotDebug": false,
        "hotSpots": [
        <?php
            $sql = "SELECT * FROM expa WHERE valid = 1";
            $result = $mysqli->query($sql);
            
            $hotSpotsArr = array();
            while($row = $result->fetch_assoc()) {
                $url = $row["url"];
                $yaw = $row["yaw"];
                $pitch = $row["pitch"];
                $popis = $row["popis"];

                $blob = <<<XYX
                {
                    "pitch": $pitch,
                    "yaw": $yaw,
                    "type": "info",
                    "text": "$popis",
                    "URL": "$url"
                }
                XYX;
                array_push($hotSpotsArr, $blob);
            }
            $index = 0;
            $maxl = count($hotSpotsArr) - 1;
            foreach($hotSpotsArr as &$val){
                if($index == $maxl){
                    echo $hotSpotsArr[$index];
                }
                else{
                    echo $hotSpotsArr[$index] . ","; 
                }
                $index ++;
            }
        ?>
        ]
    });
    </script>
    <center>
        <div id="footer">
            <div class="whitetext"><a href="https://astronomickaexpedice.cz">https://astronomickaexpedice.cz</a></div>
            <div class="whitetext">Jakub Pelc, 2022</div>
        </div>
    </center>
    <script>
        let displayInfo = 1;
        window.addEventListener("keydown", function(event) {
            if (event.defaultPrevented) {
                return;
            }
            if (event.code === "KeyH"){
                if(displayInfo == 1){
                    displayInfo = 0;
                    handleOff();
                }
                else{
                    displayInfo = 1;
                    handleOn();
                }
            }
            event.preventDefault();
        }, true);

        function handleOn(){
            document.querySelectorAll('.pnlm-hotspot').forEach(function(e) {e.style.visibility = 'visible';});
        };

        function handleOff(){
            document.querySelectorAll('.pnlm-hotspot').forEach(function(e) {e.style.visibility = 'hidden';});
        };
    </script>
</body>
</html>

<!--
pannellum.viewer('panorama', {
        "type": "equirectangular",
        "panorama": "./assets/nightsky_8192_90p.jpg",
        "autoLoad": true,
        "hotSpotDebug": false,
        "hotSpots": [
            {
                "pitch": 59.32483657590147,
                "yaw": -125.36222588288611,
                "type": "info",
                "text": "<b>LBN527</b> <br />Scigifoto",
                "URL": "https://astronomickaexpedice.cz/2022/lbn-527/"
            },
            {
                "pitch": 75.88717303975265,
                "yaw": 99.38241814253827,
                "type": "info",
                "text": "<b>NGC7000</b> <br />Digifoto",
                "URL": "https://astronomickaexpedice.cz/2020/mlhovina-severni-amerika-ngc7000/"
            }
        ]
    });
->