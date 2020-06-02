<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート入力ページ</title>
  <style>
    .error input , 
    .error textarea {
        background-color: #F8DFDF;
    }
    p.error{
        margin:0;
        color:red;
        font-weight:bold;
        margin-bottom:1em;
    }

    .button{
      margin-top: 30px;
    }

    .form_iframe {
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 10px;
    margin: 20px 0 40px;
    max-width: 600px;
    }

    body {
    font-size: 14px;
    line-height: 1.428571429;
    color: #333333;
    background-color: #ffffff;
    }

    .title{
      font-weight:bold;
    }

</style>
</head>
<body>

<h1>アンケート入力ページ</h1>
 
<form action="questionnaire_write.php" method="post" class="form_iframe">

<div>
<p class="title">性別</p>

<div class="error1"></div>
  <input type="radio" name="gender" id="male" value="1" class="required">
    <label for="male"> 男性 </label>  
  <input type="radio" name="gender" id="female"  value="2">
    <label for="female"> 女性 </label>  
</div>

<div>
<p class="title"><label for="age"> 年齢 </label></p>
<div class="error2"></div>

<select name="age" id="age">
<option value="0" selected>選択してください。</option>
<option value="1">10代</option>
<option value="2">20代</option>
<option value="3">30代</option>
<option value="4">40代</option>
<option value="5">50代</option>
<option value="6">60代</option>
<option value="7">70代</option>

<!-- <?php
for($num = 1; $num <= 7; $num++) {
  echo '<option value="' . $num . '">' . $num . '0代</option>' . "\n";
}
?> -->

<option value="8">80代以上</option>
</select>
</div>



<div>
<p class="title"><label for="live"> お住まい </label></p>
<div class="error3"></div>

<select name="live" id="live">
<option value="0" selected>選択してください。</option>
<option value="1">北海道</option>
<option value="2">東北</option>
<option value="3">関東</option>
<option value="4">北陸</option>
<option value="5">中部</option>
<option value="6">関西</option>
<option value="7">中四国</option>

<!-- <?php
for($num = 1; $num <= 7; $num++) {
  echo '<option value="' . $num . '">' . $num . '0代</option>' . "\n";
}
?> -->

<option value="8">九州・沖縄</option>
</select>
</div>



<div>
<p class="title">好きなバンド</p>

<?php
$hobby = array(0 => "ONE OK ROCK",
               1 => "HEY-SMITH",
               2 => "10-FEET",
               3 => "ROTTENGRAFFTY",
               4 => "BIGMAMA",
               5 => "SiM",
               6 => "coldrain",
               7 => "BRAHMAN",
               8 => "MONOEYES",
               9 => "その他");
$ids = array('OOR', 'HS', '10F', 'RG', 'BM', 'SiM', 'cold', 'BRAH' , 'MONO' ,'other');
 
foreach($hobby as $key => $value) {
  if($key == 0) {
    echo '<label for="OOR"><input type="checkbox" name="hobby[]" value="0" id="OOR" class="required">' . $value . '</label>' . "<br>"; 
  }else{
    echo '<label for="' . $ids[$key] .'"><input type="checkbox" name="hobby[]" value="' 
    .$key . '" id="' . $ids[$key] . '">' . $value . '</label>' . "<br>";    
  }
}
 
?>
</div>

<div>
<input type="submit" class="button">
</div>
</form>
 
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script> 
<script type="text/javascript">
jQuery(function($){
  $("form").submit(function(){  
    //エラー表示の初期化
    $("p.error").remove();
    $("div").removeClass("error");
    var text = "";
    
     //ラジオボタンの検証
    $(":radio").filter(".required").each(function(){
      if($('input[name="'+$(this).attr("name")+'"]:checked').size() == 0){
        text = $(this).parent().find('p').text();
        $('.error1').prepend("<p class='error'>" + text + "を選択してください。</p>");
      }
    })

    //セレクトメニューの検証
    $("#age").each(function(){
       if($(this).val() == 0 ) {
         text = $(this).parent().find('label').text();
         $('.error2').prepend("<p class='error'>" + text + "を選択してください。</p>");
       }
    });

    //セレクトメニューの検証
    $("#live").each(function(){
       if($(this).val() == 0 ) {
         text = $(this).parent().find('label').text();
         $('.error3').prepend("<p class='error'>" + text + "を選択してください。</p>");
       }
    });
    
    //チェックボックスの検証
    $(":checkbox").filter(".required").each(function(){
      if($('input[name="'+$(this).attr("name")+'"]:checked').size() == 0){
        text = $(this).closest('div').find('p').text();
        $(this).parent().prepend("<p class='error'>" + text + "を選択してください。</p>");
      }
    })
     
    //error クラスの追加の処理
    if($("p.error").size() > 0){
      $("p.error").parent().addClass("error");
      return false;
    }
    
  }) 
 
});
</script>

</body>
</html>