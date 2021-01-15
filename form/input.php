<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTIONS:DENY');

if(!empty($_POST)) {
  echo '<pre>';
  var_dump($_POST);
  echo '</pre>';
}

function h($str)
{
 return htmlspecialchars($str,ENT_QUOTES,'utf-8' );
}

$pageFlag = 0;
$errors = validation($_POST);

if(!empty($_POST['btn_confirm']) && empty($errors)){
  $pageFlag = 1;
}
if(!empty($_POST['btn_submit'])){
  $pageFlag = 2;
}


?>

<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>


<?php if($pageFlag === 1 ) : ?>
<div class="container">
  <div class="row">
    <div class="col-md-6">
    <?php if($_POST['csrf'] === $_SESSION['csrfToken']) :?>
    <form method="POST" action="input.php">
    <div class="form-group">
      <label for="your_name">氏名</label>
      <input type="text" class="form-control" id="your_name" value="<?php echo h($_POST['your_name']) ;?>">
    </div>
 
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="email" class="form-control" id="email" value="<?php echo h($_POST['email']) ;?>">
    </div>

    <div class="form-group">
      <label for="url">ホームページ</label>
      <input type="url" class="form-control" id="url" value="<?php echo h($_POST['url']) ;?>">
    </div>

性別
    <?php
      if($_POST['gender'] === '0') {echo '男性';}
      if($_POST['gender'] === '1') {echo '女性';}
    ?>
<br>
年齢
<?php
  if($_POST['age'] === '1') {echo '〜１９歳';}
  if($_POST['age'] === '2') {echo '２０歳〜２９歳';}
  if($_POST['age'] === '3') {echo '３０歳〜３９歳';}
  if($_POST['age'] === '4') {echo '４０歳〜４９歳';}
  if($_POST['age'] === '5') {echo '５０歳〜５９歳';}
  if($_POST['age'] === '6') {echo '６０歳〜';}
?>
<br>
問い合わせ内容
<?php echo h($_POST['contact']) ;?>
<br>

<input type="submit" name="back" value="戻る">
<input type="submit" name="btn_submit" value="送信する">
<input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']) ;?>">
<input type="hidden" name="email" value="<?php echo h($_POST['email']) ;?>">
<input type="hidden" name="url" value="<?php echo h($_POST['url']) ;?>">
<input type="hidden" name="gender" value="<?php echo h($_POST['gender']) ;?>">
<input type="hidden" name="age" value="<?php echo h($_POST['age']) ;?>">
<input type="hidden" name="contact" value="<?php echo h($_POST['contact']) ;?>">
<input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ;?>">
</form>

<?php endif; ?>

<?php endif; ?>

<?php if($pageFlag === 2 ) : ?>
<?php if($_POST['csrf'] === $_SESSION['csrfToken']) :?>
送信が完了しました。

<?php require '../mainte/insert.php';

insertContact($_POST);
?>

<?php unset($_SESSION['csrfToken']); ?>
<?php endif; ?>
<?php endif; ?>


<?php if($pageFlag === 0 ) : ?>
<?php
if(!isset($_SESSION['csrfToken'])){
  $csrfToken = bin2hex(random_bytes(32));
  $_SESSION['csrfToken'] = $csrfToken;
}
$token = $_SESSION['csrfToken'];
?>

<?php if(!empty($errors) && !empty($_POST['btn_confirm'])) :?>
<?php echo '<ul>'; ?>
<?php 
  foreach($errors as $error) {
    echo '<li>' . $error . '</li>' ; 
    } 
?>
<?php echo '</ul>'; ?>

<?php endif; ?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
    <form method="POST" action="input.php">
    <div class="form-group">
      <label for="your_name">氏名</label>
      <input type="text" class="form-control" id="your_name" name="your_name" value="<?php if(!empty($_POST['your_name'])){echo h($_POST['your_name']) ;} ?>" required>
    </div>

    <div class="from-group">
        <label for="email">メールアドレス</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($_POST['email'])){echo h($_POST['email']) ;} ?>" required>
    </div>
    
    <div class="form-group">
        <label for="url">ホームページ</label>
        <input type="url" class="form-control" id="url" name="url" value="<?php if(!empty($_POST['url'])){echo h($_POST['url']) ;} ?>" >
    </div>
性別
    <div class="form-check form-check-inline">
      <input type="radio" class="form-check-input" name="gender" id="gender1" value="0"
      <?php if(!empty($_POST['gender']) && $_POST['gender'] === '0') 
      {echo 'checked'; } ?>>
      <label class="form-check-label" for="gender1">男性</label>
      <input type="radio" class="form-check-input" name="gender" id="gender2" value="1"
      <?php if(!empty($_POST['gender']) && $_POST['gender'] === '1') 
      {echo 'checked'; } ?>>
      <lable class="form-check-label" for="gender2">女性</label> 
    </div>

    <div class="form-group">
    <label for="age">年齢</label>
    <select class="form-control" id="age" name="age">
      <option value="">選択してください</option>
      <option value="1">〜１９歳</option>
      <option value="2">２０歳〜２９歳</option>
      <option value="3">３０歳〜３９歳</option>
      <option value="4">４０歳〜４９歳</option>
      <option value="5">５０歳〜５９歳</option>
      <option value="6">６０歳〜</option>
    </select>
    </div>

    <div class="form-group">
      <label for="contact">お問い合わせ内容</label>
      <textarea class="form-control" id="contact" rows="3" name="contact">
      <?php if(!empty($_POST['contact'])){echo h($_POST['contact']) ;} ?>
      </textarea>
    </div>

    <div class="from-check">
      <input class="form-check-imput" type="checkbox" id="caution"name="caution" value="1">
      <label class="form-check-label" for="caution">注意事項にチェックする</label>
    </div>

    <input class="btn btn-info" type="submit" name="btn_confirm" value="確認する">
    <input type="hidden" name="csrf" value="<?php echo $token; ?>">
    </form>
  
    </div><!-- .col-md-6 -->
  </div><!-- .row -->
</div><!-- .container -->

<?php endif; ?>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
