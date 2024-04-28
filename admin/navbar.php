    <?php
    require "../includes/db.inc.php";
    $sql = "SELECT * FROM `admin`;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
    <!-- ===================== SIDE NAVIGATION ======================== -->
    <nav class="shadow-sm nav-collapse">
      <div class="nav-logo center">
        <div class="logo center"><img src="#" alt="Logo"></div>
      </div>
      <hr>
      <div class="nav-header">
        <div class="nav-text">
          <h5><strong><?php echo $row['username']; ?></strong></h5>
          <h6>Admin</h6>
        </div>
      </div>
      <div class="nav-body">
        <div class="links">
          <ul>
            <a href="./index.php">
              <li>
                <div class="link">
                  <div class="icon">
                    <i class="bi bi-columns-gap"></i>
                  </div>
                  <p>Dashboard</p>
            </div>
          </li>
          </a>
          <a href="./deposits.php">
                    <li>
                      <div class="link">
                        <div class="icon">
                          <i class="bi bi-people"></i>
                        </div>
                        <p>Deposits</p>
                  </div>
                </li>
                </a>
          <a href="./withdrawals.php">
                    <li>
                      <div class="link">
                        <div class="icon">
                          <i class="bi bi-people"></i>
                        </div>
                        <p>Withdrawals</p>
                  </div>
                </li>
                </a>
          <a href="../includes/admin-logout.inc.php">
            <li>
              <div class="link">
                <div class="icon">
                  <i class="bi bi-box-arrow-right"></i>
                </div>
                <p>Logout</p>
          </div>
        </li>
        </a>
          </ul>
        </div>
      </div>
    </nav>