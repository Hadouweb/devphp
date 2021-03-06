<?php
$servername = "localhost";
$username = "root";
$password = "localhost";
$dbname = "db_rush";

// Create connection
@$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (mysqli_connect_errno())
	die("Failed to connect to MySQL: " . mysqli_connect_error(). "<br />");
else
	echo "MySql connection successfully<br />";

// Delete database
$sql = "DROP DATABASE $dbname";
if(mysqli_query($conn, $sql) === TRUE)
	echo "Database delete successfully<br />";
else
	echo "Error delete database: " . mysqli_error($conn) . "<br />";


// Create database
$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql) === TRUE)
    echo "Database created successfully<br />";
else
    echo "Error creating database: " . mysqli_error($conn) . "<br />";

mysqli_close($conn);
$db = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno())
	die("Failed to connect to MySQL: " . mysqli_connect_error(). "<br />");
else
	echo "MySql connection successfully<br />";
mysqli_set_charset($db,"utf8");

// Create user table
$sql = "CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_role` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "User table created successfully<br />";
else
    echo "Error creating user table: " . mysqli_error($db) . "<br />";

// Create order table
$sql = "CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `user_id` int NOT NULL,
  `valid_order` int DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Order table created successfully<br />";
else
    echo "Error creating order table: " . mysqli_error($db) . "<br />";

// Category table
$sql = "CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `active` BOOLEAN DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Category table created successfully<br />";
else
    echo "Error creating category table: " . mysqli_error($db) . "<br />";

// Product table
$sql = "CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_desc` text NOT NULL,
  `stock` int DEFAULT 10,
  `price` FLOAT(10) NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `category_id` varchar(1000) NOT NULL,
  `date_added` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Product table created successfully<br />";
else
    echo "Error inserting product table: " . mysqli_error($db) . "<br />";

// _______________________________ INSERT ___________________________________

// Insert Super user
$mdp = hash("whirlpool", "mdp");
$sql = "INSERT INTO `user` (`user_role`, `username`, `password`) VALUES 
('1', 'Nicolas', '$mdp'),
('1', 'Samuel', '$mdp')";
if (mysqli_query($db, $sql) === TRUE)
    echo "Super user inserted successfully<br />";
else
    echo "Error creating Super user: " . mysqli_error($db) . "<br />";

// Insert Order 
$sql = "INSERT INTO `order` (`id`, `product_id`, `quantity`, `user_id`) VALUES 
(NULL, '1', '10', '1'),
(NULL, '1', '10', '2');";
if (mysqli_query($db, $sql) === TRUE)
    echo "Order inserted successfully<br />";
else
    echo "Error creating order: " . mysqli_error($db) . "<br />";

// Insert Category
$sql = "INSERT INTO `category` (`category_name`, `picture`) VALUES
('PS4', 'http://img0.gtsstatic.com/wallpapers/a486c15eddabebf5d74c86e3b569a50b_large.png'),
('Xbox One', 'http://images.playerone.tv/source/jeux/xbox_720_xbox_infinity/xbox_720_xbox_infinity-xbox-one-logo-wallpaper-hd-2013-54c79845bbacf.jpeg'),
('Wii U', 'http://www.nintendoactu.com/wp-content/uploads/2015/11/WiiU.jpg'),
('PC', 'https://i.ytimg.com/vi/wKoHS2aKSUI/maxresdefault.jpg')";
if (mysqli_query($db, $sql) === TRUE)
    echo "Categories inserted successfully<br />";
else
    echo "Error inserting categories: " . mysqli_error($db) . "<br />";

// Insert Product
$sql = "INSERT INTO `product` (`product_name`, `product_desc`, `stock`, `price`, `picture`, `category_id`, `date_added`) VALUES
('UNCHARTED THE NATHAN DRAKE COLLECTION', 'Les trois premiers épisodes de la saga Uncharted sont là dans une version remasterisée en 1080p / 60 fps.', '10', '39.99', 'http://www.gamer-network.fr/wp-content/uploads/2015/08/Uncharted-The-Nathan-Drake-Collection-trois-modes-de-jeu-Image-2.png', '1', '2016-04-09'),
('STAR WARS BATTLEFRONT', 'La force est avec DICE', '10', '49.99', 'https://media.starwars.ea.com/content/starwars-ea-com/fr_FR/starwars/battlefront/_jcr_content/ogimage.img.jpeg', '1,2', '2016-04-09'),
('DARK SOUL III', 'Plongez dans les ténèbres avec des éditions de haute volée pour DARK SOULS III !', '50', '54.99', 'http://www.gamer-network.fr/wp-content/uploads/2015/10/Dark_souls_III.png', '1,2,4', '2016-04-10'),
('SUPER MARIO MAKER', '', '3', '44.99', 'http://cdn03.nintendo-europe.com/media/images/10_share_images/games_15/wiiu_14/SI_WiiU_SuperMarioMaker_v01.jpg', '3', '2016-04-10'),
('XENOBLADE CHONICLES X','Découvrez les secrets de votre nouvelle planète et battez-vous pour l avenir de l humanité dans Xenoblade Chronicles X, en exclusivité sur Wii U', '20', '44.99', 'http://game-focus.com/images/screenshots/X/xenoblade-chronicles-x/Xeno1.png', '3', '2016-04-10'),
('XCOM2', 'XCOM 2 est la suite de XCOM: Enemy Unknown, le jeu de stratégie à succès.', '4', '34.99', 'http://www.journaldugamer.com/files/2016/01/xcom2.jpg', '4', '2016-04-10')";
if (mysqli_query($db, $sql) === TRUE)
    echo "Products inserted successfully<br />";
else
    echo "Error inserting products: " . mysqli_error($db) . "<br />";

mysqli_close($db);
?>