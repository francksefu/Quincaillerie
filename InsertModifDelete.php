<?php
    
        function insertModifDelete(array $tableau, $nomClass, $nomMethode)
        {
            require 'connexion.php';
            try
            {
                echo "Nous somme dans la classe";
                $conn = new PDO ("mysql:host = $servername;dbname = $dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if($nomClass == "ProduitC" && $nomMethode == "insert"){
                    echo "Nous somme dans la clause";
                    insert($tableau,$conn);
                }
            }catch(Exception $e){
                echo "Error:".$e->getMessage();
            }
            $conn = null;
        
        }
        function insert($tableau, $conn)
       {
           $Nom ="";$PrixAchat = 0;
           $PrixVente = 0; $QuantiteStock = 0;
           $DescriptionP = "";

           $stmt = $conn->prepare("INSERT INTO Produit (Nom, PrixAchat, PrixVente, QuantiteStock, DescriptionP) 
           VALUES (:Nom, :PrixAchat, :PrixVente, :QuantiteStock, :DescriptionP)");
           $stmt->bindParam(':Nom', $Nom);
           $stmt->bindParam(':PrixAchat', $PrixAchat);
           $stmt->bindParam(':PrixVente', $PrixVente);
           $stmt->bindParam(':QuantiteStock', $QuantiteStock);
           $stmt->bindParam(':DescriptionP', $DescriptionP);

           $longueur = count($tableau);
           for($i = 0 ; $i<$longueur; $i++){
               $Nom = $tableau[$i]->get_nom();
               $PrixAchat = $tableau[$i]->get_prixAchat();
               $PrixVente = $tableau[$i]->get_prixVente();
               $QuantiteStock = $tableau[$i]->get_quantite();
               $DescriptionP = $tableau[$i]-> get_description();

               $stmt->execute();


           }
        
           
       }
?>