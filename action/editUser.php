<?php

require_once '../include/database.php';

session_start();

// on recupere l'id de l'utilisateur dans l'url
$id = $_GET['id'];

// on recupere les données du formulaire
if (isset($_POST['edit'])) {
	
	$nom = $_POST['nom'];
	$mail = $_POST['mail'];
	$mp = $_POST['mp'];

	
	// si l'utilisateur est un admin 
	if (isset($_SESSION['admin'])) {
		// on recupere le role de l'utilisateur
		$role = intval($_POST['role']);
		// on modifie l'utilisateur dans la base de données
		$query = "UPDATE users SET nom = :nom, mail = :mail, mp = :mp, role = :role WHERE id = :id";
		$statement = $pdo->prepare($query);
		$statement->execute([':nom' => $nom, ':mail' => $mail, ':mp' => $mp, ':role' => $role, ':id' => $id]);
		// on redirige l'admin vers la page admin
		$_SESSION['flash']['success'] = "L'utilisateur " . $nom . " a bien été modifié";
		header("Location: ../page/admin.php");
		exit();

	} else { // sinon on modifie l'utilisateur dans la base de données
		$query = "UPDATE users SET nom = :nom, mail = :mail, mp = :mp WHERE id = :id";
		$statement = $pdo->prepare($query);
		$statement->execute([':nom' => $nom, ':mail' => $mail, ':mp' => $mp, ':id' => $id]);
		// on reset la session pour mettre à jour les données de l'utilisateur
		session_reset();
		// on recupere les données de l'utilisateur mis a jour
		$query = "SELECT * FROM users WHERE id = :id";
		$statement = $pdo->prepare($query);
		$statement->execute([':id' => $id]);
		$user = $statement->fetch(PDO::FETCH_OBJ);
		// on met a jour la session
		$_SESSION['user'] = $user;
		$_SESSION['flash']['success'] = "Votre compte a bien été modifié";
		// on redirige l'utilisateur vers sa page de profil
		header("Location: ../page/profil.php?id=" . $_SESSION['user']->id);
		exit();
	}
}
