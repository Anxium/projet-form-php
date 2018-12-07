<?php
    $lastNameErr = $firstNameErr = $genderErr = $countryErr = $mailErr = $messageErr = "";
    $lastName = $firstName = $gender = $country = $mail = $message = "";

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
            $genderErr = "Seulement les genres 'Homme' et 'Femme' sont autorisés";
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

        if(isset($result[0]) && isset($result[1]) && isset($result[2])) {
            $subject = trim($result[0]). ' - ' . trim($result[1]) . ' - ' . trim($result[2]);
        } elseif(isset($result[0]) && isset($result[1])) {
            $subject = trim($result[0]). ' - ' . trim($result[1]);
        } else {
            $subject = trim($result[0]);
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
                                <span class="error"><?php echo $genderErr;?></span>
                            </label>
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
                                <option value="" disabled>Choisir un sujet</option>
                                <option value="Conseil">Conseil</option>
                                <option value="Service avant-vente">Service avant-vente</option>
                                <option value="Service après-vente">Service après-vente</option>
                                <option value="Livraison">Livraison</option>
                                <option value="Question diverse">Question diverse</option>
                                <option value="Problèmes techniques">Problèmes techniques</option>
                                <option value="Autre">Autre</option>
                            </select>
                            <label for="subject">Sujet</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <textarea class="materialize-textarea" name="message" placeholder="Bonjour Axel, je vous contacte pour..."><?php if(isset($message)) echo $message;?></textarea>
                            <label for="message">Message</label>
                            <span class="error"><?php echo $messageErr;?></span>
                        </div>
                    </div>
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