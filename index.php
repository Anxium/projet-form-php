<?php
    $lastNameErr = $firstNameErr = $genderErr = $countryErr = $mailErr = $subjectErr = $messageErr = "";
    $lastName = $firstName = $gender = $country = $mail = $subject = $message = "";

    if(isset($_POST['lastName'])) {
       $result = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING));

        if(empty($result)) {
            $lastNameErr = "Un nom est requis";
        } elseif(!preg_match("/^[a-zA-Z éèçà-]*$/", $result)) {
            $lastNameErr = "Seulement les lettres et les espaces sont autorisés";
        } else {
            $lastName = $result;
        }
    }

    if(isset($_POST['firstName'])) {
        $result = trim(filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING));

        if(empty($result)) {
            $firstNameErr = "Un prénom est requis";
        } elseif(!preg_match("/^[a-zA-Z éèçà-]*$/", $result)) {
            $firstNameErr = "Seulement les lettres et les espaces sont autorisés";
        } else {
            $firstName = $result;
        }
    }

    if(isset($_POST['gender'])) {
        $result = trim(filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING));

        if(empty($result)) {
            $genderErr = "Un genre est requis";
        } elseif($result != 'Homme' && $result != 'Femme') {
            $genderErr = "Seul les genres 'Homme' et 'Femme' sont autorisés";
        } else {
            $gender = $result;
        }
    }

    if(isset($_POST['country'])) {
        $result = trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));

        if(empty($result)) {
            $countryErr = "Un Pays est requis";
        } elseif(!preg_match("/^[a-zA-Z éèçà-]*$/", $result)) {
            $countryErr = "Seulement les lettres et les espaces sont autorisés";
        } else {
            $country = $result;
        }
    }

    if(isset($_POST['mail'])) {
        $result = trim($_POST['mail']);

        if(empty($result)) {
            $mailErr = "Une adresse mail est requise";
        } elseif(!filter_var($result, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Une adresse mail valide est requise";
        } else {
            $mail = $result;
        }
    }

    if(isset($_POST['subject'])) {
        $result = filter_var_array($_POST['subject'], FILTER_SANITIZE_STRING);

        switch (sizeof($result)) { // Nécéssaire dans le cas ou JS est désactivé | Vérifie si le nombre de sujets ne dépasse pas 3, sinon erreur.
            case 1:
                $subject = trim($result[0]);
                break;
            case 2:
                $subject = trim($result[0]). ' & ' . trim($result[1]);
                break;
            case 3:
                $subject = trim($result[0]). ' & ' . trim($result[1]) . ' & ' . trim($result[2]);
                break;
            default:
                $subjectErr = "Vous ne pouvez sélectionner que 3 sujets maximum.";
        }
    } else {
        $subject = "Autre";
    }
    
    if(isset($_POST['message'])) {
        $result = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

        if(empty($result)) {
            $messageErr = "Un message est requis";
        } elseif(!filter_var($result, FILTER_SANITIZE_STRING)) {
            $messageErr = "Un message valide est requis";
        } else {
            $message = $result;
        }
    }

    if(!empty($lastName) && !empty($firstName) && !empty($gender) && !empty($country) && !empty($mail) && !empty($subject) && !empty($message) && empty($_POST['honeypot'])) {
        echo 'Mail envoyé';

        $to = 'axel.avx@gmail.com';
        $subject = 'Contact - ' . $lastName . ' ' . $firstName . ' | ' . $subject;
        $eMessage = '
        <html>
         <head>
          <title>Demande de contact</title>
         </head>
            ' . $message . '
         </body>
        </html>
        ';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: ' . $firstName . '<' . $mail . '>';

        mail($to, $subject, $eMessage, implode("\r\n", $headers));

    } elseif(!empty($_POST['honeypot'])) {
        echo 'Touche pas au code qui/quoi que tu sois.';
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Exercices sur les formulaires</title>
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
    <link rel="icon" type="image/png" href="assets/img/hackers-poulette-logo.png"/>
</head>
<body>
    <div class="container center-align">
        <img src="assets/img/hackers-poulette-logo.png" alt="logo hackers poulettes"/>
    </div>
    <div class="container form-container">
        <div class="row">
            <div class="col m10 offset-m1 s12 formulaire">
                <form action="index.php" method="POST">
                    <div class="row">
                        <div class="input-field col m3 s12">
                            <input type="text" name="lastName" value="<?php if(isset($lastName)) echo $lastName;?>"/>
                            <label for="name">Nom</label>
                            <span class="error"><?php echo $lastNameErr;?></span>
                        </div>
                        <div class="input-field col m3 s12">
                            <input type="text" name="firstName" value="<?php if(isset($firstName)) echo $firstName;?>"/>
                            <label for="name">Prénom</label>
                            <span class="error"><?php echo $firstNameErr;?></span>
                        </div>
                        <div class="col m6 s12 genre">
                            <label class="col m6 s6 genre">
                                <input type="radio" name="gender" value="Homme" <?php if($gender=="Homme") echo "checked";?>/>
                                <span>Homme</span>

                            </label>
                            <label class="col m6 s6 genre">
                                <input type="radio" name="gender" value="Femme" <?php if($gender=="Femme") echo "checked";?>/>
                                <span>Femme</span>
                            </label>
                            <span class="error"><?php echo $genderErr;?></span>
                            <input class="hide" type="radio" name="gender" value="" <?php if(!isset($_POST['gender'])) echo "checked";?>/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input type="text" name="country" value="<?php if(isset($country)) echo $country;?>"/>
                            <label for="country">Pays</label>
                            <span class="error"><?php echo $countryErr;?></span>
                        </div>
                        <div class="input-field col m6 s12">
                            <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail;?>"/>
                            <label for="mail">E-mail</label>
                            <span class="error"><?php echo $mailErr;?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <select name="subject[]" multiple>
                                <option value="" disabled>Choisir un sujet (OU autre)</option>
                                <option value="Conseil">Conseil</option>
                                <option value="Service avant-vente">Service avant-vente</option>
                                <option value="Service après-vente">Service après-vente</option>
                                <option value="Livraison">Livraison</option>
                                <option value="Question diverse">Question diverse</option>
                                <option value="Problèmes techniques">Problèmes techniques</option>
                                <option value="Autre">Autre</option>
                            </select>
                            <label for="subject">Sujet</label>
                            <span class="error"><?php echo $subjectErr;?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <textarea class="materialize-textarea" name="message" placeholder="Bonjour Axel, je vous contacte pour..."><?php if(isset($message)) echo $message;?></textarea>
                            <label for="message">Message</label>
                            <span class="error"><?php echo $messageErr;?></span>
                        </div>
                    </div>
                    <input type="text" name="honeypot" class="hide">
                    <div class="row">
                        <input class="btn envoi" type="submit" value="Envoyer"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
