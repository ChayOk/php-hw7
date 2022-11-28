<?php

require_once './header.php';

$url = $_SERVER['REQUEST_URI'];
// echo $url;
if ($url == '/explorer.php') {
    header('Location: /',true);
}

if (empty($_FILES['files']['name'][0])) {
    exit;
}

echo '<pre>';
print_r($_FILES);
echo '</pre>';

//upload
$destPath = './uploads';
if (!(file_exists($destPath))) {
    mkdir('./uploads');
}

$allFiles = scandir($destPath);

foreach ($_FILES['files']['tmp_name'] as $index => $path) {
    if (file_exists($path)) {
        $fileInfo = pathinfo($_FILES['files']['name'][$index]);
        $findFiles = preg_grep("/^" . $fileInfo['filename'] . "(.+)?\." . $fileInfo['extension'] . "$/", $allFiles);
        $filename = $fileInfo['filename'] . (count($findFiles) > 0 ? '_' . (count($findFiles) + 1) : '') . '.' . $fileInfo['extension'];

        move_uploaded_file($path, $destPath . '/' . $filename);

        $findFiles = preg_match("/^[А-Яа-я\W]+$/", $allFiles);
        $filename = $fileInfo['filename'] . ($findFiles ? translit($fileInfo['filename']) : '') . '.' . $fileInfo['extension'];
        move_uploaded_file($path, $destPath . '/' . $filename);
    }
}

function translit($str)
{
    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"'","э"=>"e","ю"=>"yu","я"=>"ya",
    "."=>"_"," "=>"_","?"=>"_","/"=>"_","\\"=>"_",
    "*"=>"_",":"=>"_","*"=>"_","\""=>"_","<"=>"_",
    ">"=>"_","|"=>"_"
    );
    return strtr($str,$tr);
}