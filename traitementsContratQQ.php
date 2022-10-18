<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>francksfApp</title>
    <link rel="stylesheet" href="formulaire.css" media = "screen" type="text/css"/>
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
            background-repeat: no-repeat;
        }
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
        .paragraph{
            font-size: 20px;
            border: 1px solid black;
            border-radius: 20px;
            padding: 10px;
            width: 30%;
            margin: 30px;
            background-color: #fff;
        }
        html{
            background: url(albin.JPG);
            background-size: cover;
        }
        tr{
            background-color:#fff;
        }
        span{
            color: goldenrod;
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
    </style>
</head>
<body>
    <div  class="header" style="background-color: transparent;">
            <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
            <a href="etatsQ.php" >Les Etats</a>
    </div>
    
        
        
        
    
    <div style="border:0px solid black;"><!--  Debut requette pour l affichage de la facture -->
    <?php
    //Nous commencons le processus de fabrication d un contrat
        include 'connexion.php';
        
        $envoie = htmlspecialchars($_POST["Envoie"]);

        
// nous ne recevons que de chiffre ici mdrrr je suis fort !!!c est au moment de revenir dans le code que l on sen l ingeniosite
        $client = htmlspecialchars($_POST["Client"]);
        $nomClientC = htmlspecialchars($_POST["NomClientC"]);
        
       
        
        //
        
        $paTT = 0; $paCM = 0; $paCA = 0;
        $pvTT = 0; $pvCM = 0; $pvCA = 0;
        $bTT = 0; $bCM = 0; $bCA;

        $rreqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$client.") GROUP BY Operation order by Operation DESC limit 500");
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
            echo"<p class='paragraph'style = 'width : 70%'><b>Total </b>:<br> Prix d achat total : <span>".$paTT." USD </span> ; Prix de vente total : <span>".$pvTT." USD</span>; ce qui nous fait un benefice de : ".$pvTT - $paTT." USD<br>";
            echo"<b>Produit acheté chez moi </b>:<br> Prix d achat total : <span>".$paCM." USD  </span>; Prix de vente total : <span>".$pvCM." USD</span>; ce qui nous fait un benefice de : ".$pvCM - $paCM." USD<br>";
            echo"<b>Produit acheté ailleur </b>:<br> Prix d achat total : <span>".$paCA." USD  </span>; Prix de vente total : <span>".$pvCA." USD</span>; ce qui nous fait un benefice de : ".$pvCA - $paCA." USD<br></p>";
        }else{echo " Pas de contrat";}

        $reqSql= ("SELECT *FROM Contrat WHERE (idClient = ".$client.") GROUP BY Operation order by Operation DESC ");
        $result= mysqli_query($db, $reqSql);
        if(mysqli_num_rows($result)>0){
            echo"<p class='paragraph'>Client  : <i>".$nomClientC."</i></p>";
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
        }else{echo "<p class = 'paragraph' > Ce client n a pas de contrat . merci!</p> ";}
       

    ?>
    </div><!-- fin affichage de la facture -->
    
    <div class="footer">
        <h2>&copy copyrigth 2022</h2>
        <p>franck sefu +243 973359746</p>
    </div>
   
</body>
</html>