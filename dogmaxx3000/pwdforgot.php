<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

if(!empty($_GET["forgot"])) {
    $requser = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $requser->execute(array($_GET['forgot']));
    $userinfo = $requser->fetch();
}

date_default_timezone_set('Europe/Paris');

if(isset($_POST['pwdforgotform'])) {
    $exist = $bdd->prepare('SELECT * FROM user WHERE email = ?');
    $exist->execute($_POST['newemail']);
    $count = $exist->rowCount();
    echo $count;
    echo $_POST['newemail'];
    if($count > 0) {
        $error = "Le compte existe.";
    } elseif($count <= 0) {
        $error = "Le compte n'existe pas";
    }
}

?>

<html lang="fr">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>DogMaxx3000</title>
    </head>
    <body style="background-color:rgb(255, 136, 0);">
        <div class="page-content">
            <div class="form-center-page">
                <?php
                    if(empty($_GET["forgot"])) {
                        ?>
                            <form action="" method="post">

                            <label for="newemail">Your email</label>
                            <input id="newemail" name="newemail" type="email" placeholder="Your email">
                            <input name="pwdforgotform" type="submit" value="Submit">

                            </form>
                        <?php
                    } else {
                        ?>
                            <form action="" method="post">

                            <label for="password">New password</label>
                            <input id="newpwd" name="newpwd" type="password" placeholder="New password">
                            <label for="password">Confirm password</label>
                            <input id="newpwd2" name="newpwd2" type="password" placeholder="Confirm password">
                            <input name="newpwdform" type="submit" value="Submit">

                            </form>
                        <?php                        
                    }
                    if (!empty($error)) {

                        ?>

                            <div class="error">
                                <?php
                                echo $error;
                                ?>
                            </div>

                        <?php

                    }
                ?>
            </div>
        </div>
    </body>
</html>