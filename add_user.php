<?pĥp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" />

        <title>Ajouter un utilisateur</title>
    </head>
    <body>
        <h1>  Ajouter un utilisateur</h1>
        <br/>
        <br/>
        <?php
        
            // les 4 variables ci-dessous ont besoin d'etre declarees
            // car elles vont etre utilisées ici pour preremplir le formulaire.
            // C'est dans le cas ou l'une (ou plusieurs) d'entre elle est ou sont vide(s)
            // lors de la tentative d'envoi du formulaire à insert_user.php            $prenom = "";
            $prenom = "";
            $nom = "";
            $email = "";
            $passwrd = "";

            // si la variable $_GET['prenom'] est définie, non nulle
            // et non vide on va la réutiliser pour remplir 
            // à nouveau le champs du formulaire d'ajout utilisateur 
            if ( isset($_GET['prenom']) && !empty($_GET['prenom']) ){
                $prenom = $_GET['prenom'];
            }

            if ( isset($_GET['nom']) && !empty($_GET['nom']) ){
                $nom = $_GET['nom'];
            }

            if ( isset($_GET['email']) && !empty($_GET['email']) ){
                $email = $_GET['email'];
            }

            if ( isset($_GET['passwrd']) && !empty($_GET['passwrd']) ){
                $passwrd = $_GET['passwrd'];
            }
            
            // On initialise $status 
            // On aurai pu le faire aussi dans le else, ci-dessous s'il n'est pas renseigné 
            // ou rempli dans la superglobale $_GET
            $status = "";

            // On commence par tester si $status existe et est defini
            // c'est le cas si l'on revient de insert_user.php
            // car l'insertion en bdd s'est mal passée
            if (  isset($_GET['status']) && !empty($_GET['status']) ){
                // simplification du code
                $status = $_GET['status'];
            }
            
            switch ($status){
                case "HS":
                    $classofp = "p-mj-hs";
                    $mes = "***** Echec lors de l'insertion. Car un ou des champs est ou sont manquant(s).";
                    break;
                case "HS2":
                    $classofp = "p-mj-hs2";
                    $mes = "Un  utilisateur ayant même prénom et même nom est déjà présent dans la base.<br />";
                    $mes = $mes . "<br /><br />Veuillez contacter le webmaster : mj5sur5@gmail.com";
                    break;
                case "OK":
                    $classofp = "p-mj-ok";
                    $mes = " Succes lors du passage de parametre.";
                    break;
                default :
                    $classofp = "p-mj-hshs";
                    $mes = " Cas non prevu pour $status $status=\"" . $status . "\"";
                    // mais en fait qd on fait "Ajouter" depuis le listing et index.php
                    // le status est = à "" donc ici on ne fait rien. 
                    // On traitera ce cas plus tard if ( $status == "" )
          
            }
            // Si $status est renseigné on affiche un message. Sinon non. 
            if ( $status != "" ){
                echo '<p class="' . $classofp . '"><br />' . $mes . '<br /><br /></p>';
            }
        ?>
        <form action="insert_user.php" method="post">
             <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>" />
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>" />            
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" />            
            <label>Password</label>
            <input type="text" name="passwrd" class="form-control" value="<?php echo $passwrd; ?>" />
            <a href="index.php" class="btn btn-primary">Retour liste</a>
            <input type="submit" class="btn btn-success" value="Valider" />
        </form>
                  <!-- les icones de fontawesome -->
        <script src="https://kit.fontawesome.com/4ec0c58701.js" crossorigin="anonymous"></script>
                  <!-- bootstrap et jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts/formulaire_JQuery.js"></script>

    </body>
</html>
<?php

?>