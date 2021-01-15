<?php 

// DB接続 PDO
function insertContact($request) {
require  'db_connection.php';


//入力 DB保存 prepare, execute(配列(すべて文字列))


  
  $params = [
    'id' => null,
    'your_name' => $request['your_name'],
    'email' => $request['email'],
    'url' => $request['url'],
    'gender' => $request['gender'],
    'age' => $request['age'],
    'contact'=> $request['contact'],
    'created_at' => null
  ];
  
  // $params = [
  //   'id' => null,
  //   'your_name' => 'なまえ123',
  //   'email' => 'test@test.com',
  //   'url' => 'http://test.com',
  //   'gender' => '1',
  //   'age' => '2',
  //   'contact'=> 'いいい',
  //   'created_at' => null
  // ];
  
  $count = 0;
  $culumns = '';
  $values = '';
  
  foreach(array_keys($params) as $key) {
    if($count++>0){
      $culumns .= ',';
      $values .= ',';
    }
    $culumns .= $key;
    $values .= ':' . $key;
  }
  
  $sql = 'insert into contacts ('.$culumns.')values('.$values.')';
  
  // var_dump($sql);
  // exit;
  
  $stmt = $pdo->prepare($sql);//プリペア−ドステートメント
  // $stmt->bindValue('id',2,PDO::PARAM_INT);//ひもづけ
  $stmt->execute($params);//実行
}
  