<?php
    switch($action){//$action détermine l'action à exécuter
        case 'view':{//daoChronique daoCommentaire contiennent des fonctions pour interagir avec la bdd
            require_once "includes/core/models/daoChronique.php";
            require_once "includes/core/models/daoCommentaire.php";
            $id = $_GET['id'] ??  0;//$id récupére la valeur id avec $_GET['id'], ou en utilisant  0 si cette variable n'existe pas
            $uneChronique = getUneChronique($id);//getUneChronique($id) est appelée pour récupérer les informations d'une chronique avec l'ID $id
            $lesCommentaires = getAllCommentaires($id);// getAllCommentaires($id) est appelée pour récupérer tous les commentaires associés à cette chronique
            require_once "includes/core/views/view_chronique.phtml";//view_chronique.phtml est inclus pour afficher la vue d'une chronique
            break;//on termine le swith case view ici
        }
        
        case 'add':{
            require_once "includes/core/models/daoChronique.php";
            if (empty($_POST)){
                // J'arrive sur le formulaire
                $uneChronique = new Chronique();        
            }else{
                // Je viens de valider le formulaire : j'ai cliqué sur Submit
                $uneChronique = new Chronique(
                    $_POST['title_chronique'],//cette valeur c'est le name du champs input sur le view_form_chronique
                    $_POST['url_chronique']);

                if (insertChronique($uneChronique)){//je teste si qd j envoie une chronique ds la bdd ca s'est bien ft ou pas
                    //l insertion s'est bien passée dc je retourne sur la liste des chroniques
                    header('Location: ?page=chronique&action=list');
                }else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
                    $message = "Erreur d'enregistrement !";
                }
            }
            require_once "includes/core/views/view_form_chronique.phtml";
            break;
        }
		case 'edit':{
            require_once "includes/core/models/daoChronique.php";
                $id = $_GET['id'];//je recupere l id de la chronique a modifier
                $uneChronique = getUneChronique($id);//je recupere les infos de la chronique stockées ds la bdd que je mets ds une variable
            
                if (!empty($_POST)){//si j'ai recu quelque chose du formulaire je fais la modif
                    // Je viens de valider le formulaire : j'ai cliqué sur Submit
                    $uneChronique->setTitre($_POST['title_chronique']);//je modifie le titre de ma chronique a partir de la donnée saisie  sur le formulaire
                    $uneChronique->setLienVideo($_POST['url_chronique']);//je modifie le lien video de ma chronique a partir de la donnée saisie  sur le formulai
    
                    if (editChronique($uneChronique)){//j envoie une chronique ds la bdd 
                        //la modif s'est bien passée dc je retourne sur la liste des chroniques
                        header('Location: ?page=chronique&action=list');
                    }else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
                        $message = "Erreur d'enregistrement !";
                    }
                }
            require_once "includes/core/views/view_form_chronique.phtml";
            break;
        }
        
		case 'list':{
            //Je dois récupérer les chroniques dans la base de données
            require_once "includes/core/models/daoChronique.php";
            $lesChroniques = getAllChroniques(); 

            require_once "includes/core/views/view_list_chroniques.phtml";
            break;
        }
		case 'delete':{
            require_once "includes/core/models/daoChronique.php";

            $id = $_GET['id'] ?? 0;
            if(deleteChronique($id)){
                header('Location: ?page=chronique&action=list');
            }else{
                $message = "ERREUR DE SUPPRESSION";
            }
            break;
        }
        case 'addCommentaire':{
            require_once "includes/core/models/daoCommentaire.php";
            require_once "includes/core/models/daoUser.php";
            
			if (empty($_POST)){
				// J'arrive sur le formulaire
				$unCommentaire = new Commentaire();	
			}else{
				// Je viens de valider le formulaire : j'ai cliqué sur Submit
                $unCommentaire = new Commentaire(
                    $_GET['id'],//je met get car je recupere mon id ds mon url
                    getPersonnebyLogin($_SESSION['login'])->getId(),
					$_POST['commentaire'],//cette valeur c'est le name du champs input sur le form view form skecth
                    new DateTime('now'));
                  
				if (insertCommentaire($unCommentaire)){//je teste si qd j envoie un sketch ds la bdd ca s'est bien ft ou pas
					//l insertion s'est bien passée dc je retourne sur la liste des chroniques
                    header('Location: ?page=chronique&action=view&id='.$_GET['id']);
				}else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
					$message = "Erreur d'enregistrement !";
				}
			}
            require_once "includes/core/views/view_chronique.phtml";
			break;
        }
        default:{

        }
    }