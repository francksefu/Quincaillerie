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
        
    </style>

</head>
<body >
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
    </div>

<div class="topnav">
    <a href="">Accueil</a>
    <a href="produitQ.php" class="active">Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="" >Caisse</a>
    
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
                    $nom=verifions($_POST["Nom"]);
                    $prixAchat=verifions($_POST["PrixAchat"]);
                    $prixVente=verifions($_POST["PrixVente"]);
                    $quantite=verifions($_POST["QuantiteStock"]);
                    $sorte=verifions($_POST["Sorte"]);
                    $identifiant=verifions($_POST["Identifiant"]);
                    
            }    
                function verifions($donne){
                    
                    $donne=htmlspecialchars($donne);
    
                    return $donne;
                }
                if(verifions($_POST["Sorte"])==1){
                $reqSql = ("INSERT INTO `Produit`(`Nom`, PrixAchat, `PrixVente`, `QuantiteStock`, `DescriptionP`) values('".verifions($_POST["Nom"])."','".verifions($_POST["PrixAchat"])."','".verifions($_POST["PrixVente"])."','".verifions($_POST["QuantiteStock"])."','".verifions($_POST["Description"])."')");
                if(mysqli_query($db, $reqSql)){
                echo"<span id='succes'> enregistrement fait</span>";
                }else{
                echo"error : ".mysqli_error($db)."ligne155";
                }
            }
                $nomA=" ";$nomN=" ";$pAA=0;$pAAN=0;$pVA=0;$pVAN=0;$qA=0;$qAN=0;$desA;$desN;$desAN;
                $updN=" ";$updPA=" ";$updPV=" ";$updQ=" ";
                if(verifions($_POST["Sorte"])==2){
                    $reqSql= ("SELECT Nom,PrixAchat,PrixVente,QuantiteStock,DescriptionP FROM Produit WHERE idProduit =".verifions($_POST["Identifiant"])."");
                        $result= mysqli_query($db, $reqSql);
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                $nomA= $row["Nom"];
                                $pAA= $row["PrixAchat"];
                                $pVA= $row["PrixVente"];
                                $qA= $row["QuantiteStock"];
                                $desA = $row["DescriptionP"];
                            }
                        }else{echo "Une erreur s est produite ";}
                        if(empty(verifions($_POST["Nom"]))){
                            $nomN=$nomA;
                        }else{$nomN=verifions($_POST["Nom"]);}
                        if(empty(verifions($_POST["PrixAchat"]))){
                            $pAAN=$pAA;
                        }else{$pAAN=verifions($_POST["PrixAchat"]);}
                        if(empty(verifions($_POST["PrixVente"]))){
                            $pVAN=$pVA;
                        }else{$pVAN=verifions($_POST["PrixVente"]);}
                        if(empty(verifions($_POST["QuantiteStock"]))){
                            $qAN=$qA;
                        }else{$qAN=verifions($_POST["QuantiteStock"]);}

                        if(empty(verifions($_POST["Description"]))){
                            $desAN=$desA;
                        }else{$desAN=verifions($_POST["Description"]);}

                        $updN= ("UPDATE `Produit` SET `Nom` = '".$nomN."' WHERE `Produit`.`idProduit` = ".verifions($_POST["Identifiant"])."");
                       $updPA= ("UPDATE `Produit` SET `PrixAchat` = '".$pAAN."' WHERE `Produit`.`idProduit` = ".verifions($_POST["Identifiant"])."");
                        $updPV= ("UPDATE `Produit` SET `PrixVente` = '".$pVAN."' WHERE `Produit`.`idProduit` = ".verifions($_POST["Identifiant"])."");
                        $updQ= ("UPDATE `Produit` SET `QuantiteStock` = '".$qAN."' WHERE `Produit`.`idProduit` = ".verifions($_POST["Identifiant"])."");
                        $updD= ("UPDATE `Produit` SET `DescriptionP` = '".$desAN."' WHERE `Produit`.`idProduit` = ".verifions($_POST["Identifiant"])."");

                        if(mysqli_query($db,$updN)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updD)){echo"";}else{
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
                        echo "voici :".$nomN." pA".$pAAN." pV".$pVAN." q".$qAN;
                }
                if(verifions($_POST["Sorte"])==3){
                    $del= ("DELETE FROM Produit WHERE idProduit=".verifions($_POST["Identifiant"])."");
                    if(mysqli_query($db,$del)){echo"<span> Suppression fait</span>";}else{
                        echo"Error : ".mysqli_error($db);
                    }
                }

                function datalist(){
                    include 'connexion.php';
                    $sql = ("SELECT*FROM Produit");
                    $result = mysqli_query($db, $sql);
                            
                    if(mysqli_num_rows($result)>0){
                                        
                        while($row= mysqli_fetch_assoc($result)){
                            echo"<option value='".$row["idProduit"].":nom=:".$row["Nom"].": PV=:".$row["PrixVente"].": USD Qtite :".$row["QuantiteStock"].":PA= :".$row["PrixAchat"].": USD'>".$row["Nom"]." : ".$row["PrixVente"]." USD</option>"; 
                        }
                               
                   }else{echo "Une erreur s est produite ";}  
            
                }
               
                
            ?>  
            </p>
    </div>
    <div class="column2">
       
        <div class="enveloppe2">
            
                <form method= "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <p id="nouvelPP" >
                        
                        <input type="text" id="Nom" name="Nom" placeholder="Nom du Produit" required>
                    
                        <input type="float" id="PrixAchat" name="PrixAchat" placeholder="Prix Achat" required> USD<br><br>
                        
                        <input type="float" id="PrixVente" name="PrixVente" placeholder="Prix Vente"  required> USD
                        
                        <input type="number" id="Quantite" name="QuantiteStock" placeholder="Quantite en stock" required><br><br>
                        
                        <textarea id="description" name="Description" placeholder="Description" rows="4" cols="4"></textarea><br>
                        
                        <input type="hidden"  name="Sorte" value="1">
                        <input type="submit" name="submit" value="submit" >
                </p>
                </form>
            
            

            <div id="modify" class="hidform">
                <form method= "POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                     <input type="text" id="identifM" onchange="verificatM()" list="identif" style="margin: 8px 35%;" placeholder="Identifiant"><br>
                     <input type="hidden" id = "cache" name="Identifiant">
                     <datalist id="identif">
                        <?php 
                            datalist();

                        ?>
                    </datalist>
             
                    <input type="text" id="NomM" name="Nom" placeholder="Nom du Produit" >
                     
                    PA <input type="float" id="PrixAchatM" name="PrixAchat" placeholder="Prix Achat"  >USD<br>
                     
                    PV <input type="float" id="PrixVenteM" name="PrixVente" placeholder="Prix Vente" >USD
                   
                    Q <input type="number" id="QuantiteM" name="QuantiteStock" placeholder="Quantite en stock"><br>
                    <textarea id="descriptionM" name="Description" placeholder="Description" rows="4" cols="4"></textarea><br>
                    <input type="hidden" name="Sorte" value="2">
                    <input type="submit" value="soumettre">
                </form>
            </div>

            <div id="delet" class="hidform">
                <form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    
                 <input type="text" list="identifS" id="IdentifiantS" onchange="verificatS()" placeholder="identifiant" required>
                 <input type="hidden" id = "cacheS" name="Identifiant">
                            <datalist id="identifS">
                                <?php 
                                    datalist();

                                ?>
                            </datalist>
                    <input type="hidden" name="Sorte" value="3">
                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
        <div class="tableau" style="background-color:#ddd;">
            <?php
                
                include 'connexion.php';
                        
                $reqSql= ("SELECT idClient, DatesVente, Ventes.Operation, idPaiements,DatesPaie,Montant FROM Ventes, Paiements WHERE (Ventes.Operation = Paiements.Operation) order by Operation DESC");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo "<table id='Customers'><tr><th>identifiant du paiement</th><th>Dates Paie</th><th>Montant</th><th>numero d operation et Dates de Vente</th></tr>";
                    
                    while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["idPaiements"]."</td><td>".$row["DatesPaie"]."</td><td>".$row["Montant"]."</td><td>".$row["Operation"]." : ".$row["DatesVente"]."</td></tr>"; 
                    }
                    echo"</table>";
                }else{echo "Une erreur s est produite ";}

            

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
</html>