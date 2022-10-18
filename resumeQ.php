<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>franckApp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
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
        #region{
            display: none;
        }
        table{
            width : 100%;
        }
        button{
            display: block;
            color: #000;
            padding: 14px 8px;
            text-decoration: none;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            border-radius: 20px;
            margin: 10px;

        }
        th{
            background-color: yellowgreen;
        }
        button:hover{
            background-color: #555;
            color: white;
            border-radius: 20px;
        }
        td{
            text-align: center;
        }
        
    </style>

</head>
<body >
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
    </div>

<div class="topnav">
<a href="accueilEntreprise.php">Accueil</a>
    <a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" class="active">Resume</a>
    <a href="contratQ.php" >Contrat</a>
</div>

<div class="row">
    <div class="column1">
    <?php // cacher et montre les formulaires d insertion et modification avec la partie de 25%?>
        
            <button type="button" 
            onclick="document.getElementById('nouvelPP').style.display='block';
            document.getElementById('modify').style.display='none';document.getElementById('delet').style.display='none';">Nouveau</button>
            <button type="button" 
            onclick="document.getElementById('modify').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('delet').style.display='none';"> Modifier Produit</button>
            <button type="button" onclick="document.getElementById('delet').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('modify').style.display='none';"> Supprimer Produit</button>
            <button><a href="approvisionnementQ.php">Approvisionnement</a></button>
            
        
        <p id="region">
        
            
            <?php 
            include 'connexion.php';
            $nom=$prixAcht=$prixVente=$quantite="";
            if($_SERVER["REQUEST_POST"]=="POST"){
                    
                    $datesResume = htmlspecialchars($_POST["DatesResume"]);
                    $dates2Resume = htmlspecialchars($_POST["Dates2Resume"]);
                    
                    $sorte=verifions($_POST["Sorte"]);
                    $identifiant=verifions($_POST["Identifiant"]);
                    
            }    
                function verifions($donne){
                   
                    $donne=htmlspecialchars($donne);
    
                    return $donne;
                }
                if(verifions($_POST["Sorte"])==1){
                $reqSql = ("INSERT INTO `Resume`(DatesResume, Dates2Resume) values('".htmlspecialchars($_POST["DatesResume"])."','".htmlspecialchars($_POST["Dates2Resume"])."')");
                if(mysqli_query($db, $reqSql)){
                echo"<span id='succes'> enregistrement fait</span>";
                }else{
                echo"error : ".mysqli_error($db)."ligne155";
                }
            }
                
                if(verifions($_POST["Sorte"])==3){
                    $del= ("DELETE FROM `Resume` WHERE idResume=".$identifiant."");
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
                        
                        <input type="date" id="Nom" name="DatesResume" placeholder="Premiere date" required>
                    
                        <input type="date" id="PrixAchat" name="Dates2Resume" placeholder="Seconde date" required>
                        
                        <input type="hidden"  name="Sorte" value="1">
                        <input type="submit" name="submit" value="submit" >
                </p>
                </form>
            
            

            <div id="modify" class="hidform">
                <form method= "POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                      <input type="date" id="Nom" name="DatesResume" placeholder="Premiere date" required>
                    
                    <input type="date" id="PrixAchat" name="Dates2Resume" placeholder="Seconde date" required> 
                    <input type="hidden" name="Sorte" value="2">
                    <input type="submit" value="soumettre">
                </form>
            </div>

            <div id="delet" class="hidform">
                <form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    
                 
                 <input type="number" id = "cacheS" name="Identifiant">
                            
                    <input type="hidden" name="Sorte" value="3">
                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
        <div class="tableau" style="background-color:#ddd;">
            <?php
                include 'connexion.php';
                $ventesTotal;
                $ventesDette;
                $sortieTotal;
                $bonusP;

                        
                $reqSql= ("SELECT*FROM `Resume` order by DatesResume desc");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo "<table id='Customers'><tr><th>identifiant</th><th>Dates 1</th><th>Dates 2</th><th>bonus perte materiels</th><th>sortie total</th><th>ventes en dette</th><th>ventes totals</th></tr>";
                    

                    while($row= mysqli_fetch_assoc($result)){
                            //echo"<tr><td>".$row["idProduit"]."</td><td>".$row["Nom"]."</td><td>".$row["PrixAchat"]."</td><td>".$row["PrixVente"]."</td><td>".$row["QuantiteStock"]."</td><td>".$row["DescriptionP"]."</td></tr>";
                            $vent = ("SELECT  TotalFacture FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$row["DatesResume"]."' AND '".$row["Dates2Resume"]."')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
                            $resultvent = mysqli_query($db, $vent);
                            if(mysqli_num_rows($resultvent)){
                                while($rowVent = mysqli_fetch_assoc($resultvent)){
                                    $ventesTotal += $rowVent["TotalFacture"];
                                }
                            }

                            $reqSqlB= ("SELECT `idBonusPerte`,`Nom`,`PrixVente`, `QuantiteGagne`, `QuantitePerdu`,QuantiteStock, `Motif`, `DatesD`  FROM Produit ,BonusPerte  WHERE (BonusPerte.idProduit=Produit.idProduit) ");
                            $resultB= mysqli_query($db, $reqSqlB);
                            if(mysqli_num_rows($resultB)>0){
                                
                                
                                while($rowB= mysqli_fetch_assoc($resultB)){
                                    $valGagne=($rowB["PrixVente"]*$rowB["QuantiteGagne"]);
                                    $valPerte=($rowB["PrixVente"]*$rowB["QuantitePerdu"]);
                                    $bonusP = $valGagne - $valPerte;
                                }
                                
        
                            $ventD = ("SELECT  TotalFacture, MontantPaye FROM Ventes WHERE (Ventes.DatesVente BETWEEN '".$row["DatesResume"]."' AND '".$row["Dates2Resume"]."')  AND (Dette = 'Oui') GROUP BY Operation");
                            $resultventD = mysqli_query($db, $ventD);
                            if(mysqli_num_rows($resultventD)){
                                while($rowVentD = mysqli_fetch_assoc($resultventD)){
                                    $ventesDette += $rowVentD["TotalFacture"] - $rowVentD["MontantPaye"];
                                }
                            }
        
                            $sortie = ("SELECT  Montant FROM Sortie WHERE (Sortie.DatesD BETWEEN '".$row["DatesResume"]."' AND '".$row["Dates2Resume"]."') ");
                            $resultsortie = mysqli_query($db, $sortie);
                            if(mysqli_num_rows($resultsortie)){
                                while($rowS = mysqli_fetch_assoc($resultsortie)){
                                    $sortieTotal += $rowS["Montant"];
                                }
                            }    
                        echo"<tr><td>".$row["idResume"]."</td><td>".$row["DatesResume"]."</td><td>".$row["Dates2Resume"]."</td><td>".$bonusP."</td><td>".$sortieTotal."</td><td>".$ventesDette."</td><td>".$ventesTotal."</td></tr>";
                    }
                }
                    echo"</table>";
                }else{echo "Tables vide ";}

            ?> 
           
        
        </div>
            
        
    </div>
    
        
</div>


<div class="footer">
        <h2>&copy copyrigth 2022</h2>
        <p>franck sefu +243 973359746</p>
</div>
<script>
   // document.getElementById("NomM").addEventListener("mouseo", verificatM);

    function verificatM(){
        if(document.getElementById("identifM").value != ""){
            let cont = document.getElementById("identifM").value;
            let tableau = cont.split(":");
            let nom =tableau[2];
            let prixA = tableau[8]*1;
            let prixV = tableau[4]*1;
            let quantite = tableau[6]*1;
            let identifiant = tableau[0]*1;

            document.getElementById("NomM").value = nom;
            document.getElementById("PrixAchatM").value = prixA;
            document.getElementById("QuantiteM").value = quantite;
            document.getElementById("PrixVenteM").value = prixV;
            document.getElementById("cache").value = identifiant;
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
