 <!---------------- Session starts form here ----------------------->
 <?php  
	session_start();

	if (!$_SESSION["LoginAdmin"]){
		echo '<script> alert("Your Are Not Authorize Person For This link");</script>';
        echo '<script>window.location="../login/login.php"</script>';
	}

	require_once "../connection/connection.php";
    $Exam_ID = $_GET['Exam_ID'];

?>
<!---------------- Session Ends form here ------------------------>
<?php
    $json_file = "../Question Bank/techincal.json";
    $questions = json_decode(file_get_contents($json_file), true);

    if(isset($_POST['submit'])){
        foreach($questions as $index => $q){
            $question = mysqli_real_escape_string($con, $q['question']);
            $option1 = mysqli_real_escape_string($con, $q['options'][0]);
            $option2 = mysqli_real_escape_string($con, $q['options'][1]);
            $option3 = mysqli_real_escape_string($con, $q['options'][2]);
            $option4 = mysqli_real_escape_string($con, $q['options'][3]);
            $answer = mysqli_real_escape_string($con, $q['answer']);
    
            $query = "INSERT INTO questions (Exam_ID, Question, O1, O2, O3, O4, Answer) 
                      VALUES ('$Exam_ID', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')";
            mysqli_query($con, $query);
        }
        echo '<script>alert("Questions Added Successfully"); window.location="quizes.php";</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Exam</title> 
</head>
    <body>
        <?php include('../Common/header.php'); ?>
        <?php include('../Common/Admin-sidebar.php'); ?>
        
        <main role="main" class="mt-1 mb-3 px-md-4 page-content-index">
			<div class="sub-main">
                <div class="dashboard-header flex-wrap flex-md-no-wrap px-3 pt-2 pb-1 mb-3 text-white">
                    <div class="d-flex flex-row">
                        <div class="p-2"><h4>Questions for the Exam</h4></div>
                    </div>
                </div>
												
				<div class="row">
					<div class="col-md-12 container-fluid">
						<section class="my-3">
							<form method="POST">
                                <table class="w-100 table table-bordered border-dark table-hover text-center" cellpadding="5">
                                    <tr class="table-dark text-white">
                                        <th>Question No</th>
                                        <th>Questions</th>
                                        <th>Options</th>
                                        <th>Answer</th>
                                    </tr>
                                    <?php 
                                        $i=1;
                                        foreach ($questions as $index => $q){ 
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo htmlspecialchars($q['question']); ?></td>
                                                <td>
                                                    <?php 
                                                        echo "A) " . htmlspecialchars($q['options'][0]) . "<br>";
                                                        echo "B) " . htmlspecialchars($q['options'][1]) . "<br>";
                                                        echo "C) " . htmlspecialchars($q['options'][2]) . "<br>";
                                                        echo "D) " . htmlspecialchars($q['options'][3]); 
                                                    ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($q['answer']); ?></td>
                                            </tr>
                                    <?php 
                                        } 
                                    ?>
                                </table>
                                <div class="text-center mb-5">
                                    <input type="submit" value="Add Questions" name="submit" class="btn btn-success">				
                                </div>
                            </form>
						</section>
					</div>
				</div>
			</div>  
        </main>

        <?php include('../Common/footer.php'); ?>

        <script>
            (() => {
                'use strict';
                const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(tooltipTriggerEl => {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            })();
        </script>
    </body>
</html>

