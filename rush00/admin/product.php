<?php
	session_start();
	include_once("./functions.php");
	if (!isset($_SESSION['user']) || $_SESSION['user']['user_role'] !== "1")
	{
		header("Location: /");
		die();
	}

	if (check($_POST['product_name']) && check($_POST['stock']) &&
		check($_POST['price']) && check($_POST['category_id']) &&
		check($_POST['product_desc']) && check($_POST['picture']) &&
		$_POST['envoyer'] === "Envoyer")
	{
		$ret = set_product($_POST['product_name'], 
			$_POST['product_desc'], 
			intval($_POST['stock']), 
			floatval($_POST['price']), 
			$_POST['picture'], 
			intval($_POST['category_id']));
		if ($ret !== FALSE)
			$msg = "Produit ajouté avec succès";
		else
			$msg = "Echec de l'ajout du produit";
	}
	if (isset($_GET['product_delete']))
	{
		//If user is admin
		$ret = delete_product($_GET['product_delete']);
		if ($ret !== FALSE)
			$msg = "Suppression du produit ok";
		else
			$msg = "Echec de la suppression du produit";
	}
	if (check($_POST['product_name']) && check($_POST['stock']) &&
		check($_POST['price']) && check($_POST['category_id']) &&
		check($_POST['product_desc']) && check($_POST['picture']) &&
		check($_GET['product_edit']) && $_POST['send_edit'] === "Envoyer")
	{
		$ret = update_product($_POST['product_name'], 
			$_POST['product_desc'], 
			intval($_POST['stock']), 
			floatval($_POST['price']), 
			$_POST['picture'], 
			intval($_POST['category_id']),
			$_GET['product_edit']);
		if ($ret !== FALSE)
			$msg = "Produit mis à jour";
		else
			$msg = "chec de la modification du produit";
	}
	if (isset($_GET['product_edit']) && !isset($_POST['send_edit']))
	{
		$product_edit = mysqli_fetch_assoc(get_product_by_id($_GET['product_edit']));
		$edit_mode = TRUE;
	}
	$products = get_all_product_category_name();
	$data_categories = get_all_category();
	while ($row = mysqli_fetch_assoc($data_categories)) {
		$categories[] = $row;
	}
?>
<div class="content-header">
	<h1>Produits</h1>
</div>
<div class="rep_form">
<?php
	echo $msg;
?>
</div>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Ajouter un produit</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_product" action="/admin/?page=product">
			<div class="col1-4">
				Nom:<br>
				<input required="required" type="text" name="product_name" value="">
			</div>
			<div class="col1-4">
				Stock:<br>
				<input required="required" type="text" name="stock" value="">
			</div>
			<div class="col1-4">
				Prix:<br>
				<input required="required" type="text" name="price" value="">
			</div>
			<div class="col1-4">
				Catégorie:<br>
				<select required="required" name="category_id">
					<?php foreach ($categories as $row) {
						echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
					} ?>
				</select>
			</div>
			<div class="col1-2">
				Déscription:<br>
				<textarea required="required" type="text" name="product_desc" value=""></textarea>
			</div>
			<div class="col1-2">
				Image (url):<br>
				<input required="required" type="text" name="picture" value="">
			</div>
			<input class="button" name="envoyer" type="submit" value="Envoyer">
		</form>
	</div>
</div>
<?php if ($edit_mode) { ?>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Editer un produit</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<form method="POST" id="add_product" action="/admin/?page=product&product_edit=<?php echo $product_edit['id']; ?>">
			<div class="col1-4">
				Nom:<br>
				<input required="required" type="text" name="product_name" value="<?php echo $product_edit['product_name']; ?>">
			</div>
			<div class="col1-4">
				Stock:<br>
				<input required="required" type="text" name="stock" value="<?php echo $product_edit['stock']; ?>">
			</div>
			<div class="col1-4">
				Prix:<br>
				<input required="required" type="text" name="price" value="<?php echo $product_edit['price']; ?>">
			</div>
			<div class="col1-4">
				Catégorie:<br>
				<select required="required" name="category_id">
					<?php foreach ($categories as $row) {
						echo "<option ";
						if ($product_edit['category_id'] == $row['id']) 
							echo "selected='selected'";
						echo "value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
					} ?>
				</select>
			</div>
			<div class="col1-2">
				Déscription:<br>
				<textarea required="required" type="text" name="product_desc"><?php echo $product_edit['product_desc']; ?></textarea>
			</div>
			<div class="col1-2">
				Image (url):<br>
				<input required="required" type="text" name="picture" value="<?php echo $product_edit['picture']; ?>">
			</div>
			<input class="button" name="send_edit" type="submit" value="Envoyer">
		</form>
	</div>
</div>
<?php } ?>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Liste des produits</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<table id="product-table">
			<thead><th>Image</th><th>Nom</th><th>Déscription</th><th>Stock</th><th>Prix</th><th>Catégorie</th><th>Date d'ajout</th><th>Edit / Suppr</th></thead>
		<?php
			while ($row = mysqli_fetch_assoc($products)) {
				echo "<tr>
				<td width=50px><img alt='" . $row['product_name'] . "' src='" . $row['picture'] . "'/></td>
				<td>" . $row['product_name'] . "</td> 
				<td>" . $row['product_desc'] . "</td>
				<td>" . $row['stock'] . "</td>
				<td>" . $row['price'] . "</td>
				<td>" . $row['category_name'] . "</td>
				<td width='180px'>" . $row['date_added'] . "</td>
				<td class=edit><a href=/admin?page=product&product_edit=".$row['id']." class=button>Editer</a>
				<a href=/admin?page=product&product_delete=".$row['id']." class=button-red>Supprimer</a></td>
				</tr>";
			}
		?>
		</table>
	</div>
</div>