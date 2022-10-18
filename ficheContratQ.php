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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>francksfApp</title>
    <link rel="stylesheet" href="formulaire.css" media = "screen" type="text/css"/>
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
        p{
            font-size: 20px;
            border: 1px solid black;
            border-radius: 20px;
            padding: 10px;
            width: 30%;
            margin: 30px;
            background-color: #fff;
        }
        html{
            background: url(imageVend.png);
            background-size: cover;
        }
        tr{
            background-color:#fff;
        }
        span{
            color: goldenrod;
        }
    </style>
</head>
<body>
    <div style="border:0px solid black;"><!--  Debut requette pour l affichage de la facture -->
    <?php
    //Nous commencons le processus de fabrication d un contrat
        include 'connexion.php';
        include 'contratC.php';
        //include 'ClientC.php';
        $type = htmlspecialchars($_POST["type"]);
        $operation;
        // ici c est si le contrat est nouveau, genre il y a jamais eu de contrat
        if($type == "nouvelVente"){
            $sql = ("SELECT Operation, idContrat FROM Contrat ORDER BY idContrat DESC limit 1");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $operation = 500000 + $row["idContrat"];
                }
                            
            }else{$operation = 500000;}
        }
        // cette section  nous permet , en cas de modification de la facture, de supprimer ce qui existais 

        if($type == "modifVente"){
            $operation = $_POST["Operation"];
            $sql = "DELETE FROM Contrat WHERE Operation = ".$operation."";
            if($db->query($sql) === TRUE){
                echo"";
            }else{
                echo"erreur modification".$db->error;
            }
        }

      
       $datesCont = htmlspecialchars($_POST["DatesCon"]);
        
        $nomClient = htmlspecialchars($_POST["Client"]);
        
        // ici nous gerons le cas ou il y a eu creation de client dans le formulaire de vente 
        
        
        $idproduit0 = htmlspecialchars($_POST["idProduit0"]); $idproduit1 = htmlspecialchars($_POST["idProduit1"]); $idproduit2 = htmlspecialchars($_POST["idProduit2"]); $idproduit3 = htmlspecialchars($_POST["idProduit3"]); $idproduit4 = htmlspecialchars($_POST["idProduit4"]); $idproduit5 = htmlspecialchars($_POST["idProduit5"]); $idproduit6 = htmlspecialchars($_POST["idProduit6"]); $idproduit7 = htmlspecialchars($_POST["idProduit7"]); $idproduit8 = htmlspecialchars($_POST["idProduit8"]);
        $idproduit9 = htmlspecialchars($_POST["idProduit9"]); $idproduit10 = htmlspecialchars($_POST["idProduit10"]); $idproduit11 = htmlspecialchars($_POST["idProduit11"]); $idproduit12 = htmlspecialchars($_POST["idProduit12"]); $idproduit13 = htmlspecialchars($_POST["idProduit13"]); $idproduit14 = htmlspecialchars($_POST["idProduit14"]); $idproduit15 = htmlspecialchars($_POST["idProduit15"]); $idproduit16 = htmlspecialchars($_POST["idProduit16"]);
        $idproduit17 = htmlspecialchars($_POST["idProduit17"]); $idproduit18 = htmlspecialchars($_POST["idProduit18"]); $idproduit19 = htmlspecialchars($_POST["idProduit19"]); $idproduit20 = htmlspecialchars($_POST["idProduit20"]);

        $quantite0 = htmlspecialchars($_POST["QuantiteP0"]); $quantite1 = htmlspecialchars($_POST["QuantiteP1"]); $quantite2 = htmlspecialchars($_POST["QuantiteP2"]); $quantite3 = htmlspecialchars($_POST["QuantiteP3"]); $quantite4 = htmlspecialchars($_POST["QuantiteP4"]); $quantite5 = htmlspecialchars($_POST["QuantiteP5"]); $quantite6 = htmlspecialchars($_POST["QuantiteP6"]); $quantite7 = htmlspecialchars($_POST["QuantiteP7"]); $quantite8 = htmlspecialchars($_POST["QuantiteP8"]);
        $quantite9 = htmlspecialchars($_POST["QuantiteP9"]); $quantite10 = htmlspecialchars($_POST["QuantiteP10"]); $quantite11 = htmlspecialchars($_POST["QuantiteP11"]); $quantite12 = htmlspecialchars($_POST["QuantiteP12"]); $quantite13 = htmlspecialchars($_POST["QuantiteP13"]); $quantite14 = htmlspecialchars($_POST["QuantiteP14"]); $quantite15 = htmlspecialchars($_POST["QuantiteP15"]); $quantite16 = htmlspecialchars($_POST["QuantiteP16"]); $quantite17 = htmlspecialchars($_POST["QuantiteP17"]);
        $quantite18 = htmlspecialchars($_POST["QuantiteP18"]); $quantite19 = htmlspecialchars($_POST["QuantiteP19"]); $quantite20 = htmlspecialchars($_POST["QuantiteP20"]);

        $prixU0 = htmlspecialchars($_POST["prixU0"]); $prixU1 = htmlspecialchars($_POST["prixU1"]); $prixU2 = htmlspecialchars($_POST["prixU2"]); $prixU3 = htmlspecialchars($_POST["prixU3"]); $prixU4 = htmlspecialchars($_POST["prixU4"]); $prixU5 = htmlspecialchars($_POST["prixU5"]); $prixU6 = htmlspecialchars($_POST["prixU6"]); $prixU7 = htmlspecialchars($_POST["prixU7"]); $prixU8 = htmlspecialchars($_POST["prixU8"]); $prixU9 = htmlspecialchars($_POST["prixU9"]); $prixU10 = htmlspecialchars($_POST["prixU10"]);
        $prixU20 = htmlspecialchars($_POST["prixU20"]); $prixU11 = htmlspecialchars($_POST["prixU11"]); $prixU12 = htmlspecialchars($_POST["prixU12"]); $prixU13 = htmlspecialchars($_POST["prixU13"]); $prixU14 = htmlspecialchars($_POST["prixU14"]); $prixU15 = htmlspecialchars($_POST["prixU15"]); $prixU16 = htmlspecialchars($_POST["prixU16"]); $prixU17 = htmlspecialchars($_POST["prixU17"]); $prixU18 = htmlspecialchars($_POST["prixU18"]); $prixU19 = htmlspecialchars($_POST["prixU19"]); 

        $source0 = htmlspecialchars($_POST["Source0"]); $source1 = htmlspecialchars($_POST["Source1"]); $source2 = htmlspecialchars($_POST["Source2"]); $source3 = htmlspecialchars($_POST["Source3"]); $source4 = htmlspecialchars($_POST["Source4"]); $source5 = htmlspecialchars($_POST["Source5"]); $source6 = htmlspecialchars($_POST["Source6"]); $source7 = htmlspecialchars($_POST["Source7"]); $source8 = htmlspecialchars($_POST["Source8"]); $source9 = htmlspecialchars($_POST["Source9"]); $source10 = htmlspecialchars($_POST["Source10"]);
        $source20 = htmlspecialchars($_POST["Source20"]); $source11 = htmlspecialchars($_POST["Source11"]); $source12 = htmlspecialchars($_POST["Source12"]); $source13 = htmlspecialchars($_POST["Source13"]); $source14 = htmlspecialchars($_POST["Source14"]); $source15 = htmlspecialchars($_POST["Source15"]); $source16 = htmlspecialchars($_POST["Source16"]); $source17 = htmlspecialchars($_POST["Source17"]); $source18 = htmlspecialchars($_POST["Source18"]); $source19 = htmlspecialchars($_POST["Source19"]); 
       
        $prixAU0 = htmlspecialchars($_POST["prixA0"]); $prixAU1 = htmlspecialchars($_POST["prixA1"]); $prixAU2 = htmlspecialchars($_POST["prixA2"]); $prixAU3 = htmlspecialchars($_POST["prixA3"]); $prixAU4 = htmlspecialchars($_POST["prixA4"]); $prixAU5 = htmlspecialchars($_POST["prixA5"]); $prixAU6 = htmlspecialchars($_POST["prixA6"]); $prixAU7 = htmlspecialchars($_POST["prixA7"]); $prixAU8 = htmlspecialchars($_POST["prixA8"]); $prixAU9 = htmlspecialchars($_POST["prixA9"]); $prixAU10 = htmlspecialchars($_POST["prixA10"]);
        $prixAU20 = htmlspecialchars($_POST["prixA20"]); $prixAU11 = htmlspecialchars($_POST["prixA11"]); $prixAU12 = htmlspecialchars($_POST["prixA12"]); $prixAU13 = htmlspecialchars($_POST["prixA13"]); $prixAU14 = htmlspecialchars($_POST["prixA14"]); $prixAU15 = htmlspecialchars($_POST["prixA15"]); $prixAU16 = htmlspecialchars($_POST["prixA16"]); $prixAU17 = htmlspecialchars($_POST["prixA17"]); $prixAU18 = htmlspecialchars($_POST["prixA18"]); $prixAU19 = htmlspecialchars($_POST["prixA19"]); 


          function insereur($produit, $client, $quantite, $prixU, $source, $prixAU, $datesC, $operatio)
        {
            //include 'ContratC.php';
            if(empty($produit)){
                echo "";
            }else{
                $tableau = explode(":",$produit);
                $idproduit = $tableau[0]*1;
                $tableauClient = explode(":", $client);
                $idClient = $tableauClient[0]*1;
                $ClassContrat = new ContratC($idproduit, $idClient, $quantite, $prixU, $source, $prixAU, $operatio, $datesC);
                $ClassContrat->insertContrat();
                
                $ClassContrat->misAjour();
                //echo $operatio." dateV :nomClinet :".$idClient."dette :  produit0 : ".$idproduit." quant :".$quantite."prix :".$prixU."  Nom du produit 1 : ";
                
            }
        }
        echo $datesCont;
        insereur($idproduit0, $nomClient, $quantite0, $prixU0, $source0, $prixAU0, $datesCont, $operation);
        insereur($idproduit1, $nomClient, $quantite1, $prixU1, $source1, $prixAU1, $datesCont, $operation);
        insereur($idproduit2, $nomClient, $quantite2, $prixU2, $source2, $prixAU2, $datesCont, $operation);
        insereur($idproduit3, $nomClient, $quantite3, $prixU3, $source3, $prixAU3, $datesCont, $operation);
        insereur($idproduit4, $nomClient, $quantite4, $prixU4, $source4, $prixAU4, $datesContrat, $operation);
        insereur($idproduit5, $nomClient, $quantite5, $prixU5, $source5, $prixAU5, $datesContrat, $operation);
        insereur($idproduit6, $nomClient, $quantite6, $prixU6, $source6, $prixAU6, $datesContrat, $operation);
        insereur($idproduit7, $nomClient, $quantite7, $prixU7, $source7, $prixAU7, $datesContrat, $operation);
        insereur($idproduit8, $nomClient, $quantite8, $prixU8, $source8, $prixAU8, $datesContrat, $operation);
        insereur($idproduit9, $nomClient, $quantite9, $prixU9, $source9, $prixAU9, $datesContrat, $operation);

        insereur($idproduit20, $nomClient, $quantite20, $prixU20, $source20, $prixAU20, $datesContrat, $operation);
        insereur($idproduit11, $nomClient, $quantite11, $prixU11, $source11, $prixAU11, $datesContrat, $operation);
        insereur($idproduit12, $nomClient, $quantite12, $prixU12, $source12, $prixAU12, $datesContrat, $operation);
        insereur($idproduit13, $nomClient, $quantite13, $prixU13, $source13, $prixAU13, $datesContrat, $operation);
        insereur($idproduit14, $nomClient, $quantite14, $prixU14, $source14, $prixAU14, $datesContrat, $operation);
        insereur($idproduit15, $nomClient, $quantite15, $prixU15, $source15, $prixAU15, $datesContrat, $operation);
        insereur($idproduit16, $nomClient, $quantite16, $prixU16, $source16, $prixAU16, $datesContrat, $operation);
        insereur($idproduit17, $nomClient, $quantite17, $prixU17, $source17, $prixAU17, $datesContrat, $operation);
        insereur($idproduit18, $nomClient, $quantite18, $prixU18, $source18, $prixAU18, $datesContrat, $operation);
        insereur($idproduit19, $nomClient, $quantite19, $prixU19, $source19, $prixAU19, $datesContrat, $operation);

        $tabC = explode(":", $nomClient);
        $NomC = $tabC[1];
        $telephone = $tabC[2];
        $calculpvt;
        $paTT = 0; $paCM = 0; $paCA = 0;
        $pvTT = 0; $pvCM = 0; $pvCA = 0;
        $bTT = 0; $bCM = 0; $bCA;

        $rreqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$tabC[0].") GROUP BY Operation order by Operation DESC limit 500");
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
            echo"<p style = 'width : 70%'><b>Total </b>:<br> Prix d achat total : <span>".$paTT." USD </span> ; Prix de vente total : <span>".$pvTT." USD</span>; ce qui nous fait un benefice de : ".$pvTT - $paTT." USD<br>";
            echo"<b>Produit acheté chez moi </b>:<br> Prix d achat total : <span>".$paCM." USD  </span>; Prix de vente total : <span>".$pvCM." USD</span>; ce qui nous fait un benefice de : ".$pvCM - $paCM." USD<br>";
            echo"<b>Produit acheté ailleur </b>:<br> Prix d achat total : <span>".$paCA." USD  </span>; Prix de vente total : <span>".$pvCA." USD</span>; ce qui nous fait un benefice de : ".$pvCA - $paCA." USD<br></p>";
        }else{echo "Une erreur s est produite ";}

        $reqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$tabC[0].") GROUP BY Operation order by Operation DESC limit 500");
        $result= mysqli_query($db, $reqSql);
        if(mysqli_num_rows($result)>0){
            echo"<p>Client  : <i>".$NomC."</i></p>";
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
        }else{echo "Une erreur s est produite ";}
       

    ?>
    </div><!-- fin affichage de la facture -->
    
    
    <div style="border: 0px solid black;"><!-- modificatin facture -->
    <br><br>
        <form id="form1" method="POST" action="<?php echo htmlspecialchars("contratAjustQ.php") ?>">
            <input type="hidden" name="Client" value="<?php echo $nomClient; ?>">
            <input type="hidden" name="DatesContrat" value="<?php echo $datesCont; ?>">
            <input type="hidden" name="Operation" value="<?php echo $operation; ?>">
            

            <input type="hidden" name="idProduit0" value="<?php echo $idproduit0; ?>">
            <input type="hidden" name="quantite0" value="<?php echo $quantite0; ?>">
            <input type="hidden" name="prixU0" value="<?php echo $prixU0; ?>">
            <input type="hidden" name="prixA0" value="<?php echo $prixAU0; ?>">
            <input type="hidden" name="source0" value="<?php echo $source0; ?>">

            <input type="hidden" name="idProduit1" value="<?php echo $idproduit1; ?>">
            <input type="hidden" name="quantite1" value="<?php echo $quantite1; ?>">
            <input type="hidden" name="prixU1" value="<?php echo $prixU1; ?>">
            <input type="hidden" name="prixA1" value="<?php echo $prixAU1; ?>">
            <input type="hidden" name="source1" value="<?php echo $source1; ?>">

            <input type="hidden" name="idProduit2" value="<?php echo $idproduit2; ?>">
            <input type="hidden" name="quantite2" value="<?php echo $quantite2; ?>">
            <input type="hidden" name="prixU2" value="<?php echo $prixU2; ?>">
            <input type="hidden" name="prixA2" value="<?php echo $prixAU2; ?>">
            <input type="hidden" name="source2" value="<?php echo $source2; ?>">

            <input type="hidden" name="idProduit3" value="<?php echo $idproduit3; ?>">
            <input type="hidden" name="quantite3" value="<?php echo $quantite3; ?>">
            <input type="hidden" name="prixU3" value="<?php echo $prixU3; ?>">
            <input type="hidden" name="prixA3" value="<?php echo $prixAU3; ?>">
            <input type="hidden" name="source3" value="<?php echo $source3; ?>">

            <input type="hidden" name="idProduit4" value="<?php echo $idproduit4; ?>">
            <input type="hidden" name="quantite4" value="<?php echo $quantite4; ?>">
            <input type="hidden" name="prixU4" value="<?php echo $prixU4; ?>">
            <input type="hidden" name="prixA4" value="<?php echo $prixAU4; ?>">
            <input type="hidden" name="source4" value="<?php echo $source4; ?>">

            <input type="hidden" name="idProduit5" value="<?php echo $idproduit5; ?>">
            <input type="hidden" name="quantite5" value="<?php echo $quantite5; ?>">
            <input type="hidden" name="prixU5" value="<?php echo $prixU5; ?>">
            <input type="hidden" name="prixA5" value="<?php echo $prixAU5; ?>">
            <input type="hidden" name="source5" value="<?php echo $source5; ?>">

            <input type="hidden" name="idProduit6" value="<?php echo $idproduit6; ?>">
            <input type="hidden" name="quantite6" value="<?php echo $quantite6; ?>">
            <input type="hidden" name="prixU6" value="<?php echo $prixU6; ?>">
            <input type="hidden" name="prixA6" value="<?php echo $prixAU6; ?>">
            <input type="hidden" name="source6" value="<?php echo $source6; ?>">

            <input type="hidden" name="idProduit7" value="<?php echo $idproduit7; ?>">
            <input type="hidden" name="quantite7" value="<?php echo $quantite7; ?>">
            <input type="hidden" name="prixU7" value="<?php echo $prixU7; ?>">
            <input type="hidden" name="prixA7" value="<?php echo $prixAU7; ?>">
            <input type="hidden" name="source7" value="<?php echo $source7; ?>">

            <input type="hidden" name="idProduit8" value="<?php echo $idproduit8; ?>">
            <input type="hidden" name="quantite8" value="<?php echo $quantite8; ?>">
            <input type="hidden" name="prixU8" value="<?php echo $prixU8; ?>">
            <input type="hidden" name="prixA8" value="<?php echo $prixAU8; ?>">
            <input type="hidden" name="source8" value="<?php echo $source8; ?>">

            <input type="hidden" name="idProduit9" value="<?php echo $idproduit9; ?>">
            <input type="hidden" name="quantite9" value="<?php echo $quantite9; ?>">
            <input type="hidden" name="prixU9" value="<?php echo $prixU9; ?>">
            <input type="hidden" name="prixA9" value="<?php echo $prixAU9; ?>">
            <input type="hidden" name="source9" value="<?php echo $source9; ?>">

            <input type="hidden" name="idProduit10" value="<?php echo $idproduit10; ?>">
            <input type="hidden" name="quantite10" value="<?php echo $quantite10; ?>">
            <input type="hidden" name="prixU10" value="<?php echo $prixU10; ?>">
            <input type="hidden" name="prixA10" value="<?php echo $prixAU10; ?>">
            <input type="hidden" name="source10" value="<?php echo $source10; ?>">

            <input type="hidden" name="idProduit11" value="<?php echo $idproduit11; ?>">
            <input type="hidden" name="quantite11" value="<?php echo $quantite11; ?>">
            <input type="hidden" name="prixU11" value="<?php echo $prixU11; ?>">
            <input type="hidden" name="prixA11" value="<?php echo $prixAU11; ?>">
            <input type="hidden" name="source11" value="<?php echo $source11; ?>">

            <input type="hidden" name="idProduit12" value="<?php echo $idproduit12; ?>">
            <input type="hidden" name="quantite12" value="<?php echo $quantite12; ?>">
            <input type="hidden" name="prixU12" value="<?php echo $prixU12; ?>">
            <input type="hidden" name="prixA12" value="<?php echo $prixAU12; ?>">
            <input type="hidden" name="source12" value="<?php echo $source12; ?>">

            <input type="hidden" name="idProduit13" value="<?php echo $idproduit13; ?>">
            <input type="hidden" name="quantite13" value="<?php echo $quantite13; ?>">
            <input type="hidden" name="prixU13" value="<?php echo $prixU13; ?>">
            <input type="hidden" name="prixA13" value="<?php echo $prixAU13; ?>">
            <input type="hidden" name="source13" value="<?php echo $source13; ?>">

            <input type="hidden" name="idProduit14" value="<?php echo $idproduit14; ?>">
            <input type="hidden" name="quantite14" value="<?php echo $quantite14; ?>">
            <input type="hidden" name="prixU14" value="<?php echo $prixU14; ?>">
            <input type="hidden" name="prixA14" value="<?php echo $prixAU14; ?>">
            <input type="hidden" name="source14" value="<?php echo $source14; ?>">

            <input type="hidden" name="idProduit15" value="<?php echo $idproduit15; ?>">
            <input type="hidden" name="quantite15" value="<?php echo $quantite15; ?>">
            <input type="hidden" name="prixU15" value="<?php echo $prixU15; ?>">
            <input type="hidden" name="prixA15" value="<?php echo $prixAU15; ?>">
            <input type="hidden" name="source15" value="<?php echo $source15; ?>">

            <input type="hidden" name="idProduit16" value="<?php echo $idproduit16; ?>">
            <input type="hidden" name="quantite16" value="<?php echo $quantite16; ?>">
            <input type="hidden" name="prixU16" value="<?php echo $prixU16; ?>">
            <input type="hidden" name="prixA16" value="<?php echo $prixAU16; ?>">
            <input type="hidden" name="source16" value="<?php echo $source16; ?>">

            <input type="hidden" name="idProduit17" value="<?php echo $idproduit17; ?>">
            <input type="hidden" name="quantite17" value="<?php echo $quantite17; ?>">
            <input type="hidden" name="prixU17" value="<?php echo $prixU17; ?>">
            <input type="hidden" name="prixA17" value="<?php echo $prixAU17; ?>">
            <input type="hidden" name="source17" value="<?php echo $source17; ?>">

            <input type="hidden" name="idProduit18" value="<?php echo $idproduit18; ?>">
            <input type="hidden" name="quantite18" value="<?php echo $quantite18; ?>">
            <input type="hidden" name="prixU18" value="<?php echo $prixU18; ?>">
            <input type="hidden" name="prixA18" value="<?php echo $prixAU18; ?>">
            <input type="hidden" name="source18" value="<?php echo $source18; ?>">

            <input type="hidden" name="idProduit19" value="<?php echo $idproduit19; ?>">
            <input type="hidden" name="quantite19" value="<?php echo $quantite19; ?>">
            <input type="hidden" name="prixU19" value="<?php echo $prixU19; ?>">
            <input type="hidden" name="prixA19" value="<?php echo $prixAU19; ?>">
            <input type="hidden" name="source19" value="<?php echo $source19; ?>">

            <input type="hidden" name="idProduit20" value="<?php echo $idproduit20; ?>">
            <input type="hidden" name="quantite20" value="<?php echo $quantite20; ?>">
            <input type="hidden" name="prixU20" value="<?php echo $prixU20; ?>">
            <input type="hidden" name="prixA20" value="<?php echo $prixAU20; ?>">
            <input type="hidden" name="source20" value="<?php echo $source20; ?>">

            <input type="submit" style="margin-left: 65%;" value="Modifier la derniere action">
        </form>
        <a href="contratQ.php" style="text-decoration: none;color:#fff;">Nouvelle action dans un contrat</a>
    </div>
    
  <?php } ?>  
</body>
</html>