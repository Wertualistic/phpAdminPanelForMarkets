<?php
include 'connect.php';

if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$id = $_GET['id'];

$pdoStatementQarz = $pdo->prepare("
    SELECT * FROM `qarzlar` WHERE id=$id
");

if (!$pdoStatementQarz->execute()) {
    echo 'Error';
}
$data = $pdoStatementQarz->fetch();

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $get_qarz = $_POST['get_qarz'];
    $give_qarz = $_POST['give_qarz'];
    $comment = $_POST['comment'];

    $pdoStatement = $pdo->prepare("
    UPDATE `qarzlar` SET `date`=:date,`get_qarz`=:get_qarz,`give_qarz`=:give_qarz,`comment`=:comment WHERE id=$id
");

    $pdoStatement->bindParam('date', $date);
    $pdoStatement->bindParam('get_qarz', $get_qarz);
    $pdoStatement->bindParam('give_qarz', $give_qarz);
    $pdoStatement->bindParam('comment', $comment);

    if ($pdoStatement->execute()) {
        header("location: qarzlar.php");
    }
    ;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>57-dars</title>
</head>

<body>

    <!-- hader start -->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">
                                <img width="100" height="80" src="image/logo.png" alt="logo of website">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Savdo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="qarzlar.php">Qarzlar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="xodimlar.php">Xodimlar</a>
                                    </li>
                                </ul>
                                <a href="logout.php"><button class="btn btn-outline-danger">Chiqish</button></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- hader end -->


    <form action="qarzEdit.php?id=<?= $data['id'] ?>" method="post" autocomplete="off">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <h2 class="font-monospace">Edit Post</h2>
                </div>
                <div class="col-6 mb-2">
                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" value="<?= $data['date'] ?>" class="form-control"
                        required="">
                </div>
                <div class="col-6 mb-2">
                    <label for="get_qarz">Olindi:</label>
                    <input type="text" name="get_qarz" required="" id="get_qarz" value="<?= $data['get_qarz'] ?>"
                        class="form-control" placeholder="get_qarz">
                </div>
                <div class="col-6 mb-2">
                    <label for="price">Berildi:</label>
                    <input type="text" required="" name="give_qarz" id="price" value="<?= $data['give_qarz'] ?>"
                        class="form-control" placeholder="Cash sales">
                </div>
                <div class="col-12 mb-2">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <textarea name="comment" required="" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"><?= $data['comment'] ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <a href="xodimlar.php" class="btn btn-warning">Close</a>
                </div>
            </div>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>

</body>

</html>