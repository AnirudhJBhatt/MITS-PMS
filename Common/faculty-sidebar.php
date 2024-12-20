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
						<i class="fa fa-user mr-2" aria-hidden="true"></i> Personal Profile
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/add-student.php">
						<span data-feather="file"></span>
						<i class="fa fa-user mr-2" aria-hidden="true"></i> Student Registration
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/viewstudents.php">
						<span data-feather="file"></span>
						<i class="fa fa-users mr-2" aria-hidden="true"></i> Students
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/viewplacements.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-book mr-2" aria-hidden="true"></i> Placements
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../faculty/updatemarks.php">
						<span data-feather="shopping-cart"></span>
						<i class="fa fa-database mr-2" aria-hidden="true"></i> Update CGPA
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