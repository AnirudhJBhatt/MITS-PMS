<?php
	if(isset($_POST['idsearch'])||isset($_POST['deptsearch'])){
		if(isset($_POST['idsearch'])){
			$Stud_ID=$_POST['Stud_ID'];
			$query ="SELECT * FROM student WHERE Stud_ID='$Stud_ID'";
		}
		elseif(isset($_POST['deptsearch'])){							
			$Stud_Course=$_POST['Stud_Course'];
			$query ="SELECT * FROM student WHERE Stud_Course='$Stud_Course'";
		}		
?>
<section class="mt-3">
	<table class="w-100 table-elements mb-5 table-three-tr text-center" cellpadding="10">
		<tr class="table-tr-head table-three text-white">
			<th>Student ID</th>
			<th>Name</th>
			<th>Batch</th>
			<th colspan="1">Operations</th>
		</tr>
		<?php			
			$run=mysqli_query($con,$query);							
			while($row=mysqli_fetch_array($run)){		
		?>
		<tr>
			<td><?php echo $row["Stud_ID"] ?></td>
			<td><?php echo $row["Stud_Name"] ?></td>
			<td><?php echo $row["Stud_Course"] ?></td>						
			<td width='300'>
	        <?php 
				echo "<a class='btn btn-info' href=display-student.php?Stud_ID=".$row['Stud_ID']." target='_blank'>Profile</a> ";
				echo '<a class="btn btn-danger" href=delete.php?Stud_ID='.$row['Stud_ID'].' onClick="return confirm(\'Do you want to delete ?\')">Delete</a>';
			?>
	    	</td>
		</tr>
		<?php
			}
		?>
	</table>
<?php
	}
?>
</section>