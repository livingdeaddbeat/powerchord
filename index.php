<?
	// index.php
	
	# Code protection
	define('ENGINE', true);
	define('MAINDIR', dirname(__FILE__));
	
	# Управление ошибками
	// error_reporting(E_ALL);
	# Подключение сессий
	session_start();
	
	# Подключение библиотеки пользовательских функций
	include 'inc/functions.php';
	
	# Инициализация работы с базой данны
	include 'data/db.php';
	
	# Инициализация стандартных данных
	include 'data/data.php';
	
	# Настройки сайта
	include 'data/config.php';
	
	# Инициализация работы с пользователем
	include 'inc/userInit.php';
	
	// Инициализация работы сайта
	include 'inc/init.php';
	
?>