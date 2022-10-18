<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>francksfApp</title>
    <link rel="stylesheet" href="facture.css" media = "screen" type="text/css"/>
    <style>

        input[type=submit]{
            width: 30%;
            background-color: #555;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 20px;
        }
        input[type = submit]:hover{
            background-color: yellowgreen;
        }
        a{
            display: block;
            color: #fff;
            padding: 14px 8px;
            text-decoration: none;
            width: 30%;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            border-radius: 20px;
            background-color: #555;
            margin-left: 65%;
            margin-top: 5%;
            text-align: center;

        }
        a:hover{
            background-color: yellowgreen;
            color: white;
            border-radius: 20px;
        }
        div{
            font-family: Arial, Helvetica, sans-serif;
        }
        p{
            width: 30%;
            height: auto;
            border: 1px solid #555;
            padding: auto;
            margin-left: 15%;
            margin-top: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div style="border:0px solid black;"><!--  Debut requette pour l affichage de la facture -->
    <?php 
        include 'connexion.php';
        include 'PaiementsC.php';
        $type = htmlspecialchars($_POST["type"]);
        $operation;
        if($type == "nouvelVente"){
            $sql = ("SELECT Operation FROM Ventes ORDER BY idVentes DESC limit 1");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $operation = $row["Operation"]+1;
                }
                            
            }else{$operation = 100000;}
        }
        if($type == "modifVente"){
            $operation = $_POST["operation"];
            $sql = "DELETE FROM Paiements WHERE Operation = ".$operation."";
            if($db->query($sql) === TRUE){
                echo"";
            }else{
                echo"erreur modification".$db->error;
            }
        }
      
       $datesPaie = $_POST["DatesPaie"];

       
        
        $idPaie0 = htmlspecialchars($_POST["idPaie0"]); $idPaie1 = htmlspecialchars($_POST["idPaie1"]); $idPaie2 = htmlspecialchars($_POST["idPaie2"]); $idPaie3 = htmlspecialchars($_POST["idPaie3"]); $idPaie4 = htmlspecialchars($_POST["idPaie4"]); $idPaie5 = htmlspecialchars($_POST["idPaie5"]); $idPaie6 = htmlspecialchars($_POST["idPaie6"]); $idPaie7 = htmlspecialchars($_POST["idPaie7"]); $idPaie8 = htmlspecialchars($_POST["idPaie8"]);
        $idPaie9 = htmlspecialchars($_POST["idPaie9"]); $idPaie10 = htmlspecialchars($_POST["idPaie10"]); $idPaie11 = htmlspecialchars($_POST["idPaie11"]); $idPaie12 = htmlspecialchars($_POST["idPaie12"]); $idPaie13 = htmlspecialchars($_POST["idPaie13"]); $idPaie14 = htmlspecialchars($_POST["idPaie14"]); $idPaie15 = htmlspecialchars($_POST["idPaie15"]); $idPaie16 = htmlspecialchars($_POST["idPaie16"]);
        $idPaie17 = htmlspecialchars($_POST["idPaie17"]); $idPaie18 = htmlspecialchars($_POST["idPaie18"]); $idPaie19 = htmlspecialchars($_POST["idPaie19"]); $idPaie20 = htmlspecialchars($_POST["idPaie20"]);

        $montant0 = htmlspecialchars($_POST["Montant0"]); $montant1 = htmlspecialchars($_POST["Montant1"]); $montant2 = htmlspecialchars($_POST["Montant2"]); $montant3 = htmlspecialchars($_POST["Montant3"]); $montant4 = htmlspecialchars($_POST["Montant4"]); $montant5 = htmlspecialchars($_POST["Montant5"]); $montant6 = htmlspecialchars($_POST["Montant6"]); $montant7 = htmlspecialchars($_POST["Montant7"]); $montant8 = htmlspecialchars($_POST["Montant8"]);
        $montant9 = htmlspecialchars($_POST["Montant9"]); $montant10 = htmlspecialchars($_POST["Montant10"]); $montant11 = htmlspecialchars($_POST["Montant11"]); $montant12 = htmlspecialchars($_POST["Montant12"]); $montant13 = htmlspecialchars($_POST["Montant13"]); $montant14 = htmlspecialchars($_POST["Montant14"]); $montant15 = htmlspecialchars($_POST["Montant15"]); $montant16 = htmlspecialchars($_POST["Montant16"]); $montant17 = htmlspecialchars($_POST["Montant17"]);
        $montant18 = htmlspecialchars($_POST["Montant18"]); $montant19 = htmlspecialchars($_POST["Montant19"]); $montant20 = htmlspecialchars($_POST["Montant20"]);
        //$identP0; $identP1; $identP2; $identP3; $identP4; $identP5; $identP6; $identP7; $identP8; $identP9; $identP10; $identP11; $identP12; $identP13; $identP14; $identP15; $identP16; $identP17; $identP18; $identP19; $identP20; 
        
        //$tableau = explode(":",$idproduit0);
               // $idproduit = $tableau[0];

        //echo $operation." dateV :".$datesV."nomClinet :".$nomClient."dette :".$dette."  produit0 : ".$idproduit0." quant :".$quantite0."prix :".$prixU0."  Nom du produit 1 : ";

        $cacher = htmlspecialchars($_POST["cacher"]);
        if($cacher == "ModifPaie"){
            $operation = htmlspecialchars($_POST["Operation"]);
            $datesPaie = htmlspecialchars($_POST["DatesP"]);
            $montant0 = htmlspecialchars($_POST["Montant"]);
            

            $sqlP = ("SELECT*FROM Ventes,Client WHERE(Ventes.idClient = Client.idClient) AND (Operation = '".$operation."')GROUP BY Operation");
            $resultP = mysqli_query($db, $sqlP);
                    
            if(mysqli_num_rows($resultP)>0){
                                
                while($rowP= mysqli_fetch_assoc($resultP)){
                    $idPaie0 = "numero = :".$rowP["Operation"].": date : ".$rowP["DatesVente"]." : nom = :".$rowP["NomClient"].": facture :".$rowP["TotalFacture"].":USD idClient :".$rowP["idClient"].": paye :".$rowP["MontantPaye"].": USD Reste a payer : ".$rowP["TotalFacture"] -$rowP["MontantPaye"];
                }
                        
            }else{echo "Une erreur s est produite ";} 
        }
        
        function insereur($idPaiem, $montant, $datesPaiem)
        {
            $cacher = htmlspecialchars($_POST["cacher"]);
            
            if(empty($idPaiem)){
                echo "";
            }else{
                $tableau = explode(":",$idPaiem);
                $operat = $tableau[1]*1;
                
                
                $ClassPaie = new PaiementsC($datesPaiem, $montant, $operat);
                if($cacher == "ModifPaie"){
                    $idPaiement = htmlspecialchars($_POST["idPaiements"]);
                    $ClassPaie->set_idPaiements($idPaiement);
                    $ClassPaie->supprimer();
                    
                }
                $ClassPaie->inserePaiement();
                
                
                $ClassPaie->misAjourPaiement();
                if($ClassPaie->tot >= $ClassPaie->mont){
                    afficheur($idPaiem);
                }else{echo"Facture deja payer... impossible d encasser ce paiement";}
                //echo $operatio." dateV :".$datesV."nomClinet :".$idClient."dette :".$dettes."  produit0 : ".$idproduit." quant :".$quantite."prix :".$prixU."  Nom du produit 1 : ";
                echo "";
            }
        }
        insereur($idPaie0, $montant0, $datesPaie);
        insereur($idPaie1, $montant1, $datesPaie);
        insereur($idPaie2, $montant2, $datesPaie);
        insereur($idPaie3, $montant3, $datesPaie);
        insereur($idPaie4, $montant4, $datesPaie);
        insereur($idPaie5, $montant5, $datesPaie);
        insereur($idPaie6, $montant6, $datesPaie);
        insereur($idPaie7, $montant7, $datesPaie);
        insereur($idPaie8, $montant8, $datesPaie);
        insereur($idPaie9, $montant9, $datesPaie);

        insereur($idPaie10, $montant10, $datesPaie);
        insereur($idPaie11, $montant11, $datesPaie);
        insereur($idPaie12, $montant12, $datesPaie);
        insereur($idPaie13, $montant13, $datesPaie);
        insereur($idPaie14, $montant14, $datesPaie);
        insereur($idPaie15, $montant15, $datesPaie);
        insereur($idPaie16, $montant16, $datesPaie);
        insereur($idPaie17, $montant17, $datesPaie);
        insereur($idPaie18, $montant18, $datesPaie);
        insereur($idPaie19, $montant19, $datesPaie);
        insereur($idPaie20, $montant20, $datesPaie);
        function afficheur($idPaie){
            
                include 'connexion.php';
                $conteneur = explode(":", $idPaie);
                $operation = $conteneur[1]*1;
                $nomClient = $conteneur[5];
                $date = $conteneur[3];
                $calculpvt = 0;
                $dette;

                $reqVerif = ("SELECT MontantPaye, TotalFacture FROM Produit, Ventes WHERE (Ventes.Operation = ".$operation.") AND (Produit.idProduit=Ventes.idProduit)");
                $resultV = mysqli_query($db, $reqVerif);
                if(mysqli_num_rows($resultV)>0){
                    while($rowV= mysqli_fetch_assoc($resultV)){
                        $montantPaye = $rowV["MontantPaye"];
                        $totalFacture = $rowV["TotalFacture"];
                        if($montantPaye == $totalFacture){
                            $dette = "payé";
                            $sql1 = ("UPDATE Ventes SET Dette = '".$dette."' WHERE Operation =".$operation." ");
                            if($db->query($sql1)===TRUE){
                                echo"";
                            }else{
                                "Echec de mise a jour :".$db->error;
                            }
                        }else{ $dette = "Oui";}
                        
                    }
                }

                $reqSql = ("SELECT Nom, QuantiteVendu, PU, PT FROM Produit, Ventes WHERE (Ventes.Operation = ".$operation.") AND (Produit.idProduit=Ventes.idProduit)");
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
                    }
                    echo"</table>";
                    echo"<h2>Total general : <span style='margin-left:20%'>".$calculpvt." USD</span></h2>";
                    echo "</div>";
                    $reqPaie = ("SELECT*FROM Paiements WHERE Operation = '".$operation."'");
                    $resultPaie = mysqli_query($db, $reqPaie);
                    if(mysqli_num_rows($result)>0){
                        $totMontant;
                        echo"<div style = 'border:0px solid black; margin-left : 60px; font-size:18px; padding:auto;'>";
                        echo"<p>";
                        echo "<h2>Les paiements</h2><br><br>";
                        while($row2 = mysqli_fetch_assoc($resultPaie)){
                            echo $row2["idPaiements"]." dates : ".$row2["DatesPaie"]." -> ".$row2["Montant"]." USD<br>";
                            $totMontant += $row2["Montant"];

                        }
                        echo"<br> <span style = 'color:white;background-color :green;'>Total paiement : ".$totMontant." USD</span> <br> ";
                        echo"<span style = 'color:white;background-color :green;'>Reste a payer : ".$calculpvt - $totMontant." USD </span><br>";
                        echo"</p>";
                        echo"</div>";
                    }
                }else{echo "Impossible de generer cette facture ";}
          

            
        }
       

    ?>
    </div><!-- fin affichage de la facture -->
    
        
        <a href="paiementQ.php" style="text-decoration: none;color:#fff;">Nouveau paiement</a>
    </div>
    
</body>
</html>