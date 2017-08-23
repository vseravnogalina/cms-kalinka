<?php header("Content-Type: text/html; charset=utf-8");
/**@package  KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
 ?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="lib/jquery/jquery-1.11.1.min.js"></script>
     <META NAME="Robots" CONTENT="NOINDEX,NOFOLLOW">
		<meta charset="utf-8" >
		<link rel="stylesheet" href='style.css'/> 
		<!--[if lt IE 9]> 
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]--> 
 
        <title>Установка</title>
		</head>
	<body style='background:#59ff99'>
	<!---Форма с указанием имени сайта и имени сервера. Загрузка архива на серевер без кнопки обзора - 
	скрытые поля указывают путь загрузки, имя файла и имя сервера.
Кнопка отсылает к php файлу- Создание папки на сервере, распаковка архива в указанную директорию.	 
	-->
	<img src='poehaly.png' alt='Картинка' width='100%' height='100%' />
	<h2>Начинаем обратный отсчет!  8!</h2>
	<form action ='nachalo.php' method='POST'>
<p>Введите имя своего сайта на латинице</p><p><input style='border:2px solid #ff59bf'  type='text' name='sait' value='' /></p>
<p>Введите имя сервера, для Денвера - localhost</p><p><input style='border:2px solid #ff59bf' type='text' name='host' value='' /></p>
<p><input style='background:#ffec59; color:#ff59bf;border-radius:25%' type=submit value="Начать установку!"></p>
</form>
	</body>
	</html>
