<?php 
header('content-type:text/html;charset=utf-8');
require_once 'Db.php';
require_once 'Page.php';
$rowCount=Db::getRowCount('user');
$page = isset($_GET['page'])?$_GET['page']:1;
$start=0+($page-1)*2;
$pageSize=2;
$pdo=Db::getInstance();
$stmt=$pdo->prepare('select * from user order by id desc limit ?,? ');
$stmt->bindValue(1, $start, PDO::PARAM_INT);
$stmt->bindValue(2, $pageSize, PDO::PARAM_INT);
$stmt->execute();
$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
$p =new Page($rowCount, $page);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>分页</title>
</head>
<body>
	<div align="center">
	<form action="text.php" method="get">
		<table align="center" border="1">
			<tr>
				<td width="160px">用户序列</td>
				<td width="160px">用户账号</td>
				<td width="160px">用户密码</td>
			</tr>
			<?php foreach ($res as $key){
			    echo '<tr>';
			    echo '<td width="160px">'.$key['id'].'</td>';
			    echo '<td width="160px">'.$key['name'].'</td>';
			    echo '<td width="160px">'.$key['pwd'].'</td>';
			}
			  ?>
		</table>
	</form>
	</div>
	<br/>
	<div align="center">
	<?php echo $p->showPage()?>
	</div>
</body>
</html>