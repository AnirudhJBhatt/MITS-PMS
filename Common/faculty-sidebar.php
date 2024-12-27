	<div class="row w-100">
		<button class="show-btn button-show ml-auto">
		<i class="fa fa-bars py-1" aria-hidden="true"></i>
		</button> 
	</div>
		<nav id="sidebarMenu" class="">
			<div class="col-xl-2 col-lg-3 col-md-4 sidebar position-fixed border-right">
        		<div class="sidebar-header">
					<a class="nav-link text-white" href="../faculty/faculty-index.php">
					<span class="home"></span>
						<i class="fa fa-home mr-2" aria-hidden="true"></i> Dashboard
					</a>
				</div>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="../faculty/faculty-info.php">
						<span data-feather="file"></span>
						<i class="fa fa-user-circle mr-2" aria-hidden="true"></i> Personal Profile
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/add-student.php">
						<span data-feather="file"></span>
						<i class="fa fa-user-plus mr-2" aria-hidden="true"></i> Batch Registration
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/view-students-data.php">
						<span data-feather="file"></span>
						<i class="fa fa-users mr-2" aria-hidden="true"></i> View Students Data
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/update-marks.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-database mr-2" aria-hidden="true"></i> Update Student Data
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/view-applicants.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-bars mr-2" aria-hidden="true"></i> View Drive Applicants
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/view-coordinators.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-list mr-2" aria-hidden="true"></i> View Coordinators
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/placement-statistics.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-bar-chart mr-2" aria-hidden="true"></i> View Placements
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/faculty-password.php">
						<span data-feather="bar-chart-2"></span>
						<i class="fa fa-key mr-2" aria-hidden="true"></i> Change Password
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