<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
      *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url(images/img1.jpg) no-repeat;
  background-size: cover;
  background-position: center;
}
.wrapper{
  width: 420px;
  background: transparent;
  border: 2px solid rgba(255, 255, 255, .2);
  backdrop-filter: blur(10px);
  color: #fff;
  border-radius: 15px;
  padding: 30px 40px;
}


.wrapper h1{
  font-size: 36px;
  text-align: center;
}
.wrapper .input-box{
  position: relative;
  width: 100%;
  height: 50px;
  
  margin: 30px 0;
}
.input-box input{
  width: 100%;
  height: 100%;
  background: transparent;
  border: none;
  outline: none;
  border: 2px solid rgba(255, 255, 255, .2);
  border-radius: 40px;
  font-size: 16px;
  color: #fff;
  padding: 20px 45px 20px 20px;
}
.input-box input::placeholder{
  color: #fff;
}
.input-box i{
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translate(-50%);
  font-size: 20px;

}
.wrapper .remember-forgot{
  display: flex;
  justify-content: space-between;
  font-size: 14.5px;
  margin: -15px 0 15px;
}
.remember-forgot label input{
  accent-color: #fff;
  margin-right: 5px;

}
.remember-forgot a{
  color: #fff;
  text-decoration: none;

}
.remember-forgot a:hover{
  text-decoration: underline;
}
.wrapper .btn{
  width: 100%;
  height: 45px;
  background: #fff;
  border: none;
  outline: none;
  border-radius: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, .1);
  cursor: pointer;
  font-size: 16px;
  color: #333;
  font-weight: 600;
}


      </style>
    
</head>
<body>
<section>
    <div class="wrapper">
        <form id="loginForm" action="#" method="post" onsubmit="validateLogin(event)">

            <h1>Login</h1>
            <div class="input-box">
                <label for="emailInput">Email</label>
                <input type="email" name="email" id="emailInput" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="passwordInput">Password</label>
                <input type="password" name="password" id="password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <br>
            <div class="remember-forgot"g>
                <label for="rememberCheckbox">
                    <input type="checkbox" id="rememberCheckbox">Remember Me
                </label>
                <a href="#">Forgot Password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            
        </form>
    </div>
    </section>
    <?php
session_start();
include("connexion.php");

// Appel de la fonction de connexion
$bdd = maConnexion();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Vérifier si l'email et le mot de passe sont corrects
  if ($email == 'rabebhamza26@gmail.com' && $password == 'rabeb') {
      // Rediriger vers la page d'administration
      header("Location: ajoutaffiche.php");
      exit(); // Assurez-vous de quitter le script après la redirection
  } else {
      // Afficher un message d'erreur si l'email ou le mot de passe est incorrect
      echo "Erreur : Identifiants incorrects. Veuillez réessayer.";
  }
}

// Fermez la connexion à la base de données
$bdd= null;
?>



</body>
</html>
