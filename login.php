<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Login Form</title>
<?php
	require "connect.php";
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/login.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/font-awesome.css">
<link href="//fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
</head>
<body>
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
}
?>
<div class="w3ls-header">
	<h1>Login form</h1>
	<div class="header-main">
			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
						<form action="checklogin.php" method="post">
							<div class="icon1">
								<input type="text" placeholder="Username" name="username" required=""/>
							</div>
							<div class="icon1">
								<input type="password" placeholder="Password" name="password" required=""/>
							</div>
							<?php if( $_GET['message'] ): ?>
								<div class="loginerrormsg"><?=$message ?></div>
							<?php endif; ?>
							<div class="bottom">
								<input type="submit" value="Log in" />
							</div>
						</form>	
					</div>
				</div>
			</div>
	</div>
</div>
</body>
</html>