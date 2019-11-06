<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		$all_set = true;
		foreach ($_POST as $key => $value) {
			if(isset($key) == false || strlen($value) == 0){
				$all_set = false;
			} 
		}
		$name = $_POST["name"];
		 $id = $_POST["id"];
		 $grade = $_POST["grade"];
		 $courses = array("CSE326","CSE107","CSE603","CIN870");
		 $courses_choose = array();
		 $credit_card = $_POST["credit_card"];
		 $credit = $_POST["credit"];

		 foreach( $courses as $course){
			if($_POST[$course] == "on") array_push($courses_choose, $course);
		 }
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if ($all_set == false){
		?>

<!-- 		 Ex 4 : 
			Display the below error message : 
 -->			
 			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		 

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), or a single white space.
		 } elseif (!preg_match("/[a-zA-Z-]+(\w)?[a-zA-Z-]+/",$name)) { 
		?>

<!-- 		 Ex 5 : 
			Display the below error message :  -->
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (! ( (preg_match("/^4[0-9]{15}/",$credit_card) && $credit == 'Visa' ) ||(preg_match("/^5[0-9]{15}/", $credit_card) && $credit == 'MasterCard'))) {
		?>

<!-- 		 Ex 5 : 
			Display the below error message : 
 -->			
 			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		 

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?


		?>

		<ul> 
			<li>Name:  <? echo $name ?></li>
			<li>ID: <? echo $id ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?php 
				$result = implode(",",$courses_choose);
				echo $result;
			?></li>
			<li>Grade: <?= grade ?></li>
			<li>Credit <? 
				print "$credit_card ($credit)"
			?></li>
		</ul>
		
		<!-- Ex 3 :  -->
			<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$info = implode(";",array($name,$id,$credit_card,$credit))."\n";
			file_put_contents($filename, $info,FILE_APPEND);
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

		
	<pre>
	<?php
		$loosers_info = file_get_contents($filename);
		print "$loosers_info";
	?>	
	</pre>

	<?php }?>
		
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				
				$name_checked = array(); 
				 foreach( $names as $name){
					if($_POST[$name] == "on") array_push($name_checked, $name);
				 }

				$returnString = implode(",",$name_checked);
				return $returnString;
			 }
		?>
		
	</body>
</html>
