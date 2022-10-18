<?php
    class DetteEntrepriseC{
        private $idDetteEntreprise;
        private $type;
        private $valeur;
        private $operation;

        function __construct($idDetteEntreprise, $type, $valeur, $operation)
        {
            $this->idDetteEntreprise = $idDetteEntreprise ;  
            $this->type = $type;
            $this->valeur = $valeur;
            $this->operation = $operation ;
        }
        function get_idDetteEntreprise()
        {
            return $this->idDetteEntreprise;
        }
        function set_idDetteEntreprise($idDetteEntreprise)
        {
            $this->idDetteEntreprise = $idDetteEntreprise; 
        }
        function get_type()
        {
            return $this->type;
        }
        function set_type($type)
        {
            $this->type = $type; 
        }
        function get_valeur()
        {
            return $this->valeur;
        }
        function set_valeur($valeur)
        {
            $this->valeur = $valeur; 
        }
        function get_operation()
        {
            return $this->operation;
        }
        function set_operation($operation)
        {
            $this->operation = $operation; 
        }
    }
?>