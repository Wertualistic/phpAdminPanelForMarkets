<?php
include 'connect.php';

if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$id = $_GET['id'];

$pdoStatementCrud = $pdo->prepare("
    SELECT * FROM `crud` WHERE id=$id
");

if (!$pdoStatementCrud->execute()) {
    echo 'Error';
}
$data = $pdoStatementCrud->fetch();

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $name = $_POST['name'];
    $cash_sale = $_POST['cash_sale'];
    $terminal_trade = $_POST['terminal_trade'];
    $total_sales = $_POST['total_sales'];
    $dealy_costs = $_POST['dealy_costs'];
    $comment = $_POST['comment'];

    $pdoStatement = $pdo->prepare("
    UPDATE `crud` SET `date`=:date,`name`=:name,`cash_sale`=:cash_sale,`terminal_trade`=:terminal_trade,`total_sales`=:total_sales,`dealy_costs`=:dealy_costs,`comment`=:comment WHERE id=$id
");

    $pdoStatement->bindParam('date', $date);
    $pdoStatement->bindParam('name', $name);
    $pdoStatement->bindParam('cash_sale', $cash_sale);
    $pdoStatement->bindParam('terminal_trade', $terminal_trade);
    $pdoStatement->bindParam('total_sales', $total_sales);
    $pdoStatement->bindParam('dealy_costs', $dealy_costs);
    $pdoStatement->bindParam('comment', $comment);

    if ($pdoStatement->execute()) {
        header('location: index.php');
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
                                        <a class="nav-link" href="qarizlar.php">Qarzlar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="xodimlar.php">Xodimlar</a>
                                    </li>
                                </ul>
                                <a class="btn btn-outline-danger" href="logout.php">Chiqish</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- hader end -->


    <form action="edit.php?id=<?= $data['id'] ?>" method="post" autocomplete="off">
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
                    <label for="name">Name:</label>
                    <input type="text" name="name" required="" id="name" value="<?= $data['name'] ?>"
                        class="form-control" placeholder="Name">
                </div>
                <div class="col-6 mb-2">
                    <label for="price">Cash sale:</label>
                    <input type="number" required="" name="cash_sale" id="price" value="<?= $data['cash_sale'] ?>"
                        class="form-control" placeholder="Cash sales">
                </div>
                <div class="col-6 mb-2">
                    <label for="terminal">Terminal trade:</label>
                    <input type="number" required="" name="terminal_trade" id="terminal"
                        value="<?= $data['terminal_trade'] ?>" class="form-control" placeholder="Terminal trades">
                </div>
                <div class="col-6 mb-2">
                    <label for="product">Total sales:</label>
                    <input type="number" required="" name="total_sales" id="product" value="<?= $data['total_sales'] ?>"
                        class="form-control" placeholder="Total sales">
                </div>
                <div class="col-6 mb-2">
                    <label for="buy">Daily Cost:</label>
                    <input type="number" required="" name="dealy_costs" id="buy" value="<?= $data['dealy_costs'] ?>"
                        class="form-control" placeholder="Enter Daily Cost">
                </div>
                <div class="col-12 mb-2">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <textarea name="comment" required="" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"><?= $data['comment'] ?></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <a href="index.php" class="btn btn-warning">Close</a>
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