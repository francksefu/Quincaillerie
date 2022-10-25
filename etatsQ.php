<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="etatQ.css" media="screen" type="text/css">
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
    
    
    <title>Franck app</title>
    <style>
        body{
            background: url(albin.JPG);
            background-size: cover;
            background-repeat: no-repeat;
        }
        #date1, #date2, #recherche, #date11, #date22, #venteOp, #approvOp, #paieOp, #contratOp, #rechercheC, #rechercheCJ{
            display: none;
        }
        #date1{
            display: none;
        }
        #formulaire2RF{
            display: none;
        }
        p{
            color:aquamarine;
        }
        
    </style>
</head>
<?php 
    function datalistVente(){
        include 'connexion.php';
        $sql = ("SELECT Operation, NomClient, DatesVente FROM Ventes, Client WHERE (Ventes.idClient = Client.idClient) GROUP BY Operation");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='".$row["Operation"].": ".$row["NomClient"]." :".$row["DatesVente"]."'>".$row["NomClient"]." : ".$row["Operation"]."</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }

    function datalistContrat(){
        include 'connexion.php';
        $sql1 = ("SELECT Operation, NomClient, DatesContrat FROM Contrat, Client WHERE (Contrat.idClient = Client.idClient) GROUP BY Operation");
        $result1 = mysqli_query($db, $sql1);
                
        if(mysqli_num_rows($result1)>0){
                            
            while($row1= mysqli_fetch_assoc($result1)){
                echo"<option value='".$row1["Operation"].": ".$row1["NomClient"]." :".$row1["DatesContrat"]."'>".$row1["NomClient"]." : ".$row1["Operation"]."</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }
    function datalistApprov(){
        include 'connexion.php';
        $sql = ("SELECT Operation, DatesApprov FROM Approvisionnement GROUP BY Operation");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='".$row["Operation"].": ".$row["DatesApprov"]."'>".$row["Operation"]."= operation: date= ".$row["DatesApprov"]."</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }

    function datalistPaie(){
        include 'connexion.php';
        $sql = ("SELECT idPaiements, Operation, DatesPaie, Montant FROM Paiements ");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='".$row["idPaiements"].": ".$row["DatesPaie"]." :".$row["Operation"].":".$row["Montant"]." USD'>".$row["Montant"]."USD = montant a modifier: operation= ".$row["Operation"]."</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }
?>
<body>

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
    <a href="etatsQ.php" class="active" style="color: black;" >Les Etats</a>
    <a href="contratQ.php" >Contrat</a>
    
</div>

    <div class="column1">
        
        <button id="bonus" style="margin:5% 0;" class="btn btn-primary" onclick="completeur1('Vos bonus')">Bonus et Pertes</button>
         

        <div class="dropdown">
            <button class="dropbtn btn btn-primary">Sortie</button>
            <div class="dropdown-content">
                <button id="toutesSortie" onclick="completeur1('Toutes les sortie')">Toutes les Sortie</button>
                <button id="sortieDette" onclick="completeur1('Les sortie triées par dettes')">Sortie trié par dette</button>
                <button id="sortieDepense" onclick="completeur1('Les sortie triées par depense')">Sortie trié par depense</button>
                <button id="sortieCharge" onclick="completeur1('Les sortie triées par charge')">Sortie trié par charge</button>
                <button id="sortieAucun" onclick="completeur1('Les sortie inutile')">Sortie inutile</button>
            </div>
    
        </div>

        <div class="dropdown">
            <button class="dropbtn btn btn-primary" >Ventes affichage facture </button>
            <div class="dropdown-content">
                <button id="toutesVentes"onclick="completeur11('Toutes les ventes')">Toutes les ventes</button>
                <button id="ventesPayeCache" onclick="completeur11('Les ventes payé cache')">ventes payé cache</button>
                <button id="ventesdettes" onclick="completeur11('Toutes les ventes accordé en dette')">ventes accordés en dette</button>
              
            </div>
  
        </div>

        <div class="dropdown">
            <button class="dropbtn btn btn-primary" >Ventes affichage tableau</button>
            <div class="dropdown-content">
                <button id="toutesVentes"onclick="completeur1('Toutes les ventes affichage tableau')">Toutes les ventes</button>
                <button id="ventesPayeCache" onclick="completeur1('Les ventes payé cache affichage tableau')">ventes payé cache</button>
                <button id="ventesdettes" onclick="completeur1('Toutes les ventes accordé en dette affichage tableau')">ventes accordés en dette</button>
              
            </div>
   
        </div>

        <button style="margin:5% 0;" class="btn btn-primary" onclick="completeur11('les approvisionnement')">Approvisionnement</button>
        <button style="margin:5% 0;" class="btn btn-primary" onclick="completeur11('les paiements')">Paiements</button>
        <div class="dropdown">
            <button class="dropbtn" class="btn btn-primary">Dettes d entreprise</button>
            <div class="dropdown-content">
                <button id="detteMateriel" onclick="completeur1('Dette de l entreprise pris en materiel  1')">Materiel</button>
                <button id="detteArgent" onclick="completeur1('Dette de l entreprise pris en argent  1')">Argent</button>
                <button id="detteEntreprise" onclick="completeur1('Dette de l entreprise 1')">Toutes</button>
            
            </div>
    
        </div>
        <div class="dropdown">
            <button class="dropbtn btn btn-primary">Le client </button>
            <div class="dropdown-content">
                <button id="toutesFactureClient" onclick="completeurClient('Toutes les factures du client')">Toutes les factures du client</button>
                <button id="factureClientDettepaiement" onclick="completeurClient('Toutes les dettes du clients reglé et non reglé et ses paiements')">Dettes deja réglé et non réglé du client</button>
                <button id="factureClientDette" onclick="completeurClient('Toutes factures du client non réglé')">Toutes les factures du client non réglé</button>
              
            </div>
     
        </div>
        <button id="voirContratClient" class="btn btn-primary" onclick="completeurClientC('Voir le contrat du client')">Voir le contrat du client</button>
        <button id="voirContratClient" class="btn btn-primary" onclick="completeurClientCJ('Voir le contrat du client entre 2 dates')">Voir le contrat des clients entre 2 dates</button>
        <button id="comp" class="btn btn-primary" onclick="completeurRF('resume Final');">Resume</button>   

        
    </div>

    <div class="column2">
        <div id="date1">
        <form method= "POST" action="<?php echo htmlspecialchars("traitementsQ.php");?>" >
            <div id="formulaire1" style="margin: 10% 10px;">
                
                <p id="commentaire"></p><br>
                <input type="date" name="DatesF1" id="datesF1" ><br>
                <input type="hidden" name = "Envoie" id="Envoie1">
                <input type="submit" value="Soumettre" id="soumettre">
            </div>
        </form>
        </div>

        <div id="date11">
        <form method= "POST" action="<?php echo htmlspecialchars("traitementsQQ.php");?>" >
            <div id="formulaire1" style="margin: 10% 10px;">
                
                <p id="commentaire11"></p><br>
                <input type="date" name="DatesF1" id="datesF11" ><br>
                <input type="hidden" name = "Envoie" id="Envoie11">
                <input type="submit" value="Soumettre" id="soumettre">
            </div>
        </form>
        </div>


        <div id="date2">
        <form method= "POST" action="<?php echo htmlspecialchars("traitementsQ.php");?>" >
            <div id="formulaire2" style="margin: 10% 10px;">
        
                <p id="commentaire2"></p><br>
                <input type="date" name="DatesF21"  required><br>
                <input type="date" name="DatesF22"  required><br>
                <input type="hidden" name = "Envoie" id="Envoie2">
                <input type="submit" value="Soumettre" id="soumettre">
            </div>
        </form>
        </div>
        <!-- les nouveau -->
        <div id="resumeFinal">
        <form method= "POST" action="<?php echo htmlspecialchars("journeeResume.php");?>" >
            <div id="formulaire2RF" style="margin: 10% 10px;">
        
                <p id="commentaireRF"></p><br>
                <input type="date" name="DatesF21"  required><br>
                <input type="date" name="DatesF22"  required><br>
                <input type="hidden" name = "Envoie" id="EnvoieRF">
                <input type="submit" value="Soumettre" id="soumettre">
            </div>
        </form>
        </div>
        <!-- fin des nouveau pour le resume du jour -->

        <div id="date22">
        <form method= "POST" action="<?php echo htmlspecialchars("traitementsQQ.php");?>" >
            <div id="formulaire22" style="margin: 10% 10px;">
        
                <p id="commentaire22"></p><br>
                <input type="date" name="DatesF21"  required><br>
                <input type="date" name="DatesF22"  required><br>
                <input type="hidden" name = "Envoie" id="Envoie22">
                <input type="submit" value="Soumettre" id="soumettre">
            </div>
        </form>
        </div>
        <?php 
            function client(){
                include 'connexion.php';

                        $sql = ("SELECT*FROM Client");
                        $result = mysqli_query($db, $sql);
                                
                        if(mysqli_num_rows($result)>0){
                                            
                            while($row= mysqli_fetch_assoc($result)){
                                echo"<option value='".$row["idClient"].": ".$row["NomClient"]." :".$row["Telephone"]."'>".$row["NomClient"]." </option>"; 
                            }
                                
                        }else{echo "Une erreur s est produite ";}
            }
        ?>

        <div id="recherche">
            <div id="client1" style="margin: 10% 10px;">
                <form method= "POST" action="<?php echo htmlspecialchars("traitementsQQ.php");?>" >
                    <p id="commentaireC"></p><br>
                    <input type="text" list="clientL" id = "nClient" onchange="completeEnvoi()" name="NomC"><br>
                    <input type = "hidden" name="Client" id = "idCli">
                    <datalist id="clientL">
                    <?php
                        client();

                    ?>
                    </datalist>
                    <input type="hidden" name = "Envoie" id="EnvoieC">
                    <input type="submit" value="Soumettre" >
                </form>
            </div>
           
        </div>
        <div id="rechercheC">
            <div id="client1C" style="margin: 10% 10px;">
                <form method= "POST" action="<?php echo htmlspecialchars("traitementsContratQQ.php");?>" >
                    <p id="commentaireCC"></p><br>
                    <input type="text" list="clientL" id = "nClientC" onchange="completeEnvoiC()"><br>
                    <input type = "hidden" name="Client" id = "idCliC">
                    <input type = "hidden" name="NomClientC" id = "nomClientC">
                    <datalist id="clientL">
                    <?php
                        client();

                    ?>
                    </datalist>
                    <input type="hidden" name = "Envoie" id="EnvoieCC">
                    <input type="submit" value="Soumettre" >
                </form>
            </div>
            
        </div>

        <div id="rechercheCJ">
            <div id="client1CJ" style="margin: 10% 10px;">
                <form method= "POST" action="<?php echo htmlspecialchars("traitementContrat2Dates.php");?>" >
                    <p id="commentaireCCJ"></p><br>
                    <input type="date" name="DatesF21"  required><br>
                    <input type="date" name="DatesF22"  required><br>
                    <input type="hidden" name = "Envoie" id="EnvoieCCJ">
                    <input type="submit" value="Soumettre" >
                </form>
            </div>
            
        </div>

        <div id="venteOp">
            <form method="POST" action="<?php echo htmlspecialchars("ventesModif.php") ?>">
                <input type = "text" list = "reference" id = "OperaNom" name="OperaNom" onchange="testeVide()" placeholder="Mettez le numero de facture ici svp ..." required>
                <span id="effaceRapide" onclick="effaceRapide()" style=" color :aliceblue; font-size:100px; "> &Cross;</span>
                <input type = "hidden" name="cacher" value="ModifVente">
                <input type="hidden" name="Operation" id="operation">
                <input type="submit" value="Soumettre">
                    <datalist id="reference">
                        <?php 
                            datalistVente();

                        ?>
                    </datalist>
            </form>
        </div>

        <div id="contratOp">
            <form method="POST" action="<?php echo htmlspecialchars("contratAjustQ.php") ?>">
                <input type = "text" list = "referenceC" id = "OperaNomC" name="OperaNom" onchange="testeVideC()" placeholder="Mettez le numero de l operation du contrat ici svp ..." required>
                <span id="effaceRapideC" onclick="effaceRapideC()" style=" color :aliceblue; font-size:100px; "> &Cross;</span>
                <input type = "hidden" name="cacher" value="ModifVente">
                <input type="hidden" name="Operation" id="operationC">
                <input type="submit" value="Soumettre">
                    <datalist id="referenceC">
                        <?php 
                            datalistContrat();

                        ?>
                    </datalist>
            </form>
        </div>

        <div id="approvOp">
            <form method="POST" action="<?php echo htmlspecialchars("approvisionnementModif.php") ?>">
                <input type = "text" list = "referenceA" id = "OperaNomA" name="OperaNom" onchange="testeVideA()" placeholder="Mettez le numero de facture ici svp ...">
                <span id="effaceRapide" onclick="effaceRapideA()" style=" color :aliceblue; font-size:100px; "> &Cross;</span>
                <input type = "hidden" name="cacher" value="ModifApprov">
                <input type="hidden" name="Operation" id="operationA">
                <input type="submit" value="Soumettre">
                    <datalist id="referenceA">
                        <?php 
                            datalistApprov();

                        ?>
                    </datalist>
            </form>
        </div>


        <div id="paieOp">
            <form method="POST" action="<?php echo htmlspecialchars("facturePaie.php") ?>">
                <input type = "text" list = "referenceP" id = "OperaNomP" name="OperaNom" onchange="testeVideP()" placeholder="Mettez l identifiant de paiements ici ...">
                <span id="effaceRapide" onclick="effaceRapideP()" style=" color :aliceblue; font-size:100px; "> &Cross;</span>
                <input type = "hidden" name="cacher" value="ModifPaie">
                <input type="hidden" name="Operation" id="operationP">
                <input style="margin-left: 20%;" type="float" name = "Montant" placeholder="Mettez ici le montant qu on vous paie">
                <input type="hidden" name="idPaiements" id="paiementsP">
                <input type="hidden" name="DatesP" id = "datesP">
                <input type="submit" value="Soumettre">
                    <datalist id="referenceP">
                        <?php 
                            datalistPaie();

                        ?>
                    </datalist>
            </form>
        </div>
  
        
    </div>

    <div class="column3">
        <button id="bonus" class="btn btn-primary" style="margin:5% 0;" onclick="completeur2('Vos bonus 2')">Bonus et Pertes</button>
          

        <div class="dropdown">
            <button class="dropbtn btn btn-primary">Sortie</button>
            <div class="dropdown-content">
                <button  onclick="completeur2('Toutes les sortie 2')">Toutes les Sortie</button>
                <button  onclick="completeur2('Les sortie triées par dettes 2')">Sortie trié par dette</button>
                <button  onclick="completeur2('Les sortie triées par depense 2')">Sortie trié par depense</button>
                <button  onclick="completeur2('Les sortie triées par charge 2')">Sortie trié par charge</button>
                <button  onclick="completeur2('Les sortie inutile 2')">Sortie inutile</button>
            </div>
    
        </div>

        <div class="dropdown">
            <button class="dropbtn btn btn-primary" >Ventes affichage facture</button>
            <div class="dropdown-content">
                <button onclick="completeur22('Toutes les ventes 2')">Toutes les ventes</button>
                <button  onclick="completeur22('Les ventes payé cache 2')">ventes payé cache</button>
                <button  onclick="completeur22('Toutes les ventes accordé en dette 2')">ventes accordés en dette</button>
             
            </div>
  
        </div>

        <div class="dropdown">
            <button class="dropbtn btn btn-primary" >Ventes affichage tableau</button>
            <div class="dropdown-content">
                <button onclick="completeur2('Toutes les ventes 2 affichage tableau')">Toutes les ventes</button>
                <button  onclick="completeur2('Les ventes payé cache 2 affichage tableau')">ventes payé cache</button>
                <button  onclick="completeur2('Toutes les ventes accordé en dette 2 affichage tableau')">ventes accordés en dette</button>
             
            </div>
   
        </div>

        <button style="margin:5% 0;" class="btn btn-primary" onclick="completeur22('les approvisionnement 2')">Approvisionnement</button>
        <button style="margin:5% 0;" class="btn btn-primary" onclick="completeur22('les paiements 2')"> Paiements </button>
        <button style="margin:5% 0;" ><a href="http://localhost:8080/phpmyadmin/index.php?route=/database/export&db=Quincaillerie"> Enregistrement sur internet </a></button>
        <div class="dropdown">
            <button class="dropbtn btn btn-primary">Dettes d entreprise</button>
            <div class="dropdown-content">
                <button id="detteMateriel" onclick="completeur2('Dette de l entreprise pris en materiel  2')">Materiel</button>
                <button id="detteArgent" onclick="completeur2('Dette de l entreprise pris en argent  2')">Argent</button>
                <button id="detteEntreprise" onclick="completeur2('Dette de l entreprise 2')">Toutes</button>
           
            </div>
   
        </div>
        
        <div class="dropdown">
            <button class="dropbtn btn btn-primary">Modification des factures</button>
            <div class="dropdown-content">
                <button id="modeVente" onclick="venteOp()" ><a>Facture de vente</a></button>
                <button id="modeApprov" onclick="approvOp()"><a>Facture d approvisionnement</a></button>
                <button id="modePaiement" onclick="paieOp()">Paiements</button>
                <button id="modeContrat" onclick="contratOp()" ><a>Une partie du contrat</a></button>
            </div>
   
        </div>
   
        
    </div>
           
    
    
    
    
    <script>
        


        function completeur1(var1)
        {
            document.getElementById("commentaire").innerHTML ="Mettez la date a laquelle vous voulez voir "+var1;
            document.getElementById("Envoie1").value = var1;
            document.getElementById("date2").style.display = "none";
            document.getElementById("recherche").style.display = "none";
            document.getElementById("date22").style.display = "none";
            document.getElementById("date1").style.display = "block";
            document.getElementById("date11").style.display = "none";
            document.getElementById("venteOp").style.display = "none";
            document.getElementById("approvOp").style.display = "none";
            document.getElementById("paieOp").style.display = "none";
            document.getElementById("contratOp").style.display = "none";
            document.getElementById("rechercheC").style.display = "none";
            document.getElementById("rechercheCJ").style.display = "none";
            document.getElementById("formulaire2RF").style.display = "none";
        }

        function completeur11(var1)
        {
            document.getElementById("commentaire11").innerHTML ="Mettez la date a laquelle vous voulez voir "+var1;
            document.getElementById("Envoie11").value = var1;
            document.getElementById("date2").style.display = "none";
            document.getElementById("date22").style.display = "none";
            document.getElementById("recherche").style.display = "none";
            document.getElementById("date1").style.display = "none";
            document.getElementById("date11").style.display = "block";
            document.getElementById("venteOp").style.display = "none";
            document.getElementById("approvOp").style.display = "none";
            document.getElementById("paieOp").style.display = "none";
            document.getElementById("contratOp").style.display = "none";
            document.getElementById("rechercheC").style.display = "none";
            document.getElementById("rechercheCJ").style.display = "none";
        }

        function completeur2(var1)
        {
            document.getElementById("commentaire2").innerHTML ="Mettez les date a laquelle vous voulez voir  "+var1;
            document.getElementById("Envoie2").value = var1;
           document.getElementById("date1").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date2").style.display = "block";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }

        

        function completeur22(var1)
        {
            document.getElementById("commentaire22").innerHTML ="Mettez les date a laquelle vous voulez voir  "+var1;
            document.getElementById("Envoie22").value = var1;
           document.getElementById("date1").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("date22").style.display = "block";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }

        function completeurClient(var1)
        {
            document.getElementById("commentaireC").innerHTML =var1+":<br>Completez avec le nom du client ici ";
            document.getElementById("EnvoieC").value = var1;
            document.getElementById("rechercheC").style.display = "none";
           document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("recherche").style.display = "block";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }

        function completeurClientC(var1)
        {
            document.getElementById("commentaireCC").innerHTML =var1+":<br>Completez avec le nom du client ici ";
            document.getElementById("EnvoieCC").value = var1;
           document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("rechercheC").style.display = "block";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }

        function completeurClientCJ(var1)
        {
            document.getElementById("commentaireCCJ").innerHTML =var1+":<br> Completez les dates entre lesquelles vous voulez voir les contrats que vous avez emis ";
            document.getElementById("EnvoieCCJ").value = var1;
           document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "block";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }
     
        function completeEnvoi(){
            if(document.getElementById("nClient").value != ""){
                let valeur = document.getElementById("nClient").value;
                let tableau = valeur.split(":");
                let idClient = tableau[0]*1;
                document.getElementById("idCli").value = idClient;
            }
        }

        function completeEnvoiC(){
            if(document.getElementById("nClientC").value != ""){
                let valeur = document.getElementById("nClientC").value;
                let tableau = valeur.split(":");
                let idClient = tableau[0]*1;
                let nomClientC = tableau[1];
                document.getElementById("idCliC").value = idClient;
                document.getElementById("nomClientC").value = nomClientC;
            }
        }
      
        function testeVide(){
            if(document.getElementById("OperaNom").value != ""){
                let tableau = document.getElementById("OperaNom").value;
                let tab = tableau.split(":");
                let operation = tab[0]*1; 
                document.getElementById("operation").value = operation;
            }
        }
        function effaceRapide(){
            document.getElementById("OperaNom").value = "";
            document.getElementById("operation").value = "";
        }
        
        function venteOp(){
            document.getElementById("venteOp").style.display = "block";
            document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
        }

        
        function testeVideA(){
            if(document.getElementById("OperaNomA").value != ""){
                let tableau = document.getElementById("OperaNomA").value;
                let tab = tableau.split(":");
                let operation = tab[0]*1; 
                document.getElementById("operationA").value = operation;
            }
        }
        function effaceRapideA(){
            document.getElementById("OperaNomA").value = "";
            document.getElementById("operationA").value = "";
        }
        function approvOp(){
            document.getElementById("approvOp").style.display = "block";
            document.getElementById("venteOp").style.display = "none";
            document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("resumeFinal").style.display = "none";
        }

        function testeVideP(){
            if(document.getElementById("OperaNomP").value != ""){
                let tableau = document.getElementById("OperaNomP").value;
                let tab = tableau.split(":");
                let operation = tab[2]*1; 
                document.getElementById("operationP").value = operation;
                let paiements = tab[0]*1; 
                document.getElementById("paiementsP").value = paiements;
                let datesP = tab[1];
                document.getElementById("datesP").value = datesP;
            }
        }
        function effaceRapideP(){
            document.getElementById("OperaNomP").value = "";
            document.getElementById("operationP").value = "";
            document.getElementById("paiementsP").value = "";
        }
        function paieOp(){
            document.getElementById("paieOp").style.display = "block";
            document.getElementById("venteOp").style.display = "none";
            document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "none";
         
        }
        function contratOp(){
            document.getElementById("contratOp").style.display = "block";
            document.getElementById("date1").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("resumeFinal").style.display = "none";
        }
        function testeVideC(){
            if(document.getElementById("OperaNomC").value != ""){
                let tableau = document.getElementById("OperaNomC").value;
                let tab = tableau.split(":");
                let operation = tab[0]*1; 
                document.getElementById("operationC").value = operation;
            }
        }
        function effaceRapideC(){
            document.getElementById("OperaNomC").value = "";
            document.getElementById("operationC").value = "";
        }

        function completeurRF(var1){
            document.getElementById("commentaireRF").innerHTML ="Mettez les date a laquelle vous voulez voir  "+var1;
           // document.getElementById("Envoie2RF").value = var1;
           document.getElementById("date1").style.display = "none";
           document.getElementById("recherche").style.display = "none";
           document.getElementById("date2").style.display = "none";
           document.getElementById("date22").style.display = "none";
           document.getElementById("date11").style.display = "none";
           document.getElementById("venteOp").style.display = "none";
           document.getElementById("approvOp").style.display = "none";
           document.getElementById("paieOp").style.display = "none";
           document.getElementById("contratOp").style.display = "none";
           document.getElementById("rechercheC").style.display = "none";
           document.getElementById("rechercheCJ").style.display = "none";
           document.getElementById("formulaire2RF").style.display = "block";
        }

    </script>

   
</body>
</html>