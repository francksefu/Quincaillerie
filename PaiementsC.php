<?php
    class PaiementsC{
        private $idPaiements ;
        public $tot;
        public $mont;
        public $difference;
        private $datePaie;
        private $montant ;
        private $operation ;//cette variable nous permet de regouper les operations dans la BD... ici elle nous aide a lier le paiement a la vente 
        
        function __construct( $datePaie, $montant, $operation){
            
            $this->datePaie = $datePaie;
            $this->montant = $montant;
            $this->operation = $operation;
        }
        
        function get_idPaiements(){
            return $this->idPaiements;
        }
        function set_idPaiements($idPaiements){
            $this->idPaiements = $idPaiements; 
        }
        function get_datePaie(){
            return $this->datePaie;
        }
        function set_datePaie($datePaie){
            $this->datePaie = $datePaie; 
        }
        function get_montant(){
            return $this->montant;
        }
        function set_montant($montant){
            $this->montant = $montant;
        }
        function get_operation(){
            return $this->operation;
        }
        function set_operation($operation){
            $this->operation = $operation; 
        }
        function verificateur()
        {
            include 'connexion.php';
            $tot;
            $mont;
            $sql = ("SELECT MontantPaye, TotalFacture FROM Ventes WHERE Operation = ".$this->operation." limit 1");
            $result = mysqli_query($db, $sql);
                        
            if(mysqli_num_rows($result)>0){
                                    
                while($row= mysqli_fetch_assoc($result)){
                    $this->tot = $row["TotalFacture"];
                    $this->mont = $row["MontantPaye"];
                }
                $this->difference = $this->tot -$this->mont;
                           
            }else{echo "error";}
        }
        function inserePaiement(){
            include 'connexion.php';
            $this->verificateur();
            
            if($this->difference >0){
            
                $sql = ("INSERT INTO Paiements (DatesPaie, Montant, Operation) values ('".$this->datePaie."', '".$this->montant."', '".$this->operation."')");
                if(mysqli_query($db, $sql)){
                    echo"";
                    }else{
                    echo"error : ".mysqli_error($db)." desolee";
                }
                $sqlId = ("SELECT idPaiements FROM Paiements order by idPaiements DESC limit 1");
                $result = mysqli_query($db, $sqlId);
                            
                if(mysqli_num_rows($result)>0){
                                        
                    while($row= mysqli_fetch_assoc($result)){
                        $this->set_idPaiements($row["idPaiements"]);
                    }
                               
                }else{echo "error";}
            }else{echo"Facture deja payé ... plus de paiement possible pour lui";}

        }
        function misAjourPaiement(){

            include 'connexion.php';
            $this->verificateur();
            if($this->difference >0){
                $montantTot;
                $sql = ("SELECT Montant FROM Paiements WHERE Operation = ".$this->operation."");
                $result = mysqli_query($db, $sql);
                           
                if(mysqli_num_rows($result)>0){
                                        
                    while($row= mysqli_fetch_assoc($result)){
                        $montantTot += $row["Montant"];
                    }
                               
                }else{echo "error";}
                
                $sql1 = ("UPDATE Ventes SET MontantPaye = '".$montantTot."' WHERE Operation =".$this->operation." ");
                if($db->query($sql1)===TRUE){
                    echo"";
                }else{
                    "Echec de mise a jour :".$db->error;
                }
            }else{ echo" pas de paiment ici";}
        }

        function supprimer(){
            include 'connexion.php';
            $MEnlever;
            $montantTot;
            $sqlE = ("SELECT Montant FROM Paiements WHERE idPaiements = '".$this->idPaiements."'");
            $resultE = mysqli_query($db, $sqlE);
            if(mysqli_num_rows($resultE)>0){
                while($rowE= mysqli_fetch_assoc($resultE)){
                    $MEnlever = $rowE["Montant"];
                }

            }

                $sqlM = ("SELECT Montant FROM Paiements WHERE Operation = ".$this->operation."");
                $resultM = mysqli_query($db, $sqlM);
                            
                if(mysqli_num_rows($resultM)>0){
                                        
                    while($rowM= mysqli_fetch_assoc($resultM)){
                        $montantTot += $rowM["Montant"];
                    }
                               
                }else{echo "error";}
                
                $sql1 = ("UPDATE Ventes SET MontantPaye = '".$montantTot - $MEnlever."' WHERE Operation =".$this->operation." ");
                if($db->query($sql1)===TRUE){
                    echo"";
                }else{
                    "Echec de mise a jour :".$db->error;
                }

            $sqlSu = ("DELETE FROM Paiements  WHERE idPaiements =".$this->idPaiements." ");
            if($db->query($sqlSu)===TRUE){
                echo"";
            }else{
                "Echec de mise a jour :".$db->error;
            }
        }
        
    }
?>