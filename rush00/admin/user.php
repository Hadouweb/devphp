<?php
	include_once("../functions.php");

	function get_role($num)
	{
		if ($num === "1")
			return ("Admin");
		else
			return ("Client");
	}
	if (isset($_POST['role']) && isset($_POST['username']) &&
		isset($_POST['password']) && $_POST['envoyer'] === "Envoyer")
	{
		$ret = set_user($_POST['role'], $_POST['username'], hash("whirlpool", $_POST['password']));
		if ($ret !== FALSE)
			$msg = "Utilisateur ajouté avec succès";
		else
			$msg = "Echec de l'ajout de l'utilisateur";
	}
	if (isset($_POST['role']) && isset($_POST['username']) &&
		isset($_POST['password']) && isset($_GET['user_edit']) && $_POST['send_edit'] === "Envoyer")
	{
		if ($_POST['password'] === "")
		{
			$user = mysqli_fetch_assoc(get_user_by_id($_GET['user_edit']));
			$password = $user['password'];
		}
		else
			$password = hash("whirlpool", $_POST['password']);
		$ret = update_user($_POST['role'], $_POST['username'], $password, $_GET['user_edit']);
		if ($ret !== FALSE)
			$msg = "Utilisateur mis à jour";
		else
			$msg = "Echec de la modification de l'utilisateur";
	}
	if (isset($_GET['user_edit']) && !isset($_POST['send_edit']))
	{
		$user_edit = mysqli_fetch_assoc(get_user_by_id($_GET['user_edit']));
		$edit_mode = TRUE;
	}
	if (isset($_GET['user_delete']))
	{
		//If user is admin
		$ret = delete_user($_GET['user_delete']);
		if ($ret !== FALSE)
			$msg = "Suppression de l'utilisateur ok";
		else
			$msg = "Echec de la suppression de l'utilisateur";
	}
	$users = get_all_user();
?>
<div class="content-header">
	<h1>Utilisateurs</h1>
</div>
<div class="rep_form">
<?php
	echo $msg;
?>
</div>
<div class="widget-box sample-widget">
	<div class="widget-header">
		<h2>Liste des utilisateurs</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<table>
			<thead><th>Role</th><th>Pseudo</th><th>Edit / Suppr</th></thead>
		<?php
			while ($row = mysqli_fetch_assoc($users)) {
				echo "<tr><td>" . get_role($row['user_role']) . "</td> <td><b>" . $row['username'] . "</b></td>
				<td class=edit><a href=/admin?page=user&user_edit=".$row['id']." class=button>Editer</a>
				<a href=/admin?page=user&user_delete=".$row['id']." class=button-red>Supprimer</a></td></tr>";
			}
		?>
		</table>
	</div>
</div>
<div class="widget-box sample-widget">
	<div class="widget-header">
		<h2>Ajouter un utilisateur</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_user" action="/admin/?page=user">
			<div>
				Role:<br>
				<select name="role">
					<option value="1">Admin</option>
					<option value="2">Client</option>
				</select>
			</div>
			<div>
				Pseudo:<br>
				<input type="text" name="username" value="">
			</div>
			<div>
				Mot de passe:<br>
				<input type="password" name="password" value="">
			</div>
			<input class="button" name="envoyer" type="submit" value="Envoyer">
		</form>
	</div>
</div>
<?php if ($edit_mode) { ?>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Editer un utilisateur</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_user" action="/admin/?page=user&user_edit=<?php echo $user_edit['id']; ?>" >
			<div>
				Role:<br>
				<select name="role">
					<option value="1">Admin</option>
					<option value="2">Client</option>
				</select>
			</div>
			<div>
				Pseudo:<br>
				<input type="text" name="username" value="<?php echo $user_edit['username']; ?>">
			</div>
			<div>
				Mot de passe:<br>
				<input type="password" name="password" value="">
			</div>
			<input class="button" name="send_edit" type="submit" value="Envoyer">
		</form>
	</div>
</div>
<?php } ?>