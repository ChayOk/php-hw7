<?php
$oldName = $_POST['oldNameFile'];
$newName = $_POST['newNameFile'];
$folder = $_POST['folder'];

if ($_POST) {
    rename($folder.'/'.$oldName, $folder.'/'.$newName);
    header("Location: /?folder=$folder");
} else{
    header("Location: /?folder=$folder");
}