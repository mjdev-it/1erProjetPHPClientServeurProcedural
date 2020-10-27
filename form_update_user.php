<?pĥp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" />

        <title>Modifier un utilisateur</title>
    </head>
    <body>
        <h1>  Modifier un utilisateur</h1>
        <br/>
        <br/>
        <?php
            // pour tests et mise au point
            //var_dump($_GET);

            // On initialise $status 
            // On aurai pu le faire dans le else, s'il n'est pas renseigné 
            // ou rempli dans la superglobale $_GET
            // mais c'est plus rapide de l'écrire ici
            $status = "";

            // On commence par tester si $status existe et est defini
            // c'est le cas si l'on revient de update_user.php
            // car l'insertion en bdd s'est mal passée
            if (  isset($_GET['status']) && !empty($_GET['status']) ){
                // simplification du code
                $status = $_GET['status'];
            }
             
            switch ($status){
                case "HS":
                    $classofp = "p-mj-hs";
                    $mes = "***** Echec lors de la mise à jour. Car un ou des champs est ou sont manquant(s).";
                    break;
                case "HS2":
                    $classofp = "p-mj-hs2";
                    $mes = "***** Echec lors de la mise à jour. Un  utilisateur ayant même prénom et même nom est déjà présent dans la base.<br />";
                    $mes = $mes . "<br /><br />Veuillez contacter le webmaster : mj5sur5@gmail.com";
                    break;
                case "OK":
                    $classofp = "p-mj-ok";
                    $mes = " Succes lors du passage de parametre.";
                    break;
                default :
                    $classofp = "p-mj-hshs";
                    $mes = " Cas non prevu pour $status $status=\"" . $status . "\"";
                    // mais en fait qd on clique sur le nom, lien cliquable depuis le listing et index.php
                    // le status est = à "" donc ici on ne fait rien. 
                    // On traitera ce cas plus tard if ( $status == "" )
          
            }

            // Si $status est renseigné on affiche un message. Sinon non. 
            if ( $status != "" && $status != "OK" ){
                echo '<p class="' . $classofp . '"><br />' . $mes . '<br /><br /></p>';
            }
            
            //echo '<p class="' . $classofp . '"><br />' . $mes . '<br /><br /></p>';

            if ( isset($_GET['id']) && !empty($_GET['id']) ){
                $id = intval($_GET["id"]);
                echo $id;
            }
            else{
                echo "<br />\$_GET(\"id\") n'est pas defini ou est vide"."\"<br />";
                die;
            }
            // ouverture de la connexion
            $connect = mysqli_connect("localhost", "mjdev", "&(44@5Xr!h3_baMa5fuX", "dwwm_mes_septembre");

            // Vérification de la connexion 
            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            $sql = " SELECT * FROM user WHERE id =".$id;
            $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));

            if ($result){
                while($row = mysqli_fetch_assoc($result)){
                    //var_dump($row);
                    //echo $row['nom'];
                    $id = $row['id'];
                    $prenom = $row['prenom'];
                    $nom = $row['nom'];
                    $email = $row['email'];
                    $passwrd = $row['passwrd'];
                    $passwrd2 = $row['passwrd2'];
                    /*
                    $sql = mysqli_query($conn,"INSERT INTO user (not_encrypted_password,encrypted_password)VALUES('$not_encrypted_password','$encrypted_password')");
                    */
                    //echo $id;
                    // la requete sql a fonctionnée
                    // on dit que le status $status est "OK" 
                    $status = "OK";
                }
            }
            else{
                // la requete sql n'a rien trouvée
                // on dit que le status est"HS" (cad Hors-Service, ça n'a pas marché)
                $status = "HS";
                
            }

            // sauvegarde du mdp enregistré dans la bdd
            // qu'on va passer en "hidden" (en champs caché) 
            // via le formulaire au fichier update_user.php
            //$passwrd2 = $$passwrd;

        ?>
        <form action="update_user.php" method="post">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>" />
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>" />            
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" />            
            <label>Password</label>
            <input type="text" name="passwrd" class="form-control" value="<?php echo $passwrd; ?>" />
            <input type="hidden" name="passwrd2" class="form-control" value="<?php echo $passwrd2; ?>" />
           <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>" />
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