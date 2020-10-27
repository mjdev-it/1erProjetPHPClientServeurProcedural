<?pĥp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" />

        <title>Supprimer un utilisateur</title>
    </head>
    <body>
        <h1>  Supprimer un utilisateur</h1>
        <br/>
        <br />
        <?php

            // pour tests et mise au point
            // var_dump($_GET);

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

            $sql = " DELETE FROM user WHERE id =".$id;
            $res = mysqli_query($connect, $sql) or die (mysqli_error($connect));

            if ($res) {

                // pour debugg 
                var_dump($res);
                //echo $res;
                //  foreach ($res as $key => $value){
                echo " Suppression Ok dans la table de l'utilisateur <br />";

                //echo " Suppression Ok dans la table de l'utilisateur d'id".$_GET['id'] ."<br />";

                // On renvoie sur la page index.php
                //header("location:index.php");
                //die;

                // liberation du jeu de resultats
                //mysqli_close($res);  
                $status = "OK";
            }
            else{
                // pour debugg 
                var_dump($res);

                echo " Erreur lors de la suppression de l'utilisateur <br />";
                $status = "HS";
            }

            // liberation du jeu de resultats
            mysqli_close($res);  

            // liberation de la connection        
            mysqli_close($connect);

            $page = "delete_user";

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
<?php

?>