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
    if($_GET['id'] == $_SESSION['id']) {
        
    
    // вихід з адмін панелі
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["exit"])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    

?>

<?php
    // 
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["company_name"]) && isset($_POST["user_name"]) && isset($_POST["text"])) {
        $company_name = $_POST["company_name"];
        $user_name = $_POST["user_name"];
        $text = $_POST["text"];
        //запит на запис даних у таблиці
        $stmt = mysqli_prepare($conn, "INSERT INTO reviews (company_name, user_name, text) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $company_name, $user_name, $text); //функція привязує змінні до ключів

        // Виконання запиту
        if (mysqli_stmt_execute($stmt)) {
            echo "Інформація успішно записана в таблицю.";
        } else {
            echo "Помилка при записі інформації: " . mysqli_error($conn);
        }       
    }

    // Перевірка, чи була надіслана форма додавання нового проекту
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["project_name"]) && isset($_POST["company_name"]) && isset($_POST["description"])) {
        // Отримання значень з форми з глобального масиву $_POST
        $project_name = $_POST['project_name'];
        $company_name = $_POST['company_name'];
        $description = $_POST['description'];
            
        // Перетворення вибраних чекбоксів в масив JSON
        $technologies = array();
        if (isset($_POST['technologies'])) {
            $all_technologies = $_POST['technologies'];
            foreach ($all_technologies as $technology_id) {
                $technologies[$technology_id] = 1; // Встановлюємо значення 1 для активних чекбоксів
            }
        }

        // Заповнення неактивних чекбоксів значенням 0
        $sql_checkboxes = 'SELECT id FROM technologies';
        $result_checkboxes = mysqli_query($conn, $sql_checkboxes);
        while ($row_result_checkboxes = mysqli_fetch_assoc($result_checkboxes)) {
            $technology_id = $row_result_checkboxes['id'];
            if (!isset($technologies[$technology_id])) {
                $technologies[$technology_id] = 0; // Встановлюємо значення 0 для неактивних чекбоксів
            }
        }
        ksort($technologies); // Сортуємо масив по ключах
        // запис ключів і значень в новий масив
        $technologies_sort = [];
        foreach ($technologies as $key => $value) {
            $technologies_sort[$key] = $value;
        }
 
        $technologies_json = json_encode($technologies_sort);
            
        // Запис даних у базу даних
        $stmt = mysqli_prepare($conn, "INSERT INTO projects (project_name, company_name, description, technologies) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $project_name, $company_name, $description, $technologies_json); //функція привязує змінні до ключів
        // Виконання запиту
        if (mysqli_stmt_execute($stmt)) {
            echo "Інформація успішно записана в таблицю.";
        } else {
            echo "Помилка при записі інформації: " . mysqli_error($conn);
        }
    }


    
    
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
            <a href="admin.php?id=<?php echo($_SESSION['id']);?>&exit=true" class="modal_btn-1">Вийти з адмін-панелі</a>
        </div>
      <h2 class="block-title">Добавлення проекту</h2>
        <form action="admin.php?id=<?php echo($_SESSION['id']);?>" method="POST">
            <input type="text" name="project_name" class="form-el form-el--theme_dark" placeholder="Назва проекту" required>
            <input type="text" name="company_name" class="form-el form-el--theme_dark" placeholder="Назва компанії" required>
            <input type="text" name="description" class="form-el form-el--theme_dark" placeholder="Опис проекту" required>
            <div class="admin-panel-lang">
                <?php
                //вивід усіх технологій у вигляді чекбоксів
                $sql_checkboxes = 'SELECT * FROM technologies';
                $result_checkboxes = mysqli_query($conn, $sql_checkboxes);
                while($row_result_checkboxes = mysqli_fetch_assoc($result_checkboxes)){
                    echo '<label><input type="checkbox" name="technologies[' .$row_result_checkboxes["id"]. ']" param-kind="'. $row_result_checkboxes["kind_id"] .'" value="' . $row_result_checkboxes["id"] . '"> ' . $row_result_checkboxes["name"] . '</label>';
                }
                ?>
            </div>
            <button type="submit" class="btn btn--theme_gradient">Відправити</button>
        </form>
    </div>
  </div>
  <div class="admin-panel">
    <div class="container container--mw_1200">
      <h2 class="block-title">Добавлення відгуків</h2>
        <form action="admin.php?id=<?php echo($_SESSION['id']);?>" method="POST">
            <input type="text" name="company_name" class="form-el form-el--theme_dark" placeholder="Назва компанії" required>
            <input type="text" name="user_name" class="form-el form-el--theme_dark" placeholder="Ім'я клієнта" required>
            <input type="text" name="text" class="form-el form-el--theme_dark" placeholder="Текст відгуку" required>
            <button type="submit" class="btn btn--theme_gradient">Відправити</button>
        </form>
    </div>
  </div>
  <!-- reviews BEGIN -->
  <section id="reviews" class="reviews">
    <div class="container container--mw_1200 reviews__container">
      <h2 class="block-title text-center">Редагування/видалення відгуків</h2>
      <div class="reviews__list">
        <div class="js-reviews-slider row reviews__row">
        <?php
            // вивід усіх відгуків
            $sql_reviews = 'SELECT * FROM reviews';
            $result_reviews = mysqli_query($conn, $sql_reviews);
            if ($result_reviews) {
                while($row_reviews = mysqli_fetch_assoc($result_reviews)) {
                    echo('<div class="col reviews__col">
                            <div class="reviews__item">
                                <div class="reviews__item-header">
                                    <div class="reviews__item-company">'.$row_reviews["company_name"].'</div>
                                    <div class="heading--size_3 reviews__item-name">'.$row_reviews["user_name"].'</div>
                                    <div class="reviews__item-text">'.$row_reviews["text"].'</div>
                                </div>
                                <div class="reviews__item-footer">
                                    <a href="edit.php?id=' .$_SESSION["id"]. '&reviews_id=' .$row_reviews["id"]. '" class="reviews__item-moore">Редагувати</a>
                                </div>
                                <div class="reviews__item-footer">
                                    <a href="delete.php?id=' .$_SESSION["id"]. '&reviews_id=' .$row_reviews["id"]. '" class="reviews__item-moore">Видалити</a>
                                </div>
                            </div>
                          </div>');
                }
            }
        ?>
        </div>
      </div>
    </div>
  </section>
  <!-- reviews END -->
</div>
<!-- site END -->

</body>
</html>

<?php
}
?>