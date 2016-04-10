<?php
	session_start();
	include_once("./functions.php");
	if (!isset($_SESSION['user']) || $_SESSION['user']['user_role'] !== "1")
	{
		header("Location: /");
		die();
	}
	if (check($_POST['category_name']) && check($_POST['picture']) &&
		$_POST['envoyer'] === "Envoyer")
	{
		$ret = set_category($_POST['category_name'], $_POST['picture']);
		if ($ret !== FALSE)
			$msg = "Catégorie ajouté avec succès";
		else
			$msg = "Echec de l'ajout de la catégorie";
	}
	if (check($_POST['category_name']) && check($_POST['picture']) &&
		check($_GET['cat_edit']) && $_POST['send_edit'] === "Envoyer")
	{
		$ret = update_category($_POST['category_name'], $_POST['picture'], $_GET['cat_edit']);
		if ($ret !== FALSE)
			$msg = "Utilisateur mis à jour";
		else
			$msg = "Echec de la modification de l'utilisateur";
	}
	if (check($_GET['cat_edit']) && !check($_POST['send_edit']))
	{
		$cat_edit = mysqli_fetch_assoc(get_category_by_id($_GET['cat_edit']));
		$edit_mode = TRUE;
	}
	if (check($_GET['cat_delete']))
	{
		$ret = delete_category($_GET['cat_delete']);
		if ($ret !== FALSE)
			$msg = "Suppression de la catégorie ok";
		else
			$msg = "Echec de la suppression de la catégorie";
	}
	$categories = get_all_category();
?>
<div class="content-header">
	<h1>Catégories</h1>
</div>
<div class="rep_form">
<?php
	echo $msg;
?>
</div>
<div class="widget-box sample-widget">
	<div class="widget-header">
		<h2>Liste des catégories</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<table>
			<thead><th>Nom</th><th>Image</th><th>Edit / Suppr</th></thead>
		<?php
			while ($row = mysqli_fetch_assoc($categories)) {
				echo "<tr><td>" . $row['category_name'] . "</td> <td width='100px'>
				<img width='100px' alt='" . $row['category_name'] . "' src='" . $row['picture'] . "'/></td'>
				<td class=edit><a href=/admin?page=category&cat_edit=".$row['id']." class=button>Editer</a>
				<a href=/admin?page=category&cat_delete=".$row['id']." class=button-red>Supprimer</a></td></tr>";
			}
		?>
		</table>
	</div>
</div>
<div class="widget-box sample-widget">
	<div class="widget-header">
		<h2>Ajouter une catégorie</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_user" action="/admin/?page=category">
			<div>
				Nom:<br>
				<input type="text" name="category_name" value="">
			</div>
			<div>
				Image:<br>
				<input type="text" name="picture" value="">
			</div>
			<input class="button" name="envoyer" type="submit" value="Envoyer">
		</form>
	</div>
</div>
<?php if ($edit_mode) { ?>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Editer une catégorie</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_user" action="/admin/?page=category&cat_edit=<?php echo $cat_edit['id']; ?>" >
			<div class="widget-content">
			<div>
				Nom:<br>
				<input type="text" name="category_name" value="<?php echo $cat_edit['category_name']; ?>">
			</div>
			<div>
				Image:<br>
				<input type="text" name="picture" value="<?php echo $cat_edit['picture']; ?>">
			</div>
			<input class="button" name="send_edit" type="submit" value="Envoyer">
		</form>
	</div>
	</div>
</div>
<?php } ?>