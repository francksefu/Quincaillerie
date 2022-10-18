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
        body{
            background: url(albin.JPG);
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
<body >
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle d entreprise</h1>
</div>

<div class="topnav">
    <a href="">Accueil</a>
    <a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php" >Bonus et Perte</a>
    <a href="sortieQ.php" class="active">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    
    <a href="detteEntreprise.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
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
            document.getElementById('nouvelPP').style.display='none';document.getElementById('delet').style.display='none';"> Modifier Sortie</button></li>
            <li><button type="button" class="btn btn-primary" onclick="document.getElementById('delet').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('modify').style.display='none';"> Supprimer Sortie</button></li>
            
        </ul>
        <p id="region">
            <?php 
             include 'connexion.php';
            if($_SERVER["REQUEST_POST"]=="POST"){
                    $idClient=verifions($_POST["TypeD"]);
                    $valeurDette=verifions($_POST["Montant"]);
                    $il_pris_quoi=verifions($_POST["il_pris_quoi"]);
                    $datesD=verifions($_POST["DatesD"]);
                    $sorte=verifions($_POST["Sorte"]);
                    $identifiant=verifions($_POST["Identifiant"]);
                    
            }    
                function verifions($donne){
                    
                    $donne=htmlspecialchars($donne);
    
                    return $donne;
                }
            if(verifions($_POST["Sorte"])==1){
                 
                $reqSql=("INSERT INTO `Sortie`(`TypeD`, `Montant`,`il_pris_quoi`,`DatesD`) 
                values('".verifions($_POST["TypeD"])."','".verifions($_POST["Montant"])."','".verifions($_POST["il_pris_quoi"])."','".verifions($_POST["DatesD"])."')");
                if(mysqli_query($db, $reqSql)){
                echo"<span id='succes'> enregistrement fait</span>";
                }else{
                echo"error : ".mysqli_error($db)."ligne155";
                }
                
            }
                $typeDA=" ";$typeDN=" ";$montantA=0;$montantN=0;$il_pris_quoiA=" ";$il_pris_quoiN=" ";$datesDA=" ";$datesDN=" ";$datesPA=" ";$datesPN=" ";
                $updN=" ";$updPA=" ";$updPV=" ";$updQ=" ";
                if(verifions($_POST["Sorte"])==2){
                    $reqSql= ("SELECT TypeD, Montant, il_pris_quoi, DatesD FROM Sortie  WHERE idSortie =".verifions($_POST["Identifiant"])."");
                        $result= mysqli_query($db, $reqSql);
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                $typeDA= $row["TypeD"];          
                                $montantA= $row["Montant"];
                                
                                $il_pris_quoiA= $row["il_pris_quoi"];
                                $datesDA= $row["DatesD"];
                               
                            }
                        }else{echo "Une erreur s est produite ";}
                        if(empty(verifions($_POST["TypeD"]))){
                            $typeDN=$typeDA;
                        }else{$typeDN=verifions($_POST["TypeD"]);}
                        
                        if(empty(verifions($_POST["Montant"]))){
                            $montantN=$montantA;
                        }else{$montantN=verifions($_POST["Montant"]);}
                        
                        if(empty(verifions($_POST["il_pris_quoi"]))){
                            $il_pris_quoiN=$il_pris_quoiA;
                        }else{$il_pris_quoiN=verifions($_POST["il_pris_quoi"]);}
                        if(empty(verifions($_POST["DatesD"]))){
                            $datesDN=$datesDA;
                        }else{$datesDN=verifions($_POST["DatesD"]);}
                        
                            
                            
                        

                        $updN= ("UPDATE `Sortie` SET `TypeD` = '".$typeDN."' WHERE `Sortie`.`idSortie` = ".verifions($_POST["Identifiant"])."");
                       $updPA= ("UPDATE `Sortie` SET `Montant` = '".$montantN."' WHERE `Sortie`.`idSortie` = ".verifions($_POST["Identifiant"])."");
                        $updil= ("UPDATE `Sortie` SET `il_pris_quoi` = '".$il_pris_quoiN."' WHERE `Sortie`.`idSortie` = ".verifions($_POST["Identifiant"])."");
                        $updDa= ("UPDATE `Sortie` SET `DatesD` = '".$datesDN."' WHERE `Sortie`.`idSortie` = ".verifions($_POST["Identifiant"])."");
                        

                        if(mysqli_query($db,$updN)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updPA)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        
                        
                        if(mysqli_query($db,$updil)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updDa)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        
                        
                        
                }
                if(verifions($_POST["Sorte"])==3){
                    $del= ("DELETE FROM Sortie WHERE idSortie=".verifions($_POST["Identifiant"])."");
                    if(mysqli_query($db,$del)){echo"<span> Suppression fait</span>";}else{
                        echo"Error : ".mysqli_error($db);
                    }
                }

                function datalist(){
                    include 'connexion.php';
                    $sql = ("SELECT*FROM Sortie");
                    $result = mysqli_query($db, $sql);
                            
                    if(mysqli_num_rows($result)>0){
                                        
                        while($row= mysqli_fetch_assoc($result)){
                            echo"<option value='".$row["idSortie"].":type=:".$row["TypeD"].": montant=:".$row["Montant"].": USD date = :".$row["DatesD"]."'>".$row["DatesD"]." : ".$row["Montant"]." USD</option>"; 
                        }
                               
                   }else{echo "Une erreur s est produite ";}  
            
                }
                
                
            ?>  
            </p>
    </div>
    <div class="column2">
        
        <div class="enveloppe2">
            
                <form method= "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <div id="nouvelPP" >
                        <br><label for="TypeD">Type de Sortie</label><br>
                        <select id="TypeD" name="TypeD">
                            <option value="Aucun">Aucun</option>
                            <option value="Dette">Dette</option>
                            <option value="Charge">Charge</option>
                            <option value="Depense">Depense</option>
                        </select>
                        
                    <br> <label for="Montant" > Montant </label><br>
                        <input type="float" id="Montant" name="Montant" placeholder="mettez ici le montant sortie" required> USD
                        
                        <br><label for="il_pris_quoi">Motif</label><br>
                        <textarea id="il_pris_quoi" name="il_pris_quoi" rows="5" cols="40">motif:</textarea>
                        <br><label for="DatesD">Date</label><br>
                        <input type="date" id="DatesD" name="DatesD">
                        <option value="Depense">Depense</option>
                        <input type="hidden"  name="Sorte" value="1">
                        <input type="submit" name="submit" value="submit" >
            </div>
                </form>
            
            

            <div id="modify" class="hidform">
                <form method= "POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    Identifiant <input type="text" list="identif" id="identifM" onchange="verificatM()" placeholder="Identifiant" required><br>
                    <datalist id="identif">
                        <?php 
                            datalist();

                        ?>
                    </datalist>
              
                    <input type="hidden" id="cache" name="Identifiant" >
                    <br><label for="TypeD">Type</label><br>
                    <select id="TypeM"  name="TypeD" >
                        <option value="Aucun">Aucun</option>
                        <option value="Dette">Dette</option>
                        <option value="Charge">Charge</option>
                        <option value="Depense">Depense</option>
                    </select>
                    <br> <label for="Montant" > Montant </label><br>
                        <input type="float" id="MontantM" name="Montant" placeholder="mettez ici le montant sortie" > USD
                        
                        <br><label for="il_pris_quoi">Motif</label><br>
                        <textarea id="il_pris_quoiM" name="il_pris_quoi" rows="5" cols="40"></textarea>
                        <br><label for="DatesD">Date</label><br>
                        <input type="date" id="DatesM" name="DatesD">
                        
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
            
        </div>
        <div class="tableau" style="background-color:#ddd;">
            <?php
                include 'connexion.php';  
                $reqSql= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie order by DatesD desc limit 500");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
                    while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                    }
                    echo"</table>";
                }else{echo "Pas des données enregistré ";}

            ?> 
            
        
        </div>
            
        
    </div>
    
        
</div>


<div class="footer">
        <h2>&COPY; copyrigth</h2>
        <p>franck sefu +243 973359746</p>
</div>

<script>
   // document.getElementById("NomM").addEventListener("mouseo", verificatM);

    function verificatM(){
        if(document.getElementById("identifM").value != ""){
            let cont = document.getElementById("identifM").value;
            let tableau = cont.split(":");
            
            let typeD = tableau[2];
            let montant = tableau[4]*1;
            let datesD = tableau[6];
            let identi = tableau[0]*1;

            document.getElementById("TypeM").value = typeD;
            document.getElementById("MontantM").value = montant;
            document.getElementById("DatesM").value = datesD;
            
            document.getElementById("cache").value = identi;
        }
    }
    function verificatS(){
        if(document.getElementById("IdentifiantS").value != ""){
            let cont = document.getElementById("IdentifiantS").value;
            let tableau = cont.split(":");
            let identifiant = tableau[0]*1;
            document.getElementById("cacheS").value = identifiant;
        }
    }
</script>
 
</body>
</html>
