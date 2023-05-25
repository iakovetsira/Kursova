<?php
	session_start();
	$servername = '127.0.0.1:3306'; // Ім'я сервера бази даних
	$username = 'root'; // Логін користувача бази даних
	$password = ''; // Пароль користувача бази даних
	$dbname = 'webpro'; // Назва бази даних, до якої ви хочете підключитися
	// Підключення до бази даних
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Перевірка підключення
	if (!$conn) {
	  die('Connection failed: ' . mysqli_connect_error());
	}
	// Відображення сторінки якщо id адміністратора дорвінює id користувача
	if(isset($_GET['id']) && isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']) {
		$sql = "DELETE FROM `reviews` WHERE id='" . $_GET['reviews_id'] . "'"; // запит на видалення послуги з таблиці
		$result = mysqli_query($conn, $sql);
		if($result) {
			header("Location: admin.php?id=" . $_SESSION['id']);
		}
	}
?>