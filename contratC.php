<?php 
    
    class ContratC{
        private $idContrat = 0;
        private  $idProduit ;
        private $idClient ;
        private $quantite ;
        private $pU ;
        private $source;
        private $paU;
        private $datesContrat ;
        private $operation ;
        
        
        
        
        
        function __construct( $idProduit, $idClient, $quantite, $pU, $source, $paU, $operation, $datesContrat)
        {
            
            $this->idProduit = $idProduit;
            $this->idClient = $idClient;
            $this->quantite = $quantite;
            $this->pU = $pU;
            $this->source = $source;
            $this->paU = $paU;
            $this->operation = $operation;
            $this->datesContrat = $datesContrat;
            
        }
        function get_idContrat(){
            return $this->idContrat;
        }
        function set_idContrat($idContrat){
            $this->idContrat = $idContrat; 
        }
        function get_idProduit(){
            return $this->idProduit;
        }
        function set_idProduit($idProduit){
            $this->idProduit = $idProduit; 
        }
        function get_idClient(){
            return $this->idClient;
        }
        function set_idClient($idClient){
            $this->idClient = $idClient; 
        }
        function get_pU(){
            return $this->pU;
        }
        function set_pU($pU){
            $this->pU = $pU; 
        }
        function get_quantite(){
            return $this->quantite;
        }
        function set_quantiteVendu($quantite){
            $this->quantite = $quantite; 
        }
        function get_source(){
            return $this->source;
        }
        function set_source($source){
            $this->source = $source; 
        }
        function get_paU(){
            return $this->paU;
        }
        function set_paU($paU){
            $this->paU = $paU; 
        }
        
        function get_datesContrat(){
            return $this->datesContrat;
        }
        function set_datesContrat($datesContrat){
            $this->datesContrat = $datesContrat; 
        }
        function get_operation()
        {
            return $this->operation;
        }
        function set_operation($operation)
        {
            $this->operation = $operation; 
        }
        function insertContrat()
        {
            include 'connexion.php';
            $pTT = $this->quantite * $this->pU;
            $pTA = $this->quantite * $this->paU;
            $sql = ("INSERT INTO Contrat (idProduit, idClient, Quantite, PU, PT, Source, PAU, PAT, Operation, DatesContrat) values ('".$this->idProduit."', '".$this->idClient."', '".$this->quantite."', '".$this->pU."', '".$pTT."', '".$this->source."', '".$this->paU."', '".$pTA."', '".$this->operation."', '".$this->datesContrat."')");
            if(mysqli_query($db, $sql)){
                echo"";
                }else{
                echo"error : ".mysqli_error($db)." desolee";
            }
            
        }
        function misAjour(){
            include 'connexion.php';
            $quantiteS;
            $sql = ("SELECT QuantiteStock FROM Produit WHERE idProduit = ".$this->idProduit."");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $quantiteS = $row["QuantiteStock"];
                }
                            
            }else{echo "error";}
            if($this->source == "chez moi"){
                $nvlQuantite = $quantiteS - $this->quantite;
                $sql1 = ("UPDATE Produit SET QuantiteStock = '".$nvlQuantite."' WHERE idProduit =".$this->idProduit." ");
                if($db->query($sql1)===TRUE){
                    echo"";
                }else{
                    "Echec de mise a jour :".$db->error;
                }
            }
        }

    }
?>