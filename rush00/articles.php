<?php
include_once("./admin/functions.php");

if (check($_GET['page']))
{
	$id_category = $_GET['page'];
	$data_products = get_all_product();
	while ($row = mysqli_fetch_assoc($data_products)) {
		$ids = explode(',', $row['category_id']);
		foreach($ids as $id)
		{
			if ($id_category === $id)
				$products[] = $row;
		}
	}
	$category = mysqli_fetch_assoc(get_category_by_id($_GET['page']));
	if (check($category))
	{
		?>
		<div class="image_category">
		<img alt="<?php echo ft_format($category['category_name']); ?>" 
		src="<?php echo $category['picture']; ?>">
		</div>
		<?php
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
		$url = http_build_query(array_merge($_GET, array('order' => $row['id'])));
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
				<a class="button" href='?<?php echo $url; ?>' >Commander</a>
			</div>
		</div>
	</div>
<?php }

}
else
	echo "<p>Aucun produit dans cette catégorie</p>"; ?>