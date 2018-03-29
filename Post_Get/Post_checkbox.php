<?php if(isset($_POST['submit'])){
   $str=$_POST['box'];
}?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>checkbox</title>
</head>
<body>
	<form action="Post_checkbox.php" method="post">
	<table align="center">
		<tr>
			<td>
			<input type="checkbox" name="box[]" value='北京' />北京
			<input type="checkbox" name="box[]" value='上海' />上海
			<input type="checkbox" name="box[]" value='深圳' />深圳
			</td>
			<td><input type="submit" name="submit" value="提交" /></td>
		</tr>
		<tr>
			<td><?php  for ($i=0;$i<count($str);$i++){
			    echo $_POST['box'][$i].'&nbsp;&nbsp;';
			}?></td>
		</tr>
	</table>
	</form>
</body>
</html>