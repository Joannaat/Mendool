<?php
    switch($action){
        case 'view':{
            require_once "includes/core/models/daoTournee.php";
            $id = $_GET['id'];
            $uneTournee = getUneTournee($id);
            require_once "includes/core/view_tournee.phtml";
        break;
        }

        case 'add':{
            require_once "includes/core/models/daoTournee.php";
            if (empty($_POST)){
                // J'arrive sur le formulaire
                $uneTournee = new Tournee();
            }else{
                // Je viens de valider le formulaire : j'ai cliqué sur Submit
                $uneTournee = new Tournee(
                    $_POST['nom_tournee'],//cette valeur c'est le name du champs input sur le view_form_tournee
                    $_POST['personnes'],
                    date_create($_POST['date'].' '.$_POST['heure']),
                    $_POST['localisation'],
                    $_POST['duree']);
                
                if (insertTournee($uneTournee)){//je teste si qd j envoie une tournee ds la bdd ca s'est bien ft ou pas
                    //l insertion s'est bien passée dc je retourne sur la liste des tournees
                    header('Location: ?page=tournee&action=list');
                }else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view tournee et affiché
                    $message = "Erreur d'enregistrement !";
                }
            }
            require_once "includes/core/views/view_form_tournee.phtml";
            break;
        }

		case 'edit':{
            require_once "includes/core/models/daoTournee.php";
            $id = $_GET['id'];//je recupere l id de la tournee a modifier
			$uneTournee = getUneTournee($id);//je recupere les infos de la tournee stockées ds la bdd que je mets ds une variable
           
			if (!empty($_POST)){//si j'ai recu quelque chose du formulaire je fais la modif
				// Je viens de valider le formulaire : j'ai cliqué sur Submit
                $uneTournee->setNomTournee($_POST['nom_tournee']);//je modifie le titre de ma tournee a partir de la donnée saisie  sur le formulaire
                $uneTournee->setNombrepersonnes($_POST['personnes']);//je modifie le lien video de ma tournee a partir de la donnée saisie  sur le formulai
                $uneTournee->setDate(date_create($_POST['date'].' '.$_POST['heure']));
                $uneTournee->setLocalisation($_POST['localisation']);
                $uneTournee->setDuree($_POST['duree']);

				if (editTournee($uneTournee)){//j envoie uune tournee ds la bdd 
					//la modif s'est bien passée dc je retourne sur la liste des tournees
                    header('Location: ?page=tournee&action=list');
				}else{//l insertion s'est mal passée j affiche un message(qui est stoqué ds la var message)que je rappelle dans le view tournee et affiché
					$message = "Erreur d'enregistrement !";
				}
			}
			require_once "includes/core/views/view_form_tournee.phtml";
			break;
        }

		case 'list':{
            //Je dois récupérer les tournees dans la base de données
            require_once "includes/core/models/daoTournee.php";
            $lesTournees = getAllTournees(); //a mettre dans le dao/)
            require_once "includes/core/views/view_list_tournees.phtml";
            break;
        }

		case 'delete':{
            require_once "includes/core/models/daoTournee.php";
                $id = $_GET['id'] ?? 0;
                
                if(deleteTournee($id)){
                    header('Location: ?page=tournee&action=list');
                }else{
                    $message = "ERREUR DE SUPPRESSION";
                }
                break;
            }
            default:{ 

            }
    }