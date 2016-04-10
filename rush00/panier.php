<?php
	//header("Location: index.php");
	include_once("./admin/functions.php");
	$total = 0;
	if ($_SESSION["user"] && ($ret = get_order_by_user_id($_SESSION["user"]["id"])) !== FALSE)
	{
		while ($row = mysqli_fetch_assoc($ret))
		{
			if ($row['valid_order'] !== 1)
			{
				if (($art = get_product_by_id($row["product_id"])) !== FALSE)
				{
					while ($res = mysqli_fetch_assoc($art))
					{
						$total += floatval($res['price']);
					?>
					<div class="product-panier">
						<div class="content">
							<span class="titre"><?php echo $res['product_name']; ?></span><br/>
							<span class="quantity">Quantité : <?php echo $row['quantity']; ?></span>
							<span class="price">Prix : <?php echo $res['price']; ?></span>
							<span class="suppr"><a href="?del_order=<?php echo $row['id']; ?>">Supprimer</a></span>
						</div>
						<img alt="<?php echo ft_format($res['product_name']); ?>" 
						src="<?php echo $res['picture']; ?>">
					</div>
					<?php
					}
				}
			}
		}
		echo "<a class='button' href='?valid_order=1'>Valider le panier</a>";
	}
	else
	{
		$ret = get_order_by_user_id($_SESSION['tmp_user']['id']);
		while ($row = mysqli_fetch_assoc($ret))
		{
			if (($art = get_product_by_id($row["product_id"])) !== FALSE)
			{
				while ($res = mysqli_fetch_assoc($art))
				{
					$total += floatval($res['price']);
					//debug($res);
				?>
				<div class="product-panier">
					<div class="content">
						<span class="titre"><?php echo $res['product_name']; ?></span><br/>
						<span class="quantity">Quantité : <?php echo $row['quantity']; ?></span>
						<span class="price">Prix : <?php echo $res['price']; ?></span>
						<span class="suppr"><a href="?del_order=<?php echo $row['id']; ?>">Supprimer</a></span>
					</div>
					<img alt="<?php echo ft_format($res['product_name']); ?>" 
					src="<?php echo $res['picture']; ?>">
				</div>
				<?php
				}
			}
		}
	}
	echo "<div>TOTAL : $total</div>";
?>