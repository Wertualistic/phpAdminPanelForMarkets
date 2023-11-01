<?php
include 'connect.php';

if (!empty($_SESSION['id'])) {
    header('location: login.php');
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $pdoStatementCheck = $pdo->prepare("
    SELECT * FROM `users` WHERE email='$email'
  ");

    if (!$pdoStatementCheck->execute()) {
        echo "Error executing statement";
    }

    $data = $pdoStatementCheck->fetch();

    if ($data) {
        echo "<script> alert('Bunday email bor') </script>";
    } else {
        if ($password == $confirmpassword) {
            $pdoStatement = $pdo->prepare("
      INSERT INTO `users`(`email`, `password`)
      VALUES
      (:email, :password)
      ");

            $pdoStatement->bindParam('email', $email);
            $pdoStatement->bindParam('password', $password);

            if ($pdoStatement->execute()) {
                header('location: login.php');
            }
        } else {
            echo "<script> alert('Parollar mos emas') </script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>Register</title>
</head>

<body>
    <div class="d-flex w-100 justify-content-center align-items-center" style="height: 100vh;">
        <form action="register.php" method="POST" autocomplete="off">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" style="width: 500px;" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary" style="width: 500px;">Submit</button>
        </form>
    </div>
</body>

</html>