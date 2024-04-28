<?php

if (isset($_POST['submit'])) {
    require_once("db.inc.php");
    $full_name = trim($_POST['name']);
    $country = trim($_POST['country']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $number = trim($_POST['number']);
    $ref = trim($_POST['ref']);
    $pwd = trim($_POST['pwd']);
    $rpwd = trim($_POST['rpwd']);

    if(!$ref) {
        $ref = "none";
    }

    if (empty($full_name) || empty($country) || empty($username) || empty($email)|| empty($number) || empty($pwd) || empty($rpwd)) {
    header("Location: ../signup.php?error=empty&full_name=".$full_name."&country=".$country."&username=".$username."&email=".$email."&number=".$number."&ref=".$ref);
    exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=username/email&full_name=".$full_name."&country=".$country."&number=".$number."&ref=".$ref);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=email&full_name=".$full_name."&country=".$country."&number=".$number."&username=".$username."&ref=".$ref);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=username&full_name=".$full_name."&country=".$country."&email=".$email."&number=".$number."&ref=".$ref);
        exit();
    } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pwd)) {
        header("Location: ../signup.php?error=strong&full_name=".$full_name."&country=".$country."&username=".$username."&email=".$email."&number=".$number."&ref=".$ref);
        exit();
    } elseif ($pwd !== $rpwd) {
        header("Location: ../signup.php?error=password&full_name=".$full_name."&country=".$country."&username=".$username."&email=".$email."&number=".$number."&ref=".$ref);
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sql");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                header("Location: ../signup.php?error=userexist&full_name=".$full_name."&country=".$country."&username=".$username."&email=".$email."&number=".$number);
                exit();
            } else {
                $sql = "INSERT INTO users (full_name, country, username, email,`phone_number`, ref, `password`, reg_date, last_login) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../signup.php?error=sql");
                exit();
            } else {
            $date = getdate()[0];
            $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssssssdd", $full_name, $country, $username, $email, $number, $ref, $hashPwd, $date, $date);
            mysqli_stmt_execute($stmt);
            // Send an Email
                     $msg = "Welecome to Bi-gramFinance, ".$username."\nYour Signup was Successful and your details have been received\nWelcome onboard!";
                     $msg = wordwrap($msg, 70);
                     mail($email, "Bi-gramFinance: Signup Successful", $msg);
            header("Location: ../login.php");
   }
            }
        }
}
 } else {
    header("Location: ../signup.php?error=pressbtn");
    exit();
 }
