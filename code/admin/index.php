<?php
    require_once("../../expaDB.php");
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrace Galerie Astronomick√© Expedice</title>
        <link rel="stylesheet" href="../pannellum/pannellum.css"/>
        <script type="text/javascript" src="../pannellum/pannellum.js"></script>
        <script type="text/javascript" src="./admin.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="shortcut icon" href="https://astronomickaexpedice.cz/wp-content/uploads/2021/02/cropped-expa-preloader-32x32.png" type="image/x-icon">
        <style>
            #panorama {
                width: 50vw;
                height: 50vh;
                margin:auto;
                margin-top: 2.5vh;
            }

            body{
                background-color: #000000;
            }

            .getLoc{
                margin: 5px;
            }

            .whitetext{
                color: white;
            }

            input{
                margin: 5px;
            }

            .smalltext{
                font-size: 12px;
            }

            .atable{
                border-collapse: collapse;
                width: 75%;
            }

            table, th, td {
                border: 2px solid white;
                color: white;
            }

            td{
                word-wrap: break-word;
                text-align: center;
            }

            .smaller{
                font-size: 12px;
            }

            p{
                max-width: 75vw;
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
    <body onload="getTable()">

        <div id="panorama"></div>
        <center>
            <!--<button class="getLoc" onclick="getLocation()">Z√≠skat pozici</button>-->
            <form autocomplete="off" class="whitetext" action="add.php" method="post">
                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                Yaw: <input type="text" name="yaw" id="yawtext">
                Pitch: <input type="text" name="pitch" id="pitchtext"><br />
                Popis: <input oninput="showPreview()" type="text" name="popis" id="popistext"><br />
                        <p class="whitetext">Preview:</p>
                        <span class="whitetext" style="width: 58px;" id="previewBox"><b>NGC7000</b> <br />Digifoto</span>
                        <h5 class="whitetext smalltext">
                                &lt;br /> pro dalŇ°√≠ Ňô√°dek <br />
                                &lt;b> text &lt;/b> pro tuńćn√Ĺ text <br />
                                Ostatn√≠ html funguje takt√©Ňĺ.
                        </h5>
                Odkaz: <input oninput="updateLink()" type="text" name="odkaz" id="urltext"><br />
                <input type="submit">
            </form>
            <h4 class="whitetext">N√°vod:</h4>
            <p class="whitetext smaller">1. Zarovnejte kŇô√≠Ňĺek na ńć√°st oblohy, kam chcete um√≠stit bod (zoom koleńćkem). AŇĺ budete m√≠t kŇô√≠Ňĺek na m√≠stńõ kam chcete um√≠stit bod (pŇôi maxim√°ln√≠m zoomu), kliknńõte myŇ°√≠ (mńõla by se o trochu zmńõnit hodnota Yaw a Pitch, pŇôi dalŇ°√≠m kliknut√≠ uŇĺ ne).</p>
            <p class="whitetext smaller">2. VyplŇąte popis obr√°zku (stylov√°n√≠ pomoc√≠ html tagŇĮ, vzhled se v√°m zobrazuje pod textem preview, <br /> defaultn√≠ styl je " &lt;b>NGC7000&lt;/b> &lt;br />Digifoto "</p>
            <p class="whitetext smaller">3. VloŇĺte odkaz na blog / fotografii s popisem.</p>
            <p class="whitetext smaller">4. Stisknńõte odeslat, zkontrolujte, zda se obr√°zek zobraz√≠ v tabulce a na spr√°vn√©m m√≠stńõ na obloze. Pokud ne, pro odebr√°n√≠ bodu kliknńõte na remove v dan√©m Ňô√°dku. ŗ∂ě</p>
            <p class="whitetext smaller">5. pro √ļpravy dan√©ho bodu, zmńõŇąte pouze ty parametry, kter√© chcete upravit. Pot√© kliknńõte na upravit v dan√©m Ňô√°dku tabulky.</p>
            
            <?php
                $sql = "SELECT * FROM expa WHERE valid = 1";
                $result = $mysqli->query($sql);
                                                
                echo "<div class='tablediv' style='overflow-x:auto;'><table class='atable'><tr><th style='width: 0px; display:none;'>ID</th><th>Popis</th><th>URL</th><th>Yaw</th><th>Pitch</th><th>Remove</th><th>Edit</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td class='editID' style='width: 0px; display:none;'>".$row["id"]."</td><td>".$row["popis"]."</td><td><a href='".$row["url"]."'>odkaz</a></td><td>".$row["yaw"]."</td><td>".$row["pitch"]."</td><td><a href='./remove.php?id=".$row["id"]."'>odstranit</a></td><td><a class='editLink' href='./edit.php?changeID=".$row["id"]."'>upravit</a></td></tr>";
                }
                echo "</table></div>";
            ?>
            </center>
        <script>
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "../assets/nightsky_edit.jpg",
            "autoLoad": true,
            "hotSpotDebug": true,
            "hotSpots": [
            <?php
                $sql1 = "SELECT * FROM expa WHERE valid = 1";
                $result1 = $mysqli->query($sql1);
                
                $hotSpotsArr = array();
                while($row = $result1->fetch_assoc()) {
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

    </body>
</html>