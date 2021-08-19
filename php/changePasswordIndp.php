<?php
session_start();
include 'connect_todb.php';
if (!$sqldb->select_db('higherEducationdb')) {
    die("not connected to database");
}
$userType = $_SESSION['userType'];
if ($userType == "student") {
    // students details
    $name = $_SESSION["name"];
    $rollno = $_SESSION["rollno"];

    $passwordF = $_POST["password"];
    $newPass1 = $_POST["newPass1"];
    $newPass2 = $_POST["newPass2"];

    $getPassQuery = "SELECT password from student WHERE rollno = '$rollno'";
    if ($vals = $sqldb->query($getPassQuery)) {
        if ($vals_val = mysqli_fetch_assoc($vals)) {
            $passwordD = $vals_val['password'];
            // echo "$passwordD";
            if ($passwordD == $passwordF && $newPass1 == $newPass2) {
                // echo "Match";
                $setPassQuery = "UPDATE student SET password = '$newPass1' WHERE rollno = '$rollno'";
                if ($sqldb->query($setPassQuery)) {
                    // echo "Changed";
?>
                    <script>
                        alert("Password changed Successfully!");
                    </script>

                <?php
                    header("Refresh:0; url=$userType.php");
                }
            } else {
                if ($passwordD == $passwordF) {

                ?><script>
                        alert("New Passwords don't match");
                    </script><?php
                                header("Refresh:0; url=$userType.php");
                            } else {
                                ?><script>
                        alert("Password dosen't match");
                    </script><?php
                                header("Refresh:0; url=$userType.php");
                            }
                        }
                    }
                } else {
                    echo "Couldn't authenticate user.";
                }
            } else if ($userType == "teacher") {
                $name = $_SESSION["name"];
                $department = $_SESSION["department"];
                $passwordF = $_POST["password"];
                $newPass1 = $_POST["newPass1"];
                $newPass2 = $_POST["newPass2"];

                $getPassQuery = "SELECT password from teacher WHERE uname = '$name' AND department = '$department'";
                if ($vals = $sqldb->query($getPassQuery)) {
                    if ($vals_val = mysqli_fetch_assoc($vals)) {
                        $passwordD = $vals_val['password'];
                        // echo "$passwordD";
                        if ($passwordD == $passwordF && $newPass1 == $newPass2) {
                            // echo "Match";
                            $setPassQuery = "UPDATE teacher SET password = '$newPass1' WHERE uname = '$name'";
                            if ($sqldb->query($setPassQuery)) {
                                // echo "Changed";
                                ?>
                    <script>
                        alert("Password changed Successfully!");
                    </script>

                <?php
                                header("Refresh:0; url=$userType.php");
                            }
                        } else {
                            if ($passwordD == $passwordF) {

                ?><script>
                        alert("New Passwords don't match");
                    </script><?php
                                header("Refresh:0; url=$userType.php");
                            } else {
                                ?><script>
                        alert("Password dosen't match");
                    </script><?php
                                header("Refresh:0; url=$userType.php");
                            }
                        }
                    }
                } else {
                    echo "Couldn't authenticate user.";
                }
            }
