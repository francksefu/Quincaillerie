<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FranckApp</title>
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
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
</head>
<style>
    body{
            background: url(albin.JPG);
            background-size: cover;
        }
        
        button{
            margin: 10px;
        }
</style>
<body>
    <div  class="header" style="background-color: transparent;">
        <h1 style="text-shadow: 3px 3px 5px white;color: #fff;">Controle et gestion d' entreprise</h1>
    </div>
    <div class="topnav">
        <a href="accueilEntreprise.php">Accueil</a>
        <a href="produitQ.php" >Produit</a>
        <a href="bonusPerte.php">Bonus et Perte</a>
        <a href="sortieQ.php">Sorties</a>
        <a href="ventesQ.php">Ventes</a>
        <a href="clientQ.php" class="active" style="color: #000;">Client</a>
        <a href="paiementQ.php">Paiements</a>
        <a href="detteEntrepriseQ.php">Dette Entreprise</a>
        <a href="etatsQ.php" >Les Etats</a>
        <a href="contratQ.php" >Contrat</a>
    </div>

    <?php 
        $idClient = htmlspecialchars($_POST["idClient"]);
        $montantTot = 0;
        $prixMateriel = 0;
        $nomClient = "";
    ?>
    <div class="tableau">
        <?php
            include 'connexion.php'; 
            
            $reqSqlV= ("SELECT PT FROM Contrat WHERE (Contrat.idClient = ".$idClient.")");
            $resultV= mysqli_query($db, $reqSqlV);
            if(mysqli_num_rows($resultV)>0){
                //echo"<table id='Customers'><tr><th>identifiant</th><th>Nom du client</th><th>Montant</th><th>DatesPaiement</th></tr>";
                while($rowV= mysqli_fetch_assoc($resultV)){
                    //echo"<tr><td>".$row["idPaieContrat"]."</td><td>".$row["NomClient"]."</td><td>".$row["Montant"]."</td><td>".$row["DatesPaieContrat"]."</td></tr>";
                    $prixMateriel += $rowV["PT"];
                }
                //echo"</table>";
            }else{echo "Une erreur s est produite ";}

            $reqSql= ("SELECT idPaieContrat, NomClient, Montant, DatesPaieContrat FROM Client, PaiementContrat WHERE ((Client.idClient = PaiementContrat.idClient) AND PaiementContrat.idClient = ".$idClient.")order by DatesPaieContrat DESC");
            $result= mysqli_query($db, $reqSql);
            if(mysqli_num_rows($result)>0){
                //echo"<table id='Customers'><tr><th>identifiant</th><th>Nom du client</th><th>Montant</th><th>DatesPaiement</th></tr>";
                while($row= mysqli_fetch_assoc($result)){
                    //echo"<tr><td>".$row["idPaieContrat"]."</td><td>".$row["NomClient"]."</td><td>".$row["Montant"]."</td><td>".$row["DatesPaieContrat"]."</td></tr>";
                    $montantTot += $row["Montant"];
                    $nomClient = $row["NomClient"];
                }
                //echo"</table>";
            }else{echo "Une erreur s est produite ";}
        ?>
        <div class="footer">
        <h2>Resume rapide </h2>
        <p>Nom du client : <?php echo $nomClient; ?> <br>Somme de tous les paiements :  <?php echo $montantTot; ?>$ <br>
            Somme de tous les materiel deja pris : <?php  echo $prixMateriel; ?> $ <br>
            Dette actuelle (difference entre les 2) :  <?php echo $montantTot - $prixMateriel; ?> $ <br>
        </p>
    </div>
        <?php
            $reqSqlC= ("SELECT idPaieContrat, NomClient, Montant, DatesPaieContrat FROM Client, PaiementContrat WHERE ((Client.idClient = PaiementContrat.idClient) AND PaiementContrat.idClient = ".$idClient.")order by DatesPaieContrat DESC");
            $resultC= mysqli_query($db, $reqSqlC);
            if(mysqli_num_rows($resultC)>0){
                echo"<table id='Customers' style='background-color:#ddd;' ><tr><th>identifiant</th><th>Nom du client</th><th>Montant</th><th>DatesPaiement</th></tr>";
                while($rowC= mysqli_fetch_assoc($resultC)){
                    echo"<tr><td>".$rowC["idPaieContrat"]."</td><td>".$rowC["NomClient"]."</td><td>".$rowC["Montant"]."</td><td>".$rowC["DatesPaieContrat"]."</td></tr>"; 
                }
                echo"</table>";
            }else{echo "Une erreur s est produite ";}

        ?> 
       
    </div>
    <div class="footer">
        <h2>&copy; Copyrigth</h2>
        <p>franck sefu +243 973359746</p>
    </div>
</body>
</html>