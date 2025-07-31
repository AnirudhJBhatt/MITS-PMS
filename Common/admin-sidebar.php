        <div class="sidebar border-end">
            <div class="sidebar-header">
                <div class="nav-item">
                    <a class="nav-link text-white" href="../Admin/admin-dashboard.php">
                        <span class="home"></span>
                        <i class="bi bi-house-door" aria-hidden="true"></i> Dashboard 
                    </a>
                </div>
            </div>
            <?php
                $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'user-registration.php') ? 'active' : ''; ?>" href="../Admin/user-registration.php">
                        <i class="bi bi-person-fill"></i> User Registration
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'company-registration.php') ? 'active' : ''; ?>" href="../Admin/company-registration.php">
                        <i class="bi bi-building"></i> Company Registration
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'campus-drive.php') ? 'active' : ''; ?>" href="../Admin/campus-drive.php">
                        <i class="bi bi-calendar-plus"></i> Add Drive
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'drive-details.php') ? 'active' : ''; ?>" href="../Admin/drive-details.php">
                        <i class="bi bi-person-lines-fill"></i> Drive Applicants
                    </a>
                </li>
                <!-- <li>
                    <a class="nav-link <?= ($current_page == 'quizes.php') ? 'active' : ''; ?>" href="../Admin/quizes.php">
                        <i class="bi bi-gear-fill"></i> Add Exam
                    </a>
                </li> -->
                <li>
                    <a class="nav-link <?= ($current_page == 'placement-data.php') ? 'active' : ''; ?>" href="../Admin/placement-data.php">
                        <i class="bi bi-info-circle"></i> View Placement Data
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'search.php') ? 'active' : ''; ?>" href="../Admin/search.php">
                        <i class="bi bi-search"></i> Search
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'placement-statistics.php') ? 'active' : ''; ?>" href="../Admin/placement-statistics.php">
                        <i class="bi bi-bar-chart-fill"></i> Placement Statistics
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'manage-accounts.php') ? 'active' : ''; ?>" href="../Admin/manage-accounts.php">
                        <i class="bi bi-gear-fill"></i> Manage Account
                    </a>
                </li>
            </ul>
        </div>