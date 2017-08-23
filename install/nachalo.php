<?php header("Content-Type: text/html; charset=utf-8");
/**@package KALINKA  @author Родионова Галина Евгеньевна http(s)://unatka.ru * @copyright Copyright © 2013-2016 Родионова Галина Евгеньевна* email gala.anita@mail.ru @ version 0.9.2
* @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3**/
if(isset($_POST['sait'])) $sait=htmlspecialchars(strip_tags(trim($_POST['sait'])));
if(isset($_POST['host'])) $host=htmlspecialchars(strip_tags(trim($_POST['host'])));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href='style.css'/> 
<!--[if lt IE 9]>  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]--> 
 <META NAME="Robots" CONTENT="NOINDEX,NOFOLLOW">
        <title>Установка CMS KALINKA</title>
		</head>
		<body>
		<?php echo '<h3>Ваш сайт&nbsp;&nbsp; '.$sait.'</h3>'; echo '<h3>на хостинге&nbsp;&nbsp;'.$host.'</h3>'; 
		
/*//Создаем директорию загрузки
/*Ну вот, загрузились, теперь нужно распаковать архив в эту директорию*/
//И в процессе загрузки переместить архиватор
		
$upfile="kalinka.zip";

		if($upfile)
{
require_once('pclzip/pclzip.lib.php');
//создаем новый объект ZipArchive 
$archive = new PclZip("$upfile");
  if ($archive->extract() == 0) {
    die("Error : ".$archive->errorInfo(true));
  }
  else echo "<h2>7!</h2>";
  }
  else echo "Архива нет!<br>";
//АДМИНКА
	/*Определяем директорию из которой ведется загрузка*/
	$puttupadm="kalinka/office";
	/*Определяем директорию, в которую ведется загрузка*/
	mkdir("../office/");
	$admfact="../office";
	//Ставим CKEditor
	//Создаем директорию $admfact/ckeditor
	mkdir("$admfact/ckeditor/");
/*Создаем директорию $admfact/CKEditor/adapters*/
	mkdir("$admfact/ckeditor/adapters");
	/*Копируем из $puttupadm/CKEditor/adapters в $admfact/CKEditor/adapters*/
	/*Удаляем файл из папки $puttupadm/ckeditor/adapters*/
	if (copy("$puttupadm/ckeditor/adapters/jquery.js","$admfact/ckeditor/adapters/jquery.js"))  
	{unlink("$puttupadm/ckeditor/adapters/jquery.js");}
//Удаляем папку $puttupadm/CKEditor/adapters
	if (file_exists("$admfact/ckeditor/adapters/"))
	{if(rmdir("$puttupadm/ckeditor/adapters/"))clearstatcache();}
	//Создаем директорию $admfact/CKEditor/lang
	mkdir("$admfact/ckeditor/lang");
//Сканируем директорию $puttupadm/CKEditor/lang
	//Формируем массив 
	$editlang=array();//имя массива
	$dr="$puttupadm/ckeditor/lang";
//сканируемая директория
	$skip = array('.', '..');//удаляем точки
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $editlang[]=$tem;}
/*Копируем и удадяем файлы из $puttupadm/CKEditor/lang*/
	if(isset($editlang))
	{
	foreach($editlang as $value)
	{if(copy("$puttupadm/ckeditor/lang/$value","$admfact/ckeditor/lang/$value"))
	unlink("$puttupadm/ckeditor/lang/$value");
	}
	}
	/*Удалить директорию $puttupadm/CKEditor/lang*/
	if (file_exists("$admfact/ckeditor/lang/"))
	{if(rmdir("$puttupadm/ckeditor/lang"))clearstatcache();}

//ПЛАГИНЫ
//Создаем директорию $admfact/CKEditor/plugins
	mkdir("$admfact/ckeditor/plugins");
/***Создаем директорию $admfact/CKEditor/plugins/a11yhelp*/
	mkdir("$admfact/ckeditor/plugins/a11yhelp");
	/***Создаем директорию $admfact/CKEditor/plugins/a11yhelp/dialogs*/
	mkdir("$admfact/ckeditor/plugins/a11yhelp/dialogs");
	/***Создаем директорию $admfact/CKEditor/plugins/a11yhelp/dialogs/lang*/
	mkdir("$admfact/ckeditor/plugins/a11yhelp/dialogs/lang");
	/*Сканируем директорию $puttupadm/CKEditor/plugins/a11yhelp/dialogs/lang*/
	$edplaglang=array();//имя массива
	$dr="$puttupadm/ckeditor/plugins/a11yhelp/dialogs/lang";//сканируемая директория
	$skip = array('.', '..');//удаляем точки
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edplaglang[]=$tem;}
/*Копируем и удадяем файлы из $puttupadm/CKEditor/plugins/a11yhelp/dialogs/lang*/
	if(isset($edplaglang))
	{
	foreach($edplaglang as $value)
	{if(copy("$puttupadm/ckeditor/plugins/a11yhelp/dialogs/lang/$value","$admfact/ckeditor/plugins/a11yhelp/dialogs/lang/$value"))
	unlink("$puttupadm/ckeditor/plugins/a11yhelp/dialogs/lang/$value");
	}
	}
	/***Удаляем папку $puttupadm/CKEditor/plugins/a11yhelp/dialogs/lang*/
	if (file_exists("$admfact/ckeditor/plugins/a11yhelp/dialogs/lang"))
	{if(rmdir("$puttupadm/ckeditor/plugins/a11yhelp/dialogs/lang"))clearstatcache();}
	/*Копируем из $puttupadm/CKEditor/ в $admfact/CKEditor/*/
	if(copy("$puttupadm/ckeditor/plugins/a11yhelp/dialogs/a11yhelp.js","$admfact/ckeditor/plugins/a11yhelp/dialogs/a11yhelp.js"))
	unlink("$puttupadm/ckeditor/plugins/a11yhelp/dialogs/a11yhelp.js");
	/*Копируем из $puttupadm/CKEditor/plugins/a11yhelp/dialogs в $admfact/CKEditor/plugins/a11yhelp/dialogs
	//Удаляем файл из папки $puttupadm/CKEditor/plugins/a11yhelp/dialogs*/
	
	/***Удаляем папку $puttupadm/CKEditor/plugins/a11yhelp/dialogs*/
	if (file_exists("$admfact/ckeditor/plugins/a11yhelp/dialogs"))
	{if(rmdir("$puttupadm/ckeditor/plugins/a11yhelp/dialogs"))clearstatcache();}
	/***Удаляем папку $puttupadm/CKEditor/plugins/a11yhelp/*/
	if (file_exists("$admfact/ckeditor/plugins/a11yhelp/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/a11yhelp/"))clearstatcache();}
	/**Создаем директорию $admfact/CKEditor/plugins/about*/
	mkdir("$admfact/ckeditor/plugins/about");
	/**Создаем директорию $admfact/CKEditor/plugins/about/dialogs*/
	mkdir("$admfact/ckeditor/plugins/about/dialogs");
	/**Создаем директорию $admfact/CKEditor/plugins/about/dialogs/hidpi*/
	mkdir("$admfact/ckeditor/plugins/about/dialogs/hidpi");
	/*Копируем $puttupadm/CKEditor/plugins/about/dialogs/hidpi/logo_ckeditor.png в
	 $admfact/CKEditor/plugins/about/dialogs/hidpi/logo_ckeditor.png
	 Копируем $puttupadm/CKEditor/plugins/about/dialogs/logo_ckeditor.png в
	 $admfact/CKEditor/plugins/about/dialogs/logo_ckeditor.png
	 Копируем $puttupadm/CKEditor/plugins/about/dialogs/about.js в
	 $admfact/CKEditor/plugins/about/dialogs/about.js
	 */
	 /**Удаляем файл из папки $puttupadm/CKEditor/plugins/about/dialogs/hidpi/logo_ckeditor.png*/
	 /**Удаляем файл из папки $puttupadm/CKEditor/plugins/about/dialogs/logo_ckeditor.png*/
	 if(copy("$puttupadm/ckeditor/plugins/about/dialogs/hidpi/logo_ckeditor.png","$admfact/ckeditor/plugins/about/dialogs/hidpi/logo_ckeditor.png"))
	 unlink("$puttupadm/ckeditor/plugins/about/dialogs/hidpi/logo_ckeditor.png");
	 if(copy("$puttupadm/ckeditor/plugins/about/dialogs/logo_ckeditor.png","$admfact/ckeditor/plugins/about/dialogs/logo_ckeditor.png"))
	 unlink("$puttupadm/ckeditor/plugins/about/dialogs/logo_ckeditor.png");
	 /**Удаляем файл из папки $puttupadm/CKEditor/plugins/about/dialogs/about.js*/
	 if(copy("$puttupadm/ckeditor/plugins/about/dialogs/about.js","$admfact/ckeditor/plugins/about/dialogs/about.js"))
	 unlink("$puttupadm/ckeditor/plugins/about/dialogs/about.js");
	
	/**Удаляем папку $puttupadm/CKEditor/plugins/about/dialogs/hidpi*/
	if (file_exists("$admfact/ckeditor/plugins/about/dialogs/hidpi"))
	{if(rmdir("$puttupadm/ckeditor/plugins/about/dialogs/hidpi"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/about/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/about/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/about/dialogs/"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/about/*/
	if (file_exists("$admfact/ckeditor/plugins/about/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/about/"))clearstatcache();}
	/***Создаем директорию $admfact/CKEditor/plugins/clipboard*/
	mkdir("$admfact/ckeditor/plugins/clipboard");
	/***Создаем директорию $admfact/CKEditor/plugins/clipboard/dialogs*/
	mkdir("$admfact/ckeditor/plugins/clipboard/dialogs");
	/*Копируем $puttupadm/CKEditor/plugins/clipboard/dialogs/paste.js в
	$admfact/CKEditor/plugins/clipboard/dialogs/paste.js
	*/
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/clipboard/dialogs/paste.js*/
	if (copy("$puttupadm/ckeditor/plugins/clipboard/dialogs/paste.js","$admfact/ckeditor/plugins/clipboard/dialogs/paste.js"))  
	{unlink("$puttupadm/ckeditor/plugins/clipboard/dialogs/paste.js");clearstatcache();}
	/**Удаляем папку $puttupadm/ckeditor/plugins/clipboard/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/clipboard/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/clipboard/dialogs/"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/clipboard/*/
	if (file_exists("$admfact/ckeditor/plugins/clipboard/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/clipboard/"))clearstatcache();}
	/***Создаем директорию $admfact/CKEditor/plugins/dialog*/
	mkdir("$admfact/ckeditor/plugins/dialog");
	/*Копируем $puttupadm/CKEditor/plugins/dialog/dialogDefinition.js в
	$admfact/CKEditor/plugins/dialogs/dialogDefinition.js
	*/
	/***Удаляем файл из папки $puttupadm/CKEditor/plugins/dialog/dialogDefinition.js*/
	if (copy("$puttupadm/ckeditor/plugins/dialog/dialogDefinition.js","$admfact/ckeditor/plugins/dialog/dialogDefinition.js"))  
	{unlink("$puttupadm/ckeditor/plugins/dialog/dialogDefinition.js");}
	/***Удаляем папку $puttupadm/CKEditor/plugins/dialog/*/
	if (file_exists("$admfact/ckeditor/plugins/dialog/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/dialog/"))clearstatcache();}
/***Создаем директорию $admfact/CKEditor/plugins/image/*/
	mkdir("$admfact/ckeditor/plugins/image/");
	/***Создаем директорию $admfact/CKEditor/plugins/image/dialogs*/
	mkdir("$admfact/ckeditor/plugins/image/dialogs");
	/***Создаем директорию $admfact/CKEditor/plugins/image/images*/
	mkdir("$admfact/ckeditor/plugins/image/images");
	/*Копируем $puttupadm/CKEditor/plugins/image/dialogs/image.js в
	$admfact/CKEditor/plugins/image/dialogs/image.js
	Копируем $puttupadm/CKEditor/plugins/image/images/noimage.png в
	$admfact/CKEditor/plugins/image/images/noimage.png
	*/
	/***Удаляем файл из папки $puttupadm/CKEditor/plugins/image/dialogs/image.js*/
	if (copy("$puttupadm/ckeditor/plugins/image/dialogs/image.js","$admfact/ckeditor/plugins/image/dialogs/image.js"))  
	{unlink("$puttupadm/ckeditor/plugins/image/dialogs/image.js");}
	/***Удаляем папку $puttupadm/CKEditor/plugins/image/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/image/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/image/dialogs/"))clearstatcache();}
	/***Удаляем файл из папки $puttupadm/CKEditor/plugins/image/images/noimage.png*/
	if (copy("$puttupadm/ckeditor/plugins/image/images/noimage.png","$admfact/ckeditor/plugins/image/images/noimage.png"))  
	{unlink("$puttupadm/ckeditor/plugins/image/images/noimage.png");}
	/***Удаляем папку $puttupadm/CKEditor/plugins/image/images*/
	if (file_exists("$admfact/ckeditor/plugins/image/images"))
	{if(rmdir("$puttupadm/ckeditor/plugins/image/images"))clearstatcache();}
	/***Удаляем папку $puttupadm/CKEditor/plugins/image/*/
	if (file_exists("$admfact/ckeditor/plugins/image/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/image/"))clearstatcache();}
	/**Создаем директорию $admfact/CKEditor/plugins/link/*/
	mkdir("$admfact/ckeditor/plugins/link/");
	/**Создаем директорию $admfact/CKEditor/plugins/link/dialogs*/
	mkdir("$admfact/ckeditor/plugins/link/dialogs");
	/**Создаем директорию $admfact/CKEditor/plugins/link/images*/
	mkdir("$admfact/ckeditor/plugins/link/images");
	/**Создаем директорию $admfact/CKEditor/plugins/link/images/hidpi*/
	mkdir("$admfact/ckeditor/plugins/link/images/hidpi");
	/*Копируем $puttupadm/CKEditor/plugins/link/dialogs/anchor.js в
	$admfact/CKEditor/plugins/link/dialogs/anchor.js
	Копируем $puttupadm/CKEditor/plugins/link/dialogs/link.js в
	$admfact/CKEditor/plugins/link/dialogs/link.js
	Копируем $puttupadm/CKEditor/plugins/link/images/hidpi/anchor.png в
	$admfact/CKEditor/plugins/link/images/hidpi/anchor.png
	Копируем $puttupadm/CKEditor/plugins/link/images/anchor.png в
	$admfact/CKEditor/plugins/link/images/anchor.png
	*/
	if (copy("$puttupadm/ckeditor/plugins/link/images/anchor.png","$admfact/ckeditor/plugins/link/images/anchor.png"))  
	{unlink("$puttupadm/ckeditor/plugins/link/images/anchor.png");}
	if (copy("$puttupadm/ckeditor/plugins/link/dialogs/link.js","$admfact/ckeditor/plugins/link/dialogs/link.js"))  
	{unlink("$puttupadm/ckeditor/plugins/link/dialogs/link.js");}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/link/dialogs/anchor.js*/
	if (copy("$puttupadm/ckeditor/plugins/link/dialogs/anchor.js","$admfact/ckeditor/plugins/link/dialogs/anchor.js"))  
	{unlink("$puttupadm/ckeditor/plugins/link/dialogs/anchor.js");}
	/**Удаляем папку $puttupadm/CKEditor/plugins/link/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/link/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/link/dialogs/"))clearstatcache();}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/link/images/hidpi/anchor.png*/
	if (copy("$puttupadm/ckeditor/plugins/link/images/hidpi/anchor.png","$admfact/ckeditor/plugins/link/images/hidpi/anchor.png"))  
	{unlink("$puttupadm/ckeditor/plugins/link/images/hidpi/anchor.png");}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/link/images/anchor.png*/
	
	/**Удаляем папку $puttupadm/CKEditor/plugins/link/images/hidpi*/
	if (file_exists("$admfact/ckeditor/plugins/link/images/hidpi"))
{if(rmdir("$puttupadm/ckeditor/plugins/link/images/hidpi"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/link/images*/
	if (file_exists("$admfact/ckeditor/plugins/link/images"))
{if(rmdir("$puttupadm/ckeditor/plugins/link/images"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/link/*/
	if (file_exists("$admfact/ckeditor/plugins/link/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/link/"))clearstatcache();}
/***Создаем директорию $admfact/CKEditor/plugins/magicline/*/
	mkdir("$admfact/ckeditor/plugins/magicline/");
	/***Создаем директорию $admfact/CKEditor/plugins/magicline/images/*/
	mkdir("$admfact/ckeditor/plugins/magicline/images/");
	/***Создаем директорию $admfact/CKEditor/plugins/magicline/images/hidpi*/
	mkdir("$admfact/ckeditor/plugins/magicline/images/hidpi");
	/*Копируем $puttupadm/CKEditor/plugins/magicline/images/hidpi/icon.png в
	$admfact/CKEditor/plugins/magicline/images/hidpi/icon.png
	Копируем $puttupadm/CKEditor/plugins/magicline/images/icon.png в
	$admfact/CKEditor/plugins/magicline/images/icon.png
	*/
	/***Удаляем файл из папки $puttupadm/CKEditor/plugins/magicline/images/hidpi/icon.png*/
	if (copy("$puttupadm/ckeditor/plugins/magicline/images/hidpi/icon.png","$admfact/ckeditor/plugins/magicline/images/hidpi/icon.png"))  
	{unlink("$puttupadm/ckeditor/plugins/magicline/images/hidpi/icon.png");}
if (copy("$puttupadm/ckeditor/plugins/magicline/images/hidpi/icon-rtl.png","$admfact/ckeditor/plugins/magicline/images/hidpi/icon-rtl.png"))  
	{unlink("$puttupadm/ckeditor/plugins/magicline/images/hidpi/icon-rtl.png");}
	/***Удаляем папку $puttupadm/CKEditor/plugins/magicline/images/hidpi/*/
	if (file_exists("$admfact/ckeditor/plugins/magicline/images/hidpi/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/magicline/images/hidpi/"))clearstatcache();}
	/***Удаляем файл из папки $puttupadm/CKEditor/plugins/magicline/images/icon.png*/
	if (copy("$puttupadm/ckeditor/plugins/magicline/images/icon.png","$admfact/ckeditor/plugins/magicline/images/icon.png"))  
	{unlink("$puttupadm/ckeditor/plugins/magicline/images/icon.png");}
if (copy("$puttupadm/ckeditor/plugins/magicline/images/icon-rtl.png","$admfact/ckeditor/plugins/magicline/images/icon-rtl.png"))  
	{unlink("$puttupadm/ckeditor/plugins/magicline/images/icon-rtl.png");}
	/***Удаляем папку $puttupadm/CKEditor/plugins/magicline/images/*/
	if (file_exists("$admfact/ckeditor/plugins/magicline/images/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/magicline/images/"))clearstatcache();}
	/***Удаляем папку $puttupadm/CKEditor/plugins/magicline/*/
	if (file_exists("$admfact/ckeditor/plugins/magicline/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/magicline/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/plugins/pastefromword/*/
	mkdir("$admfact/ckeditor/plugins/pastefromword/");
	/**Создаем директорию $admfact/CKEditor/plugins/pastefromword/filter/*/
	mkdir("$admfact/ckeditor/plugins/pastefromword/filter/");
	/*Копируем $puttupadm/CKEditor/plugins/pastefromword/filter/default.js в
	$admfact/CKEditor/plugins/pastefromword/filter/default.js
	*/
	
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/pastefromword/filter/default.js*/
if (copy("$puttupadm/ckeditor/plugins/pastefromword/filter/default.js","$admfact/ckeditor/plugins/pastefromword/filter/default.js"))  
{unlink("$puttupadm/ckeditor/plugins/pastefromword/filter/default.js");clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/pastefromword/filter/*/
	if (file_exists("$admfact/ckeditor/plugins/pastefromword/filter"))
	{if(rmdir("$puttupadm/ckeditor/plugins/pastefromword/filter"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/pastefromword/*/
	if (file_exists("$admfact/ckeditor/plugins/pastefromword/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/pastefromword/"))clearstatcache();}
	/**Создаем директорию $admfact/CKEditor/plugins/scayt/*/
	mkdir("$admfact/ckeditor/plugins/scayt/");
	/**Создаем директорию $admfact/CKEditor/plugins/scayt/dialogs/*/
	mkdir("$admfact/ckeditor/plugins/scayt/dialogs/");
	/*Копируем $puttupadm/CKEditor/plugins/scayt/dialogs/options.js в
	$admfact/CKEditor/plugins/scayt/dialogs/options.js
	Копируем $puttupadm/CKEditor/plugins/scayt/dialogs/toolbar.css в
	$admfact/CKEditor/plugins/scayt/dialogs/toolbar.css
	
	Копируем $puttupadm/CKEditor/plugins/scayt/LICENSE.md в
	$admfact/CKEditor/plugins/scayt/LICENSE.md
	Копируем $puttupadm/CKEditor/plugins/scayt/README.md в
	$admfact/CKEditor/plugins/scayt/README.md
	
	*/
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/scayt/dialogs/options.js*/
	if (copy("$puttupadm/ckeditor/plugins/scayt/dialogs/options.js","$admfact/ckeditor/plugins/scayt/dialogs/options.js"))  
	{unlink("$puttupadm/ckeditor/plugins/scayt/dialogs/options.js");}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/scayt/dialogs/toolbar.css*/
	if (copy("$puttupadm/ckeditor/plugins/scayt/dialogs/toolbar.css","$admfact/ckeditor/plugins/scayt/dialogs/toolbar.css"))  
	{unlink("$puttupadm/ckeditor/plugins/scayt/dialogs/toolbar.css");}
	/**Удаляем папку $puttupadm/CKEditor/plugins/scayt/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/scayt/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/scayt/dialogs/"))clearstatcache();}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/scayt/LICENSE.md*/
	
if (copy("$puttupadm/ckeditor/plugins/scayt/LICENSE.md","$admfact/ckeditor/plugins/scayt/LICENSE.md"))  
	{unlink("$puttupadm/ckeditor/plugins/scayt/LICENSE.md");}
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/scayt/README.md*/
	if (copy("$puttupadm/ckeditor/plugins/scayt/README.md","$admfact/ckeditor/plugins/scayt/README.md"))  
	{unlink("$puttupadm/ckeditor/plugins/scayt/README.md");}
	/**Удаляем папку $puttupadm/CKEditor/plugins/scayt*/
	if (file_exists("$admfact/ckeditor/plugins/scayt"))
	{if(rmdir("$puttupadm/ckeditor/plugins/scayt"))clearstatcache();}
	/**Создаем директорию $admfact/CKEditor/plugins/specialchar/*/
	mkdir("$admfact/ckeditor/plugins/specialchar/");
	/**Создаем директорию $admfact/CKEditor/plugins/specialchar/dialogs/*/
	mkdir("$admfact/ckeditor/plugins/specialchar/dialogs/");
	/**Создаем директорию $admfact/CKEditor/plugins/specialchar/dialogs/lang*/
	mkdir("$admfact/ckeditor/plugins/specialchar/dialogs/lang");
	/**Сканируем папку $puttupadm/CKEditor/plugins/specialchar/dialogs/lang*/
	$editplagspdl=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/plugins/specialchar/dialogs/lang";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $editplagspdl[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/plugins/specialchar/dialogs/lang в
	$admfact/CKEditor/plugins/specialchar/dialogs/lang и удаляем их
	*/
	if(isset($editplagspdl))
	{
	foreach($editplagspdl as $value)
	{if(copy("$puttupadm/ckeditor/plugins/specialchar/dialogs/lang/$value","$admfact/ckeditor/plugins/specialchar/dialogs/lang/$value"))
	unlink("$puttupadm/ckeditor/plugins/specialchar/dialogs/lang/$value");
	}
	}
	/*Копируем $puttupadm/CKEditor/plugins/specialchar/dialogs/specialchar.js в
	$admfact/CKEditor/plugins/specialchar/dialogs/specialchar.js
	*/
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/specialchar/dialogs/specialchar.js*/
	if (copy("$puttupadm/ckeditor/plugins/specialchar/dialogs/specialchar.js","$admfact/ckeditor/plugins/specialchar/dialogs/specialchar.js"))  
	{unlink("$puttupadm/ckeditor/plugins/specialchar/dialogs/specialchar.js");}
	/**Удаляем папку $puttupadm/CKEditor/plugins/specialchar/dialogs/lang*/
	if (file_exists("$admfact/ckeditor/plugins/specialchar/dialogs/lang"))
	{if(rmdir("$puttupadm/ckeditor/plugins/specialchar/dialogs/lang"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/specialchar/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/specialchar/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/specialchar/dialogs/"))clearstatcache();}
	/**Удаляем папку $puttupadm/CKEditor/plugins/specialchar/*/
	if (file_exists("$admfact/ckeditor/plugins/specialchar/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/specialchar/"))clearstatcache();}
	/**Создаем директорию $admfact/CKEditor/plugins/table/*/
	mkdir("$admfact/ckeditor/plugins/table/");
	/**Создаем директорию $admfact/CKEditor/plugins/table/dialogs/*/
	mkdir("$admfact/ckeditor/plugins/table/dialogs/");
	/*Копируем $puttupadm/CKEditor/plugins/table/dialogs/table.js в
	$admfact/CKEditor/plugins/table/dialogs/table.js
	*/
	
	/**Удаляем файл из папки $puttupadm/CKEditor/plugins/table/dialogs/table.js*/
	if (copy("$puttupadm/ckeditor/plugins/table/dialogs/table.js","$admfact/ckeditor/plugins/table/dialogs/table.js"))  
	{unlink("$puttupadm/ckeditor/plugins/table/dialogs/table.js");}
/*Удаляем папку $puttupadm/CKEditor/plugins/table/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/table/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/table/dialogs/"))clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/plugins/table/*/
	if (file_exists("$admfact/ckeditor/plugins/table/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/table/"))clearstatcache();}
/*Создаем директорию $admfact/CKEditor/plugins/tabletools/*/
	mkdir("$admfact/ckeditor/plugins/tabletools/");
/**Создаем директорию $admfact/CKEditor/plugins/tabletools/dialogs/*/
	mkdir("$admfact/ckeditor/plugins/tabletools/dialogs/");
	/*Копируем $puttupadm/CKEditor/plugins/tabletools/dialogs/tableCell.js в
	$admfact/CKEditor/plugins/tabletools/dialogs/tableCell.js
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/tabletools/dialogs/tableCell.js*/
	if (copy("$puttupadm/ckeditor/plugins/tabletools/dialogs/tableCell.js","$admfact/ckeditor/plugins/tabletools/dialogs/tableCell.js"))  
	{unlink("$puttupadm/ckeditor/plugins/tabletools/dialogs/tableCell.js");}
/**Удаляем папку $puttupadm/CKEditor/plugins/tabletools/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/tabletools/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/tabletools/dialogs/"))clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/plugins/tabletools/*/
	if (file_exists("$admfact/ckeditor/plugins/tabletools/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/tabletools/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/plugins/wsc/*/
	mkdir("$admfact/ckeditor/plugins/wsc/");
/*Создаем директорию $admfact/CKEditor/plugins/wsc/dialogs/*/
	mkdir("$admfact/ckeditor/plugins/wsc/dialogs/");
/**Сканируем папку $puttupadm/CKEditor/plugins/wsc/dialogs/*/
	$editplwdl=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/plugins/wsc/dialogs/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $editplwdl[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/plugins/wsc/dialogs/ в
	$admfact/CKEditor/plugins/wsc/dialogs/ и удаляем их
	*/
	if(isset($editplwdl))
	{
	foreach($editplwdl as $value)
	{if(copy("$puttupadm/ckeditor/plugins/wsc/dialogs/$value","$admfact/ckeditor/plugins/wsc/dialogs/$value"))
	unlink("$puttupadm/ckeditor/plugins/wsc/dialogs/$value");
	}
	}
	/*
	Копируем $puttupadm/CKEditor/plugins/wsc/LICENSE.md в
	$admfact/CKEditor/plugins/wsc/LICENSE.md
	Копируем $puttupadm/CKEditor/plugins/wsc/README.md в
	$admfact/CKEditor/plugins/wsc/README.md
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/wsc/LICENSE.md*/
	if (copy("$puttupadm/ckeditor/plugins/wsc/LICENSE.md","$admfact/ckeditor/plugins/wsc/LICENSE.md"))  
	{unlink("$puttupadm/ckeditor/plugins/wsc/LICENSE.md");}
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/wsc/README.md*/
	if (copy("$puttupadm/ckeditor/plugins/wsc/README.md","$admfact/ckeditor/plugins/wsc/README.md"))  
	{unlink("$puttupadm/ckeditor/plugins/wsc/README.md");}
/**Удаляем папку $puttupadm/CKEditor/plugins/wsc/dialogs/*/
	if (file_exists("$admfact/ckeditor/plugins/wsc/dialogs/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/wsc/dialogs/"))clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/plugins/wsc/*/
	if (file_exists("$admfact/ckeditor/plugins/wsc/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/wsc/"))clearstatcache();}
	/*
	Копируем $puttupadm/CKEditor/plugins/icons.png в
	$admfact/CKEditor/plugins/icons.png
	Копируем $puttupadm/CKEditor/plugins/icons_hidpi.png в
	$admfact/CKEditor/plugins/icons_hidpi.png
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/icons.png*/
	if (copy("$puttupadm/ckeditor/plugins/icons.png","$admfact/ckeditor/plugins/icons.png"))  
	{unlink("$puttupadm/ckeditor/plugins/icons.png");}
/**Удаляем файл из папки $puttupadm/CKEditor/plugins/icons_hidpi.png*/
	if (copy("$puttupadm/ckeditor/plugins/icons_hidpi.png","$admfact/ckeditor/plugins/icons_hidpi.png"))  
	{unlink("$puttupadm/ckeditor/plugins/icons_hidpi.png");}
/**Удаляем папку $puttupadm/CKEditor/plugins/*/
	if (file_exists("$admfact/ckeditor/plugins/"))
	{if(rmdir("$puttupadm/ckeditor/plugins/"))clearstatcache();}
/*КОНФИГУРАЦИЯ*/
	/*Создаем директорию $admfact/CKEditor/samples*/
	mkdir("$admfact/ckeditor/samples");
mkdir("$admfact/ckeditor/samples/css");
if (copy("$puttupadm/ckeditor/samples/css/samples.css","$admfact/ckeditor/samples/css/samples.css"))  
	{unlink("$puttupadm/ckeditor/samples/css/samples.css");}
/**Удаляем папку $puttupadm/CKEditor/samples/css/*/
	if (file_exists("$admfact/ckeditor/samples/css/"))
	{if(rmdir("$puttupadm/ckeditor/samples/css/"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/img");
$editplwdl=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/samples/img";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $editplwdl[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/plugins/wsc/dialogs/ в
	$admfact/CKEditor/plugins/wsc/dialogs/ и удаляем их
	*/
	if(isset($editplwdl))
	{
	foreach($editplwdl as $value)
	{if(copy("$puttupadm/ckeditor/samples/img/$value","$admfact/ckeditor/samples/img/$value"))
	unlink("$puttupadm/ckeditor/samples/img/$value");
	}
	}
if (file_exists("$admfact/ckeditor/samples/img/"))
	{if(rmdir("$puttupadm/ckeditor/samples/img/"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/js");
if (copy("$puttupadm/ckeditor/samples/js/sample.js","$admfact/ckeditor/samples/js/sample.js"))  
	{unlink("$puttupadm/ckeditor/samples/js/sample.js");}
if (copy("$puttupadm/ckeditor/samples/js/sf.js","$admfact/ckeditor/samples/js/sf.js"))  
	{unlink("$puttupadm/ckeditor/samples/js/sf.js");}
/**Удаляем папку $puttupadm/CKEditor/samples/*/
	if (file_exists("$admfact/ckeditor/samples/js"))
	{if(rmdir("$puttupadm/ckeditor/samples/js"))clearstatcache();}


mkdir("$admfact/ckeditor/samples/old");
/***Создаем директорию $admfact/CKEditor/samples/assets*/
	mkdir("$admfact/ckeditor/samples/old/assets");
/**Создаем директорию $admfact/CKEditor/samples/old/assets/inlineall*/
	mkdir("$admfact/ckeditor/samples/old/assets/inlineall");
	/*Копируем $puttupadm/CKEditor/samples/old/assets/inlineall/logo.png в
	$admfact/CKEditor/samples/old/assets/inlineall/logo.png
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/assets/inlineall/logo.png*/
	if (copy("$puttupadm/ckeditor/samples/old/assets/inlineall/logo.png","$admfact/ckeditor/samples/old/assets/inlineall/logo.png"))  
	{unlink("$puttupadm/ckeditor/samples/old/assets/inlineall/logo.png");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/assets/inlineall/*/
	if (file_exists("$admfact/ckeditor/samples/old/assets/inlineall/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/assets/inlineall/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/samples/old/assets/outputxhtml*/
	mkdir("$admfact/ckeditor/samples/old/assets/outputxhtml");
	/*Копируем $puttupadm/CKEditor/samples/old/assets/outputxhtml/outputxhtml.css в
	$admfact/CKEditor/samples/old/assets/outputxhtml/outputxhtml.css
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/assets/outputxhtml/outputxhtml.css*/
	if (copy("$puttupadm/ckeditor/samples/old/assets/outputxhtml/outputxhtml.css","$admfact/ckeditor/samples/old/assets/outputxhtml/outputxhtml.css"))  
	{unlink("$puttupadm/ckeditor/samples/old/assets/outputxhtml/outputxhtml.css");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/assets/outputxhtml/*/
	if (file_exists("$admfact/ckeditor/samples/old/assets/outputxhtml/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/assets/outputxhtml/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/samples/old/assets/uilanguages*/
	mkdir("$admfact/ckeditor/samples/old/assets/uilanguages");
	/*Копируем $puttupadm/CKEditor/samples/old/assets/uilanguages/languages.js в
	$admfact/CKEditor/samples/old/assets/uilanguages/languages.js
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/assets//uilanguages/languages.js*/
	if (copy("$puttupadm/ckeditor/samples/old/assets/uilanguages/languages.js","$admfact/ckeditor/samples/old/assets/uilanguages/languages.js"))  
	{unlink("$puttupadm/ckeditor/samples/old/assets/uilanguages/languages.js");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/assets//uilanguages/*/
	if (file_exists("$admfact/ckeditor/samples/old/assets/uilanguages/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/assets/uilanguages/"))clearstatcache();}
	/*Сканируем директорию $puttupadm/CKEditor/samples/old/assets/*/
	$editsmplas=array();/*имя массива*/
	$dr="$puttupadm/ckeditor/samples/old/assets/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $editsmplas[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/samples/old/assets/ в
	$admfact/CKEditor/samples/old/assets/ и удаляем их
	*/
	if(isset($editsmplas))
	{
	foreach($editsmplas as $value)
	{if(copy("$puttupadm/ckeditor/samples/old/assets/$value","$admfact/ckeditor/samples/old/assets/$value"))
	unlink("$puttupadm/ckeditor/samples/old/assets/$value");
	}
	}
/**Удаляем папку $puttupadm/CKEditor/samples/old/assets/*/
	if (file_exists("$admfact/ckeditor/samples/old/assets/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/assets/"))clearstatcache();}
	/*SAMPLES*/

/***Создаем директорию $admfact/CKEditor/samples/old/dialog*/
	mkdir("$admfact/ckeditor/samples/old/dialog");
/**Создаем директорию $admfact/CKEditor/samples/old/dialog/assets/*/
	mkdir("$admfact/ckeditor/samples/old/dialog/assets/");
	/*Копируем $puttupadm/CKEditor/samples/old/dialog/assets/my_dialog.js в
	$admfact/CKEditor/samples/old/dialog/assets/my_dialog.js
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/dialog/assets/my_dialog.js*/
	if (copy("$puttupadm/ckeditor/samples/old/dialog/assets/my_dialog.js","$admfact/ckeditor/samples/old/dialog/assets/my_dialog.js"))  
	{unlink("$puttupadm/ckeditor/samples/old/dialog/assets/my_dialog.js");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/dialog/assets*/
	if (file_exists("$admfact/ckeditor/samples/old/dialog/assets"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/dialog/assets"))clearstatcache();}
	/*Копируем $puttupadm/CKEditor/samples/old/dialog/dialog.html в
	$admfact/CKEditor/samples/old/dialog/dialog.html
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/dialog/dialog.html*/
	if (copy("$puttupadm/ckeditor/samples/old/dialog/dialog.html","$admfact/ckeditor/samples/old/dialog/dialog.html"))  
	{unlink("$puttupadm/ckeditor/samples/old/dialog/dialog.html");}
/*Удаляем папку $puttupadm/CKEditor/samples/old/dialog/*/
	if (file_exists("$admfact/ckeditor/samples/old/dialog/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/dialog/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/samples/old/enterkey/*/
	mkdir("$admfact/ckeditor/samples/old/enterkey/");
	/*Копируем $puttupadm/CKEditor/samples/old/enterkey/enterkey.html в
	$admfact/CKEditor/samples/old/enterkey/enterkey.html
	*/
	if (copy("$puttupadm/ckeditor/samples/old/enterkey/enterkey.html","$admfact/ckeditor/samples/old/enterkey/enterkey.html"))  
	{unlink("$puttupadm/ckeditor/samples/old/enterkey/enterkey.html");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/enterkey*/
	if (file_exists("$admfact/ckeditor/samples/old/enterkey"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/enterkey"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/samples/old/htmlwriter/*/
	mkdir("$admfact/ckeditor/samples/old/htmlwriter/");
/**Создаем директорию $admfact/CKEditor/samples/old/htmlwriter/assets/*/
	mkdir("$admfact/ckeditor/samples/old/htmlwriter/assets/");
/**Создаем директорию $admfact/CKEditor/samples/old/htmlwriter/assets/outputforflash*/
	mkdir("$admfact/ckeditor/samples/old/htmlwriter/assets/outputforflash");
	/*Сканируем директорию $puttupadm/CKEditor/samples/old/htmlwriter/assets/outputforflash*/
	$edflash=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/samples/old/htmlwriter/assets/outputforflash";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edflash[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/samples/old/htmlwriter/assets/outputforflash в
	$admfact/CKEditor/samples/old/htmlwriter/assets/outputforflash и удаляем их
	*/
	if(isset($edflash))
	{
	foreach($edflash as $value)
	{if(copy("$puttupadm/ckeditor/samples/old/htmlwriter/assets/outputforflash/$value","$admfact/ckeditor/samples/old/htmlwriter/assets/outputforflash/$value"))
	unlink("$puttupadm/ckeditor/samples/old/htmlwriter/assets/outputforflash/$value");
	}
	}
/**Удаляем папку $puttupadm/CKEditor/samples/old/htmlwriter/assets/outputforflash*/
	if (file_exists("$admfact/ckeditor/samples/old/htmlwriter/assets/outputforflash"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/htmlwriter/assets/outputforflash"))clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/samples/old/htmlwriter/assets/*/
	if (file_exists("$admfact/ckeditor/samples/old/htmlwriter/assets/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/htmlwriter/assets/"))clearstatcache();}
	/*Сканируем директорию $puttupadm/CKEditor/samples/old/htmlwriter/*/
	$edhtwrt=array();
/*имя массива*/
$dr="$puttupadm/ckeditor/samples/old/htmlwriter/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edhtwrt[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/samples/old/htmlwriter/ в
	$admfact/CKEditor/samples/old/htmlwriter/ и удаляем их
	*/
	if(isset($edhtwrt))
	{
	foreach($edhtwrt as $value)
	{if(copy("$puttupadm/ckeditor/samples/old/htmlwriter/$value","$admfact/ckeditor/samples/old/htmlwriter/$value"))
	unlink("$puttupadm/ckeditor/samples/old/htmlwriter/$value");
	}
	}
unset($edhtwrt);
/**Удаляем папку $puttupadm/CKEditor/samples/old/htmlwriter/*/
	if (file_exists("$admfact/ckeditor/samples/old/htmlwriter/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/htmlwriter/"))clearstatcache();}
/**Создаем директорию $admfact/CKEditor/samples/old/magicline/*/
	mkdir("$admfact/ckeditor/samples/old/magicline/");
	/*Копируем $puttupadm/CKEditor/samples/old/magicline/magicline.html в
	$admfact/CKEditor/samples/old/magicline/magicline.html
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/magicline/magicline.html*/
	if (copy("$puttupadm/ckeditor/samples/old/magicline/magicline.html","$admfact/ckeditor/samples/old/magicline/magicline.html"))  
	{unlink("$puttupadm/ckeditor/samples/old/magicline/magicline.html");clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/samples/old/magicline/*/
	if (file_exists("$admfact/ckeditor/samples/old/magicline/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/magicline/"))clearstatcache();}
	//**Создаем директорию $admfact/CKEditor/samples/old/toolbar/*/
	mkdir("$admfact/ckeditor/samples/old/toolbar/");
	/*Копируем $puttupadm/CKEditor/samples/old/toolbar/toolbar.html в
	$admfact/CKEditor/samples/old/toolbar/toolbar.html
	*/
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/toolbar/toolbar.html*/
	if (copy("$puttupadm/ckeditor/samples/old/toolbar/toolbar.html","$admfact/ckeditor/samples/old/toolbar/toolbar.html"))  
	{unlink("$puttupadm/ckeditor/samples/old/toolbar/toolbar.html");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/toolbar/*/
	if(rmdir("$puttupadm/ckeditor/samples/old/toolbar/"))clearstatcache();
/**Создаем директорию $admfact/CKEditor/samples/old/wysiwygarea*/
	mkdir("$admfact/ckeditor/samples/old/wysiwygarea");
	/*Копируем $puttupadm/CKEditor/samples/old/wysiwygarea/fullpage.html в
	$admfact/CKEditor/samples/old/wysiwygarea/fullpage.html
	*/
	
/**Удаляем файл из папки $puttupadm/CKEditor/samples/old/wysiwygarea/fullpage.html*/
	if (copy("$puttupadm/ckeditor/samples/old/wysiwygarea/fullpage.html","$admfact/ckeditor/samples/old/wysiwygarea/fullpage.html"))  
	{unlink("$puttupadm/ckeditor/samples/old/wysiwygarea/fullpage.html");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/wysiwygarea/*/
	if (file_exists("$admfact/ckeditor/samples/old/wysiwygarea/"))
	{if(rmdir("$puttupadm/ckeditor/samples/old/wysiwygarea/"))clearstatcache();}
/*СКАНИРУЕМ, КОПИРУЕМ,УДАЛЯЕМ samples/old*/

/*Сканируем директорию $puttupadm/CKEditor/samples/*/
	$edsamp=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/samples/old/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edsamp[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/samples/ в
	$admfact/CKEditor/samples/ и удаляем их
	*/
	if(isset($edsamp))
	{
	foreach($edsamp as $value)
	{if(copy("$puttupadm/ckeditor/samples/old/$value","$admfact/ckeditor/samples/old/$value"))
	unlink("$puttupadm/ckeditor/samples/old/$value");
	}
	}
/**Удаляем папку $puttupadm/CKEditor/samples/old*/
	if (file_exists("$admfact/ckeditor/samples/old"))
	{if(rmdir("$puttupadm/ckeditor/samples/old"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/toolbarconfigurator");
mkdir("$admfact/ckeditor/samples/toolbarconfigurator/css");
if (copy("$puttupadm/ckeditor/samples/toolbarconfigurator/css/fontello.css","$admfact/ckeditor/samples/toolbarconfigurator/css/fontello.css"))  
	{unlink("$puttupadm/ckeditor/samples/toolbarconfigurator/css/fontello.css");}
/**Удаляем папку $puttupadm/CKEditor/samples/old/wysiwygarea/*/
	if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator/css/"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator/css"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/toolbarconfigurator/font");
$dr="$puttupadm/ckeditor/samples/toolbarconfigurator/font";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edtool[]=$tem;}
/*Копируем файлы из $puttupadm/CKEditor/samples/toolbarconfigurator/font в $admfact/CKEditor/samples/toolbarconfigurator/font и удаляем их*/
	if(isset($edtool))
	{
	foreach($edtool as $value)
	{if(copy("$puttupadm/ckeditor/samples/toolbarconfigurator/font/$value","$admfact/ckeditor/samples/toolbarconfigurator/font/$value"))
	unlink("$puttupadm/ckeditor/samples/toolbarconfigurator/font/$value");
	}
	}
/**Удаляем папку $puttupadm/CKEditor/samples/toolbarconfigurator/font*/
	if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator/font"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator/font"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/toolbarconfigurator/js");
$dr="$puttupadm/ckeditor/samples/toolbarconfigurator/js";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edtoollib[]=$tem;}
/*Копируем файлы из $puttupadm/CKEditor/samples/toolbarconfigurator/js в $admfact/CKEditor/samples/toolbarconfigurator/js и удаляем их*/
	if(isset($edtoollib))
	{
	foreach($edtoollib as $value)
	{if(copy("$puttupadm/ckeditor/samples/toolbarconfigurator/js/$value","$admfact/ckeditor/samples/toolbarconfigurator/js/$value"))
	unlink("$puttupadm/ckeditor/samples/toolbarconfigurator/js/$value");
	}
	}
unset($edtoollib);
/**Удаляем папку $puttupadm/CKEditor/samples/toolbarconfigurator/js*/
	if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator/js"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator/js"))clearstatcache();}
mkdir("$admfact/ckeditor/samples/toolbarconfigurator/lib");
mkdir("$admfact/ckeditor/samples/toolbarconfigurator/lib/codemirror");
$dr="$puttupadm/ckeditor/samples/toolbarconfigurator/lib/codemirror";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edmirr[]=$tem;}
/*Копируем файлы из $puttupadm/CKEditor/samples/toolbarconfigurator/font в $admfact/CKEditor/samples/toolbarconfigurator/font и удаляем их*/
	if(isset($edmirr))
	{
	foreach($edmirr as $value)
	{if(copy("$puttupadm/ckeditor/samples/toolbarconfigurator/lib/codemirror/$value","$admfact/ckeditor/samples/toolbarconfigurator/lib/codemirror/$value"))
	unlink("$puttupadm/ckeditor/samples/toolbarconfigurator/lib/codemirror/$value");
	}
	}
unset($edmirr);
/**Удаляем папку $puttupadm/CKEditor/samples/toolbarconfigurator/lib/codemirror*/
	if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator/lib/codemirror"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator/lib/codemirror"))clearstatcache();}
if(copy("$puttupadm/ckeditor/samples/toolbarconfigurator/index.html","$admfact/ckeditor/samples/toolbarconfigurator/index.html"))
	unlink("$puttupadm/ckeditor/samples/toolbarconfigurator/index.html");
if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator/lib/"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator/lib/"))clearstatcache();}
if (file_exists("$admfact/ckeditor/samples/toolbarconfigurator"))
	{if(rmdir("$puttupadm/ckeditor/samples/toolbarconfigurator"))clearstatcache();}
if(copy("$puttupadm/ckeditor/samples/index.html","$admfact/ckeditor/samples/index.html"))
	unlink("$puttupadm/ckeditor/samples/index.html");

if (file_exists("$admfact/ckeditor/samples"))
	{if(rmdir("$puttupadm/ckeditor/samples"))clearstatcache();}
	/*SKINS*/
	/***Создаем директорию $admfact/CKEditor/skins*/
	mkdir("$admfact/ckeditor/skins");
/***Создаем директорию $admfact/CKEditor/skins/moono*/
	mkdir("$admfact/ckeditor/skins/moono");
/***Создаем директорию $admfact/CKEditor/skins/moono/images*/
	mkdir("$admfact/ckeditor/skins/moono/images");
/***Создаем директорию $admfact/CKEditor/skins/moono/images/hidpi*/
	mkdir("$admfact/ckeditor/skins/moono/images/hidpi");
	/*Сканируем директорию $puttupadm/CKEditor/skins/moono/images/hidpi*/
	/*Копируем файлы из $puttupadm/CKEditor/skins/moono/images/hidpi в
	$admfact/CKEditor/skins/moono/images/hidpi и удаляем их
	*/
	$edskmoo=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/skins/moono/images/hidpi";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edskmoo[]=$tem;}
		if(isset($edskmoo))
		{
		foreach ($edskmoo as $value)
		{
		if(copy("$puttupadm/ckeditor/skins/moono/images/hidpi/$value","$admfact/ckeditor/skins/moono/images/hidpi/$value"))
		{unlink("$puttupadm/ckeditor/skins/moono/images/hidpi/$value");
		clearstatcache();}
		}
		}
/**Удаляем папку $puttupadm/CKEditor/skins/moono/images/*/
if (file_exists("$admfact/ckeditor/skins/moono/images/hidpi"))
{if(rmdir("$puttupadm/ckeditor/skins/moono/images/hidpi"))clearstatcache();}
/*Сканируем директорию $puttupadm/CKEditor/skins/moono/images/*/
	$edskmim=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/skins/moono/images/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edskmim[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/skins/moono/images/ в
	$admfact/CKEditor/skins/moono/images/ и удаляем их
	*/
	if(isset($edskmim))
	{
	foreach($edskmim as $value)
	{if(copy("$puttupadm/ckeditor/skins/moono/images/$value","$admfact/ckeditor/skins/moono/images/$value"))
	{unlink("$puttupadm/ckeditor/skins/moono/images/$value");
	clearstatcache();
	
}}
	}
/**Удаляем папку $puttupadm/CKEditor/skins/moono/images/*/
	if (file_exists("$admfact/ckeditor/skins/moono/images/"))
	{if(rmdir("$puttupadm/ckeditor/skins/moono/images/"))clearstatcache();}
/*Сканируем директорию $puttupadm/CKEditor/skins/moono/*/
	$edskm=array();//имя массива
	$dr="$puttupadm/ckeditor/skins/moono/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edskm[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/skins/moono/ в
	$admfact/CKEditor/skins/moono/ и удаляем их
	*/
	if(isset($edskm))
	{
	foreach($edskm as $value)
	{if(copy("$puttupadm/ckeditor/skins/moono/$value","$admfact/ckeditor/skins/moono/$value"))
	{unlink("$puttupadm/ckeditor/skins/moono/$value");
	clearstatcache();
	
}
	}
	}
/**Удаляем папку $puttupadm/CKEditor/skins/moono/*/
	if (file_exists("$admfact/ckeditor/skins/moono/"))
	{if(rmdir("$puttupadm/ckeditor/skins/moono/"))clearstatcache();}
/**Удаляем папку $puttupadm/CKEditor/skins/*/
	if (file_exists("$admfact/ckeditor/skins/"))
	{if(rmdir("$puttupadm/ckeditor/skins/"))clearstatcache();}
	/*Сканируем директорию $puttupadm/CKEditor/*/
	$edall=array();
/*имя массива*/
	$dr="$puttupadm/ckeditor/";
/*сканируемая директория*/
	$skip = array('.', '..');
/*удаляем точки*/
$sh = scandir($dr);
/*сканируем и в цикле создаем массив элементов директории*/
foreach($sh as $tem) {
    if(!in_array($tem, $skip))
        $edall[]=$tem;}
	/*Копируем файлы из $puttupadm/CKEditor/ в
	$admfact/CKEditor/ и удаляем их
	*/
	if(isset($edall))
	{
	foreach($edall as $value)
	{if(copy("$puttupadm/ckeditor/$value","$admfact/ckeditor/$value"))
	unlink("$puttupadm/ckeditor/$value");
	}
	}
	/**Удаляем папку $puttupadm/CKEditor/*/
	if (file_exists("$admfact/ckeditor/"))
	{if(rmdir("$puttupadm/ckeditor/"))clearstatcache();
	echo "Редактор готов!";echo "<h2>5!&nbsp;&nbsp;&nbsp;</h2>";}
	/*Создаем директорию $admfact/common*/
	mkdir("$admfact/common");
	//сканируем $puttupadm/common
	if(file_exists("$admfact/common/"))
{/*Формируем массив*/ 
	$admcomz=array();
	$dr="$puttupadm/common/";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $admcomz[]=$shmod;
}	
}	
	/*Копируем и удаляем $puttupadm/common*/
	foreach($admcomz as $value)
	{if(copy("$puttupadm/common/$value","$admfact/common/$value"))
	{unlink("$puttupadm/common/$value");clearstatcache();}
	}
	/*Удаляем папку $puttupadm/common*/
	if (file_exists("$admfact/common"))
	{rmdir("$puttupadm/common"); clearstatcache();}
	/*Создаем директорию $admfact/book*/
	mkdir("$admfact/book");
	/*сканируем $puttupadm/book*/
	if (file_exists("$admfact/book"))
{//Формируем массив
	$admcntz=array();
	$dr="$puttupadm/book";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $admcntz[]=$shmod;
}	
}		
	/*Копируем и удаляем $puttupadm/book*/
	foreach($admcntz as $value)
	{if(copy("$puttupadm/book/$value","$admfact/book/$value"))
	unlink("$puttupadm/book/$value");clearstatcache();
	}
	/*Удаляем папку $puttupadm/book*/
	if (file_exists("$admfact/book"))
	{rmdir("$puttupadm/book"); clearstatcache();}
/*Создаем директорию $admfact/images*/
	mkdir("$admfact/images");
	/*сканируем $puttupadm/images*/
	if (file_exists("$admfact/images"))
{//Формируем массив
	$admimg=array();
	$dr="$puttupadm/images";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $admimg[]=$shmod;
}	
}		
	/*Копируем и удаляем $puttupadm/images*/
	foreach($admimg as $value)
	{if(copy("$puttupadm/images/$value","$admfact/images/$value"))
	unlink("$puttupadm/images/$value");clearstatcache();
	}
	/*Удаляем папку $puttupadm/images*/
	if (file_exists("$admfact/images"))
	{rmdir("$puttupadm/images"); clearstatcache();}
//Настройки
mkdir("$admfact/set");if(copy("$puttupadm/set/main.php","$admfact/set/main.php"))
	unlink("$puttupadm/set/main.php");
if(copy("$puttupadm/set/mdObr.php","$admfact/set/mdObr.php"))
	unlink("$puttupadm/set/mdObr.php");
if (file_exists("$admfact/set"))
	{
	rmdir("$puttupadm/set");clearstatcache();
}
//Library
	mkdir("$admfact/lib");
/*Файлы $puttupadm/lib/library.php !!$admfact/lib/library.php*/
	if(copy("$puttupadm/lib/library.php","$admfact/lib/library.php"))
	unlink("$puttupadm/lib/library.php");
if(copy("$puttupadm/lib/javascriptadm.js","$admfact/lib/javascriptadm.js"))
	unlink("$puttupadm/lib/javascriptadm.js");
if(copy("$puttupadm/lib/skan.php","$admfact/lib/skan.php"))
	unlink("$puttupadm/lib/skan.php");
if (file_exists("$admfact/lib"))
	{
	rmdir("$puttupadm/lib");clearstatcache();
}
if (!file_exists("$admfact/lib/pclzip"))
		mkdir("$admfact/lib/pclzip");
	if(copy("pclzip/gnu-lgpl.txt","$admfact/lib/pclzip/gnu-lgpl.txt"))
	{unlink("pclzip/gnu-lgpl.txt");
	}
	if(copy("pclzip/pclzip.lib.php","$admfact/lib/pclzip/pclzip.lib.php"))
	{unlink("pclzip/pclzip.lib.php");
	}
	if(copy("pclzip/readme.txt","$admfact/lib/pclzip/readme.txt"))	
	
	{ unlink("pclzip/readme.txt");
	}
	if (file_exists("pclzip"))
		{rmdir("pclzip");clearstatcache();
		}
	//Создаем директорию $admfact/menu
	mkdir("$admfact/menu");
	//Создаем директорию $admfact/menu/menucom
	mkdir("$admfact/menu/menucommon");
	/*Копируем и удаляем $puttupadm/menu/menucom/menuside.php*/
	if(copy("$puttupadm/menu/menucommon/menuside.php","$admfact/menu/menucommon/menuside.php"))
	unlink("$puttupadm/menu/menucommon/menuside.php");
	//Удаляем $puttupadm/menu/menucom/
	if (file_exists("$admfact/menu/menucommon/"))
{rmdir("$puttupadm/menu/menucommon/"); clearstatcache();}
	//Создаем директорию $admfact/menu/menuset
	mkdir("$admfact/menu/menuset");
	/*Копируем и удаляем $puttupadm/menu/menuset/menuside.php*/
	if(copy("$puttupadm/menu/menuset/menuside.php","$admfact/menu/menuset/menuside.php"))
	unlink("$puttupadm/menu/menuset/menuside.php");
	//Удаляем $puttupadm/menu/menuset/
	if (file_exists("$admfact/menu/menuset/"))
{rmdir("$puttupadm/menu/menuset/"); clearstatcache();}
	//Создаем директорию $admfact/menu/menubook
	mkdir("$admfact/menu/menubook");
	/*Копируем и удаляем $puttupadm/menu/menubook/menuside.php*/
	if(copy("$puttupadm/menu/menubook/menuside.php","$admfact/menu/menubook/menuside.php"))
	unlink("$puttupadm/menu/menubook/menuside.php");
	//Удаляем $puttupadm/menu/menubook/
	if (file_exists("$admfact/menu/menubook/"))
{rmdir("$puttupadm/menu/menubook/"); clearstatcache();}
	//Создаем директорию $admfact/menu/topmenu
	mkdir("$admfact/menu/topmenu");
	/*Копируем и удаляем $puttupadm/menu/topmenu/topmenu.php*/
	if(copy("$puttupadm/menu/topmenu/topmenu.php","$admfact/menu/topmenu/topmenu.php"))
	unlink("$puttupadm/menu/topmenu/topmenu.php");
	//Удаляем $puttupadm/menu/topmenu/
	if (file_exists("$admfact/menu/topmenu/"))
{rmdir("$puttupadm/menu/topmenu/"); clearstatcache();}
	//Удаляем $puttupadm/menu/
	if (file_exists("$admfact/menu/"))
	{rmdir("$puttupadm/menu/"); clearstatcache();}
	//Создаем директорию $admfact/template
	mkdir("$admfact/template");
	//Создаем директорию $admfact/template/admin
	mkdir("$admfact/template/admin");
	//Создаем директорию $admfact/template/admin/css
	mkdir("$admfact/template/admin/css");
	/*Копируем и удаляем $puttupadm/template/admin/css/admin.css*/
	if(copy("$puttupadm/template/admin/css/admin.css","$admfact/template/admin/css/admin.css"))
	unlink("$puttupadm/template/admin/css/admin.css");
	//Удаляем $puttupadm/template/admin/css/
	if (file_exists("$admfact/template/admin/css/"))
	{rmdir("$puttupadm/template/admin/css/"); clearstatcache();}
	/*Копируем и удаляем $puttupadm/template/admin/admin.php*/
	if(copy("$puttupadm/template/admin/admin.php","$admfact/template/admin/admin.php"))
	unlink("$puttupadm/template/admin/admin.php");
	
	//Удаляем $puttupadm/template/admin
	if (file_exists("$admfact/template/admin"))
	{rmdir("$puttupadm/template/admin"); clearstatcache();}
	//Удаляем $puttupadm/template
	if (file_exists("$admfact/template"))
	{rmdir("$puttupadm/template"); clearstatcache();}
	//Сканируем $puttupadm/
	if (file_exists("$puttupadm"))
{//Формируем массив 
	$admall=array();
	$dr="$puttupadm/";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $admall[]=$shmod;
}	
}		
	//Копируем и удаляем файлы $puttupadm/
	foreach($admall as $value)
	{if(copy("$puttupadm/$value","$admfact/$value"))
	unlink("$puttupadm/$value");clearstatcache();
	}
	
	
	if (file_exists("$upfile"))
	unlink($upfile);
	if (file_exists("$puttupadm"))
	if(rmdir($puttupadm))
	echo "Админка готова!";echo "<h2>4!&nbsp;&nbsp;&nbsp;</h2>";
	//Грузим сайт
	//Путь - откуда грузим
	//Путь - куда грузим
	//Определяем директорию из которой ведется загрузка
	$puttup="kalinka";
	

//Папка common- СОЗДАТЬ ../common
	mkdir("../common");
/*Копировать и удалять файлы $puttup/common/modulen.txt*/
//сканируем $puttupadm/common
	if(file_exists("$puttup/common/"))
{/*Формируем массив*/ 
	$comz=array();
	$dr="$puttup/common/";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $comz[]=$shmod;
}	
}	
	/*Копируем и удаляем $puttupadm/common*/
	foreach($comz as $value)
	{if(copy("$puttup/common/$value","../common/$value"))
	{unlink("$puttup/common/$value");clearstatcache();}
	}
	/*Удаляем папку $puttupadm/common*/
	if (file_exists("../common"))
	{rmdir("$puttup/common"); clearstatcache();}
	/*Создаем директорию $admfact/book*/
	mkdir("../book");


	//Папка images - СОЗДАТЬ ../images
	mkdir("../images");

/*Файл $puttup/images/kalinka_log.png - ../images/kalinka_log.png*/
	if(copy("$puttup/images/kalinalogtp.png","../images/kalinalogtp.png"))
	unlink("$puttup/images/kalinalogtp.png");
if(copy("$puttup/images/CART.png","../images/CART.png"))
	unlink("$puttup/images/CART.png");
	//УДАЛИТЬ папку $puttup/images/
	if (file_exists("../images/kalinalogtp.png"))
	{
	rmdir("$puttup/images/");clearstatcache();
	}
	
	//Папка lib/jquery - СОЗДАТЬ ../lib/jquery
mkdir("../lib");	
mkdir("../lib/jquery");
	
	//Файл $puttup/lib/jquery/jquery-1.12.0.min.js - ../lib/jquery/jquery-3.1.1.min.js
	if(copy("$puttup/lib/jquery/jquery-3.1.1.min.js","../lib/jquery/jquery-3.1.1.min.js"))
	unlink("$puttup/lib/jquery/jquery-3.1.1.min.js");
	
if(copy("$puttup/lib/javascript.js","../lib/javascript.js"))
	unlink("$puttup/lib/javascript.js");
if(copy("$puttup/lib/library.php","../lib/library.php"))
	unlink("$puttup/lib/library.php");
	if (file_exists("../lib/jquery"))
	{
	rmdir("$puttup/lib/jquery");clearstatcache();
}
	//УДАЛИТЬ папку $puttup/lib
	if (file_exists("../lib"))
	{
	rmdir("$puttup/lib");clearstatcache();
}
	//Папка menu/- СОЗДАТЬ ../menu/
	mkdir("../menu/");
	//Папка menu/menusimple/- СОЗДАТЬ ../menu/menusimple/
	mkdir("../menu/menusimple/");
	//Файлы $puttup/menu/menusimple/menuside.php - ../menu/menuside/menusimple.php
	if(copy("$puttup/menu/menusimple/menuside.php","../menu/menusimple/menuside.php"))
	unlink("$puttup/menu/menusimple/menuside.php");
	//УДАЛИТЬ папку$puttup/menu/menusimple
	if (file_exists("../menu/menusimple"))
	{
	rmdir("$puttup/menu/menusimple/");clearstatcache();
}
	//Папка menu/topmenu- СОЗДАТЬ ../menu/topmenu
	mkdir("../menu/topmenu");
	
	
	if(copy("$puttup/menu/topmenu/topmenu.php","../menu/topmenu/topmenu.php"))
	unlink("$puttup/menu/topmenu/topmenu.php");
	
	//УДАЛИТЬ папку $puttup/menu/topmenu/
if (file_exists("../menu/topmenu/"))
{
rmdir("$puttup/menu/topmenu/");clearstatcache();}
	//УДАЛИТЬ папку $puttup/menu/
	if (file_exists("../menu/"))
	{
	rmdir("$puttup/menu/");clearstatcache();}
	//Папка modul- СОЗДАТЬ ../modul
	mkdir("../modul");

	//Папка modul/modcreg- СОЗДАТЬ $saitfact/modul/modcreg
	mkdir("../modul/modcreg");

	if(copy("$puttup/modul/modcreg/def.php","../modul/modcreg/def.php"))
	unlink("$puttup/modul/modcreg/def.php");

	//УДАЛИТЬ папку $puttup/modul/modcreg
	if (file_exists("../modul/modcreg"))
	{
	rmdir("$puttup/modul/modcreg");clearstatcache();}
//Папка modul/mdObr- СОЗДАТЬ $saitfact/modul/mdObr
	mkdir("../modul/mdObr");

	if(copy("$puttup/modul/mdObr/def.php","../modul/mdObr/def.php"))
	unlink("$puttup/modul/mdObr/def.php");

	//УДАЛИТЬ папку $puttup/modul/modcreg
	if (file_exists("../modul/mdObr"))
	{
	rmdir("$puttup/modul/mdObr");clearstatcache();}

	//УДАЛИТЬ папку $puttup/modul
	if (file_exists("../modul"))
	{
	rmdir("$puttup/modul");clearstatcache();}

//Папка template -СОЗДАТЬ ../template
mkdir("../template");
//Папка template -СОЗДАТЬ ../template/simple
mkdir("../template/simple");

//Копировать и удалять Файл $puttup/template/simple/style.css
if (copy("$puttup/template/simple/style.css","../template/simple/style.css"))
unlink("$puttup/template/simple/style.css");

//Папка maket -СОЗДАТЬ ../template/simple/maket
mkdir("../template/simple/maket");
//Копировать и удалять Файл $puttup/template/simple/maket/maket_simple.php
if(copy("$puttup/template/simple/maket/maket_simple.php","../template/simple/maket/maket_simple.php"))
unlink("$puttup/template/simple/maket/maket_simple.php");
if(copy("$puttup/template/simple/maket/lazur1.jpg","../template/simple/maket/lazur1.jpg"))
unlink("$puttup/template/simple/maket/lazur1.jpg");
//УДАЛИТЬ папку $puttup/template/simple/maket
if (file_exists("../template/simple/maket"))
	{
	rmdir("$puttup/template/simple/maket");clearstatcache();
}
//Копировать и удалять Файл $puttup/template/simple/mainfile.php	
if(copy("$puttup/template/simple/mainfile.php","../template/simple/mainfile.php"))
unlink("$puttup/template/simple/mainfile.php");
//УДАЛИТЬ папку $puttup/template/simple/
if (file_exists("../template/simple/"))
	{
	rmdir("$puttup/template/simple/");clearstatcache();
}
//УДАЛИТЬ папку $puttup/template/
	if (file_exists("../template/"))
	{
	rmdir("$puttup/template/");clearstatcache();
}
	//Сканировать папку $puttup
	if (file_exists("$puttup"))
{//Формируем массив 
	$Zst=array();
	$dr="$puttup";
	$skip = array('.', '..');
$mdsh = scandir($dr);
foreach($mdsh as $shmod) {
    if(!in_array($shmod, $skip))
        $Zst[]=$shmod;
}	
}		
	//Копировать и удалять Файлы
	if(isset($Zst))
	{
	foreach ($Zst as $value)
if(copy("$puttup/$value","../$value"))
	unlink("$puttup/$value");
	}
	//УДАЛИТЬ папку $puttup
	 if (file_exists("../index.php"))
	{
	rmdir("$puttup/");clearstatcache();
}
	 
if (!file_exists("../variables")) mkdir("../variables"); //В начало  

 //Записываем заголовок в папку переменных
$fl8="$"."heading";//В начало
if (touch('../variables/variables.php'))
{$fp = fopen( "../variables/variables.php", "w+")or die ( "Не удалось открыть файл" );
fputs( $fp, "<?php  if (!defined('BUGIT')) exit ('Ошибка соединения');
$fl8='$sait'; ?>");
fclose( $fp );}
$fl7="$"."logotype";//В начало$
if (touch('../variables/logotype.php'))
{$fp = fopen( "../variables/logotype.php", "w+")or die ( "Не удалось открыть файл" );
fputs( $fp, "<?php  if(!defined('BUGIT')) exit ('Ошибка соединения');
$fl7='kalinalogtp.png'; ?>");
fclose( $fp );}

	 //Записываем шаблон
	 $fle="$"."osnova";//В начало
if (touch('../variables/vartempl.php'))
{$fp = fopen( "../variables/vartempl.php", "w+")or die ( "Не удалось открыть файл" );
fputs( $fp, "<?php if (!defined('BUGIT')) exit ('Ошибка соединения');$fle='simple'; ?>");
fclose( $fp );}
	//Переход к созданию БД (start.php)
	echo "<h2>Сайт подготовлен</h2>";echo "<h2>3!&nbsp;&nbsp;&nbsp;</h2>";
	
	//Передаем в форме $sait на всякий случай
	if (file_exists("../variables/vartempl.php"))
	//Переход  скрипту start
	{
	echo "<h3>Запишите для себя все вводимые данные! Данные шифруются!</h3>";
	
	echo "<form action='start.php' method='POST'>";
	echo '<p>Логин администратора сайта. </p>
 <p><input type="text" name="loginpolz" value="" required ></input></p>
 <p>Введите адрес электронной почты администратора сайта</p>
 <p><input type="email" name="email" value="" required ></input></p>
 <p>Введите номер сотового телефона администратора, если считаете нужным</p>
 <p>в формате +7ХХХХХХХХХХ- +7 и 10 цифр номера подряд</p>
 <p><input type="tel" name="tel" value="" pattern="+7[0-9]{10}" ></input></p>
 <p><input type="hidden" name="gruppa" value="1" readonly ></input></p>
 <p>Введите пароль администратора сайта.Рекомендуется ввести значение,
 которое отличается от пароля пользователя БД</p>
 <p><input type="password" name="passw" value="" required ></input></p>
 <p>Повторите пароль.</p>
 <p><input type="password" name="repassw" value="" required ></input></p>';
	echo '<p><input type="submit" name="buttbd" value="Далее!"></input></p>';
	echo "</form>";
}
		?>
		</body></html>

