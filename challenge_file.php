<!--php-->
<?php
    // 定義
    $file_name = './challenge_log.txt';
    $comment = '';
    $data = [];
    $file_all = '';
    
    // 時刻設定
    date_default_timezone_set('Asia/Tokyo');
    $date = date("Y/m/d H:i:s");

    // コメント取得＆訂正
    if(isset($_POST['comment']) === true){
        $comment = '['.$date.']'.$_POST['comment']."\n";
    }
    
    // ファイルの書き込み
    $fp = fopen($file_name, 'a');
    
    if ($fp !== false){
        if(fwrite($fp, $comment)===false){
            print 'ファイルの書き込みに失敗しました。';
        }
        fclose($fp);
    } else {
        print 'ファイルのオープンに失敗しました。';
    }

    // ファイルの読み込み
    $fp = fopen($file_name, 'r');
    
    if ($fp !== false){
        while (($tmp = fgets($fp)) !== false){
            $data[] = htmlspecialchars($tmp, ENT_QUOTES, 'UTF-8');
        }
        fclose($fp);
    }else {
        print 'ファイルのオープンに失敗しました。';
    }
    
    $file_all = file_get_contents($file_name);

?>

<!--css-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>課題</h1>
    <form method='POST'>
        発言：
        <input type="text" name="comment"/>
        <input type="submit" value="送信"/>
    </form>
    <p>発言一覧</p>
    
    <!--php-->
    <?php
        // 一行ずつ表示
        foreach($data as $read){
            print $read;
            print '<br>';
        }
        
        // まとめて表示
        // print $file_all;
    ?>
</body>
</html>
