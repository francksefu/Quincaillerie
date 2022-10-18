<?php
    session_start();
    if(isset($_GET['deconnexion']))
     { 
       if($_GET['deconnexion']==true)
           {  
              session_unset();
              header("location:connectEntreprise.php");
           }
        }
        else if($_SESSION['username'] !== ""){
            $user = $_SESSION['username'];
                    // afficher un message
             
?>
<!DOCTYPE >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css"/>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-grid.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-grid.min.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-reboot.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap-reboot.min.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css" media="screen" type="text/css" />
    <script src="bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.js"></script>
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    
    <style>
        html{
            background: url(imageVend.png);
            background-size: cover;
            background-repeat: no-repeat;
        }
   
   
        #nouvelPP  {
            display: none;
        }
        #modify {
             display: none;
        }
        #delet { 
            display: none;
        }
        #voirTextArea{
            display: none;
        }
        button{
            margin: 10px;
        }
    </style>
   
</head>
<body style="background: url(albin.JPG) no-repeat center fixed; background-size:cover">
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle d' entreprise</h1>
</div>

<div class="topnav">
    <a href="accueilEntreprise.php">Accueil</a>
    <a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php" class="active" style="color:black;">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="contratQ.php" >Contrat</a>
</div>

<div class="row">
    <div class="column1">
    <?php // cacher et montre les formulaires d insertion et modification avec la partie de 25%?>
        <ul>
        <li><button type="button" class="btn btn-primary"
            onclick="document.getElementById('nouvelPP').style.display='block';
            document.getElementById('modify').style.display='none';document.getElementById('delet').style.display='none';">Nouveau</button></li>
            <li><button type="button" class="btn btn-primary"
            onclick="document.getElementById('modify').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('delet').style.display='none';"> Modifier </button></li>
            <li><button type="button" class="btn btn-primary" onclick="document.getElementById('delet').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('modify').style.display='none';"> Supprimer </button></li>
            
        </ul>
        <p id="region">
            <?php 
            include 'connexion.php';

            if($_SERVER["REQUEST_POST"]=="POST"){
                    $idClient=verifions($_POST["TypeD"]);
                    $valeurDette=verifions($_POST["ValeurDette"]);
                    $montantPaye=verifions($_POST["MontantPaye"]);
                    $Reste=verifions($_POST["ValeurDette"])-verifions($_POST["MontantPaye"]);
                    $il_pris_quoi=verifions($_POST["il_pris_quoi"]);
                    $datesD=verifions($_POST["DatesD"]);
                    $sorte=verifions($_POST["Sorte"]);
                    $identifiant=verifions($_POST["Identifiant"]);
                    $datesRNew=verifions($_POST["DatesRNew"]);
                    
            }    
                function verifions($donne){
                    
                    $donne=htmlspecialchars($donne);
    
                    return $donne;
                }
                if(verifions($_POST["Sorte"])==1){
                    $ResteV=(verifions($_POST["ValeurDette"])-verifions($_POST["MontantPaye"]));
                $reqSql=("INSERT INTO `DetteEntreprise`(`TypeD`, ValeurDette, `MontantPaye`, `Reste`,`il_pris_quoi`,`DatesD`) 
                values('".verifions($_POST["TypeD"])."','".verifions($_POST["ValeurDette"])."','".verifions($_POST["MontantPaye"])."','".(verifions($_POST["ValeurDette"])-verifions($_POST["MontantPaye"]))."','".verifions($_POST["il_pris_quoi"])."','".verifions($_POST["DatesD"])."')");
                if(mysqli_query($db, $reqSql)){
                echo"<span id='succes'> enregistrement fait</span>";
                }else{
                echo"error : ".mysqli_error($db)."ligne155";
                }
            }
                $typeA=" ";$typeN=" ";$valeurDetteA=0;$valeurDetteN=0;$montantPayeA=0;$montantPayeN=0;$resteA=0;$resteN=0;$il_pris_quoiA=" ";$il_pris_quoiN=" ";$datesDA=" ";$datesDN=" ";$datesRNewA=" ";$datesRNewN=" ";
                $updN=" ";$updPA=" ";$updPV=" ";$updQ=" ";$insertionSortie=" ";

                if(verifions($_POST["Sorte"])==2){
                    $reqSql= ("SELECT TypeD,ValeurDette,MontantPaye,Reste,il_pris_quoi,DatesD,DatesRNew FROM DetteEntreprise  WHERE idDette =".verifions($_POST["Identifiant"])."");
                        $result= mysqli_query($db, $reqSql);
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                $typeDA= $row["TypeD"];
                                $valeurDetteA= $row["ValeurDette"];
                                $montantPayeA= $row["MontantPaye"];
                                $resteA= $row["Reste"];
                                $il_pris_quoiA= $row["il_pris_quoi"];
                                $datesDA= $row["DatesD"];
                                $datesRNewA=$row["DatesRNew"];
                            }
                        }else{echo "Une erreur s est produite ";}
                        if(empty(verifions($_POST["TypeD"]))){
                            $typeDN=$typeDA;
                        }else{$typeDN=verifions($_POST["TypeD"]);}
                        if(empty(verifions($_POST["ValeurDette"]))){
                            $valeurDetteN=$valeurDetteA;
                        }else{$valeurDetteN=verifions($_POST["ValeurDette"]);}
                        if(empty(verifions($_POST["MontantPaye"]))){
                            $montantPayeN=$montantPayeA;
                        }else{$montantPayeN=verifions($_POST["MontantPaye"]);}
                        if(empty(verifions($_POST["ValeurDette"])) && empty(verifions($_POST["MontantPaye"]))){
                            $resteN=$valeurDetteN-$montantPayeN;
                        }else{$resteN=$valeurDetteN-$montantPayeN;}
                        if(empty(verifions($_POST["il_pris_quoi"]))){
                            $il_pris_quoiN=$il_pris_quoiA;
                        }else{$il_pris_quoiN=verifions($_POST["il_pris_quoi"]);}
                        if(empty(verifions($_POST["DatesD"]))){
                            $datesDN=$datesDA;
                        }else{$datesDN=verifions($_POST["DatesD"]);}
                        if(empty(verifions($_POST["DatesRNew"]))){
                            $datesRNewN=$datesRNewA;
                        }else{$datesRNewN=verifions($_POST["DatesRNew"]);}
                        if(empty($_POST["DatesRNew"])){
                            echo"";
                        }else{
                            $updH= ("UPDATE `DetteEntreprise` SET `MontantPayeHold` = '".$montantPayeA."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                            if(mysqli_query($db,$updH)){echo"";}else{
                                echo"Error : ".mysqli_error($db);
                            }
                        }
                        if(empty($_POST["DatesRNew"])){
                            echo"";
                        }else{
                            $reqSql= ("SELECT  MontantPaye, MontantPayeHold,il_pris_quoi,DatesD,DatesRNew  FROM DetteEntreprise WHERE DatesD='".$_POST["DatesRNew"]."'");
                            $result= mysqli_query($db, $reqSql);$il_pris_quoiI=" ";$datesDI=" ";$datesRNewI=" ";
                            if(mysqli_num_rows($result)>0){
                                
                                    while($row= mysqli_fetch_assoc($result)){
                                        $insertionSortie = $row["MontantPaye"] - $row["MontantPayeHold"];
                                        $il_pris_quoiI = $row["il_pris_quoi"];
                                        $datesDI= $row["DatesD"];
                                        $datesRNewI = $row["DatesRNew"];
                                    }
                                    $reqSql=("INSERT INTO `Sortie`(`TypeD`, `Montant`,`il_pris_quoi`,`DatesD`) 
                                    values('PaiementDetteEnt','".$insertionSortie."','".$il_pris_quoiI."','".$datesRNewI."')");
                                    if(mysqli_query($db, $reqSql)){
                                         echo"<span id='succes'> enregistrement fait</span>";
                                    }else{
                                    echo"error : ".mysqli_error($db)."ligne155";
                                    }
                                
                            }else{echo "Une erreur s est produite ";}

                            
                        }
                        
                        


                        $updN= ("UPDATE `DetteEntreprise` SET `TypeD` = '".$typeDN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                       $updPA= ("UPDATE `DetteEntreprise` SET `ValeurDette` = '".$valeurDetteN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                        $updPV= ("UPDATE `DetteEntreprise` SET `MontantPaye` = '".$montantPayeN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                        $updQ= ("UPDATE `DetteEntreprise` SET `Reste` = '".$resteN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                        $updil= ("UPDATE `DetteEntreprise` SET `il_pris_quoi` = '".$il_pris_quoiN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                        $updDa= ("UPDATE `DetteEntreprise` SET `DatesD` = '".$datesDN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");
                        $updDaH= ("UPDATE `DetteEntreprise` SET `DatesRNew` = '".$datesRNewN."' WHERE `DetteEntreprise`.`idDette` = '".verifions($_POST["Identifiant"])."'");

                        if(mysqli_query($db,$updN)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updPA)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updPV)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updQ)){echo"<span>Mis a jour fait</span>";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updil)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updDa)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updDaH)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        echo "voici :".$typeDN." vD".$valeurDetteN." mP".$montantPayeN." q".$datesDN;
                }
                if(verifions($_POST["Sorte"])==3){
                    $del= ("DELETE FROM DetteEntreprise WHERE idDette=".verifions($_POST["Identifiant"])."");
                    if(mysqli_query($db,$del)){echo"<span> Suppression fait</span>";}else{
                        echo"Error : ".mysqli_error($db);
                    }
                }
                
                
            ?>  
            </p>
    </div>
    <div class="column2">
        
        <div class="enveloppe2">
            
                <form method= "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <p id="nouvelPP" >
                        <br><label for="TypeD">Type de Dette</label><br>
                        <select id="TypeD" name="TypeD">
                            <option value="Argent">Argent</option>
                            <option value="Materiel">Materiel</option>
                        </select>
                       
                    <br> <label for="ValeurDetten" > Valeur de la Dette </label><br>
                        <input type="float" id="ValeurDetten" name="ValeurDette" placeholder="Valeur de la Dette" required>FC
                        <br><label for="MontantPayen" > Montant deja payE</label><br>
                        <input type="float" id="MontantPayen" name="MontantPaye" placeholder="Montant deja payE"  required>FC
                        <br><label for="il_pris_quoi">Motif</label><br>
                        <textarea id="il_pris_quoi" name="il_pris_quoi" rows="5" cols="40">motif:</textarea>
                        <br><label for="DatesD">Date</label><br>
                        <input type="date" id="DatesD" name="DatesD"> 
                        <input type="hidden"  name="Sorte" value="1">
                        <input type="submit" name="submit" value="submit" >
                </p>
                </form>
            
            

            <div id="modify" class="hidform">
                <form method= "POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    Identifiant <input type="number" name="Identifiant" placeholder="Identifiant"><br>
                    <br><label for="Type">Type</label><br>
                    <select id="Type"  name="TypeD"  >
                        <option value="Argent">Argent</option>
                        <option value="Materiel">Materiel</option>
                    </select>
                    <br> <label for="ValeurDette" > Valeur de la Dette </label><br>
                        <input type="float" id="ValeurDette" name="ValeurDette" placeholder="Valeur de la Dette" >FC
                        <br><label for="MontantPaye" > Montant deja payE</label><br>
                        <input type="float" id="MontantPaye" name="MontantPaye" placeholder="Montant deja payE"  >FC
                        <br><label for="il_pris_quoi">Il a pris quois ??</label><br>
                        <textarea id="il_pris_quoi" name="il_pris_quoi" rows="5" cols="40"></textarea>
                        <br><label for="DatesD">Date</label><br>
                        <input type="date" id="DatesD" name="DatesD">
                        <br><label for="DatesR">Date de remboursement</label><br>
                        <input type="date" id="DatesR" name="DatesRNew">  
                
                    <input type="hidden" name="Sorte" value="2">
                    <input type="submit" value="soumettre">
                </form>
            </div>

            <div id="delet" class="hidform">
                <form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    
                Identifiant <input type="number" id="Identifiant" name="Identifiant" placeholder="identifiant" required>
                    <input type="hidden" name="Sorte" value="3">
                    <input type="submit" value="Supprimer">
                </form>
            </div>
            <div id="voirTextarea">
                <div class="Moitie">
                    
                    <form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                            
                        Identifiant <input type="number" id="Identifiant" name="Identifiant" placeholder="identifiant" required>
                        <input type="hidden" name="Sorte" value="4">
                        <input type="submit" value="Voir">
                        
                    </form>
                </div>
                <div class="Moitie" stype="overflow: auto;">
                    <?php 
                         
                        include 'connexion.php';
            
                        if($_SERVER["REQUEST_POST"]=="POST"){
                                
                                $sorte=verifionso($_POST["Sorte"]);
                                $identifiant=verifionso($_POST["Identifiant"]);
                                
                        }    
                        function verifionso($donne){
                                
                            $donne=htmlspecialchars($donne);
                
                            return $donne;
                        }
                        if(verifions($_POST["Sorte"])==4){
                            $reqSql= ("SELECT idDette,il_pris_quoi FROM DetteEntreprise ");
                            $result= mysqli_query($db, $reqSql);
                            if(mysqli_num_rows($result)>0){
                            echo"<table id='Customers'><tr><th>identifiant</th><th>Motif </th></tr>";
                            while($row= mysqli_fetch_assoc($result)){
                                echo"<tr><td>".$row["idDette"]."</td><td>".$row["il_pris_quoi"]."</td>></tr>"; 
                            }
                            echo"</table>";
                            }else{echo "Une erreur s est produite ";}
                        }
                    ?>
                </div>       
            </div>
        </div>
        <div class="tableau" style="background-color:#ddd;">
            <?php
                include 'connexion.php';   
                $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise order by DatesD desc limit 500 ");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                    while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                    }
                    echo"</table>";
                }else{echo "Une erreur s est produite ";}

            ?> 
            
        
        </div>
            
        
    </div>
    
        
</div>


<div class="footer">
        <h2>&COPY; copyrigth </h2>
        <p>franck sefu +243 973359746</p>
</div>
<?php } ?>
 
</body>
</html>