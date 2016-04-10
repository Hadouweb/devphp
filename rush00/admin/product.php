<?php
	session_start();
	include_once("./functions.php");
	if (!isset($_SESSION['user']) || $_SESSION['user']['user_role'] !== "1")
	{
		header("Location: /");
		die();
	}
	$products = get_all_product();
?>
<div class="content-header">
	<h1>Produits</h1>
</div>
<div class="widget-box full-widget">
	<div class="widget-header">
		<h2>Liste des produits</h2>
		<i class="fa fa-cog"></i>
	</div>
	<div class="widget-content">
		<table>
			<thead><th>Nom</th><th>Déscription</th><th>Stock</th><th>Prix</th><th>Image</th><th>Catégorie</th><th>Date d'ajout</th><th>Edit / Suppr</th></thead>
		<?php
			while ($row = mysqli_fetch_assoc($products)) {
				echo "<tr>
				<td>" . $row['product_name'] . "</td> 
				<td>" . $row['product_desc'] . "</td>
				<td>" . $row['stock'] . "</td>
				<td>" . $row['price'] . "</td>
				<td><img alt=" . $row['product_name'] . " src=" . $row['picture'] . "/></td>
				<td>" . $row['category_id'] . "</td>
				<td>" . $row['date_added'] . "</td>
				<td class=edit><a href=/admin?page=product&user_edit=".$row['id']." class=button>Editer</a>
				<a href=/admin?page=product&user_delete=".$row['id']." class=button-red>Supprimer</a></td>
				</tr>";
			}
		?>
		</table>
	</div>
</div>