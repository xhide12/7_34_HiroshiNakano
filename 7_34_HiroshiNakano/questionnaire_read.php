<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート結果</title>

  <style>
  table th {
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    border: 1px solid #ccc;
    background-color: #666;
    color: #FFF;
  }

  table td {
    padding: 10px;
    vertical-align: top;
    border: 1px solid #ccc;
  }

  .thead {
    display: table-header-group;
    vertical-align: middle;
    border-color: inherit;
  }

  body, h1, h2, h3, h4, h5, h6 {
    font-family: "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", Meiryo, メイリオ, Verdana, Arial, sans-serif;
  }

  p {
    font-weight: bold; 
    margin: 20px 0 10px;
  }

  html {
    font-size: 80%;
  }

  table {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    display: table;
    box-sizing: border-box;
    border-spacing: 2px;
    border-color: #696969;
  }

  tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
  }

  th {
    display: table-cell;
  }

  </style>


  
</head>


<body>

<?php
//アンケート結果が保存するたテキストファイルを指定
$textfile = 'data/data.txt';
//ファイルを開く
$fp = fopen($textfile, 'rb');   //rで読み込みモード、bで互換性維持 
 
if(!$fp){  //fopen()関数の戻り値を検証
  exit('ファイルがないか異常があります。');
}
 
//テキストを排他的にロックし、その戻り値を検証
if(!flock($fp, LOCK_EX)){
  exit('ファイルをロックできませんでした。');
}
 
//ファイルポインタが EOF（最後）に達するまで、テキストの各行を読み出し、trim()関数で文字列の先頭および末尾にあるホワイトスペースを取り除き配列に格納
while(!feof($fp)){
  $results[] = trim(fgets($fp));
}
 
if($results[28] != 0){  //アンケート結果が0でなければ集計
  echo '<p>アンケートの集計結果：総数 ' . $results[28] . ' 件</p>';
 
?>
 
<table>
  <thead>
  <tr>
  <th>質問</th>
  <th>人数</th>
  <th>比率</th>
  </tr>
  </thead>


  <tbody>
  <tr>
  <td>性別</td>

<?php
  // 男女の比率計算
  $male_rate   = round($results[0] / $results[28] * 100);
  $female_rate = round($results[1] / $results[28] * 100);
 
  echo '  <td>男性：' . $results[0] . '人 女性：' . $results[1] . '人</td>';
  echo '  <td>男性：' . $male_rate . '% 女性：' . $female_rate . '%</td>';
?>

  </tr>
  <tr>
  <td>年齢</td>

<?php
  $age10_rate = round($results[2] / $results[28] * 100);
  $age20_rate = round($results[3] / $results[28] * 100);
  $age30_rate = round($results[4] / $results[28] * 100);
  $age40_rate = round($results[5] / $results[28] * 100);
  $age50_rate = round($results[6] / $results[28] * 100);
  $age60_rate = round($results[7] / $results[28] * 100);
  $age70_rate = round($results[8] / $results[28] * 100);
  $age80_rate = round($results[9] / $results[28] * 100);
 
  echo '  <td>10代：' . $results[2] . '人<br>' .
             '20代：' . $results[3] . '人<br>' .
             '30代：' . $results[4] . '人<br>' .
             '40代：' . $results[5] . '人<br>' .
             '50代：' . $results[6] . '人<br>' .
             '60代：' . $results[7] . '人<br>' .
             '70代：' . $results[8] . '人<br>' .
         '80代以上：' . $results[9] . '人</td>';
  echo '  <td>10代：' . $age10_rate . '%<br>' .
             '20代：' . $age20_rate . '%<br>' .
             '30代：' . $age30_rate . '%<br>' .
             '40代：' . $age40_rate . '%<br>' .
             '50代：' . $age50_rate . '%<br>' .
             '60代：' . $age60_rate . '%<br>' .
             '70代：' . $age70_rate . '%<br>' .
         '80代以上：' . $age80_rate . '%</td>';
?>

  </tr>

  <tr>
  <td>お住まい</td>

<?php
  $live1_rate = round($results[10] / $results[28] * 100);
  $live2_rate = round($results[11] / $results[28] * 100);
  $live3_rate = round($results[12] / $results[28] * 100);
  $live4_rate = round($results[13] / $results[28] * 100);
  $live5_rate = round($results[14] / $results[28] * 100);
  $live6_rate = round($results[15] / $results[28] * 100);
  $live7_rate = round($results[16] / $results[28] * 100);
  $live8_rate = round($results[17] / $results[28] * 100);
 
  echo '  <td>北海道：' . $results[10] . '人<br>' .
             '東北：' . $results[11] . '人<br>' .
             '関東：' . $results[12] . '人<br>' .
             '北陸：' . $results[13] . '人<br>' .
             '中部：' . $results[14] . '人<br>' .
             '関西：' . $results[15] . '人<br>' .
             '中四国：' . $results[16] . '人<br>' .
         '九州・沖縄：' . $results[17] . '人</td>';
  echo '  <td>北海道：' . $live1_rate . '%<br>' .
             '東北：' . $live2_rate . '%<br>' .
             '関東：' . $live3_rate . '%<br>' .
             '北陸：' . $live4_rate . '%<br>' .
             '中部：' . $live5_rate . '%<br>' .
             '関西：' . $live6_rate . '%<br>' .
             '中四国：' . $live7_rate . '%<br>' .
         '九州・沖縄：' . $live8_rate . '%</td>';
?>

  </tr>

  <tr>
  <td>好きなバンド</td> 
  
<?php
// $results_sum = $results[18] + $results[19] + $results[20] + $results[21] + $results[22] + $results[23] $results[24] +$results[25] + $results[26] + $results[27];

//   $hobby1_rate = round($results[18] / $results_sum * 100);
//   $hobby2_rate = round($results[19] / $results_sum * 100);
//   $hobby3_rate = round($results[20] / $results_sum * 100);
//   $hobby4_rate = round($results[21] / $results_sum * 100);
//   $hobby5_rate = round($results[22] / $results_sum * 100);
//   $hobby6_rate = round($results[23] / $results_sum * 100);
//   $hobby7_rate = round($results[24] / $results_sum * 100);
//   $hobby8_rate = round($results[25] / $results_sum * 100);
//   $hobby9_rate = round($results[26] / $results_sum * 100);
//   $hobby10_rate = round($results[27] / $results_sum * 100);
 
  $hobby1_rate = round($results[18] / $results[28] * 100);
  $hobby2_rate = round($results[19] / $results[28] * 100);
  $hobby3_rate = round($results[20] / $results[28] * 100);
  $hobby4_rate = round($results[21] / $results[28] * 100);
  $hobby5_rate = round($results[22] / $results[28] * 100);
  $hobby6_rate = round($results[23] / $results[28] * 100);
  $hobby7_rate = round($results[24] / $results[28] * 100);
  $hobby8_rate = round($results[25] / $results[28] * 100);
  $hobby9_rate = round($results[26] / $results[28] * 100);
  $hobby10_rate = round($results[27] / $results[28] * 100);

  
  echo '<td>ONE OK ROCK：' . $results[18] . '人<br>' .
       'HEY-SMITH：' . $results[19] . '人<br>' .
       '10-FEET：' . $results[20] . '人<br>' .
       'ROTTENGRAFFTY：' . $results[21] . '人<br>' .
       'BIGMAMA：' . $results[22] . '人<br>' .
       'SiM：' . $results[23] . '人<br>' .
       'coldrain：' . $results[24] . '人<br>' .
       'BRAHMAN：' . $results[25] . '人<br>' .
       'MONOEYES：' . $results[26] . '人<br>' .
       'その他：' . $results[27] . '人</td>';
  echo '<td>ONE OK ROCK：' . $hobby1_rate . '%<br>' .
       'HEY-SMITH：' . $hobby2_rate . '%<br>' .
       '10-FEET：' . $hobby3_rate . '%<br>' .
       'ROTTENGRAFFTY：' . $hobby4_rate . '%<br>' .
       'BIGMAMA：' . $hobby5_rate . '%<br>' .
       'SiM：' . $hobby6_rate . '%<br>' .
       'coldrain：' . $hobby7_rate . '%<br>' .
       'BRAHMAN：' . $hobby8_rate . '%<br>' .
       'MONOEYES：' . $hobby9_rate . '%<br>' .
       'その他：' . $hobby10_rate . '%</td>';
?>
  </tr>
  </tbody>
  </table>

<?php
} else {
  // アンケートデータがない場合
  echo '  <p class="msg">表示できるようなアンケートデータがありません。</p>';
}
fclose($fp);
echo '<p class="link"><a href="questionnaire_input.php">アンケートページへ戻る</a></p>';
?>

</body>
</html>