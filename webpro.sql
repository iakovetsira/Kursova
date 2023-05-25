-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 18 2023 г., 19:53
-- Версия сервера: 5.7.39-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `webpro`
--

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` int(4) NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `technologies` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `company_name`, `description`, `technologies`) VALUES
(1, 'Розробка особистого кабінету', 'Клініка Lenom', 'Розробка особистого кабінету учасника проекту. Реалізація механік програми лояльності, розіграшів призів, просування за партнерською системою. Розробка односторінкового сайту в двох мовних версіях. Можливість реєстрації для користувачів. ', '{\"1\": \"1\", \"2\": \"1\", \"3\": \"0\", \"4\": \"0\", \"5\": \"1\", \"6\": \"0\", \"7\": \"1\", \"8\": \"1\", \"9\": \"1\", \"10\": \"0\", \"11\": \"0\", \"12\": \"0\", \"13\": \"0\", \"14\": \"0\", \"15\": \"0\", \"16\": \"0\", \"17\": \"1\", \"18\": \"0\", \"19\": \"0\", \"20\": \"0\", \"21\": \"0\"}'),
(2, 'Чат-Бот', 'Тернопільська целюлоза', 'Розробка особистого кабінету учасника проекту. Реалізація механік програми лояльності, розіграшів призів, продвиження по партнерській системі. Розробка односторінкового сайту в двох мовних версіях. Можливість реєстрації для користувачів', '{\"1\": \"1\", \"2\": \"0\", \"3\": \"0\", \"4\": \"0\", \"5\": \"1\", \"6\": \"1\", \"7\": \"1\", \"8\": \"1\", \"9\": \"1\", \"10\": \"0\", \"11\": \"1\", \"12\": \"0\", \"13\": \"1\", \"14\": \"0\", \"15\": \"0\", \"16\": \"1\", \"17\": \"1\", \"18\": \"0\", \"19\": \"1\", \"20\": \"0\", \"21\": \"1\"}'),
(4, 'Логістична Система', 'Твоя Логістика', 'Логістична Система - інноваційний проект для логістичної компанії, що забезпечує ефективне управління та оптимізацію поставок, складського управління та маршрутизації. Забезпечує автоматизацію процесів, покращує прогнозування та знижує витрати, сприяючи ефективному функціонуванню логістичного бізнесу.', '{\"1\": 1, \"2\": 0, \"3\": 0, \"4\": 0, \"5\": 0, \"6\": 0, \"7\": 1, \"8\": 1, \"9\": 0, \"10\": 0, \"11\": 0, \"12\": 0, \"13\": 1, \"14\": 0, \"15\": 1, \"16\": 0, \"17\": 0, \"18\": 1, \"19\": 1, \"20\": 0, \"21\": 0, \"22\": 1, \"23\": 0, \"24\": 0}');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(5) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `company_name`, `user_name`, `text`) VALUES
(1, 'Львів Газ', 'Олег Мельник', 'Професійна компанія з програмної розробки, яка забезпечує високоякісні рішення та швидку реакцію на потреби клієнтів.'),
(2, 'Шина', 'Владислав Кіт', 'Надійний партнер для розробки програмного забезпечення, з надзвичайно кваліфікованим персоналом і ефективними рішеннями.'),
(3, 'Тернопільська Целюлоза', 'Оксана Марчук', 'Компанія-експерт з програмної розробки, яка володіє глибоким розумінням технологій та здатна швидко реалізувати проекти будь-якої складності'),
(4, 'ТзОВ Технології', 'Анатолій Семенюк', 'Інноваційна фірма з програмної розробки, що надає сучасні рішення та сприяє цифровій трансформації бізнесу.'),
(6, 'Електрон', 'Валентина Мандрик', 'Дуже професійно підійшли до своєї справи. Надали хорошу команду, яка в хороші терміни виконала своє завдання.');

-- --------------------------------------------------------

--
-- Структура таблицы `technologies`
--

CREATE TABLE `technologies` (
  `id` int(3) NOT NULL,
  `img_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `kind_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `technologies`
--

INSERT INTO `technologies` (`id`, `img_name`, `name`, `kind_id`) VALUES
(1, 'java', 'Java', 1),
(2, 'php', 'PHP', 1),
(3, 'linux', 'Linux', 1),
(4, 'spring', 'Spring', 1),
(5, 'html', 'HTML', 1),
(6, 'centos', 'Centos', 1),
(7, 'node', 'NodeJS', 1),
(8, 'mongodb', 'MongoDB', 1),
(9, 'css', 'CSS', 1),
(10, 'docker', 'Docker', 1),
(11, 'git', 'Git', 1),
(12, 'cisco', 'Cisco', 2),
(13, 'hpe', 'HP Enterprise', 2),
(14, 'ibm', 'IBM', 2),
(15, 'dell-emc', 'DELL EMC', 2),
(16, 'fujitsu', 'Fujitsu', 2),
(17, 'microsoft-azure', 'Microsoft Azure', 3),
(18, 'kubernetes', 'Kubernetes', 3),
(19, 'gmail', 'Gmail', 3),
(20, 'microsoft-one', 'Microsoft One Drive', 3),
(21, 'adobe-creative', 'Adobe Creative Cloud', 3),
(22, 'android', 'Android', 4),
(23, 'ios', 'IOS', 4),
(24, 'windows', 'Windows', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `technologies_kind`
--

CREATE TABLE `technologies_kind` (
  `id` int(2) NOT NULL,
  `technologies_kind_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `technologies_kind`
--

INSERT INTO `technologies_kind` (`id`, `technologies_kind_name`) VALUES
(1, 'Мови програмування\r\nта платформи'),
(2, 'Збереження даних'),
(3, 'Хмарні технології'),
(4, 'Мобільні платформи');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `password` varchar(30) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `Name`) VALUES
(1, 'admin', '1212', 'Андрій');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `technologies_kind`
--
ALTER TABLE `technologies_kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `technologies_kind`
--
ALTER TABLE `technologies_kind`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
