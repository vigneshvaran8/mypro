<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Dashboard</title>
    <?php
    require "../connect.php";
    /*if(!$_SESSION['username']){
        header('Location:'.ADMIN_URL.'login.php?message=timedout');
        exit();
    }*/
    ?>
    <!-- Bootstrap -->
    <link href="<?php echo ADMIN_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo ADMIN_URL; ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo ADMIN_URL; ?>assets/css/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo ADMIN_URL; ?>assets/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        switch ($_GET['message']){
            case 'failure':
                $message = 'Your username or password is empty';
                break;
            case 'incorrect':
                $message = 'Your username or password is incorrect';
                break;
            case 'denied':
                $message = 'You don\'t have access to access admin backend';
                break;
            case 'timedout':
                $message = 'Your session has expired please login again to visit dashboard.';
                break;
            case 'logout':
                $message = 'You are successfully logged out!';
                break;
            case 'exception':
                $message = 'There was some problem with database please contact admin';
                break;
            default:
                $message = 'There was a problem in login.';
        }
        ?>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
        <?= $message ?>
                    <form action="checklogin.php" method="post" id="loginform">
                        <h1>Login Form</h1>
                        <div>
                            <input type="text" name="username" class="form-control" placeholder="Username"  />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password"  />
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Log in">
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>



<!-- jQuery -->
<script src="<?php echo ADMIN_URL; ?>assets/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo ADMIN_URL; ?>assets/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo ADMIN_URL; ?>assets/js/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo ADMIN_URL; ?>assets/js/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo ADMIN_URL; ?>assets/js/custom.min.js"></script>
</body>
</html>
