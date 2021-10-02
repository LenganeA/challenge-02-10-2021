<?php

    $connexion = new PDO("mysql:localhost;dbname=challenge", "root", "");
    
    if(isset($_POST['form_inscrire']))
    {
        $nom 	    = trim(htmlspecialchars($_POST['name']));
		$lastname   = trim(htmlspecialchars($_POST['lastname']));
		$email		= trim(htmlspecialchars($_POST['email']));
		$password 	= htmlspecialchars(sha1($_POST['password']));
		$password2 	= htmlspecialchars(sha1($_POST['password2'])); 

        if (!empty($nom) AND !empty($lastname) AND !empty($email) AND !empty($password) AND !empty($password2))
        {
            $nom_strlen = strlen($nom);

            if($nom_strlen <= 10)
            {
                if ($password == $password2) 
                {
                    $insert_user = $connexion->prepare("INSERT INTO users(nom, prenom, email, motdepasse) VALUES(?, ?, ?, ?) ");
                    $insert_user->execute(array($nom, $lastname, $email, $password));
                    $erreur = "Compte crée !";
                }
                else
                {
                    $erreur ="Vos mot de passe ne sont pas identique !";
                }
            }
            else
            {
                $erreur = "Votre nom doit contenir 10 caractères!";
            }
        }
        else
        {
            $erreur = "Complétés tous les champs!";
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
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>
</head>
<body>
    
    <header>
        <div class="body_form">
            <div class="name_img">
                <h1>INSCRIPTION</h1>
                <img src="" alt="">
            </div>
            
            <form method="POST" action="">
                <div class="input_1"><input type="text" name="name" placeholder="Nom" value="" require></div>
                <div class="input_2"><input type="text" name="lastname" placeholder="Prenom" value="" require></div>

                <div class="input_1"><input type="email" name="email" placeholder="Email Institutionnel" value="" require></div>
                <div class="input_2"><input type="password" name="password" placeholder="Mot de passe"  require></div>
                <div class="input_2"><input type="password" name="password2" placeholder="Comfirmation de votre mot de passe" require></div>
                
                <button type="submit" value="Valider" name="form_inscrire">S'inscrire</button>

                <button type="submit" value="Valider" class="btn1"><a href="../connexion/connexion.php">Se connecter</a></button>

                <div class="word">
				    <a href="../acceuil/index.php" class="retour">Retour <i class="fa fa-arrow-left"></i> </a>
				    <a href="#">Mot de passe oublié?</a>
			    </div>
                <?php
                    if(isset($erreur))
                    {
                        echo '<div class="alert alert-danger" role="alert">'.$erreur.'</div>';
                    }
                ?>
                
            </form>

            
        </div>
    </header>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>