<?php
    class ApprovisionnementC{
        private $idApprov;
        private $idProduit;
        private $quantiteApprov;
        private $datesApprov ;
        private $operation ;

        function __construct($idProduit, $prixAchat, $quantiteApprov, $datesApprov, $operation)
        {
           
            $this->idProduit = $idProduit;
            $this->prixAchat = $prixAchat ;
            $this->quantiteApprov = $quantiteApprov;
            $this->datesApprov = $datesApprov;
            $this->operation = $operation;  
        }
        function get_idApprov()
        {
            return $this->idApprov;
        }
        function set_idApprov($idApprov)
        {
            $this->idApprov = $idApprov;
        }
        function get_idproduit()
        {
            return $this->idProduit;
        }
        function set_idProduit($idProduit)
        {
            $this->idProduit = $idProduit;
        }
        function get_prixAchat(){
            return $this->prixAchat;
        }
        function set_prixAchat($prixAchat){
            $this->prixAchat = $prixAchat;
        }
        function get_quantiteApprov()
        {
            return $this->quantiteApprov;
        }
        function set_quantiteApprov($quantiteApprov)
        {
            $this->quantiteApprov = $quantiteApprov;
        }
        function get_datesApprov()
        {
            return $this->datesApprov;
        }
        function set_datesApprov($datesApprov)
        {
            $this->datesApprov = $datesApprov;
        }
        function get_operation(){
            return $this->operation;
        }
        function set_operation($operation){
            $this->operation = $operation; 
        }
        function misAjour(){
            include 'connexion.php';
            $quantite;
            $sql = ("SELECT QuantiteStock FROM Produit WHERE idProduit = ".$this->idProduit."");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $quantite = $row["QuantiteStock"];
                }
                            
            }else{echo "error";}
            $nvlQuantite = $quantite + $this->quantiteApprov;
            $sql1 = ("UPDATE Produit SET QuantiteStock = '".$nvlQuantite."' WHERE idProduit =".$this->idProduit." ");
            if($db->query($sql1)===TRUE){
                echo"";
            }else{
                "Echec de mise a jour :".$db->error;
            }
        }
        function insere(){
            include 'connexion.php';
            $sql = ("INSERT INTO Approvisionnement (idProduit, PrixA, QuantiteApprov, DatesApprov, Operation) values ('".$this->idProduit."', '".$this->prixAchat."', '".$this->quantiteApprov."', '".$this->datesApprov."', '".$this->operation."')");
            if(mysqli_query($db, $sql)){
                echo"";
                }else{
                echo"error : ".mysqli_error($db)." desolee";
            }
        }
    }
?>