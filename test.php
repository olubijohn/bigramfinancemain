<?php
session_start();
require "./includes/db.inc.php";
$id = $_SESSION['id'];
$str_start_date = "Start Date:";
$str_current_date = "Current Date:";
    $sql = $sql = "SELECT * FROM deposits WHERE user_id = $id AND deposit_status = 'success' AND expiring_days > 0;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $exp_days = $row['expiring_days'];
        $start_date .= $row['deposit_date'];
        $current_date .= getdate()[0];
        $str_start_date = date("Y-m-d", $start_date);
        $str_current_date = date("Y-m-d", $current_date);
        $diff = strtotime($str_start_date) - strtotime($str_current_date);
        $diff_in_days = ceil(abs($diff/86400));
        $new_exp_days = $exp_days - $diff_in_days;
        $u_sql = "UPDATE deposits SET days_spent = $diff_in_days WHERE id = $id;";
        mysqli_query($conn, $u_sql);
    }
}

echo $start_date . "----". $current_date;
echo "<br>".$str_start_date . "----". $str_current_date;
echo "<br>". $diff;
echo "<br>". $diff_in_days;
echo "<br>". $new_exp_days;