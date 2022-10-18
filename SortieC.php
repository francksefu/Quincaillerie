<?php
    class SorttieC
    {
        private $idSortie;
        private $type;
        private $montant;
        private $motif;
        private $datesSortie;
        private $operation;
        
        function __construct($idSortie, $type, $montant, $datesSortie, $operation)
        {
            $this->idSortie = $idSortie;
            $this->type = $type;
            $this->montant = $montant;
            $this->datesSortie = $datesSortie;
            $this->operation = $operation ;
        }
        function get_idSortie()
        {
            return $this->idSortie;
        }
        function set_idSortie($idSortie)
        {
            $this->idSortie = $idSortie; 
        }
        function get_type()
        {
            return $this->type;
        }
        function set_type($type)
        {
            $this->type = $type; 
        }
        function get_montant()
        {
            return $this->montant;
        }
        function set_montant($montant)
        {
            $this->montant = $montant; 
        }
        function get_motif()
        {
            return $this->motif;
        }
        function set_motif($motif)
        {
            $this->motif = $motif; 
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