<?php

require_once('core/init.php');
if (isset($_SESSION['has_login'])) {
    header('location: /atol_perpustakaan');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistem Informasi Perpustakaan</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />

</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> FORM LOGIN</h2>
                <h5>(Library)</h5>
                 <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Sign In Your Account</strong> 
                    </div>
                    <div class="panel-body">
                        <form action="controllers/login_controller.php" method="post" onsubmit="return validateForm()">

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                <input type="text" name="username" id="username"class="form-control" placeholder="Username ">
                                <small class="hide">* Isi ini dulu yuk</small>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                <input type="password" name="password" id="password" class="form-control"  placeholder="Password">
                                <small class="hide">* Isi ini dulu yuk</small>
                            </div>
                                   
                            <div class="form-group">
                                <input type="submit" value="Login Now" class="btn btn-primary ">
                            </div>

                        </form>    
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <script src="assets/js/login.js"></script>
</body>
</html>
