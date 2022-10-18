<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="accueil.css" media="screen" type="text/css" />
    <style>
        a{
            text-decoration: none;background-color: #555;
            color:white; 
            text-align: center;
            font-size: 18px; 
        }
        body{
            background-image: url(albin.JPG) ;
            background-repeat: no-repeat;
            background-size: cover;
        }
        a:hover{
            background-color: #223366;
            color: white;

        }
        h1{
            color:blanchedalmond;
        }
    </style>

</head>

<body>

    
        <div >
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
                    echo "<h1>Bonjour $user, vous êtes connectés</h1>";
                    

                    
                }
        ?>
            <!-- zone de connexion -->
            
            <form>
                <h1 style="text-align: center;margin: 20px 0;color:black;">Bienvenu...</h1>
                
                <a href='accueilEntreprise.php?deconnexion=true' >Déconnexion</a>
            <a href="produitQ.php" >Produit</a>
             <a href="bonusPerte.php"  >Bonus et Perte</a>
            <a href="sortieQ.php"  >Sorties</a>
            <a href="ventesQ.php"  >ventes</a>
            <a href="clientQ.php"  >Client</a>
            <a href="contratQ.php"  >contrat</a>
            <a href="detteEntrepriseQ.php" >Dette Entreprise</a>
            <a href="etatsQ.php"  >Les Etats</a>
            
            </form>
        </div>
    
</body>
</html>