<?php header("Content-Type: text/html; charset=utf-8"); 
/**@package  KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2018 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 1.0.0
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
 if ($_POST['butt'])
{
//Наименование сайта
$server=(htmlspecialchars(trim($_POST['server'])));//Наименование сервера
$datbas=(htmlspecialchars(trim($_POST['datbas'])));//Наименование БД
$username=(htmlspecialchars(trim($_POST['username'])));//Имя пользователя БД
$loginpolz=(htmlspecialchars(trim($_POST['loginpolz'])));//Логин администратора сайта (полный доступ)
$email=(htmlspecialchars(trim($_POST['email'])));//Емайл администратора сайта
$parol=(htmlspecialchars(trim($_POST['parol'])));//Пароль БД
$passw=(htmlspecialchars(trim($_POST['passw'])));//Пароль администратора сайта
$tel=(htmlspecialchars(trim($_POST['tel'])));
$gruppa=intval($_POST['gruppa']);//Группа администратора сайта

$reparol=(htmlspecialchars(trim($_POST['reparol'])));//ПОВТОР пароль БД
if($parol!==$reparol)
die ("Пароли БД не совпадают! Требуется переустановить загрузочную папку!");
$today=date("Y-m-d");
//Подключение к БД
$mysqli = new mysqli($server,$username,$parol, $datbas);

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Соединение не установлено: %s\n", mysqli_connect_error());
    exit();
}
else
echo "Соединение установлено";
$serverkd = $mysqli->real_escape_string(base64_encode($server));
$datbaskd = $mysqli->real_escape_string(base64_encode($datbas));
$usernamekd = $mysqli->real_escape_string(base64_encode($username));
$passwordkd = $mysqli->real_escape_string(base64_encode($parol));
$tel=$mysqli->real_escape_string($tel);
$gruppa = $mysqli->real_escape_string($gruppa);
$loginpolz = $mysqli->real_escape_string(sha1($loginpolz));
$email = $mysqli->real_escape_string(sha1($email));
$passw = $mysqli->real_escape_string(sha1($passw));

/* возвращаем имя текущей базы данных */
if ($result = $mysqli->query("SELECT DATABASE($datbas)")) {
    $row = $result->fetch_row();
    printf("Устанавливается база данных %s.\n", $row[0]);
    $result->close();
}
//Таблица Пользователи - costomers, стобцы login и password - только для администрации
$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS costomers(
id int (10) AUTO_INCREMENT,
login varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
password varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
email varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
groupcost tinyint(2) NOT NULL,
name varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
phone varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci,
ip int (22),
PRIMARY KEY (id)) ENGINE=InnoDB  CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='Пользователи'")) {
    echo "Не удалось создать таблицу Пользователи: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Пользователи успешно создана";
$mysqli->query("SET NAMES 'utf8'");
 //Достаем из таблиц инфу о пользователе по паролю
 $result=$mysqli->query("SELECT login FROM costomers WHERE login='$loginpolz'");
 $proverka=$result->fetch_array();
  if(empty($proverka['login']))
{$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query("INSERT INTO costomers  
(login,password,email,groupcost,name,phone) VALUES 
('".$loginpolz."','".$passw."','".$email."','".$gruppa."','','".$tel."')")){
    echo "Не удалось создать таблицу Пользователи: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Данные введены в таблицу Пользователи";}
else echo "Данные уже введены в таблицу Пользователи";
/* Очистить выборку */
   $result ->close();
//Создать главную таблицу узла Блог - book	
$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS book(
id int (10) AUTO_INCREMENT,
title varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
list int (20),
content text CHARACTER SET utf8 COLLATE utf8_general_ci,
author varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
dat date,
keywords varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
annotation text CHARACTER SET utf8 COLLATE utf8_general_ci,
idpart int (10),
PRIMARY KEY (id)) COMMENT='Тексты статей узла Блог'")) {
    echo "Не удалось создать таблицу Блог: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Блог успешно создана";
//Ввести данные в таблицу
 $resu=$mysqli->query("SELECT content FROM book WHERE id='1'");
 $prov=$resu->fetch_array();
  if(empty($prov['content']))
{$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("INSERT INTO book(
title,list,content,author,dat,keywords,annotation,idpart)
VALUES('Блог','1','<p>Приветствую Вас на главной странице узла Блог проекта Калинка!</p>

<p>Как выглядит шаблон:</p>

<p>Заголовки:</p>

<h1>Заголовок 1</h1>

<h2>Заголовок 2</h2>

<h3>Заголовок 3</h3>

<p>Шрифты:</p>

<p><strong>Bold</strong></p>

<p><em>Italic</em></p>

<p>Normal</p>

<p>Списки:</p>

<ul>
	<li>Пункт 1</li>
	<li>Пункт2</li>
</ul>

<p>&nbsp;</p>

<ol>
	<li>Пункт 1</li>
	<li>Пункт 2</li>
</ol>

<p>Таблицы</p>

<table border=1 cellpadding=1 cellspacing=1>
	<caption>Оформление таблиц</caption>
	<tbody>
		<tr>
			<th scope=row>№</th>
			<td>За&shy;го&shy;ло&shy;вок</td>
			<td>За&shy;го&shy;ло&shy;вок</td>
			<td>За&shy;го&shy;ло&shy;вок</td>
		</tr>
		<tr>
			<th scope=row>1</th>
			<td>текст</td>
			<td>текст</td>
			<td>текст</td>
		</tr>
		<tr>
			<th scope=row>2</th>
			<td>текст</td>
			<td>текст</td>
			<td>текст</td>
		</tr>
	</tbody>
</table>','admin','$today','.','.','0')")) 
{echo "Не удалось ввести данные в Блог: (".$mysqli->errno . ")".$mysqli->error;}
else echo "Данные введены в таблицу Блог!";}
else echo "Данные уже введены в таблицу Блог!";
$mysqli->query("SET NAMES 'utf8'");
//Создать таблицу комментариев для узла book - feedbackbook
if(!$mysqli->query("CREATE TABLE IF NOT EXISTS feedbackbook(
id int (10) AUTO_INCREMENT,
comment text CHARACTER SET utf8 COLLATE utf8_general_ci,
namecostomer varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
email varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
idarticle int(10),
namearticle varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
dat date,
moder tinyint(4),
PRIMARY KEY (id)) COMMENT='Комментарии к статьям узла Блог'")) {
    echo "Не удалось создать таблицу Комментарии: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Комментарии успешно создана";
//Создать таблицу разделов узла book - partbook
$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS partbook(
id int (10) AUTO_INCREMENT,
title varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
list int(10),
PRIMARY KEY (id)) COMMENT='Разделы узла Блог'")) {
    echo "Не удалось создать таблицу Разделы: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Разделы успешно создана";
//Создать таблицу разделов Общее - partcommon
$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS partcommon(
id int (10) AUTO_INCREMENT,
title varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
list int(10),
PRIMARY KEY (id)) COMMENT='Разделы узла Общее'")) {
    echo "Не удалось создать таблицу Разделы-Общее: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Разделы-Общее успешно создана";
//Ввести данные в таблицу
 $resul=$mysqli->query("SELECT title FROM partcommon WHERE id='1'");
 $provka=$resul->fetch_array();
  if(empty($provka['title']))
{$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query("INSERT INTO partcommon(title,list)
VALUES('main','100')")) 
{echo "Не удалось ввести данные в  Разделы-Общее: (".$mysqli->errno . ")".$mysqli->error;}
else echo "Данные введены в таблицу  Разделы-Общее!";}
else echo "Данные уже введены в таблицу  Разделы-Общее!";
//Создать таблицу документов сайта common
$mysqli->query("SET NAMES 'utf8'");
if (!$mysqli->query("CREATE TABLE IF NOT EXISTS common(
id int (10) AUTO_INCREMENT,
title varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
list int (20),
content text CHARACTER SET utf8 COLLATE utf8_general_ci,
author varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci,
dat date,
keywords varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
annotation text CHARACTER SET utf8 COLLATE utf8_general_ci,
idpart int (10),
PRIMARY KEY (id)) COMMENT='Документы'")) {
    echo "Не удалось создать таблицу Документы: (" . $mysqli->errno . ") " . $mysqli->error;
}
else echo "Таблица Документы успешно создана";
//Ввести данные в таблицу
 $resul=$mysqli->query("SELECT content FROM common WHERE id='1'");
 $provka=$resul->fetch_array();
  if(empty($provka['content']))
{$mysqli->query("SET NAMES 'utf8'");
if(!$mysqli->query("INSERT INTO common(
title,list,content,author,dat,keywords,annotation,idpart)
VALUES('О нас','1','Приветствую Вас на  странице Документы проекта Калинка!','admin','$today','.','.','1')")) 
{echo "Не удалось ввести данные в Документы: (".$mysqli->errno . ")".$mysqli->error;}
else echo "Данные введены в таблицу Документы!";}
else echo "Данные уже введены в таблицу Документы!";

/* закрываем соединение */
$mysqli->close();
$fl1="$"."server";
$fl2="$"."datbas";
$fl3="$"."username";
$fl4="$"."parol";
$fl5="$"."title";

if (touch('../variables/variac.php'))
$fp = fopen( "../variables/variac.php", "w+")or die ( "Не удалось открыть файл" );
fputs( $fp, "<?php $fl1='$serverkd';$fl2='$datbaskd';$fl3='$usernamekd';$fl4='$passwordkd'; ?>");
fclose( $fp );
?> <!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'/>
  <title>KALINKA BD</title>
  <link rel='stylesheet' href='style.css'/>
  <META NAME='Robots' CONTENT='NOINDEX,NOFOLLOW'>
 </head>
 <body><?php
if(file_exists("../variables/variac.php")) {echo 'БД установлена';
echo "
<meta charset='utf-8'/>
		<link rel='stylesheet' href='style.css'/> 
<h2>1!&nbsp;&nbsp;&nbsp;</h2>";
echo "<form action='finish1.php' method='POST' >
<input type='hidden'name='tmb' value='sAitGotovKStarty' >
<p><input type='submit' name='but' value='Далее' />";

}
else echo "Ошибка установки БД";
}
?></body></html>
