  <div class="row w-100">
    <button class="show-btn button-show ml-auto">
      <i class="fa fa-bars py-1" aria-hidden="true"></i>
    </button> 
  </div>
    <nav id="sidebarMenu" class="">
			<div class="col-xl-2 col-lg-3 col-md-4 sidebar position-fixed border-right">
        <div class="sidebar-header">
          <div class="nav-item">
              <a class="nav-link text-white" href="../admin/admin-index.php">
                <span class="home"></span>
                  <i class="fa fa-home mr-2" aria-hidden="true"></i> Dashboard 
              </a>
          </div>
        </div>   
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="../admin/student.php">
              <span data-feather="file"></span>
              <i class="fa fa-user mr-2" aria-hidden="true"></i> User Registration
            </a>
		      </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/company.php">
              <span data-feather="shopping-cart"></span>
              <i class="fa fa-globe mr-2" aria-hidden="true"></i> Company Registration
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/campus-drive.php">
              <span data-feather="bar-chart-2"></span>
              <i class="fa fa-plus mr-2" aria-hidden="true"></i> Add Drive
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/view-applicants.php">
              <span data-feather="users"></span>
              <i class="fa fa-bars mr-2" aria-hidden="true"></i> Drive Applicants
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/view-students-data.php">
              <span data-feather="layers"></span>
              <i class="fa fa-users mr-2" aria-hidden="true"></i> View Placement Data
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/placement-statistics.php">
              <span data-feather="layers"></span>
              <i class="fa fa-bar-chart mr-2" aria-hidden="true"></i> Placement Statistics
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/search.php">
              <span data-feather="layers"></span>
              <i class="fa fa-search mr-2" aria-hidden="true"></i> Search
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/manage-accounts.php">
              <span data-feather="layers"></span>
              <i class="fa fa-key mr-2" aria-hidden="true"></i> Manage Account
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <script>
        const toggleBtn = document.querySelector(".show-btn");
        const sidebar = document.querySelector(".sidebar");
        // undefined
        toggleBtn.addEventListener("click",function(){
            sidebar.classList.toggle("show-sidebar");
        });
    </script>