<?php header("Content-Type: text/html; charset=utf-8"); 
/**@package  KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2017 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
//Форма ввода данных при установке
$loginpolz=(htmlspecialchars(trim($_POST['loginpolz'])));//Логин администратора сайта (полный доступ)
$email=(htmlspecialchars(trim($_POST['email'])));//Емайл администратора сайта
$passw=(htmlspecialchars(trim($_POST['passw'])));//Пароль администратора сайта
$repassw=(htmlspecialchars(trim($_POST['repassw'])));//ПОВТОР Пароль администратора сайта
$tel=(htmlspecialchars(trim($_POST['tel'])));
$gruppa=intval($_POST['gruppa']);//Группа администратора сайта
if($passw!==$repassw)
die ("Пароль администратора не совпадает! Требуется переустановить загрузочную папку!");
//else echo "<h2>2!&nbsp;&nbsp;&nbsp;</h2>";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>KALINKA BD</title>
  <link rel="stylesheet" href="style.css"/>
  <!--[if lt IE 9]> 
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]-->
  <META NAME="Robots" CONTENT="NOINDEX,NOFOLLOW">
 </head>
 <body>
 <h2>Продолжаем отсчет!&nbsp;&nbsp;&nbsp;2!</h2>
 <h2>Устанавливаем Базу Данных(БД)</h2>
<h3>Будьте внимательны при заполнении полей формы!</h3>
<h3>Если будут введены ошибочные данные, установка не будет выполнена!</h3>
 <form action="instl.php" name="" method="POST">
 
 <p>Для создания БД введите имя пользователя БД</p>
 <p><input type="text" name="username" value="" required></input></p>
 <p>Введите пароль пользователя БД</p>
 <p><input type="password" name="parol" value="" required></input></p>
  <p>Повторите пароль пользователя БД</p>
 <p><input type="password" name="reparol" value="" required></input></p>
 <p>Сервер подключения, для Денвера - localhost</p>
 <p>При установке на реальный хостинг, получите имя сервера подключения БД у Вашего хостера</p>
 <p><input type="text" name="server" value="" required></input></p>
 <p>Введите имя БД</p>
 <p><input type="text" name="datbas" value="" required></input></p>
  <p>Повторите имя БД</p>
 <p><input type="text" name="redatbas" value="" required></input></p>
 <p><input type="hidden" name="loginpolz" value="<?php echo $loginpolz?>" required ></input></p>
 
 <p><input type="hidden" name="email" value="<?php echo $email?>" required ></input></p>
 
 <p><input type="hidden" name="tel" value="<?php echo $tel?>" pattern="+7[0-9]{10}" ></input></p>
 <p><input type="hidden" name="gruppa" value="1" readonly ></input></p>
 
 <p><input type="hidden" name="passw" value="<?php echo $passw?>" required ></input></p>
 <p><input type="submit" name="butt" value="Создать базу данных!"></input></p>
 </body></html>
