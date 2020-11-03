<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

if(isset($_POST['formlogin'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);

    if(!empty($_POST['email']) AND !empty($_POST['password'])) {
        $requser = $bdd->prepare("SELECT * FROM `user ` WHERE `email` = ? AND `passwordUser` = ?");
        $requser->execute(array($email, $password));
        $userexist = $requser->rowCount();
        if($userexist == 1) {

            $userinfo = $requser->fetch();
            $_SESSION['userID'] = $userinfo['userID'];
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['fname'] = $userinfo['fname'];
            $_SESSION['lname'] = $userinfo['fname'];
            $_SESSION['alertUser'] = $userinfo['alertUser'];

            header("Location: index?user=" .$userinfo['userID']);

        } else {
            $error .= "L'adresse email ou le mot de passe sont incorrect.";
        }
    }else{
        $error .= "Tous les champs doivent être complétés.";
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
                if (empty($_GET['valid'])) {
                    ?>
                        <a class="return" href="index"><i class="material-icons">keyboard_arrow_left</i> Return to the Homepage</a>
                        <h2 class="title-form">Login</h2>
                    <?php
                }
                ?>

                <form action="" method="post">

                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="Email">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password">
                    <input name="formlogin" type="submit" value="Login">

                </form>

                <?php
                if (empty($_GET['valid'])) {
                    ?>
                        <a href="signin" class="return add"><i class="material-icons">control_point</i> Don't have an account</a>
                    <?php
                }
                ?>
                <br>
                <br>
                <?php

                    if (!empty($error)) {

                        ?>

                            <div class="error">
                                <?php
                                echo $error;
                                ?>
                            </div>

                        <?php

                    }
                    if ($_GET['success'] == 1 AND empty($error)) {

                        ?>

                            <div class="success">
                                <?php
                                echo "Le compte a été créé avec succés.";
                                ?>
                            </div>

                        <?php

                    }
                    if($_GET['valid'] == 1) {
                        ?>

                            <div class="success">
                                <?php
                                echo "Connectez-vous pour valider la modification.";
                                ?>
                            </div>

                        <?php
                    }

                ?>

            </div>

        </div>
    </body>
</html>