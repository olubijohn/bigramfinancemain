<?php
require_once("db.inc.php");

function depositID()
{
    $x = range(0, 9);
    $y = "";
    for ($i = 0; $i < 9; $i++) {
        $shuffle = shuffle($x);
        $rand_x = $x[array_rand($x)];
        $y .= $rand_x;
    }
    return $y;
}
function totalDeposit($id, $conn) {
    $sql = "SELECT * FROM deposits WHERE user_id = $id AND deposit_status = 'success';";
    $result = mysqli_query($conn, $sql);
    $amount = 0;
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $amount += $row['amount'];
      }
    }
    return $amount;
  }

  function totalWithdrawal($id, $conn) {
    $sql = "SELECT * FROM withdrawals WHERE user_id = $id AND withdrawal_status = 'success';";
    $result = mysqli_query($conn, $sql);
    $amount = 0;
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $amount += $row['amount'];
      }
    }
    return $amount;
  }


if (isset($_POST['show'])) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $resultChecker = mysqli_num_rows($result);
    if ($resultChecker > 0) {
        $x = 0;
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $date = date("Y-m-d H:i:s", $row['last_login']);
            $total_deposit = totalDeposit($row['id'], $conn);
            $total_withdrawal = totalWithdrawal($row['id'], $conn);
            $array = array();
            $array[] = ++$x;
            $array[] = $row['full_name'];
            $array[] = $row['username'];
            $array[] = $row['email'];
            $array[] = $row['phone_number'];
            $array[] = $row['email'];
            $array[] = $total_deposit;
            $array[] = $total_withdrawal;
            $array[] = $date;
            $array[] = '<td>•••<div class="links shadow-sm">
            <form action="./edit-user.php" method="post">
            <button type="submit" class="edit" name="edit" value="' . $row['id'] . '" disabled>Edit Uer</button>
            </form>
            <button type="submit" name="id" value="' . $row['id'] . '" onclick="passUserId(' . $row['id'] . ')" >Deposit</button>
            <button name="delete" value="' . $row['id'] . '" onclick="deleteStudent(' . $row['id'] . ')">Delete User</button>
            <button type="submit" name="upgrade" value="' . $row['id'] . '" onclick="upgradeUser(' . $row['id'] . ')" disabled>Upgrade User</button>
            <button type="submit" name="downgrade" value="' . $row['id'] . '" onclick="downgradeUser(' . $row['id'] . ')" disabled>Downgrade User</button>
          </div></td>';
            array_push($data, $array);
        }
        file_put_contents("../admin/students.txt", '{"data":' . json_encode($data) . '}');
    } else {
        file_put_contents("../admin/students.txt", '{"data":[[null,null,null,null,null,null,null,null,null,null]]}');
    }
} elseif (isset($_POST['remove'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM users WHERE id = '$id';";
    mysqli_query($conn, $sql);
    $sql2 = "DELETE FROM deposits WHERE user_id = '$id';";
    mysqli_query($conn, $sql2);
    $sql3 = "DELETE FROM withdrawals WHERE user_id = '$id';";
    mysqli_query($conn, $sql3);
    echo "Deleted Successfully!";
} elseif (isset($_POST['deposit'])) {
  $plan = $_POST['plan'];
  $amount = $_POST['amount'];
  $type = $_POST['type'];
  $user_id = $_POST['id'];
  $deposit_id = depositID();
  $date = getdate()[0];
  $exp_days = 7;

  $sql = "INSERT INTO deposits (deposit_id, user_id, amount, plan, `payment_option`, `deposit_status`, deposit_date, expiring_days) VALUES ($deposit_id, $user_id, $amount, $plan, '$type', 'success', $date, $exp_days);";
  if (mysqli_query($conn, $sql)) {
      // send a mail
      echo "Deposit Successful";
  }
}