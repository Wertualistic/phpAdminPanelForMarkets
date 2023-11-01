<?php
include 'connect.php';

if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$pdoStatementCrud = $pdo->prepare("
    SELECT * FROM `crud`
");

$pdoStatementCrud->execute();

$pdoStatementCrud1 = $pdo->prepare("
    SELECT * FROM `crud`
");

$pdoStatementCrud1->execute();

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $name = $_POST['name'];
    $cash_sale = $_POST['cash_sale'];
    $terminal_trade = $_POST['terminal_trade'];
    $total_sales = $_POST['total_sales'];
    $dealy_costs = $_POST['dealy_costs'];
    $comment = $_POST['comment'];

    $pdoStatement = $pdo->prepare("
    INSERT INTO crud(`date`, `name`, `cash_sale`, `terminal_trade`, `total_sales`, `dealy_costs`, `comment`)
        VALUES
    (:date, :name, :cash_sale, :terminal_trade, :total_sales, :dealy_costs, :comment)
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
                                        <a class="nav-link" href="qarzlar.php">Qarzlar</a>
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

    <!-- section start -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <tr>
                                <th>Naqd</th>
                                <th>Terminal</th>
                                <th>Jami</th>
                                <th>Tovar</th>
                                <th>Rasxod</th>
                                <th>Kassa</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $totalCashSale = 0;
                            $totalTerminalTrade = 0;
                            $totalTotalSales = 0;
                            $totalDealyCosts = 0;

                            while ($data = $pdoStatementCrud1->fetch()) {
                                // Your existing code for displaying individual rows
                            
                                // Update the totals
                                $totalCashSale += $data['cash_sale'];
                                $totalTerminalTrade += $data['terminal_trade'];
                                $totalTotalSales += $data['total_sales'];
                                $totalDealyCosts += $data['dealy_costs'];
                            }

                            // Display the total row after the loop
                            echo '<tr>';
                            echo '<td class="cash">' . $totalCashSale . '</td>';
                            echo '<td class="terminal">' . $totalTerminalTrade . '</td>';
                            echo '<td>' . ($totalTerminalTrade + $totalCashSale) . '</td>';
                            echo '<td class="product">' . $totalTotalSales . '</td>';
                            echo '<td class="cost">' . $totalDealyCosts . '</td>';
                            echo '<td class="cashier">' . ($totalTerminalTrade + $totalCashSale - $totalDealyCosts) . '</td>';
                            echo '</tr>';
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-warning mb-3 " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                            class="bi bi-plus-circle"> </i>Savdo qoshish</button>

                </div>
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Sanasi</th>
                                <th>Naqd savdo</th>
                                <th>Terminal savdo</th>
                                <th>Kunlik savdo</th>
                                <th>Kelgan tovar</th>
                                <th>Kunlik rasxod</th>
                                <th>Kassa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($data = $pdoStatementCrud->fetch()) { ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td>
                                        <?= $data['date'] ?>
                                    </td>
                                    <td class="cash">
                                        <?= $data['cash_sale'] ?>
                                    </td>
                                    <td class="terminal">
                                        <?= $data['terminal_trade'] ?>
                                    </td>
                                    <td>
                                        <?= $data['terminal_trade'] + $data['cash_sale'] ?>
                                    </td>
                                    <td class="product">
                                        <?= $data['total_sales'] ?>
                                    </td>
                                    <td class="cost">
                                        <?= $data['dealy_costs'] ?>
                                    </td>
                                    <td class="cashier">
                                        <?= $data['terminal_trade'] + $data['cash_sale'] - $data['dealy_costs'] ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle show" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu" data-popper-placement="top-end">
                                                <li><a href="show.php?id=<?= $data['id'] ?>">
                                                        <button class="dropdown-item" type="button"><i
                                                                class="bi col-12 btn btn-success bi-eye-fill">show</i>
                                                        </button></a></li>
                                                <li><a href="edit.php?id=<?= $data['id'] ?>"><button class="dropdown-item"
                                                            type="button"><i
                                                                class="bi col-12 btn btn-warning bi-pencil-square"> edit
                                                            </i></button></a>
                                                </li>
                                                <li>
                                                    <a onclick="return confirm('Delete ?')" type="submit"
                                                        href='delete.php?id=<?= $data['id'] ?>' class="dropdown-item"><i
                                                            class="bi col-12 btn btn-danger bi-trash">delete</i></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-date fs-9 " id="staticBackdropLabel">Savdo qo'shish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="index.php" autocomplete="off" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="col-form-label">Data:</label>
                                <input type="date" class="form-control" name="date" placeholder="Data">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Cash sale:</label>
                                <input type="number" class="form-control" name="cash_sale" placeholder="Cash sales">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Terminal trade:</label>
                                <input type="number" class="form-control" name="terminal_trade"
                                    placeholder="Terminal trades">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Total sales:</label>
                                <input type="number" class="form-control" name="total_sales" placeholder="Total sales">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Dealy costs:</label>
                                <input type="number" class="form-control" name="dealy_costs"
                                    placeholder="Enter Dealy costs">
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Comment:</label>
                            <textarea class="form-control" name="comment" id="message-text"></textarea>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success" name="submit">Sumbit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>

</html>