<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

if(isset($_POST['formsignin'])) {

    if(!empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['fname']) AND !empty($_POST['lname']) AND !empty($_POST['password']) AND !empty($_POST['password2'])) {

        if($_POST['email'] == $_POST['email2']) {

            if($_POST['password'] == $_POST['password2']) {

                $psw = sha1($_POST['password']);
                $fname = htmlspecialchars($_POST['fname']);
                $lname = htmlspecialchars($_POST['lname']);
                $email = htmlspecialchars($_POST['email']);

                $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
                $reqmail->execute(array($email));
                $mailexist = $reqmail->rowCount();

                if($mailexist == 0) {

                    $insertmbr = $bdd->prepare("INSERT INTO `user ` (`userID`, `fname`, `lname`, `email`, `passwordUser`) VALUES (NULL, ?, ?, ?, ?);");
                    $insertmbr->execute(array($fname, $lname, $email, $psw));

                    header("Location: login?success=1");

                } else {

                    $error .= "Adresse mail déjà utilisée.";

                }

            } else {

                $error .= "Les mots de passe ne correspondent pas.";

            }

        } else {

            $error .= "Les adresses emails ne correspondent pas.";

        }

    } else {

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
                <a class="return" href="index"><i class="material-icons">keyboard_arrow_left</i> Return to the Homepage</a>
                <h2 class="title-form">Signin</h2>

                <form action="" method="post">

                    <label for="fname">Firstname</label>
                    <input id="fname" name="fname" type="text" placeholder="First name">
                    <label for="lname">Lastname</label>
                    <input id="lname" name="lname" type="text" placeholder="Last name">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Email">
                    <label for="email2">Confirm your email</label>
                    <input id="email2" name="email2" type="email" placeholder="Confirm your email">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Password">
                    <label for="password2">Confirm your password</label>
                    <input id="password2" name="password2" type="password" placeholder="Confirm your password">
                    <input name="formsignin" type="submit" value="Signin">

                </form>

                <a href="login" class="return add"><i class="material-icons">perm_identity</i> Already have an account</a>
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

                ?>

            </div>

        </div>
    </body>
</html>