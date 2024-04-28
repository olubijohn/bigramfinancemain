<?php
  session_start();
if (isset($_SESSION['id']) && isset($_SESSION['balance'])) {
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
                  <br /><b>USD <?php echo $_SESSION['balance'] ?></b>
                  <br />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 offset-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Request Withdrawal</h3>
                    <script language="javascript">
                      <!--
                      function openCalculator(id) {
                        w = 225;
                        h = 400;
                        t = (screen.height - h - 30) / 2;
                        l = (screen.width - w - 30) / 2;
                        window.open(
                          "?a=calendar&type=" + id,
                          "calculator" + id,
                          "top=" +
                            t +
                            ",left=" +
                            l +
                            ",width=" +
                            w +
                            ",height=" +
                            h +
                            ",resizable=1,scrollbars=0"
                        );

                        for (i = 0; i < document.spendform.h_id.length; i++) {
                          if (document.spendform.h_id[i].value == id) {
                            document.spendform.h_id[i].checked = true;
                          }
                        }
                      }

                      function updateCompound() {
                        var id = 0;
                        var tt = document.spendform.h_id.type;
                        if (tt && tt.toLowerCase() == "hidden") {
                          id = document.spendform.h_id.value;
                        } else {
                          for (i = 0; i < document.spendform.h_id.length; i++) {
                            if (document.spendform.h_id[i].checked) {
                              id = document.spendform.h_id[i].value;
                            }
                          }
                        }

                        var cpObj =
                          document.getElementById("compound_percents");
                        if (cpObj) {
                          while (cpObj.options.length != 0) {
                            cpObj.options[0] = null;
                          }
                        }

                        if (cps[id] && cps[id].length > 0) {
                          document.getElementById(
                            "coumpond_block"
                          ).style.display = "";

                          for (i in cps[id]) {
                            cpObj.options[cpObj.options.length] = new Option(
                              cps[id][i]
                            );
                          }
                        } else {
                          document.getElementById(
                            "coumpond_block"
                          ).style.display = "none";
                        }
                      }
                      var cps = {};
                      -->
                    </script>
                      <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                      <?php
                if (isset($_GET['error'])) {
                  if ($_GET['error'] == "insufficient") {
                    echo '<div id="snackbar" class="text-center" style="color: red;">Insufficient Balance!</div>';
                  }
                }
                ?>
            <form method="post" action="./includes/withdrawal.inc.php">
          <div class="preview-block">
           <div class="row gy-4">
            <div class="col-sm-12">
             <div class="form-group">
              <label class="form-label" for="default-03">Withdrawal Amount</label>
              <div class="form-control-wrap">
               <div class="form-icon form-icon-left">
                <em class="icon ni ni-sign-usd-alt"></em>
               </div><input type="tel" class="form-control" id="default-03" name="amount" placeholder="" required>
              </div>
             </div>
             <div class="form-group">
              <div class="form-control-wrap">
               <div class="form-group">
                <label class="form-label" for="fv-topics">Withdrawal Method</label>
                <div class="form-control-wrap ">
                 <select class="form-control currency" id="currency" name="method" data-placeholder="Choose Withdrawal Method" required> <option>bitcoin</option> <option>ethereum</option> <option>trc20</option> <option>BNB</option> <option>tron</option> <option>dogecoin</option> <option>Litecoin</option> </select>
                </div>
               </div>
              </div>
             </div>
             <div class="form-group">
              <label class="form-label" for="default-03">Withdrawal Address</label>
              <div class="form-control-wrap">
               <input type="text" class="form-control" id="address" name="address" placeholder="" value="" required>
              </div>
             </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="col-md-12 mt-3">
             <div class="form-group">
              <button type="submit" name="submit" class="btn btn-lg btn-primary">proceed</button>
             </div>
            </div>
           </div>
          </div>
         </form>
           </div>
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
          <span
            class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"
          >
            <i class="far fa-user text-primary"></i
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
                ><span aria-hidden="true" style="color: rgb(118, 118, 118)">
                </span></a
            ></span>
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
    </div>
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
  </body>
</html>
<?php
} else {
  header("Location: ./login.php");
}
?>