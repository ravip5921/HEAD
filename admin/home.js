function showStudentsCol()
{
	var student_elem = document.getElementById("studentscoltable");
	student_elem.style.display = "block"
	var teacher_elem = document.getElementById("teacherscoltable");
	teacher_elem.style.display = "none"
}

function showTeachersCol()
{
	var student_elem = document.getElementById("studentscoltable");
	student_elem.style.display = "none";
	var teacher_elem = document.getElementById("teacherscoltable");
	teacher_elem.style.display = "block";
}

function showStudentTable_save()
{
	var student_elem = document.getElementById("studentTable_save");
	student_elem.style.display = "block";
	var teacher_elem = document.getElementById("teachertable_save");
	teacher_elem.style.display = "none";
}

function showTeacherTable_save()
{
	var student_elem = document.getElementById("studentTable_save");
	student_elem.style.display = "none";
	var teacher_elem = document.getElementById("teachertable_save");
	teacher_elem.style.display = "block";
}

function showStudentTable_search()
{
	var student_elem = document.getElementById("studentTable_search");
	student_elem.style.display = "block";
	var teacher_elem = document.getElementById("teachertable_search");
	teacher_elem.style.display = "none";
}

function showTeacherTable_search()
{
	var student_elem = document.getElementById("studentTable_search");
	student_elem.style.display = "none";
	var teacher_elem = document.getElementById("teachertable_search");
	teacher_elem.style.display = "block";
}

function askConformationForDelete()
{
	var del = confirm("Do you really want to delete");
	return del;
}

function updateRecord()
{
	//alert("updating record");
	var student_radio = document.getElementById("save_rec_student");
	//updating record
	if(student_radio.checked)
	{ //user selected is student
		//alert("student");
		$.ajax({
		url: 'saveindividualrecord.php',
		dataType: 'text',
		type: 'post',
		data: {
			update: 'Update record',
			user: 'student',
			rollno: document.getElementById("save_rec_student_rollno").value,
			sname: document.getElementById("save_rec_student_name").value,
			dob: document.getElementById("save_rec_student_dob").value
		},
		success: function(returned_result){
			alert(returned_result);
		}
		})
	}
	else
	{//user is teacher
		//alert("teacher");
		$.ajax({
		url: 'saveindividualrecord.php',
		type: 'post',
		dataType: 'text',
		data: {
			update: 'Update record',
			user: 'teacher',
			tname: document.getElementById("save_rec_teacher_name").value,
			post: document.getElementById("save_rec_teacher_post").value,
			department: document.getElementById("save_rec_teacher_department").value
		},
		success: function(returned_result){
			alert(returned_result);
		}
		})
	}
}
	
function saveRecord()
{
//inserting new record
//alert("saving record");
	var student_radio = document.getElementById("save_rec_student");
	if(student_radio.checked)
	{ //user selected is student
		//alert("student");
		$.ajax({
		url: 'saveindividualrecord.php',
		type: 'post',
		dataType: 'text',
		data: {
			save: 'Save record',
			user: 'student',
			rollno: document.getElementById("save_rec_student_rollno").value,
			sname: document.getElementById("save_rec_student_name").value,
			dob: document.getElementById("save_rec_student_dob").value
		}, 
		success: function(returned_result){
			alert(returned_result);
		}
		})
	}
	else
	{//user is teacher
		//alert("teacher");
		$.ajax({
		url: 'saveindividualrecord.php',
		type: 'post',
		dataType: 'text',
		data: {
			save: 'Save record',
			user: 'teacher',
			tname: document.getElementById("save_rec_teacher_name").value,
			post: document.getElementById("save_rec_teacher_post").value,
			department: document.getElementById("save_rec_teacher_department").value
		},
		success: function(returned_result){
			alert(returned_result);
		}
		})
	}	
}