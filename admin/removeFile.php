<?php
$fileFolder = $_POST['removeFolder'];
$folder = $_POST['folder'];
// die(var_dump($folder.'/'.$fileFolder));

if (is_dir($folder.'/'.$fileFolder)) {
    rmdir($folder.'/'.$fileFolder);
    header("Location: /?folder=$folder");
} else if(is_file($folder.'/'.$fileFolder)){
    unlink($folder.'/'.$fileFolder);
    header("Location: /?folder=$folder");
} else{
    header("Location: /?folder=$folder");
}