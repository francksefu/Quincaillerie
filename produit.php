<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>franckApp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
    <style>
        html{
            background: url(imageVend.png);
            background-size: cover;
            background-repeat: no-repeat;
        }
       
       
   
        #nouvelPP  {
            display: none;
        }
        #modify {
             display: none;
        }
        #delet { 
            display: none;
        }
        #region{
            display: none;
        }
        table{
            width : 100%;
        }
        button{
            display: block;
            color: #000;
            padding: 14px 8px;
            text-decoration: none;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            border-radius: 20px;
            margin: 10px;

        }
        th{
            background-color: yellowgreen;
        }
        button:hover{
            background-color: #555;
            color: white;
            border-radius: 20px;
        }
        td{
            text-align: center;
        }
       
    </style>

</head>
<body >
<div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
    </div>

<div class="topnav">
    <a href="accueilEntreprise.php">Accueil</a>
    <a href="produitQ.php" class="active">Produit</a>
    <a href="bonusPerte.php">Bonus et Perte</a>
    <a href="sortieQ.php">Sorties</a>
    <a href="ventesQ.php">Ventes</a>
    <a href="clientQ.php">Client</a>
    <a href="paiementQ.php">Paiements</a>
    <a href="detteEntrepriseQ.php">Dette Entreprise</a>
    <a href="etatsQ.php" >Les Etats</a>
    <a href="resumeQ.php" >Resume</a>
    
</div>

        <div style ="margin: 20px 10%; background-color: #fff;">
            <?php
                include 'connexion.php';
                        
                $reqSql= ("SELECT idProduit, Nom, PrixAchat, PrixVente, QuantiteStock,DescriptionP, PrixVmin FROM Produit order by idProduit asc");
                $result= mysqli_query($db, $reqSql);
                if(mysqli_num_rows($result)>0){
                    echo "<table id='Customers'><tr><th>identifiant</th><th>Nom</th><th>Prix Achat</th><th>Prix Vente</th><th>Prix Vente min</th><th>Quantite en stock</th><th>Description</th></tr>";
                    
                    while($row= mysqli_fetch_assoc($result)){
                            echo"<tr><td>".$row["idProduit"]."</td><td>".$row["Nom"]."</td><td>".$row["PrixAchat"]."</td><td>".$row["PrixVente"]."</td><td>".$row["PrixVmin"]."</td><td>".$row["QuantiteStock"]."</td><td>".$row["DescriptionP"]."</td></tr>"; 
                    }
                    echo"</table>";
                }else{echo "Pas des donnees dans la base ";}

            ?> 
           
        
        </div>
            
        
    </div>
    
        
</div>


<div class="footer">
        <h2>&copy copyrigth 2022</h2>
        <p>franck sefu +243 973359746</p>
</div>


</body>
</html>
</html>