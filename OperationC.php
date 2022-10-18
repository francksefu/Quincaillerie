<?php 
    class OperationC{
        private $idOperation;
        private $code ;
        private $somme ;

        function __construct($idOperation, $code, $somme)
        {
            $this->idOperation = $idOperation;
            $this->code = $code;
            $this->somme = $somme ;
            
        }
        function get_idOperation(){
            return $this->idOperation;
        }
        function set_idOperation($idOperation){
            $this->idOperation = $idOperation; 
        }
        function get_code(){
            return $this->code;
        }
        function set_code($code){
            $this->code = $code; 
        }
        function get_somme(){
            return $this->somme;
        }
        function set_somme($somme){
            $this->somme = $somme; 
        }
    }
?>