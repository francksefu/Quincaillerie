<?php 
    
    class VentesC{
        private $idVentes = 0;
        private  $idProduit ;
        private $idClient ;
        private $dette ;
        private $dateVente ;
        private $operation ;
        private $pU ;
        private $quantiteVendu ;
        
        function __construct( $idProduit, $pU, $quantiteVendu, $idClient, $dette, $dateVente, $operation)
        {
            
            $this->idProduit = $idProduit;
            $this->pU = $pU;
            $this->quantiteVendu = $quantiteVendu;
            $this->idClient = $idClient;
            $this->dette = $dette;
            $this->dateVente = $dateVente;
            $this->operation = $operation;
        }
        function get_idVentes(){
            return $this->idVentes;
        }
        function set_idVentes($idVentes){
            $this->idVentes = $idVentes; 
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
        function get_quantiteVendu(){
            return $this->quantiteVendu;
        }
        function set_quantiteVendu($quantite){
            $this->quantiteVendu = $quantite; 
        }
        function get_dette(){
            return $this->dette;
        }
        function set_dette($dette){
            $this->dette = $dette; 
        }
        function get_dateVente(){
            return $this->dateVente;
        }
        function set_dateVente($dateVente){
            $this->dateVente = $dateVente; 
        }
        function get_operation()
        {
            return $this->operation;
        }
        function set_operation($operation)
        {
            $this->operation = $operation; 
        }
        function insertVente()
        {
            include 'connexion.php';
            $pTT = $this->quantiteVendu * $this->pU;
            $sql = ("INSERT INTO Ventes (idProduit, idClient, QuantiteVendu, PU, PT, DatesVente, Operation, Dette) values ('".$this->idProduit."', '".$this->idClient."', '".$this->quantiteVendu."', '".$this->pU."', '".$pTT."', '".$this->dateVente."', '".$this->operation."', '".$this->dette."')");
            if(mysqli_query($db, $sql)){
                echo"";
                }else{
                echo"error : ".mysqli_error($db)." desolee";
            }
            if($this->dette == "Oui"){
                $sqldette = ("UPDATE Ventes SET MontantPaye = '0' WHERE Operation =".$this->operation." ");
                if($db->query($sqldette)===TRUE){
                    echo"";
                }else{
                    "Echec de mise a jour :".$db->error;
                }
            }
            
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
            $nvlQuantite = $quantite - $this->quantiteVendu;
            $sql1 = ("UPDATE Produit SET QuantiteStock = '".$nvlQuantite."' WHERE idProduit =".$this->idProduit." ");
            if($db->query($sql1)===TRUE){
                echo"";
            }else{
                "Echec de mise a jour :".$db->error;
            }
        }

    }
?>