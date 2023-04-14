<?php

	require_once "includes/core/models/bdd.php";        //(ici je me connecte a ma bdd)
    require_once "includes/core/models/chronique.php"; //(ici je definis et je recupere mes classes)

    //je cree une fonction qui va recupérer toutes mes chroniques de ma bdd et les transformer en tableau,je la rappelle dans mon crontoller_chronique pour l'executer)
	function getAllChroniques(): array{          
		$conn = getConnexion();//je rappelle ma fonction de co a ma bdd
		//preparation requête SQL pour récupérer les informations des vidéos ayant le libellé Chronique
        $SQLQuery = "SELECT videos.id, titre, lien_video, libelle 
        FROM videos INNER JOIN type_video ON id_type = type_video.id
        WHERE libelle = 'Chronique'";

        $SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->execute();

        $listeChroniques = array();//je cree une variable qui est un tableau de mes chroniques en les recupérant de la requete du dessus)
        
        //avec la boucle while je parcours les resultats renvoyes par ma requete
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){//La méthode fetch() est utilisée pour récupérer chaque ligne de résultat de la requête. Elle renvoie un tableau associatif qui contient les valeurs de chaque colonne pour la ligne courante.
			//je prend mon titre et mon lien video de ma bdd et je le met ds une variable sqlrow et je le met dans mon objet chronique
			$type = new TypeVideo($SQLRow['libelle']);// je recupere le lubelle de la video
			$uneChronique = new Chronique($SQLRow['titre'],$SQLRow['lien_video'], $type);//je recup le titre et le lien
			$uneChronique->setId($SQLRow['id']);//on utilise la meth setId pr attribuer un id a chaque chronique qu on recoit

            $listeChroniques[] = $uneChronique;
        }
        $SQLStmt->closeCursor();//méthode closeCursorlibere les ressources associées à la requête La méthode renvoie le tableau $listeChroniques contenant toutes les chroniques récupérées de la bdd

		return $listeChroniques;
    }

    function getUneChronique($idChronique): Chronique{//Le paramètre $idChronique filtre la requête sql recupére que les infos de la chronique ayant l'ID spécifié
		$conn = getConnexion();
		// Je récupère UNE Chronique
		$SQLQuery = "SELECT videos.id, titre, lien_video, libelle
		FROM videos INNER JOIN type_video ON id_type = type_video.id
		WHERE videos.id = :id";

		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $idChronique, PDO::PARAM_INT);//var de liaison permet eviter injection de sql
		$SQLStmt->execute();
		$SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
		//jeprend mon titre et mon lien video de ma bdd et je le met ds une variable sqlrow et je le met dans mon objet sketch
		$type = new TypeVideo($SQLRow['libelle']);
		$uneChronique = new Chronique($SQLRow['titre'],$SQLRow['lien_video'], $type);

		$uneChronique->setId($SQLRow['id']);

		$SQLStmt->closeCursor();
		return $uneChronique;
	}

    function insertChronique(Chronique $newChronique): bool {//insertChronique prend en paramètre une instance de la classe Chronique($newChronique) et elle renvoie un booléen pour indiquer si l'insertion de la nouvelle chronique a réussi ou pas
		$conn = getConnexion();
		//préparela requête sql pour insérer les données de la nouvelle chronique dans la bdd
		$SQLQuery = "INSERT INTO videos(titre,lien_video,id_type)
		VALUES (:titre, :lien_video,:id_type)";

		$SQLStmt = $conn->prepare($SQLQuery);
		//le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:titre
		$SQLStmt->bindValue(':titre', $newChronique->getTitre(), PDO::PARAM_STR);//La requête contient des paramètres nommés (:titre, :lien_video, :id_type) qui seront remplacés par les valeurs correspondantes lors de l'exécution de la requête
		$SQLStmt->bindValue(':lien_video', $newChronique->getLienVideo(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':id_type', $newChronique->getType()->getId(), PDO::PARAM_INT);
		;

		if (!$SQLStmt->execute()){//si l execution s est mal passée je renvoie false sinn true
			return false;
		}else{
			return true;
		}
	}

	function editChronique(Chronique $newChronique): bool {
		$conn = getConnexion();
		//requete qui permet de mettre a jour dans en modifiant titre et lien_video ayant l'ID correspondant a l'ID de la chronique
		$SQLQuery = "UPDATE videos
			SET titre = :titre, lien_video = :lien_video 
			WHERE videos.id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);//lie les valeurs de l'objet Chronique passées en paramètres aux placeholders en utilisant les méthodes bindValue()
		$SQLStmt->bindValue(':id', $newChronique->getId(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':titre', $newChronique->getTitre(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':lien_video', $newChronique->getLienVideo(), PDO::PARAM_STR);
		return $SQLStmt->execute();
	}

	function deleteChronique(int $id):bool{//fonction qui prend en parametre l'ID de la video à supprimer
		$conn = getConnexion();
		//Je dois d'abord supprimer les commentaires liés à la chronique
		$SQLQuery = "DELETE FROM commenter WHERE id_video = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
		if (!$SQLStmt->execute()){
			//Si la suppression des commentaires a échoué, on retourne false
			return false;
		}
		//si la suppression s'est bien passée, on supprime la video chronique
		$SQLQuery = "DELETE FROM videos WHERE id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $SQLStmt->execute();
	}
	
