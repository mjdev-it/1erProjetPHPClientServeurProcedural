<?pĥp

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" />

        <title>Listing des utilisateurs</title>
    </head>
    <body>

        <div class="container-fluid">
            <div class="px-4 py-2">
                <br/>
                <br />
                <br/>
                <br />
                <h1>  Listing des utilisateurs</h1>
                <br/>
                <br />
                <?php

                    // pour tests et mise au point
                    //var_dump($_GET);
                    $status = ""; 
                    // Si les champs existent on dit que le $status = "OKHS"
                    // ça peut changer plus tard si en plus les champs sont non vides
                    // sinon ça ne change pas
                    if ( isset($_GET['id']) && isset($_GET['status']) && isset($_GET['page']) ) {
                        $status = "OKHS";
                    }
                    // On teste si des valeurs ont été envoyées à index.php pat la méthode get
                    // avec passage de parametres dans l'url
                    // Ici pas de soucis pour la securité, c'est juste pour afficher un message OK ou pas
                    // suite à ajout, modification ou suppression d'un utilisateur
                    if ( isset($_GET['id']) && !empty($_GET['id']) 
                    && isset($_GET['status']) && !empty($_GET['status']) 
                    && isset($_GET['page']) && !empty($_GET['page'])){
                        
                        $id = intval($_GET["id"]);
                        $status = $_GET['status'];
                        $page = $_GET['page'];

                        /*
                        echo "<br />" ."id = " .$id;
                        echo "<br />" ."status =" .$status;
                        echo "<br />" ." page = " .$page;
                        */
                        $deb_mes = "";
                        $mil_mes = " avec l'id : " . $id;
                        $fin_mes = "<br /> lors de la sortie de la page : " . $page. ".php" ;
                        switch ($status) {
                            case "HS":
                                $deb_mes = "***** Echec ";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            break;
                            case "OK":
                                $deb_mes = "Bravo Succes ";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            break;
                            case "HS2":
                                $mes = "Un  utilisateur ayant même prénom et même nom est déjà présent dans la base.<br />";
                                $mes = $mes . "<br />Veuillez contacter le webmaster : mj5sur5@gmail.com";
                                break;
                            default:
                                $deb_mes = "***** Attention ***** ". $status 
                                . "= cas non prévu au programme. Faites un peu attention mj !";
                                //$deb_mes = $deb_mes . "Vous avez status qui est egal a : \"" . $status ."\"";
                                $mes =  $deb_mes . $mil_mes . $fin_mes ;
                            }                        

                        
                    }
                    else{
                        //echo "<br /> Erreur \$_GET(\"id\") et/ou \$_GET(\"page\") et/ou \$_GET(\"status\") n'est pas defini ou est vide"."\"<br />";
                        //echo "<br />" . "mais ceci peut se passer, si vous ouvrer cette page sans passer de paramètres ";
                        $mes = "On a lancé cette page index.php sans y avoir passé de parametres.";
                        $mes = $mes . " Cela provient du fait qu'on n'y vient pas depuis l'une des pages insert_user.php ou delete_user.php ou update_user.php";
                    }

                    if ( $status == "OK" || $status == ""){
                        echo '<p class="p-mj-ok"><br />' . $mes . '<br /><br /></p>';
                    }
                    elseif ( $status == "HS"){
                        echo '<p class="p-mj-hs"><br />' . $mes . '<br /><br /></p>';
                    }
                    else{
                        echo '<p class="p-mj-hs2"><br />' . $mes . '<br /><br /></p>';
                    }
                    echo "<br /><br /><br />";
                ?>
                <input id="mes" type="hidden" value="<?php echo $mes; ?>" />
                               
                <?php
                    echo '<div id="modal-mj" class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <p>Modal body text goes here.</p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>';

                    // ouverture de la connexion
                    $connect = mysqli_connect("localhost", "mjdev", "&(44@5Xr!h3_baMa5fuX", "dwwm_mes_septembre");

                    /* Vérification de la connexion */
                    if (mysqli_connect_errno()) {
                        printf("Échec de la connexion : %s\n", mysqli_connect_error());
                        exit();
                    }
                    
                    //echo '<h1>Listing des utilisateurs</h1>'; et selection dans la base
                    $sql = "SELECT * FROM user ORDER BY id;";

                    $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));

                    if ($result) {
                        // pour test
                        //printf("Select a retourné %d lignes.\n", $result->num_rows);

                        $status="OK";
                        echo '<table class="table-class table table-bordered table-striped">';
                        
                        echo '<thead class="thead-class">
                                <tr>
                                    <th>Id</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Suppression ?</th>
                                </tr>
                            </thead>
                        <tbody>';
                        
                        

                        while($row = mysqli_fetch_assoc($result)){
                            //var_dump($row);
                            //echo $row['nom'];
                            echo '<tr><td>' . $row['id'].'</td><td>'. $row['prenom'] . '</td><td>'.'<a href='.'"form_update_user.php?id='.$row['id'].'&status='.$status.'">'.$row['nom']. '</a></td><td>'. $row['email'] . '</td><td>'. $row['passwrd'] . '</td><td><a href='.'"delete_user.php?id='.$row['id'].'" class='.'"delete"><input type="button" class="btn-add btn btn-danger" value="Supprimer"\></a></td></tr>';
                        }
                        echo '</tbody></table>';
                        //echo '</table>';
                        echo '<a href='.'"add_user.php" class='.'"ajout'.'"><input type="button" class="btn-add btn btn-primary" value="Ajouter"\>';

                        // lancement d'ube alert ds le script php ms avec un echo
                        // le alert contient la chaine $mes constitué des 3 variables reçues en parametre
                        // echo "<script type='text/javascript'>alert('".$mes."');</script>";

                        // liberation du jeu de resultats
                        //mysqli_close($result); 

                    }

                    

                    // liberation de la connexion
                    mysqli_close($connect); 
                ?>
                
          </div>
        </div>
        <!-- les icones de fontawesome -->
        <script src="https://kit.fontawesome.com/4ec0c58701.js" crossorigin="anonymous"></script>       

                  <!-- bootstrap et jquery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script type="text/javascript" src="scripts.js"></script>

    </body>
</html>
<?php

?>