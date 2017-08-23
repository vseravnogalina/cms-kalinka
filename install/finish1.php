<?php header("Content-Type: text/html; charset=utf-8");
/**@package  UNATKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
//Здесь удаляем все оставшиеся файлы установки, кроме индексного и этого самого
//И ставим кнопку СТАРТ
$tmb=(htmlspecialchars(trim($_POST['tmb'])));//Логин администратора сайта (полный доступ)

if (unlink('nachalo.php'))//Начало
echo "";
else
{echo "Ошибка при удалении файла";};

if (unlink('poehaly.png'))//Поехали
echo "";
else
{echo "Ошибка при удалении файла";};

if (unlink('instl.php'))//Инсталл
echo "";
else
{echo "Ошибка при удалении файла";};

//Старт
if (unlink('start.php'))
{echo "<h2>0!&nbsp;&nbsp;&nbsp;</h2>";}
else
{echo "Ошибка при удалении файла";};

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href='style.css'/> 
		<!--[if lt IE 9]> 
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]--> 
 <META NAME="Robots" CONTENT="NOINDEX,NOFOLLOW">
        <title>Установка</title>
		</head>
		<body>
<?php
echo
"<form action='../tumbl.php' method='POST'>
<input type='hidden' name='tumb' value=$tmb />
<input style='background:#ffec59;color:ff59bf;border-radius:25%;' type='submit' name='' value='СТАРТ!'>
</form>";
echo"
<img src='strelka.png' alt='Картинка' width='10%' height='20%' />";
echo "<br>ПОЗДРАВЛЯЕМ! ВАШ САЙТ ГОТОВ К СТАРТУ!";

?>
</body></html>
