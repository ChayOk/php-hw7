<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="/"><img src="img/logo.svg" alt=""></a>
        <a href="logout.php" class="logout">Выйти</a>
    </header>
    <section class="main">
        <h1 class="title">File manager</h1>
        <div class="fileManager">   
            <div class="folders">
                <ul>
                    <?php 
                    $url = $_SERVER['REQUEST_URI'];
                    if ($url == '/header.php') {
                        header('Location: /',true);
                    }

                    $folder = './' . $_GET['folder'];
                    if ($_GET['folder'] == 'admin') {
                        $folder = __DIR__;
                    }
                    // die(var_dump($folder));
                    if (is_dir($folder)) {
                        if ($dh = opendir($folder)) {
                            while (($file = readdir($dh)) !== false) {
                                if (is_dir($folder . '/' . $file)) {
                                    echo "<li class='folderList'><a href='/?folder=" . $file . "'><img src='./img/folder_icon.svg' class='folderListIcon'><span>{$file}</span></a></li>";
                                }
                                else if($file == 'config.ini' || //скрывает файлы доступа 
                                        $file == 'index.php'  ||
                                        $file == 'login.php'  ||
                                        $file == 'logout.php'
                                        ){
                                    echo '';
                                }
                                else{
                                    if($folder != './'){
                                        $fileLink = $folder.'/'.$file;
                                    }else{
                                        $fileLink = $file;
                                    }
                                    echo "<li class='fileList'><a href='$fileLink' target='_blank'><img src='./img/file_icon.svg' class='fileListIcon'><span>{$file}</span></a></li>";                                    
                                }
                                
                            }
                            closedir($dh);
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="actions">
                <form action="show.php" method="POST" class="readFile">
                    <h4>Посмотреть/добавить/изменить файл</h4>
                    <label for="">
                        <input type="text" name="fileName" placeholder="Введите название файла">
                    </label>
                    <input type="hidden" name="folder" value="<?php echo $folder; ?>">
                    <button>Изменить</button>
                </form>

                <form action="addFolder.php" method="POST" class="addFolder">
                    <h4>Добавить каталог</h4>
                    <label for="">
                        <input type="text" name="folderName" placeholder="Введите название каталога">
                        <input type="hidden" name="folder" value="<?php echo $folder; ?>">
                    </label>
                    <button>Добавить</button>
                </form>

                <form action="renameFile.php" method="POST" class="renameFolder">
                    <h4>Переименовать файл или каталог</h4>
                    <label for="">
                        <input type="text" name="oldNameFile" placeholder="Введите старое название">
                        <input type="text" name="newNameFile" placeholder="Введите новое название">
                        <input type="hidden" name="folder" value="<?php echo $folder; ?>">
                    </label>
                    <button>Переименовать</button>
                </form>

                <form action="removeFile.php" method="POST" class="removeFolder">
                    <h4>Удалить файл или каталог</h4>
                    <label for="">
                        <input type="text" name="removeFolder" placeholder="Введите название файла или каталога">
                        <input type="hidden" name="folder" value="<?php echo $folder; ?>">
                    </label>
                    <button>Удалить</button>
                </form>

                <form action="explorer.php" method="POST" enctype="multipart/form-data" class="uploadFile">
                    <h4>Загрузить файл</h4>
                    <input type="file" multiple name="files[]">            
                    <button>Загрузить</button>
                </form>
            </div>
        </div> 
    </section>
</body>
</html>