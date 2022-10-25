<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>franckApp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="facture.css" media = "screen" type="text/css"/>
    
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
        p {
            padding: 10px;
            
            border-radius: 10px;
            margin-bottom:10px;
            text-align: center;
           border: 1px solid black;
            width: 60%;
            margin-left: 20%;
        }
        #Customers{
            width: 80%;
            margin: auto;
        }
    </style>
</head>

<body>
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
</div>
<div class="topnav">
<a href="accueilEntreprise.php">Accueil</a>
    <a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php" >Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
    <a href="contratQ.php" >Contrat</a>
  
</div>
   <?php 
   include 'connexion.php';
   echo "<p> Bonus et Pertes</p>";
   // Bonus et perte
   $dates21 = htmlspecialchars($_POST["DatesF21"]);
   $dates22 = htmlspecialchars($_POST["DatesF22"]);
   $envoie = "resumeFinal";
    function bonus($reqSql){
        include 'connexion.php';
        $montantG;
        $montantP;
        $result= mysqli_query($db, $reqSql);
        
        if(mysqli_num_rows($result)>0){
            
            echo"<table id='Customers'><tr><th>identifiant</th><th>Nom Produit</th><th>Quantite gagne</th><th>Quantite perdu</th><th>Quantite en stock</th><th>motif</th><th> Valeur </th><th>DatesD</th></tr>";
            while($row= mysqli_fetch_assoc($result)){ 
                    $valGagne=($row["PrixVente"]*$row["QuantiteGagne"]);
                    $valPerte=($row["PrixVente"]*$row["QuantitePerdu"]);
                    echo"<tr><td>".$row["idBonusPerte"]."</td><td>".$row["Nom"]."</td><td>".$row["QuantiteGagne"]." </td><td>".$row["QuantitePerdu"]." </td><td>".$row["QuantiteStock"]."</td><td>".$row["Motif"]."</td><td>".$valGagne-$valPerte." USD </td><td>".$row["DatesD"]."</td></tr>";
                    
                    $montantG += $valGagne;
                    $montantP += $valPerte;
            }

            echo"</table>";
            echo "<p class='footer'>Montant Total perdu = ".-$montantP."USD <br>";
            echo "Montant Total perdu = ".$montantG."USD <br>";
            echo "La difference entre les deux est donc de : ".$montantG - $montantP." USD </p>";

        }else{echo "Pas des bonus ,ni pertes dans cette periode";}
    }
    if($envoie == "resumeFinal"){
            
        $reqBonusP2= ("SELECT `idBonusPerte`,`Nom`,`PrixVente`, `QuantiteGagne`, `QuantitePerdu`,QuantiteStock, `Motif`, `DatesD`  FROM Produit ,BonusPerte  WHERE (BonusPerte.idProduit=Produit.idProduit) AND(DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
        bonus($reqBonusP2);

    }
//Ventes affichage tableau
echo "<p> Ventes </p>";
    function ventesT($reqmere, $reqmere2){
        include 'connexion.php';

        $montantTot;

        $result= mysqli_query($db, $reqmere);
        $result2 = mysqli_query($db, $reqmere2);
        if(mysqli_num_rows($result)>0){
            echo"<table id='Customers'><tr><th>Articles</th><th>Quantite vendu </th><th>Prix Unitaire</th><th>Prix total </th></tr>";
            
            while($row= mysqli_fetch_assoc($result)){
                echo"<tr style = 'background-color:gold; color : green;'><td>".$row["DatesVente"]."</td></tr>";
                
                $reqfille = ("SELECT Nom, QuantiteVendu, PU, PT, QuantiteStock FROM Ventes, Produit WHERE (DatesVente = '".$row["DatesVente"]."') and (Ventes.idProduit = Produit.idProduit)");
                $resultf= mysqli_query($db, $reqfille);
                if(mysqli_num_rows($resultf)>0){
                   
                    while($rowf= mysqli_fetch_assoc($resultf)){
                        echo"<tr><td>".$rowf["Nom"]."</td><td>".$rowf["QuantiteVendu"]."</td><td>".$rowf["PU"]."</td><td>".$rowf["PT"]."</td></tr>"; 
                        $montantTot += ($rowf["PT"]);
               
                    }
                }
            }
            echo"</table>";
            echo"<p class='footer' style = 'color : green;'> Montant total de vente : ".$montantTot." USD </p><br><br>";
           
        }else{echo "Table vide ... ";}

        if(mysqli_num_rows($result2)>0){
            echo"<table id='Customers'><tr><th style ='background-color:yellow; color: #000;'>Articles</th><th style ='background-color:yellow; color: #000;'>Quantite vendu </th><th style ='background-color:yellow; color: #000;'>QuantiteStock actuel</th></tr>";
            $nombre;
            while($row2= mysqli_fetch_assoc($result2)){
                //echo"<tr style = 'background-color:gold; color : green;'><td>".$row2["DatesVente"]."</td></tr>";
                $nombre = 0;
                $reqfille2 = ("SELECT Nom, QuantiteVendu, PU, PT, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente = '".$row2["DatesVente"]."') and (Ventes.idProduit = '".$row2["idProduit"]."'))and (Ventes.idProduit = Produit.idProduit)");
                $resultf2= mysqli_query($db, $reqfille2);
                if(mysqli_num_rows($resultf2)>0){
                   
                    while($rowf2 = mysqli_fetch_assoc($resultf2)){

                        //echo"<tr><td>".$rowf["Nom"]."</td><td>".$rowf["QuantiteVendu"]."</td><td>".$rowf["PU"]."</td><td>".$rowf["PT"]."</td><td>".$rowf["QuantiteStock"]."</td></tr>"; 
                        $nombre += ($rowf2["QuantiteVendu"]);
               
                    }
                }
                echo"<tr><td>".$row2["Nom"]."</td><td>".$nombre."</td><td>".$row2["QuantiteStock"]."</td></tr>";
            }
            echo"</table>";
            
        }else{echo "Pas de ventes au cours de cette periode ... ";}
    }
    if($envoie == "resumeFinal"){
        $reqmere = ("SELECT DatesVente FROM Ventes WHERE (DatesVente BETWEEN '".$dates21."' AND '".$dates22."') GROUP BY DatesVente");
        $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE (DatesVente BETWEEN '".$dates21."' AND '".$dates22."')and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
        ventesT($reqmere, $reqmere2);
    }

    // les sorties 
    echo "<p> Les sorties </p>";
    function sortie($reqSql){
        include 'connexion.php';

        $montantTot;
        $result= mysqli_query($db, $reqSql);
        if(mysqli_num_rows($result)>0){
            echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
            while($row= mysqli_fetch_assoc($result)){

                echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                $montantTot += $row["Montant"];
            }
            echo"</table>";
            echo"<p class='footer'> Montant total sortie : ".$montantTot." USD </p>";
        }else{echo "Pas de sortie a cette date ... ";}
    }

    if($envoie == "resumeFinal"){
            
        $reqSortie2= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."')");
        sortie($reqSortie2);
        
    }

    // dette entreprise
    echo "<p>Dette entreprise</p>";
    if($envoie == "resumeFinal"){
        $valeuD;
        $montantD;
        $restD;

        $reqSqlD= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
        $resultD= mysqli_query($db, $reqSqlD);
        if(mysqli_num_rows($resultD)>0){
            echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
            while($rowD= mysqli_fetch_assoc($resultD)){
                $valeuD += $rowD["ValeurDette"];
                $montantD += $rowD["MontantPaye"];
                $restD += $rowD["Reste"];

                    echo"<tr><td>".$rowD["idDette"]."</td><td>".$rowD["TypeD"]."</td><td>".$rowD["ValeurDette"]."</td><td>".$rowD["MontantPaye"]."</td><td>".$rowD["Reste"]."</td><td>".$rowD["DatesD"]."</td><td>".$rowD["DatesRNew"]."</td></tr>"; 
            }
            echo"</table>";
            echo"<p class='footer'>Valeur Total de toutes les dettes : ".$valeuD." USD <br>";
            echo "Montant Total deja payé : ".$montantD." USD<br>";
            echo "Reste total : ".$restD." USD<br></p>";
        }else{echo "Pas des dettes d entreprise a cette date ";}
    }
   // les approvisionnements
   echo "<p> Approvisionnements</p>";
   function approvisionnement($reqinfo){
        include 'connexion.php';
        $totFact;

        $resultinf = mysqli_query($db, $reqinfo);
        if(mysqli_num_rows($resultinf)>0){
            while($row1= mysqli_fetch_assoc($resultinf)){

                $reqSql = ("SELECT Nom, QuantiteApprov, PrixA FROM Produit, Approvisionnement WHERE (Approvisionnement.Operation = '".$row1["Operation"]."') AND (Produit.idProduit=Approvisionnement.idProduit)");
                $result= mysqli_query($db, $reqSql);
                echo"<div style='width:60%;margin-left:5%; margin-bottom: 5%;'>";
            
                echo"<h1>Facture d approvisionnement</h1><br>";
                echo"<h2>Numero : ".$row1["Operation"]."</h2><br>";
                echo" <h2>Goma le,".$row1["DatesApprov"]."</h2><br>";
            

                if(mysqli_num_rows($result)>0){
                    echo"<table id='customers'><tr><th style = 'background-color:#555;'>Qtite</th><th style = 'background-color:#555;'>Articles </th><th style = 'background-color:#555;'>     PU      </th><th style = 'background-color:#555;'>PT </th></tr>";
                    while($row= mysqli_fetch_assoc($result)){
                        echo"<tr><td>".$row["QuantiteApprov"]."</td><td>".$row["Nom"]."</td><td>".$row["PrixA"]."</td><td>".$row["PrixA"]*$row["QuantiteApprov"]."</td></tr>"; 
                        
                    }
                    echo"</table>";
                    echo"<h2>Total general : <span style='margin-left:20%'>".$row1["TotalFacture"]." USD</span></h2>";
                    $totFact += $row1["TotalFacture"];
                    echo "</div>";
                }else{echo "Impossible de generer cette facture ";}
            }
            echo"<p class='footer' style = 'color : green; font-size: 25px; margin-top:20px;'>Total de toutes les factures : ".$totFact." USD <br></p>";
        }else{echo"Pas d approvisionnement a cette date";}
    
    }

    if($envoie == "resumeFinal"){
            
        $reqApprov2 = ("SELECT Nom, QuantiteApprov, PrixA,Operation, TotalFacture FROM Produit, Approvisionnement WHERE (Approvisionnement.DatesApprov BETWEEN '".$dates21."' AND '".$dates22."') AND (Produit.idProduit=Approvisionnement.idProduit) GROUP by Operation");
        approvisionnement($reqApprov2);
   
    }

    // les paiements 
    echo "<p> Paiements des quelques ventes </p>";
    function afficheur($OperaV,$nomCli, $dateV, $detteV){
            
        include 'connexion.php';
        
        $operation = $OperaV;
        $nomClient = $nomCli;
        $date = $dateV;
        $calculpvt = 0;
        $dette = $detteV;

       

        $reqSql = ("SELECT Nom, QuantiteVendu, PU, PT, MontantPaye, TotalFacture FROM Produit, Ventes WHERE (Ventes.Operation = ".$operation.") AND (Produit.idProduit=Ventes.idProduit)");
        $result= mysqli_query($db, $reqSql);
        echo"<div style='width:60%;margin-left:5%; '>";
        echo "<div class='cadreint'>dette : ".$dette."</div>";
        echo"<h1>Facture</h1><br>";
        echo"<h2>Numero : ".$operation."</h2><br>";
        echo" <h2>Goma le,".$date."</h2><br>";
        echo"<h2>Mr, Mme :<span style:'border-bottom:dotted;'><i>".$nomClient." </i>doit :</span></h2><br>";

        if(mysqli_num_rows($result)>0){
            echo"<table id='customers'><tr><th style = 'background-color:#555;'>Qtite</th><th style = 'background-color:#555;'>Articles </th><th style = 'background-color:#555;'>     PU      </th><th style = 'background-color:#555;'>PT </th></tr>";
            while($row= mysqli_fetch_assoc($result)){
                echo"<tr><td>".$row["QuantiteVendu"]."</td><td>".$row["Nom"]."</td><td>".$row["PU"]."</td><td>".$row["PT"]."</td></tr>"; 
                $cal = $row["QuantiteVendu"]*$row["PU"];
                $calculpvt += $cal;
                $montantPay = $row["MontantPaye"];
                $totalFactureI = $row["TotalFacture"]; 
            }
            echo"</table>";
            echo"<h2>Total general : <span style='margin-left:20%'>".$totalFactureI." USD</span></h2>";
            echo "</div>";
            echo"<p>Reste sur cette facture : ".$totalFactureI - $montantPay." USD</p>";
            $reqPaie = ("SELECT*FROM Paiements WHERE Operation = '".$operation."'");
            $resultPaie = mysqli_query($db, $reqPaie);
            if(mysqli_num_rows($result)>0){
                $totMontant;
                echo"<div style = 'border:0px solid black; margin-left : 60px; font-size:18px; padding:auto;'>";
                echo"<p>";
                echo "<h2>Les paiements</h2><br><br>";
                while($row2 = mysqli_fetch_assoc($resultPaie)){
                    echo $row2["idPaiements"]." . dates : ".$row2["DatesPaie"]." -> ".$row2["Montant"]." USD<br>";
                    $totMontant += $row2["Montant"];

                }
                echo"<br> <span style = 'color:white;background-color :green;'>Total paiement : ".$totMontant." USD</span> <br> ";
                echo"<span style = 'color:white;background-color :green;'>Reste a payer : ".$calculpvt - $totMontant." USD </span><br>";
                echo"</p>";
                echo"</div>";
            }
        }else{echo "Pas de paiements ventes directes ";}
  
    }
    function paiements($reqinfo){
        include 'connexion.php';
    
        $resultinfo = mysqli_query($db, $reqinfo);
        if(mysqli_num_rows($resultinfo) > 0){
            while ($rowinfo = mysqli_fetch_assoc($resultinfo)){
                afficheur($rowinfo["Operation"],$rowinfo["NomClient"],$rowinfo["DatesVente"],$rowinfo["Dette"]);
               
            }
           
        }else{echo "Pas des données pour le paiements des ventes directes";}

    } 
    if($envoie == "resumeFinal"){
        $reqPaie = ("SELECT Operation, DatesVente, NomClient, Dette FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$dates21."' AND '".$dates22."')  AND (Client.idClient=Ventes.idClient)AND(Dette != 'Non') GROUP BY Operation");
         paiements($reqPaie);
     }  
   ?> 
<!-- Contrat fait -->
<div style="border:0px solid black;"><!--  Debut requette pour l affichage de la facture -->
    <?php
    //Nous commencons le processus de fabrication d un contrat
        include 'connexion.php';
        
        $envoie = htmlspecialchars($_POST["Envoie"]);

        
// nous ne recevons que de chiffre ici mdrrr je suis fort !!!c est au moment de revenir dans le code que l on sen l ingeniosite
        $dates1 = htmlspecialchars($_POST["DatesF21"]);
        $dates2 = htmlspecialchars($_POST["DatesF22"]);
        
      //Debut affichage contrat journalier, client par client

      // variable contenant la conclusion final
      $paTTJ = 0; $paCMJ = 0; $paCAJ = 0;
        $pvTTJ = 0; $pvCMJ = 0; $pvCAJ = 0;
        $bTTJ = 0; $bCMJ = 0; $bCAJ;

      $rreqSqlI= ("SELECT Contrat.idClient, NomClient,DatesContrat FROM Contrat, Client WHERE (Contrat.idClient = Client.idClient) AND (DatesContrat BETWEEN  '".$dates1."' AND '".$dates2."') GROUP BY Client.idClient order by Operation DESC");
        $rresultI= mysqli_query($db, $rreqSqlI);
        if(mysqli_num_rows($rresultI)>0){
                    
            while($rrowI= mysqli_fetch_assoc($rresultI)){
                //fin de la bouble de triage des clients qui devrons determniner le contrat
        
        //
        
                $paTT = 0; $paCM = 0; $paCA = 0;
                $pvTT = 0; $pvCM = 0; $pvCA = 0;
                $bTT = 0; $bCM = 0; $bCA;

                $rreqSql= ("SELECT *FROM Contrat WHERE (idClient = '".$rrowI["idClient"]."') AND (DatesContrat BETWEEN  '".$dates1."' AND '".$dates2."') GROUP BY Operation order by Operation DESC");
                $rresult= mysqli_query($db, $rreqSql);
                if(mysqli_num_rows($rresult)>0){
                //echo"<p>Client  : <i>".$NomC."</i></p>";
                //echo "<table id='Customers'><tr><th>Quantite</th><th>Articles</th><th>Sources</th><th>Prix A unitaire</th><th>Prix A total</th><th>Prix V U</th><th>Prix V total</th></tr>";
                    
                    while($rrow= mysqli_fetch_assoc($rresult)){
                            //echo"<tr><td>".$row["idProduit"]."</td><td>".$row["idClient"]."</td><td>".$row["Quantite"]."</td><td>".$row["DatesContrat"]."</td><td>".$row["PAU"]."</td><td>".$row["PAT"]."</td><td>".$row["PU"]."</td></tr>"; 
                        $rreqSql1= ("SELECT Operation, Quantite, Nom, Source, PAU, PAT, PU, PT FROM Contrat, Produit WHERE (Produit.idProduit = Contrat.idProduit) AND(Operation = ".$rrow["Operation"].") ");
                    //echo"<tr style = 'background-color:blue; color : #fff;'><td>".$row["DatesContrat"]."</td><td>".$row["Operation"]."</td></tr>";
                        $rresult1= mysqli_query($db, $rreqSql1);
                        if(mysqli_num_rows($rresult1)>0){
                            while($rrow1= mysqli_fetch_assoc($rresult1)){
                            //echo"<tr><td>".$row1["Quantite"]."</td><td>".$row1["Nom"]."</td><td>".$row1["Source"]."</td><td>".$row1["PAU"]."</td><td>".$row1["PAT"]."</td><td>".$row1["PU"]."</td><td>".$row1["PT"]."</td>";
                                $paTT += $rrow1["PAT"];
                                $pvTT += $rrow1["PT"];
                                if($rrow1["Source"] == "chez moi"){
                                    $paCM += $rrow1["PAT"];
                                    $pvCM += $rrow1["PT"];
                                }else{
                                    $paCA += $rrow1["PAT"];
                                    $pvCA += $rrow1["PT"];
                                }
                            }
                        }
                }
                echo"<p class='footer'style = 'width : 70%'><b>Total </b>:<br> Prix d achat total : <span>".$paTT." USD </span> ; Prix de vente total : <span>".$pvTT." USD</span>; ce qui nous fait un benefice de : ".$pvTT - $paTT." USD<br>";
                echo"<b>Produit acheté chez moi </b>:<br> Prix d achat total : <span>".$paCM." USD  </span>; Prix de vente total : <span>".$pvCM." USD</span>; ce qui nous fait un benefice de : ".$pvCM - $paCM." USD<br>";
                echo"<b>Produit acheté ailleur </b>:<br> Prix d achat total : <span>".$paCA." USD  </span>; Prix de vente total : <span>".$pvCA." USD</span>; ce qui nous fait un benefice de : ".$pvCA - $paCA." USD<br></p>";
                }else{echo " Pas de contrat";}
                $paTTJ += $paTT;        $pvTTJ += $pvTT;        $bCMJ += $bCM;
                $paCMJ += $paCM;        $pvCMJ += $pvCM;        $bTTJ += $bTT;
                $paCAJ += $paCA;        $pvCAJ += $pvCA;        $bCAJ += $bCA;

                $reqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$rrowI["idClient"].") AND (DatesContrat BETWEEN  '".$dates1."' AND '".$dates2."')  GROUP BY Operation order by Operation DESC ");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                echo"<p class='paragraph'>Client  : <i>".$rrowI["NomClient"]."</i></p>";
                echo "<table id='Customers' style = 'width:90%; margin-left : 5%;'><tr><th>Quantite</th><th>Articles</th><th>Sources</th><th>Prix A unitaire</th><th>Prix A total</th><th>Prix V U</th><th>Prix V total</th></tr>";
                    
                while($row= mysqli_fetch_assoc($result)){
                    //echo"<tr><td>".$row["idProduit"]."</td><td>".$row["idClient"]."</td><td>".$row["Quantite"]."</td><td>".$row["DatesContrat"]."</td><td>".$row["PAU"]."</td><td>".$row["PAT"]."</td><td>".$row["PU"]."</td></tr>"; 
                    $reqSql1= ("SELECT Operation, Quantite, Nom, Source, PAU, PAT, PU, PT FROM Contrat, Produit WHERE (Produit.idProduit = Contrat.idProduit) AND(Operation = ".$row["Operation"].") ");
                    echo"<tr style = 'background-color:gold; color : green;'><td>".$row["DatesContrat"]."</td><td>".$row["Operation"]."</td></tr>";
                    $result1= mysqli_query($db, $reqSql1);
                    if(mysqli_num_rows($result1)>0){
                        while($row1= mysqli_fetch_assoc($result1)){
                            echo"<tr><td>".$row1["Quantite"]."</td><td>".$row1["Nom"]."</td><td>".$row1["Source"]."</td><td>".$row1["PAU"]."</td><td>".$row1["PAT"]."</td><td>".$row1["PU"]."</td><td>".$row1["PT"]."</td>";
                        }
                    }
                }
                echo"</table>";
                }else{echo "<p class = 'paragraph' > Ce client n a pas de contrat . merci!</p> ";}
       
            }
           
            echo"<p class='footer'style = 'width : 70%; background-color: #555;'><b>Total </b>:<br> Prix d achat total : <span>".$paTTJ." USD </span> ; Prix de vente total : <span>".$pvTTJ." USD</span>; ce qui nous fait un benefice de : ".$pvTTJ - $paTTJ." USD<br>";
            echo"<b>Produit acheté chez moi </b>:<br> Prix d achat total : <span>".$paCMJ." USD  </span>; Prix de vente total : <span>".$pvCMJ." USD</span>; ce qui nous fait un benefice de : ".$pvCMJ - $paCMJ." USD<br>";
            echo"<b>Produit acheté ailleur </b>:<br> Prix d achat total : <span>".$paCAJ." USD  </span>; Prix de vente total : <span>".$pvCAJ." USD</span>; ce qui nous fait un benefice de : ".$pvCAJ - $paCAJ." USD<br></p>";
                
        }else{echo " Pas de contrat";}

      

    ?>
    </div><!-- fin affichage de la facture -->
    
    <div class="footer">
        <h2>&copy copyrigth 2022</h2><br>
        franck sefu +243 973359746
    </div>
</body>
</html>