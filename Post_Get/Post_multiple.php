
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
<form action="Post_multiple.php" method="post">
	<table align="center">
		<tr>
			<td>选择地点</td>
			<td>
				<select name="select[]" size="5" multiple>
					<option value="北京" selected>北京</option>
					<option value="上海">上海</option>
					<option value="深圳">深圳</option>
					<option value="杭州">杭州</option>
					<option value="青岛">青岛</option>
					<option value="广州">广州</option>
					<option value="济南">济南</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="提交" /></td>
		</tr>
		<tr>
			<td><?php for ($i=0;$i<count($place);$i++){
			 echo $place[$i].'&nbsp;&nbsp;';
			}?></td>
		</tr>
	</table>
</form>
</body>
</html>