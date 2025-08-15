<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier recette</title>

<!-- CSS -->
<style>
    /* Reset de base */
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f7f7f7, #e0f7fa);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .container {
        background-color: #ffffff;
        padding: 30px 25px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        max-width: 500px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .container:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.2); }

    h1 {
        font-family: 'Brush Script MT', cursive;
        font-size: 2.4rem;
        color: #ff6f61;
        text-align: center;
        margin-bottom: 25px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; }

    input[type="text"], input[type="file"], input[type="hidden"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: 0.3s;
    }

    input[type="text"]:focus, input[type="file"]:focus {
        border-color: #00bcd4;
        box-shadow: 0 0 5px rgba(0,188,212,0.3);
        outline: none;
    }

    .form-group { margin-bottom: 12px; }

    .back_btn {
        display: inline-block;
        margin-bottom: 15px;
        color: #00bcd4;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .back_btn:hover { color: #007b7f; text-decoration: underline; }

    .btn-primary {
        background-color: #00bcd4;
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }

    .btn-primary:hover { background-color: #0097a7; }

    /* Responsive */
    @media (max-width: 600px) {
        h1 { font-size: 2rem; }
        .container { padding: 20px; }
        .btn-primary { padding: 10px; font-size: 15px; }
    }

    .current-img {
        display: block;
        margin-bottom: 10px;
        max-width: 100%;
        border-radius: 6px;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>

<div class="container">
<?php
include("connexion.php");
$bdd = maConnexion();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idrecette = $_POST['id'];
    $titrerecette = $_POST['titre'];
    $description = $_POST['Description'];
    $lien = $_POST['Lien'];

    // Gestion de l'image
    $imagePath = $_POST['current_image']; // chemin actuel
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
        $uploadDir = "images/"; // dossier de destination
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
            $imagePath = $targetFile;
        }
    }

    $sql = "UPDATE recettes SET titre=?, description=?, lien=?, image=? WHERE id=?";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(1, $titrerecette);
    $stmt->bindValue(2, $description);
    $stmt->bindValue(3, $lien);
    $stmt->bindValue(4, $imagePath);
    $stmt->bindValue(5, $idrecette, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('La recette a été mise à jour avec succès.');</script>";
    } else {
        echo "<p>Erreur : " . $stmt->errorInfo()[2] . "</p>";
    }
}

// Affichage du formulaire avec les données existantes
if(isset($_GET['id'])) {
    $idrecette = $_GET['id'];
    $sql = "SELECT * FROM recettes WHERE id=?";
    $stmt = $bdd->prepare($sql);
    $stmt->bindValue(1, $idrecette, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
?>
    <a href="affichage.php" class="back_btn"><i class="fas fa-arrow-left"></i> Retour</a>
    <h1>Modifier la recette</h1>
    <form action="modifier.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <input type="hidden" name="current_image" value="<?php echo $result['image']; ?>">

        <div class="form-group">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" value="<?php echo $result['titre']; ?>">
        </div>

        <div class="form-group">
            <label for="Description">Description:</label>
            <input type="text" id="Description" name="Description" value="<?php echo $result['description']; ?>">
        </div>

        <div class="form-group">
            <label for="Lien">Lien:</label>
            <input type="text" id="Lien" name="Lien" value="<?php echo $result['lien']; ?>">
        </div>

        <div class="form-group">
            <label for="image"></label>
            <?php if(!empty($result['image'])): ?>
                <img src="<?php echo $result['image']; ?>" alt="" class="current-img">
            <?php endif; ?>
            <label for="image">Changer la photo:</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit" class="btn-primary">Modifier la recette</button>
    </form>
<?php
    } else {
        echo "<p>Aucune recette trouvée avec cet identifiant.</p>";
    }
}
$bdd = null;
?>
</div>

</body>
</html>
