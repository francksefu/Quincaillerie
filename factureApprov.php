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
    </style>
</head>
<body>
    <div style="border:0px solid black;"><!--  Debut requette pour l affichage de la facture -->
    <?php 
        include 'connexion.php';
        include 'ApprovisionnementC.php';
        $type = htmlspecialchars($_POST["type"]);
        $operation;
        if($type == "nouvelVente"){
            $sql = ("SELECT Operation, idApprov FROM Approvisionnement ORDER BY idApprov DESC limit 1");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $operation = 200000 + $row["idApprov"];
                }
                            
            }else{$operation = 200000;}
        }
        if($type == "modifVente"){
            $operation = $_POST["operation"];
            $sql = "DELETE FROM Approvisionnement WHERE Operation = ".$operation."";
            if($db->query($sql) === TRUE){
                echo"";
            }else{
                echo"erreur modification".$db->error;
            }
        }
      
       $datesVente = $_POST["DatesVentes"];

        $idproduit0 = htmlspecialchars($_POST["idProduit0"]); $idproduit1 = htmlspecialchars($_POST["idProduit1"]); $idproduit2 = htmlspecialchars($_POST["idProduit2"]); $idproduit3 = htmlspecialchars($_POST["idProduit3"]); $idproduit4 = htmlspecialchars($_POST["idProduit4"]); $idproduit5 = htmlspecialchars($_POST["idProduit5"]); $idproduit6 = htmlspecialchars($_POST["idProduit6"]); $idproduit7 = htmlspecialchars($_POST["idProduit7"]); $idproduit8 = htmlspecialchars($_POST["idProduit8"]);
        $idproduit9 = htmlspecialchars($_POST["idProduit9"]); $idproduit10 = htmlspecialchars($_POST["idProduit10"]); $idproduit11 = htmlspecialchars($_POST["idProduit11"]); $idproduit12 = htmlspecialchars($_POST["idProduit12"]); $idproduit13 = htmlspecialchars($_POST["idProduit13"]); $idproduit14 = htmlspecialchars($_POST["idProduit14"]); $idproduit15 = htmlspecialchars($_POST["idProduit15"]); $idproduit16 = htmlspecialchars($_POST["idProduit16"]);
        $idproduit17 = htmlspecialchars($_POST["idProduit17"]); $idproduit18 = htmlspecialchars($_POST["idProduit18"]); $idproduit19 = htmlspecialchars($_POST["idProduit19"]); $idproduit20 = htmlspecialchars($_POST["idProduit20"]);

        $quantite0 = htmlspecialchars($_POST["QuantiteP0"]); $quantite1 = htmlspecialchars($_POST["QuantiteP1"]); $quantite2 = htmlspecialchars($_POST["QuantiteP2"]); $quantite3 = htmlspecialchars($_POST["QuantiteP3"]); $quantite4 = htmlspecialchars($_POST["QuantiteP4"]); $quantite5 = htmlspecialchars($_POST["QuantiteP5"]); $quantite6 = htmlspecialchars($_POST["QuantiteP6"]); $quantite7 = htmlspecialchars($_POST["QuantiteP7"]); $quantite8 = htmlspecialchars($_POST["QuantiteP8"]);
        $quantite9 = htmlspecialchars($_POST["QuantiteP9"]); $quantite10 = htmlspecialchars($_POST["QuantiteP10"]); $quantite11 = htmlspecialchars($_POST["QuantiteP11"]); $quantite12 = htmlspecialchars($_POST["QuantiteP12"]); $quantite13 = htmlspecialchars($_POST["QuantiteP13"]); $quantite14 = htmlspecialchars($_POST["QuantiteP14"]); $quantite15 = htmlspecialchars($_POST["QuantiteP15"]); $quantite16 = htmlspecialchars($_POST["QuantiteP16"]); $quantite17 = htmlspecialchars($_POST["QuantiteP17"]);
        $quantite18 = htmlspecialchars($_POST["QuantiteP18"]); $quantite19 = htmlspecialchars($_POST["QuantiteP19"]); $quantite20 = htmlspecialchars($_POST["QuantiteP20"]);

        $prixU0 = htmlspecialchars($_POST["prixU0"]); $prixU1 = htmlspecialchars($_POST["prixU1"]); $prixU2 = htmlspecialchars($_POST["prixU2"]); $prixU3 = htmlspecialchars($_POST["prixU3"]); $prixU4 = htmlspecialchars($_POST["prixU4"]); $prixU5 = htmlspecialchars($_POST["prixU5"]); $prixU6 = htmlspecialchars($_POST["prixU6"]); $prixU7 = htmlspecialchars($_POST["prixU7"]); $prixU8 = htmlspecialchars($_POST["prixU8"]); $prixU9 = htmlspecialchars($_POST["prixU9"]); $prixU10 = htmlspecialchars($_POST["prixU10"]);
        $prixU20 = htmlspecialchars($_POST["prixU20"]); $prixU11 = htmlspecialchars($_POST["prixU11"]); $prixU12 = htmlspecialchars($_POST["prixU12"]); $prixU13 = htmlspecialchars($_POST["prixU13"]); $prixU14 = htmlspecialchars($_POST["prixU14"]); $prixU15 = htmlspecialchars($_POST["prixU15"]); $prixU16 = htmlspecialchars($_POST["prixU16"]); $prixU17 = htmlspecialchars($_POST["prixU17"]); $prixU18 = htmlspecialchars($_POST["prixU18"]); $prixU19 = htmlspecialchars($_POST["prixU19"]); 

        //$tableau = explode(":",$idproduit0);
               // $idproduit = $tableau[0];

        //echo $operation." dateV :".$datesV."nomClinet :".$nomClient."dette :".$dette."  produit0 : ".$idproduit0." quant :".$quantite0."prix :".$prixU0."  Nom du produit 1 : ";
        function insereur($produit, $quantite, $prixU, $datesV, $operatio)
        {
            //include 'VentesC.php';
            if(empty($produit)){
                echo "";
            }else{
                $tableau = explode(":",$produit);
                $idproduit = $tableau[0]*1;
                
               
                $ClassApprov = new ApprovisionnementC($idproduit, $prixU, $quantite, $datesV, $operatio);
                $ClassApprov->misAjour();
                $ClassApprov->insere();
                //echo $operatio." dateV :".$datesV."nomClinet :".$idClient."dette :".$dettes."  produit0 : ".$idproduit." quant :".$quantite."prix :".$prixU."  Nom du produit 1 : ";
                echo "";
            }
        }
        insereur($idproduit0, $quantite0, $prixU0, $datesVente, $operation);
        insereur($idproduit1, $quantite1, $prixU1, $datesVente, $operation);
        insereur($idproduit2, $quantite2, $prixU2, $datesVente, $operation);
        insereur($idproduit3, $quantite3, $prixU3, $datesVente, $operation);
        insereur($idproduit4, $quantite4, $prixU4, $datesVente, $operation);
        insereur($idproduit5, $quantite5, $prixU5, $datesVente, $operation);
        insereur($idproduit6, $quantite6, $prixU6, $datesVente, $operation);
        insereur($idproduit7, $quantite7, $prixU7, $datesVente, $operation);
        insereur($idproduit8, $quantite8, $prixU8, $datesVente, $operation);
        insereur($idproduit9, $quantite9, $prixU9, $datesVente, $operation);

        insereur($idproduit10, $quantite10, $prixU10, $datesVente, $operation);
        insereur($idproduit11, $quantite11, $prixU11, $datesVente, $operation);
        insereur($idproduit12, $quantite12, $prixU12, $datesVente, $operation);
        insereur($idproduit13, $quantite13, $prixU13, $datesVente, $operation);
        insereur($idproduit14, $quantite14, $prixU14, $datesVente, $operation);
        insereur($idproduit15, $quantite15, $prixU15, $datesVente, $operation);
        insereur($idproduit16, $quantite16, $prixU16, $datesVente, $operation);
        insereur($idproduit17, $quantite17, $prixU17, $datesVente, $operation);
        insereur($idproduit18, $quantite18, $prixU18, $datesVente, $operation);
        insereur($idproduit19, $quantite19, $prixU19, $datesVente, $operation);
        insereur($idproduit20, $quantite20, $prixU20, $datesVente, $operation);
        
        $calculpvt = 0;
        $reqSql = ("SELECT Nom, QuantiteApprov, PrixA FROM Produit, Approvisionnement WHERE (Approvisionnement.Operation = ".$operation.") AND (Produit.idProduit=Approvisionnement.idProduit)");
        $result= mysqli_query($db, $reqSql);
        echo"<div style='width:60%;margin-left:5%;'>";
        
        echo"<h1>Facture d approvisionnement</h1><br>";
        echo"<h2>Numero : ".$operation."</h2><br>";
        echo" <h2>Goma le,".$datesVente."</h2><br>";
        

        if(mysqli_num_rows($result)>0){
            echo"<table id='customers'><tr><th style = 'background-color:#555;'>Qtite</th><th style = 'background-color:#555;'>Articles </th><th style = 'background-color:#555;'>     PU      </th><th style = 'background-color:#555;'>PT </th></tr>";
            while($row= mysqli_fetch_assoc($result)){
                    echo"<tr><td>".$row["QuantiteApprov"]."</td><td>".$row["Nom"]."</td><td>".$row["PrixA"]."</td><td>".$row["PrixA"]*$row["QuantiteApprov"]."</td></tr>"; 
                    $cal = $row["QuantiteApprov"]*$row["PrixA"];
                    $calculpvt += $cal; 
            }
            echo"</table>";
            echo"<h2>Total general : <span style='margin-left:20%'>".$calculpvt." USD</span></h2>";
            echo "</div>";
        }else{echo "Impossible de generer cette facture ";}
        $update = "UPDATE Approvisionnement SET TotalFacture = '".$calculpvt."' WHERE Operation ='".$operation."'";
        if($db->query($update) === TRUE ){
            echo"";
        }else{echo "Erreur du calcul de la facture :".$db->error;}


    ?>
    </div><!-- fin affichage de la facture -->
    <div style="border: 0px solid black;"><!-- modificatin facture -->
    <br><br>
        <form id="form1" method="POST" action="<?php echo htmlspecialchars("approvisionnementModif.php") ?>">
           
            <input type="hidden" name="datesVente" value="<?php echo $datesVente; ?>">
            <input type="hidden" name="operation" value="<?php echo $operation; ?>">
            

            <input type="hidden" name="idProduit0" value="<?php echo $idproduit0; ?>">
            <input type="hidden" name="quantite0" value="<?php echo $quantite0; ?>">
            <input type="hidden" name="prixU0" value="<?php echo $prixU0; ?>">

            <input type="hidden" name="idProduit1" value="<?php echo $idproduit1; ?>">
            <input type="hidden" name="quantite1" value="<?php echo $quantite1; ?>">
            <input type="hidden" name="prixU1" value="<?php echo $prixU1; ?>">

            <input type="hidden" name="idProduit2" value="<?php echo $idproduit2; ?>">
            <input type="hidden" name="quantite2" value="<?php echo $quantite2; ?>">
            <input type="hidden" name="prixU2" value="<?php echo $prixU2; ?>">

            <input type="hidden" name="idProduit3" value="<?php echo $idproduit3; ?>">
            <input type="hidden" name="quantite3" value="<?php echo $quantite3; ?>">
            <input type="hidden" name="prixU3" value="<?php echo $prixU3; ?>">

            <input type="hidden" name="idProduit4" value="<?php echo $idproduit4; ?>">
            <input type="hidden" name="quantite4" value="<?php echo $quantite4; ?>">
            <input type="hidden" name="prixU4" value="<?php echo $prixU4; ?>">

            <input type="hidden" name="idProduit5" value="<?php echo $idproduit5; ?>">
            <input type="hidden" name="quantite5" value="<?php echo $quantite5; ?>">
            <input type="hidden" name="prixU5" value="<?php echo $prixU5; ?>">

            <input type="hidden" name="idProduit6" value="<?php echo $idproduit6; ?>">
            <input type="hidden" name="quantite6" value="<?php echo $quantite6; ?>">
            <input type="hidden" name="prixU6" value="<?php echo $prixU6; ?>">

            <input type="hidden" name="idProduit7" value="<?php echo $idproduit7; ?>">
            <input type="hidden" name="quantite7" value="<?php echo $quantite7; ?>">
            <input type="hidden" name="prixU7" value="<?php echo $prixU7; ?>">

            <input type="hidden" name="idProduit8" value="<?php echo $idproduit8; ?>">
            <input type="hidden" name="quantite8" value="<?php echo $quantite8; ?>">
            <input type="hidden" name="prixU8" value="<?php echo $prixU8; ?>">

            <input type="hidden" name="idProduit9" value="<?php echo $idproduit9; ?>">
            <input type="hidden" name="quantite9" value="<?php echo $quantite9; ?>">
            <input type="hidden" name="prixU9" value="<?php echo $prixU9; ?>">

            <input type="hidden" name="idProduit10" value="<?php echo $idproduit10; ?>">
            <input type="hidden" name="quantite10" value="<?php echo $quantite10; ?>">
            <input type="hidden" name="prixU10" value="<?php echo $prixU10; ?>">

            <input type="hidden" name="idProduit11" value="<?php echo $idproduit11; ?>">
            <input type="hidden" name="quantite11" value="<?php echo $quantite11; ?>">
            <input type="hidden" name="prixU11" value="<?php echo $prixU11; ?>">

            <input type="hidden" name="idProduit12" value="<?php echo $idproduit12; ?>">
            <input type="hidden" name="quantite12" value="<?php echo $quantite12; ?>">
            <input type="hidden" name="prixU12" value="<?php echo $prixU12; ?>">

            <input type="hidden" name="idProduit13" value="<?php echo $idproduit13; ?>">
            <input type="hidden" name="quantite13" value="<?php echo $quantite13; ?>">
            <input type="hidden" name="prixU13" value="<?php echo $prixU13; ?>">

            <input type="hidden" name="idProduit14" value="<?php echo $idproduit14; ?>">
            <input type="hidden" name="quantite14" value="<?php echo $quantite14; ?>">
            <input type="hidden" name="prixU14" value="<?php echo $prixU14; ?>">

            <input type="hidden" name="idProduit15" value="<?php echo $idproduit15; ?>">
            <input type="hidden" name="quantite15" value="<?php echo $quantite15; ?>">
            <input type="hidden" name="prixU15" value="<?php echo $prixU15; ?>">

            <input type="hidden" name="idProduit16" value="<?php echo $idproduit16; ?>">
            <input type="hidden" name="quantite16" value="<?php echo $quantite16; ?>">
            <input type="hidden" name="prixU16" value="<?php echo $prixU16; ?>">

            <input type="hidden" name="idProduit17" value="<?php echo $idproduit17; ?>">
            <input type="hidden" name="quantite17" value="<?php echo $quantite17; ?>">
            <input type="hidden" name="prixU17" value="<?php echo $prixU17; ?>">

            <input type="hidden" name="idProduit18" value="<?php echo $idproduit18; ?>">
            <input type="hidden" name="quantite18" value="<?php echo $quantite18; ?>">
            <input type="hidden" name="prixU18" value="<?php echo $prixU18; ?>">

            <input type="hidden" name="idProduit19" value="<?php echo $idproduit19; ?>">
            <input type="hidden" name="quantite19" value="<?php echo $quantite19; ?>">
            <input type="hidden" name="prixU19" value="<?php echo $prixU19; ?>">

            <input type="hidden" name="idProduit20" value="<?php echo $idproduit20; ?>">
            <input type="hidden" name="quantite20" value="<?php echo $quantite20; ?>">
            <input type="hidden" name="prixU20" value="<?php echo $prixU20; ?>">

            <input type="submit" style="margin-left: 65%;" value="Modifier facture">
        </form>
        <a href="approvisionnementQ.php" style="text-decoration: none;color:#fff;">Nouvelle Approvisionnement</a>
    </div>
    <?php } ?>
</body>
</html>