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
        <h1>  Ajouter un utilisateur</h1>
        <br/>
        <br/>
        <?php

            // pour tests et mise au point
            // var_dump($_POST);

            
            if ( isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['passwrd']) && !empty($_POST['passwrd'])&& isset($_POST['passwrd2']) && !empty($_POST['passwrd2']) ){
                
                // $id est transformé en int car c'est un entier dans la bdd
                // or il provient d'un echo de php donc c'est une chaîne de caractères
                // (remarque mj toutefois php ou mysqli à l'air permissif, 
                // car cela fonctionne aussi sans faire cette conversion )
                $id = intval($_POST["id"]);
                echo $id;

                //var_dump($row);
                    //echo $row['nom'];
                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $email = $_POST['email'];
                    $passwrd = $_POST['passwrd'];
                    $passwrd2 = $_POST['passwrd2'];
            }
            else{
                $id = intval($_POST["id"]);
                /* Pour debugg et mise au point
                echo $id."<br />";
                echo $_POST['prenom']."<br />";
                echo $_POST['nom']."<br />";
                echo $_POST['email']."<br />";
                echo $_POST['passwrd']."<br />";
                echo $_POST['passwrd2']."<br />";
                echo "<br />Un des champs n'est pas défini ou est vide"."\"<br />";
                */
                echo "<br />Un des champs n'est pas défini ou est vide"."\"<br />";
                $status == "HS";
            }
  
            

            $b_passwrd_modifie = false;
            // test le passwrd a t-il été modifié à la maj ?
            if ( $passwrd != $passwrd2){
                // si oui c'est qu'il a été modifié. d'ou cryptage de $passwrd
                // avant un nouveau test avec le $passwrd modifié puis crypté
                //  est-il egal crypté à celui qui est sauvegardé dans la bdd ?
                $passwrd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                // le $passwrd mis a jour et crypté est-il egal à celui enregistré dans la bdd ?
                if ( $passwrd != $passwrd2){
                    $b_passwrd_modifie = true;
                }
                // sinon au precedent test le passwrd dans le champ du formulaire $passwrd
                // récupéré ici et celui enregistré dans la bdd sont différents
                else{
                    $b_passwrd_modifie = true;
                    
                }
            }

            // ouverture de la connexion
            $connect = mysqli_connect("localhost", "mjdev", "&(44@5Xr!h3_baMa5fuX", "dwwm_mes_septembre");

            // Vérification de la connexion 
            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            /*****------------------------------------------------------------------------ 
            // première requete on vérifie si le nom et le prénom existe déjà
            ---------------------------------------------------------------------------******/
            $sql = "SELECT prenom, nom FROM user WHERE prenom='$prenom' AND nom='$nom' AND id<>'$id';";

            $res = mysqli_query($connect, $sql) or die (mysqli_error($connect));

            if ($res) {
                $row_cnt = mysqli_num_rows($res);
                echo "\$row_cnt =\"" . $row_cnt ."\"<br />";
                if ( $row_cnt > 0){
                    $status = "HS2";
                    echo "On passe ici $status = \"HS2\"" . $row_cnt ."\"<br />";
                }
                else{
                    // 2eme requete mise à jour de l'utilisateur
                    $sql="UPDATE user SET nom='$nom', prenom='$prenom', email='$email', passwrd='$passwrd' WHERE id='$id'";

                    $res2 = mysqli_query($connect, $sql) or die (mysqli_error($connect));
        
                    if ($res2) {
        
                        // liberation du jeu de resultats
                        //mysqli_close($res);  
                        $status = "OK";
                    }
                    else{
                        // pour debbug et mise au point
                        //echo " Erreur lors de l'insertion du nouvel utilisateur <br />";
                        $status = "HS";
                    }
        
                    /* 3eme requete non necessaire ici. utile surtout lors de l'insertion 
                    // dans le insert_user.php pour recuperer l'id du nouvel utilisateur qu'on a inséré
                    if ( $status == "OK"){
                        $sql = " SELECT * FROM user WHERE prenom='$prenom' AND nom='$nom' AND email='$email' AND passwrd='$passwrd'";
                        $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));
        
                        if ($result){
                            while($row = mysqli_fetch_assoc($result)){
                                // var_dump($row);
                                // echo $row['nom'];
                                $id = $row['id'];
                                $prenom = $row['prenom'];
                                $nom = $row['nom'];
                                $email = $row['email'];
                                $passwrd = $row['passwrd'];
                               
                                echo $id;
                                $status = "OK";
                            }
                        }
                    }
                    */
                }
            }
            
            if ( $status == "HS" || $status == "HS2" ){
                header("location:form_update_user.php?id=".$id."prenom=".$prenom."&nom=".$nom."&email=".$email."&passwrd=".$passwd."&status=".$status);
                die;
            }

            // je renvoie à index.php 3 parametres, dont ici le nom de la page d'ou l'on sort
            // mais sans le ".php" car cela pose problème
            $page = "update_user";

            // On renvoie sur la page index.php avec aussi la page precedente, le status
            //  et l'id concerné par l'insertion (add_user.php)
            //  ou la maj (update_user.php) ou le delete (delete_user.php)
            header("location:index.php?id=".$id."&status=".$status."&page=".$page);
            die;

            // liberation du jeu de resultats
            mysqli_close($result);  

            // liberation de la connection        
            mysqli_close($connect);

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
