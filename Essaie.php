<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button><a href="produitQ.php">retour</a></button>
    <?php
        include 'InsertModifDelete.php';
        include 'connexion.php';
        $id = 1;
        $Nom = $_POST["Nom"];
        $PrixAchat = $_POST["PrixAchat"];
        $PrixVente = $_POST["PrixVente"];
        $QuantiteStock = $_POST["QuantiteStock"];
        $DescriptionP = $_POST["DescriptionP"];
        echo $DescriptionP;
        $nomClass = "ProduitC";
        $nomMethode = "insert";
        $produit = new ProduitC($id,$Nom, $PrixAchat, $PrixVente, $QuantiteStock,$DescriptionP);
        $tableau = array($produit);
        insertModifDelete($tableau, $nomClass, $nomMethode);
    ?>
    <button><a href="produitQ.php">retour</a></button>
    
</body>
</html>