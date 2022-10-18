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
            background: url(imageVend1.png);
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
        input[type=text]{
            width: 60%;
            padding: 12px 20px;
            margin: 8px 20px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 18px;


        }
        
       
    </style>
</head>
<?php 
    include 'PaiementsC.php';
    function datalist(){
        include 'connexion.php';
        $sql = ("SELECT*FROM Ventes,Client WHERE(Ventes.idClient = Client.idClient) AND (Dette = 'Oui')GROUP BY Operation");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='numero = :".$row["Operation"].": date : ".$row["DatesVente"]." : nom = :".$row["NomClient"].": facture :".$row["TotalFacture"].":USD idClient :".$row["idClient"].": paye :".$row["MontantPaye"].": USD Reste a payer : ".$row["TotalFacture"] -$row["MontantPaye"]."' >Total facture : ".$row["TotalFacture"]." USD: ".$row["NomClient"].": Reste a payer : ".$row["TotalFacture"] -$row["MontantPaye"]." USD</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }


    $datesPaie = $_POST["DatesPaie"];

       
        
        $idPaie0 = htmlspecialchars($_POST["idPaie0"]); $idPaie1 = htmlspecialchars($_POST["idPaie1"]); $idPaie2 = htmlspecialchars($_POST["idPaie2"]); $idPaie3 = htmlspecialchars($_POST["idPaie3"]); $idPaie4 = htmlspecialchars($_POST["idPaie4"]); $idPaie5 = htmlspecialchars($_POST["idPaie5"]); $idPaie6 = htmlspecialchars($_POST["idPaie6"]); $idPaie7 = htmlspecialchars($_POST["idPaie7"]); $idPaie8 = htmlspecialchars($_POST["idPaie8"]);
        $idPaie9 = htmlspecialchars($_POST["idPaie9"]); $idPaie10 = htmlspecialchars($_POST["idPaie10"]); $idPaie11 = htmlspecialchars($_POST["idPaie11"]); $idPaie12 = htmlspecialchars($_POST["idPaie12"]); $idPaie13 = htmlspecialchars($_POST["idPaie13"]); $idPaie14 = htmlspecialchars($_POST["idPaie14"]); $idPaie15 = htmlspecialchars($_POST["idPaie15"]); $idPaie16 = htmlspecialchars($_POST["idPaie16"]);
        $idPaie17 = htmlspecialchars($_POST["idPaie17"]); $idPaie18 = htmlspecialchars($_POST["idPaie18"]); $idPaie19 = htmlspecialchars($_POST["idPaie19"]); $idPaie20 = htmlspecialchars($_POST["idPaie20"]);

        $montant0 = htmlspecialchars($_POST["Montant0"]); $montant1 = htmlspecialchars($_POST["Montant1"]); $montant2 = htmlspecialchars($_POST["Montant2"]); $montant3 = htmlspecialchars($_POST["Montant3"]); $montant4 = htmlspecialchars($_POST["Montant4"]); $montant5 = htmlspecialchars($_POST["Montant5"]); $montant6 = htmlspecialchars($_POST["Montant6"]); $montant7 = htmlspecialchars($_POST["Montant7"]); $montant8 = htmlspecialchars($_POST["Montant8"]);
        $montant9 = htmlspecialchars($_POST["Montant9"]); $montant10 = htmlspecialchars($_POST["Montant10"]); $montant11 = htmlspecialchars($_POST["Montant11"]); $montant12 = htmlspecialchars($_POST["Montant12"]); $montant13 = htmlspecialchars($_POST["Montant13"]); $montant14 = htmlspecialchars($_POST["Montant14"]); $montant15 = htmlspecialchars($_POST["Montant15"]); $montant16 = htmlspecialchars($_POST["Montant16"]); $montant17 = htmlspecialchars($_POST["Montant17"]);
        $montant18 = htmlspecialchars($_POST["Montant18"]); $montant19 = htmlspecialchars($_POST["Montant19"]); $montant20 = htmlspecialchars($_POST["Montant20"]);

        function insereur($idPaiem, $montant, $datesPaiem)
        {
            
            if(empty($idPaiem)){
                echo "";
            }else{
                $tableau = explode(":",$idPaiem);
                $operat = $tableau[1]*1;
                
                $ClassPaie = new PaiementsC($datesPaiem, $montant, $operat);

                $ClassPaie->misAjourPaiement();
                $ClassPaie->supprimer();
                
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
    <a href="paiementQ.php" style="background-color:#fff; color:black; border-radius:50%;">Paiements</a>
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
    
        <form id="form1" method="POST" action="<?php  echo htmlspecialchars("facturePaie.php"); ?>">
        <input type="date"  name="DatesPaie" id="datesPaie" value="<?php echo $datesPaie; ?>"><br>
        <button type="submit" id="envoi" style="border-radius:15px; width : 45%; background-color :burlywood;">Envoyer</button>
        
           
            
            <br><label for="nom">Paiement :</label><br>
            <input type = "text" list = "idpaie0" id = "Paie0" name="idPaie0" value="<?php echo $idPaie0; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie0">
                <?php 
                    datalist();

                ?>
            </datalist>
           
            <input type="float" id = "montant0" name="Montant0" value="<?php echo $montant0; ?>" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie1" id = "Paie1" name="idPaie1" value="<?php echo $idPaie1; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie1">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant1" name="Montant1" onchange="clickMoi()" value="<?php echo $montant1; ?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie2" id = "Paie2" name="idPaie2" value="<?php echo $idPaie2; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie2">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant2" name="Montant2" onchange="clickMoi()" value="<?php echo $montant2; ?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie3" id = "Paie3" name="idPaie3" value="<?php echo $idPaie3; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie3">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant3" name="Montant3" onchange="clickMoi()" value="<?php echo $montant3; ?>" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie4" id = "Paie4" name="idPaie4" value="<?php echo $idPaie4; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie4">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant4" name="Montant4" onchange="clickMoi()" value="<?php echo $montant4; ?>" placeholder="Montant payé..."> <br>
           


            <input type = "text" list = "idpaie5" id = "Paie5" name="idPaie5" value="<?php echo $idPaie5; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie5">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant5" name="Montant5" onchange="clickMoi()" value="<?php echo $montant5; ?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie6" id = "Paie6" name="idPaie6" value="<?php echo $idPaie6; ?>"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie6">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant6" name="Montant6" onchange="clickMoi()" value="<?php echo $montant6; ?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie7" id = "Paie7" name="idPaie7" value="<?php echo $idPaie7; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie7">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant7" name="Montant7" value="<?php echo $montant7; ?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie8" id = "Paie8" name="idPaie8" value="<?php echo $idPaie8; ?>"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie8">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant8" name="Montant8" onchange="clickMoi()" value="<?php echo $montant8; ?>" placeholder="Montant payé..."> <br>

           
             <input type = "text" list = "idpaie9" id = "Paie9" name="idPaie9" value="<?php echo $idPaie9; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie9">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant9" name="Montant9" onchange="clickMoi()" value="<?php echo $montant9; ?>" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie10" id = "Paie10" name="idPaie10" value="<?php echo $idPaie10; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie10">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant10" name="Montant10" onchange="clickMoi()" value="<?php echo $montant10;?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie11" id = "Paie11" name="idPaie11" value="<?php echo $idPaie11; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie11">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant11" name="Montant11" onchange="clickMoi()" value="<?php echo $montant11;?>"  placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie12" id = "Paie12" name="idPaie12" value="<?php echo $idPaie12; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie12">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant12" name="Montant12" onchange="clickMoi()" value="<?php echo $montant12;?>" placeholder="Montant payé..."> <br>

           
             <input type = "text" list = "idpaie13" id = "Paie13" name="idPaie13" value="<?php echo $idPaie13; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie13">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant13" name="Montant13" onchange="clickMoi()" value="<?php echo $montant13;?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie14" id = "Paie14" name="idPaie14" value="<?php echo $idPaie14; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie14">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant14" name="Montant14" onchange="clickMoi()" value="<?php echo $montant14;?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie15" id = "Paie15" name="idPaie15" value="<?php echo $idPaie15; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie15">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant15" name="Montant15" onchange="clickMoi()" value="<?php echo $montant15;?>" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie16" id = "Paie16" name="idPaie16" value="<?php echo $idPaie16; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie16">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant16" name="Montant16" onchange="clickMoi()" value="<?php echo $montant16;?>" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie17" id = "Paie17" name="idPaie17" value="<?php echo $idPaie17; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie17">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant17" name="Montant17" onchange="clickMoi()" value="<?php echo $montant17;?>" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie18" id = "Paie18" name="idPaie18" value="<?php echo $idPaie18; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie18">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant18" name="Montant18" onchange="clickMoi()" value="<?php echo $montant18;?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie19" id = "Paie19" name="idPaie19" value="<?php echo $idPaie19; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie19">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant19" name="Montant19" onchange="clickMoi()" value="<?php echo $montant19;?>" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie20" id = "Paie20" name="idPaie20" value="<?php echo $idPaie20; ?>" placeholder="Rechercher la facture ...">
            <datalist id="idpaie20">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant20" name="Montant20" onchange="clickMoi()" value="<?php echo $montant20;?>" placeholder="Montant payé..."> <br>
           

            
            
            
        </form>
    </div>
    
    

    <script>
        
        
        //document.getElementById("but").addEventListener("mouseover", calcul1);
       document.getElementById("but").addEventListener("mouseover", calcul1);
        document.getElementById("but").addEventListener("mouseover", verify);
        document.getElementById("envoi").addEventListener("mouseover", calcul1);
        document.getElementById("envoi").addEventListener("mouseover", verify);
        document.getElementById("envoi").addEventListener("mouseover", clickMoi);
        
        
        
        
        
        function verify(){
            
            for(let i= 0;i<21 ; i++){
                let lettre = "Paie"+i;
                if(document.getElementById(lettre).value !=""){
                    let enlettre = "montant"+i;
                document.getElementById(enlettre).setAttribute("required","");
                document.getElementById(enlettre).style.borderColor="green";
                }
                
            }
            
        }
        function calcul1(){
            let tot = 0;
            for(let j= 0;j<21 ; j++){
                let mont = "montant"+j;
                let valeurT = document.getElementById(mont).value;
                let enpaie = "Paie"+j;
                let verif = document.getElementById(enpaie).value;
                
                
                

                if(document.getElementById(enpaie).value != ""){
                    tot += document.getElementById(mont).value * 1 ;
                }
          
            }
           document.getElementById("voyons").innerHTML = tot;
           document.getElementById("voyons").style.backgroundColor = "#777";
            document.getElementById("conversion").innerHTML = tot * 2000;
            document.getElementById("conversion").style.backgroundColor = "#777";
            
        }
        function clickMoi(){
           for(let i = 0; i<21; i++){
            let ident= "Paie"+i;
               if(document.getElementById(ident).value != ""){
                    
                    let quant = "montant"+i;
                    let comparer = document.getElementById(quant).value * 1;
                    let motComp = document.getElementById(ident).value;
                    let comparareur = motComp.split(":");
                    let valeur = comparareur[13]*1;
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


<!-- Archives factures paiements  -->
<form id="form1" method="POST" action="<?php echo htmlspecialchars("paimentsVerif.php") ?>">
            
            <input type="hidden" name="DatesPaie" value="<?php echo $datesPaie; ?>">
            
            <input type="hidden" name="idPaie0" value="<?php echo $idPaie0; ?>">
            <input type="hidden" name="Montant0" value="<?php echo $montant0; ?>">
           

            <input type="hidden" name="idPaie1" value="<?php echo $idPaie1; ?>">
            <input type="hidden" name="Montant1" value="<?php echo $montant1; ?>">
            
            <input type="hidden" name="idPaie2" value="<?php echo $idPaie2; ?>">
            <input type="hidden" name="Montant2" value="<?php echo $montant2; ?>">
            
            <input type="hidden" name="idPaie3" value="<?php echo $idPaie3; ?>">
            <input type="hidden" name="Montant3" value="<?php echo $montant3; ?>">
            
            <input type="hidden" name="idPaie4" value="<?php echo $idPaie4; ?>">
            <input type="hidden" name="Montant4" value="<?php echo $montant4; ?>">
            
            <input type="hidden" name="idPaie5" value="<?php echo $idPaie5; ?>">
            <input type="hidden" name="Montant5" value="<?php echo $montant5; ?>">
            
            <input type="hidden" name="idPaie6" value="<?php echo $idPaie6; ?>">
            <input type="hidden" name="Montant6" value="<?php echo $montant6; ?>">
            
            <input type="hidden" name="idPaie7" value="<?php echo $idPaie7; ?>">
            <input type="hidden" name="Montant7" value="<?php echo $montant7; ?>">
            
            <input type="hidden" name="idPaie8" value="<?php echo $idPaie8; ?>">
            <input type="hidden" name="Montant8" value="<?php echo $montant8; ?>">
            
            <input type="hidden" name="idPaie9" value="<?php echo $idPaie9; ?>">
            <input type="hidden" name="Montant9" value="<?php echo $montant9; ?>">
            
            <input type="hidden" name="idPaie10" value="<?php echo $idPaie10; ?>">
            <input type="hidden" name="Montant10" value="<?php echo $montant10; ?>">
            
            <input type="hidden" name="idPaie11" value="<?php echo $idPaie11; ?>">
            <input type="hidden" name="Montant11" value="<?php echo $montant11; ?>">
            
            <input type="hidden" name="idPaie12" value="<?php echo $idPaie12; ?>">
            <input type="hidden" name="Montant12" value="<?php echo $montant12; ?>">
            
            <input type="hidden" name="idPaie13" value="<?php echo $idPaie13; ?>">
            <input type="hidden" name="Montant13" value="<?php echo $montant13; ?>">
            
            <input type="hidden" name="idPaie14" value="<?php echo $idPaie14; ?>">
            <input type="hidden" name="Montant14" value="<?php echo $montant14; ?>">
            
            <input type="hidden" name="idPaie15" value="<?php echo $idPaie15; ?>">
            <input type="hidden" name="Montant15" value="<?php echo $montant15; ?>">
            
            <input type="hidden" name="idPaie16" value="<?php echo $idPaie16; ?>">
            <input type="hidden" name="Montant16" value="<?php echo $montant16; ?>">
            
            <input type="hidden" name="idPaie17" value="<?php echo $idPaie17; ?>">
            <input type="hidden" name="Montant17" value="<?php echo $montant17; ?>">
            
            <input type="hidden" name="idPaie18" value="<?php echo $idPaie18; ?>">
            <input type="hidden" name="Montant18" value="<?php echo $montant18; ?>">
            
            <input type="hidden" name="idPaie19" value="<?php echo $idPaie19; ?>">
            <input type="hidden" name="Montant19" value="<?php echo $montant19; ?>">
            
            <input type="hidden" name="idPaie20" value="<?php echo $idPaie20; ?>">
            <input type="hidden" name="Montant20" value="<?php echo $montant20; ?>">
            
            <input type="submit" style="margin-left: 65%;" value="Modifier facture">
        </form>
</body>
</html>