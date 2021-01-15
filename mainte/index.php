<?php   

require 'db_connection.php';

// ユーザー入力なし query
// $sql = 'select * from contacts where id = 2'; //sql
// $stmt = $pdo->query($sql); //sql実行 ステートメント

// $result = $stmt->fetchall();

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

// ユーザー入力あり prepare, bind, execute 悪意ユーザ sqlインジェクション対策
$sql = 'select * from contacts where id = :id'; //名前付きプレースホルダ
$stmt = $pdo->prepare($sql);//プリペア−ドステートメント
$stmt->bindValue('id',2,PDO::PARAM_INT);//ひもづけ
$stmt->execute();//実行
$result = $stmt->fetchall();

echo '<pre>';
var_dump($result);
echo '</pre>';

// トランザクション まとまって処理 beginTransaction,commit,rollback

$pdo->beginTransaction();
//sql処理

$pdo->commit();

try {}catch(PDOexpection $e){

  $pdo->rollback();//更新のキャンセル
}

