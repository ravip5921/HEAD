<?php
// session_start(); 
?>
<html>

<head>
    <title>Change Password</title>
    <style>
        <?php include '../css/bootstrap.min.css'; ?><?php include '../css/changePassword.css'; ?>
    </style>
</head>

<body>
    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="card-head">
            <h1 class="card-title mb-3">Institute of Engineering Pulchowk,Campus
            </h1>
            <hr>
            <h3 class="card-detail mb-3">Change Your Password</h3>
        </div>
        <div class="row-body">
            <form method="POST" action="changePasswordIndp.php">
                <div class="form-row col-md-8">

                    <label for="inputcurrentpassword4">Current Password:</label>
                    <input class="form-control" type="password" name="password" placeholder="Current Password">

                </div>
                <div class="form-row col-md-8">

                    <label for="inputnewPass4">New Password:</label>
                    <input class="form-control" type="password" name="newPass1" placeholder="New Password">

                </div>
                <div class="form-row col-md-8">

                    <label for="inputnewPass24">Re-enter New Password:</label>
                    <input class="form-control" type="password" name="newPass2" placeholder="Re-enter New Password">

                </div>
                <div class="form-row col-md-8">
                    <div class="confirm-btn">
                        <input class="btn btn-lg btn-primary" type="submit" value="Confirm">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>