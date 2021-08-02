<?php session_start(); ?>
<html>

<head>

    <title>Check</title>
    <style>
        .myDiv {
            /* border: 5px outset red; */
            /* background-color: lightblue; */
            text-align: center;
        }

        .MyTextBox {
            background-color: lightblue;
            text-align: center;
        }

        .Button {
            text-align: center;
            background-color: green;
        }
    </style>
</head>

<body>
    <?php
    if ($_SESSION["userType"] == "teacher") {
        $test = $_SESSION["name"];
        echo "$test";

        echo "
        <div class=\"MyTextBox\">
        <input
          name=\"Password\"
          type=\"password\"
          id=\"pw\"
          label=\"Password\"
          placeholder=\"Enter Password\"
        />
      </div>
        ";
        header("Refresh:2; url= teacher.php");
    } elseif ($_SESSION["userType"] == "student") {
        $dob = $_SESSION["dob"];
        $rollno = $_SESSION["rollno"];
        $name = $_SESSION["name"];
        echo "$dob $rollno $name";
        header("Refresh:2; url= student.php");
    }

    ?>
</body>

</html>