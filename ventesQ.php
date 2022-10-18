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
    <title>Document</title>
    <link rel="stylesheet" href="venteQ.css" media="screen" type="text/css" />
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
        span{
            width: 10%;
            background-color: yellowgreen;
            color: white;
            padding: 10px 14px;
            margin: 8px 0;
           
            border-radius: 16px;
    
        }
        #divClient{
            display: none;
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
                echo"<option value='".$row["idProduit"].": ".$row["Nom"]." :".$row["PrixVente"].": USD Qtite :".$row["QuantiteStock"].":pv min = :".$row["PrixVmin"]."'>".$row["Nom"]." : ".$row["PrixVente"]." USD</option>"; 
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
    <a href="ventesQ.php" style="background-color:#fff; color:black; border-radius:50%;">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
    <a href="contratQ.php" >Contrat</a>
  
</div>
<div class="column1">
    <button type="button"  id="but" style="border-radius:20px;" class = "btn btn-primary">Calul facture</button><br><br><span>Total facture :</span><br><br><br>
    <span id="voyons"></span><span> USD</span><br><br><br><span id="conversion"></span><span> Fc</span>
   
</div>
    <p style="color: #fff;">Choisissez les produits achetes : </p><br>
    <div class="column2">
    
        <form id="form1" method="POST" action="<?php  echo htmlspecialchars("facture.php"); ?>">
        <input type="date" class = "form-control" name="DatesVentes" id="datesVentes" value="<?php $d = strtotime("today"); echo date('Y-m-d',$d); ?>" ><br>
        <div id="divACli"><button id = "creeClient" class = "btn btn-primary"  onclick="hiddenCreer()" style="width: 20%; border-radius: 20px;">Creer Client</button>Mr, Mme <input type="text" list="dataclient" id = "idClient" name="Client" placeholder="Ecriver ici le nom du client"required></div> <div id="divClient"><button id = "clientExistant" onclick="hiddenAncien()" style="width: 20%; border-radius: 20px; background-color: yellow;">Client Existant</button>Mr, Mme <input type="text" name="NewClient" id = "newClient" placeholder="Nom du nouveau client"></div>
        <button type="submit" id="envoi" onmouseover ="clickMoi()" style="width: 40%;border-radius:20px;" class="btn btn-primary">Envoyer</button>
        
        <datalist id="dataclient">
                <?php 
                    dataclient();

                ?>
            </datalist>
            <select name="Dette" style="width: 25%; background-color:darkkhaki; margin: 20px;" class = "form-control">
                <option value="Non">facture a payer cash</option>
                <option value="Oui"> Dette </option>
            </select>
            
            
            <br><label for="nom">factures :</label><br>

            <span  onclick="effaceRapide0()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit0" id = "Produit0" name="idProduit0" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit0">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" class = "form-control" id="quantite0" name="QuantiteP0"onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu0" name="PU0" onchange="clickPrix()" placeholder="Prix Unitaire..."><span id="demo0" ></span><span> USD</span> <br>
            <input type="hidden" id="prixU0" name="prixU0">
            
            <span id="effaceRapide" onclick="effaceRapide1()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit1" id = "Produit1" name="idProduit1"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit1">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" class = "form-control" id="quantite1" name="QuantiteP1" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu1" onchange="clickPrix()" name="PU1" placeholder="Prix Unitaire..."><span id="demo1"></span><span> USD</span><br>
            <input type="hidden" id="prixU1" name="prixU1">

            <span  onclick="effaceRapide2()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit2" id = "Produit2" name="idProduit2"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit2">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU2" name="prixU2">
            <input type="float" class = "form-control" id="quantite2" name="QuantiteP2" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu2" name="PU2" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo2"></span><span> USD</span><br>

            <span  onclick="effaceRapide3()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit3" id = "Produit3" name="idProduit3"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit3">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU3" name="prixU3">
            <input type="float" class = "form-control" id="quantite3" name="QuantiteP3" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu3" name="PU3" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo3"></span><span> USD</span><br>

            <span  onclick="effaceRapide4()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit4" id = "Produit4" name="idProduit4" placeholder="Nom du produit ici ...">
            <datalist id="idproduit4">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU4" name="prixU4">
            <input type="float" class = "form-control" id="quantite4" name="QuantiteP4" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu4" name="PU4" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo4"></span><span> USD</span><br>


            <span  onclick="effaceRapide5()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit5" id = "Produit5" name="idProduit5"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit5">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU5" name="prixU5">
            <input type="float" class = "form-control" id="quantite5" name="QuantiteP5" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu5" name="PU5" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo5"></span><span> USD</span><br>

            <span  onclick="effaceRapide6()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text"class = "form-control" list = "idproduit6" id = "Produit6" name="idProduit6"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit6">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU6" name="prixU6">
            <input type="float" class = "form-control" id="quantite6" name="QuantiteP6" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu6" name="PU6" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo6"></span><span> USD</span><br>

            <span  onclick="effaceRapide7()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit7" id = "Produit7" name="idProduit7"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit7">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU7" name="prixU7">
            <input type="float" class = "form-control" id="quantite7" name="QuantiteP7" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu7" name="PU7" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo7"></span><span> USD</span><br>

            <span  onclick="effaceRapide8()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit8" id = "Produit8" name="idProduit8" placeholder="Nom du produit ici ...">
            <datalist id="idproduit8">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU8" name="prixU8">
            <input type="float" class = "form-control" id="quantite8" name="QuantiteP8" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu8" name="PU8" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo8"></span><span> USD</span><br>

            <span  onclick="effaceRapide9()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit9" id = "Produit9" name="idProduit9"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit9">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU9" name="prixU9">
            <input type="number" class = "form-control" id="quantite9" name="QuantiteP9" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu9" name="PU9" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo9"></span><span> USD</span><br>

            <span  onclick="effaceRapide10()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit10" id = "Produit10" name="idProduit10"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit10">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU10" name="prixU10">
            <input type="number" class = "form-control" id="quantite10" name="QuantiteP10" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu10" name="PU10" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo10"></span><span> USD</span><br>

            <span  onclick="effaceRapide11()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit11" id = "Produit11" name="idProduit11"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit11">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU11" name="prixU11">
            <input type="number" class = "form-control" id="quantite11" name="QuantiteP11" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu11" name="PU11" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo11"></span><span> USD</span><br>

            <span  onclick="effaceRapide12()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit12" id = "Produit12" name="idProduit12" placeholder="Nom du produit ici ...">
            <datalist id="idproduit12">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU12" name="prixU12">
            <input type="number" class = "form-control" id="quantite12" name="QuantiteP12" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu12" name="PU12" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo12"></span><span> USD</span><br>

            <span  onclick="effaceRapide13()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit13" id = "Produit13" name="idProduit13"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit13">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU13" name="prixU13">
            <input type="number" class = "form-control" id="quantite13" name="QuantiteP13" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu13" name="PU13" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo13"></span><span> USD</span><br>

            <span  onclick="effaceRapide14()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit14" id = "Produit14" name="idProduit14"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit14">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU14" name="prixU14">
            <input type="number" class = "form-control" id="quantite14" name="QuantiteP14" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu14" name="PU14" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo14"></span><span> USD</span><br>

            <span  onclick="effaceRapide15()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit15" id = "Produit15" name="idProduit15"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit15">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU15" name="prixU15">
            <input type="number" class = "form-control" id="quantite15" name="QuantiteP15" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu15" name="PU15" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo15"></span><span> USD</span><br>


            <span  onclick="effaceRapide16()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit16" id = "Produit16" name="idProduit16"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit16">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU16" name="prixU16">
            <input type="number" class = "form-control" id="quantite16" name="QuantiteP16" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu16" name="PU16" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo16"></span><span> USD</span><br>

            <span  onclick="effaceRapide17()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit17" id = "Produit17" name="idProduit17"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit17">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU17" name="prixU17">
            <input type="number" class = "form-control" id="quantite17" name="QuantiteP17" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu17" onchange="clickPrix()" name="PU17" placeholder="Prix Unitaire si reduction fait..."><span id="demo17"></span><span> USD</span><br>


            <span  onclick="effaceRapide18()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit18" id = "Produit18" name="idProduit18" placeholder="Nom du produit ici ...">
            <datalist id="idproduit18">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU18" name="prixU18">
            <input type="number" class = "form-control" id="quantite18" name="QuantiteP18" onchange="clickMoi()"placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu18" onchange="clickPrix()" name="PU18" placeholder="Prix Unitaire si reduction fait..."><span id="demo18"></span><span> USD</span><br>

            <span  onclick="effaceRapide19()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit19" id = "Produit19" name="idProduit19"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit19">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU19" name="prixU19">
            <input type="number" class = "form-control" id="quantite19" name="QuantiteP19" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu19" onchange="clickPrix()" name="PU19" placeholder="Prix Unitaire si reduction fait..."><span id="demo19"></span><span> USD</span><br>

            <span  onclick="effaceRapide20()" style=" color :aliceblue; font-size:40px; background:transparent; "> &Cross;</span>
            <input type = "text" class = "form-control" list = "idproduit20" id = "Produit20" name="idProduit20"  placeholder="Nom du produit ici ...">
            <datalist id="idproduit20">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU20" name="prixU20">
            <input type="number" class = "form-control" id="quantite20" name="QuantiteP20" onchange="clickMoi()" placeholder="Mettez ici la quantite...">
            <input type="float" class = "form-control" id = "pu20" name="PU20" onchange="clickPrix()" placeholder="Prix Unitaire si reduction fait..."><span id="demo20"></span><span> USD</span><br>
            <input type="hidden" class = "form-control" name="type" value="nouvelVente">
            

            
            
            
        </form>
    </div>
    
    <?php } ?>

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
        document.getElementById("envoi").addEventListener("mouseover", clickPrix);
        
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
                    let valeur = comparareur[4]*1;
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

        function clickPrix(){
           for(let i = 0; i<21; i++){
            let ident= "Produit"+i;
            
               if(document.getElementById(ident).value != "" ){
                    
                    let prixVmin = "pu"+i;
                    let comparer = document.getElementById(prixVmin).value;
                    let motComp = document.getElementById(ident).value;
                    let comparareur = motComp.split(":");
                    let valeur = comparareur[6]*1;
                    if(document.getElementById(prixVmin) != 0){
                        if(valeur > comparer){
                            document.getElementById(prixVmin).style.color = "red";
                            //document.getElementById(prixVmin).style.border = "4px solid red";
                            //document.getElementById("envoi").setAttribute("disabled", "");
                        }else{
                            document.getElementById(prixVmin).style.color = "green";
                            document.getElementById(prixVmin).style.border = "1px solid green";
                           // document.getElementById("envoi").removeAttribute("disabled");
                        }
                    }    
               }
           }
        }

        function hiddenCreer (){
            document.getElementById("divClient").style.display = "block";
            document.getElementById("divACli").style.display = "none";
            document.getElementById("newClient").setAttribute("required", "");
            document.getElementById("idClient").removeAttribute("required");

        }
        function hiddenAncien (){
            document.getElementById("divClient").style.display = "none";
            document.getElementById("divACli").style.display = "block";
            document.getElementById("idClient").setAttribute("required", "");
            document.getElementById("newClient").removeAttribute("required");

        }
        function effaceRapide0(){
            document.getElementById("Produit0").value = ""; document.getElementById("quantite0").removeAttribute("required");document.getElementById("quantite0").value = ""; document.getElementById("pu0").value = "";
        }
        function effaceRapide1(){
            document.getElementById("Produit1").value = ""; document.getElementById("quantite1").removeAttribute("required"); document.getElementById("quantite1").value = ""; document.getElementById("pu1").value = "";
        }
        function effaceRapide2(){
            document.getElementById("Produit2").value = ""; document.getElementById("quantite2").removeAttribute("required"); document.getElementById("quantite2").value = ""; document.getElementById("pu2").value = "";
        }
        function effaceRapide3(){
            document.getElementById("Produit3").value = ""; document.getElementById("quantite3").removeAttribute("required"); document.getElementById("quantite3").value = ""; document.getElementById("pu3").value = "";
        }
        function effaceRapide4(){
            document.getElementById("Produit4").value = ""; document.getElementById("quantite4").removeAttribute("required"); document.getElementById("quantite4").value = ""; document.getElementById("pu4").value = "";
        }
        function effaceRapide5(){
            document.getElementById("Produit5").value = ""; document.getElementById("quantite5").removeAttribute("required"); document.getElementById("quantite5").value = ""; document.getElementById("pu5").value = "";
        }
        function effaceRapide6(){
            document.getElementById("Produit6").value = ""; document.getElementById("quantite6").removeAttribute("required"); document.getElementById("quantite6").value = ""; document.getElementById("pu6").value = "";
        }
        function effaceRapide7(){
            document.getElementById("Produit7").value = ""; document.getElementById("quantite7").removeAttribute("required"); document.getElementById("quantite7").value = ""; document.getElementById("pu7").value = "";
        }
        function effaceRapide8(){
            document.getElementById("Produit8").value = ""; document.getElementById("quantite8").removeAttribute("required"); document.getElementById("quantite8").value = ""; document.getElementById("pu8").value = "";
        }
        function effaceRapide9(){
            document.getElementById("Produit9").value = ""; document.getElementById("quantite9").removeAttribute("required"); document.getElementById("quantite9").value = ""; document.getElementById("pu9").value = "";
        }
        function effaceRapide10(){
            document.getElementById("Produit10").value = ""; document.getElementById("quantite10").removeAttribute("required"); document.getElementById("quantite10").value = ""; document.getElementById("pu10").value = "";
        }
        function effaceRapide11(){
            document.getElementById("Produit11").value = ""; document.getElementById("quantite11").removeAttribute("required"); document.getElementById("quantite11").value = ""; document.getElementById("pu11").value = "";
        }
        function effaceRapide12(){
            document.getElementById("Produit12").value = ""; document.getElementById("quantite12").removeAttribute("required"); document.getElementById("quantite12").value = ""; document.getElementById("pu12").value = "";
        }
        function effaceRapide13(){
            document.getElementById("Produit13").value = ""; document.getElementById("quantite13").removeAttribute("required"); document.getElementById("quantite13").value = ""; document.getElementById("pu13").value = "";
        }
        function effaceRapide14(){
            document.getElementById("Produit14").value = ""; document.getElementById("quantite14").removeAttribute("required"); document.getElementById("quantite14").value = ""; document.getElementById("pu14").value = "";
        }
        function effaceRapide15(){
            document.getElementById("Produit15").value = ""; document.getElementById("quantite15").removeAttribute("required"); document.getElementById("quantite15").value = ""; document.getElementById("pu15").value = "";
        }
        function effaceRapide16(){
            document.getElementById("Produit16").value = ""; document.getElementById("quantite16").removeAttribute("required"); document.getElementById("quantite16").value = ""; document.getElementById("pu16").value = "";
        }
        function effaceRapide17(){
            document.getElementById("Produit17").value = ""; document.getElementById("quantite17").removeAttribute("required"); document.getElementById("quantite17").value = ""; document.getElementById("pu17").value = "";
        }
        function effaceRapide18(){
            document.getElementById("Produit18").value = ""; document.getElementById("quantite18").removeAttribute("required"); document.getElementById("quantite18").value = ""; document.getElementById("pu18").value = "";
        }
        function effaceRapide19(){
            document.getElementById("Produit19").value = ""; document.getElementById("quantite19").removeAttribute("required"); document.getElementById("quantite19").value = ""; document.getElementById("pu19").value = "";
        }
        function effaceRapide20(){
            document.getElementById("Produit20").value = ""; document.getElementById("quantite20").removeAttribute("required"); document.getElementById("quantite20").value = ""; document.getElementById("pu20").value = "";
        }
        
    </script>
</body>
</html>