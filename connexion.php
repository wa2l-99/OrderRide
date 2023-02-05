<?php
    //démarrage de la session
    session_start();

    // On inclut la connexion à la base de données
    require_once 'config.php';

    // Si il existe les champs email, password et qu'il sont pas vident
    if(isset($_POST['email']) && isset($_POST['motDePasse'])) 
    {
        // Convertit les caractères spéciaux en entités HTML (&,',>)
        $email = htmlspecialchars($_POST['email']); 
        $motDePasse = htmlspecialchars($_POST['motDePasse']);
        $pass_crypt = htmlspecialchars(md5($_POST['motDePasse']));
        // email transformé en minuscule
        $email = strtolower($email); 
        // On regarde si l'utilisateur est inscrit dans la table internautes
        //prepare : Prépare une requête à l'exécution et retourne un objet
        $check = $bdd->prepare("select * from internautes where email=? and motDePasse=? limit 1");
        $check->execute(array($email,$pass_crypt));
        //fetchAll: méthode permette de retourner un tableau contenant toutes les lignes d'internautes
        $user = $check->fetchAll();
        // Si > à 0 alors l'utilisateur existe
        if(count($user) > 0)
        {
            //Creation des variables de sessions et stocker les données pour chaque utilisateur dans les sessions sous forme de tableau.
            $_SESSION["prenom_nom"] = ucfirst(strtolower($user[0]["prenom"])) .
            " "  .  strtoupper($user[0]["nom"]);
            $_SESSION["email"] = strtolower($user[0]["email"]);
            $_SESSION["connecter"] = "yes";
            //Redirection vers index
            header('Location: index.php');
        }else{ header('Location: login.php?login_err=erreur'); die(); }
    // si le formulaire est envoyé sans aucune données
    }else{ header('Location: login.php'); die();} 
?>