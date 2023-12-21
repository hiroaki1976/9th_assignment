<?php
$id = $_GET['id'];

//0. function.phpを呼び出す
require_once('function.php');

//1.  DB接続します
$pdo = db_conn();

//２．データ取得SQL作成
// idが$idのデータを取得するSQLを作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    // 成功した場合
    $result = $stmt->fetch();
    }
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>ユーザー情報更新</h1>
    <p class="onegai">ユーザー情報更新</p>
    <form name="contact" action="update.php" method="post" id="myForm">
        <dl>
            <dt>【必須】事業所名：</dt><dd><input type="text" name="jigyousyo" value="<?= h($result['jigyousyo']) ?>" required></dd>
            <dt>事業所種別：</dt>
            <dd><input type="checkbox" name="a_gata" id="a_gata" <?= isset($result['officetype_a']) && h($result['officetype_a']) == 'A型on' ? 'checked' : '' ?>>就労継続支援A型
                <input type="checkbox" name="b_gata" id="b_gata" <?= isset($result['officetype_b']) && h($result['officetype_b']) == 'B型on' ? 'checked' : '' ?>>就労継続支援B型
                <input type="checkbox" name="ikou" id="ikou" <?= isset($result['officetype_ikou']) && h($result['officetype_ikou']) == '移行on' ? 'checked' : '' ?>>就労移行支援
                <input type="checkbox" name="other" id="other" <?= isset($result['officetype_other']) && h($result['officetype_other']) == 'その他on' ? 'checked' : '' ?>>その他    
            </dd>
            <dt>郵便番号</dt><dd><input name="postcode" type="text" value="<?= h($result['postcode']) ?>"></dd>
            <dt>都道府県</dt><dd><input name="prefecture" type="text" value="<?= h($result['prefecture']) ?>"></dd>
            <dt>市区町村</dt><dd><input name="city" type="text" value="<?= h($result['city']) ?>"></dd>
            <dt>町名など</dt><dd><input name="town" type="text" value="<?= h($result['town']) ?>"></dd>
            <dt>【必須】ご担当者様氏名：</dt><dd><input type="text" name="name" value="<?= h($result['name']) ?>" required></dd>
            <dt>【必須】ご担当者様氏名（カナ）：</dt><dd><input type="text" name="name_kana" id="name_kana" value="<?= h($result['name_kana']) ?>" required></dd>
            <p id="errorMessage1"></p>
            <dt>【必須】E-MAIL:</dt><dd><input type="email" name="email" value="<?= h($result['email']) ?>" required></dd>
            <dt>【必須】Password:</dt><dd><input type="password" name="password1" id="password1" value="<?= h($result['password']); ?>" required></dd>
        </dl>
        <input type="hidden" name="id" value="<?= h($result['id']); ?>">
        <input type="submit" value="更新" id="submit">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>