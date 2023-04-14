<?php

	require_once "includes/core/models/bdd.php";        //(ici je me connecte a ma bdd)
    require_once "includes/core/models/sketch.php"; //(ici je definis et je recupere mes classes)

    //je cree une fonction que je rappelle dans mon crontoller_sketch pour lexcuter)
	function getAllSketches(): array{          
		$conn = getConnexion();
            //Fonction qui exécute le SELECT ... FROM contacts et renvoie le résultat sous la forme attendue
        $SQLQuery = "SELECT videos.id, titre, lien_video, libelle 
        FROM videos INNER JOIN type_video ON id_type = type_video.id
        WHERE libelle = 'Sketch'";

        $SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->execute();

        $listeSketches = array();//je cree un tableau de mes skecthes en les recupérant de la requete du dessus)
        //var_dump($SQLStmt->fetch());
        // var_dump($SQLStmt->fetch(PDO::FETCH_NUM));
        // var_dump($SQLStmt->fetch(PDO::FETCH_ASSOC));

        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
			//new Sketch('BONHEUR', lien video');
			//jeprend mon titre et mon lien video de ma bdd et je le met ds une variable sqlrow et je le met dans mon objet sketch
			$type = new TypeVideo($SQLRow['libelle']);
			$unSketch = new Sketch($SQLRow['titre'],$SQLRow['lien_video'], $type);
			
			$unSketch->setId($SQLRow['id']);

            $listeSketches[] = $unSketch;
        }
        $SQLStmt->closeCursor();

		return $listeSketches;
    }

    function getUnSketch($idSketch): Sketch{
		$conn = getConnexion();
		// Je récupère UN sketch
		$SQLQuery = "SELECT videos.id, titre, lien_video, libelle
		FROM videos INNER JOIN type_video ON id_type = type_video.id
		WHERE videos.id = :id";

		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $idSketch, PDO::PARAM_INT);
		$SQLStmt->execute();
		$SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
//jeprend mon titre et mon lien video de ma bdd et je le met ds une variable sqlrow et je le met dans mon objet sketch
		$type = new TypeVideo($SQLRow['libelle']);
		$unSketch = new Sketch($SQLRow['titre'],$SQLRow['lien_video'], $type);
		$unSketch->setId($SQLRow['id']);
		$SQLStmt->closeCursor();
		return $unSketch;
	}

	function insertSketch(Sketch $newSketch): bool {//pour renvoyer vrai ou faux pour dire si on a bien envoyé les donnees ds la base
		// INSERT DANS LA BDD 
		$conn = getConnexion();

		$SQLQuery = "INSERT INTO videos(titre,lien_video,id_type)
		VALUES (:titre, :lien_video,:id_type)";

		$SQLStmt = $conn->prepare($SQLQuery);
		//le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:titre
		$SQLStmt->bindValue(':titre', $newSketch->getTitre(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':lien_video', $newSketch->getLienVideo(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':id_type', $newSketch->getType()->getId(), PDO::PARAM_INT);
		;

		if (!$SQLStmt->execute()){//si l eexcution s est mal passée je renvoie false sinn true
			return false;
		}else{
			return true;
		}
	}
	
	function deleteSketch(int $id):bool{
		$conn = getConnexion();
		
		$SQLQuery = "DELETE FROM commenter
			WHERE id_video = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
		if (!$SQLStmt->execute()){
			//Si la suppression des commentaires a échoué, on retourne false
			return false;
		}
		//Ensuite, on supprime le sketch
		$SQLQuery = "DELETE FROM videos WHERE id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
		return $SQLStmt->execute();
	}

	function editSketch(Sketch $newSketch): bool {
		$conn = getConnexion();
	
		$SQLQuery = "UPDATE videos
			SET titre = :titre, lien_video = :lien_video
			WHERE videos.id = :id";
		$SQLStmt = $conn->prepare($SQLQuery);
		$SQLStmt->bindValue(':id', $newSketch->getId(), PDO::PARAM_INT);
		$SQLStmt->bindValue(':titre', $newSketch->getTitre(), PDO::PARAM_STR);
		$SQLStmt->bindValue(':lien_video', $newSketch->getLienVideo(), PDO::PARAM_STR);
		return $SQLStmt->execute();
	}
