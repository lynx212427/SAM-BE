<?php
include("connect.php");
include("classes.php");

$quarters = array();

$getIslandQuery = "
    SELECT 
        ip.islandOfPersonalityID,
        ip.name AS island_name, 
        ip.longDescription AS long_desc, 
        ic.islandContentID,
        ic.content AS content, 
        ic.image AS island_image,
        ip.image AS personality_image
    FROM islandsofpersonality ip
    JOIN islandcontents ic ON ip.islandOfPersonalityID = ic.islandOfPersonalityID
    ORDER BY ip.islandOfPersonalityID, ic.islandContentID
";

$getIslandResult = executeQuery($getIslandQuery);

if (!$getIslandResult) {
    die('Query failed: ' . mysqli_error($connection));
}

while ($row = mysqli_fetch_assoc($getIslandResult)) {
    $a = new Island(
        $row['island_name'],
        $row['long_desc'],
        $row['content'],
        $row['island_image'],
        $row['personality_image'],
        $row['islandContentID'],
        $row['islandOfPersonalityID']
    );

    if (!isset($quarters[$row['islandOfPersonalityID']])) {
        $quarters[$row['islandOfPersonalityID']] = array();
    }
    array_push($quarters[$row['islandOfPersonalityID']], $a);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAM-BE: Islands of Personality</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://raw.githubusercontent.com/lynx212427/SAM-BE/refs/heads/main/assets/web_icon.ico" type="image/x-icon">
</head>

<body class="embarrassment-color">

    <div class="container shadow fear-color mt-2 p-5">
        <div class="row">
            <div class="col">
                <h1 class="text-uppercase text-center">WELCOME TO ISLANDS OF PERSONALITY!</h1>
                <h5 class="text-center fw-light mt-1">These are some of my personalities that is easily to be observed when you join my exploration.</h5>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="anger-color cardsTitle m-2">
            <span>Music</span>
        </div>
        <div class="anxiety-color cardsTitle m-2">
            <span>Game</span>
        </div>
        <div class="joy-color cardsTitle m-2">
            <span>Movie</span>
        </div>
        <div class="envy-color cardsTitle m-2">
            <span>Art</span>
        </div>

        <div class="container imgCon">
            <div class="col">
                <div class="row">
                </div>
    
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <?php
                        foreach ($quarters as $personalityID => $islands) {
                            $firstIsland = $islands[0];
                            echo $firstIsland->generatePersonalityHeader(); 
                            foreach ($islands as $island) {
                                echo $island->generateContentCard();
                            }
                            echo Island::closePersonalitySection();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer text-center anger-color">
            <div class="container-fluid p-3 ennui-color"></div>
            <div class="container-fluid p-3 envy-color"></div>
            <div class="container-fluid p-3 joy-color"></div>
            <div class="container-fluid p-3 anxiety-color"></div>
            <div class="text-center p-3" >
                © 2024 Copyright: Alfea Aemiel V. Mingua
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
            </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
            </script>
</body>
</html>