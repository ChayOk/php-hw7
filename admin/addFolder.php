<?php
$destPath = $_POST['folderName'];
$folder = $_POST['folder'];
if (!(file_exists($destPath))) {
    mkdir($folder.'/'.$destPath);
    header("Location: /?folder=$folder");
} else{
    $allFiles = scandir($folder);
    $folderInfo = pathinfo($destPath);
    $findFolder = preg_grep("/^" . $folderInfo['filename'] . "(\_\d)?" . "$/", $allFiles);
    $foldername = $folderInfo['basename'] . (count($findFolder) > 0 ? '_' . (count($findFolder) + 1) : '');

    mkdir($folder.'/'.$foldername);
    header("Location: /?folder=$folder");
}