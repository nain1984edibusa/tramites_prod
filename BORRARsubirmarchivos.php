<?php
if(isset($_FILES['archivo1']['tmp_name'])){
echo $_FILES['archivo1']['tmp_name'];
echo $_FILES['archivo2']['tmp_name'];

$fileTmpPath = $_FILES['archivo1']['tmp_name'];
$fileName = $_FILES['archivo1']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
$uploadFileDir = './upload/';
$dest_path = $uploadFileDir . $newFileName;
if(move_uploaded_file($fileTmpPath, $dest_path))
{
  $message ='File is successfully uploaded.';
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}

$fileTmpPath = $_FILES['archivo2']['tmp_name'];
$fileName = $_FILES['archivo2']['name'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
$uploadFileDir = './upload/';
$dest_path = $uploadFileDir . $newFileName;
if(move_uploaded_file($fileTmpPath, $dest_path))
{
  $message ='File is successfully uploaded.';
}
else
{
  $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
}
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form enctype="multipart/form-data" id="formuploadajax" method="post" action="subirmarchivos.php">
        Nombre: <input type="text" name="nombre" placeholder="Escribe tu nombre">
        <br />
        <input  type="file" id="archivo1" name="archivo1"/>
        <br />
        <input  type="file" id="archivo2" name="archivo2"/>
        <br />
        <input type="submit" value="Subir archivos"/>
</form>

