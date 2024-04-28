<!-- OVERLAY -->
<div class="overlay"></div>
<div class="loading-cover"></div>
<div class="loading">
    <h1><i class="bi bi-arrow-clockwise"></i></h1>
    Loading...</div>
<!-- ======================= HEADER ========================= -->
<div class="page-content">
    <header class="shadow-sm">
      <div class="header-logo">
        <div class="dash center"><i class="bi bi-border-width"></i></div>
        <div class="logo"><img src="#" alt="Logo"></div>
      </div>
      <div class="extra">
        <div class="profile">
          <i class="bi bi-person"></i>
          <div class="accounts">
            <!-- <div class="account acccount-profile d-flex align-items-center">
              <i class="bi bi-person"></i>
              <span>Profile</span>
            </div> -->
            <a href="#">
            <div class="account account-setting d-flex align-items-center">
              <i class="bi bi-gear"></i>
              <span>Settings</span>
            </div>
            </a>
            <a href="../includes/admin-logout.inc.php">
            <div class="account account-logout d-flex align-items-center">
              <i class="bi bi-box-arrow-right"></i>
              <span>Logout</span>
            </div>
            </a>
          </div>
        </div>
        <div class="notification">
          <i class="bi bi-bell"></i>
          <div class="card">
            <div class="card-header">Notifications</div>
            <div class="card-body">
              <!-- <div class="notes">
                <?php
                  if ($result_checker > 0) {
                    while ($row = mysqli_fetch_assoc($result)) :   
                ?>
                <div class="note d-flex align-items-center">
                  <div class="note-icon"><span class="badge bg-warning">new</span></div>
                  <div class="note-body">
                    <p><?php echo $row['body'] ?></p>
                    <span><?php echo $row['date_created'] ?></span>
                  </div>
                </div>
                <hr>
                <?php
                endwhile;
              }
              ?>
              </div> -->
            </div>
            <div class="card-footer text-center"><span>Dismiss</span></div>
          </div>
        </div>
        <div class="mode">
          <i class="bi bi-moon hide"></i>
          <i class="bi bi-brightness-high-fill"></i>
        </div>
      </div>
    </header>