<!DOCTYPE html>
<html lang="en" class="js">
<!-- Mirrored from bi-GramFinance/signup.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Mar 2024 15:25:44 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8" />
  <meta name="robots" content="noindex" />
  <meta name="author" content="Softnio" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <!-- Fav Icon  -->
  <link rel="shortcut icon" href="images/..html" />

  <!-- Site Title  -->
  <title>Signup - Bi-gramFinance</title>
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
                <!-- <a href="index-3.html">
                    <img src='images/logo.png'/>
                  </a> -->
                <h5 class="ath-heading title">Sign Up</h5>
                <?php
                if (isset($_GET['error'])) {
                  if ($_GET['error'] == "empty") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Empty Fields!</div>';
                  } elseif ($_GET['error'] == "uid/email") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Invalid Username/Email!</div>';
                  } elseif ($_GET['error'] == "email") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">SInvalid Email!</div>';
                  } elseif ($_GET['error'] == "uid") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Invalid Username!</div>';
                  } elseif ($_GET['error'] == "strong") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Use Strong Password!</div>';
                  } elseif ($_GET['error'] == "username") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Use Valid USername!</div>';
                  } elseif ($_GET['error'] == "password") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Password not the same!</div>';
                  } elseif ($_GET['error'] == "sql") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Database Error! Try Again</div>';
                  } elseif ($_GET['error'] == "userexist") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">User Exist! Change Username/Email</div>';
                  } elseif ($_GET['error'] == "success") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Signup Success!</div>';
                    header("refresh:2;url=./login.php");
                  }
                }
                ?>
                <form action="./includes/signup.inc.php" method="post">
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Your Name" name="name" value="<?php if (isset($_GET['full_name'])) {echo $_GET['full_name'];}?>" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Your Username" name="username" value="<?php if (isset($_GET['username'])) {echo $_GET['username'];}?>" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Your Email" name="email" value="<?php if (isset($_GET['email'])) {echo $_GET['email'];}?>" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Your Country" name="country" value="<?php if (isset($_GET['country'])) {echo $_GET['country'];}?>" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Phone Number" name="number" value="<?php if (isset($_GET['number'])) {echo $_GET['number'];}?>" required />
                    </div>
                  </div>
                  <!--<div class="field-item">-->
                  <!--    <div class="field-wrap">-->
                  <!--        <input type="text" class="input-bordered" placeholder="Bitcoin Wallet" name="btcwallet">-->
                  <!--    </div>-->
                  <!--</div>-->

                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="password" class="input-bordered" placeholder="Password" name="pwd" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="password" class="input-bordered" placeholder="Repeat Password" name="rpwd" required />
                    </div>
                  </div>
                  <div class="field-item">
                    <div class="field-wrap">
                      <input type="text" class="input-bordered" placeholder="Referral Id (Optional)" name="ref" value="<?php if (isset($_GET['ref'])) {echo $_GET['ref'];}?>" />
                    </div>
                  </div>
                  <div class="field-item">
                    <input class="input-checkbox" id="agree-term-2" type="checkbox" name="ac" value="v" />
                    <label for="agree-term-2">I agree to Bi-gramFinance
                      <a href="#">Privacy Policy</a> &amp;
                      <a href="#">Terms</a>.</label>
                  </div>


                  <div class="ath-note text-center">
                    <button type="submit" name="submit"> <strong>SIGN UP HERE</strong></button>
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

<!-- Mirrored from bi-GramFinance/signup.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Mar 2024 15:25:51 GMT -->

</html>