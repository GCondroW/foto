<!DOCTYPE html>
<html>
	<title><?= $siteConfig->siteName ?></title>	
	<body>
		<h2>Login</h2>
		<? if($message) ?>
			<p><?= $message ?></p>
		<? endif; ?>
		<form action="/a/submit" enctype="multipart/form-data" method="post">
		  <label for="fname">User Name:</label><br>
		  <input type="text" id="userName" name="userName" value=""><br>
		  <label for="lname">Pass Word:</label><br>
		  <input type="password" id="password" name="password" value=""><br><br>
		  <input type="submit" value="Submit">
		</form> 

	</body>
</html>

