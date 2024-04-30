<?php 
session_start();
if (isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ================ BOOTSTRAP CDN -================= -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- ============ BOOTSTRAP ICON CDN ===========================-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- =================== JQUERY CDN ======================= -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- =================== DATA TABLE CDN ======================= -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>
  <!-- ===================== TOASTIFY LIBRARY ==================== -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <link rel="stylesheet" href="./styles.css">
  <link rel="shortcut icon" href="#" type="image/x-icon">
  <title>BI-GRAM ADMIN PANEL</title>
</head>
<body>
<?php 
    require("./header.php"); 
    require("./navbar.php");
    ?>
  <!-- MAIN CONTENT -->
  <main>
    <div class="admin">
      <div class="dashboard container-fluid">
        <div class="summary">
          <div class="row">
            <div class="col-md-3">
              <div class="icon">
                <i class="bi bi-people"></i>
              </div>
              <div class="number">
                <h2 id="user-num">0</h2>
              </div>
              <div class="text">
                <p>Total Users</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="icon">
                <i class="bi bi-people"></i>
              </div>
              <div class="number">
                <h2 id="deposit-num">0</h2>
              </div>
              <div class="text">
                <p>Total Deposits</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="icon">
                <i class="bi bi-mortarboard"></i>
              </div>
              <div class="number">
                <h2 id="withdraw-num">0</h2>
              </div>
              <div class="text">
                <p>Total Withdrawals</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="add-student">
      <button class="btn" data-bs-toggle="modal" data-bs-target="#myModal1">Add New Student</button>
      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
        Enroll Student
      </button>
    </div> -->
    <!-- =================== MODAL============================== -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Enroll Student</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <div class="mb-3">
                <label for="student" class="form-label">Select Student</label>
                <input list="student" class="form-control" id="students">
                <datalist id="student">`
                </datalist>
              </div>
              <div class="mb-3">
                <label for="course" class="form-label">Select Course</label>
                <select id="e-course" name="course" class="form-control">
                </select>
              </div>
              <div class="d-grid shadow-sm">
                <button type="submit" class="btn btn-primary" id="enroll-btn" onclick="enrollUser()">Enroll Student</button>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- =================== MODAL II ============================== -->
    <div class="modal fade" id="myModal1">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Student</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="fName" class="form-label">First Name</label>
              <input type="text" class="form-control" id="fName" placeholder="First Name">
            </div>
            <div class="mb-3">
              <label for="lName" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="lName" placeholder="Last Name">
            </div>
            <div class="mb-3">
              <label for="uid" class="form-label">Username</label>
              <input type="text" class="form-control" id="uid" placeholder="Username">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="mb-3">
              <label for="pwd" class="form-label">Password</label>
              <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div>
            <div class="mb-3">
              <label for="rpwd" class="form-label">Re-Password</label>
              <input type="password" class="form-control" id="rpwd" placeholder="Repeat Password">
            </div>
            <div class="d-grid shadow-sm">
              <button type="submit" class="btn btn-primary" id="student-btn" onclick="addStudent()">Register Student</button>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">

        <div class="table-data shadow-sm">
          <div class="alert alert-primary">
            <strong>DEPOSITS</strong>
          </div>
          <table width="100%" class="table table-hover table-borderless" id="teacher-table">
            <thead>
              <tr>
                <td>#</td>
                <td>Deposit ID</td>
                <td>Amount</td>
                <td>User</td>
                <td>Plan</td>
                <td>Deposit Status</td>
                <td>Deposit Date</td>
                <td>Action</td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </main>
  </div>
  <footer>
  <div class="footer-text text-center">
    Copyrights Ⓒ 2024 All Rights reserved |Bi-gramFinance
    </div>
    <!-- <div class="footer-icons">
      <a href="#">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="#">
        <i class="bi bi-twitter"></i>
      </a>
      <a href="#">
        <i class="bi bi-instagram"></i>
      </a>
      <a href="#">
        <i class="bi bi-whatsapp"></i>
      </a>
    </div> -->
</footer>
  <script src="./app.js"></script>
  <script src="./loader.js"></script>
  <script>
    $("document").ready(function() {
      displayTable();
      // getStudents();
      // getCourses();
      userNum();
      depositNum();
      withdrawNum();
    });
    var table = $('#teacher-table').DataTable({
      ajax: "./deposits.txt"
    });
    // ========================= GET ALL STUDENTS =====================
    function getStudents() {
      var fetchStudents = true;
      $.post("../includes/students.inc.php", {
        fetchStudents: fetchStudents
      }, function(data, status) {
        var results = JSON.parse(data);
        var x = "";
        results.forEach(result => {
          x += `<option value="${result.email}">`;
        });
        $("#student").html(x);
      });
    }
    // ========================= GET ALL COURSES =====================
    function getCourses() {
      var fetchCourse = true;
      $.post("../includes/courses.inc.php", {
        fetchCourse: fetchCourse
      }, function(data, status) {
        var results = JSON.parse(data);
        var x = '<option value="0">--- Select Course ---</option>';
        results.forEach(result => {
          x += `<option value="${Number(result.id)}">${result.course_short_name}</option>`;
        });
        $("#e-course").html(x);
      });
    }
    // ========================== ADD STUDENTS =========================
  //   function addStudent() {
  //     $("#student-btn").html("<span class='spinner-border'></span>");
  // $("#student-btn").attr("disabled", true);
  //     var addStudent = true;
  //     var fName = $("#fName").val();
  //     var lName = $("#lName").val();
  //     var uid = $("#uid").val();
  //     var email = $("#email").val();
  //     var pwd = $("#pwd").val();
  //     var rpwd = $("#rpwd").val();
  //     $.post("../includes/students.inc.php", {
  //       addStudent: addStudent,
  //       fName: fName,
  //       lName: lName,
  //       uid: uid,
  //       email: email,
  //       pwd: pwd,
  //       rpwd: rpwd
  //     }, function(data, status) {
  //       if (data == "Registered Successfully") {
  //         $("#myModal1").modal("hide");
  //         $("#fName").val("");
  //         $("#lName").val("");
  //         $("#uid").val("");
  //         $("#email").val("");
  //         $("#pwd").val("");
  //         $("#rpwd").val("");
  //         displayTable();
  //         getStudents();
  //         studentNum();
  //       }
  //       toast(data);
  //       $("#student-btn").html("Add Student");
  //    	$("#student-btn").attr("disabled",false);
  //     });
  //   }
    //============================= DELETE STUDENT =========================
    function deleteStudent(id) {
      var remove = true;
      $.post("../includes/admin.inc.php", {
        id: id,
        remove: remove
      }, function(data, status) {
        displayTable();
        // getStudents();
        userNum();
        toast(data);
      });
    }
    //============================= UPGRADE & DOWNGRADE STUDENT =========================
    function aproveDeposit(id) {
      var aprove = true;
      $.post("../includes/deposit.inc.php", {
        id: id,
        aprove: aprove
      }, function(data, status) {
        displayTable();
        toast(data);
      });
    }

    function rejectDeposit(id) {
      var reject = true;
      $.post("../includes/deposit.inc.php", {
        id: id,
        reject: reject
      }, function(data, status) {
        displayTable();
        toast(data);
      });
    }

    function pendDeposit(id) {
      var pend = true;
      $.post("../includes/deposit.inc.php", {
        id: id,
        pend: pend
      }, function(data, status) {
        displayTable();
        toast(data);
      });
    }
    //================================== ENROLL USER ==============================
  //   function enrollUser() {
  //     $("#enroll-btn").html("<span class='spinner-border'></span>");
  // $("#enroll-btn").attr("disabled", true);
  //     var enroll = true;
  //     var student = $("#students").val();
  //     var courseId = $("#e-course").val();
  //     $.post("../includes/courses.inc.php", {
  //       enroll: enroll,
  //       student:student,
  //       courseId:courseId
  //     }, function(data, status) {
  //       if (data === "Enrolled Successfully") {
  //         displayTable();
  //         $("#students").val("");
  //         $("#e-course").val(-1);
  //         $("#myModal").modal("hide");
  //       }
  //       toast(data);
  //       $("#enroll-btn").html("Enroll Student");
  //    	$("#enroll-btn").attr("disabled",false);
  //     });
  //   }
        //============================= CARDS DISPLAYS =========================
        function depositNum() {
      var fetchDeposits = true;
      $.post("../includes/cards.inc.php", {
        fetchDeposits: fetchDeposits
      }, function(data, status) {
        $("#deposit-num").html(data);
      });
    }
    function withdrawNum() {
      var fetchWithdrawal = true;
      $.post("../includes/cards.inc.php", {
        fetchWithdrawal: fetchWithdrawal
      }, function(data, status) {
        $("#withdraw-num").html(data);
      });
    }
    function userNum() {
      var fetchUsers = true;
      $.post("../includes/cards.inc.php", {
        fetchUsers: fetchUsers
      }, function(data, status) {
        $("#user-num").html(data);
      });
    }
    //============================ DISPLAY TABLE ======================================
    function displayTable() {
      var show = true;
      $.post("../includes/deposit.inc.php", {
        show: show
      }, function(data, status) {
        table.ajax.reload();
      });
    }
    // ===================== TOASTIFY =========================
    function toast(x) {
      Toastify({
        text: x,
        duration: 2000,
        close: true,
        style: {
          background: "linear-gradient(to right, #4649ff, #1d1ce5)",
        }
      }).showToast()
    }
  </script>
</body>

</html>
<?php
 } else {
  header("Location: ./login.php");
 }
?>