<html>
    <head>
     <style>
.message {
    padding: 15px;
    margin: 20px 0;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
}

.success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.error {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

</style>
    </head>
    <body>

<?php
include("connexion.php");

// Appel de la fonction de connexion
$bdd = maConnexion();

// Vérifier si l'ID de recette à supprimer a été transmis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Récupérer l'ID de recette à supprimer
    $idRecettes = $_POST['id'];

    // Préparer et exécuter la requête SQL pour supprimer le recette de la base de données
    $sql = "DELETE FROM recettes WHERE id = ?";
    $stmt = $bdd->prepare($sql);
    if ($stmt->execute([$idRecettes])) {
        echo "<script>alert('Les informations de recette ont été supprimer avec succès.')</script>";
    } else {
        echo "Erreur lors de la suppression du service : " . $stmt->errorInfo()[2]; // Afficher l'erreur s'il y en a
    }
}
?>
    </body>
</html>