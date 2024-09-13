<!DOCTYPE html>
<html>
	<title><?= $siteConfig->siteName ?></title>	
	<body>
		<h2>Login</h2>
		<? if($message) ?>
			<p><?= $message ?></p>
		<? endif; ?>
		<form action="/a/home/user/create/submit" enctype="multipart/form-data" method="post">
			<label for="userName">User Name:</label><br>
			<input type="text" id="userName" name="userName" value=""><br>
			<label for="password">password:</label><br>
			<input type="password" id="password" name="password" value=""><br>
			<label for="password_confirm">Konfirmasi Password:</label><br>
			<input type="password" id="password_confirm" name="password_confirm" value=""><br><br>
			<input type="submit" value="Submit">
		</form> 

	</body>
</html>

