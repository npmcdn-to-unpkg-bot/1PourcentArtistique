<?php
	/*Access to the database*/
	require_once '../persistance/admin.php';

	/*Get the paramete*/
	$emailDest = $_POST['email'];

	/*Test if the parameter is empty or not and return an error if yes*/
	if (empty($emailDest)) {
		$res = array('error' => true, 'key' => 'Entrer un email');
	}
	/*If is not, whe generate a random password, change it in the database and send by email.*/
	else {
		/* Generata random password with 8 caracter*/
		$nb_character = 8;
    	$generate_password =  substr(md5(uniqid(mt_rand(), true)), 0, $nb_character);
    	$getAdmin = new Admin("", $emailDest, md5($generate_password), "");
    	$exist = $getAdmin->existByEmail();
    	$email = "xx"; // Define with the mail of the domain
    	if($exist) {
    		$res = $getAdmin->changePasswordByMail();
	    	/* If the password is change, we send it by email*/
	    	if($res) {
	    		$subject = 'Réinitialisation de votre mot de passe';
				$message = "Bonjour,<br><br>
							Suite a votre demande, voici un mot de passe générer aléatoirement: <b>";
				$message .= $generate_password;
				$message .= "</b> .<br>";
				$message .= "Merci de bien vouloir vous connecter avec celui-ci et le changer sur votre espace membre. <br><br>
							Cordialement,<br>
							L'équipe du 1% Artistique de l'UM.";
				/*A changer sur le vrai serveur...*/
				$recipient = $emailDest
				$headers = "From: \"1% Artistique de l'UM\"<".$email.">\n";
				$headers .= "Reply-To: ".$email."\n";
				$headers .= "Content-Type: text/html; charset=\"utf8\"";
				if(mail($recipient,$subject,$message,$headers))
				{
				        // $res = "Votre nouveau mot de passe à été envoyer par email.";
					$res = array('send' => true, 'key' => 'Votre nouveau mot de passe à été envoyer par email.');
				}
				else
				{
				        // $res = "Votre nouveau mot de passe n'a pas pu être envoyé par email.";
					$res = array('notsend' => true, 'key' => 'Votre nouveau mot de passe n\'a pas pu être envoyé par email.');
				}
	    	}
	    	else {
	    		// $res = "Le mot de pass n'a pas pu être changer.";
	    		$res = array('notchanged' => true, 'key' => 'Le mot de pass n\'a pas pu être changer.');
	    	}
    	}
    	else {
    		$res = array('notexisted' => true, 'key' => 'Vous n\'existez pas en base de données.');
    	}
	}
	echo json_encode($res);