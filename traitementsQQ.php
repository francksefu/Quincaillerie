<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>franckapp</title>
    <!--<link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />-->
    <link rel="stylesheet" href="facture.css" media = "screen" type="text/css"/>
    <style>
        p {
            padding: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            border-radius: 10px;
            margin-bottom:10px;
            text-align: center;
            border: 1px solid black;
            width: 60%;
            color: red;
            margin-bottom: 3%;
            margin-left: 5%;
        }
        @media screen and (max-width: 600px){
            .fact{width: 100%;}
        }
        .header{
    background-color: #f1f1f1;
    padding: 14px;
    text-align: center; 
   
}
#Customers{
    
    border-collapse: collapse;
    width: 100%;
    
}
#Customers td, #Customers th{
    border: 1px solid #ddd;
    padding: 8px;
}
#Customers tr:nth-child(even){background-color: #f2f2f2;}
#Customers tr:hover{ background-color: #ddd;}
 th{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: yellowgreen;
    color: white;
    position:-webkit-sticky;
    position: sticky;
    top: 0;
}

.footer{
    background-color: #f1f1f1;
    padding: 7px;
    text-align: center;
    width: 60%;
    border-radius: 20px;
    margin: auto;
    position: -webkit-sticky;
    position: sticky;
    bottom: 0;
    left: 20%;
}
.topnav{
    overflow: hidden;
    background-color: #333;
}
.topnav a{
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
.region{
    height: 20px;

}
.topnav a:hover {
    background-color: #ddd;
    color: black;
    border-radius: 50%;
}
</style>
</head>
<body>
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #000;">Controle et gestion d' entreprise</h1>
    </div>

<div class="topnav">
    <a href="">Accueil</a>
    <a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
    
</div>


    <?php
    /* 
    les requetes sur une et 2 dates concernant tout ce qui doit s afficher comme facture est ici , remarquez le css
    les requete ont ete tournee de tel sorte qu elle respecte les designe des factures. Mais fallait penser a l utilisation des 
    fonction pour eviter les DRY (don t repeat your self) donc je vais utiliser des fonctions c est mieux ... analyser 600 lignes de code 
    lorqu il y panne c est ne pas facile ... donc arrangeons ca...
    */

        include 'connexion.php';

        $dates1 = htmlspecialchars($_POST["DatesF1"]);
        $envoie = htmlspecialchars($_POST["Envoie"]);

        $dates21 = htmlspecialchars($_POST["DatesF21"]);
        $dates22 = htmlspecialchars($_POST["DatesF22"]);
// nous ne recevons que de chiffre ici mdrrr je suis fort !!!c est au moment de revenir dans le code que l on sen l ingeniosite
        $client = htmlspecialchars($_POST["Client"]);
        $NomC = htmlspecialchars($_POST["NomC"]);

        function ventes ($reqinfo){
            include 'connexion.php';
            $totFacture;
            $reste;
            $totMontantP;
            
            $resultinfo = mysqli_query($db, $reqinfo);
            if(mysqli_num_rows($resultinfo) > 0){
                while ($rowinfo = mysqli_fetch_assoc($resultinfo)){

                    
                    $reqSql = ("SELECT Nom, QuantiteVendu, PU, PT FROM Produit, Ventes WHERE (Ventes.Operation = '".$rowinfo["Operation"]."') AND (Produit.idProduit=Ventes.idProduit)");
                    $result= mysqli_query($db, $reqSql);
                    echo"<div class ='fact' style = 'margin-left:5%; width:60%; margin-top:3%;'>";
                    echo "<div class='cadreint'>dette : ".$rowinfo["Dette"]."</div>";
                    echo"<h1>Facture</h1><br>";
                    echo"<h2>Numero : ".$rowinfo["Operation"]."</h2><br>";
                    echo" <h2>Goma le,".$rowinfo["DatesVente"]."</h2><br>";
                    echo"<h2>Mr, Mme :<span style:'border-bottom:dotted;'><i>".$rowinfo["NomClient"]." </i>doit :</span></h2><br>";

                    if(mysqli_num_rows($result)>0){
                        echo"<table id='customers'><tr><th style = 'background-color:#555;'>Qtite</th><th style = 'background-color:#555;'>Articles </th><th style = 'background-color:#555;'>     PU      </th><th style = 'background-color:#555;'>PT </th></tr>";
                        while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["QuantiteVendu"]."</td><td>".$row["Nom"]."</td><td>".$row["PU"]."</td><td>".$row["PT"]."</td></tr>"; 
                            $cal = $row["QuantiteVendu"]*$row["PU"];
                             
                        }
                        echo"</table>";
                        echo"<h2>Total general : <span style='margin-left:20%'>".$rowinfo["TotalFacture"]." USD</span></h2>";
                        echo "</div>";
                        if($rowinfo["MontantPaye"] == "")
                        { 
                            echo "";
                            $totFacture += $rowinfo["TotalFacture"];
                            
                        }else{
                             echo "<p>Reste sur facture : ".$rowinfo["TotalFacture"] - $rowinfo["MontantPaye"]." USD </p>";
                             $totFacture += $rowinfo["TotalFacture"];
                             $reste += $rowinfo["TotalFacture"] - $rowinfo["MontantPaye"];
                        }
                    }else{echo "Impossible de generer cette facture ";}
              
                    

                }
                echo"<p style = 'color : black; font-size: 25px; margin-top:20px;'>Total de toutes les factures : ".$totFacture." USD <br>";
                echo"Total montant deja payé : ".$totFacture - $reste." USD <br>";
                echo "Total reste a payer :<span style = 'color : red;'> ".$reste." USD</span> <br></p>";
            }else{echo "Pas des données";}

        }

        function clientVentes($reqinfo){
            include 'connexion.php';

            $totFactureC;
            $resteC = 0;
            $totMontantPC;

            $resultinfo = mysqli_query($db, $reqinfo);
            if(mysqli_num_rows($resultinfo) > 0){
                while ($rowinfo = mysqli_fetch_assoc($resultinfo)){

                    
                    $reqSql = ("SELECT Nom, QuantiteVendu, PU, PT FROM Produit, Ventes WHERE (Ventes.Operation = '".$rowinfo["Operation"]."') AND (Produit.idProduit=Ventes.idProduit)");
                    $result= mysqli_query($db, $reqSql);
                    echo"<div class ='fact' style = 'margin-left:5%; width:60%; margin-top:3%;'>";
                    echo "<div class='cadreint'>dette : ".$rowinfo["Dette"]."</div>";
                    echo"<h1>Facture</h1><br>";
                    echo"<h2>Numero : ".$rowinfo["Operation"]."</h2><br>";
                    echo" <h2>Goma le,".$rowinfo["DatesVente"]."</h2><br>";
                    echo"<h2>Mr, Mme :<span style:'border-bottom:dotted;'><i>".$rowinfo["NomClient"]." </i>doit :</span></h2><br>";

                    if(mysqli_num_rows($result)>0){
                        echo"<table id='customers'><tr><th style = 'background-color:#555;'>Qtite</th><th style = 'background-color:#555;'>Articles </th><th style = 'background-color:#555;'>     PU      </th><th style = 'background-color:#555;'>PT </th></tr>";
                        while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["QuantiteVendu"]."</td><td>".$row["Nom"]."</td><td>".$row["PU"]."</td><td>".$row["PT"]."</td></tr>"; 
                            $cal = $row["QuantiteVendu"]*$row["PU"];
                             
                        }
                        echo"</table>";
                        echo"<h2>Total general : <span style='margin-left:20%'>".$rowinfo["TotalFacture"]." USD</span></h2>";
                        echo "</div>";
                        if($rowinfo["MontantPaye"] == "")
                        { 
                            echo "";
                            $totFactureC += $rowinfo["TotalFacture"];
                            
                        }else{
                             echo "<p>Reste sur facture : ".$rowinfo["TotalFacture"] - $rowinfo["MontantPaye"]." USD </p>";
                             $totFactureC += $rowinfo["TotalFacture"];
                             $resteC += $rowinfo["TotalFacture"] - $rowinfo["MontantPaye"];
                        }
                    }else{echo "Impossible de generer cette facture ";}
             
                    

                }
                echo"<p style = 'color : black; font-size: 25px; margin-top:20px;'>Total de toutes les factures : ".$totFactureC." USD <br>";
                echo"Total montant deja payé : ".$totFactureC - $resteC." USD <br>";
                echo "Total reste a payer :<span style = 'color : red;'> ".$resteC." USD</span> <br></p>";
            }else{echo "Pas des données";}
        }

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
                echo"<p style = 'color : green; font-size: 25px; margin-top:20px;'>Total de toutes les factures : ".$totFact." USD <br></p>";
            }else{echo"Pas d approvisionnement a cette date";}
            
        }
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
            }else{echo "Impossible de generer cette facture ";}
      

        
    }
    function paiements($reqinfo){
        include 'connexion.php';
        
            
        $resultinfo = mysqli_query($db, $reqinfo);
        if(mysqli_num_rows($resultinfo) > 0){
            while ($rowinfo = mysqli_fetch_assoc($resultinfo)){
                afficheur($rowinfo["Operation"],$rowinfo["NomClient"],$rowinfo["DatesVente"],$rowinfo["Dette"]);
                   
            }
               
        }else{echo "Pas des données";}

     
    }    

        

        if($envoie == "Toutes les ventes"){
            
            $reqtoutVente = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente = '".$dates1."')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqtoutVente);
            

           
        }
// fin de ce qui precede comme requete ... tout est bon jusque la ....

        if($envoie == "Les ventes payé cache"){
            
            $reqventePaie = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente = '".$dates1."') AND (Ventes.Dette != 'Oui')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqventePaie);
            
        }

        if($envoie == "Toutes les ventes accordé en dette"){
            
            $reqventeDette = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente = '".$dates1."') AND (Ventes.Dette = 'Oui') AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqventeDette);

        }
        //approvisionnement
        if($envoie == "les approvisionnement"){
            
            $reqApprov = ("SELECT Nom, QuantiteApprov, PrixA,Operation, TotalFacture FROM Produit, Approvisionnement WHERE (Approvisionnement.DatesApprov = '".$dates1."') AND (Produit.idProduit=Approvisionnement.idProduit) GROUP by Operation");
            approvisionnement($reqApprov);

        }
        //clients
        if($envoie == "Toutes les factures du client"){
            
            $reqclientToutes = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.idClient = '".$client."')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            clientVentes($reqclientToutes);

        }
        //clients
        if($envoie == "Toutes les dettes du clients reglé et non reglé et ses paiements"){
            
            $reqclientNondette = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE(Ventes.Dette != 'Non')AND (Ventes.idClient = '".$client."') AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            clientVentes($reqclientNondette);
        }
        //clients
        if($envoie == "Toutes factures du client non réglé"){
            
            $reqClientDette = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE(Ventes.Dette = 'Oui')AND (Ventes.idClient = '".$client."') AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            clientVentes($reqClientDette);
        }
      //clients
      if($envoie == "Voir le contrat du client"){
        $rreqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$client.") GROUP BY Operation order by Operation DESC ");
        $rresult= mysqli_query($db, $rreqSql);
        if(mysqli_num_rows($rresult)>0){
                
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
            echo"<p style = 'width : 70%; color: black;'><b>Total </b>:<br> Prix d achat total : <span >".$paTT." USD </span> ; Prix de vente total : <span style = 'color: green;'>".$pvTT." USD</span>; ce qui nous fait un benefice de :<span style = 'color: green;'>".$pvTT - $paTT." USD</span><br>";
            echo"<b style = 'color: green;'>Produit acheté chez moi </b>:<br> Prix d achat total : <span style = 'color: green;'>".$paCM." USD  </span>; Prix de vente total : <span style = 'color: green;'>".$pvCM." USD</span>; ce qui nous fait un benefice de : <span style = 'color: green;'>".$pvCM - $paCM." USD</span><br>";
            echo"<b style = 'color: green;'>Produit acheté ailleur </b>:<br> Prix d achat total : <span style = 'color:green'>".$paCA." USD  </span>; Prix de vente total : <span style = 'color:green'>".$pvCA." USD</span>; ce qui nous fait un benefice de :<span style = 'color: green;'>".$pvCA - $paCA." USD</span><br></p>";
        }else{echo "Une erreur s est produite ";}

        $reqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$client.") GROUP BY Operation order by Operation DESC ");
        $result= mysqli_query($db, $reqSql);
        if(mysqli_num_rows($result)>0){
            echo"<p style = 'color: #000;'>Client  : <i>".$NomC."</i></p>";
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
        }else{echo "Pas de contrat existant pour ce client ";}
    


      }
    //ventes
        if($envoie == "Toutes les ventes 2"){
            
            $reqventes2 = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$dates21."' AND '".$dates22."')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqventes2);

        }

        if($envoie == "Les ventes payé cache 2"){
            
            $reqventePaie2 = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$dates21."' AND '".$dates22."') AND (Ventes.Dette != 'Oui')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqventePaie2);
  
        }

        if($envoie == "Toutes les ventes accordé en dette 2"){
            
            $reqventeDette2 = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$dates21."' AND '".$dates22."') AND (Ventes.Dette = 'Oui') AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
            ventes($reqventeDette2);

        }

        if($envoie == "les approvisionnement 2"){
            
            $reqApprov2 = ("SELECT Nom, QuantiteApprov, PrixA,Operation, TotalFacture FROM Produit, Approvisionnement WHERE (Approvisionnement.DatesApprov BETWEEN '".$dates21."' AND '".$dates22."') AND (Produit.idProduit=Approvisionnement.idProduit) GROUP by Operation");
            approvisionnement($reqApprov2);
           
        }

        

        if($envoie == "les paiements"){
            $re = ("SELECT Operation, Dette, NomClient, DatesVente, TotalFacture, MontantPaye FROM Client, Ventes WHERE (Ventes.DatesVente = '".$dates1."')  AND (Client.idClient=Ventes.idClient) GROUP BY Operation");
             paiements($re);
         }
         if($envoie == "les paiements 2"){
            $reqPaie = ("SELECT Operation, DatesVente, NomClient, Dette FROM Client, Ventes WHERE (Ventes.DatesVente BETWEEN '".$dates21."' AND '".$dates22."')  AND (Client.idClient=Ventes.idClient)AND(Dette != 'Non') GROUP BY Operation");
             paiements($reqPaie);
         }
    ?>

<div class="footer">
        <h2>&copy copyrigth 2022</h2>
        <p style="border: none; color : black; margin: auto;">franck sefu +243 973359746</p>
</div>
</body>
</html>