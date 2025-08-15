<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        
/* ===== Reset & Base ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 10px;
}

a {
    text-decoration: none;
}

/* ===== Form Container ===== */
.form {
    background-color: #ffffff;
    padding: 15px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 150%;
    max-width: 400px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.form:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}

/* ===== Back Button ===== */
.back_btn {
    display: flex;
    align-items: center;
    color: #2bc48a;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 12px;
}

.back_btn img {
    height: 12px;
    margin-right: 5px;
}

/* ===== Title ===== */
h1 {
    font-size: 20px;
    font-weight: bold;
    color: #4b4b4b;
    text-align: center;
    margin-bottom: 15px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
}

/* ===== Labels & Inputs ===== */
label {
    display: block;
    font-weight: bold;
    color: #333;
    margin-bottom: 3px;
    font-size: 12px;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 12px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="file"]:focus {
    border-color: #2bc48a;
    box-shadow: 0 0 5px rgba(43,196,138,0.3);
    outline: none;
}

/* ===== Buttons ===== */
button {
    display: block;
    width: 100%;
    padding: 8px;
    margin-bottom: 8px;
    border: none;
    border-radius: 5px;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

button[type="submit"] {
    background-color: #2bc48a;
    color: #fff;
}

button[type="submit"]:hover {
    background-color: #27a67c;
    transform: translateY(-1px);
}

button[type="button"] {
    background-color: #3498db;
    color: #fff;
}

button[type="button"]:hover {
    background-color: #2980b9;
    transform: translateY(-1px);
}

/* ===== Messages ===== */
.temps, .error {
    text-align: center;
    font-size: 12px;
    margin-top: 8px;
}

.temps {
    color: #27a67c;
}

.error {
    color: #e74c3c;
}

/* ===== Responsive ===== */
@media (max-width: 400px) {
    .form {
        padding: 12px 15px;
    }

    h1 {
        font-size: 18px;
    }

    button {
        font-size: 12px;
        padding: 7px;
    }
}
</style>


    <script>
        function modifierRecette(id) {
            alert("Fonction de modification non implémentée pour le service avec l'ID " + id + ".");
            window.location.href = "modifier.php?Id=" + id;
        }

        function supprimerRecette(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette recette ?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "supprimer.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        window.location.reload();
                    }
                };
                xhr.send("id=" + id);
            }
        }
    </script>
</head>
<body>
    <section id="appointment-form">
        <div class="form">
            <a href="login.php" class="back_btn"><img src="images/back.png"> Retour</a>
            <h1>Ajouter Recette</h1>

            <form id="appointment-form" action="Admin.php" method="POST" enctype="multipart/form-data">
                <label for="image">Photo:</label>
                <input type="file" id="image" name="image" required>

                <label for="titre">Titre:</label>
                <input type="text" id="titre" name="titre" placeholder="Entrer le titre" required>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" placeholder="Entrer la description" required>

                <label for="lien">Lien:</label>
                <input type="text" id="lien" name="lien" placeholder="Entrer le lien" required>

                <button type="submit" name="button">Ajouter Recette</button>
                <button type="button" onclick="location.href='affichage.php'">Afficher Recette</button>
            </form>
        </div>

        <?php
            include("connexion.php");
            $bdd = maConnexion();
            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                $image = $_FILES['image']['name'];
                $titre = $_POST['titre'];
                $description = $_POST['description'];
                $lien = $_POST['lien'];
                $sql = "INSERT INTO recettes(image, titre, description, lien) VALUES ('$image', '$titre', '$description','$lien')";
                $nblignes = $bdd->exec($sql);
                if ($nblignes !== false) {
                    echo "<p class='temps'>Enregistrement ajouté!</p>";
                    echo "<p>Votre numéro d'identifiant est : " . $bdd->lastInsertId() . "</p>";
                } else {
                    echo "<p class='error'>Impossible d'effectuer la requête: " . $bdd->errorInfo()[2] . "</p>";
                }
            }
            $bdd = null;
        ?>
    </section>
</body>
</html>
