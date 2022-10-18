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
            <!-- zone de connexion -->

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
            background: url(imageVend2.png);
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
                echo"<option value='".$row["idProduit"].": ".$row["Nom"]." : ".$row["PrixAchat"].": USD = PA' >".$row["Nom"]." : ".$row["PrixVente"]." USD = PV</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }

    
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
    <a href="" >Caisse</a>
    
</div>
<div class="column1">
    <button type="button"  id="but" style="border-radius:20px;">Calul facture</button><br><br><span>Total facture :</span><br><br><br>
    <span id="voyons"></span><span> USD</span><br><br><br><span id="conversion"></span><span> Fc</span>
    
    
</div>
    <p>Choisissez les produits achetes : </p><br>
    <div class="column2">
    
        <form id="form1" method="POST" action="<?php  echo htmlspecialchars("factureApprov.php"); ?>">
        <input type="date"  name="DatesVentes" id="datesVentes" value="<?php echo date('Y-m-d') ?>"><br>
        <input type="submit" id="envoi"  value="Envoyer">
        
          
            <br><label for="nom">factures :</label><br>
            <input type = "text" list = "idproduit0" id = "Produit0" name="idProduit0" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit0">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="number" id="quantite0" name="QuantiteP0" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu0" name="PU0" placeholder="Prix Unitaire..."><span id="demo0" ></span><span> USD</span> <br>
            <input type="hidden" id="prixU0" name="prixU0">

            <input type = "text" list = "idproduit1" id = "Produit1" name="idProduit1" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit1">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="number" id="quantite1" name="QuantiteP1" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu1" name="PU1" placeholder="Prix Unitaire..."><span id="demo1"></span><span> USD</span><br>
            <input type="hidden" id="prixU1" name="prixU1">

            <input type = "text" list = "idproduit2" id = "Produit2" name="idProduit2" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit2">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU2" name="prixU2">
            <input type="number" id="quantite2" name="QuantiteP2" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu2" name="PU2" placeholder="Prix Unitaire si reduction fait..."><span id="demo2"></span><span> USD</span><br>

            <input type = "text" list = "idproduit3" id = "Produit3" name="idProduit3" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit3">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="hidden" id="prixU3" name="prixU3">
            <input type="number" id="quantite3" name="QuantiteP3" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu3" name="PU3" placeholder="Prix Unitaire si reduction fait..."><span id="demo3"></span><span> USD</span><br>


            <input type = "text" list = "idproduit4" id = "Produit4" name="idProduit4" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit4">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU4" name="prixU4">
            <input type="number" id="quantite4" name="QuantiteP4" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu4" name="PU4" placeholder="Prix Unitaire si reduction fait..."><span id="demo4"></span><span> USD</span><br>



            <input type = "text" list = "idproduit5" id = "Produit5" name="idProduit5" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit5">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU5" name="prixU5">
            <input type="number" id="quantite5" name="QuantiteP5" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu5" name="PU5" placeholder="Prix Unitaire si reduction fait..."><span id="demo5"></span><span> USD</span><br>

            <input type = "text" list = "idproduit6" id = "Produit6" name="idProduit6" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit6">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU6" name="prixU6">
            <input type="number" id="quantite6" name="QuantiteP6" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu6" name="PU6" placeholder="Prix Unitaire si reduction fait..."><span id="demo6"></span><span> USD</span><br>

            <input type = "text" list = "idproduit7" id = "Produit7" name="idProduit7" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit7">
                <?php 
                    datalist();
                ?>
            </datalist>
            <input type="hidden" id="prixU7" name="prixU7">
            <input type="number" id="quantite7" name="QuantiteP7" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu7" name="PU7" placeholder="Prix Unitaire si reduction fait..."><span id="demo7"></span><span> USD</span><br>

            <input type = "text" list = "idproduit8" id = "Produit8" name="idProduit8" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit8">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU8" name="prixU8">
            <input type="number" id="quantite8" name="QuantiteP8" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu8" name="PU8" placeholder="Prix Unitaire si reduction fait..."><span id="demo8"></span><span> USD</span><br>

            <input type = "text" list = "idproduit9" id = "Produit9" name="idProduit9" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit9">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU9" name="prixU9">
            <input type="number" id="quantite9" name="QuantiteP9" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu9" name="PU9" placeholder="Prix Unitaire si reduction fait..."><span id="demo9"></span><span> USD</span><br>


            <input type = "text" list = "idproduit10" id = "Produit10" name="idProduit10" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit10">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU10" name="prixU10">
            <input type="number" id="quantite10" name="QuantiteP10" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu10" name="PU10" placeholder="Prix Unitaire si reduction fait..."><span id="demo10"></span><span> USD</span><br>

            <input type = "text" list = "idproduit11" id = "Produit11" name="idProduit11" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit11">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU11" name="prixU11">
            <input type="number" id="quantite11" name="QuantiteP11" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu11" name="PU11" placeholder="Prix Unitaire si reduction fait..."><span id="demo11"></span><span> USD</span><br>

            <input type = "text" list = "idproduit12" id = "Produit12" name="idProduit12" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit12">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU12" name="prixU12">
            <input type="number" id="quantite12" name="QuantiteP12" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu12" name="PU12" placeholder="Prix Unitaire si reduction fait..."><span id="demo12"></span><span> USD</span><br>

            <input type = "text" list = "idproduit13" id = "Produit13" name="idProduit13" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit13">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU13" name="prixU13">
            <input type="number" id="quantite13" name="QuantiteP13" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu13" name="PU13" placeholder="Prix Unitaire si reduction fait..."><span id="demo13"></span><span> USD</span><br>

            <input type = "text" list = "idproduit14" id = "Produit14" name="idProduit14" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit14">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU14" name="prixU14">
            <input type="number" id="quantite14" name="QuantiteP14" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu14" name="PU14" placeholder="Prix Unitaire si reduction fait..."><span id="demo14"></span><span> USD</span><br>

            <input type = "text" list = "idproduit15" id = "Produit15" name="idProduit15" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit15">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU15" name="prixU15">
            <input type="number" id="quantite15" name="QuantiteP15" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu15" name="PU15" placeholder="Prix Unitaire si reduction fait..."><span id="demo15"></span><span> USD</span><br>


            <input type = "text" list = "idproduit16" id = "Produit16" name="idProduit16" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit16">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU16" name="prixU16">
            <input type="number" id="quantite16" name="QuantiteP16" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu16" name="PU16" placeholder="Prix Unitaire si reduction fait..."><span id="demo16"></span><span> USD</span><br>

            <input type = "text" list = "idproduit17" id = "Produit17" name="idProduit17" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit17">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU17" name="prixU17">
            <input type="number" id="quantite17" name="QuantiteP17" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu17" name="PU17" placeholder="Prix Unitaire si reduction fait..."><span id="demo17"></span><span> USD</span><br>


            <input type = "text" list = "idproduit18" id = "Produit18" name="idProduit18" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit18">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU18" name="prixU18">
            <input type="number" id="quantite18" name="QuantiteP18" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu18" name="PU18" placeholder="Prix Unitaire si reduction fait..."><span id="demo18"></span><span> USD</span><br>

            <input type = "text" list = "idproduit9" id = "Produit19" name="idProduit19" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit19">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU19" name="prixU19">
            <input type="number" id="quantite19" name="QuantiteP19" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu19" name="PU19" placeholder="Prix Unitaire si reduction fait..."><span id="demo19"></span><span> USD</span><br>

            <input type = "text" list = "idproduit20" id = "Produit20" name="idProduit20" onchange="clickMoi()" placeholder="Nom du produit ici ...">
            <datalist id="idproduit20">
                <?php datalist(); ?>
            </datalist>
            <input type="hidden" id="prixU20" name="prixU20">
            <input type="number" id="quantite20" name="QuantiteP20" placeholder="Mettez ici la quantite...">
            <input type="float" id = "pu20" name="PU20" placeholder="Prix Unitaire si reduction fait..."><span id="demo20"></span><span> USD</span><br>
            <input type="hidden" name="type" value="nouvelVente">
            

            
            
            
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
        
        
        
    </script>
</body>
</html>