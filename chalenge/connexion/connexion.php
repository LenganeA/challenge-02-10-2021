<?php session_start();

	$connexion = new PDO("mysql:host=localhost;dbname=user_uvci", "root", "");

	if (isset($_POST['form_connect'])) 
	{
		$mail_connect		= trim(htmlspecialchars($_POST['email']));
		$password_connect 	= trim(sha1($_POST['password']));

		if (!empty($mail_connect) AND !empty($password_connect)) 
		{
			$requser = $connexion->prepare("SELECT * FROM users WHERE email = ? AND motdepasse = ?");
			$requser->execute(array($mail_connect, $password_connect));
			$user_exist = $requser->rowCount();

			if ($user_exist == 1) 
			{
				$user_info = $requser->fetch();
				$_SESSION['id'] = $user_info['id'];
				$_SESSION['name'] = $user_info['name'];
				$_SESSION['lastname'] = $user_info['lastname'];
				$_SESSION['email'] = $user_info['email'];
				header("Location: profil.php?id=".$_SESSION['id']);
			}
			else
			{
				$erreur ="Mauvais identifiant !";
			}
		}
		else
		{
			$erreur = "Complétés tous les champs !";
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/others/bootstrap.css">
    <link rel="stylesheet" href="../css/others/font-awesome.min.css">
    <link rel="stylesheet" href="connexion.css">
    <title>connexion</title>
</head>
<body>
    
    <header>
        <nav>
            <div class="name_img">
                <h1>CONNEXION</h1>
                <img src="../images/logo-black.png" alt="">
            </div>
			<div class="form_connect">
				<form method="POST" action="">
					<div class="input_1">
						<p style="position: absolute; left: -200px; top: 10px;"><?php if (isset($erreur)) { echo "<font color= 'red'>".$erreur."</font>";} ?></p><input type="email" name="email" placeholder="Nom de l'utilisateur...">
					</div>
					<div class="input_2">
						<input type="password" name="password" placeholder="Mot de passe...">
					</div>
					<div class="input_btn">
						<button type="submit" name="form_connect">Connexion</button>
					</div>
				</form>
			</div>
		</nav>
    </header>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>