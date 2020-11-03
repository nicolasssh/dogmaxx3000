<?php

session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=dogmaxx3000', 'bdd', '');
} catch(exception $e) {
    echo $e;
    die;
}

/*$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
$headers .= "From: DogMaxx3000 <nicolas@nitryta.com>";
$usermail = $_SESSION['email'];
$object = '🐕 Votre chien a aboyé!';
$msg = '<html><head>';
$msg .= '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
$msg .= '</head><body>';
$msg .= '<center>';
$msg .= '<h4>[Alerte] Votre chien a aboyé!<br>';
$msg .= '<i class="material-icons></i>';
$msg .= ' '.date('d/m/Y').'<br>';
$msg .= '<i class="material-icons>schedule</i>';
$msg .= ' '.date('H:i').'<br>';
$msg .= '</body></html>'*/

    if($_SESSION['alertUser'] == '1') {
        $alertadjust = $bdd->prepare("UPDATE user SET alertUser = '0' WHERE userID = ?");
        $alertadjust->execute($_SESSION['userID']);
        header("Cache-Control:no-cache");
        header('Location: login?valid=1');
    } elseif($_SESSION['alertUser'] == '0') {
        $alertadjust = $bdd->prepare("UPDATE user SET alertUser = '1' WHERE userID = ?");
        $alertadjust->execute($_SESSION['userID']);
        header('Location: login?valid=1');
    }

?>

<!--<!DOCTYPE html>
<html lang="fr">
    <head>
        <style>
            body {width:90%;background-color: white;font-family: sans-serif;}
        </style>
    </head>
    <body>
        <center>
        <img width="300px" src="http://localhost:8888/dogmaxx3000/img/logo-dogmaxx.png" alt="logo">
        <h1>⚠️ Votre chien a aboyé ⚠️</h1>
        📅 <?= 'Le '.date('d/m/Y') ?>
        <br>
        🕒 <?= 'à '.date('H:i') ?>
        </center>
    </body></html>-->