<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケートフォーム</title>
  <style>
  html {
    font-family: Verdana, Arial, sans-serif;
    font-size: 80%;
    line-height: 1.428571429;
  }

  h1{
    font-size:24px;
    margin:10px;
  }

  form div, .message, dl{
    margin:10px;
  }

  .success{
    color:#009826;
  }

  .error{
    color:red;
  }

  .warning {
    color:#BC5958;
  }

  </style>

</head>
<body>
<h1>アンケート結果</h1>

<?php
//入力値に不正なデータがないかなどをチェックする関数
function checkInput($var){
  if(is_array($var)){
    //$var が配列の場合、checkInput()関数をそれぞれの要素について呼び出す
    return array_map('checkInput', $var);
  }else{
    //php.iniでmagic_quotes_gpcが「on」の場合の対策
    if(get_magic_quotes_gpc()){  
      $var = stripslashes($var);
    }
    //NULLバイト攻撃対策
    if(preg_match('/\0/', $var)){  
      die('不正な入力（NULLバイト）です。');
    }
    //文字エンコードのチェック
    if(!mb_check_encoding($var, 'UTF-8')){ 
      die('不正な文字エンコードです。');
    }
    //数値かどうかのチェック 
    if(!ctype_digit($var)) {  
      die('不正な入力です。');
    }
    return (int)$var;
  }
}
 
//POSTされた全てのデータをチェック
$_POST = checkInput($_POST);
 
$error = 0;  //変数の初期化
 
//性別の入力の検証
if(isset($_POST['gender'])) {
  $gender = $_POST['gender'];
  if($gender == 1) {
    $gendername = '男性';
  }elseif($gender == 2) {
    $gendername = '女性';
  }else{
    $error = 1;  //入力エラー（値が 1 または 2 以外）
  }
}else{
  $error = 1;  //入力エラー（値が未定義）
}
 
//年齢の入力の検証
if(isset($_POST['age'])) {
  $age = $_POST['age'];
  if($age < 1 || $age > 8 ) {
    $error = 1;  //入力エラー（値が1-8以外）
  }
}else{
   $error = 1;  //入力エラー（値が未定義）
}

//お住まいの入力の検証
if(isset($_POST['live'])) {
  $live = $_POST['live'];
  if($live < 1 || $live > 8 ) {
    $error = 1;  //入力エラー（値が1-8以外）
  }
}else{
   $error = 1;  //入力エラー（値が未定義）
}
 
//趣味の入力の検証
if(isset($_POST['hobby'])) {
  $hobby = $_POST['hobby'];
  if(is_array($hobby)) {
    foreach($hobby as $value) {
      if($value < 0 || $value > 9) {
        $error = 1;  //入力エラー（値が0-9以外）
      }
    }
  }else{
    $error = 1;  //入力エラー（値が配列ではない）
  }
}else{
  $error = 1;  //入力エラー（値が未定義）
}
 
//エラーがない場合の処理（結果の表示）
if($error == 0) {
  echo '<dl>';
  echo '<dt>性別：</dt><dd>' . $gendername . '</dd>';  
  
  //年齢の値で分岐
  if($age != 8) {
    echo '<dt>年齢：</dt><dd>' . $age . '0代</dd>';
  }else{
    echo '<dt>年齢：</dt><dd>80代以上</dd>';
  }

  //お住まいの値で分岐
  if($live == 1) {
      echo '<dt>お住まい：</dt><dd>' . '北海道' . '</dd>';
    }else if($live == 2){
      echo '<dt>お住まい：</dt><dd>' . '東北' . '</dd>';      
    }else if($live == 3){
      echo '<dt>お住まい：</dt><dd>' . '関東' . '</dd>';      
    }else if($live == 4){
      echo '<dt>お住まい：</dt><dd>' . '北陸' . '</dd>';      
    }else if($live == 5){
      echo '<dt>お住まい：</dt><dd>' . '中部' . '</dd>';      
    }else if($live == 6){
      echo '<dt>お住まい：</dt><dd>' . '関西' . '</dd>';      
    }else if($live == 7){
      echo '<dt>お住まい：</dt><dd>' . '中四国' . '</dd>';      
    }else{
      echo '<dt>お住まい：</dt><dd>' . '九州・沖縄'.'</dd>';
    }


  //foreach で配列の数だけ繰り返し処理
  echo '<dt>趣味：</dt>';
  echo '<dd>';
  foreach($hobby as $value) {
    switch($value) {
      case 0:
        echo 'ONE OK ROCK<br>';
        break;
      case 1:
        echo 'HEY-SMITH<br>';
        break;
      case 2:
        echo '10-FEET<br>';
        break;
      case 3:
        echo 'ROTTENGRAFFTY<br>';
        break;
      case 4:
        echo 'BIGMAMA<br>';
        break;
      case 5:
        echo 'SiM<br>';
        break;
      case 6:
        echo 'coldrain<br>';
        break;
      case 7:
        echo 'BRAHMAN<br>';
        break;
      case 8:
        echo 'MONOEYES<br>';
        break;
      case 9:
        echo 'その他<br>';
        break;
                    
    }
  }
  echo '</dd></dl>';
  
//アンケート結果を保存するテキストファイルを指定
$textfile = 'data/data.txt';
  
//読み込み／書き出し用にオープン (r+) 'b' フラグを指定
$fp = fopen($textfile, 'r+b');
if(!$fp) {
  exit('ファイルが存在しないか異常があります');
}
if(!flock($fp, LOCK_EX)){
  exit('ファイルをロックできませんでした');
}
while(!feof($fp)) {
  $results[] = trim(fgets($fp));
}

if($gender == 1) $results[0] ++;
if($gender == 2) $results[1] ++;

// $results[$age + 1] ++;

if($age == 1) $results[2] ++;
if($age == 2) $results[3] ++;
if($age == 3) $results[4] ++;
if($age == 4) $results[5] ++;
if($age == 5) $results[6] ++;
if($age == 6) $results[7] ++;
if($age == 7) $results[8] ++;
if($age == 8) $results[9] ++;

// $results[$live + 9] ++;

if($live == 1) $results[10] ++;
if($live == 2) $results[11] ++;
if($live == 3) $results[12] ++;
if($live == 4) $results[13] ++;
if($live == 5) $results[14] ++;
if($live == 6) $results[15] ++;
if($live == 7) $results[16] ++;
if($live == 8) $results[17] ++;


// foreach($hobby as $val){
//   $results[$value + 18] ++;
// }

  if($hobby == 0) $results[18] ++;
  if($hobby == 1) $results[19] ++;
  if($hobby == 2) $results[20] ++;
  if($hobby == 3) $results[21] ++;
  if($hobby == 4) $results[22] ++;
  if($hobby == 5) $results[23] ++;
  if($hobby == 6) $results[24] ++;
  if($hobby == 7) $results[25] ++;
  if($hobby == 8) $results[26] ++;
  if($hobby == 9) $results[27] ++;


$results[28] ++;

rewind($fp);

foreach($results as $value) {
  fwrite($fp, $value . "\n");
}

fclose($fp);
 
  echo '<p class="message success">以上の内容を保存しました。<br>アンケートにご協力いただきありがとうございました！</p>'; 
  echo '<p class="message"><a href="questionnaire_read.php">集計結果ページへ</a></p>';
  echo '<p class="message"><a href="questionnaire_input.php">アンケート入力ページへ</a></p>';
}else{
  echo '<p class="message error">恐れ入りますがアンケート入力ページに戻り、アンケートの項目全てにお答えください。</p>';
}
?>


</body>
</html>