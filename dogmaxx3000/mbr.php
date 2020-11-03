<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
}

if(isset($_GET['user'])) {
    $requser = $bdd->prepare("SELECT * FROM user WHERE userID = ?");
    $requser->execute(array($_GET['user']));
    $user = $requser->fetch();
    if(isset($_POST['fname']) AND !empty($_POST['fname']) AND $_POST['fname'] != $user['fname']) {
       $newfname = htmlspecialchars($_POST['fname']);
       $insertfname = $bdd->prepare("UPDATE user SET fname = ? WHERE userID = ?");
       $insertfname->execute(array($newfname, $_SESSION['ID']));
       header('Location: mbr?user='.$_SESSION['ID'].'&success=1');
    } else {
        header('Location: mbr?id='.$_SESSION['ID'].'&success=2');
    }
    if(isset($_POST['lname']) AND !empty($_POST['lname']) AND $_POST['lname'] != $user['lname']) {
       $newlname = htmlspecialchars($_POST['lname']);
       $insertlname = $bdd->prepare("UPDATE user SET lname = ? WHERE userID = ?");
       $insertlname->execute(array($newlname, $_SESSION['ID']));
       header('Location: mbr?user='.$_SESSION['ID'].'&success=1');
    } else {
        header('Location: mbr?user='.$_SESSION['ID'].'&success=2');
    }
    if(isset($_POST['email']) AND !empty($_POST['email']) AND $_POST['email'] != $user['enail']) {
        $newemail = htmlspecialchars($_POST['email']);
        $insertemail = $bdd->prepare("UPDATE user SET email = ? WHERE userID = ?");
        $insertemail->execute(array($newemail, $_SESSION['ID']));
        header('Location: mbr?user='.$_SESSION['ID'].'&success=1');
     } else {
         header('Location: mbr?user='.$_SESSION['ID'].'&success=2');
     }
    }
    
 ?>

?>

<html lang="fr">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>DogMaxx3000</title>
    </head>
    <body>
        <?php

        if (empty($_SESSION)) {

            header("Location: index?error=code130");

        } else {

            ?>

            <div class="header">
                <div class="logo">
                    <img src="" alt="logo">
                </div>
                <div class="menu">
                    <a class="link signin" href=""><i class="material-icons">face</i> Espace Membre</a>
                    <a href="disconnect" class="link">Deconnexion</a>
                </div>
            </div>
            
            <div class="page-content">
            <div style="margin-top:120px;" class="section controls">
                <div class="controls-btn historique"></div>
                <div class="controls-btn alerts"></div>
                <div class="controls-btn croquettes"></div>
            </div>
            <div class="section modify">
                <form action="" method="post">

                    <label for="fname">Firstname</label>
                    <input id="fname" name="fname" type="text" placeholder="<?= $userinfo["fname"] ?>">
                    <label for="lname">Lastname</label>
                    <input id="lname" name="lname" type="text" placeholder="<?= $userinfo["lname"] ?>">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="<?= $userinfo["email"] ?>">
                    <input name="modif" type="submit" value="Modifier">
                    <?= $userinfo ?>

                    <?php

                        if($_GET["success"] == 1) {
                            ?>
                                <div class="success">
                                    Les informations on été modifiées.
                                </div>
                            <?php
                        } elseif($_GET["success"] == 0) {
                            ?>
                                <div style="background-color:rgb(75, 75, 255);" class="success">
                                    Voici vos informations.
                                </div>
                            <?php
                        } elseif($_GET["success"] == 2) {
                            ?>
                                <div class="error">
                                    Une erreur est parvenue.
                                </div>
                            <?php
                        }

                    ?>

                </form>
            </div>
        <?php
        }
        ?>
    </body>
</html>