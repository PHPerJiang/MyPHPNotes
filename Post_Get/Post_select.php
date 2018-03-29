
<?php if(isset($_POST['submit'])&&$_POST['submit']=='提交'){
   $place=$_POST['select'];
}?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>select</title>
</head>
<body>
<form action="Post_select.php" method="post">
	<table align="center">
		<tr>
			<td>选择地点</td>
			<td>
				<select name="select" size="1">
					<option value="北京" selected>北京</option>
					<option value="上海">上海</option>
					<option value="深证">深圳</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="提交" /></td>
		</tr>
		<tr>
			<td><?=$place?></td>
		</tr>
	</table>
</form>
</body>
</html>