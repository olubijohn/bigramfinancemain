<?php
require("./db.inc.php");
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

function SendEmail($msg, $email, $head) {
    $mail = wordwrap($msg, 70);
    mail($email, $head, $mail);
}
if (isset($_POST['submit'])) {
    $plan = $_POST['plan'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $user_id = $_POST['id'];
    $deposit_id = depositID();
    $date = getdate()[0];
    $exp_days = 7;

    $sql = "INSERT INTO deposits (deposit_id, user_id, amount, plan, `payment_option`, deposit_date, expiring_days) VALUES ($deposit_id, $user_id, $amount, $plan, '$type', $date, $exp_days);";
    if (mysqli_query($conn, $sql)) {
        // send a mail
        header("Location: ../dashboard.php");
    }
} elseif (isset($_POST['show'])) {
    $sql = "SELECT * FROM deposits ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $resultChecker = mysqli_num_rows($result);
    if ($resultChecker > 0) {
        $x = 0;
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $date = date("Y-m-d H:i:s", $row['deposit_date']);
            $uid = $row['user_id'];
            $u_sql = "SELECT * FROM users WHERE id = $uid;";
            $u_result = mysqli_query($conn, $u_sql);
            if(mysqli_num_rows($u_result) > 0) {
                $u_row = mysqli_fetch_assoc($u_result);
              }
              $plan_no = $row['plan'];
              $plan = "";
              if($plan_no == 5) {
                $plan = "STARTUP";
              } elseif($plan_no == 7) {
                $plan = "GOLD";
              } elseif($plan_no == 10) {
                $plan = "HOURLY";
              } elseif($plan_no == 12) {
                $plan = "GRAND";
              }
            //   status
            $status = "";
            if($row['deposit_status'] == "pending") {
                $status = '<span class="badge bg-warning">Pending</span>';
            } elseif($row['deposit_status'] == "success") {
                $status = '<span class="badge bg-success">Success</span>';
            } elseif($row['deposit_status'] == "rejected") {
                $status = '<span class="badge bg-danger">Rejected</span>';
            }
            $array = array();
            $array[] = ++$x;
            $array[] = $row['deposit_id'];
            $array[] = $row['amount'];
            $array[] = $u_row['username'];
            $array[] = $plan;
            $array[] = $status;
            $array[] = $date;
            $array[] = '<td>•••<div class="links shadow-sm">
            <form action="./photocard.php" method="post">
            <button name="id" value="' . $row['id'] . '" disabled>View Details</button>
            </form>
            <form action="./edit-user.php" method="post">
            <button type="submit" class="edit" name="edit" value="' . $row['id'] . '" disabled>Delete Deposit</button>
            </form>
            <button name="pend" value="' . $row['id'] . '" onclick="pendDeposit(' . $row['id'] . ')">Pend Deposit</button>
            <button name="aprove" value="' . $row['id'] . '" onclick="aproveDeposit(' . $row['id'] . ')">Aprove Deposit</button>
            <button name="reject" value="' . $row['id'] . '" onclick="rejectDeposit(' . $row['id'] . ')">Reject Deposit</button>
          </div></td>';
            array_push($data, $array);
        }
        file_put_contents("../admin/deposits.txt", '{"data":' . json_encode($data) . '}');
    } else {
        file_put_contents("../admin/deposits.txt", '{"data":[[null,null,null,null,null,null,null,null]]}');
    }
} elseif (isset($_POST['aprove'])) {
    $id = $_POST['id'];
    $sql = "SELECT deposit_status FROM deposits WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['deposit_status'];
    $user_id = $row['user_id'];
    // get Users details
    $u_sql = "SELECT * FROM users WHERE id = '$user_id';";
    $u_result = mysqli_query($conn, $u_sql);
    $u_row = mysqli_fetch_assoc($u_result);
    $email = $row['email'];
    if ($plan == "success") {
        echo "Already Aproved";
    } else {
        $sql = "UPDATE deposits SET deposit_status = 'success' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
         SendEmail("Your Deposit on Bi-gramFinance has been aproved",$email,"Bi-gramFinance: Deposit Status Changed");
        echo "Aproved Successfully";
    }
} elseif (isset($_POST['reject'])) {
    $id = $_POST['id'];
    $sql = "SELECT deposit_status FROM deposits WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['deposit_status'];
    $user_id = $row['user_id'];
    // get Users details
    $u_sql = "SELECT * FROM users WHERE id = '$user_id';";
    $u_result = mysqli_query($conn, $u_sql);
    $u_row = mysqli_fetch_assoc($u_result);
    $email = $row['email'];
    if ($plan == "rejected") {
        echo "Already Rejected";
    } else {
        $sql = "UPDATE deposits SET deposit_status = 'rejected' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
         SendEmail("Your Deposit on Bi-gramFinance has been rejected\nContact the admin to know why",$email,"Bi-gramFinance: Deposit Status Changed");
        echo "Rejected Successfully";
    }
} elseif (isset($_POST['pend'])) {
    $id = $_POST['id'];
    $sql = "SELECT deposit_status FROM deposits WHERE id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $plan = $row['deposit_status'];
    if ($plan == "pending") {
        echo "Already Pending";
    } else {
        $sql = "UPDATE deposits SET deposit_status = 'pending' WHERE id = '$id';
        ";
        mysqli_query($conn, $sql);
        echo "Pended Successfully";
    }
}
else {
    header("Location: ../deposit.php");
}
