<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./styles.css">
  <link rel="shortcut icon" href="#" type="image/x-icon">
  <title>Login - Bi-gramFinance</title>
</head>
<body>
  <?php 
    if (isset($_GET['error'])) {
      if ($_GET['error'] == "empty") {
        echo '<div id="snackbar">Empty Field(s)!</div>';
      }
      elseif ($_GET['error'] == "sql") {
        echo '<div id="snackbar">Database Error! Try Again</div>';
      }
      elseif ($_GET['error'] == "usernotfound") {
        echo '<div id="snackbar">User Not Found!</div>';
      }
      elseif ($_GET['error'] == "wrongpwd") {
        echo '<div id="snackbar">Incorrect Password!</div>';
      }
    }  
  ?>
  <div class="wrapper container-fluid">
    <div class="container">
      <div class="row login shadow-sm">
        <div class="col-md-6">
          <img src="./login.png" alt="Login">
        </div>
        <div class="col-md-6">
          <form action="../includes/admin-login.inc.php" method="post">
            <div class="mb-3 shadow-sm">
              <div class="icon"><i class="bi bi-person-fill"></i></div>
              <input type="text" class="form-control" id="username" name="uid" placeholder="Username/Email">
            </div>
            <div class="mb-3 shadow-sm">
              <div class="icon"><i class="bi bi-lock-fill"></i></div>
              <input type="password" class="form-control" id="password" name="pwd" placeholder="Password">
            </div>
            <div class="d-grid shadow-sm">
              <button type="submit" name="admin" class="btn">Login</button>
            </div>
          </form>
        </div>
      </div>
  </div>
  </div>
  <footer>
  <div class="footer-text text-center">
    Copyrights Ⓒ 2024 All Rights reserved | Design By <a href="http://wa.me/2349016242310">CodeXtra</a>
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
  <script src="./toast.js"></script>
  <script><?php if (isset($_GET['error'])) {
   echo "snackBar();";
  } ?></script>
</body>
</html>