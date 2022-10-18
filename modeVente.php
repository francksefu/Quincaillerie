<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formulaire.css" media="screen" type="text/css" />
    <title>franckApp</title>
    <style>
        html{
            background: url(imageVend.png);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<?php 
    function datalist(){
        include 'connexion.php';
        $sql = ("SELECT Operation, NomClient, DatesVente FROM Ventes, Client WHERE (Ventes.idClient = Client.idClient) GROUP BY Operation");
        $result = mysqli_query($db, $sql);
                
        if(mysqli_num_rows($result)>0){
                            
            while($row= mysqli_fetch_assoc($result)){
                echo"<option value='".$row["Operation"].": ".$row["NomClient"]." :".$row["DatesVente"]."'>".$row["NomClient"]." : ".$row["Operation"]."</option>"; 
            }
                    
       }else{echo "Une erreur s est produite ";}  

    }
?>
<body>
    <div id="venteOp">
    <form method="POST" action="">
        <input type = "text" list = "reference" id = "OperaNom" name="OperaNom" onchange="testeVide()" placeholder="Mettez le numero de facture ici svp ...">
        <span id="effaceRapide" onclick="effaceRapide()" style=" color :aliceblue; font-size:100px; "> &Cross;</span>
        <input type = "hidden" name="cacher" value="ModifVente">
        <input type="hidden" name="Operation" id="operation">
        <input type="submit" value="Soumettre">
            <datalist id="reference">
                <?php 
                    datalist();

                ?>
            </datalist>
    </form>
    </div>
    <script>
        let OperaNom = document.getElementById("OperaNom").value;
        function testeVide(){
            if(document.getElementById("OperaNom").value != ""){
                let tableau = document.getElementById("OperaNom").value;
                let tab = tableau.split(":");
                let operation = tab[0]*1; 
                document.getElementById("operation").value = operation;
            }
        }
        function effaceRapide(){
            document.getElementById("OperaNom").value = "";
            document.getElementById("operation").value = "";
        }
    </script>
</body>
</html>