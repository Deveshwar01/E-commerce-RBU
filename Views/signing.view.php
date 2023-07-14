<?php

use Alerts\Alerts;
use Datainterface\Insertion;
use Datainterface\Selection;

@session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pswd'])) {
		goto out;
	}
	$name = htmlspecialchars(strip_tags($_POST['name']));
	$list = explode(' ', $name);
	$address = "no address";
	$data = [
		"firstname" => $list[0],
		"lastname" => end($list),
		"mail" => htmlspecialchars(strip_tags($_POST['email'])),
		"phone" => isset($_POST['phone']) ? htmlspecialchars(strip_tags($_POST['phone'])) : " ",
		"password" => md5(htmlspecialchars(strip_tags($_POST['pswd']))),
		"address" => $address,
		"role" => "Admin"
	];

	$check = Selection::selectById('users', ['mail' => $data['mail']]);

	if (empty($check)) {
		$user = Insertion::insertRow('users', $data);
		if (!empty($user)) {
			echo Alerts::alert('info', 'User created ' . $list[0]);
		} else {
			echo Alerts::alert('danger', 'Failed to create user');
		}
	} else {
		echo Alerts::alert('danger', 'Email already exist');
	}

	out:
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['log-in'])) {
	if (empty($_POST['email']) || empty($_POST['pswd'])) {
		goto outs;
	}
	$data = [
		"mail" => htmlspecialchars(strip_tags($_POST['email'])),
		"password" => md5(htmlspecialchars(strip_tags($_POST['pswd']))),
	];
	$check = Selection::selectById('users', ['mail' => $data['mail']]);
	if (isset($check[0]['password']) && $check[0]['password'] === $data['password']) {
		$_SESSION['private_data']['current_user'] = $check;
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=homepage">';
	} else {
		echo Alerts::alert('danger', "Incorrect email and password");
	}
	outs:
}


?>
<link rel="stylesheet" href="css/signing.css">
<section class="home">
	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">

		<div class="signup">
			<form action="<?php echo $_SESSION['public_data']['view']['view_url']; ?>" method="POST">
				<label for="chk" aria-hidden="true">Sign-up </label>
				<input type="text" name="name" placeholder="Enter your name" required="">
				<input type="email" name="email" placeholder=" Enter Email" required="">
				<input type="text" name="phone" placeholder=" enter your number" required="">
				<input type="password" name="pswd" placeholder=" set Password" required="">
				<button name="signup">Sign up</button>
			</form>
		</div>

		<div class="login">
			<form action="<?php echo $_SESSION['public_data']['view']['view_url']; ?>" method="POST">
				<label for="chk" aria-hidden="true">Log-in</label>
				<input type="email" name="email" placeholder=" Enter Email" required="">
				<input type="password" name="pswd" placeholder=" Enter Password" required="">
				<button name="log-in">Login</button>
			</form>
		</div>
	</div>
</section>