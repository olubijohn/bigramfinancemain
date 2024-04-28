<?php
require "./db.inc.php";

if (isset($_POST['fetchUsers'])) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn,$sql);
    $result_checker = mysqli_num_rows($result);
    echo $result_checker;
} elseif (isset($_POST['fetchDeposits'])) {
    $sql = "SELECT * FROM deposits WHERE deposit_status = 'success';";
    $result = mysqli_query($conn,$sql);
    $result_checker = mysqli_num_rows($result);
    echo $result_checker;
} elseif (isset($_POST['fetchWithdrawals'])) {
    $sql = "SELECT * FROM withdrawals WHERE withdrawal_status = 'success';";
    $result = mysqli_query($conn,$sql);
    $result_checker = mysqli_num_rows($result);
    echo $result_checker;
}