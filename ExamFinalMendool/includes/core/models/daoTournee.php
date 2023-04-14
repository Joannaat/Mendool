<?php
    require_once "includes/core/models/bdd.php";     require_once "includes/core/models/tournee.php"; //(ici je definis et je recupere mes classes)//(ici je me connecte a ma bdd)
    require_once "includes/core/models/tournee.php"; //(ici je definis et je recupere mes classes)

    //je cree une fonction que je rappelle dans mon crontoller_tournee pour l'executer)
	function getAllTournees(): array{          
		$conn = getConnexion();
            //Fonction qui exécute le SELECT ... FROM contacts et renvoie le résultat sous la forme attendue
        $SQLQuery = "SELECT evenement.id, nom_tournee, nombre_personnes, date, localisation, duree, heure
        FROM evenement";

        $SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->execute();

        $listeTournees = array();//je cree un tableau de mes tournees en les recupérant de la requete du dessus)
        //var_dump($SQLStmt->fetch());
        // var_dump($SQLStmt->fetch(PDO::FETCH_NUM));
        // var_dump($SQLStmt->fetch(PDO::FETCH_ASSOC));

        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
			$dateHeure = date_create($SQLRow['date'].' '.$SQLRow['heure']);
			$uneTournee = new Tournee( $SQLRow['nom_tournee'], $SQLRow['nombre_personnes'], $dateHeure,$SQLRow['localisation'],$SQLRow['duree']);
			
			$uneTournee->setId($SQLRow['id']);

            $listeTournees[] = $uneTournee;
        }
        $SQLStmt->closeCursor();

		return $listeTournees;
		
    }

    function getUneTournee($idTournee){
		$conn = getConnexion();
		// Je récupère UNE tournee
		$SQLQuery = "SELECT evenement.id, nom_tournee, nombre_personnes, date, localisation, duree, heure
        FROM evenement
		WHERE evenement.id = :id";

		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $idTournee, PDO::PARAM_INT);
		$SQLStmt->execute();
		$SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
		//jeprend mon titre et mon lien video de ma bdd et je le met ds une variable sqlrow et je le met dans mon objet tournee
		$dateHeure = date_create($SQLRow['date'].' '.$SQLRow['heure']);
		$uneTournee = new Tournee($SQLRow['nom_tournee'],$SQLRow['nombre_personnes'],$dateHeure ,$SQLRow['localisation'], $SQLRow['duree']);

		$uneTournee->setId($SQLRow['id']);
		$SQLStmt->closeCursor();
		return 	$uneTournee;
	}

    function insertTournee(Tournee $newTournee): bool {//pour renvoyer vrai ou faux pour dire si on a bien envoyé les donnees ds la base
		// INSERT DANS LA BDD 
		$conn = getConnexion();

		$SQLQuery = "INSERT INTO evenement( nom_tournee, nombre_personnes, date, localisation, duree, heure)
		VALUES (:nom_tournee, :nombre_personnes, :date,:localisation,:duree,:heure)";

		$SQLStmt = $conn->prepare($SQLQuery);
		//le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:titre
		$SQLStmt->bindValue(':nom_tournee', $newTournee->getNomTournee(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':nombre_personnes', $newTournee->getNombrepersonnes(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':date', $newTournee->getFullDate()->format('Y-m-d'), PDO::PARAM_STR);
		$SQLStmt->bindValue(':localisation', $newTournee->getLocalisation(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':duree', $newTournee->getDuree(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':heure', $newTournee->getFullDate()->format('H:i'), PDO::PARAM_STR);

		if (!$SQLStmt->execute()){//si l execution s est mal passée je renvoie false sinn true;
			return false;
		}else{
			return true;
		}
	}

	function deleteTournee(int $id):bool{//je dois d'abord supprimer les reservations sinon je ne peux pas supprimer la tournee en question
		$conn = getConnexion();
		
		$SQLQuery = "DELETE FROM reserver_evenement
		WHERE id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
		if ($SQLStmt->execute()){
		//Ensuite je supprime la chronique
			$SQLQuery = "DELETE FROM evenement 
				WHERE evenement.id = :id";
			$SQLStmt = $conn->prepare($SQLQuery);
			$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
			return $SQLStmt->execute();
		}
	}

	function editTournee(Tournee $newTournee): bool {
		$conn = getConnexion();
	
		$SQLQuery = "UPDATE evenement
			SET nom_tournee = :nom_tournee, nombre_personnes = :nombre_personnes, localisation = :localisation, date = :date, duree = :duree, heure = :heure
			WHERE id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $newTournee->getId(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':nom_tournee', $newTournee->getNomTournee(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':nombre_personnes', $newTournee->getNombrepersonnes(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':localisation', $newTournee->getLocalisation(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':date', $newTournee->getFullDate()->format('Y-m-d'), PDO::PARAM_STR);
		$SQLStmt->bindValue(':duree', $newTournee->getDuree(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':heure', $newTournee->getFullDate()->format('H:i'), PDO::PARAM_STR);
		$resultat = $SQLStmt->execute();
		var_dump($SQLStmt->errorInfo());
		return $resultat;
	}
