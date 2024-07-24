<?php
//session_start(); // Démarre une nouvelle session ou reprend une session existante
?>

<?php
// Connexion à la base de données MySQL
try {
    $db = new PDO('mysql:host=localhost;dbname=learning;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Configure PDO pour lever des exceptions en cas d'erreur
    ]);
} catch (Exception $e) {
    // En cas d'erreur, affiche un message et arrête le script
    die('Erreur : ' . $e->getMessage());
}

function query($db,$sql, $data = array(), $one=false){
	$req = $db->prepare($sql);
	$req->execute($data);
	if ($one) {
		return $req->fetch(PDO::FETCH_ASSOC);
	}else{
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
}
function insert($db, $sql, $data = array()){
	$req = $db->prepare($sql);
	$req->execute($data);
	return $req;
}
?>

