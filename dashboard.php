<?php
  session_start();
if (isset($_SESSION['id'])) {
  require "./includes/db.inc.php";
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$id';";
  $result = mysqli_query($conn, $sql);
  $data = null;
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $data = $row;
    }
  }
   function calculator($id, $conn) {
    $sql = $sql = "SELECT * FROM deposits WHERE user_id = $id AND deposit_status = 'success' AND days_spent < 7;";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $exp_days = $row['expiring_days'];
        $start_date = $row['deposit_date'];
        $current_date = getdate()[0];
        $str_start_date = date("Y-m-d", $start_date);
        $str_current_date = date("Y-m-d", $current_date);
        $diff = strtotime($str_start_date) - strtotime($str_current_date);
        $diff_in_days = ceil(abs($diff/86400));
        $new_exp_days = $exp_days - $diff_in_days;
        $u_sql = "UPDATE deposits SET days_spent = $diff_in_days WHERE id = $id;";
        mysqli_query($conn, $u_sql);
    }
}
   }
   calculator($id, $conn);
  function availableBalance($id, $conn) {
    $deposits = totalDeposit($id, $conn);
    $withdrawal = notRejectedWithdrawal($id, $conn);
    $profit = profitCal($id, $conn);
    $balance = ($deposits - $withdrawal) + $profit;
    return $balance;
  }
  function profitCal($id, $conn) {
    $sql = "SELECT * FROM deposits WHERE user_id = $id AND deposit_status = 'success';";
    $result = mysqli_query($conn, $sql);
    $profit = 0;
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $amount = $row['amount'];
        $plan = $row['plan'];
        $days = $row['days_spent'];
        $math = ($plan/100) * $days * $amount;
        $profit += $math;
      }
    }
    return $profit;
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
  function activeDeposit($id, $conn) {
    $sql = "SELECT * FROM deposits WHERE user_id = $id AND deposit_status = 'success' AND expiring_days > 0;";
    $result = mysqli_query($conn, $sql);
    $amount = 0;
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $amount += $row['amount'];
      }
    }
    return $amount;
  }
  function notRejectedWithdrawal($id, $conn) {
    $sql = "SELECT * FROM withdrawals WHERE user_id = $id AND withdrawal_status != 'rejected';";
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
  function pendingWithdrawal($id, $conn) {
    $sql = "SELECT * FROM withdrawals WHERE user_id = $id AND withdrawal_status = 'pending';";
    $result = mysqli_query($conn, $sql);
    $amount = 0;
    if(mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $amount += $row['amount'];
      }
    }
    return $amount;
  }

  $total_deposit = totalDeposit($id, $conn);
  $active_deposit = activeDeposit($id, $conn);
  $total_withdrawal = totalWithdrawal($id, $conn);
  $pending_withdrawal = pendingWithdrawal($id, $conn);
  $availale_balance = availableBalance($id, $conn);
  $profit = profitCal($id, $conn);
  $_SESSION['balance'] = $availale_balance;
?>
<html>
  <head></head>
  <body>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no"
    />
    <title>Bi-gramFinance</title>
    <meta name="designer" href="https://hyipcustomize.com/" />
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/vendor.bundle.base.css" />
    <meta name="theme-color" content="#063372" />
    <link rel="stylesheet" href="./css/dataTables.bootstrap4.html.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="../img/logo-icon-color.png" />
    <script
      type="text/javascript"
      charset="utf-8"
      async
      src="./js/loader.js"
    ></script>
    <script src="./js/a076d05399.js"></script>
    <link rel="stylesheet" href="./css/font-awesome.min.css" />
    <script src="https://kit.fontawesome.com/7552c817df.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/normalize.min.css" />
    <link rel="stylesheet" href="./css/icon.css" />
    <link rel="stylesheet" href="./css/style_.css" />
    <style>
      .thatwhat {
        z-index: 99999;
        position: fixed;
        bottom: 0;
        left: 0;
        padding-left: 20px;
        padding-bottom: 20px;
      }

      .thatwhat img {
        height: 60px;
        width: 60px;
      }

      * {
        box-sizing: border-box;
      }

      #google_translate_element {
        z-index: 9999999;
        position: fixed;
        bottom: 25px;
        left: 15px;
      }

      .goog-te-gadget {
        font-family: Roboto, "Open Sans", sans-serif !important;
        text-transform: uppercase;
      }

      .goog-te-gadget-simple {
        background-color: rgba(0, 0, 0, 0.5) !important;
        border: 1px solid rgba(255, 255, 255, 0.5) !important;
        padding: 3px !important;
        border-radius: 4px !important;
        font-size: 0.8rem !important;
        line-height: 2rem !important;
        display: inline-block;
        cursor: pointer;
        zoom: 1;
        margin-bottom: 4px;
      }

      .goog-te-menu2 {
        max-width: 100%;
      }

      .goog-te-menu-value {
        color: #fff !important;
      }

      .goog-te-menu-value:before {
        font-family: "Material Icons";
        content: "\E927";
        margin-right: 16px;
        font-size: 2rem;
        vertical-align: -10px;
      }

      .goog-te-menu-value span:nth-child(5) {
        display: none;
      }

      .goog-te-menu-value span:nth-child(3) {
        border: none !important;
        font-family: "Material Icons";
      }

      .goog-te-menu-value span:nth-child(3):after {
        font-family: "Material Icons";
        content: "\E5C5";
        font-size: 1.5rem;
        vertical-align: -6px;
      }

      .goog-te-gadget-icon {
        background-position: 0px 0px;
        height: 32px !important;
        width: 32px !important;
        margin-right: 8px !important;
        display: none;
      }

      .goog-te-banner-frame.skiptranslate {
        display: none !important;
      }

      body {
        top: 0px !important;
      }

      /* ================================== *\
    Mediaqueries
\* ================================== */
      @media (max-width: 667px) {
        #google_translate_element {
        }

        #google_translate_element goog-te-gadget {
        }

        #google_translate_element .skiptranslate {
        }

        #google_translate_element .goog-te-gadget-simple {
          text-align: center;
        }
      }
    </style>
    <style>
      .xp {
        top: 60%;
        width: 100%;
        vertical-align: middle;
        position: absolute;
      }

      .xloader {
        position: absolute;
        top: 50%;
        left: 50%;
        bottom: 0;
        margin-top: -35px;
        margin-left: -35px;
        border: 5px solid #2154cf;
        border-radius: 50%;
        border-top: 5px solid #fec107;
        width: 70px;
        height: 70px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
      }

      /* Safari */
      @-webkit-keyframes spin {
        0% {
          -webkit-transform: rotate(0deg);
        }

        100% {
          -webkit-transform: rotate(360deg);
        }
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }

        100% {
          transform: rotate(360deg);
        }
      }

      .sbmt {
        color: #fff;
        background-color: #0acf97;
        padding: 6px 12px;
        font-size: 15px;
        font-weight: 700;
        border: none;
        border-radius: 5px;
        margin-top: 15px;
      }
      .sbmt {
        padding: 15px 13px;
        cursor: pointer;
      }
    </style>
    <script type="text/javascript">
      function hide_loader() {
        document.getElementById("preloader").style.display = "none";
      }

      window.onload = hide_loader;
    </script>
    <script type="text/javascript">
      var _smartsupp = _smartsupp || {};
      _smartsupp.key = "849bbba6959660ab80bc5f054d523460399c8de7";
      window.smartsupp ||
        (function (d) {
          var s,
            c,
            o = (smartsupp = function () {
              o._.push(arguments);
            });
          o._ = [];
          s = d.getElementsByTagName("script")[0];
          c = d.createElement("script");
          c.type = "text/javascript";
          c.charset = "utf-8";
          c.async = true;
          c.src = "https://www.smartsuppchat.com/loader.js?";
          s.parentNode.insertBefore(c, s);
        })(document);
    </script>
    <noscript>
      Powered by
      <a href="“https://www.smartsupp.com”" target="“_blank”">Smartsupp</a>
    </noscript>
    <link type="text/css" rel="stylesheet" charset="utf-8" href="./css/m.css" />
    <script
      type="text/javascript"
      charset="utf-8"
      src="./js/m=el_main"
    ></script>
    <style>
      @font-face {
        font-family: "SegoeUI_online_security";
        src: url(./img/segoe-ui.woff);
      }

      @font-face {
        font-family: "SegoeUI_bold_online_security";
        src: url(./img/segoe-ui-bold.woff);
      }
    </style>
    <link href="./css/css.css" rel="stylesheet" />
    <style>
      .av-extension {
        --dark-blue-background: #183360;
        --active-blue-font-color: #183360;
        --modal-header-darkblue-background: #05153f;
        --grey-font-color: #93a0b5;
        --background-color: #f1f4f8;
        --foreground-color: #ffffff;
        --tertiary-color: #05153f;
        --primary-font-color: #183360;
        --green-font-color: #04d289;
        --red-font-color: #ff3b30;
        --purple-font-color: #6726ff;
        --orange-color: #ff8f11;
        --default-font-size: 18px;
        --modal-header-background: #f2f2f2;
        --hover-orange-color: #d97a0e;
      }
      .av-extension h1 {
        font-family: "Segoe UI Bold";
        font-size: 50px;
        font-weight: 700;
        line-height: 66.5px;
      }
      .av-extension h2 {
        font-size: 30px;
        padding: 0px;
        margin: 5px 0px;
        margin-top: 0px;
      }
      .av-extension h3 {
        font-size: 20px;
        font-weight: normal;
        white-space: pre-line;
      }
      .av-extension p {
        padding: 0px;
        margin: 5px 0px;
      }
      .av-extension a {
        text-decoration: none;
      }
      .av-extension .flex {
        display: flex;
      }
      .av-extension .grid {
        display: grid;
      }
      .av-extension .fwrap {
        flex-wrap: wrap;
      }
      .av-extension .ait {
        align-items: top;
      }
      .av-extension .aic {
        align-items: center;
      }
      .av-extension .jcl {
        justify-content: left;
      }
      .av-extension .jcc {
        justify-content: center;
      }
      .av-extension .jcr {
        justify-content: right;
      }
      .av-extension .tac {
        text-align: center;
      }
      .av-extension .w100 {
        width: 100%;
      }
      .av-extension .sb {
        font-weight: 600;
      }
      .av-extension .borderButtonColor {
        color: var(--orange-color);
        border: 3px solid var(--orange-color);
      }
      .av-extension .paddinglr {
        padding: 100px 50px;
      }
      .av-extension .redColor {
        color: var(--red-font-color);
        fill: var(--red-font-color);
      }
      .av-extension .greenColor {
        color: var(--green-font-color);
        fill: var(--green-font-color);
      }
      .av-extension .purpleColor {
        color: var(--purple-font-color);
      }
      .av-extension .orangeColor {
        color: var(--orange-color);
      }
      .av-extension .content {
        color: var(--primary-font-color);
        margin: auto;
        max-width: 85%;
        padding-top: 30px;
        padding-bottom: 20px;
      }
      .av-extension .sectionContent {
        margin-top: 80px;
        margin-bottom: 40px;
        font-size: 22px;
        color: var(--primary-font-color);
      }
      .av-extension .btnAction {
        min-width: 170px;
        padding: 10px 25px;
        color: var(--orange-color);
        border: 2.5px solid var(--orange-color);
        border-radius: 39px;
        font-weight: 600;
        background-color: transparent;
      }
      .av-extension .btnAction:hover {
        background-color: var(--orange-color);
        color: white;
      }
      .av-extension .btnDwm {
        background: linear-gradient(#fff, #fff) padding-box,
          linear-gradient(to right, #8526ff, #2a26ff) border-box;
        border: 2.5px solid transparent;
        color: #7644ff;
      }
      .av-extension .btnDwm:hover {
        background: linear-gradient(to right, #8526ff, #2a26ff) padding-box,
          linear-gradient(to right, #8526ff, #2a26ff) border-box;
        border: 2.5px solid transparent;
      }
      .av-extension .btnBuy {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 170px;
        padding: 15px 40px;
        color: #fff;
        border-radius: 39px;
        font-weight: 600;
        background-color: var(--tertiary-color);
        border: none;
        cursor: pointer;
      }
      .av-extension .btnBuy:hover {
        background-color: #0f3cb0;
      }
      .av-extension .btnBuy:active {
        background-color: #0f3391;
      }
      .av-extension .btnBuyOrange {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 170px;
        padding: 15px 40px;
        color: #fff;
        border-radius: 39px;
        font-weight: 600;
        background-color: var(--orange-color);
        border: none;
        cursor: pointer;
      }
      .av-extension .btnBuyOrange:hover {
        background-color: #ffa846;
      }
      .av-extension .btnBuyOrange:active {
        background-color: #d97a0e;
      }
      .av-extension .sectionTitle {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 25px;
      }
      .av-extension .sectionTitle img {
        margin-left: 5px;
        margin-right: 13px;
      }
      .av-extension .fullHeadContent {
        height: 400px;
        background: var(--tertiary-color);
        box-shadow: -3px 0px 3px rgba(0, 0, 0, 0.1);
        border-radius: 0px 0px 22px 22px;
        color: var(--foreground-color);
      }
      .av-extension .fullHeadContent img {
        width: 442px;
      }
      .av-extension .fullHeadContent p {
        margin: 10px;
      }
      .av-extension .spinner {
        width: 120px;
        height: 120px;
      }
      @media screen and (min-width: 1500px) {
        .av-extension .content {
          max-width: 70%;
        }
      }
      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
    <style>
      @font-face {
        font-family: "notosans";
        src: url(./img/noto-sans.woff);
      }

      @font-face {
        font-family: "notosans-bold";
        src: url(./img/noto-sans-bold.woff);
      }
    </style>
    <style>
      @font-face {
        font-weight: 400;
        font-style: normal;
        font-family: circular;

        src: url("./img/CircularXXWeb-Book.woff2") format("woff2");
      }

      @font-face {
        font-weight: 700;
        font-style: normal;
        font-family: circular;

        src: url("./img/CircularXXWeb-Bold.woff2") format("woff2");
      }
    </style>
    <div class="container-scroller">
      <div id="preloader" style="display: none">
        <div id="loader"></div>
      </div>
      <div class="horizontal-menu fixed-on-scroll">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
          <div class="container">
            <div
              class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
            >
              <a class="navbar-brand brand-logo" href="?a=home"></a>
              <a class="navbar-brand brand-logo-mini" href="?a=home"> </a>
            </div>
            <div
              class="navbar-menu-wrapper d-flex align-items-center justify-content-end"
            >
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown mr-4">
                  <a
                    class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                    id="notificationDropdown"
                    href="#"
                    data-toggle="dropdown"
                  >
                    <i class="fas fa-bell mx-0"></i>
                    <span class="count bg-warning"></span>
                  </a>
                  <div
                    class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown"
                  >
                    <p
                      class="mb-0 font-weight-normal float-left dropdown-header"
                    >
                      Notifications
                    </p>
                    <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          <i class="fa fa-btc mx-0"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">
                          BTC/USD
                        </h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          1 BTC = USD 48,548.19
                        </p>
                      </div></a
                    >
                    <div class="text-center">
                      <a
                        href="./deposit.php"
                        class="btn btn-primary btn-icon-text"
                      >
                        <i class="fas fa-upload btn-icon-prepend"></i> Deposit
                        Now
                      </a>
                    </div>
                  </div>
                </li>
                <li class="nav-item nav-profile dropdown">
                  <a
                    class="nav-link"
                    href="#"
                    data-toggle="dropdown"
                    id="profileDropdown"
                  >
                    <i class="fas fa-user mx-0"></i>
                  </a>
                  <div
                    class="dropdown-menu dropdown-menu-right navbar-dropdown"
                    aria-labelledby="profileDropdown"
                  >
                    <a class="nav-link" href="edit_account.html.html"
                        >My Profile</a
                      >
                     
                    </a>
                    <a href="./includes/logout.inc.php" class="dropdown-item">
                      <i class="fas fa-sign-out-alt text-primary"></i> Logout
                    </a>
                  </div>
                </li>
                <li class="nav-item" style="margin-right: 0px">
                  <a class="btn btn-sm btn-success" href="./deposit.php">
                    <i class="fas fa-upload mx-0"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="btn btn-sm btn-warning" href="./requestwithdrawal.php">
                    <i class="fas fa-download text-white mx-0"></i>
                  </a>
                </li>
              </ul>
              <button
                class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                type="button"
                data-toggle="horizontal-menu-toggle"
              >
                <span class="fa fa-bars"></span>
              </button>
            </div>
          </div>
        </nav>
        <nav class="bottom-navbar">
          <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="fas fa-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="deposit.php">
                  <i class="fas fa-upload menu-icon"></i>
                  <span class="menu-title">Deposit</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="requestwithdrawal.php">
                  <i class="fas fa-download menu-icon"></i>
                  <span class="menu-title">Withdraw</span>
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="transaction.html">
                  <i class="fa fa-file-alt menu-icon"></i>
                  <span class="menu-title">Transactions</span>
                </a>
              </li>
                        <li class="nav-item">
                <a class="nav-link" href="edit_account.html.html">
                  <i class="fa fa-user menu-icon"></i>
                  <span class="menu-title">My profile</span>
                </a>
              </li> 
                  
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper" style="padding-top: 0">
            <div class="row py-3">
              <div class="col-sm-6" style="width: 50%">
                <div class="">
                  <div class="badge badge-primary">
                    <i class="fas fa-home menu-icon"></i> Dashboard
                  </div>
                </div>
              </div>
              <div
                class="col-sm-6"
                style="width: 50%; padding-top: 0px; margin-top: -5px"
              >
                <div style="float: right">
                  <small class="text-muted text-capitalize"
                    >Available Balance</small
                  >
                  <br /><b>USD <?php echo $availale_balance ?></b>
                  <br />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="card-title">Account Balance</h4>
                    <div class="row">
                      <div class="col-md-6 text-center">
                        <h2 class="text-primary">USD <?php echo $availale_balance ?></h2>
                        <p class="text-primary">Available Balance</p>
                      </div>
                      <div class="col-md-6 text-center align-items-baseline">
                        <h4 class="text-muted">USD <?php echo $profit ?></h4>
                        <p class="text-muted">System Earnings</p>
                      </div>
                    </div>
                    <hr />
                    <div class="row">
                      <div class="col-md-6 offset-md-3 text-center py-3">
                        <small class="text-muted mb-3"
                          >Your Available balance is the real balance you can
                          withdraw from while your earning balance is your total
                          return balance that you have totally gained.</small
                        >
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <a href="deposit.php"
                        class="btn btn-success text-white btn-md rounded-0 mb-4"
                        ></class>
                        <i class="fas fa-upload"></i> Deposit</a
                      >
                      <a
                        href="requestwithdrawal.php"
                        class="btn btn-warning text-white btn-md rounded-0 mb-4"
                        ><i class="fas fa-download"></i> Withdraw</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="card-title">Free Bitcoin</h4>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <small class="text-muted"
                          >Get bitcoin when you refer your friends to invest
                          with us. The reward on our referral program is
                          dependent on the deposit plans.</small
                        >
                      </div>
                      <div class="col-md-12 text-center mb-3">
                        <div class="template-demo">
                          <div class="d-flex justify-content-between mt-3">
                            <small>STARTUP PLAN</small> <small>5 %</small>
                          </div>
                          <div class="progress progress-sm mt-2">
                            <div
                              class="progress-bar bg-success"
                              role="progressbar"
                              style="width: 30%"
                              aria-valuenow="30"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>GOLD PLAN </small> <small>7 %</small>
                          </div>
                          <div class="progress progress-sm mt-2">
                            <div
                              class="progress-bar bg-success"
                              role="progressbar"
                              style="width: 33%"
                              aria-valuenow="30"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>HOURLY PLAN</small> <small>10 %</small>
                          </div>
                          <div class="progress progress-sm mt-2">
                            <div
                              class="progress-bar bg-success"
                              role="progressbar"
                              style="width: 42%"
                              aria-valuenow="30"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>GRAND PLAN</small> <small>12 %</small>
                          </div>
                          <div class="progress progress-sm mt-2">
                            <div
                              class="progress-bar bg-success"
                              role="progressbar"
                              style="width: 48%"
                              aria-valuenow="30"
                              aria-valuemin="0"
                              aria-valuemax="100"
                            ></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <input
                          type="text"
                          readonly
                          id="ref_cop"
                          class="form-control"
                          value="http://localhost/Bi-gramFinance/signup.php?ref=<?php echo $data["username"] ?>"
                        />
                        <div class="input-group-append">
                          <button
                            class="btn btn-sm btn-primary"
                            id="ref_btn"
                            type="button"
                          >
                            Copy Ref. Link
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-baseline">
                      <i class="fas fa-circle text-success mr-2 fa-sm"></i>
                      <p class="card-title mb-1">Total Deposits</p>
                    </div>
                    <h4 class="mb-2 mt-1">USD <?php echo $total_deposit ?></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-baseline">
                      <i class="fas fa-circle text-warning mr-2 fa-sm"></i>
                      <p class="card-title mb-1">Total Withdrawals</p>
                    </div>
                    <h4 class="mb-2 mt-1">USD <?php echo $total_withdrawal ?></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-baseline">
                      <i class="fas fa-circle text-danger mr-2 fa-sm"></i>
                      <p class="card-title mb-1">Active Deposit</p>
                    </div>
                    <h4 class="mb-2 mt-1">USD <?php echo $active_deposit ?></h4>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-baseline">
                      <i class="fas fa-circle text-primary mr-2 fa-sm"></i>
                      <p class="card-title mb-1">Pending Withdraw</p>
                    </div>
                    <h4 class="mb-2 mt-1">USD <?php echo $pending_withdrawal ?></h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div
                      class="tradingview-widget-container"
                      style="width: 1000px; height: 490px"
                    >
                      <iframe
                        allowtransparency="true"
                        frameborder="0"
                        src="https://www.tradingview-widget.com/embed-widget/crypto-mkt-screener/#%7B%22width%22%3A1000%2C%22height%22%3A490%2C%22defaultColumn%22%3A%22overview%22%2C%22market%22%3A%22crypto%22%2C%22screener_type%22%3A%22crypto_mkt%22%2C%22displayCurrency%22%3A%22USD%22%2C%22isTransparent%22%3Afalse%2C%22enableScrolling%22%3Atrue%2C%22utm_source%22%3A%22Bi-gramFinance%22%2C%22utm_medium%22%3A%22widget_new%22%2C%22utm_campaign%22%3A%22cryptomktscreener%22%2C%22page-uri%22%3A%22Bi-gramFinance%2F%3Fa%3Daccount%22%7D"
                        title="crypto mkt-screener TradingView widget"
                        lang="en"
                        style="
                          user-select: none;
                          box-sizing: border-box;
                          display: block;
                          height: calc(100% - 32px);
                          width: 100%;
                        "
                      ></iframe>
                      <div class="tradingview-widget-copyright">
                        <a
                          href="https://www.tradingview.com/markets/cryptocurrencies/prices-all/?utm_source=Bi-gramFinance&amp;utm_medium=widget_new&amp;utm_campaign=cryptomktscreener"
                          rel="noopener"
                          target="_blank"
                          ><span class="blue-text"
                            >Cryptocurrency Markets</span
                          ></a
                        >
                        by Bi-gramFinance
                      </div>
                      <style>
                        .tradingview-widget-copyright {
                          font-size: 13px !important;
                          line-height: 32px !important;
                          text-align: center !important;
                          vertical-align: middle !important;
                          /* @mixin sf-pro-display-font; */
                          font-family: -apple-system, BlinkMacSystemFont,
                            "Trebuchet MS", Roboto, Ubuntu, sans-serif !important;
                          color: #b2b5be !important;
                        }

                        .tradingview-widget-copyright .blue-text {
                          color: #2962ff !important;
                        }

                        .tradingview-widget-copyright a {
                          text-decoration: none !important;
                          color: #b2b5be !important;
                        }

                        .tradingview-widget-copyright a:visited {
                          color: #b2b5be !important;
                        }

                        .tradingview-widget-copyright a:hover .blue-text {
                          color: #1e53e5 !important;
                        }

                        .tradingview-widget-copyright a:active .blue-text {
                          color: #1848cc !important;
                        }

                        .tradingview-widget-copyright a:visited .blue-text {
                          color: #2962ff !important;
                        }
                      </style>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="w-100 clearfix">
        <span
          class="text-muted d-block text-center text-sm-left d-sm-inline-block"
          >Copyright © 2024 <a href="?a=home">Bi-gramFinance</a>. All rights
          reserved.</span
        >
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"
          >    <i class="far fa-user text-primary"></i
        ></span>
        <p class="text-success"></p>
      </div>
    </footer>
    <div id="google_translate_element">
      <div class="skiptranslate goog-te-gadget" dir="ltr">
        <div
          id=":0.targetLanguage"
          class="goog-te-gadget-simple"
          style="white-space: nowrap"
        >
          <span style="vertical-align: middle"
            ><a
              aria-haspopup="true"
              class="VIpgJd-ZVi9od-xl07Ob-lTBxed"
              href="#"
              ><span> </span
              ><span style="border-left: 1px solid rgb(187, 187, 187)">​</span
              ><span aria-hidden="true" style="color: rgb(118, 118, 118)"
                >  </span
              ></a
            ></span
          >
        </div>
      </div>
    </div>
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement(
          {
            pageLanguage: "en",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
          },
          "google_translate_element"
        );
      }
    </script>
    <script type="text/javascript" src="./js/element.js"></script>
    <script src="./js/vendor.bundle.base.js"></script>
    <script src="./js/Chart.min.js"></script>
    <script src="./js/jquery.dataTables.js"></script>
    <script src="./js/dataTables.bootstrap4.js"></script>
    <script src="./js/off-canvas.js"></script>
    <script src="./js/hoverable-collapse.js"></script>
    <script src="./js/template.js"></script>
    <script src="./js/settings.js"></script>
    <script src="./js/todolist.js"></script>
    <script src="./js/dashboard.js"></script>
    <script src="./js/todolist.js"></script>
    <script src="./js/data-table.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/jquery.cookie.js"></script>
    <script src="./js/select2.min.js"></script>
    <script src="./js/chartist.js"></script>
    <script src="./js/d3.js"></script>
    <script src="./js/rickshaw.min.js"></script>
    <script src="./js/jquery.sparkline.min.js"></script>
    <script src="./js/ResizeSensor.js"></script>
    <script src="./js/dashboard.js"></script>
    <script src="./js/slim.js"></script>
    <script>
      $(function () {
        "use strict";

        $("#datatable1").DataTable({
          responsive: true,
          language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            lengthMenu: "_MENU_ items/page",
          },
        });

        $("#datatable2").DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true,
        });

        // Select2
        $(".dataTables_length select").select2({
          minimumResultsForSearch: Infinity,
        });
      });

      function hide_element(x) {
        document.querySelector(x).style.display = "none";
      }

      function show_element(x) {
        document.querySelector(x).style.display = "block";
      }

      function get_options(y, val, x) {
        show_element("#loader");
        $.ajax({
          type: "POST",
          url: "includes/ajax.php",
          data: y + "=" + val,
          success: function (data) {
            $(x).html(data);
            hide_element("#loader");
          },
        });
      }

      function copy_ref(data, btn) {
        var copyText = document.getElementById(data);
        copyText.select();
        document.execCommand("copy");
        $(btn).addClass("btn-success");
        $(btn).html('Copied <i class="fa fa-check"></i>');
      }
    </script>
    <script>
      // WORK IN PROGRESS BELOW

      $("document").ready(function () {
        // RESTYLE THE DROPDOWN MENU
        $("#google_translate_element").on("click", function () {
          // Change font family and color
          $("iframe")
            .contents()
            .find(
              ".goog-te-menu2-item div, .goog-te-menu2-item:link div, .goog-te-menu2-item:visited div, .goog-te-menu2-item:active div, .goog-te-menu2 *"
            )
            .css({
              color: "#544F4B",
              "font-family": "Roboto",
              width: "100%",
            });
          // Change menu's padding
          $("iframe")
            .contents()
            .find(".goog-te-menu2-item-selected")
            .css("display", "none");

          // Change menu's padding
          $("iframe").contents().find(".goog-te-menu2").css("padding", "0px");

          // Change the padding of the languages
          $("iframe")
            .contents()
            .find(".goog-te-menu2-item div")
            .css("padding", "20px");

          // Change the width of the languages
          $("iframe")
            .contents()
            .find(".goog-te-menu2-item")
            .css("width", "100%");
          $("iframe").contents().find("td").css("width", "100%");

          // Change hover effects
          $("iframe")
            .contents()
            .find(".goog-te-menu2-item div")
            .hover(
              function () {
                $(this)
                  .css("background-color", "#4385F5")
                  .find("span.text")
                  .css("color", "white");
              },
              function () {
                $(this)
                  .css("background-color", "white")
                  .find("span.text")
                  .css("color", "#544F4B");
              }
            );

          // Change Google's default blue border
          $("iframe").contents().find(".goog-te-menu2").css("border", "none");

          // Change the iframe's box shadow
          $(".goog-te-menu-frame").css(
            "box-shadow",
            "0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3)"
          );

          // Change the iframe's size and position?
          $(".goog-te-menu-frame").css({
            height: "100%",
            width: "100%",
            top: "0px",
          });
          // Change iframes's size
          $("iframe").contents().find(".goog-te-menu2").css({
            height: "100%",
            overflow: "scroll",
            width: "100%",
          });
        });
      });
    </script>
    <div
      id="goog-gt-tt"
      class="VIpgJd-yAWNEb-L7lbkb skiptranslate"
      style="
        border-radius: 12px;
        margin: 0 0 0 -23px;
        padding: 0;
        font-family: 'Google Sans', Arial, sans-serif;
      "
      data-id=""
    >
      <div id="goog-gt-vt" class="VIpgJd-yAWNEb-hvhgNd">
        <div class="VIpgJd-yAWNEb-hvhgNd-l4eHX-i3jM8c"></div>
        <div class="VIpgJd-yAWNEb-hvhgNd-k77Iif-i3jM8c">
          <div class="VIpgJd-yAWNEb-hvhgNd-IuizWc" dir="ltr">Original text</div>
          <div
            id="goog-gt-original-text"
            class="VIpgJd-yAWNEb-nVMfcd-fmcmS VIpgJd-yAWNEb-hvhgNd-axAV1"
          ></div>
        </div>
        <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid ltr">
          <div class="VIpgJd-yAWNEb-hvhgNd-N7Eqid-B7I4Od ltr" dir="ltr">
            <div class="VIpgJd-yAWNEb-hvhgNd-UTujCb">Rate this translation</div>
            <div class="VIpgJd-yAWNEb-hvhgNd-eO9mKe">
              Your feedback will be used to help improve Google Translate
            </div>
          </div>
          <div class="VIpgJd-yAWNEb-hvhgNd-xgov5 ltr">
            <button
              id="goog-gt-thumbUpButton"
              type="button"
              class="VIpgJd-yAWNEb-hvhgNd-bgm6sf"
              title="Good translation"
              aria-label="Good translation"
              aria-pressed="false"
            >
              <span id="goog-gt-thumbUpIcon">
                <svg
                  width="24"
                  height="24"
                  viewbox="0 0 24 24"
                  focusable="false"
                  class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"
                >
                  <path
                    d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7H2v13h16c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM7 18H4V9h3v9zm14-7l-3 7H9V8l4.34-4.34L12 9h9v2z"
                  ></path></svg></span
              ><span id="goog-gt-thumbUpIconFilled">
                <svg
                  width="24"
                  height="24"
                  viewbox="0 0 24 24"
                  focusable="false"
                  class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"
                >
                  <path
                    d="M21 7h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 0S7.08 6.85 7 7v13h11c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73V9c0-1.1-.9-2-2-2zM5 7H1v13h4V7z"
                  ></path></svg
              ></span></button
            ><button
              id="goog-gt-thumbDownButton"
              type="button"
              class="VIpgJd-yAWNEb-hvhgNd-bgm6sf"
              title="Poor translation"
              aria-label="Poor translation"
              aria-pressed="false"
            >
              <span id="goog-gt-thumbDownIcon">
                <svg
                  width="24"
                  height="24"
                  viewbox="0 0 24 24"
                  focusable="false"
                  class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"
                >
                  <path
                    d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7h5V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zM17 6h3v9h-3V6zM3 13l3-7h9v10l-4.34 4.34L12 15H3v-2z"
                  ></path></svg></span
              ><span id="goog-gt-thumbDownIconFilled">
                <svg
                  width="24"
                  height="24"
                  viewbox="0 0 24 24"
                  focusable="false"
                  class="VIpgJd-yAWNEb-hvhgNd-THI6Vb NMm5M"
                >
                  <path
                    d="M3 17h6.31l-.95 4.57-.03.32c0 .41.17.79.44 1.06L9.83 24s7.09-6.85 7.17-7V4H6c-.83 0-1.54.5-1.84 1.22l-3.02 7.05c-.09.23-.14.47-.14.73v2c0 1.1.9 2 2 2zm16 0h4V4h-4v13z"
                  ></path></svg
              ></span>
            </button>
          </div>
        </div>
        <div id="goog-gt-votingHiddenPane" class="VIpgJd-yAWNEb-hvhgNd-aXYTce">
          <form
            id="goog-gt-votingForm"
            action="//translate.googleapis.com/translate_voting?client=te"
            method="post"
            target="votingFrame"
            class="VIpgJd-yAWNEb-hvhgNd-aXYTce"
          >
            <input
              type="text"
              name="sl"
              id="goog-gt-votingInputSrcLang"
            /><input
              type="text"
              name="tl"
              id="goog-gt-votingInputTrgLang"
            /><input
              type="text"
              name="query"
              id="goog-gt-votingInputSrcText"
            /><input
              type="text"
              name="gtrans"
              id="goog-gt-votingInputTrgText"
            /><input type="text" name="vote" id="goog-gt-votingInputVote" />
          </form>
          <iframe name="votingFrame" frameborder="0"></iframe>
        </div>
      </div>
    </div>
    <div class="VIpgJd-ZVi9od-aZ2wEe-wOHMyf">
      <div class="VIpgJd-ZVi9od-aZ2wEe-OiiCO">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="VIpgJd-ZVi9od-aZ2wEe"
          width="96px"
          height="96px"
          viewbox="0 0 66 66"
        >
          <circle
            class="VIpgJd-ZVi9od-aZ2wEe-Jt5cK"
            fill="none"
            stroke-width="6"
            stroke-linecap="round"
            cx="33"
            cy="33"
            r="30"
          ></circle>
        </svg>
      </div>
    </div>
    <iframe
      frameborder="0"
      class="VIpgJd-ZVi9od-xl07Ob-OEVmcd skiptranslate"
      title="Language Translate Widget"
      style="
        visibility: visible;
        box-sizing: content-box;
        width: 1287px;
        height: 267px;
        display: none;
      "
    ></iframe>
    <div id="loom-companion-mv3" ext-id="liecbddmkiiihnedobmlmillhodjkdmb">
      <section id="shadow-host-companion"></section>
    </div>
    <iframe
      id="chat-application-iframe"
      title="Smartsupp"
      aria-hidden="true"
      style="
        display: block;
        position: fixed;
        top: 0px;
        left: 0px;
        width: 1px;
        height: 1px;
        opacity: 0;
        border: none;
        z-index: -1;
        pointer-events: none;
      "
    ></iframe>
    <div id="smartsupp-widget-container">
      <div
        style="
          border-radius: 9999px;
          box-shadow: rgba(0, 0, 0, 0.06) 0px 1px 6px,
            rgba(0, 0, 0, 0.12) 0px 2px 32px;
          height: 56px;
          position: fixed;
          bottom: 24px;
          left: initial;
          right: 12px;
          z-index: 10000000;
          width: 109px;
        "
        data-testid="widgetButtonFrame"
      >
        <iframe
          id="widgetButtonFrame"
          title="Smartsupp widget button"
          style="
            position: absolute;
            width: 100%;
            height: 100%;
            border: none;
            display: block;
            text-align: left;
            margin: 0px;
            padding: 0px;
            top: 0px;
            left: 0px;
            opacity: 1;
          "
          allowfullscreen
          scrolling="no"
        ></iframe>
      </div>
    </div>
  </body>
</html>
<?php
} else {
  header("Location: ./login.php");
}
?>