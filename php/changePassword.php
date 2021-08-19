<?php
// session_start(); 
?>
<html>

<head>
    <title>Change Password</title>
</head>

<body>
    <div>
        <h1>Change Your Password</h1>
    </div>

    <div>
        <form method="POST" action="changePasswordIndp.php">
            <div>
                <input type="text" name="password" placeholder="Current Password">
            </div>
            <div>
                <input type="password" name="newPass1" placeholder="New Password">
            </div>
            <div>
                <input type="password" name="newPass2" placeholder="Re-enter New Password">
            </div>
            <div>
                <input type="submit" value="Confirm">
            </div>
        </form>
    </div>

</body>

</html>