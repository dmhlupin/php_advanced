-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Окт 29 2021 г., 21:37
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
  `session_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `user_id`, `status`, `sum`, `session_id`) VALUES
(1, 'Заказ 1', '911-123-56-79', 1, 1, 19000, 1),
(2, 'Заказ 2', '911-987-65-32', 1, 2, 12000, 2);

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
(15, 'Титановые наручные часы Boccia Titanium 3753-04 с хронографом', 'Многофункциональные часы с титановым корпусом по достоинству оценят современные мужчины. Circle-Oval. Часы-хронограф с секундомером. Окошко даты. Рифленая заводная головка. Кожаный ремешок с классической застежкой.', 13700, 1, 4, '3753-04.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `hash`) VALUES
(1, 'admin', '123', ''),
(2, 'user', '123', '');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
