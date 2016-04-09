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

// Create user table
$sql = "CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_logged` BOOLEAN NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "User table created successfully<br />";
else
    echo "Error creating user table: " . mysqli_error($db) . "<br />";

// Create order table
$sql = "CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product` text NOT NULL,
  `price` FLOAT(10) NOT NULL,
  `total` FLOAT(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Order table created successfully<br />";
else
    echo "Error creating user table: " . mysqli_error($db) . "<br />";

// Category table
$sql = "CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `picture` varchar(1000) NOT NULL,
  `active` BOOLEAN DEFAULT 0,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($db, $sql) === TRUE)
    echo "Product table created successfully<br />";
else
    echo "Error creating product table: " . mysqli_error($db) . "<br />";
?>