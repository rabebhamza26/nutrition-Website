<?php
function maConnexion(){
//essai d'executer ce code :si  
try
{
$bdd= new PDO ('mysql:host=localhost;dbname=nutrition_db','root','');
//configure le mode de gestion des erreurs pour une instance de PDO 
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Réglage de l'encodage des caractères
$bdd->query("SET NAMES 'utf8'");
return $bdd;
}
//sinon

catch (PDOException $e)
{
 die ('Erreur:'.$e->getMessage());
}
}

 
?>