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
mysqli_set_charset($db,"utf8");

// Create user table
$sql = "CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_logged` BOOLEAN NOT NULL,
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
  `order_detail_id` int NOT NULL,
  `total` FLOAT(10) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Order table created successfully<br />";
else
    echo "Error creating order table: " . mysqli_error($db) . "<br />";

// Create order detail table
$sql = "CREATE TABLE `order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` text NOT NULL,
  `quantity` text NOT NULL,
  `price` FLOAT(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Order table created successfully<br />";
else
    echo "Error creating order detail table: " . mysqli_error($db) . "<br />";

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
  `category_id` int DEFAULT 0,
  `date_added` DATE NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Product table created successfully<br />";
else
    echo "Error inserting product table: " . mysqli_error($db) . "<br />";

// _______________________________ INSERT ___________________________________

// Insert Super user Nicolas
$sql = "INSERT INTO `user` (`user_type`, `username`, `password`, `is_logged`) VALUES 
('1', 'Nicolas', 'mdp', 0),
('1', 'Samuel', 'mdp', 0)";
if (mysqli_query($db, $sql) === TRUE)
    echo "Super user inserted successfully<br />";
else
    echo "Error creating Super user: " . mysqli_error($db) . "<br />";

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
('STAR WARS BATTLEFRONT', 'La force est avec DICE', '10', '49.99', 'https://media.starwars.ea.com/content/starwars-ea-com/fr_FR/starwars/battlefront/_jcr_content/ogimage.img.jpeg', '1', '2016-04-09'),
('WORLD OF WARCRAFT : WARLORDS OF DRAENOR', 'On l\'avait prévenu, Thrall : Garrosh, fallait pas l\'inviter !', '10', '9.99', 'http://media.blizzard.com/wow/warlords-of-draenor-6y1fz/media/wallpapers/warlords-of-draenor-1680x1050.jpg', '4', '2016-04-09')";
if (mysqli_query($db, $sql) === TRUE)
    echo "Products inserted successfully<br />";
else
    echo "Error inserting products: " . mysqli_error($db) . "<br />";


?>