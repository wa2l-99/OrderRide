<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['email']) && isset($_POST['motDePasse']) && isset($_POST['retape_motDePasse']))
    {
        // Patch XSS, Convertit les caractères spéciaux en entités HTML (&,',>)

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $email = htmlspecialchars($_POST['email']);
        $motDePasse = htmlspecialchars($_POST['motDePasse']);
        $password_retype = htmlspecialchars($_POST['retape_motDePasse']);
      

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT email, motDePasse, nom, prenom, telephone FROM internautes WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule 
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($nom) <= 100){ // On verifie que la longueur du nom <= 100
                if(strlen($prenom) <= 100){ // On verifie que la longueur du prenom <= 100
                    if(strlen($telephone) <= 20){ // On verifie que la longueur du prenom <= 100

                        if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                                if(strlen($motDePasse) >= 8){ // On verifie que la longueur du mot de passe >= 8
                                    if($motDePasse === $password_retype){ // si les deux mdp saisis sont bon

                                        // On insère dans la base de données
                                        $ins = $bdd->prepare("insert into internautes(nom,prenom,telephone,email,motDePasse) values(?,?,?,?,?)");
                                        if ($ins->execute(array($nom, $prenom, $telephone, $email, md5($motDePasse) )))
                                        // On redirige avec le message de succès
                                        header('Location:inscription.php?reg_err=success');
                                        die();
                                     }else{ header('Location: inscription.php?reg_err=password'); die();}
                                }else{ header('Location: inscription.php?reg_err=pwd_length'); die();}
                            }else{ header('Location: inscription.php?reg_err=email'); die();}
                        }else{ header('Location: inscription.php?reg_err=email_length'); die();}
                     }else{ header('Location: inscription.php?reg_err=tel_length'); die();}
                }else{ header('Location: inscription.php?reg_err=prenom_length'); die();}
            }else{ header('Location: inscription.php?reg_err=nom_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }