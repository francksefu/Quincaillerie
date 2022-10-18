<script language=javascript>
function changecategorie() 
{ 
    categorie = document.getElementById('categorie').value; 
    switch (categorie) 
    { 
    <?php 
        /*On recherche tous les types dans les catégories qui créerons les 'case'*/
        $sql = "SELECT DISTINCT(ID) FROM CATEGORIE"; 
 $result = mysql_query($sql); 
 while ( $row = mysql_fetch_array( $result ) ) 
 { 
    ? > 
    case ('<?php echo $row[0];? >'): 
    <?php 
        /*Pour chaque type on cherche tous les ingrédients associés que l'on met dans une variable*/ 
        $valeur = "'"; 
 $sql2 = "SELECT LIBELLE FROM INGREDIENT WHERE TYPE='".$row[0]."'"; 
 $result2 = mysql_query($sql2); 
 while ( $row2 = mysql_fetch_array($result2)) 
 { 
     $valeur = $valeur." ".$row2[0]; 
 } 
     $valeur = $valeur."'"; 
    ?> 
    document.getElementById('ingredient').value = ""; 
    document.getElementById('ingredient').value = <?php echo $valeur;? >; 
    break; 
    <?php 
        } 
    ? > 
    } 
} 
</script> 
......... 
<select name='categorie' id='categorie' onchange='changecategorie()'> 


<?php 
$valeur = '<script type="text/JavaScript"> document.getElementById("idProduit").value;</script>';
   include 'connexion.php';
   $sql = ("SELECT Nom, idProduit, PrixVente FROM Produit WHERE idProduit=$valeur");
   $result = mysqli_query($db, $sql);
   if(mysqli_num_rows($result)>0)
   {
       while($rows = mysqli_fetch_assoc($result))
       {
    
?>
function EcrirePU(){
    document.getElementById("demo").innerHTML = '<?php echo $rows["PrixVente"]; ?>';
}
<?php
       }
    }
?>