<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajout ou afffiche</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    display: flex;
    justify-content: space-around;
    width: 80%;
    max-width: 1200px;
}

.affichage, .ajout {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    width: 45%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #333;
}

img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 20px;
}

</style>
</head>
<body>
    <div class="container">
        <div class="affichage">
            <h2> Affichage</h2>
<a href="affichage.php">
            <img src="images/affiche.png" alt="affichage ">
            </a>
        </div>
        <div class="ajout">
            <h2>Ajout</h2>
<a href="admin.php">
            <img src="images/ajout.png" alt="Ajout">
            </a>
        </div>
    </div>
</body>
</html>
