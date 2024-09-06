<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/a.css">
</head>
<body >
    <div><h1>スコア</h1>
    <a href="index.php" id="btn">スコア確認</a>
    </div>
    <div class= "p">
    <?php
    $pdo = new PDO('');
             $date =$pdo->prepare('select * from score where date = ?');
             $date->execute([$_POST['day']]);
    foreach($date as $row){
        echo '<h2>',$row['date'],'</h2>';
        echo '<h2>',$row['team_name'],'vs'
             ,$row['eny_name'],'</h2>';
        echo '<h1>',$row['team'],' - '
             ,$row['eny'],'</h1>';      
    }
    ?>
</div>
</body>
</html>