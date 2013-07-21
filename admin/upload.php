<?php
session_start();
if (!$_SESSION['admin']) { Header("Location: index.php"); exit; }
?>
<?php
//проверяем загрузку файла на наличие ошибок
if($_FILES['uploadfile']['error'] > 0)
{
 //в зависимости от номера ошибки выводим соответствующее сообщение
 //UPLOAD_MAX_FILE_SIZE - значение установленное в php.ini
 //MAX_FILE_SIZE значение указанное в html-форме загрузки файла
 switch ($_FILES['uploadfile']['error'])
 {
 case 1: echo 'File size exceeds the limit UPLOAD_MAX_FILE_SIZE.'; break;
 case 2: echo 'File size exceeds the limit MAX_FILE_SIZE.'; break;
 case 3: echo 'Failed to download the file.'; break;
 case 4: echo 'No file was uploaded.'; break;
 case 6: echo 'No temporary folder.'; break;
 case 7: echo 'Failed to write file to disk.'; break;
 case 8: echo 'PHP-extension stop file download.'; break;
 }
 exit;
} 
 
//проверяем не является ли загружаемый файл php скриптом,
//при необходимости можете дописать нужные типы файлов
$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html");
foreach ($blacklist as $item)
{
 if(preg_match("/$item\$/i", $_FILES['uploadfile']['name']))
 {
 echo "You can not load scripts.";
 exit;
 }
}
 
//проверяем MIME-тип файла
if($_FILES['uploadfile']['type'] != 'application/zip')
{
 echo 'Are you trying to download the zip file is not.';
 exit;
}

//папка для загрузки
$uploaddir = '../nightly/';
//новое сгенерированное имя файла
$newFileName=date('F j, Y, H:i:s').rand(10,100).'.zip';
//путь к файлу (папка.файл)
$uploadfile = $uploaddir.$newFileName;

//загружаем файл move_uploaded_file
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile))
echo "The selected file is loaded.\n";
else
echo "Error loading file.\n";
?>
