<?php   
    require_once "includes/core/models/bdd.php";
    require_once "includes/core/models/user.php";

    function userExists(string $login):bool{
        $conn = getConnexion();

        $SQLQuery = "SELECT COUNT(id) as existe
        FROM userauth
        WHERE login = :login";

        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':login',$login, PDO::PARAM_STR);
        $SQLStmt->execute();

        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $loginTrouve = $SQLRow['existe'];

        $SQLStmt->closeCursor();
        
        return ($loginTrouve>0);
    }

    function checkAuth(string $login,string $mdp):bool{
        $conn = getConnexion();

        $SQLQuery = "SELECT mdp
        FROM userauth
        WHERE login = :login";

        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':login',$login, PDO::PARAM_STR);
        $SQLStmt->execute();

        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $motDePassStocke = $SQLRow['mdp'];

        $SQLStmt->closeCursor();

        return (password_verify($mdp,$motDePassStocke));
    }
    
    function isAdmin(string $login): bool{
        $conn = getConnexion();

        $SQLQuery = "SELECT visiteur
        FROM userauth
        WHERE login = :login";

        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':login',$login, PDO::PARAM_STR);
        $SQLStmt->execute();

        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $visiteur = $SQLRow['visiteur'];

       if ($visiteur == 0){//cette fonction va chercher  ds la table userauth la valeur du champ visiteur pour le login donné
        //qd elle aura recup cette valeur elle renvoie si la valeur visiteur vaut 1
        //ca veut dire que le login n est pas administrateur donc elle devra renvoyer false sinon elle renverra true
            return true;
        }else{
            return false;
        }
    }

/***************************************Acces visiteur**********************/
function getPersonnebyId(int $id): User {
    $conn = getConnexion();

    $SQLQuery = "SELECT personne.id, nom, prenom, mail, visiteur, mdp, login
    FROM personne INNER JOIN userauth ON id_personne = personne.id
    WHERE personne.id = :id";

    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);//je veux la pers qui correspon d a cet id
    $SQLStmt->execute();
    
    $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
    $unePersonne = new User($SQLRow['nom'],$SQLRow['prenom'],$SQLRow['mail'],$SQLRow['visiteur'],$SQLRow['mdp'],$SQLRow['login'] );
    $unePersonne->setId($SQLRow['id']);

    $SQLStmt->closeCursor();
    return $unePersonne;
}

function getPersonnebyLogin(string $login): User {
    $conn = getConnexion();

    $SQLQuery = "SELECT personne.id, nom, prenom, mail, visiteur, mdp, login
    FROM personne INNER JOIN userauth ON id_personne = personne.id
    WHERE userauth.login = :login";

    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindvalue(':login',$login, PDO::PARAM_STR);// je veux la pers qui correspond a ce login
    $SQLStmt->execute();

    $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
    $unePersonne = new User($SQLRow['nom'],$SQLRow['prenom'],$SQLRow['mail'],$SQLRow['visiteur'],$SQLRow['mdp'],$SQLRow['login'] );
    $unePersonne->setId($SQLRow['id']);

    $SQLStmt->closeCursor();
    return $unePersonne;
}


function insertPersonne(User $newPersonne):bool {//pour renvoyer vrai ou faux pour dire si on a bien envoyé les donnees ds la base
    $conn = getConnexion();

    $SQLQuery = "INSERT INTO personne(nom,prenom,mail)
    VALUES (:nom, :prenom, :mail)";
    $SQLStmt = $conn->prepare($SQLQuery);

    //le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:nom etc
    $SQLStmt->bindValue(':nom', $newPersonne->getNom(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':prenom', $newPersonne->getPrenom(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':mail', $newPersonne->getMail(), PDO::PARAM_STR);
    if ($SQLStmt->execute()){//si l execution se passe bien je m'occupe de userAuth
        $newPersonne->setId($conn->lastInsertId());
        
        $SQLQuery = "INSERT INTO userauth(login, mdp, visiteur, id_personne)
        VALUES (:login, :mdp, 1, :idpersonne)";
        $SQLStmt = $conn->prepare($SQLQuery);
    
        //le bindvalue affecte la valeur qu'on a mit ds le controller pour renseigner la valeur recue du form a la variable:nom etc
        $SQLStmt->bindValue(':login', $newPersonne->getLogin(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':mdp', $newPersonne->getMdp(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':idpersonne', $newPersonne->getId() , PDO::PARAM_INT);
        if (!$SQLStmt->execute()){//si l eexcution s est mal passée je renvoie false sinn true
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}