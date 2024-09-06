<?php
session_start();
if($_POST['button'] == 2){
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$name = $_POST['name'];
    $daseki = $_POST['daseki'];
    $anda = $_POST['anda'];
    $other = $_POST['other'];
    $memo = $_POST['memo'];

    $pdo = new PDO('mysql:host=my','name','Pass');

    $sql=$pdo->prepare('insert into player (name,daseki,anda,other,memo) value (?,?,?,?,?)');
    $sql->execute([$name,$daseki,$anda,$other,$memo]);
	$player = $sql->fetch();

	if ($player) {
		echo 'エラー';
		exit;
	} else {
		echo '';
	}

}
}elseif($_POST['button'] == 1){
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
     $new_daseki=$_POST['new_daseki'];
     $new_anda=$_POST['new_anda'];
     $new_other=$_POST['new_other'];
     $new_memo=$_POST['new_memo'];
     if($_POST['button']==1){
        $pdo = new PDO('');
     $sql=$pdo->prepare('update player set daseki=?,anda=?,other=?,memo=? where name=?');
     $result=$sql->execute([$new_daseki,$new_anda,$new_other,$new_memo,$_POST['na']]);

	$pdo=null;
     }
}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人成績</title>
    <style>
        h2{
    font-size: 18px;
    border: 3px solid #ffffff;
    border-radius: 20px;
    padding: 6px 0;
    margin: 20px auto;
    width: 300px;
    text-align:center;
}
p,button{
    text-align: center;
    margin-bottom: 20px;
}
table  {
  border: 1px solid #000;
  border-collapse: collapse;
}
 
table th {
  border: 1px solid #000;
}
table td {
  border: 1px solid #000;
}

    </style>
</head>
<body>
<div id="toptitle" class="container center-block text-center mb-3" style="color:#FFFFFF; background-color:#000;">
        <div class="row center-block">
            <div class="col center-block">
                <h1>個人成績</h1>
            </div>
        </div>
    </div>
    <a href="index.php" id="btn_a"value="read">スコア確認</a>
<form method="post" action="result_out.php">
    
    <p><h2>成績一覧</h2></p>
    
<?php
    $pdo = new PDO('');
        echo '<table align="center" border="1">',
             '<tr> <th>名前</th> <th>打席数</th> <th>打数</th> <th>安打数</th> <th>打率</th> <th>メモ</th></tr>';
    foreach ($pdo->query('select * from player') as $row){
        echo '<tr><td>',$row['name'],'</td>';
        echo '<td>',$row['daseki']+$row['other'],'打席</td>';
        echo '<td>',$row['daseki'],'打数</td>';
        echo '<td>',$row['anda'],'安打</td>';
        $round=round($row['anda']/$row['daseki'],3);
        echo '<td>打率',$round,'</td>';
        echo '<td>',$row['memo'],'</td></tr>';
        
    }
    echo '</table>';
    $pdo = null;
?>
<p><h2>更新</h2></p>
    <?php
    $pdo = new PDO('');
    echo '<p>更新したい選手名を選択：';
    echo '<select name = "na">';
    foreach($pdo->query('select name from player') as $row){
        echo '<option value="',$row['name'],'">',$row['name'],'</option></p>';
    }
    echo '</select>';
    ?>

    <p>打席数：<select name="new_daseki">
    <?php
            for($i=1;$i<=100;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select></p>
    <p>安打数：<select name="new_anda">
    <?php
            for($i=1;$i<=100;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select></p>
    <p>四球数、死球数、犠打数：<select name="new_other">
    <?php
            for($i=1;$i<=100;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select></p>
    <p>メモ：<input type="text" name="new_memo"></p>
    <p><button type="submit" name="button" value="1">更新</button></p>


    <p><h2>新規登録</h2></p>
		<p>選手名：<input type="text" name="name"></p>
        <p>打席数：<select name="daseki">
        <?php
            for($i=0;$i<=10;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select>
        </p>
        <p>安打数：<select name="anda">
        <?php
            for($i=0;$i<=10;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select>
        </p>
        <p>四球数、死球数、犠打数：<select name="other">
        <?php
            for($i=0;$i<=10;$i++){
                echo '<option value="',$i,'">',$i,'</option>';
            }
            ?>
            </select>
        </p>
        <p>メモ：<input type="text" name="memo"></p>
		<p><button type="submit" name="button" value="2">登録</button></p>

	</form>
</body>
</html>