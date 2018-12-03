<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercices sur les formulaires</title>
    <link rel="stylesheet" type="text/css" href="assets/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container center-align">
        <img src="assets/img/hackers-poulette-logo.png" alt="logo hackers poulettes">
    </div>
    <div class="container form-container">
        <div class="row">
            <div class="col m10 offset-m1 s12 formulaire">
                <form action="index.php" method="POST">
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input type="text" name="name" required/>
                            <label for="name">Nom & prénom</label>
                        </div>
                        <div class="col m6 s12 genre">
                            <label class="col m6 s6 genre">
                                <input type="radio" name="gender" value="Homme" required/>
                                <span>Homme</span>
                            </label>
                            <label class="col m6 s6 genre">
                                <input type="radio" name="gender" value="Femme" required/>
                                <span>Femme</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <input type="text" name="country" required/>
                            <label for="country">Pays</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <input type="email" name="mail" required/>
                            <label for="mail">E-mail</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <select name="subject" multiple>
                                <option value="" disabled>Choisir un sujet</option>
                                <option value="Problèmes techniques">Problèmes techniques</option>
                                <option value="Livraison">Livraison</option>
                                <option value="Question diverse">Question diverse</option>
                                <option value="Option 4">Option 4</option>
                                <option value="Option 5">Option 5</option>
                            </select>
                            <label for="subject">Sujet</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col m12 s12">
                            <textarea class="materialize-textarea" name="message" required></textarea>
                            <label for="message">Message</label>
                        </div>
                    </div>
                    <div class="row">
                        <input class="btn waves-effect waves-light" type="submit" value="Envoyer"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

        $options = array(
            'name' 	        => FILTER_SANITIZE_STRING,
            'gender'        => FILTER_SANITIZE_STRING,
            'country' 		=> FILTER_SANITIZE_STRING,
            'mail' 		    => FILTER_VALIDATE_EMAIL,
            'subject' 		=> FILTER_SANITIZE_STRING,
            'message' 		=> FILTER_SANITIZE_STRING
        );

        $result = filter_input_array(INPUT_POST, $options);

        if ($result != null AND $result != FALSE) {

            foreach($options as $key => $value) 
            {
               $result[$key]=trim($result[$key]);
               echo $result[$key] . '<br/>';
            }
        
        } else {

            echo 'Ce n\'est pas bon!';

        }

    ?>

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>