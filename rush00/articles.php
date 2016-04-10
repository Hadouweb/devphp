<?php
include_once("./admin/functions.php");

if (check($_GET['page']))
{
	$id_category = $_GET['page'];
	$data_products = get_product_by_category($id_category);
	while ($row = mysqli_fetch_assoc($data_products)) {
		$products[] = $row;
	}
}
else
{
	$data_products = get_all_product();
	while ($row = mysqli_fetch_assoc($data_products)) {
		$products[] = $row;
	}
}

if (check($products))
{
	foreach($products as $row) {
	?>
	<div class="product">
		<h4><?php echo $row['product_name']; ?></h4>
		<div class='thumbnail'>
			<img alt="<?php echo ft_format($row['product_name']); ?>" 
			src="<?php echo $row['picture']; ?>"/>
		</div>
		<div class="content-product">
			<div class='description'>
				<p class="desc">Déscription:</p>
				<p><?php echo $row['product_desc']; ?></p>
			</div>
			<span class="stock">Stock: <?php echo ft_format($row['stock']); ?></span>
			<hr/>
			<div class="info-product">
				<span class="price">Prix: <?php echo ft_format($row['price']); ?> €</span><br />
			</div>
			<div class="info-product">
				<a class="button" href='#' >Commander</a>
			</div>
		</div>
	</div>
<?php }

}
else
	echo "<p>Aucun produit dans cette catégorie</p>"; ?>