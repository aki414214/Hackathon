<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	$date = $_POST['date'];
    $team_name = $_POST['team_name'];
    $eny_name = $_POST['eny_name'];
    $team = $_POST['team'];
    $eny = $_POST['eny'];

    $pdo = new PDO('');

    $sql=$pdo->prepare('insert into score (date,team_name,eny_name,team,eny) value (?,?,?,?,?)');
    $sql->execute([$date,$team_name,$eny_name,$team,$eny]);
	$player = $sql->fetch();

	if ($player) {
		echo 'エラー';
		exit;
	} else {
		echo '';
	}

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/a.css">
</head>
<body>
    <p><h1>試合スコア記録サイト</h1></p>
    <img src="../img/image.png">
    <form method="post" action="index2.php">
    <div class="read">
        <h1>試合スコア</h1>
             <select name="day" id="day">
                <option name="day1">日付け</option>
                <?php
    $pdo = new PDO('');
    foreach($pdo->query('select date from score') as $row){
        echo '<option value="',$row['date'],'">',$row['date'],'</option></p>';
    }
    ?>
            </select>
            <button type="submit" name="button" value="">スコア確認へ</button>
            </form> 
    </div>
    

    <div class="create">
        <h1>試合スコア新規登録</h1>
        <form method="post" action="index.php">
            日付<br>
            <input type="date" name="date"><br>
            チーム名<br>
            <input type="text" name="team_name" >vs<input type="text" name="eny_name" ><br>
            スコア<br>
            <input type="number" name="team" value="0">-<input type="number" name="eny" value="0">
            <p><button type="submit" name="button" value="2">登録</button></p>
        </form>
    </div>
    <div class = "result">
        <form method="post" action="result_out.php">
            <h1>個人成績</h1>
            <button type="submit" name="button" value="">個人成績画面へ</button>
        </form>
    </div>      
</body>
</html>