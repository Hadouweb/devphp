<?php
	include_once("./admin/functions.php");
	$data_categories = get_all_category();
	while ($row = mysqli_fetch_assoc($data_categories)) {
		$categories[] = $row;
	}
?>
<section id="sidebar"> 
	<div id="sidebar-nav">   
		<ul>
			<li><a href="/">Accueil</a></li>
			<?php foreach ($categories as $row)
			{
				echo "<li>";
				echo"<a href='?page=".$row['id']."'>".$row['category_name']."</a>";
				echo "</li>";
			}
			?>
		</ul>
	</div>
</section>