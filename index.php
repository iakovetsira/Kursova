<!DOCTYPE html>
<?php
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
  // вхід адміністратора у систему
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT `id`, `user_name`, `password` FROM `users` WHERE `user_name`='" .$username . "'";
    $result = mysqli_query($conn, $sql);
    while($result_array = mysqli_fetch_assoc($result)) {
      // перевірка паролю
      if ($result_array["password"] == $password){
        // запуск сесії
        session_start();
        // збереження інформації про користувача у сесії
        $_SESSION["id"] = $result_array["id"];
        // перенаправлення на сторінку адміністратора
        header("Location: admin.php?id=" . $result_array["id"]);
      }
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

<div id="modal-login" class="modal">
  <form action="index.php" method="post" class="modal__form" name="login-form">
    <div class="heading heading--size_3 modal__form-title">Введіть<br>логін і пароль</div>
    <input type="text" name="username" class="form-el form-el--theme_dark input modal__form-input" required placeholder="Введіть логін">
    <input type="password" name="password" class="form-el form-el--theme_dark input modal__form-input" required placeholder="Введіть пароль">
    <button type="submit" class="btn btn--theme_gradient modal__form-btn">Увійти</button>
  </form>
</div>
<!-- site BEGIN -->
<div id="site">
  <!-- header BEGIN -->
  <header class="header header--fixed">
    <div class="container container--mw_full header__container">
      <div class="header__col header__col--1">
        <a href="#intro" class="js-to-scroll logo header__logo">
          <span class="logo__text">WebPro</span>
        </a>
      </div>
      <div class="header__col header__col--2">
        <nav class="nav header__nav">
          <ul class="nav__list">
            <li class="nav__item">
              <a href="#technologies" class="nav__link">Технології</a>
            </li>
            <li class="nav__item">
              <a href="#steps" class="nav__link">Як ми працюємо</a>
            </li>
            <li class="nav__item">
              <a href="#portfolio" class="nav__link">Кейси</a>
            </li>
            <li class="nav__item">
              <a href="#reviews" class="nav__link">Відгуки</a>
            </li>
            <li class="nav__item">
              <a href="#contacts" class="nav__link">Контакти</a>
            </li>
            <li class="nav__item">
              <a href="#modal-login" class="nav__link">Вхід</a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="header__col header__col--1 header__right">
        <a href="tel:+380686563458" class="header__tell">+38 068 65 63 458</a>
        <a href="tel:+380686563458" class="header__btn-mobile header__tell-mobile"></a>
        <button class="header__btn-mobile header__toggle">
          <span class="header__toggle-line"></span>
          <span class="header__toggle-line"></span>
          <span class="header__toggle-line"></span>
        </button>
      </div>
    </div>
    <div class="header__drop">
      <div class="header__drop-inner">
        <div class="header__drop-header"></div>
        <div class="header__drop-footer">
          <ul class="header__drop-list">
            <li class="header__drop-item"><a href="mailto:web@pro.ua">web@pro.ua</a></li>
            <li class="header__drop-item"><a href="tel:+380686563458"><strong>+380686563458</strong></a></li>
            <li class="header__drop-item">м. Львів, вул. Б.Хмельницького 25.</li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <!-- header END -->
  <!-- intro BEGIN -->
  <section id="intro" class="intro">
    <div class="container container--mw_1200 intro__container">
      <div class="intro__content">
        <p class="intro__description">Розробка програмного забезпечення</p>
        <h1 class="heading heading--size_2 intro__title">Розробка програмного забезпечення та автоматизація ваших бізнес процесів</h1>
        <h2 class="heading heading--size_5 intro__subtitle">Від бізнес-аналізу та дизайну до тестування та підтримки</h2>
      </div>
      <div class="intro__hero">
        <img src="images/intro-light.jpg" alt="" class="intro__hero-light">
        <img src="images/intro-laptop.png" alt="" class="layer intro__hero-laptop">
        <img src="images/intro-fireflies.png" alt="" class="layer intro__hero-fireflies">
      </div>
    </div>
  </section>

  <!-- intro END -->
  <!-- technologies BEGIN -->
  <section id="technologies" class="technologies">
    <div class="container container--mw_1200 technologies__container">
  <div class="technologies__description">Розробка передбачає створення програмного продукту, що вирішує будь-яку задачу замовника. Розроблене ПЗ може бути інтегроване в уже існуючі ваші системи, а функціональність продукту враховує унікальність бізнес-процесів.</div>
  <h2 class="section-title technologies__title"><strong>Технології,</strong> які<br>ми використовуємо</h2>
  <div class="technologies__list">
    <?php // Виконання запиту на підрахунок унікальних значень
      $sql = 'SELECT COUNT(DISTINCT id) FROM technologies_kind';
      $result = mysqli_query($conn, $sql);
      $count_of_kind = 0; 
      // Обробка результату запиту
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
          $count_of_kind = $row['COUNT(DISTINCT id)']; // кількість унікальних видів послуг
          }
      }else {
          echo "Результатів не знайдено";
      }
      for($i=1;$i<=$count_of_kind;$i++){
        // subquery вибір послуг
        $sql = 'SELECT (SELECT technologies_kind_name FROM technologies_kind WHERE id = technologies.kind_id) AS technologies_kind_name, technologies.* FROM technologies WHERE kind_id = ' .$i;
        $result = mysqli_query($conn, $sql);
        // вивід заголовку виду послуг
        echo('<div class="technologies__item">');
          if ($row = mysqli_fetch_assoc($result)) {
          echo ('<div class="technologies__item-text">' .$row["technologies_kind_name"]. '</div>');
          }
        echo('<div class="technologies__item-language">');
        mysqli_data_seek($result, 0);
        while($row = mysqli_fetch_assoc($result)) {
          echo('<div class="technologies__item-picture">
              <img src="images/'.$row["img_name"].'-logo.png" alt="java" class="technologies__item-icon">
              </div>');
        }
        echo('</div></div>');
      }
      echo('</div>');
    ?>
      </div>
    </div>
  </section>
  <!-- technologies END -->
  <!-- about BEGIN -->
  <section class="about">
    <div class="container container--mw_1200 about__container">
      <div class="row about__row">
        <div class="col about__col about__col--6">
          <div class="about__content">
            <div class="about__content-header">
        <h2 class="section-title about__title"><strong>Про нас</strong></h2>
        <p class="about__content-paragraph">WebPro - провідна компанія у розробці програмного забезпечення. Ми створюємо інноваційні рішення для різних галузей. Наша команда професіоналів розробляє високоякісні продукти, задовольняючи найвимогливіших клієнтів. Ми спеціалізуємося на веб- та мобільних додатках, управлінні проектами та електронній комерції. Наш підхід індивідуальний, ми працюємо з клієнтами, щоб розуміти їхні бізнес-цілі.</p>
        <p class="about__content-paragraph">Ми також надаємо повний цикл підтримки і обслуговування, забезпечуючи надійну технічну підтримку та оновлення.</p>
      </div>
          </div>
        </div>
        <div class="col about__col about__col--5">
      <div class="about__list">
      <div class="about__item">
        <div class="heading--size_2 about__item-count">10 491 267</div>
        <div class="about__item-text">рядків коду написано</div>
      </div>
      <div class="about__item">
        <div class="heading--size_2 about__item-count">420</div>
        <div class="about__item-text">завершених проектів</div>
      </div>
      <div class="about__item">
        <div class="heading--size_2 about__item-count">480</div>
        <div class="about__item-text">годин заощаджено</div>
      </div>
      <div class="about__item">
        <div class="heading--size_2 about__item-count">18</div>
        <div class="about__item-text">серверів підтримується</div>
      </div>
      </div>
    </div>
      </div>
    </div>
  </section>
  <!-- about END -->
  <!-- steps BEGIN -->
  <section id="steps" class="steps">
    <div class="container container--mw_1200 steps__container">
      <h2 class="section-title steps__title"><strong>Як</strong> ми працюємо</h2>
      <div class="steps__list">
  <div class="steps__item">
    <img src="images/steps-1.svg" alt="steps 1" class="steps__item-icon">
    <div class="steps__item-content">
      <div class="steps__item-header">
        <h3 class="heading heading--size_3 steps__item-title">Збір вимог<br>та оцінка проекту</h3>
        <div class="steps__item-counter"></div>
      </div>
      <div class="steps__item-text">Аналіз ідеї, уточнення функціональних вимог, формування плану робіт, попередня оцінка проекту та підготовка комерційної пропозиції</div>
    </div>
  </div>
  <div class="steps__item">
    <img src="images/steps-2.svg" alt="steps 2" class="steps__item-icon">
    <div class="steps__item-content">
      <div class="steps__item-header">
        <h3 class="heading heading--size_3 steps__item-title">Розробка бізнес-логіки<br>та технічного завдання</h3>
        <div class="steps__item-counter"></div>
      </div>
      <div class="steps__item-text">Уточнення бізнес-логіки та погодження функціоналу. Проектування та створення технічної документації. Підготовка прототипу продукту для схвалення концепції замовником</div>
    </div>
  </div>
  <div class="steps__item">
    <img src="images/steps-3.svg" alt="steps 3" class="steps__item-icon">
    <div class="steps__item-content">
      <div class="steps__item-header">
        <h3 class="heading heading--size_3 steps__item-title">Розробка проекту</h3>
        <div class="steps__item-counter"></div>
      </div>
      <div class="steps__item-text">Формування команди, підготовка середовища розробки, програмування продукту на основі узгодженого технічного завдання. Тестування ПЗ</div>
    </div>
  </div>
  <div class="steps__item">
    <img src="images/steps-4.svg" alt="steps 4" class="steps__item-icon">
    <div class="steps__item-content">
      <div class="steps__item-header">
        <h3 class="heading heading--size_3 steps__item-title">Впровадження та супровід</h3>
        <div class="steps__item-counter"></div>
            </div>
            <div class="steps__item-text">Роботи з впровадження розробленого рішення. Передача прав та документації, гарантійне обслуговування та супровід. Консультації щодо подальшого розвитку продукту</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- steps END -->
  <!-- portfolio BEGIN -->
  <section id="portfolio" class="portfolio">
    <div class="js-portfolio-slider portfolio__slider">
    <?php
      //вивід усіх проектів у слайдері на головній сторінці
      $sql_portfolio = 'SELECT * FROM projects';
      $result_portfolio = mysqli_query($conn, $sql_portfolio);
      if ($result_portfolio) {
        while($row_portfolio = mysqli_fetch_assoc($result_portfolio)) {
          echo('<div class="portfolio__item">
              <div class="portfolio__item-bg" style="background-image: url(images/portfolio-bg-1.jpg);"></div>
              <div class="portfolio__item-bg" style="background-image: url(images/portfolio-bg-1.jpg);"></div>
              <div class="container container--mw_1200 portfolio__container">
                <div class="portfolio__item-inner">
                  <div class="portfolio__item-content">
                  <h3 class="portfolio__item-title">'.$row_portfolio["project_name"].'</h3>
                  <div class="portfolio__item-company">'.$row_portfolio["company_name"].'</div>
                  <div class="portfolio__item-text">
                    '.$row_portfolio["description"].'
                  </div>');
                  $items_array = json_decode($row_portfolio["technologies"], true); //декодуємо json у массив даних
                  $count_item = count($items_array);
                  $query_array = [];
                  for ($i=0;$i<=$count_item - 1;$i++) {
                    if($items_array[$i] == 1){
                      $query_array[$i] = $i; //записуємо усі id які потрібно вибрати з таблиці
                    }
                  }
                  $sql_query_string = "SELECT * FROM technologies WHERE id IN (" . implode(",", $query_array) . ")"; //формуємо запит до табилці
                  $result_query_string = mysqli_query($conn, $sql_query_string);
                  echo('<ul class="portfolio__item-lang">');
                  while($row_query_string = mysqli_fetch_assoc($result_query_string)){
                    echo('<li class="portfolio__item-lang-item">'.$row_query_string["name"].'</li>');
                  }
                  echo('
                  </ul>
                  </div>
                </div>
              </div>
            </div>');
        }
      }
    ?>
    
    </div>
  </section>
  <!-- portfolio END -->
  <!-- reviews BEGIN -->
  <section id="reviews" class="reviews">
    <div class="container container--mw_1200 reviews__container">
      <h2 class="section-title reviews__title"><strong>Відгуки</strong> наших клієнтів</h2>
      <div class="reviews__list">
        <div class="js-reviews-slider row reviews__row">
    <?php
      //вивід відгуків
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
  <!-- contacts BEGIN -->
  <section id="contacts" class="contacts">
    <div class="container container--mw_1200 contacts__container">
      <h2 class="section-title contacts__title"><strong>Контакти</strong></h2>
      <div class="row contacts__row">
        <div class="col contacts__col contacts__col--7">
          <ul class="contacts__list">
            <li class="contacts__item">Webpro</li>
            <li class="contacts__item">Email: <a href="mailto:web@pro.ua">web@pro.ua</a></li>
            <li class="contacts__item">Телефон: <a href="tel:+380686563458">+380686563458</a></li>
            <li class="contacts__item">Адреса: м. Львів, вул. Б.Хмельницького 25.</li>
          </ul>
        </div>
        <div class="col contacts__col contacts__col--5">
          <a href="#intro" class="js-top-top to-top contacts__to-top"></a>
        </div>
      </div>
    </div>
  </section>
  <!-- contacts END -->
  <!-- footer BEGIN -->
  <footer class="footer">
    <div class="container container--mw_full footer__container">
      <div class="row footer__row">
        <div class="col footer__col footer__col--3">
          <div class="footer__company-name">Webpro ©</div>
        </div>
        <div class="col footer__col footer__col--6">
          <div class="footer__cookie">Використовуючи наш сайт, ви надаєте згоду на використання файлів cookie, які забезпечують правильну роботу сайту.</div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer END -->
</div>
<!-- site END -->

<!-- slider ↓ -->
<script src="js/slick-1.9.0.min.js"></script>
<!-- modal ↓ -->
<script src="js/jquery.modal.min.js"></script>
<!-- main ↓ -->
<script src="js/main.js"></script>

</body>
</html>