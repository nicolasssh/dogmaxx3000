<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

if(!empty($_SESSION)) {
    $getid = intval($_SESSION['userID']);
    $requser = $bdd->prepare('SELECT * FROM user WHERE userID = ?');
    $requser->execute(array($_SESSION['userID']));
    $userinfo = $requser->fetch();

    $reqhist = $bdd->prepare('SELECT * FROM alertsUser WHERE userID = ? ORDER BY alertID DESC');
    $reqhist->execute(array($_SESSION['userID']));
    $nbhist = $reqhist->rowCount();

    /*echo "Connected<br>";
    echo $_SESSION['alertUser'].'<br>';
    echo $_SESSION['userID'].'<br>';
    echo $nbhist;*/
}

date_default_timezone_set('Europe/Paris');

?>

<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DogMaxx3000 | Historique | <?php 
            if (!empty($_SESSION)) {
                echo 'Connected';
            } else {
                echo 'Disconnected';
            }
        ?></title>
</head>
<body>
<?php

if (empty($_SESSION)) {

header('Location: index');

} else {

?>

<div class="header">
    <div class="logo">
        <img src="img/logo-dogmaxx.png" alt="logo">
    </div>
    <div class="menu">
        <!--<a class="link signin" href="<?= 'mbr?user='.$_SESSION['ID']?>"><i class="material-icons">face</i> Espace Membre</a>-->
        <a href="<?= 'index?user='.$_SESSION['userID'] ?>" class="link">Accueil</a>
        <a href="disconnect" class="link">Deconnexion</a>
    </div>
</div>
<?php 
} 
?>


    <div class="page-content-hist">
        <center><h2>Historique des actions</h2></center><br>
            <?php
                if($nbhist > 0) {
                    while($data = $reqhist->fetch()) {
                        if($data['type'] == 'aboi') {
                            echo '<div class="alert">';
                            echo '<b>🐕 Votre chien à aboyé</b>';
                            echo ' : <br>';
                            echo '📅 '.$data['alertDate'].' <br>🕒 '.$data['alertTime'];
                            echo '</div>';
                        } elseif($data['type'] == 'croquettes') {
                            echo '<div class="alert">';
                            echo '<b>🦴 Vous avez nourri votre chien</b>';
                            echo ' : <br>';
                            echo '📅 '.$data['alertDate'].' <br>🕒 '.$data['alertTime'];
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<div style="background-color:red; color:white;text-align:center;" class="alert">';
                    echo '⚠️ Aucun résultat.';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</body>
</html>