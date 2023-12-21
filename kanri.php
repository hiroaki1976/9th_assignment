<?php
//0. function.phpを呼び出す
require_once('function.php');

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // .=で追記される
    $view .= "<tr>";
    $view .= "<td>" . h($result['time']) . "</td>"."<td>". '<a href="detail.php?id=' . $result['id'] . '">' . h($result['jigyousyo']) . '</a>' . "</td>"."<td>". h($result['officetype_a']) . "</td>" . "<td>" . h($result['officetype_b']) . "</td>" . "<td>" . h($result['officetype_ikou']) . "</td>" . "<td>" . h($result['officetype_other']) . "</td>" . "<td>" . h($result['postcode']) . "</td>" . "<td>" . h($result['prefecture']) ."</td>" . "<td>" . h($result['city']) . "</td>" . "<td>" . h($result['town']) . "</td>" . "<td>" . h($result['name']) . "</td>" . "<td>" . h($result['name_kana']) . "</td>" . "<td>" .h($result['email']) ."</td>" . "<td>" . password_hash(h($result['password']), PASSWORD_DEFAULT) ."</td>" . "<td>" . '<a href="delete.php?id=' . h($result['id']) . '">[削除]</a>' . "</td>";
    $view .= "</tr>";
  }

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理画面</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body id="main">
<div>
    <div>
        <h1>登録ユーザー一覧</h1>
        <table>
            <tr>
                <th>登録日時</th><th>事業所名</th><th>A型</th><th>B型</th><th>移行</th><th>その他</th><th>郵便番号</th><th>都道府県</th><th>市区町村</th><th>町名など</th><th>担当者名</th><th>担当者名カナ</th><th>E-mail</th><th>password</th><th>削除ボタン</th>
            </tr>
                <?= $view ?> <!--?php echo $view ?の省略記法 -->
        </table>
    </div>
</div>

</body>
</html>
