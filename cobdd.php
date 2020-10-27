<?php



$bdd = mysqli_connect("localhost:3307", "visio", "afpa", "phpvisio");



if (!$bdd) {

     echo "Erreur de connection " . mysqli_connect_errno();

     exit;

}

// et dans les fichiers php 
// require 'cobdd.php';


