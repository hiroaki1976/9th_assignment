# タイトル「ユーザー情報登録・閲覧アプリ」

## デプロイ

  - 
 
## 紹介と使い方

  - 卒業制作のユーザー登録画面を意識して、制作しました（前回、前々回の課題のアップグレード版です）。

  - ユーザー登録に必要と思われる項目を、フォームへ盛り込みました。

  - 登録した項目はデータベースに保存され、管理画面（kanri.php）より閲覧できます。

  - 管理画面からは、データの更新・削除ができます。

## 工夫した点

  - 同じ処理をする所は関数化し、コードを見やすくしました。 

  - 管理画面に表示されるパスワードはpassword_hash関数を使い、暗号化して表示しています。

  - 管理画面の表を少し見やすくしました（その分、スクロールしないとすべて見れませんが）。

## 苦戦した点

  - ダブルクォーテーションが1か所抜けていたために、データベースの更新ができず（エラーも出ない）、原因を見つけるのにとても苦労していましたが、チューターのかたおかさんのご指摘で解決することができました。ありがとうございました！

  - 更新画面のチェックボックスの処理にかなり手間取り、ChatGPTの助けも借りましたが解決できず苦戦しましたが、結局自分のデータベースの値の設定ミスと判明し、ほぼ解決したものの、「その他」のチェックボックスの処理だけがどうしてもできず、そこはきちんと動きません。

## 質問・疑問・感想など

  - [感想]ダブルクォーテーション・シングルクォーテーションには気をつけたいです。

  - [質問]全角のダブルクォーテーション・シングルクォーテーションをVSCode上で容易に見分ける方法があれば、知りたいです。

## 参考にした web サイトなど

  - 初心者でも安心！PHPパスワード暗号化の詳解5ステップ
  - https://jp-seemore.com/web/7770/

  - 
  - 