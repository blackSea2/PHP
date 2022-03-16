<!doctype html>
<html lang="en">
<head>
    <?php


    require_once 'mySQLconnect.php';
    $sql = 'SELECT * FROM articles WHERE id = :id';
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);
    $article = $query->fetch(PDO::FETCH_OBJ);

    $website = $article->title;
    require 'blocks/head.php';
    ?>
</head>
<body>
<?php require 'blocks/header.php'?>

<main class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="p-5 mb-4 bg-light rounded-3">
                <h3 class="display-4 mb-4"><?= $article -> title ?></h3>
                <p class="mb-1"><b>Автор статьи: </b><mark><?= $article -> avtor ?></mark></p>
                <p style="color: gray">
                    <?php
                        $date = date('H:i:s  d.m.Y', $article -> date);
                        echo $date;
                    ?>
                </p>
                <p class="lead">
                    <?= $article -> intro ?>
                </p>
                <p>
                    <?= $article -> text ?>
                </p>
            </div>
            <div class="comments mt-4">
                <h2>Комментарии</h2>
                <form action="/news.php?id=<?=$_GET['id']?>" method="post">
                    <label for="username">Ваше имя</label>
                    <input type="text" name="username" id="username"  value="<?= $_COOKIE['login'] ?>" class="form-control">
                    <label for="mess">Сообщение</label>
                    <textarea name="mess" id="mess" class="form-control"></textarea>
                    <button type="submit" id="comment_mess" class="btn btn-success mt-3 mb-3">Добавить</button>
                    <?php

                        if($_POST['username'] != '' && $_POST['mess'] != '') {
                            $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
                            $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

                            $sql = 'INSERT INTO comments(name, mess, article_id) VALUE (?, ?, ?)';
                            $query = $pdo->prepare($sql);
                            $query->execute([$username, $mess, $_GET['id']]);
                        }

                        $sql = 'SELECT * FROM comments WHERE article_id = :id ORDER BY id DESC';
                        $query = $pdo->prepare($sql);
                        $query->execute(['id' => $_GET['id']]);
                        $comments = $query->fetchAll(PDO::FETCH_OBJ);

                        foreach ($comments as $comment){ ?>
                            <div class="alert alert-info">
                                <h3><b><?=$comment->name?></b></h3>
                                <p><?=$comment->mess?></p>
                            </div>
                        <?php } ?>
                </form>
            </div>
        </div>
        <?php require 'blocks/aside.php'?>
    </div>
</main>

<?php require 'blocks/footer.php'?>
</body>
</html>
