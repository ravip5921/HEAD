<?php
session_start();

echo "Under Construction!";

$uname = $_SESSION['name'];


?><script>
    alert("Sorry" + $uname + ".\nThis page is under construction.");
</script>
<?php
header("Refresh:0;url:teacher.php");
?>