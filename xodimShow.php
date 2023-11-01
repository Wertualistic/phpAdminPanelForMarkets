<?php
include 'connect.php';

if (empty($_SESSION['id'])) {
    header('location: login.php');
}

$id = $_GET['id'];

$pdoStatementCrud = $pdo->prepare("
    SELECT * FROM `xodimlar` WHERE id=$id
");

if (!$pdoStatementCrud->execute()) {
    echo 'Error';
}

$data = $pdoStatementCrud->fetch();

$pdoStatementMenu = $pdo->prepare("
    SELECT * FROM `menu1` WHERE id=$data[menu_id]
");

if (!$pdoStatementMenu->execute()) {
    echo 'Error';
}
$data1 = $pdoStatementMenu->fetch();

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

    <div class="check">
        <div class="col-12 col-sm-2" id="print">
            <p>Sana: <strong>
                    <?= $data['date'] ?>
                </strong></p>
            <p>Isim: <strong>
                    <?= $data1['name'] ?>
                </strong></p>
            <p>Berildi: <strong>
                    <?= $data['give_qarz'] ?> so'm
                </strong></p>
                <p>Olindi: <strong>
                    <?= $data['get_qarz'] ?> so'm
                </strong></p>
                <p>Qoldi: <strong>
                        <?= ($data['get_qarz'] - $data['give_qarz']) ?> so'm
                    </strong></p>
            <p>Izoh: <strong>
                    <?= $data['comment'] ?>
                </strong></p>
            <a href="xodimlar.php" class="btn btn-warning">Orqaga</a>
            <button class="btn btn-success" id="printtable">Print</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/print-this/printThis.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#printtable').click(function () {
                $('#print').printThis({
                    importCSS: true,
                    importStyle: true,
                    deferredLoading: true
                });
            });
        });
    </script>
</body>

</html>