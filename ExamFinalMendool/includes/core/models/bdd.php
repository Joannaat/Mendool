<?php
	function getConnexion(){//je cree une fonction qui me permet de me co à ma bdd
		// Etape 1 : la connexion à ma bdd
		$server = 'db.3wa.io';
		$port = '3306';
		$dbname = 'joannaattali_mendool';
		$username = 'joannaattali';
		$password = '1263cc04bd1d2bf30e55d90a162f1681';

		// Construction de la chaîne de connexion : Data Source Name 
	$dsn = "mysql:host=$server;port=$port;dbname=$dbname;charset=utf8";

	try{
		$conn = new PDO($dsn, $username, $password);//cree nouvelle instance de la calsse pdo et utilise les infos de co fournies
		return $conn;//$conn peut ensuite être utilisée pour exécuter des requêtes SQL et récupérer les infos de ma bdd 
	}catch(PDOException $ex){//$ex stocke l'objet d'exception PDOException levé lors de la tentative de connexion à la base de données.
		print('Pas possible de se connecter !!!');
		die();//je stoppe l execution du script
	}
}

  