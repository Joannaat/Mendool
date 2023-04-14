<?php
    switch($action){
        case 'view':{//ici je veux afficher la vue d'un sketch
            require_once "includes/core/models/daoSketch.php";
            require_once "includes/core/models/daoCommentaire.php";
            $id = $_GET['id'] ?? 0;
			$unSketch = getUnSketch($id);
            $lesCommentaires = getAllCommentaires($id);
            require_once "includes/core/views/view_sketch.phtml";
            break;
        }

        case 'add':{
            require_once "includes/core/models/daoSketch.php";
			if (empty($_POST)){//si$_POST est vide c'est qu'il n'a pas ete rempli 
				$unSketch = new Sketch();//donc on a doit afficher un nouvel objet pour ajouter une nouveau sketch	
			}else{
				// Je viens de valider le formulaire : j'ai cliqué sur Submit
                $unSketch = new Sketch(//pour creer cet objet je recupere les données entrées par l utilisateur et je l'insert dans ma bdd
					$_POST['title'],//la [valeur]=name du champs input sur le form view form skecth
                    $_POST['url']);
                    
				if (insertSketch($unSketch)){//je teste si qd j envoie un sketch ds la bdd ca s'est bien ft ou pas
					//l insertion s'est bien passée dc je retourne sur la liste des sketches
                    header('Location: ?page=sketch&action=list');
				}else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
					$message = "Erreur d'enregistrement !";
				}
			}
            require_once "includes/core/views/view_form_sketch.phtml";
			break;
        }

		case 'edit':{
            require_once "includes/core/models/daoSketch.php";
            $id = $_GET['id'];//je recupere l id du sketch a modifier
			$unSketch = getUnSketch($id);//je recupere les infos du sketch stockées ds la bdd que je mets ds une variable
        
			if (!empty($_POST)){//si j'ai recu quelque chose du formulaire je fais la modif
				// Je viens de valider le formulaire : j'ai cliqué sur Submit
                $unSketch->setTitre($_POST['title']);//je modifie le titre de mon sketch a partir de la donnée saisie  sur le formulaire
                $unSketch->setLienVideo($_POST['url']);//je modifie le lien video de mon sketch a partir de la donnée saisie  sur le formulai

				if (editSketch($unSketch)){//j envoie un sketch ds la bdd 
					//la modif s'est bien passée dc je retourne sur la liste des sketches
                    header('Location: ?page=sketch&action=list');
				}else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
					$message = "Erreur d'enregistrement !";
				}
			}
			require_once "includes/core/views/view_form_sketch.phtml";
			break;
        }

		case 'list':{
            //Je dois récupérer les sketches dans la base de données
            require_once "includes/core/models/daoSketch.php";
            $lesSketches = getAllSketches(); //a mettre dans le dao/)
            require_once "includes/core/views/view_list_sketches.phtml";
            break;
        }

		case 'delete':{
            require_once "includes/core/models/daoSketch.php";
            $id = $_GET['id'] ?? 0;

            if(deleteSketch($id)){
                header('Location: ?page=sketch&action=list');
            }else{
                $message = "ERREUR DE SUPPRESSION";
            }
            break;
        }
        
        case 'addCommentaire':{
            require_once "includes/core/models/daoCommentaire.php";
            require_once "includes/core/models/daoUser.php";
            //ici je verifie si le tableau est vide(l'utilisatuer n 'a pas encore soumis de com)')
			if (empty($_POST)){
				// J'arrive sur le formulaire je cree une nouvelle instance de la classe commentaire
				$unCommentaire = new Commentaire();	
			}else{
				// Je viens de valider le formulaire : j'ai cliqué sur Submit
                $unCommentaire = new Commentaire(
                    $_GET['id'],//je met get car je recupere mon id ds mon url(($_GET['id']) est l'identifiant du sketch pour lequel le commentaire est soumis)
                    getPersonnebyLogin($_SESSION['login'])->getId(),//est l'identifiant de la personne qui soumet le commentaire.on l'obtient en appelant la fction getPersonnebyLogin avec le login stocké dans la variable de session $_SESSION['login'] et en appelant la méthode getId() de l'objet Personne renvoyé pour obtenir son identifiant.
					$commentaire = htmlspecialchars($_POST['commentaire'], ENT_QUOTES, 'UTF-8'),//ici on va chercher le name,on recupere le com soumis par l utilisateur
                    new DateTime('now'));
            
				if (insertCommentaire($unCommentaire)){//je teste si qd j envoie un sketch ds la bdd ca s'est bien ft ou pas
					//l insertion s'est bien passée dc je retourne sur la liste des sketches
                    header('Location: ?page=sketch&action=view&id='.$_GET['id']);
				}else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view sketch et affiché
					$message = "Erreur de soumission";
				}
			}
            require_once "includes/core/views/view_sketch.phtml";
			break;
        }
        default:{
        }
    }