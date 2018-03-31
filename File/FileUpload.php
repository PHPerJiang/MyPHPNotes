<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>FileUpload</title>
</head>
<body>
	<form action="FileUpload.php" method="post" enctype="multipart/form-data">
		<table align="center">
			<tr>
				<td><input type="file" name="upload" /></td>
				<td><input type="submit" value="提交" name="submit"/></td>
				<td><?php if (!empty($_FILES)){ //判断上传的文件是否为空
                        $file=$_FILES['upload'];    //把文件信息数组赋值给file
                        $path='./FileSave/';        //设置文件保存目录
                        move_uploaded_file($file['tmp_name'],$path.$file['name']);//上传文件（把临时文件移动到保存位置并重命名）
                        echo '文件上传成功';
                    }?>				
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
