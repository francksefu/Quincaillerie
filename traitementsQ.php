<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>franckapp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
    
    <style>
        p {
            padding: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 24px;
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
<body >
<div  class="header" style="background-color: transparent; ">
        <h1 style="text-shadow: 3px 3px 5px white;color: #000;">Controle et gestion d' entreprise</h1>
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
    <a href="resumeQ.php" >Resume</a>
    
</div>


    <?php

        include 'connexion.php';

        $dates1 = htmlspecialchars($_POST["DatesF1"]);
        $envoie = htmlspecialchars($_POST["Envoie"]);

        $dates21 = htmlspecialchars($_POST["DatesF21"]);
        $dates22 = htmlspecialchars($_POST["DatesF22"]);

        $client = htmlspecialchars($_POST["Client"]);
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
                echo "<p>Montant Total perdu = ".-$montantP."USD <br>";
                echo "Montant Total perdu = ".$montantG."USD <br>";
                echo "La difference entre les deux est donc de : ".$montantG - $montantP." USD </p>";

            }else{echo "Pas des données a cette date la";}
        }
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
                echo"<p> Montant total sortie : ".$montantTot." USD </p>";
            }else{echo "Table vide ... ";}
        }

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
                echo"<p style = 'color : green;'> Montant total de vente : ".$montantTot." USD </p><br><br>";
               /* echo"<table id='Customers'><tr><th>identi</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
                while($row= mysqli_fetch_assoc($result)){

                    echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                    $montantTot += $row["Montant"];
                }
                echo"</table>";
                echo"<p> Montant total sortie : ".$montantTot." USD </p>";*/
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
                //echo"<p style = 'color : green;'> Montant total de vente : ".$montantTot." USD </p>";
               /* echo"<table id='Customers'><tr><th>identi</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
                while($row= mysqli_fetch_assoc($result)){

                   echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                    $montantTot += $row["Montant"];
                }
                echo"</table>";
                echo"<p> Montant total sortie : ".$montantTot." USD </p>";*/
            }else{echo "Table vide ... ";}
        }

        function ventesTT($reqmere, $reqmere2, $detteV){
            include 'connexion.php';

            $montantTot;

            $result= mysqli_query($db, $reqmere);
            $result2 = mysqli_query($db, $reqmere2);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>Articles</th><th>Quantite vendu </th><th>Prix Unitaire</th><th>Prix total </th></tr>";
                
                while($row= mysqli_fetch_assoc($result)){
                    echo"<tr style = 'background-color:gold; color : green;'><td>".$row["DatesVente"]."</td></tr>";
                    
                    $reqfille = ("SELECT Nom, QuantiteVendu, PU, PT, QuantiteStock FROM Ventes, Produit WHERE (DatesVente = '".$row["DatesVente"]."' and (Ventes.Dette = '".$detteV."')) and (Ventes.idProduit = Produit.idProduit)");
                    $resultf= mysqli_query($db, $reqfille);
                    if(mysqli_num_rows($resultf)>0){
                       
                        while($rowf= mysqli_fetch_assoc($resultf)){
                            echo"<tr><td>".$rowf["Nom"]."</td><td>".$rowf["QuantiteVendu"]."</td><td>".$rowf["PU"]."</td><td>".$rowf["PT"]."</td></tr>"; 
                            $montantTot += ($rowf["PT"]);
                   
                        }
                    }
                }
                echo"</table>";
                echo"<p style = 'color : green;'> Montant total de vente : ".$montantTot." USD </p><br><br>";
               /* echo"<table id='Customers'><tr><th>identi</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
                while($row= mysqli_fetch_assoc($result)){

                    echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                    $montantTot += $row["Montant"];
                }
                echo"</table>";
                echo"<p> Montant total sortie : ".$montantTot." USD </p>";*/
            }else{echo "Table vide ... ";}

            if(mysqli_num_rows($result2)>0){
                echo"<table id='Customers'><tr><th style ='background-color:yellow; color: #000;'>Articles</th><th style ='background-color:yellow; color: #000;'>Quantite vendu </th><th style ='background-color:yellow; color: #000;'>QuantiteStock actuel</th></tr>";
                $nombre;
                while($row2= mysqli_fetch_assoc($result2)){
                    //echo"<tr style = 'background-color:gold; color : green;'><td>".$row2["DatesVente"]."</td></tr>";
                    $nombre = 0;
                    $reqfille2 = ("SELECT Nom, QuantiteVendu, PU, PT, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente = '".$row2["DatesVente"]."'and (Ventes.Dette = '".$detteV."')) and (Ventes.idProduit = '".$row2["idProduit"]."'))and (Ventes.idProduit = Produit.idProduit)");
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
                //echo"<p style = 'color : green;'> Montant total de vente : ".$montantTot." USD </p>";
               /* echo"<table id='Customers'><tr><th>identi</th><th>Type </th><th>Montant </th><th>Motif </th><th>DatesD</th></tr>";
                while($row= mysqli_fetch_assoc($result)){

                   echo"<tr><td>".$row["idSortie"]."</td><td>".$row["TypeD"]."</td><td>".$row["Montant"]."</td><td>".$row["il_pris_quoi"]."</td><td>".$row["DatesD"]."</td></tr>"; 
                    $montantTot += $row["Montant"];
                }
                echo"</table>";
                echo"<p> Montant total sortie : ".$montantTot." USD </p>";*/
            }else{echo "Table vide ... ";}
        }

        if($envoie == "Toutes les ventes affichage tableau"){
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE (DatesVente = '".$dates1."') GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE (DatesVente = '".$dates1."')and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesT($reqmere, $reqmere2);
        }
        if($envoie == "Les ventes payé cache affichage tableau"){
            $detteV = "Non";
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE ((DatesVente = '".$dates1."') and (Dette = 'Non')) GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente = '".$dates1."') and (Dette = 'Non'))and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesTT($reqmere, $reqmere2, $detteV);
        }
        if($envoie == "Toutes les ventes accordé en dette affichage tableau"){
            $detteV = "Oui";
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE ((DatesVente = '".$dates1."') and (Dette = 'Oui')) GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente = '".$dates1."') and (Dette = 'Oui'))and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesTT($reqmere, $reqmere2, $detteV);
        }


        if($envoie == "Vos bonus"){
            
            $reqBonusP= ("SELECT `idBonusPerte`,`Nom`,`PrixVente`, `QuantiteGagne`, `QuantitePerdu`,QuantiteStock, `Motif`, `DatesD`  FROM Produit ,BonusPerte  WHERE (BonusPerte.idProduit=Produit.idProduit) AND(DatesD = '".$dates1."' ) ");
            bonus($reqBonusP);

        }

        if($envoie == "Toutes les sortie"){
           
            
            
            $reqSortie= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD = '".$dates1."')");
            sortie($reqSortie);
            
        }

        if($envoie == "Les sortie triées par dettes"){
            
            $reqSortieDette= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD = '".$dates1."') AND (TypeD = 'Dette')");
            sortie($reqSortieDette);
            
        }

        if($envoie == "Les sortie triées par depense"){
            
            $reqDepense= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD = '".$dates1."') AND (TypeD = 'Depense')");
            sortie($reqDepense);
            
        }

        if($envoie == "Les sortie triées par charge"){
            
            $reqCharge= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD = '".$dates1."') AND (TypeD = 'Charge')");
            sortie($reqCharge);
            
        }

        if($envoie == "Les sortie inutile"){
            
            
            $reqInutile= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD = '".$dates1."') AND (TypeD = 'Aucun')");
            sortie($reqInutile);
        
        }
        if($envoie == "Dette de l entreprise 1"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (DatesD = '".$dates1."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "Une erreur s est produite ";}
        }
       
        if($envoie == "Dette de l entreprise pris en materiel  1"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (TypeD = 'Materiel') AND (DatesD = '".$dates1."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "Une erreur s est produite ";}
        }   

        if($envoie == "Dette de l entreprise pris en argent  1"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (TypeD = 'Argent') AND (DatesD = '".$dates1."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "Une erreur s est produite ";}
        }   




        if($envoie == "Vos bonus 2"){
            
            $reqBonusP2= ("SELECT `idBonusPerte`,`Nom`,`PrixVente`, `QuantiteGagne`, `QuantitePerdu`,QuantiteStock, `Motif`, `DatesD`  FROM Produit ,BonusPerte  WHERE (BonusPerte.idProduit=Produit.idProduit) AND(DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
            bonus($reqBonusP2);

        }

        if($envoie == "Toutes les sortie 2"){
            
            $reqSortie2= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."')");
            sortie($reqSortie2);
            
        }

        if($envoie == "Les sortie triées par dettes 2"){
           
            $reqSortie= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') AND (TypeD = 'Dette')");
            sortie($reqSortie);
           
        }

        if($envoie == "Les sortie triées par depense 2"){
            
            
            $reqSql= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') AND (TypeD = 'Depense')");
            sortie($reqSql);
            
        }

        if($envoie == "Les sortie triées par charge 2"){
            
            $reqSql= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') AND (TypeD = 'Charge')");

            sortie($reqSql);
        }

        if($envoie == "Les sortie inutile 2"){
           
            $reqSql= ("SELECT idSortie,TypeD,  Montant,il_pris_quoi, DatesD FROM Sortie WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') AND (TypeD = 'Aucun')");
            sortie($reqSql);
        }
        if($envoie == "Dette de l entreprise 2"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "Pas des données a cette date ";}
        }
       
        if($envoie == "Dette de l entreprise pris en materiel  2"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (TypeD = 'Materiel') AND (DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "pas des données  a cette date ";}
        }   

        if($envoie == "Dette de l entreprise pris en argent  2"){
            $valeu;
            $montant;
            $rest;

            $reqSql= ("SELECT idDette,TypeD, ValeurDette, MontantPaye, Reste,il_pris_quoi, DatesD,DatesRNew  FROM DetteEntreprise WHERE (TypeD = 'Argent') AND (DatesD BETWEEN '".$dates21."' AND '".$dates22."') ");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                echo"<table id='Customers'><tr><th>identifiant</th><th>Type </th><th>Valeur Dette</th><th>Montant PayE</th><th>Reste</th><th>DatesD</th><th>Dates de remboursement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    $valeu += $row["ValeurDette"];
                    $montant += $row["MontantPaye"];
                    $rest += $row["Reste"];

                        echo"<tr><td>".$row["idDette"]."</td><td>".$row["TypeD"]."</td><td>".$row["ValeurDette"]."</td><td>".$row["MontantPaye"]."</td><td>".$row["Reste"]."</td><td>".$row["DatesD"]."</td><td>".$row["DatesRNew"]."</td></tr>"; 
                }
                echo"</table>";
                echo"<p>Valeur Total de toutes les dettes : ".$valeu." USD <br>";
                echo "Montant Total deja payé : ".$montant." USD<br>";
                echo "Reste total : ".$rest." USD<br></p>";
            }else{echo "Pas des données a cette date ";}
        } 
        
        if($envoie == "Toutes les ventes 2 affichage tableau"){
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE (DatesVente BETWEEN '".$dates21."' AND '".$dates22."') GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE (DatesVente BETWEEN '".$dates21."' AND '".$dates22."')and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesT($reqmere, $reqmere2);
        }
        if($envoie == "Les ventes payé cache 2 affichage tableau"){
            $detteV = "Non";
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE ((DatesVente BETWEEN '".$dates21."' AND '".$dates22."') and (Dette = 'Non')) GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente BETWEEN '".$dates21."' AND '".$dates22."') and (Dette = 'Non'))and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesTT($reqmere, $reqmere2, $detteV);
        }
        if($envoie == "Toutes les ventes accordé en dette 2 affichage tableau"){
            $detteV = "Oui";
            $reqmere = ("SELECT DatesVente FROM Ventes WHERE ((DatesVente BETWEEN '".$dates21."' AND '".$dates22."') and (Dette = 'Oui')) GROUP BY DatesVente");
            $reqmere2 = ("SELECT DatesVente, Ventes.idProduit, Nom, QuantiteStock FROM Ventes, Produit WHERE ((DatesVente BETWEEN '".$dates21."' AND '".$dates22."') and (Dette = 'Oui'))and (Produit.idProduit = Ventes.idProduit) GROUP BY idProduit");
            ventesTT($reqmere, $reqmere2, $detteV);
        }
        
        
    ?>
    <div class="footer" style="color:#000;">
        <h2>&copy copyrigth 2022</h2>
        <p>franck sefu +243 973359746</p>
    </div>
</body>
</html>