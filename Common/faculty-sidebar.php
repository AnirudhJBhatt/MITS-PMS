<div class="sidebar border-end">
            <div class="sidebar-header">
                <div class="nav-item">
                    <a class="nav-link text-white" href="../Faculty/faculty-index.php">
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
                    <a class="nav-link <?= ($current_page == 'faculty-info.php') ? 'active' : ''; ?>" href="../Faculty/faculty-info.php">
                        <i class="bi bi-person-circle"></i> Personal Profile
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'add-student.php') ? 'active' : ''; ?>" href="../Faculty/add-student.php">
                        <i class="bi bi-person-plus-fill"></i> Add Students
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'update-data.php') ? 'active' : ''; ?>" href="../Faculty/update-data.php">
                        <i class="bi bi-database-fill-add"></i> Update Data
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'campus-drive.php') ? 'active' : ''; ?>" href="../Faculty/campus-drive.php">
                        <i class="bi bi-cloud-arrow-down-fill"></i> Campus Drive
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'view-data.php') ? 'active' : ''; ?>" href="../Faculty/view-data.php">
                        <i class="bi bi-database"></i> View Data
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'view-coordinators.php') ? 'active' : ''; ?>" href="../Faculty/view-coordinators.php">
                        <i class="bi bi-card-list"></i> View Coordinators
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'placement-statistics.php') ? 'active' : ''; ?>" href="../Faculty/placement-statistics.php">
                        <i class="bi bi-graph-up"></i> Placement Statistics
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'faculty-password.php') ? 'active' : ''; ?>" href="../Faculty/faculty-password.php">
                        <i class="bi bi-gear-fill"></i> Manage Account
                    </a>
                </li>
            </ul>
        </div>