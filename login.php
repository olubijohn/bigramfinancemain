<!DOCTYPE html>
<html lang="en" class="js">
<!-- Mirrored from bi-GramFinance/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Mar 2024 15:25:51 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8" />
  <meta name="author" content="Bitfinex Investment" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <!-- Fav Icon  -->
  <link rel="shortcut icon" href="images/..html" />
  <!-- Site Title  -->
  <title>Login - Bi-gramFinance</title>
  <!-- Bundle and Base CSS -->
  <link rel="stylesheet" href="assets2/css/vendor.bundlef86e.css?ver=192" />
  <link rel="stylesheet" href="assets2/css/stylef86e.css?ver=192" id="changeTheme" />
  <!-- Extra CSS -->
  <link rel="stylesheet" href="assets2/css/themef86e.css?ver=192" />

  <!-- Smartsupp Live Chat script -->
  <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = "c859611da6152f4cde6a4c89599d15735041b545";
    window.smartsupp ||
      (function(d) {
        var s,
          c,
          o = (smartsupp = function() {
            o._.push(arguments);
          });
        o._ = [];
        s = d.getElementsByTagName("script")[0];
        c = d.createElement("script");
        c.type = "text/javascript";
        c.charset = "utf-8";
        c.async = true;
        c.src = "../www.smartsuppchat.com/loaderd41d.js?";
        s.parentNode.insertBefore(c, s);
      })(document);
  </script>
</head>

<body class="nk-body body-wider bg-light-alt">
  <div class="nk-wrap">
    <main class="nk-pages">
      <div class="section">
        <div class="container">
          <div class="nk-blocks d-flex justify-content-center">
            <div class="ath-container m-0">
              <div class="ath-body">
                <a href="index-3.html">
                  <!--<img src='images/logo.png'/>-->
                </a>
                <h5 class="ath-heading title">Sign In</h5>
                <?php
                if (isset($_GET['error'])) {
                  if ($_GET['error'] == "empty") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Empty Field(s)!</div>';
                  } elseif ($_GET['error'] == "sql") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Database Error! Try Again</div>';
                  } elseif ($_GET['error'] == "usernotfound") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">User Not Found!</div>';
                  } elseif ($_GET['error'] == "wrongpwd") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Incorrect Password!</div>';
                  }
                }
                ?>
                <form action="./includes/login.inc.php" method="post">
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" name="uid" placeholder="Username or Email" />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="password" class="input-bordered" name="pwd" placeholder="Password" />
                    </div>
                  </div>
                  <div class="field-item d-flex justify-content-between align-items-center">
                    <div class="field-item pb-0">
                      <input class="input-checkbox" id="remember-me-100" type="checkbox" />
                      <label for="remember-me-100">Remember Me</label>
                    </div>
                    <div class="forget-link fz-6">
                      <a href="forgot-password.html">Forgot password?</a>
                    </div>
                  </div>


                  <div class="ath-note text-center">
                    <button type="submit" name="submit"> <strong>SIGN IN HERE</strong></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <div class="preloader"><span class="spinner spinner-round"></span></div>

  <!-- JavaScript -->
  <script src="assets2/js/jquery.bundlef86e.js?ver=192"></script>
  <script src="assets2/js/scriptsf86e.js?ver=192"></script>
  <script src="assets2/js/charts.js"></script>
  <!--<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="cf281c41-7d90-4677-b6d0-ed2de5c20f66";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>-->
</body>

<!-- Mirrored from bi-GramFinance/login.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Mar 2024 15:25:51 GMT -->

</html>