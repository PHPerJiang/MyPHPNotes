<?php if(isset($_POST['submit'])&&$_POST['submit']!=''){
$sex=$_POST['sex'];
}?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>	radio</title>
</head>
<body>
	<form action="Post_radio.php" method="post">
	<table align="center">
		<input type="radio" name="sex" value="男" checked />男
		<input type="radio" name="sex" value="女" />女
		<input type="submit" name="submit" value="提交" />
		<tr>
			<td>性别：<?php echo $sex;?></td>
		</tr>
	</table>
	
	</form>
</body>
</html>