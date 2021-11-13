-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 14 2021 г., 00:00
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int NOT NULL,
  `session_id` varchar(256) NOT NULL,
  `product_id` int NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `product_id`, `price`) VALUES
(1, 'ved8fv1gcqtni40rfsvl90vudml2akbr', 2, 10000),
(2, 'ved8fv1gcqtni40rfsvl90vudml2akbr', 17, 20000),
(49, 'ved8fv1gcqtni40rfsvl90vudml2akbr', 14, 86000),
(50, 'ved8fv1gcqtni40rfsvl90vudml2akbr', 15, 13700),
(51, 'dmnpqrfsmsvd8hgu107mare5qaicaupi', 2, 35990),
(52, 'dmnpqrfsmsvd8hgu107mare5qaicaupi', 3, 9990),
(53, 'dmnpqrfsmsvd8hgu107mare5qaicaupi', 4, 29650),
(54, '2it7hqgb73f7an6qvg1n6haf72n69gep', 3, 9990),
(55, '2it7hqgb73f7an6qvg1n6haf72n69gep', 4, 29650),
(56, '2it7hqgb73f7an6qvg1n6haf72n69gep', 3, 9990),
(57, '4j23dbtgeo8d47qvu6clu59998qe2c3v', 3, 9990),
(58, '4j23dbtgeo8d47qvu6clu59998qe2c3v', 3, 9990),
(59, '4j23dbtgeo8d47qvu6clu59998qe2c3v', 3, 9990),
(64, 'onai0keg2hamsgla3bdnoc5t6fviuv60', 4, 29650),
(66, '7c338539d0eeqvvus83vsc2hv9dh3519', 2, 35990);

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Nescafe'),
(2, 'Nike'),
(3, 'TikTak');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Продукты'),
(2, 'Одежда');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL,
  `sum` int NOT NULL,
  `session_id` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `user_id`, `status`, `sum`, `session_id`) VALUES
(1, 'Заказ 1', '911-123-56-79', 1, 1, 19000, '1'),
(2, 'Заказ 2', '911-987-65-32', 1, 2, 12000, '2'),
(3, 'Часы Casio Edifice EFR-526L-1A', '1111111', 1, 1, 9990, '4j23dbtgeo8d47qvu6clu59998qe2c3v'),
(4, 'Титановые наручные часы Citizen BM8560-11X', '122-122-1221', 1, 1, 29650, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(5, 'Часы Casio G-SHOCK', '222-333-444', 1, 1, 35990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(6, 'Часы Casio G-SHOCK', '342424', 1, 1, 35990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(7, 'Часы Casio G-SHOCK', '111-111-111', 1, 1, 35990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(8, 'Часы Casio Edifice EFR-526L-1A', '111-111-111', 1, 1, 9990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(9, 'Часы Casio G-SHOCK', '111-111-111', 1, 1, 35990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(10, 'Титановые наручные часы Citizen BM8560-11X', '111-111-111', 1, 1, 29650, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(11, 'Часы Casio G-SHOCK', '111-111-111', 1, 1, 35990, 'onai0keg2hamsgla3bdnoc5t6fviuv60'),
(12, 'Часы Casio G-SHOCK', '111-111-111', 2, 1, 35990, '7c338539d0eeqvvus83vsc2hv9dh3519'),
(13, 'Швейцарские механические наручные часы NORQAIN N1001CY01A', '111-111-333', 2, 1, 286000, '7c338539d0eeqvvus83vsc2hv9dh3519');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `brand_id`, `image`) VALUES
(2, 'Часы Casio G-SHOCK', 'Эта новинка от Casio порадует вам своей функциональностью и надежностью. Часы для настоящих мужчин. G-Steel. Питание от солнечной энергии Tough Solar - солнечные батарейки большой мощности, индикатор заряда батареи. Функция автоматического сохранения энергии', 35990, 1, 3, 'GST-B400D-1AER.jpg'),
(3, 'Часы Casio Edifice EFR-526L-1A', 'Часы со спортивным характером по достоинству оценят современные мужчины, которые отдают предпочтение практичным и функциональным вещам. Edifice. Часы-хронограф', 9990, 1, 3, 'EFR-526L-1A.jpg'),
(4, 'Титановые наручные часы Citizen BM8560-11X', 'Надежные титановые часы - выбор практичных и пунктуальных мужчин. Super Titanium Eco-Drive. Система Eco-Drive не требующая замены батарейки. Питание от солнечной энергии, запас энергии на 180 дней', 29650, 1, 2, 'BM8560-11X.jpg'),
(13, 'Наручные часы Citizen AT2480-81X', 'Титановые часы с системой Eco-Drive - выбор современных и динамичных мужчин. Eco-Drive. Часы-хронограф\r\nЧасы-хронограф с секундомером и тахиметром. Секундомер с точностью 1/1сек и временем измерения 60мин. ', 44550, 1, 2, 'AT2480-81X.jpg'),
(14, 'Швейцарские механические наручные часы Aviator', 'Коллекция часов Douglas была разработана в честь известного американского пассажирского самолета Douglas DC-3. Часы Douglas Day-Date дают больше возможностей по контролю текущего времени, дня недели и даты. Douglas Day-Date. Лимитированная серия.', 86000, 1, 1, 'V-3-20-0-145-4.jpg'),
(15, 'Титановые наручные часы Boccia Titanium 3753-04 с хронографом', 'Многофункциональные часы с титановым корпусом по достоинству оценят современные мужчины. Circle-Oval. Часы-хронограф с секундомером. Окошко даты. Рифленая заводная головка. Кожаный ремешок с классической застежкой.', 13700, 1, 4, '3753-04.jpg'),
(16, 'Швейцарские механические наручные часы NORQAIN N1001CY01A', 'Стильный вариант швейцарских часов для мужчин, которые всегда достигают поставленных целей. Adventure Sport. Лимитированная серия - 100 экземпляров. В механизме, состоящем из 80 деталей 26 камней, частота 28800 полуколебаний в час. Запас хода 38 часов. Окошко даты находится в положении 3 часа. Быстрая коррекция даты. Циферблат с фирменным узором NORQAIN.', 286000, 1, 5, 'N1001CY01A-A103-10AR-20S.jpg'),
(17, 'Швейцарские механические наручные часы NORQAIN N1800SP81A', 'Безупречный швейцарский аксессуар станет главным штрихом в образе активной леди. Adventure Sport. Женские швейцарские часы. В механизме, состоящем из 80 деталей 26 камней, частота 28800 полуколебаний в час. Запас хода 38 часов. Окошко даты находится в положении 3 часа. Быстрая коррекция даты.', 165000, 2, 5, 'N1800SP81A-M18D-18MM-16S.jpg'),
(22, 'Швейцарские механические наручные часы NORQAIN NS1200C23C/G1NS/10REC с хронографом', 'Многофункциональный хронограф с превосходным швейцарским качеством - идеальный аксессуар в образе настоящего мужчины. Adventure Sport Chrono. В механизме, состоящем из 120 деталей 27 камней, частота 28800 полуколебаний в час. Запас хода 48 часов. Часы-хронограф с секундомером. Циферблат с фирменным узором NORQAIN. Накладные метки в виде штрихов. Окошко даты находится в положении 4 часа. Дата устанавливается отдельной кнопкой.', 339000, 1, 5, 'NS1200C23C-G1NS-10REC.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `login` varchar(100) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `hash`) VALUES
(1, 'admin', 'admin', '$2y$10$xJe5EdSBPzRWhKYJXDMHEuT.hzBVrAIcS0XEeUkxwWB5P44FGB2aO', ''),
(2, 'user1', 'user1', '$2y$10$qb0i/515w3abapOspSAh9u9js0j8GB0qLK7pFvMDbgXAzCR9Z3sxO', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users_orders`
--

CREATE TABLE `users_orders` (
  `user_id` int NOT NULL,
  `order_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
