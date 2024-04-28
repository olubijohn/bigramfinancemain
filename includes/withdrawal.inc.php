<?php
session_start();
require("./db.inc.php");
function withdrawlID()
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
function SendEmail($msg, $email, $head) {
    $mail = wordwrap($msg, 70);
    mail($email, $head, $mail);
}
if (isset($_POST['submit'])) {
    $method = $_POST['method'];
    $amount = $_POST['amount'];
    $address = $_POST['address'];
    $user_id = $_POST['id'];
    $withdrawal_id = withdrawlID();
    $date = getdate()[0];
    $available_balance = $_SESSION['balance'];
    if ($amount > $available_balance) {
        header("Location: ../requestwithdrawal.php?error=insufficient");
    } else {
        $sql = "INSERT INTO withdrawals (withdrawal_id, user_id, amount, `method`, wallet_address, withdrawal_date) VALUES ($withdrawal_id, $user_id, $amount, '$method', '$address', $date);";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../dashboard.php");
        }
    }
} elseif (isset($_POST['show'])) {
    $sql = "SELECT * FROM withdrawals ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $resultChecker = mysqli_num_rows($result);
    if ($resultChecker > 0) {
        $x = 0;
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $date = date("Y-m-d H:i:s", $row['withdrawal_date']);
            $uid = $row['user_id'];
            $u_sql = "SELECT * FROM users WHERE id = $uid;";
            $u_result = mysqli_query($conn, $u_sql);
            if(mysqli_num_rows($u_result) > 0) {
                $u_row = mysqli_fetch_assoc($u_result);
              }
            //   status
            $status = "";
            if($row['withdrawal_status'] == "pending") {
                $status = '<span class="badge bg-warning">Pending</span>';
            } elseif($row['withdrawal_status'] == "success") {
                $status = '<span class="badge bg-success">Success</span>';
            } elseif($row['withdrawal_status'] == "rejected") {
                $status = '<span class="badge bg-danger">Rejected</span>';
            }
            $array = array();
            $array[] = ++$x;
            $array[] = $row['withdrawal_id'];
            $array[] = $row['amount'];
            $array[] = $u_row['username'];
            $array[] = $row['method'];
            $array[] = $row['wallet_address'];
            $array[] = $status;
            $array[] = $date;
            $array[] = '<td>•••<div class="links shadow-sm">
            <form action="./photocard.php" method="post">
            <button name="id" value="' . $row['id'] . '" disabled>View Details</button>
            </form>
            <form action="./edit-user.php" method="post">
            <button type="submit" class="edit" name="edit" value="' . $row['id'] . '" disabled>Delete Withdrawal</button>
            </form>
            <button name="pend" value="' . $row['id'] . '" onclick="pendWithdrawal(' . $row['id'] . ')">Pend Withdrawal</button>
            <button name="aprove" value="' . $row['id'] . '" onclick="aproveWithdrawal(' . $row['id'] . ')">Aprove Withdrawal</button>
            <button name="reject" value="' . $row['id'] . '" onclick="rejectWithdrawal(' . $row['id'] . ')">Reject Withdrawal</button>
          </div></td>';
            array_push($data, $array);
        }
        file_put_contents("../admin/withdrawals.txt", '{"data":' . json_encode($data) . '}');
    } else {
        file_put_contents("../admin/withdrawals.txt", '{"data":[[null,null,null,null,null,null,null,null,null]]}');
    }
} elseif (isset($_POST['aprove'])) {
    $id = $_POST['id'];
    $sql = "SELECT withdrawal_status FROM withdrawals WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['withdrawal_status'];
    $user_id = $row['user_id'];
    // get Users details
    $u_sql = "SELECT * FROM users WHERE id = '$user_id';";
    $u_result = mysqli_query($conn, $u_sql);
    $u_row = mysqli_fetch_assoc($u_result);
    if ($plan == "success") {
        echo "Already Aproved";
    } else {
        $sql = "UPDATE withdrawals SET withdrawal_status = 'success' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
         SendEmail("Your Withdrawal on Bi-gramFinance has been aproved",$email,"Bi-gramFinance: Withdrawal Status Changed");
        echo "Aproved Successfully";
    }
} elseif (isset($_POST['reject'])) {
    $id = $_POST['id'];
    $sql = "SELECT withdrawal_status FROM withdrawals WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['withdrawal_status'];
    $user_id = $row['user_id'];
    // get Users details
    $u_sql = "SELECT * FROM users WHERE id = '$user_id';";
    $u_result = mysqli_query($conn, $u_sql);
    $u_row = mysqli_fetch_assoc($u_result);
    $email = $row['email'];
    if ($plan == "rejected") {
        echo "Already Rejected";
    } else {
        $sql = "UPDATE withdrawals SET withdrawal_status = 'rejected' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
         SendEmail("Your Withdrawal on Bi-gramFinance has been rejected\nContact the admin to know why",$email,"Bi-gramFinance: Withdrawal Status Changed");
        echo "Rejected Successfully";
    }
} elseif (isset($_POST['pend'])) {
    $id = $_POST['id'];
    $sql = "SELECT withdrawal_status FROM withdrawals WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['withdrawal_status'];
    if ($plan == "pending") {
        echo "Already Pending";
    } else {
        $sql = "UPDATE withdrawals SET withdrawal_status = 'pending' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
        echo "Pended Successfully";
    }
}
else {
    header("Location: ../requestwithdrawal.php");
}
