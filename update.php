<?php

//0. function.phpを呼び出す
require_once('function.php');

//1. POSTデータ取得
$jigyousyo = $_POST['jigyousyo'];
$a_gata = isset($_POST['a_gata']) ? 'A型' . $_POST['a_gata'] : 'A型';
$b_gata = isset($_POST['b_gata']) ? 'B型' . $_POST['b_gata'] : 'B型';
$ikou = isset($_POST['ikou']) ? '移行' . $_POST['ikou'] : '移行';
$other = isset($_POST['other']) ? 'その他' . $_POST['other']. "\n" : 'その他'. "\n";
$postcode = isset($_POST['postcode']) ? $_POST['postcode']. "\n" : ''. "\n";
$prefecture = isset($_POST['prefecture']) ? $_POST['prefecture']. "\n" : ''. "\n";
$city = isset($_POST['city']) ? $_POST['city']. "\n" : ''. "\n";
$town = isset($_POST['town']) ? $_POST['town']. "\n" : ''. "\n";
$name = $_POST['name']. "\n";
$name_kana = $_POST['name_kana']. "\n";
$email = $_POST['email']. "\n";
$password1 = $_POST['password1']. "\n";
$id = $_POST["id"];

//2. DB接続します
$pdo = db_conn();

//3．データ登録SQL作成

// 3-1. SQL文を用意
$stmt = $pdo->prepare('UPDATE 
                        gs_bm_table
                        SET 
                        jigyousyo = :jigyousyo, officetype_a = :officetype_a, officetype_b = :officetype_b, officetype_ikou = :officetype_ikou, officetype_other = :officetype_other, postcode = :postcode, prefecture = :prefecture, city = :city, town = :town, name = :name, name_kana = :name_kana, email = :email, password = :password
                        WHERE id = :id; ');

// 3-2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':jigyousyo', $jigyousyo, PDO::PARAM_STR);
$stmt->bindValue(':officetype_a', $a_gata, PDO::PARAM_STR);
$stmt->bindValue(':officetype_b', $b_gata, PDO::PARAM_STR);
$stmt->bindValue(':officetype_ikou', $ikou, PDO::PARAM_STR);
$stmt->bindValue(':officetype_other', $other, PDO::PARAM_STR);
$stmt->bindValue(':postcode', $postcode, PDO::PARAM_STR);
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR);
$stmt->bindValue(':city', $city, PDO::PARAM_STR);
$stmt->bindValue(':town', $town, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':name_kana', $name_kana, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password1, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);


// 3-3. 実行
$status = $stmt->execute();

// 3-４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
  // $error = $stmt->errorInfo();
  // exit('ErrorMessage:'.$error[2]);
} else {
  redirect('kanri.php');
}