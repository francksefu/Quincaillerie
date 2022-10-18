<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="venteQ.css" media="screen" type="text/css" />
    <style>
        html{
            background: url(imageVend.png);
            background-size: cover;
        }
        span{
            width: 10%;
            background-color: yellowgreen;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            
            border-radius: 16px;
    
        }
        
       
    </style>
</head>
<?php 
    function datalist(){
        include 'connexion.php';
        $sql = ("SELECT*FROM Produit");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='".$row["idProduit"].": ".$row["Nom"]." :".$row["PrixVente"].": USD' >".$row["Nom"]." : ".$row["PrixVente"]." USD</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }

    

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
    $nomClient = $_POST["nomClient"];
    $datesVente = $_POST["datesVente"];
    $operation = $_POST["operation"];
    $dette = $_POST["dette"];

    $idproduit0 = $_POST["idProduit0"]; $quantite0 = $_POST["quantite0"]; $prixU0 = $_POST["prixU0"];
    $idproduit1 = $_POST["idProduit1"]; $quantite1 = $_POST["quantite1"]; $prixU1 = $_POST["prixU1"];
    $idproduit2 = $_POST["idProduit2"]; $quantite2 = $_POST["quantite2"]; $prixU2 = $_POST["prixU2"];
    $idproduit3 = $_POST["idProduit3"]; $quantite3 = $_POST["quantite3"]; $prixU3 = $_POST["prixU3"];
    $idproduit4 = $_POST["idProduit4"]; $quantite4 = $_POST["quantite4"]; $prixU4 = $_POST["prixU4"];
    $idproduit5 = $_POST["idProduit5"]; $quantite5 = $_POST["quantite5"]; $prixU5 = $_POST["prixU5"];
    $idproduit6 = $_POST["idProduit6"]; $quantite6 = $_POST["quantite6"]; $prixU6 = $_POST["prixU6"];
    $idproduit7 = $_POST["idProduit7"]; $quantite7 = $_POST["quantite7"]; $prixU7 = $_POST["prixU7"];
    $idproduit8 = $_POST["idProduit8"]; $quantite8 = $_POST["quantite8"]; $prixU8 = $_POST["prixU8"];
    $idproduit9 = $_POST["idProduit9"]; $quantite9 = $_POST["quantite9"]; $prixU9 = $_POST["prixU9"];
    $idproduit10 = $_POST["idProduit10"]; $quantite10 = $_POST["quantite10"]; $prixU10 = $_POST["prixU10"];
    $idproduit11 = $_POST["idProduit11"]; $quantite11 = $_POST["quantite11"]; $prixU11 = $_POST["prixU11"];
    $idproduit12 = $_POST["idProduit12"]; $quantite12 = $_POST["quantite12"]; $prixU12 = $_POST["prixU12"];
    $idproduit13 = $_POST["idProduit13"]; $quantite13 = $_POST["quantite13"]; $prixU13 = $_POST["prixU13"];
    $idproduit14 = $_POST["idProduit14"]; $quantite14 = $_POST["quantite14"]; $prixU14 = $_POST["prixU14"];
    $idproduit15 = $_POST["idProduit15"]; $quantite15 = $_POST["quantite15"]; $prixU15 = $_POST["prixU15"];
    $idproduit16 = $_POST["idProduit16"]; $quantite16 = $_POST["quantite16"]; $prixU16 = $_POST["prixU16"];
    $idproduit17 = $_POST["idProduit17"]; $quantite17 = $_POST["quantite17"]; $prixU17 = $_POST["prixU17"];
    $idproduit18 = $_POST["idProduit18"]; $quantite18 = $_POST["quantite18"]; $prixU18 = $_POST["prixU18"];
    $idproduit19 = $_POST["idProduit19"]; $quantite19 = $_POST["quantite19"]; $prixU19 = $_POST["prixU19"];
    $idproduit20 = $_POST["idProduit20"]; $quantite20 = $_POST["quantite20"]; $prixU20 = $_POST["prixU20"];

    //Pour la modification d une facture aleatoire
    $cache = htmlspecialchars($_POST["cacher"]);
    $tableauProduit = array();
    $tableauQuantite = array();
    $tableauPrix = array();
    $iClient;
    if($cache == "ModifVente"){
        include 'connexion.php';
        
        $operaModif = htmlspecialchars($_POST["Operation"]) * 1;
        $operation = $operaModif;
        
          
        $reqSqlo= ("SELECT Ventes.idProduit, Nom, PrixVente, Ventes.idClient, DatesVente, Dette, QuantiteVendu, PU,Operation FROM Ventes, Produit WHERE(Ventes.idProduit = Produit.idProduit ) AND (Operation ='".$operaModif."')");
        $resulto= mysqli_query($db, $reqSqlo);
        if(mysqli_num_rows($resulto)>0){
            
             while($rowo= mysqli_fetch_assoc($resulto)){
                $essaie = "".$rowo["idProduit"].": ".$rowo["Nom"]." :".$rowo["PrixVente"].": USD ";
                array_push($tableauProduit, $essaie); 
                 
                //echo $rowo["QuantiteVendu"];
                array_push($tableauPrix, $rowo["PU"]);
                array_push($tableauQuantite, $rowo["QuantiteVendu"]);
                $dette = $rowo["Dette"];
                $datesVente = $rowo["DatesVente"];
                $iClient = $rowo["idClient"];
             
                   
            }
            $reqC = ("SELECT*FROM Client WHERE idClient = '".$iClient."'");
            $resulC = mysqli_query($db, $reqC);
            if(mysqli_num_rows($resulC)>0){
                while($ro= mysqli_fetch_assoc($resulC)){
                    $nomCli = $ro["NomClient"]." :".$ro["Telephone"];
                }
            }
            $nomClient = $iClient.": ".$nomCli;
            
            //echo $tableauProduit[0]." ".$tableauPrix[0]." ".$tableauQuantite[0]." ".$dette; 
            $idproduit0 = $tableauProduit[0]; $quantite0 = $tableauQuantite[0]; $prixU0 = $tableauPrix[0];      $idproduit1 = $tableauProduit[1]; $quantite1 = $tableauQuantite[1]; $prixU1 = $tableauPrix[1];      $idproduit2 = $tableauProduit[2]; $quantite2 = $tableauQuantite[2]; $prixU2 = $tableauPrix[2];
            $idproduit3 = $tableauProduit[3]; $quantite3 = $tableauQuantite[3]; $prixU3 = $tableauPrix[3];      $idproduit4 = $tableauProduit[4]; $quantite4 = $tableauQuantite[4]; $prixU4 = $tableauPrix[4];      $idproduit5 = $tableauProduit[5]; $quantite5 = $tableauQuantite[5]; $prixU5 = $tableauPrix[5];
            $idproduit6 = $tableauProduit[6]; $quantite6 = $tableauQuantite[6]; $prixU6 = $tableauPrix[6];      $idproduit7 = $tableauProduit[7]; $quantite7 = $tableauQuantite[7]; $prixU7 = $tableauPrix[7];      $idproduit8 = $tableauProduit[8]; $quantite8 = $tableauQuantite[8]; $prixU8 = $tableauPrix[8];
            $idproduit9 = $tableauProduit[9]; $quantite9 = $tableauQuantite[9]; $prixU9 = $tableauPrix[9];      $idproduit10 = $tableauProduit[10]; $quantite10 = $tableauQuantite[10]; $prixU10 = $tableauPrix[10];      $idproduit11 = $tableauProduit[11]; $quantite11 = $tableauQuantite[11]; $prixU11 = $tableauPrix[11];
            $idproduit12 = $tableauProduit[12]; $quantite12 = $tableauQuantite[12]; $prixU12 = $tableauPrix[12];      $idproduit13 = $tableauProduit[13]; $quantite13 = $tableauQuantite[13]; $prixU13 = $tableauPrix[13];      $idproduit14 = $tableauProduit[14]; $quantite14 = $tableauQuantite[14]; $prixU14 = $tableauPrix[14];
            $idproduit15 = $tableauProduit[15]; $quantite15 = $tableauQuantite[15]; $prixU15 = $tableauPrix[15];      $idproduit16 = $tableauProduit[16]; $quantite16 = $tableauQuantite[16]; $prixU16 = $tableauPrix[16];      $idproduit17 = $tableauProduit[17]; $quantite17 = $tableauQuantite[17]; $prixU17 = $tableauPrix[17];
            $idproduit18 = $tableauProduit[18]; $quantite18 = $tableauQuantite[18]; $prixU18 = $tableauPrix[18];      $idproduit19 = $tableauProduit[19]; $quantite19 = $tableauQuantite[19]; $prixU19 = $tableauPrix[19];      $idproduit20 = $tableauProduit[20]; $quantite20 = $tableauQuantite[20]; $prixU20 = $tableauPrix[20];
           
        }else{echo "Pas des données a cette dqte la";}
    }
    
    function retourProduit($idproduit, $quantite){
        include 'connexion.php';
        if($idproduit != "")
        {
            $tableau = explode(":", $idproduit);
            $idProd = $tableau[0]*1;
            $quantiteF;
            $sql = ("SELECT QuantiteStock FROM Produit WHERE idProduit = ".$idProd."");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $quantiteF = $row["QuantiteStock"];
                }
                            
            }else{echo "error";}
            $nvlQuantite = $quantiteF + $quantite;
            $sql1 = ("UPDATE Produit SET QuantiteStock = '".$nvlQuantite."' WHERE idProduit =".$idProd." ");
            if($db->query($sql1)===TRUE){
                echo"";
            }else{
                "Echec de mise a jour :".$db->error;
            }
        }    
    }

    retourProduit($idproduit0, $quantite0); retourProduit($idproduit1, $quantite1); retourProduit($idproduit2, $quantite2); retourProduit($idproduit3, $quantite3); retourProduit($idproduit4, $quantite4); retourProduit($idproduit5, $quantite5); retourProduit($idproduit6, $quantite6); retourProduit($idproduit7, $quantite7); retourProduit($idproduit8, $quantite8); retourProduit($idproduit9, $quantite9); retourProduit($idproduit10, $quantite10);
    retourProduit($idproduit20, $quantite20); retourProduit($idproduit11, $quantite11); retourProduit($idproduit12, $quantite12); retourProduit($idproduit13, $quantite13); retourProduit($idproduit14, $quantite14); retourProduit($idproduit15, $quantite15); retourProduit($idproduit16, $quantite16); retourProduit($idproduit17, $quantite17); retourProduit($idproduit18, $quantite18); retourProduit($idproduit19, $quantite19); 

   
?>
<body>
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
</div>
<div class="topnav">
<a href="produitQ.php" >Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
    <a href="contratQ.php" >Contrat</a>
</div>
<div class="column1">
    <button type="button"  id="but" style="border-radius:20px;">Calul facture</button><br><br><span>Total facture :</span><br><br><br>
    <span id="voyons"></span><span> USD</span><br><br><br><span id="conversion"></span><span> Fc</span>
    
    
</div>
    <p>Choisissez les produits achetes : </p><br>
    <div class="column2">
    
        <form id="form1" method="POST" action="<?php  echo htmlspecialchars("facture.php"); ?>">
        <input type="date"  name="DatesVentes" id="datesVentes" value="<?php echo $datesVente ?>"><br>
        Mr,Mme <input type="text" list="dataclient" id = "idClient" name="Client" placeholder="Ecriver ici le nom du client" value="<?php echo $nomClient; ?>" required><input type="submit" id="envoi"  value="Envoyer">
        
        <datalist id="dataclient">
                <?php 
                    dataclient();

                ?>
            </datalist>
            <select name="Dette" style="width: 25%; background-color:darkkhaki;" value="<?php echo $dette; ?>">
                <option value="Non">facture a payer cash</option>
                <option value="Oui"> Dette </option>
            </select>
            
            
            <br><label for="nom">factures :</label><br>
            <input type = "text" list = "idproduit0" id = "Produit0" name="idProduit0" value="<?php echo $idproduit0; ?>"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit0">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="number" id="quantite0" name="QuantiteP0" onchange="clickMoi()" value="<?php echo $quantite0;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu0" name="PU0" placeholder="Prix Unitaire..." value="<?php echo $prixU0;?>"><span id="demo0" ></span><span> USD</span> <br>
            <input type="hidden" id="prixU0" name="prixU0">

            <input type = "text" list = "idproduit1" id = "Produit1" name="idProduit1" value="<?php echo $idproduit1; ?>"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit1">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="number" id="quantite1" name="QuantiteP1"onchange="clickMoi()" value="<?php echo $quantite1;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu1" name="PU1" placeholder="Prix Unitaire..." value="<?php echo $prixU1;?>"><span id="demo1"></span><span> USD</span><br>
            <input type="hidden" id="prixU1" name="prixU1">

            <input type = "text" list = "idproduit2" id = "Produit2" name="idProduit2" value="<?php echo $idproduit2; ?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit2">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU2" name="prixU2">
            <input type="number" id="quantite2" name="QuantiteP2" onchange="clickMoi()" value="<?php echo $quantite2;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu2" name="PU2" value="<?php echo $prixU2;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo2"></span><span> USD</span><br>

            <input type = "text" list = "idproduit3" id = "Produit3" name="idProduit3" value="<?php echo $idproduit3; ?>"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit3">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU3" name="prixU3">
            <input type="number" id="quantite3" name="QuantiteP3" onchange="clickMoi()" value="<?php echo $quantite3;?>"placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu3" name="PU3" value="<?php echo $prixU3;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo3"></span><span> USD</span><br>


            <input type = "text" list = "idproduit4" id = "Produit4" name="idProduit4" value="<?php echo $idproduit4;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit4">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU4" name="prixU4">
            <input type="number" id="quantite4" name="QuantiteP4" value="<?php echo $quantite4;?>" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu4" name="PU4" value="<?php echo $prixU4;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo4"></span><span> USD</span><br>



            <input type = "text" list = "idproduit5" id = "Produit5" name="idProduit5" value="<?php echo $idproduit5;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit5">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU5" name="prixU5">
            <input type="number" id="quantite5" name="QuantiteP5" onchange="clickMoi()"value="<?php echo $quantite5;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu5" name="PU5" value="<?php echo $prixU5;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo5"></span><span> USD</span><br>

            <input type = "text" list = "idproduit6" id = "Produit6" name="idProduit6" value="<?php echo $idproduit6;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit6">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU6" name="prixU6">
            <input type="number" id="quantite6" name="QuantiteP6" onchange="clickMoi()" value="<?php echo $quantite6;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu6" name="PU6" value="<?php echo $prixU6;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo6"></span><span> USD</span><br>

            <input type = "text" list = "idproduit7" id = "Produit7" name="idProduit7" value="<?php echo $idproduit7;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit7">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU7" name="prixU7">
            <input type="number" id="quantite7" name="QuantiteP7" onchange="clickMoi()" value="<?php echo $quantite7;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu7" name="PU7" value="<?php echo $prixU7;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo7"></span><span> USD</span><br>

            <input type = "text" list = "idproduit8" id = "Produit8" name="idProduit8" value="<?php echo $idproduit8;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit8">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU8" name="prixU8">
            <input type="number" id="quantite8" name="QuantiteP8" onchange="clickMoi()" value="<?php echo $quantite8;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu8" name="PU8" value="<?php echo $prixU8;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo8"></span><span> USD</span><br>

            <input type = "text" list = "idproduit9" id = "Produit9" name="idProduit9" value="<?php echo $idproduit9;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit9">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU9" name="prixU9">
            <input type="number" id="quantite9" name="QuantiteP9"onchange="clickMoi()" value="<?php echo $quantite9;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu9" name="PU9" value="<?php echo $prixU9;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo9"></span><span> USD</span><br>


            <input type = "text" list = "idproduit10" id = "Produit10" name="idProduit10" value="<?php echo $idproduit10;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit10">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU10" name="prixU10">
            <input type="number" id="quantite10" name="QuantiteP10" value="<?php echo $quantite10;?>"onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu10" name="PU10" value="<?php echo $prixU10;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo10"></span><span> USD</span><br>

            <input type = "text" list = "idproduit11" id = "Produit11" name="idProduit11" value="<?php echo $idproduit11;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit11">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU11" name="prixU11">
            <input type="number" id="quantite11" name="QuantiteP11" value="<?php echo $quantite11;?>"onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu11" name="PU11" value="<?php echo $prixU11;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo11"></span><span> USD</span><br>

            <input type = "text" list = "idproduit12" id = "Produit12" name="idProduit12" value="<?php echo $idproduit12;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit12">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU12" name="prixU12">
            <input type="number" id="quantite12" name="QuantiteP12" onchange="clickMoi()" value="<?php echo $quantite12;?>"placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu12" name="PU12" value="<?php echo $prixU12;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo12"></span><span> USD</span><br>

            <input type = "text" list = "idproduit13" id = "Produit13" name="idProduit13" value="<?php echo $idproduit13;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit13">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU13" name="prixU13">
            <input type="number" id="quantite13" name="QuantiteP13" onchange="clickMoi()" value="<?php echo $quantite13;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu13" name="PU13" value="<?php echo $prixU13;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo13"></span><span> USD</span><br>

            <input type = "text" list = "idproduit14" id = "Produit14" name="idProduit14" value="<?php echo $idproduit14;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit14">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU14" name="prixU14">
            <input type="number" id="quantite14" name="QuantiteP14" onchange="clickMoi()" value="<?php echo $quantite14;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu14" name="PU14" value="<?php echo $prixU14;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo14"></span><span> USD</span><br>

            <input type = "text" list = "idproduit15" id = "Produit15" name="idProduit15" value="<?php echo $idproduit15;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit15">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU15" name="prixU15">
            <input type="number" id="quantite15" name="QuantiteP15" value="<?php echo $quantite15;?>" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu15" name="PU15" value="<?php echo $prixU15;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo15"></span><span> USD</span><br>


            <input type = "text" list = "idproduit16" id = "Produit16" name="idProduit16" value="<?php echo $idproduit16;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit16">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU16" name="prixU16">
            <input type="number" id="quantite16" name="QuantiteP16" onchange="clickMoi()" value="<?php echo $quantite16;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu16" name="PU16" value="<?php echo $prixU16;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo16"></span><span> USD</span><br>

            <input type = "text" list = "idproduit17" id = "Produit17" name="idProduit17" value="<?php echo $idproduit17;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit17">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU17" name="prixU17">
            <input type="number" id="quantite17" name="QuantiteP17" onchange="clickMoi()" value="<?php echo $quantite17;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu17" name="PU17" value="<?php echo $prixU17;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo17"></span><span> USD</span><br>


            <input type = "text" list = "idproduit18" id = "Produit18" name="idProduit18" value="<?php echo $idproduit18;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit18">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU18" name="prixU18">
            <input type="number" id="quantite18" name="QuantiteP18" onchange="clickMoi()" value="<?php echo $quantite18;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu18" name="PU18" value="<?php echo $prixU18;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo18"></span><span> USD</span><br>

            <input type = "text" list = "idproduit19" id = "Produit19" name="idProduit19" value="<?php echo $idproduit19;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit19">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU19" name="prixU19">
            <input type="number" id="quantite19" name="QuantiteP19" onchange="clickMoi()" value="<?php echo $quantite19;?>" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu19" name="PU19" value="<?php echo $prixU19;?>" placeholder="Prix Unitaire si reduction fait..."><span id="demo19"></span><span> USD</span><br>

            <input type = "text" list = "idproduit20" id = "Produit20" name="idProduit20" value="<?php echo $idproduit20;?>" placeholder="Nom du produit ici ...">
            <datalist id="idproduit20">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU20" name="prixU20">
            <input type="number" id="quantite20" name="QuantiteP20" onchange="clickMoi()" value="<?php echo $quantite20;?>"placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu20" name="PU20" value="<?php echo $prixU20;?>"placeholder="Prix Unitaire si reduction fait..."><span id="demo20"></span><span> USD</span><br>
            <input type="hidden" name="type" value="modifVente">
            <input type="hidden" name="operation" value="<?php echo $operation?>">

            
            
            
        </form>
    </div>
    
    

    <script>
        let idProduit1 = document.forms["form1"];
        let nbr = 5;
        let tagName = document.getElementsByTagName("input");
        let longueurTotal =tagName.length;
        let tagNameD = document.getElementsByTagName('datalist');
        let longueurTotalD = tagNameD.length;
        let nbrS;
        let nbrST = "idProduit";
        var voyons = 0;
        
        document.getElementById("but").addEventListener("mouseover", calcul1);
        document.getElementById("but").addEventListener("click", total);
        document.getElementById("but").addEventListener("mouseover", verify);
        document.getElementById("envoi").addEventListener("mouseover", calcul1);
        document.getElementById("envoi").addEventListener("mouseover", verify);
        
        
        /*function clickM(){
           // document.getElementById("demo").innerHTML = idProduit1.elements[0].value;
           //document.getElementById("demo").innerHTML = document.getElementsByTagName('input').length;
           let long = document.getElementsByTagName('input').length;
           for(let j = 5; j<long; j++){
            strj = j.toString();
            document.getElementsByTagName('input')[j].placeholder = "Nom du produit"+j;
            document.getElementsByTagName('input')[j].name = "idProduit"+j;
            //document.getElementById("demo").innerHTML =document.getElementById("idProduit11").setAttribute("required","");
            document.getElementsByTagName('input')[j].list = "idProduit"+j;
            document.getElementsByTagName('datalist')[j].id = "idProduit"+j;
            
            
            //document.getElementsByTagName('datalist')[j].appendChild(document.createTextNode("<"+"?php datalist();"+" ?"+">")); 

           }
           
          // document.forms["form1"].elements[1].value = 
        }
        */
        function voirCreer(){
            i=0;
            nbrS = nbr.toString(); 
            let enString = nbrS + nbrST;
            const entree = document.createElement("input");
            idProduit1.appendChild(entree);
            idProduit1.appendChild(document.createElement("br"));
           
            tagName[longueurTotal].placeholder = "Nom du produit";
            //document.getElementsByTagName('input')[longueur].name = enString;
            //document.getElementsByTagName('input')[longueur].list = enString;
            i++;

        }
        function verify(){
            
            for(let i= 0;i<21 ; i++){
                let lettre = "Produit"+i;
                if(document.getElementById(lettre).value !=""){
                    let enlettre = "quantite"+i;
                document.getElementById(enlettre).setAttribute("required","");
                document.getElementById(enlettre).style.borderColor="green";
                }
                
            }
            
        }
        function calcul1(){
            for(let j= 0;j<21 ; j++){
                let lettre = "Produit"+j;
                let valeurT =document.getElementById(lettre).value;
                let prixU;
                let prixTableux;
                let pvT;
                let ah="quantite"+j;
                let puV = "pu"+j;
                let pr = "prixU"+j;
                let quantit =document.getElementById(ah).value;
                

                if(document.getElementById(puV).value != ""){
                    prixU = document.getElementById(puV).value;
                    if(document.getElementById(ah).value !=""){
                            pvT = prixU * quantit;
                            let demons = "demo"+j;
                            document.getElementById(demons).innerHTML = pvT;
                            document.getElementById(pr).value = prixU;
                            document.getElementById(demons).style.backgroundColor = "#555";
                            
                        }else{
                            document.getElementById(enlettre).style.border="2px solid red"; 
                        }
                }else{

                    if(document.getElementById(lettre).value !=""){
                        let enlettre = "quantite"+j;
                        prixTableux = valeurT.split(":");
                        prixU = prixTableux[2];
                        if(document.getElementById(enlettre).value !=""){
                            pvT = prixU * quantit;
                            let demons = "demo"+j;
                            document.getElementById(demons).innerHTML = pvT;
                            document.getElementById(demons).style.backgroundColor = "#555";
                            document.getElementById(pr).value = prixU;
                            //document.getElementById("datesVentes").value =Date();
                            
                            
                            
                        }else{
                            document.getElementById(enlettre).style.border="2px solid red"; 
                        }
                    
                    }
                }
               
            }
           
            
        }
        function total(){
            for(let i = 0; i < 21; i++){
                let contenu = "demo"+i;
                let y = document.getElementById(contenu).innerHTML;
                if(y != "" ){
                
                    voyons =voyons + (document.getElementById(contenu).innerHTML) *1;
                    
                }
                document.getElementById("voyons").innerHTML = voyons;
                document.getElementById("voyons").style.backgroundColor = "#777";
                document.getElementById("conversion").innerHTML = voyons*2000;
                document.getElementById("conversion").style.backgroundColor = "#777";
            }
            voyons = 0;
        }
        function clickMoi(){
           for(let i = 0; i<21; i++){
            let ident= "Produit"+i;
               if(document.getElementById(ident).value != ""){
                    
                    let quant = "quantite"+i;
                    let comparer = document.getElementById(quant).value;
                    let motComp = document.getElementById(ident).value;
                    let comparareur = motComp.split(":");
                    let valeur = comparareur[4];
                    if(valeur < comparer){
                        document.getElementById(quant).style.color = "red";
                        document.getElementById(quant).style.border = "4px solid red";
                        document.getElementById("envoi").setAttribute("disabled", "");
                    }else{
                        document.getElementById(quant).style.color = "green";
                        document.getElementById(quant).style.border = "1px solid green";
                        document.getElementById("envoi").removeAttribute("disabled");
                    }
               }
           }
        }
        
        
    </script>
</body>
</html>