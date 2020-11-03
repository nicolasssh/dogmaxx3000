<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

if(!empty($_SESSION)) {
    echo "Connected";
    echo $_SESSION['alertUser'];
    echo $_SESSION['userID'];
    $getid = intval($_SESSION['userID']);
    $requser = $bdd->prepare('SELECT * FROM user WHERE userID = ?');
    $requser->execute(array($_SESSION['userID']));
    $userinfo = $requser->fetch();
}

date_default_timezone_set('Europe/Paris');

?>

<html lang="fr">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>DogMaxx3000 | <?php 
            if (!empty($_SESSION)) {
                echo 'Connected';
            } else {
                echo 'Disconnected';
            }
        ?></title>
        <link rel="icon" href="img/logo-dogmaxx.png" type="image/png">
    </head>
    <body>
        <?php

        if($_GET['success'] == 1) {
            echo "<script>alert('Email envoyé.')</script>";
        }

        if (empty($_SESSION)) {

            ?>

            <div class="header">
                <div class="logo">
                    <img src="img/logo-dogmaxx.png" alt="logo">
                </div>
                <div class="menu">
                    <!--<a href="" class="link">Acceuil</a>
                    <a href="" class="link">Contact</a>-->
                    <a href="login" class="login link">Se Connecter</a>
                    <a href="signin" class="signin">S'enregistrer</a>
                </div>
            </div>

            <div id="video-container" class="video-display">
                <center><h2>Révolutionnez la vie de votre chien!</h2>
                <p>Portez lui de l'attention même à distance.</p>    
            </center>
                <img src="img/model3d.png" alt="model3d">
            </div>

            <?php

        } else {

            ?>

            <div class="header">
                <div class="logo">
                    <img src="img/logo-dogmaxx.png" alt="logo">
                </div>
                <div class="menu">
                    <!--<a class="link signin" href="<?= 'mbr?user='.$_SESSION['ID']?>"><i class="material-icons">face</i> Espace Membre</a>-->
                    <a href="disconnect" class="link">Deconnexion</a>
                </div>
            </div>

            <div id="video-container" class="video-display">
                <img src="img/offline_flux.png" alt="offline">
            </div>

            <?php /* echo date('d/m/Y H:i');*/ ?>

            <!--<div name="lancecroq" id="lancecroq" class="controls-btn"></div>-->
            <center>
            <form method="post">
                <button name="lancecroq" id="lancecroq" class="controls-btn">
                    <i class="material-icons">fastfood</i>
                </button>
                
                <button name="sendnotif" id="sendnotif" class="controls-btn">
                    <i class="material-icons">email</i>
                </button>

                <button name="histo" id="histo" class="controls-btn">
                    <i class="material-icons">schedule</i>
                </button>
            </form>
            </center>


            <?php
            if(isset($_POST['lancecroq'])) {
                $addCroqHist = $bdd->prepare('INSERT INTO `alertsUser` (`alertID`, `userID`, `type`, `alertDate`, `alertTime`) VALUES (NULL, ?, ?, ?, ?)');
                $addCroqHist->execute(array($_SESSION['userID'], 'croquettes', date('d/m/Y'), date('H:i')));
                ?>
                    <script>alert("Attention le but n'est pas d'achever votre animal de compagnie.")</script>
                <?php
            }

            if(isset($_POST['sendnotif'])) {

                /* Europe/Paris */

                /*$headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
                $headers .= "From: DogMaxx3000 <nicolas@nitryta.com> \r\n";
                $headers .= "Reply-to : nicolas@nitryta.com \r\n";
                $headers .= 'Content-Disposition: inline'."\r\n";
                $headers .= "X-Priority: 1 \r\n"; 
                $headers .= 'X-Mailer:PHP/'.phpversion().'\r\n';
                $headers .= "Date:" . date("D, d M Y h:s:i") . " +0200\n";	
                $headers .= 'Content-Transfer-Encoding: 8bit';
                $usermail = $_SESSION['email'];
                $object = '🐕 [Alerte] Votre chien a aboyé!';
                $msg = '<html lang="fr">';
                $msg .= '<head>';
                $msg .= '<style>';
                $msg .= 'body {width:90%;background-color: white;font-family: sans-serif;}';
                $msg .= '</style>';
                $msg .= '</head>';
                $msg .= '<body>';
                $msg .= '<h1>⚠️ Votre chien a aboyé</h1><br>';
                $msg .= '📅 ';
                $msg .= date('d/m/Y');
                $msg .= '<br>';
                $msg .= '🕒 ';
                $msg .= date('H:i');
                $msg .= '</body></html>';
                $emailsend = mail($usermail, $object, $msg, $headers);*/

                $addAlertHist = $bdd->prepare('INSERT INTO `alertsUser` (`alertID`, `userID`, `type`, `alertDate`, `alertTime`) VALUES (NULL, ?, ?, ?, ?)');
                $addAlertHist->execute(array($_SESSION['userID'], 'aboi', date('d/m/Y'), date('H:i')));

                if($emailsend == true) {
                    header("Location: index?user=".$_SESSION['userID']."&success=1");
                } else {
                    echo "<script>alert('Un problème est survenu lors de l'envoi du mail.')</script>";
                }
            }
            /*if(isset($_POST['sendnotif'])) {

                    $alertOn = '1';
                    $alertOff = '2';

                    if($_SESSION['alertUser']) {
                        $activeAlert = $bdd->prepare("UPDATE user SET alertUser = ? WHERE id = ?");
                        $activeAlert->execute(array('1', $_SESSION['id']));
                        //header("Cache-Control:no-cache");
                        header('Location: login?valid=1');
                    } else {
                        $activeAlert = $bdd->prepare("UPDATE user SET alertUser = ? WHERE id = ?");
                        $activeAlert->execute(array('2', $_SESSION['id']));
                        //header("Cache-Control:no-cache");
                        header('Location: login?valid=1');
                    }
                
            }*/

            if(isset($_POST['histo'])) {
                header("Location: alerts?user=".$_SESSION['userID']);
            }

        }
        if ($_GET["error"] == "code130") {
            echo "<script>alert('Vous n\'êtes pas connecté.')</script>";
        }
        ?>
    </body>
</html>