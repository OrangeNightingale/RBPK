-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 05 2015 г., 03:48
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `coursdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note_text` varchar(255) CHARACTER SET utf32 NOT NULL,
  `note_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `note_text`, `note_id`) VALUES
(1, 'Моя заметка', '4'),
(2, 'Хочу купить коляску!', '3'),
(13, 'qw', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `google_id` varchar(255) DEFAULT NULL,
  `name` text,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `notice`
--

INSERT INTO `notice` (`id`, `google_id`, `name`, `note`) VALUES
(1, 'qwe', 'Tony Stark', 'qwerty'),
(3, '', 'Test', 'test'),
(5, '', '', ''),
(6, '', '', ''),
(9, '109354271492580406992', 'Антон Педан', 'Test');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `email` varchar(255) CHARACTER SET utf32 NOT NULL,
  `passHash` varchar(255) CHARACTER SET utf32 NOT NULL,
  `week_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `week_id` (`week_id`),
  KEY `google_id` (`google_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `passHash`, `week_id`) VALUES
(3, NULL, 'Мария Иванова', 'ex@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(4, NULL, 'Scherrt Hert', 'wer@gmail.com', 'bfd59291e825b5f2bbf1eb76569f8fe7', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `weeks`
--

CREATE TABLE IF NOT EXISTS `weeks` (
  `week_id` int(11) NOT NULL AUTO_INCREMENT,
  `week_text` varchar(500) CHARACTER SET utf32 NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`week_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `weeks`
--

INSERT INTO `weeks` (`week_id`, `week_text`, `user_id`) VALUES
(1, 'Первая неделя беременности', 3),
(2, 'Вторая неделя беременности', 3);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `weeks`
--
ALTER TABLE `weeks`
  ADD CONSTRAINT `weeks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
