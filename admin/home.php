<?php session_start();?>
<!DOCTYPE html>

	<head>
		<title>HEAD-Admin</title>
		<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=SMHwEj2Jb_5BDlApIMWMqrh9W6tT0KoKWw9fgtpuPLsEgF6YJvur9LFoUymgtczvVqIMtHcTuQmnmzSkZYWllxhRYQFqB-fkDxOJfLimRETL9PPAFCZyUx2nDCkLwXNdfL0KVmqTA_Jo_S45tc7FFpXbh9hr0F19MG9rvA5LYjRE46tVem9ehXAevhYvj-71azKgcvcEQ8sdmo0mouW1ZGfRlTUAo_yxZeAw7ZR3H3Cunm_SFERvVHFG_eTyXMqD3pWUpR9Z4Cvxw87Rtr-VIHfznVglskzReCIgR2MgGwTrS-fLSPv14FOx5I090CRc8hvCKFEJwyIQhI8nkhdplg" charset="UTF-8"></script>
		<style> 
			@import url("../css/bootstrap.min.css");
			@import url("home_style.css");
		</style>
		<script src = "home.js"></script>
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</head>
	
	<body>
	<?php
			include 'connect_todb.php';
			extract($_POST, EXTR_PREFIX_ALL, 'frompost');
			extract($_SESSION, EXTR_PREFIX_ALL, 'fromsession');
			
			if (isset($fromsession_username)  && isset($fromsession_password))
			{
				//
				$fromsession_username = sanitizeString($fromsession_username);
				$fromsession_password = sanitizeString($fromsession_password);
				
				$query_check = "SELECT username FROM admin WHERE username = '$fromsession_username' AND password = '$fromsession_password'";
				$present = $sqldb->query($query_check);
				if (mysqli_fetch_assoc($present)){
					//
				}
				else
				{header('Location: index.html?err=inco');}
			}
			else if (isset($frompost_username) && isset($frompost_password) )
			{
				if ($frompost_ussercat = 'admin')
				{
				$frompost_username = sanitizeString($frompost_username);
				$frompost_password = sanitizeString($frompost_password);
				
				$query_check = "SELECT username FROM admin WHERE username = '$frompost_username' AND password = '$frompost_password'";
				$present = $sqldb->query($query_check);
				if (mysqli_fetch_assoc($present)){
					//
					$_SESSION['username'] = $frompost_username;
					$_SESSION['password'] = $frompost_password;
				}
				else
				{header('Location: index.html?err=inco');}
				}
				else
				{header('Location: index.html?err=inco');}
			}
			else
			{
				header("Location: index.html");
			}

	?>
	<div class="container">
		<div id="searchrecord">
			<h3>Search record</h3>
			<form action = "searchrecord.php" method = "post">
				<div class = "users-selector">
					<p style = "margin-bottom: 0px"><b>Search/Delete record for</b></p>
					<input type = "radio" name = "user" value = "student" onclick= "showStudentTable_search();" checked = "true" >Student
					<input type = "radio" name = "user" value = "teacher" onclick= "showTeacherTable_search();" >Teacher<br>
				</div>
				<table id="studentTable_search">
					<tr>
						<td>Rollno:</td>
						<td><input class ="form-control inputfield" type="text" name="rollno"></td>
					</tr>
					
					<tr>
						<td>Name:</td>
						<td><input class ="form-control inputfield" type="text" name="sname"></td>
					</tr>
					
					<tr>
						<td>Batch:</td>
						<td><input class ="form-control inputfield" type="number" name="batch" placeholder = "e.g: 075"></td>
					</tr>
					
					<tr>
						<td>Department:</td>
						<td><input class ="form-control inputfield" type="text" name="department" placeholder = "e.g: bct"></td>
					</tr>
					
					<tr>
						<td ><input class ="btn btn-primary btn-m btn-del" type="submit" value="Delete record" name="delete" onclick = "return askConformationForDelete()"></td>
						<td ><input class="btn btn-primary btn-m" type="submit" value="Search" name="search"></td>
					</tr>
				</table>
				
				<table id="teachertable_search" style = "display: none">
					<tr>
						<td>Name:</td>
						<td><input class ="form-control inputfield" type="text" name="tname"></td>
					</tr>
					
					<tr>
						<td>Post:</td>
						<td><input class ="form-control inputfield" type="text" name="post"></td>
					</tr>
					
					<tr>
						<td>Department:</td>
						<td><input class ="form-control inputfield" type="text" name="department"></td>
					</tr>
					
					<tr>
						<td ><input class ="btn btn-primary btn-m btn-del" type="submit" value="Delete record" name="delete" onclick = "return askConformationForDelete()"></td>
						<td ><input class="btn btn-primary btn-m" type="submit" value="Search" name="search"></td>
					</tr>
				</table>
			</form>
		</div>
		
		<div id = "savefromexcel">
			<h3>Save records from excel file</h3>
			<div id = "records_inputs">
				<form action="savefromexcel.php" method="post" enctype = "multipart/form-data">
					<table id ="excelfiletable">
						<tr>
							<td>Excel File:</td>
							<td><input type="file" class ="btn btn-primary btn-m btn-file" name="xlfile" accept = "application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
						</tr>
						
						<tr>
							<td>Sheets number:</td>
							<td><input class ="form-control inputfield" type="text" name="sheetnos" placeholder = "e.g: 1,2,3"></td>
						</tr>
						
						<tr>
							<td>Header of name column:</td>
							<td><input class ="form-control inputfield" type = "text" name = "name_header" placeholder = "e.g: Name"></td>
						</tr>
					</table>
					
					<div class = "users-selector">
						<p style = "margin-bottom: 0px"><b>Save record for</b></p>
						<!--<div class="form-check">-->
							<input class ="form-check-input" type = "radio" name = "user" value = "student" onclick= "showStudentsCol();" checked = "true" >Student
						<!--</div>
						<div class="form-check">-->
							<input class ="form-check-input" type = "radio" name = "user" value = "teacher" onclick= "showTeachersCol();" >Teacher<br>
						<!--</div> -->
					</div>
					
					<p><b>Enter the colum number of corresponding elements below present in the excel sheet</b></p>
						
					<table id="studentscoltable">
						<tr>
							<td>Rollno:</td>
							<td><input class ="form-control inputfield" type="number" name="rollno_col" min = "1" placeholder = "startsfrom1"></td>
						</tr>
						
						<tr>
							<td>Name:</td>
							<td><input class="form-control inputfield" type="number" name="sname_col" min = "1"></td>
						</tr>
						
						<tr>
							<td>DOB:</td>
							<td><input class ="form-control inputfield" type="number" name="dob_col" min = "1"></td>
						</tr>
						
						<tr>
							<td colspan = "2"><input class ="btn btn-primary" type="submit" value="Save record" name="save"></td>
						</tr>
					</table>
					
					<table id="teacherscoltable" style = "display: none">
						<tr>
							<td>Name:</td>
							<td><input class ="form-control inputfield" type="number" name="tname_col" min = "1" placeholder = "startfrom1"></td>
						</tr>
						
						<tr>
							<td>Department:</td>
							<td><input class ="form-control inputfield" type="number" name="department_col" min = "1"></td>
						</tr>
						
						<tr>
							<td>Post:</td>
							<td><input class ="form-control inputfield" type="number" name="post_col" min = "1"></td>
						</tr>
						
						<tr>
							<td colspan = "2"><input class ="btn btn-primary btn-m" type="submit" value="Save record" name="save"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		
		<div id="saveindividualrecord">
			<h3>Save individual record</h3>
				<div class = "users-selector">
					<p style = "margin-bottom: 0px"><b>Update/Insert record for</b></p>
					<input id = "save_rec_student" type = "radio" name = "user" value = "student" onclick= "showStudentTable_save();" checked = "true" >Student
					<input id = "save_rec_teacher" type = "radio" name = "user" value = "teacher" onclick= "showTeacherTable_save();" >Teacher<br>
				</div>
				
				<table id="studentTable_save">
					<tr>
						<td>Rollno:</td>
						<td><input class ="form-control inputfield" id = "save_rec_student_rollno" type="text" name="rollno" placeholder = "e.g: 075bct001"></td>
					</tr>
					
					<tr>
						<td>Name:</td>
						<td><input class ="form-control inputfield" id = "save_rec_student_name" type="text" name="sname"></td>
					</tr>
					
					<tr>
						<td>DOB:</td>
						<td><input class ="form-control inputfield" id = "save_rec_student_dob" type="date" name="dob"></td>
					</tr>
					
					<tr>
						<td ><button class ="btn btn-primary btn-m" onClick = "updateRecord();">Update record</button></td>
						<td ><input class="btn btn-primary btn-m" type="button" value="Save record" name="save" onclick = "saveRecord()"></td>
					</tr>
				</table>
						
				<table id="teachertable_save" style = "display: none">
					<tr>
						<td>Name:</td>
						<td><input class ="form-control inputfield" type="text" name="tname" id = "save_rec_teacher_name"></td>
					</tr>
					
					<tr>
						<td>Department:</td>
						<td><input class ="form-control inputfield" type="text" name="department" id = "save_rec_teacher_department"></td>
					</tr>
					
					<tr>
						<td>Post:</td>
						<td><input class ="form-control inputfield" type="text" name="post" id = "save_rec_teacher_post"></td>
					</tr>
					
					<tr>
						<td ><button class ="btn btn-primary btn-m" onClick = "updateRecord();">Update record</button></td>
						<td ><input class="btn btn-primary btn-m" type="button" value="Save record" name="save" onclick = "saveRecord()"></td>
					</tr>
				</table>
		</div>
		
	</div>	
	</body>
	
</html>