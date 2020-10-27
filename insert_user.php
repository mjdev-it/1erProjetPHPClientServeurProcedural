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
        
        <?php
            echo "Hello";
        ?>
        <br />
        <?php

            // pour tests et mise au point
            // var_dump($_POST);

            $b_tsleschampsremplis = true;

            $prenom = "";
            $nom = "";
            $email = "";
            $passwrd = "";
            $passwrd2 = "";
           
            // On fait exister la variable
            // on pourra donc l'envoyer à add_user.php
            // si l'operation d'insertion s'est mal passée
            $status = "HS";

            if ( isset($_POST['prenom']) && !empty($_POST['prenom']) ){
                $prenom = $_POST['prenom'];
            }
            else{
                $b_tsleschampsremplis = false;
            }
            if ( isset($_POST['nom']) && !empty($_POST['nom']) ){
                $nom = $_POST['nom'];
            }
            else{
                $b_tsleschampsremplis = false;
            }
            if ( isset($_POST['email']) && !empty($_POST['email']) ){
                $email = $_POST['email'];
            }
            else{
                $b_tsleschampsremplis = false;
            }
            if ( isset($_POST['passwrd']) && !empty($_POST['passwrd']) ){
                $passwrd = $_POST['passwrd'];
            }
            else{
                $b_tsleschampsremplis = false;
            }

            // cas special pour passwrd2 est dans un champs caché
            // on considere qu'il est tjrs rempli (suite aux tests effecttués)
            if ( isset($_POST['passwrd2']) && !empty($_POST['passwrd2']) ){
                $passwrd2 = $_POST['passwrd2'];
            }

            if ( !$b_tsleschampsremplis ){
                // Si l'un des (ou les) champs prenom, nom, email et password sont non declarés
                // et s'ils sont null ou sont non renseigné 
                // (ou egal à 0 mais peu de chances ici pour les valeurs demandées)
                // alors on revient sur le formulaire en passsant les parametres déjà ecrits ds certains champs
                // et avec die on termine le script courant 
                header("location:add_user.php?prenom=".$prenom."&nom=".$nom."&email=".$email."&passwrd=".$passwrd."&passwrd=".$passwrd."&status=".$status);
                die;
            }
            
            /*
            echo "<br />la valeur de prenom est : ".$_POST['prenom'];
            echo "<br />la valeur de nom est : ".$_POST['nom'];
            echo "<br />la valeur de email est : ".$_POST['email'];
            echo "<br />la valeur de password est : ".$_POST['password'];
            */

            
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $passwrd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $passwrd2 = $passwrd;
            
            // ouverture de la connexion
            $connect = mysqli_connect("localhost", "mjdev", "&(44@5Xr!h3_baMa5fuX", "dwwm_mes_septembre");

            // Vérification de la connexion 
            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }
            
            // première requete on vérifie si le nom et le prénom existe déjà
            $sql = "SELECT id, prenom, nom FROM user WHERE prenom='$prenom' AND nom='$nom';";

            $res = mysqli_query($connect, $sql) or die (mysqli_error($connect));

            // On verifie s'il y a au moins un resultat On dit que ça ne va pas
            // qu'on ne peut pas insérer
            if ($res) {
                $row_cnt = mysqli_num_rows($res);
                echo "\$row_cnt =\"" . $row_cnt ."\"";
                if ( $row_cnt > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        // var_dump($row);
                        // echo $row['nom'];
                        $id = $row['id'];
                    }
                    $status = "HS2";
                }
                else{
                    // lancement 2eme requete on insert le nouvel utilisateur
                    $sql = "INSERT INTO user (id, prenom, nom, email, passwrd, passwrd2)  VALUES ('','$prenom','$nom','$email','$passwrd','$passwrd2');";
        
                    $res2 = mysqli_query($connect, $sql) or die (mysqli_error($connect));
        
                    if ($res2) {
        
                        //var_dump($res);
                        //echo $res;
                        //echo " Insertion Ok dans la table du nouvel utilisateur<br />";
        
                        // liberation du jeu de resultats
                        //mysqli_close($res);  
                        $status = "OK";
                    }
                    else{
                        echo " Erreur lors de l'insertion du nouvel utilisateur <br />";
                        $status = "HS";
                    }
        
                    if ( $status == "OK" ){
                        // lancement 3eme requete pour recuperer l'id du nouvel utilisateur
                        $sql = " SELECT * FROM user WHERE prenom='$prenom' AND nom='$nom' AND email='$email' AND passwrd='$passwrd'";
                        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
        
                        if ($result){
                            // on fait un while mais comme on teste avant l'insertion 
                            // si il y a déjà ds la bdd même nom et même prénom 
                            // que le nouvel utilisateur on ne peut avoir en théorie qu'un seul resultat
                            while($row = mysqli_fetch_assoc($result)){
                                // var_dump($row);
                                // echo $row['nom'];
                                $id = $row['id'];
                                $prenom = $row['prenom'];
                                $nom = $row['nom'];
                                $email = $row['email'];
                                $passwrd = $row['passwrd'];
                                /*
                                $sql = mysqli_query($conn,"INSERT INTO user (not_encrypted_password,encrypted_password)VALUES('$not_encrypted_password','$encrypted_password')");
                                */
                                echo $id;
                                $status = "OK";
                            }
                        }
                    }
                }
            }
            
            // liberation de la connection        
            mysqli_close($connect);
        
            $page = "insert_user";

            // On renvoie sur la page index.php avec aussi la page precedente, le status
            //  et l'id concerné par l'insertion (add_user.php) ou la maj (update_user.php)
            header("location:index.php?id=".$id."&status=".$status."&page=".$page);
            die;
            
        ?>
            
        <!-- les icones de fontawesome -->
        <script src="https://kit.fontawesome.com/4ec0c58701.js" crossorigin="anonymous"></script>
                  <!-- bootstrap et jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts/formulaire_JQuery.js"></script>

    </body>
</html>