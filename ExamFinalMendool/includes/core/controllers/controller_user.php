<?php
    require_once "includes/core/models/daoUser.php";
    switch ($action){
        case 'login':{
            if(!empty($_POST)){
                $loginSaisi = $_POST['ChLogin'];
                $mdpSaisi = $_POST['ChMdp'];
                
                if(userExists($loginSaisi)){
                    if(CheckAuth($loginSaisi,$mdpSaisi)){
                        $_SESSION['login'] = $loginSaisi;//
                        $_SESSION['admin'] = isAdmin($loginSaisi);//isAdmin permet de savr si l tuilisateur est un visiteur ou pas(elle renvoie vrai ou faux)
                        header('location: index.php');
                    }else{
                        $message = 'Erreur d\'identification';
                    }
                }else{
                    $message = 'Cet utilisateur n\'existe pas';
                }
            }
        }
            require_once "includes/core/views/view_form_user.phtml";
            break;
            
        case 'logout':{
            if(isset($_SESSION['login'])){//si login existe dans session c''est que l'utilisateur est connecté
                unset($_SESSION['login']);//supprime la variable login de la session
                unset($_SESSION['admin']);//supprime la variable admin de la session
            }
            header('location: index.php');
            break;
        }

        case'inscription':{
            //j'arrive sur le form d'inscripiton
            if (empty($_POST)){
				//s'il est vide je crée une nouvelle instance ( donc un nouveau user)
				$unePersonne = new User();	
			}else{
                // si le form est pas vide je recupere les infos
                $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');//cette valeur c'est le name du champs input sur le form view form skecth
                $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8');
                $password = trim($_POST['password']);//ici je sors les espaces eventuels insérés ds le password
                
                if (!empty($nom) && !empty($prenom) && !empty($login) && strlen($nom) <= 20 && strlen($prenom) <= 20 && strlen($login) <= 20
                    && preg_match("/^[a-zA-Z]+$/", $nom) && preg_match("/^[a-zA-Z]+$/", $prenom) && preg_match("/^[a-zA-Z0-9]+$/", $login)){
                     
                  if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strcmp($_POST['email'], $_POST['emailConfirm']) == 0//validatio que si les 2 mails sont pareils
                    && !empty($password) && strlen($password) >= 8){
                      $unePersonne = new User(
                        $login,
                        password_hash($password, PASSWORD_ARGON2ID),//on fait appel a une fonction php qui hache le password
                        true,
                        $nom, 
                        $prenom,
                        $email,
                        );
                        
                        if (insertPersonne($unePersonne)){//je teste si qd j envoie une pers ds la bdd ca s'est bien ft ou pas
					    //l insertion s'est bien passée dc je retourne sur ma view index
                            echo "ajout bdd";
                            $_SESSION['login'] = $login;//ca permet de faire en sorte que la personne enregistrée soit co directement apres inscription
                            header('Location: ?page=index&action=view&status=inscription_success');
                        }else{
                            $message ="Erreur interne. Essayez ultérieurement";
                        }
                  }else{
                      $message = "Email et/ou mot de passe invalide";
                  }
                }else{
                   $message = "L'utilisateur et/ou mot de passe invalide"; 
                }
			}
            require_once "includes/core/views/view_form_inscription.phtml";
            break;
        }
    }