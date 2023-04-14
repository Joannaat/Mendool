<?php
/**********************************Ici code pour savoir sur quelle page on va atterir , s'il y a quelque chose ds la page, j affiche la page sinon j affiche l index si on renseigne pa sla page***********************/
	
	session_start();
	$page = $_GET['page'] ?? 'index';
	$action = $_GET['action'] ?? 'view'; 
	
	switch ($page){
		case 'index':{
			require_once "includes/core/controllers/controller_index.php";
			break;
		}
		case 'sketch':{
			require_once "includes/core/controllers/controller_sketch.php";
			break;
		}
		case 'tournee':{
			require_once "includes/core/controllers/controller_tournee.php";
			break;
		}
		case 'chronique':{
			require_once "includes/core/controllers/controller_chronique.php";
			break;
		}
		case 'user':{
			require_once "includes/core/controllers/controller_user.php";
			break;
		}
		case'inscription':{
			require_once "includes/core/controllers/controller_user.php";
			break;
		}
		default:{
			require_once "includes/core/controllers/controller_erreur.php";
		}
	}