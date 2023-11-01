<?php
include 'connect.php';

if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$pdoStatementMenu = $pdo->prepare("
    SELECT * FROM `menu1`
");

if (!$pdoStatementMenu->execute()) {
    echo 'Xato';
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    $pdoStatement = $pdo->prepare("
    INSERT INTO menu1 (`name`)
        VALUES
    (:name)");

    $pdoStatement->bindParam(':name', $name);

    if ($pdoStatement->execute()) {
        header('location: xodimlar.php');
    }
}


$pdoStatementMenu1 = $pdo->prepare("
    SELECT * FROM `menu1`
");

if (!$pdoStatementMenu1->execute()) {
    echo 'Xato';
}

$pdoStatementQarz = $pdo->prepare("
    SELECT * FROM `xodimlar`
");

if (!$pdoStatementQarz->execute()) {
    echo 'Xato';
}

$pdoStatementQarz1 = $pdo->prepare("
    SELECT * FROM `xodimlar`
");

if (!$pdoStatementQarz1->execute()) {
    echo 'Xato';
}

$pdoStatementQarz2 = $pdo->prepare("
    SELECT * FROM `xodimlar`
");

if (!$pdoStatementQarz2->execute()) {
    echo 'Xato';
}

$pdoStatementQarz3 = $pdo->prepare("
    SELECT * FROM `xodimlar`
");

if (!$pdoStatementQarz3->execute()) {
    echo 'Xato';
}

$xodimlar = $pdoStatementQarz->fetch();

if (isset($_POST['submit1'])) {
    $date = $_POST['date'];
    $menu_id = $_POST['menu_id'];
    $get_qarz = $_POST['get_qarz'];
    $give_qarz = $_POST['give_qarz'];
    $comment = $_POST['comment'];

    $pdoStatement = $pdo->prepare("
    INSERT INTO xodimlar (`date`, `menu_id`, `get_qarz`, `give_qarz`, `comment`)
        VALUES
    ( :date, :menu_id, :get_qarz, :give_qarz, :comment)");

    $pdoStatement->bindParam(':date', $date);
    $pdoStatement->bindParam(':menu_id', $menu_id);
    $pdoStatement->bindParam(':get_qarz', $get_qarz);
    $pdoStatement->bindParam(':give_qarz', $give_qarz);
    $pdoStatement->bindParam(':comment', $comment);

    if ($pdoStatement->execute()) {
        header('location: xodimlar.php');
    }
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
                                        <a class="nav-link" href="qarzlar.php">qarzlar</a>
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

    <!-- section start -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered text-center mytable">
                        <thead>
                            <tr>
                                <th>Summasi</th>
                                <th>berildi </th>
                                <th>qoldi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $GiveQarz = 0;
                            $GetQarz = 0;

                            while ($data = $pdoStatementQarz1->fetch()) {
                                // Your existing code for displaying individual rows
                            
                                // Update the totals
                                $GiveQarz += $data['give_qarz'];
                                $GetQarz += $data['get_qarz'];
                            }

                            // Display the total row after the loop
                            echo '<tr>';
                            echo '<td class="cash">' . $GetQarz . '</td>';
                            echo '<td class="terminal">' . $GiveQarz . '</td>';
                            echo '<td>' . ($GetQarz - $GiveQarz) . '</td>';
                            echo '</tr>';
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-outline-warning mb-3 " data-bs-toggle="modal" data-bs-target="#menumodal"><i
                            class="bi bi-plus-circle"> </i>Xodim qoshish</button>

                </div>
                <div class="col-6 text-center">
                    <button class="btn btn-outline-warning mb-3 " data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><i class="bi bi-plus-circle"> </i>Ish haqqi qoshish</button>

                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <!-- Main start -->
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    <div class="list-group mylistgroup">
                        <?php while ($data = $pdoStatementMenu->fetch()) { ?>
                            <div class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="singleXodim.php?id=<?= $data['id'] ?>"
                                    style="text-decoration: none; color: black; font-size: 18px;">
                                    <?= $data['name'] ?>
                                </a>
                                <a href="menuDelete1.php?id=<?= $data['id'] ?>">
                                    <i class="bi d-none bi-trash-fill btn btn-outline-danger btn-sm"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>
    <!-- Main end -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-9 " id="staticBackdropLabel">Ish haqqi qo'shish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="xodimlar.php" autocomplete="off">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="col-form-label">Sana:</label>

                                <input type="date" class="form-control" name="date" placeholder="Sana">
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Kimga yozamiz:</label>
                                <select name="menu_id" id="names" class="form-select form-control">
                                    <?php while ($data = $pdoStatementMenu1->fetch()) { ?>
                                        <option value="<?= $data['id'] ?>">
                                            <?= $data['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="name" class="col-form-label">Umumiy oylik:</label>
                                <input type="text " class="form-control" name="get_qarz">
                            </div>

                            <div class="col-6">
                                <label for="name" class="col-form-label">Berilgan oylik:</label>
                                <input type="text " class="form-control" name="give_qarz">
                            </div>
                        </div>
                        <form>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Izoh:</label>
                                <textarea class="form-control" name="comment" id="message-text"></textarea>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="submit1">Sumbit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="menumodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Xodim qo'shish</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="xodimlar.php" autocomplete="off" method="post">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Xodim:</label>
                            <input type="text" class="form-control" name="name" placeholder="Xodim ismini yozing">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="submit">Qo'shish</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
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

    <script>
        let getAction = document.querySelectorAll(".list-group-item-action");

        for (let i = 0; i < getAction.length; i++) {
            getAction[i].addEventListener('click', () => {
                let getBtn = getAction[i].querySelectorAll(".bi-trash-fill");

                for (let j = 0; j < getBtn.length; j++) {
                    getBtn[j].classList.toggle('d-none');
                }
            });
        }
    </script>

</body>

</html>