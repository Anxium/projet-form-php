<?php

if (isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['country']) && isset($_POST['mail']) && isset($_POST['message']) && isset($_POST['subject'])) {

    $options = array(
        'name' 	        => FILTER_SANITIZE_STRING,
        'gender'        => FILTER_SANITIZE_STRING,
        'country' 		=> FILTER_SANITIZE_STRING,
        'mail' 		    => FILTER_VALIDATE_EMAIL,
        'message' 		=> FILTER_SANITIZE_STRING
    );

    $subject = $_POST['subject'];

    $result = filter_input_array(INPUT_POST, $options);
    $result += filter_var_array($subject, FILTER_SANITIZE_STRING);

    $flag = false;

    print_r($result);
}


    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Exercices sur les formulaires</title>
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
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
                        <div class="input-field col m6 s12">
                            <?php
                                if (isset($result['name'])) {
                                    if(empty($result['name'])) {
                                        echo '<input type="text" name="name" class="wrong" required/>';
                                    } else {
                                        echo '<input type="text" name="name" value="' . $result['name'] . '" required disabled/>';
                                    }
                                } else {
                                    echo '<input type="text" name="name"/>';
                                }
                            ?>
                            <label for="name">Nom & prénom</label>
                        </div>
                        <div class="col m6 s12 genre">
                            <?php
                                if (isset($result['gender'])) {
                                    if(empty($result['gender'])) { ?>
                                        <label class="col m6 s6 genre wrong">
                                            <input type="radio" name="gender" value="Homme" required/>
                                            <span>Homme</span>
                                        </label>
                                        <label class="col m6 s6 genre wrong">
                                            <input type="radio" name="gender" value="Femme" required/>
                                            <span>Femme</span>
                                        </label>
                                    <?php } else { 
                                        if ($result['gender'] == 'Homme') { ?>
                                            <label class="col m6 s6 genre">
                                                <input type="radio" name="gender" value="Homme" checked disabled required/>
                                                <span>Homme</span>
                                            </label>
                                            <label class="col m6 s6 genre">
                                                <input type="radio" name="gender" value="Femme" disabled required/>
                                                <span>Femme</span>
                                            </label>
                                        <?php } else { ?>
                                            <label class="col m6 s6 genre">
                                                <input type="radio" name="gender" value="Homme" disabled required/>
                                                <span>Homme</span>
                                            </label>
                                            <label class="col m6 s6 genre">
                                                <input type="radio" name="gender" value="Femme" checked disabled required/>
                                                <span>Femme</span>
                                            </label>
                                        <?php }
                                    }
                                } else {?>
                                    <label class="col m6 s6 genre">
                                        <input type="radio" name="gender" value="Homme" required/>
                                        <span>Homme</span>
                                    </label>
                                    <label class="col m6 s6 genre">
                                        <input type="radio" name="gender" value="Femme" required/>
                                        <span>Femme</span>
                                    </label>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <?php
                                if (isset($result['country'])) {
                                    if(empty($result['country'])) {
                                        echo '<input type="text" name="country" class="wrong" required/>';
                                    } else {
                                        echo '<input type="text" name="country" value="' . $result['country'] . '" required disabled/>';
                                    }
                                } else {
                                    echo '<input type="text" name="country"/>';
                                }
                            ?>
                            <label for="country">Pays</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <?php
                                if (isset($result['mail'])) {
                                    if($result['mail'] == false) {
                                        echo '<input type="text" name="mail" class="wrong" required/>';
                                    } else {
                                        echo '<input type="text" name="mail" value="' . $result['mail'] . '" required disabled/>';
                                    }
                                } else {
                                    echo '<input type="text" name="mail"/>';
                                }
                            ?>
                            <label for="mail">E-mail</label>
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
                                <option value="Autres">Autres</option>
                            </select>
                            <label for="subject">Sujet</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <?php
                                if (isset($result['message'])) {
                                    if(empty($result['message'])) {
                                        echo '<textarea class="materialize-textarea wrong" name="message" required></textarea>';
                                    } else {
                                        echo '<textarea class="materialize-textarea" name="message" class="wrong" required disabled>' . $result['message'] . '</textarea>';
                                    }
                                } else {
                                    echo '<input type="text" name="message"/>';
                                }
                            ?>
                            <label for="message">Message</label>
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