<?php
    
    require_once "includes/core/models/bdd.php";        //(ici je me connecte a ma bdd)
    require_once "includes/core/models/commentaire.php";
    require_once "includes/core/models/sketch.php";


    function getAllCommentaires(int $idVideo): array{
        //Récupérer tous les commentaires d'une video
        $conn = getConnexion();

        $SQLQuery = "SELECT commenter.id_video,id_personne, commentaire, date
        FROM commenter
        WHERE id_video = :idvideo
        ORDER BY date DESC";

        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':idvideo',$idVideo, PDO::PARAM_INT);
        $SQLStmt->execute();

        $listesCommentaires = array();
        while($SQLRow=$SQLStmt->fetch(PDO::FETCH_ASSOC)){//pour chaque ligne de resultat de la requete et je la transforme en objet
        $unCommentaire = new Commentaire ($SQLRow['id_video'], $SQLRow['id_personne'], $SQLRow['commentaire'], date_create($SQLRow['date']));

        $listesCommentaires[] = $unCommentaire;
        }
        $SQLStmt->closeCursor();

		return $listesCommentaires;
    }


    function getUncommentaire(int $idVideo, int $idPersonne): Commentaire {
        //Récupère un commenataire pour une video pour une personne
        $conn = getConnexion();
    
        $SQLQuery = "SELECT commenter.id_video, id_personne,commentaire, date
        FROM commenter
        WHERE id_personne = :idpersonne
            AND id_video = :idvideo";
    
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':idpersonne', $idPersonne, PDO::PARAM_INT);//je veux le com qui correspond a cet id
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unCommentaire = new Commentaire($SQLRow['commentaire'], $SQLRow['date']);
        $unCommentaire->setId($SQLRow['id']);
    
        $SQLStmt->closeCursor();
        return $unCommentaire;
    } 
	
    function insertCommentaire(Commentaire $newCommentaire):bool {//pour renvoyer vrai ou faux pour dire si on a bien envoyé les donnees ds la base
        $conn = getConnexion();
    
        $SQLQuery = "INSERT INTO commenter(id_video, id_personne, commentaire,date)
        VALUES (:idvideo, :idpersonne, :commentaire, :date)";
        $SQLStmt = $conn->prepare($SQLQuery);

        //le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:nom etc
        $SQLStmt->bindValue(':idvideo', $newCommentaire->getIdVideo(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':idpersonne', $newCommentaire->getIdPersonne(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':commentaire', $newCommentaire->getCommentaire(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':date', $newCommentaire->getDate()->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        if (!$SQLStmt->execute()){//si l eexcution s est mal passée je renvoie false sinn true
            return false;
        }else{
            return true;
        }
    }
    
   /* function deleteCommentaire(int $id): bool{
    $conn = getConnexion();

    // Je vérifie si la personne est connectée
    if (!isset($_SESSION['id_personne'])) {
        return false;
    }
    // Ici je supprime le commentaire de la personne connectée
    $SQLQuery = "DELETE FROM commenter 
                 WHERE id_video = :id
                 AND id_personne = :id_personne";
    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
    $SQLStmt->bindValue(':id_personne', $_SESSION['id_personne'], PDO::PARAM_INT);

    if (!$SQLStmt->execute()) {
        // Si la suppression du commentaire a échoué, on retourne false
        
        return false;
    }

    return true;
    }*/

		