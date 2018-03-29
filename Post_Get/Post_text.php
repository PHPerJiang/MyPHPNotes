<?php if (isset($_POST['submit']) && $_POST['submit']=='登录'){
    $username=$_POST['username'];
    $pwd=$_POST['pwd'];
   }
   
   ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>test</title>
</head>
<body>
	<form action="Post_text.php" method="post">
	<table align="center">
	<tr>
		<td>账号：</td>
		<td><input type="text" name="username"/></td>
	</tr>
	<tr>
		<td>密码：</td>
		<td><input type="password" name="pwd"/></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="登录" /></td>
	</tr>
	<tr>
		用户名：<?php echo $username;?>
		密码：<?php echo $pwd;?>
		<br/>
		<?php echo '用户名：'.$username.'密码：'.$pwd?>
	</tr>
	</table>
	</form>
	
</body>
</html>