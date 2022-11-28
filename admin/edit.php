<?php
if($_POST){
    $data = [];
    $data = [
        'editFile' => $_POST['editFile'],
        'folder' => $_POST['fileFolder'],
        'file' => $_POST['file']
    ];

    writeToFile($data);
}

function writeToFile(array $data)
{
    $fileName = $data['folder'].'/'.$data['file'];
    $folder = $data['folder'];
    // die(var_dump($fileName));    
    $handler = fopen($fileName, "w+");
    fwrite($handler, $data['editFile'] . "\n");
    fclose($handler);
    header("Location: /?folder=$folder");

    return 1;
}