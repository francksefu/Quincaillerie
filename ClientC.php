<?php 
    class ClientC{
        private $idClient;
        private $nom = "";
        private $telephone = "";
        public $lastid;
        function __construct($nom, $telephone){
            $this->nom = $nom;
            $this->telephone = $telephone;
            
        }
        function get_nom(){
            return $this->nom;
        }
        function set_nom($nom){
            $this->nom = $nom;
        }
        function set_idClient($idClient){
            $this->idClient = $idClient;
        }
        function get_idClient(){
            return $this->idClient;
        }
        function get_telephone(){
            return $this->telephone;
        }
        function set_telephone($telephone){
            $this->telephone = $telephone;
        }
        function creerClient()
        {
            include 'connnexion.php';
            $sql = ("INSERT INTO Client (NomClient, Telephone) values ('".$this->get_nom()."', '".$this->get_telephone()."')");
            if(mysqli_query($db, $sql)){
                echo"";
                }else{
                echo"error : ".mysqli_error($db)." desolee";
            }
            
                
               /* $sqlN = ("SELECT*FROM Client order by idClient DESC limit 1");
                $resultN = mysqli_query($db, $sqlN);
                if(mysqli_num_rows($resultN)>0){
                                        
                    while($rowN= mysqli_fetch_assoc($resultN)){
                        $this->set_idClient($rowN["idClient"]); 
                    }
                                
                }else{echo "error";}
            }else{
                echo"error : ".mysqli_error($db)." desolee";
            }*/
            
        }
    }

?>