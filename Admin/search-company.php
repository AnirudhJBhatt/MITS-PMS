<?php
	if(isset($_POST['idsearch'])){
		$C_ID=$_POST['C_ID'];
		$query ="SELECT * FROM company WHERE C_ID='$C_ID'";				
?>
		<section class="mt-3">
			<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
				<tr class="table-tr-head table-three text-white">
					<th>Company ID</th>
					<th>Name</th>
					<th>Type</th>
					<th>Address</th>
					<th colspan="1">Operations</th>
				</tr>
				<?php
					$run=mysqli_query($con,$query);							
					while($row=mysqli_fetch_array($run)){
				?>
				<tr>
					<td><?php echo $row["C_ID"] ?></td>
					<td><?php echo $row["C_Name"] ?></td>
					<td><?php echo $row["C_Type"] ?></td>
					<td><?php echo $row["C_Address"] ?></td>						
					<td width='300'>
					<?php 
						echo "<a class='btn btn-info' href=display-company.php?C_ID=".$row['C_ID'].">Profile</a> ";
						echo '<a class="btn btn-danger" href=delete.php?C_ID='.$row['C_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
					?>
					</td>
				</tr>
				<?php		
					}
				?>
			</table>		
		</section>
<?php
	}
?>