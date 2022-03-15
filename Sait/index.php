<!doctype html>
<html lang="en">
<head>
    <?php
        $website = 'PHP блог';
        require 'blocks/head.php';
    ?>
</head>
<body>
    <?php require 'blocks/header.php'?>

        <main class="container mt-5">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <?php
                        require_once 'mySQLconnect.php';

                        $sql = 'SELECT * FROM articles ORDER BY date DESC';
                        $query = $pdo->query($sql);
                        while ($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
                            <div class="p-5 pb-2 mb-3 bg-light rounded-3">
                                <?php echo "<h3>$row->title</h3>
                                <p>$row->intro</p>
                                <p><b>Автор статьи: </b><mark>$row->avtor</mark></p>"
                                ?>
                                <a href='<?="/news.php?id=$row->id"?>' title='$row->title'>
                                    <button class="btn btn-warning mb-5">Подробнее</button>
                                </a>
                            </div>
                        <?php } ?>

                </div>
                <?php require 'blocks/aside.php'?>
            </div>
        </main>

    <?php require 'blocks/footer.php'?>
</body>
</html>
