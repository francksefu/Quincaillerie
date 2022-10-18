<?php
    class ProduitC {
        private $idProduit = 0;
        private $prixAchat = 0.0;
        private $prixVente = 0.0;
        private $quantite = 0;

        private $description = "";
        private $nom = "";

       function __construct($idProduit, $nom, $prixAchat, $prixVente, $quantite, $description){
           $this->idProduit = $idProduit;
           $this->nom = $nom;
           $this->prixAchat = $prixAchat;
           $this->prixVente = $prixVente;
           $this->quantite = $quantite;
           $this->description = $description;

        }
        
        function get_idproduit(){
            return $this->idProduit;
        }
        function set_idProduit($idProduit){
            $this->idProduit = $idProduit;
        }
        function get_nom(){
            return $this->nom;
        }
        function set_nom($nom){
            $this->nom = $nom;
        }
        function get_prixAchat(){
            return $this->prixAchat;
        }
        function set_prixAchat($prixAchat){
            $this->prixAchat = $prixAchat;
        }
        function get_prixVente(){
            return $this->prixVente;
        }
        function set_prixVente($prixVente){
            $this->prixVente = $prixVente;
        }
        function get_quantite(){
            return $this->quantite;
        }
        function set_quantite($quantite){
            $this->quantite = $quantite;
        }
        function get_description(){
            return $this->description;
        }
        function set_description($description){
            $this->description = $description;
        }
        
        
    }

?>