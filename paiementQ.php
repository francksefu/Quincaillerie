<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franck francksfApp</title>
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
    function datalist(){
        include 'connexion.php';
        $sql = ("SELECT*FROM Ventes,Client WHERE(Ventes.idClient = Client.idClient) AND (Dette = 'Oui') GROUP BY Operation");
        $result = mysqli_query($db, $sql);
               
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='numero = :".$row["Operation"].": date : ".$row["DatesVente"]." : nom = :".$row["NomClient"].": facture :".$row["TotalFacture"].":USD idClient :".$row["idClient"].": paye :".$row["MontantPaye"].": USD Reste a payer : ".$row["TotalFacture"] -$row["MontantPaye"]."' >Total facture : ".$row["TotalFacture"]." USD: ".$row["NomClient"].": Reste a payer : ".$row["TotalFacture"] -$row["MontantPaye"]." USD</option>"; 
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
    <a href="paiementQ.php" style="background-color:#fff; color:black; border-radius:50%;">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
   
</div>
<div class="column1">
    <button type="button"  id="but" style="border-radius:20px;">Calul facture</button><br><br><span>Total facture :</span><br><br><br>
    <span id="voyons"></span><span> USD</span><br><br><br><span id="conversion"></span><span> Fc</span>
    
    
</div>
    <p>Choisissez les produits achetes : </p><br>
    <div class="column2">
    
        <form id="form1" method="POST" action="<?php  echo htmlspecialchars("facturePaie.php"); ?>">
        <input type="date"  name="DatesPaie" id="datesPaie" value="<?php echo date('Y-m-d') ?>"><br>
        <button type="submit" id="envoi" style="border-radius:15px; width : 45%; background-color :burlywood;" onmouseover="clickMoi()">Envoyer</button>
        
            
            
            <br><label for="nom">Paiement :</label><br>
            <input type = "text" list = "idpaie0" id = "Paie0" name="idPaie0"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie0">
                <?php 
                    datalist();

                ?>
            </datalist>
            
            <input type="float" id = "montant0" name="Montant0" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie1" id = "Paie1" name="idPaie1"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie1">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant1" name="Montant1" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie2" id = "Paie2" name="idPaie2"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie2">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant2" name="Montant2" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie3" id = "Paie3" name="idPaie3"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie3">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant3" name="Montant3" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie4" id = "Paie4" name="idPaie4"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie4">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant4" name="Montant4" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           


            <input type = "text" list = "idpaie5" id = "Paie5" name="idPaie5"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie5">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant5" name="Montant5" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie6" id = "Paie6" name="idPaie6"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie6">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant6" name="Montant6" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie7" id = "Paie7" name="idPaie7"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie7">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant7" name="Montant7" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie8" id = "Paie8" name="idPaie8"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie8">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant8" name="Montant8" onchange="clickMoi()" placeholder="Montant payé..."> <br>

           
             <input type = "text" list = "idpaie9" id = "Paie9" name="idPaie9"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie9">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant9" name="Montant9" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie10" id = "Paie10" name="idPaie10"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie10">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant10" name="Montant10" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie11" id = "Paie11" name="idPaie11"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie11">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant11" name="Montant11" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie12" id = "Paie12" name="idPaie12"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie12">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant12" name="Montant12" onchange="clickMoi()" placeholder="Montant payé..."> <br>

           
             <input type = "text" list = "idpaie13" id = "Paie13" name="idPaie13"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie13">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant13" name="Montant13" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie14" id = "Paie14" name="idPaie14"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie14">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant14" name="Montant14" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie15" id = "Paie15" name="idPaie15"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie15">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant15" name="Montant15" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie16" id = "Paie16" name="idPaie16"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie16">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant16" name="Montant16" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie17" id = "Paie17" name="idPaie17"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie17">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant17" name="Montant17" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            <input type = "text" list = "idpaie18" id = "Paie18" name="idPaie18"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie18">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant18" name="Montant18" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie19" id = "Paie19" name="idPaie19"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie19">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant19" name="Montant19" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           
            <input type = "text" list = "idpaie20" id = "Paie20" name="idPaie20"  placeholder="Rechercher la facture ...">
            <datalist id="idpaie20">
                <?php 
                    datalist();

                ?>
            </datalist>
            <input type="float" id = "montant20" name="Montant20" onchange="clickMoi()" placeholder="Montant payé..."> <br>
           

            
            
            
        </form>
    </div>
    
    

    <script>
        
        
        //document.getElementById("but").addEventListener("mouseover", calcul1);
       document.getElementById("but").addEventListener("mouseover", calcul1);
        document.getElementById("but").addEventListener("mouseover", verify);
        document.getElementById("envoi").addEventListener("mouseover", calcul1);
        document.getElementById("envoi").addEventListener("mouseover", verify);
        //document.getElementById("envoi").addEventListener("mouseover", clickMoi);
        
        
        
        
        
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
                    if((valeur + 1 )> comparer){
                        document.getElementById(quant).style.color = "green";
                        document.getElementById(quant).style.border = "1px solid green";
                        document.getElementById("envoi").removeAttribute("disabled");
                    }else{
                        
                        document.getElementById(quant).style.color = "red";
                        document.getElementById(quant).style.border = "4px solid red";
                        document.getElementById("envoi").setAttribute("disabled", "");
                    }
               }
           }
        }
        
        
    </script>
</body>
</html>