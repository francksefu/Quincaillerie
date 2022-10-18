<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FranckApp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
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
        }
        
        
   
        #nouvelPP, #clientCont  {
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
        button{
            margin: 10px;
        }
    </style>
</head>
<body>
    <?php 
        function dataclient(){
            include 'connexion.php';
            $sql = ("SELECT*FROM Client");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    echo"<option value='".$row["idClient"].": ".$row["NomClient"]." :".$row["Telephone"]."' >".$row["NomClient"]." </option>"; 
                }
                        
           }else{echo "Une erreur s est produite ";}  
   
        }

        function suppressionPaiement(){
            include 'connexion.php';
            $sql = ("SELECT idPaieContrat, NomClient, Montant, DatesPaieContrat, PaiementContrat.idClient  FROM PaiementContrat, Client WHERE (Client.idClient = PaiementContrat.idClient) ");
            $result = mysqli_query($db, $sql);
                    
            if(mysqli_num_rows($result)>0){
                                
                while($row= mysqli_fetch_assoc($result)){
                    echo"<option value='".$row["idPaieContrat"].": ".$row["NomClient"]." :".$row["Montant"].":".$row["DatesPaieContrat"].":".$row["idClient"]."'>".$row["NomClient"]." </option>"; 
                }
                        
           }else{echo "Une erreur s est produite ";}  
    
        }
    ?>
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
    </div>
<div class="topnav">
<a href="accueilEntreprise.php">Accueil</a>
<a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php" class="active" style="color: #000;">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="contratQ.php" >Contrat</a>
</div>

<div class="row">
    <div class="column1">
    <?php // cacher et montre les formulaires d insertion et modification avec la partie de 25%?>
        <ul>
            <li><button type="button" class="btn btn-primary"
            onclick="document.getElementById('nouvelPP').style.display='block';
            document.getElementById('modify').style.display='none';document.getElementById('delet').style.display='none'; document.getElementById('clientCont').style.display = 'none';">Ajouter un paiement (contrat)</button></li>
            <li><button type="button" class="btn btn-primary"
            onclick="document.getElementById('modify').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('delet').style.display='none'; document.getElementById('clientCont').style.display = 'none';"> Modifier un paiement(contrat) </button></li>
            <li><button type="button" class="btn btn-primary" onclick="document.getElementById('delet').style.display='block';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('modify').style.display='none'; document.getElementById('clientCont').style.display = 'none';"> Supprimer un paiement (contrat)</button></li>
           
           <li><button type="button" class="btn btn-primary" onclick="document.getElementById('delet').style.display='none';
            document.getElementById('nouvelPP').style.display='none';document.getElementById('modify').style.display='none'; document.getElementById('clientCont').style.display = 'block';">Voir le contrat d un client specifique </button></li>
            
        </ul>
        <p id="region">
            <?php 
            include 'connexion.php';
            $nom=$telephone="";
                
            if($_SERVER["REQUEST_POST"]=="POST"){
                    $nom=verifions($_POST["NomClient"]);
                    $prixAchat=verifions($_POST["Telephone"]);
                    
                    $sorte=verifions($_POST["Sorte"]);
                    $identifiant=verifions($_POST["Identifiant"]);
                    
            }    
                function verifions($donne){
                    
                    $donne=htmlspecialchars($donne);
    
                    return $donne;
                }
                if(verifions($_POST["Sorte"])==1){
                $reqSql=("INSERT INTO `PaiementContrat`(`DatesPaieContrat`, Montant, idClient) values('".htmlspecialchars($_POST["DatesPaieContrat"])."','".htmlspecialchars($_POST["Montant"])."', '".htmlspecialchars($_POST["idClient"])."')");
                if(mysqli_query($db, $reqSql)){
                echo"<span id='succes'> enregistrement fait</span>";
                }else{
                echo"error : ".mysqli_error($db)."ligne155";
                }
            }
                $idClientA=" ";$idClientN=" "; $montantA=0; $montantN=0; $datesPaieA = 0; $datesPaieN = 0;
                $updN=" ";$updPA=" ";$updPV=" ";$updQ=" ";
                if(verifions($_POST["Sorte"])==2){
                    $reqSql= ("SELECT * FROM PaiementContrat WHERE idPaieContrat =".htmlspecialchars($_POST["Identifiant"])."");
                        $result= mysqli_query($db, $reqSql);
                        if(mysqli_num_rows($result)>0){
                            while($row= mysqli_fetch_assoc($result)){
                                $idClientA= $row["idClient"];
                                $montantA= $row["Montant"];
                                $datesPaieA = $row["DatesPaieContrat"];
                                
                            }
                        }else{echo "Une erreur s est produite ";}
                        if(empty(verifions($_POST["idClient"]))){
                            $idClientN=$idClientA;
                        }else{$idClientN=verifions($_POST["idClient"]);}
                        if(empty(verifions($_POST["Montant"]))){
                            $montantN=$montantA;
                        }else{$montantN=verifions($_POST["Montant"]);}

                        if(empty(htmlspecialchars($_POST["DatesPaieContrat"]))){
                            $datesPaieN=$datesPaieA;
                        }else{$datesPaieN = htmlspecialchars($_POST["DatesPaieContrat"]);}
                       
                        $updN= ("UPDATE `PaiementContrat` SET `idClient` = '".$idClientN."' WHERE `PaiementContrat`.`idPaieContrat` = ".htmlspecialchars($_POST["Identifiant"])."");
                        $updPA= ("UPDATE `PaiementContrat` SET `Montant` = '".$montantN."' WHERE `PaiementContrat`.`idPaieContrat` = ".htmlspecialchars($_POST["Identifiant"])."");
                        $updPV= ("UPDATE `PaiementContrat` SET `DatesPaieContrat` = '".$datesPaieN."' WHERE `PaiementContrat`.`idPaieContrat` = ".htmlspecialchars($_POST["Identifiant"])."");
                        

                        if(mysqli_query($db,$updN)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updPA)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                        if(mysqli_query($db,$updPV)){echo"";}else{
                            echo"Error : ".mysqli_error($db);
                        }
                       
                        echo "voici :".$nomN." telepphone".$telephoneN;
                }
                if(verifions($_POST["Sorte"])==3){
                    $del= ("DELETE FROM PaiementContrat WHERE idPaieContrat=".htmlspecialchars($_POST["Identifiant"])."");
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
                        <br><label for="Nom">Nom</label><br>
                        <input type="text" class="form-control" onchange="deplaceur(this, document.getElementById('idClientV'))" id="Nom" list="data" name="NomClient" placeholder="Nom du client" required>*
                        <datalist id="data">
                            <?php dataClient(); ?>
                        </datalist>
                        <input type="hidden" id="idClientV" name="idClient">
                    <br> <label for="DatePaie" > Date de paiement</label><br>
                        <input type="date" class="form-control" id="DatePaie" name="DatesPaieContrat" placeholder="Date de paiement" >
                    <br> <label for="Montant" > Montant</label><br>
                        <input type="float" class="form-control" id="Montant" name="Montant" placeholder="Montant" >
                      
                        <input type="hidden"  name="Sorte" value="1">
                        <input type="submit" name="submit" value="submit" >
                </p>
                </form>
            
            

            <div id="modify" class="hidform">
                <form method= "POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                Identifiant <input type="text" id="IdentifiantM" onchange="deplaceur(this, document.getElementById('IdentifiantMod'))" list="dataM"  placeholder="cherchez le paiement a supprimer" required>
                <datalist id="dataM">
                    <?php suppressionPaiement(); ?>
                </datalist>
                <input type="hidden" id="IdentifiantMod" name="Identifiant">

                <br><label for="Nom">Nom</label><br>
                    <input type="text" class="form-control" id="NomM" list="data" onchange="deplaceur(this, document.getElementById('idClientM'))" name="NomClient" placeholder="Nom du client" required>*
                        <datalist id="data">
                            <?php dataClient(); ?>
                        </datalist>
                    <input type="hidden" id="idClientM" name="idClient">
                <br> <label for="DatePaie" > Date de paiement</label><br>
                    <input type="date" class="form-control" id="DatesPaieM" name="DatesPaieContrat" placeholder="Date de paiement" >
                <br> <label for="Montant" > Montant</label><br>
                    <input type="float" class="form-control" id="MontantM" name="Montant" placeholder="Montant" >
                       
                    <input type="hidden" name="Sorte" value="2">
                    <input type="submit" value="soumettre">
                </form>
                
            </div>
            <div id="clientCont">
                <form method="POST" action="contratClient.php">
                    <input type="text" class="form-control" onchange="deplaceur(this, document.getElementById('idClientC'))" list="clientC" placeholder="Nom du client svp">
                    <datalist id="clientC">
                        <?php dataClient(); ?>
                    </datalist>
                    <input type="hidden" id="idClientC" name="idClient"><br><br>
                    <button type="submit" class="btn btn-primary" style="width: 30%;">Soumettre</button>
                </form>
            </div>

            <div id="delet" class="hidform">
                <form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                    
                Identifiant <input type="text" id="IdentifiantS" class="form-control" onchange="deplaceur(this, document.getElementById('IdentifiantSup'))" list="dataS"  placeholder="cherchez le paiement a supprimer" required>
                <datalist id="dataS">
                    <?php suppressionPaiement(); ?>
                </datalist>
                <input type="hidden" id="IdentifiantSup" name="Identifiant">
                    <input type="hidden" name="Sorte" value="3">
                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
        <div class="tableau" style="background-color:#ddd;">
            <?php
                include 'connexion.php';        
                $reqSql= ("SELECT idPaieContrat, NomClient, Montant, DatesPaieContrat FROM Client, PaiementContrat WHERE (Client.idClient = PaiementContrat.idClient )order by DatesPaieContrat DESC");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo"<table id='Customers'><tr><th>identifiant</th><th>Nom du client</th><th>Montant</th><th>DatesPaiement</th></tr>";
                    while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["idPaieContrat"]."</td><td>".$row["NomClient"]."</td><td>".$row["Montant"]."</td><td>".$row["DatesPaieContrat"]."</td></tr>"; 
                    }
                    echo"</table>";
                }else{echo "Une erreur s est produite ";}

            ?> 
           
        
        </div>
            
        
    </div>
    
        
</div>


<div class="footer">
        <h2>&copy; Copyrigth</h2>
        <p>franck sefu +243 973359746</p>
</div>
<script>
    function deplaceur(expediteur, recepteur){
        let decoupeur = expediteur.value;
        const tab = decoupeur.split(":");
        recepteur.value = tab[0];
        
    }
    function plaqueurModifieur(){
        let decoupeur = document.getElementById("IdentifiantM").value;
        const tab = decoupeur.split(":");
        document.getElementById("NomM").value = tab[4]+":"+tab[1];
        document.getElementById("DatesPaieM").value = tab[3];
        document.getElementById("MontantM").value = tab[2];
    }
    document.getElementById("IdentifiantM").addEventListener("change", plaqueurModifieur)
    
</script>
 
</body>
</html>