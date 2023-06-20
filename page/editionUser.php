<?php
require_once '../include/database.php';
require_once '../include/function.php';

logged_only();


$id = $_GET['id'];

$query = "SELECT * FROM users WHERE id = :id";
$statement = $pdo->prepare($query);
$statement->execute([':id' => $id]);
$user = $statement->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<title>Edit | User</title>
</head>

<body>
	<?php include 'menu.php'; ?>
	<div class="container-fluid">
		<form method="post" action="../action/editUser.php?id=<?= $user->id ?>">
			<div class="m-3">
				<label for="nom">Votre Nom</label>
				<input type="text" name="nom" value="<?= $user->nom ?>">
			</div>

			<div class="m-3"><label for="mail">Votre email</label>
				<input type="text" name="mail" value="<?= $user->mail ?>">
			</div>

			<div class="m-3"><label for="mp">Votre mot de passe</label>
				<input type="password" name="mp" value="<?= $user->mp ?>">
			</div>
			<?php if (isset($_SESSION['admin'])) : ?>
				<div class="m-3"><label for="role">Votre role</label>
					<input type="number" name="role" value="<?= $user->role ?>">
				</div>
			<?php endif; ?>
			<input type="submit" name="edit" value="éditer">
		</form>
	</div>

</body>

</html>