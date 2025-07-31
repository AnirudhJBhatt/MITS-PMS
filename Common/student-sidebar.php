        <div class="sidebar border-end">
            <div class="sidebar-header">
                <div class="nav-item">
                    <a class="nav-link text-white" href="../Student/student-index.php">
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
                    <a class="nav-link <?= ($current_page == 'student-info.php') ? 'active' : ''; ?>" href="../Student/student-info.php">
                        <i class="bi bi-person-circle"></i> Personal Profile
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'student-drive.php') ? 'active' : ''; ?>" href="../Student/student-drive.php">
                        <i class="bi bi-building"></i> Campus Drives
                    </a>
                </li>
                <!-- <li>
                    <a class="nav-link <?= ($current_page == 'student-exams.php') ? 'active' : ''; ?>" href="../Student/student-exams.php">
                        <i class="bi bi-building"></i> Exam
                    </a>
                </li> -->
                <li>
                    <a class="nav-link <?= ($current_page == 'student-applications.php') ? 'active' : ''; ?>" href="../Student/student-applications.php">
                        <i class="bi bi-clock"></i> Applications
                    </a>
                </li>
                <li>
                    <a class="nav-link <?= ($current_page == 'student-password.php') ? 'active' : ''; ?>" href="../Student/student-password.php">
                        <i class="bi bi-gear-fill"></i> Manage Account
                    </a>
                </li>
            </ul>
        </div>