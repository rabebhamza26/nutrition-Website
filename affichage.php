<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Recettes</title>

    <style>
        /* Reset de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Titre principal */
        h1 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2.5rem;
            text-align: center;
            margin: 30px 0;
            color: #ff6f61;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #ff6f61, #ffcc70);
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent;
            transition: transform 0.3s ease;
        }

        h1:hover {
            transform: scale(1.05);
            cursor: default;
        }

        /* Bouton ajouter */
        .Btn_add {
            display: inline-flex;
            align-items: center;
            background-color: #2bc48a;
            padding: 8px 20px;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .Btn_add img {
            margin-right: 8px;
            height: 20px;
        }

        .Btn_add:hover {
            background-color: #28a175;
        }

        /* Tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #3f51b5;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
            transition: background-color 0.3s;
        }

        td img {
            max-width: 100px;
            border-radius: 8px;
        }

        /* Boutons modifier/supprimer */
        .button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            margin: 3px 0;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .button:first-child {
            background-color: #4CAF50;
        }

        .button:first-child:hover {
            background-color: #45a049;
        }

        .button:last-child {
            background-color: #f44336;
        }

        .button:last-child:hover {
            background-color: #d73833;
        }

        /* Responsive */
        @media (max-width: 900px) {
            table, th, td {
                font-size: 14px;
            }

            td img {
                max-width: 70px;
            }

            h1 {
                font-size: 2rem;
            }

            .Btn_add {
                padding: 6px 15px;
                font-size: 14px;
            }
        }

        @media (max-width: 600px) {
            table, th, td {
                font-size: 12px;
            }

            td img {
                max-width: 50px;
            }

            h1 {
                font-size: 1.7rem;
            }

            .Btn_add {
                padding: 5px 12px;
                font-size: 12px;
            }

            th, td {
                padding: 8px 10px;
            }
        }
        .back_btn {
    display: inline-flex;
    align-items: center;
    gap: 8px; /* espace entre icône et texte */
    padding: 8px 14px;
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
    font-size: 14px;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.back_btn i {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    background-color: rgba(255,255,255,0.2);
    border-radius: 50%;
    font-size: 12px;
    transition: all 0.3s ease;
}

.back_btn:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.back_btn:hover i {
    background-color: #fff;
    color: #3498db;
    transform: translateX(-3px);
}


    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function modifierRecettes(id) {
            alert("Fonction de modification non implémentée pour la recette avec l'ID " + id + ".");
            window.location.href = "modifier.php?id=" + id;
        }

        function supprimerRecettes(id) {
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
<div class="container">
<a href="login.php" class="back_btn"><i class="fas fa-arrow-left"></i> Retour</a>

    <a href="admin.php" class="Btn_add"> <img src="images/plus.png"> Ajouter</a>
    <h1>Liste des recettes</h1>

    <?php
    include("connexion.php");
    $bdd = maConnexion();

    $reponse = $bdd->query('SELECT * FROM recettes') or die($bdd->errorInfo()[2]);

    if ($reponse->rowCount() > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Image</th><th>Titre</th><th>Description</th><th>Lien</th><th>Actions</th></tr>";
        while ($ligne = $reponse->fetchObject()) {
            echo "<tr>";
            echo "<td>" . $ligne->id . "</td>";
            echo "<td><img src='images/" . $ligne->image . "'></td>";
            echo "<td>" . $ligne->titre . "</td>";
            echo "<td>" . $ligne->description . "</td>";
            echo "<td><a href='" . $ligne->lien . "' target='_blank'>" . $ligne->lien . "</a></td>";
            echo "<td>";
            echo "<button class='button' onclick='modifierRecettes(" . $ligne->id . ")'>Modifier</button> <br>";
            echo "<button class='button' onclick='supprimerRecettes(" . $ligne->id . ")'>Supprimer</button>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    $reponse->closeCursor();
    $bdd = null;
    ?>
</div>
</body>
</html>
