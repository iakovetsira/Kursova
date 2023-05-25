<!DOCTYPE html>
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
?>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, user-scalable=0">
<title>WEBPro - Розробка ПЗ</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/media.css" type="text/css" rel="stylesheet">
<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>

<!-- site BEGIN -->
<div id="site">
  <div class="admin-panel">
    <div class="container container--mw_1200">
        <div class="admin-panel__nav">
            <a href="admin.php?id=<?php echo($_SESSION['id']);?>" class="modal_btn-1">Повернутись назад</a>
        </div>
      <h2 class="block-title">Редагування</h2>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST") {
            // отримання даних з форми
            $reviews_id = $_GET["reviews_id"]; // дійстаємо id відгуку з глобального масиву $_GET
            $new_company_name = $_POST["company_name"]; // дістаємо редаговані дані з глоабльного масиву $_POST
            $new_user_name = $_POST["user_name"]; // дістаємо редаговані дані з глоабльного масиву $_POST
            $new_text = $_POST["text"]; // дістаємо редаговані дані з глоабльного масиву $_POST
            $sql = "UPDATE `reviews` SET `company_name`='" . $new_company_name . "', `user_name`='" .$new_user_name. "', `text`='" .$new_text. "' WHERE `id`='" . $reviews_id . "'"; // запит на оновлення послуги в таблиці
            $result = mysqli_query($conn, $sql);
            if (mysqli_query($conn, $sql)) {
              header("Location: admin.php?id=" . $_SESSION['id']); // Перехід на сторінку admin.php
            } else {
              echo "Помилка оновлення: " . mysqli_error($conn);
            }
            
          }
          // вибір відгуку який будемо редагувати
          $revies_id = $_GET["reviews_id"]; // дійстаємо id відгуку з глобального масиву $_GET
          $sql = "SELECT * FROM `reviews` WHERE `id`='" . $revies_id . "'"; 
          $result = mysqli_query($conn, $sql); // виконуємо запит
          while($result_array = mysqli_fetch_assoc($result)) { //вивід форми з даними які будемо редагувати
            echo('</div>
              <form action="edit.php?id=' .$_SESSION['id']. '&reviews_id=' .$_GET["reviews_id"]. '" method="POST">
                <input type="text" class="form-el form-el--theme_dark" name="company_name" value="' .$result_array["company_name"]. '" required>
                <input type="text" class="form-el form-el--theme_dark" name="user_name" value="' .$result_array["user_name"]. '" required>
                <input type="text" class="form-el form-el--theme_dark" name="text" value="' .$result_array["text"]. '" required>
                <button type="submit" class="btn btn--theme_gradient">Відправити</button>
              </form>
            </div>');
            }
            

        ?>
      
    </div>
  </div>
</div>
<!-- site END -->

</body>
</html>

<?php
}
?>