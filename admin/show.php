<?php if ($_COOKIE['login'] != $loginHash && $_COOKIE['password'] != $passwordHash): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Add file</title>
</head>
<body>   
    <header>
        <a href="/"><img src="img/logo.svg" alt=""></a>
        <a href="logout.php" class="logout">Выйти</a>
    </header>
    <section class="main">
            <h1 class="title" style="margin-bottom: 20px;">Посмотреть/добавить/изменить файл</h1>

    <?php
    ini_set('display_errors', 'Off'); 

    $file = $_POST['fileName'];
    $fileFolder = $_POST['folder'];
    // die(var_dump($fileFolder));
    $folder = pathinfo($file)['dirname'];
    $filePath = $folder.'\\'.$file;
    // die(var_dump(pathinfo($file)));
    $content = file($folder.'\\'.$file, FILE_USE_INCLUDE_PATH);
    $writeFile = function () use ($content, $filePath) 
    {
        if (!filesize($filePath) < 1) {
            foreach ($content as $value) {
            echo $value . "<br>";
            }
        } else{
            echo 'Данного файла нет в каталоге. Нажмите изменить, чтобы создать его.';
        }     
    };
    $writeFile();
    ?>
    <form action="edit.php" method="POST" class="editFile">
        <h4>Внесите изменения в файл <?php echo $file ?></h4>
        <label for="">
            <textarea name='editFile'><?php $writeFile(); ?></textarea></label>
            <input type="hidden" name="file" value="<?php echo $file ?>">
            <input type="hidden" name="fileFolder" value="<?php echo $fileFolder ?>">
            <button>Изменить</button>
    </form>

    </section>
    
</body>
</html>
<?php else:
header('Location: /');
endif;