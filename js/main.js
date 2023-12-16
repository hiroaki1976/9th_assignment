//
// 郵便番号から住所を自動入力
//
// formを取得
const contactForm = document.forms.contact;
// formのpostcodeに郵便番号を入力したら関数を実行する
contactForm.postcode.addEventListener('input', e => {
  // zipcloud apiを使って、郵便番号の住所データを取得。
    fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${e.target.value}`)
    // 取得したデータをjson形式で読み込み。
    .then(response => response.json())
    // 取得したデータを出力
    .then(data => {
        contactForm.prefecture.value = data.results[0].address1;
        contactForm.city.value = data.results[0].address2;
        contactForm.town.value = data.results[0].address3;
    })
    .catch(error => console.log(error))
})

//
// 全角カタカナ+全角・半角スペース正規表現チェック
//
$('#myForm').on('submit', function(event) {
    let input = $('#name_kana').val();
  // 全角カタカナ+全角・半角スペースの正規表現
    let regex = /^[\u30A0-\u30FF\s+]*$/;

    if (regex.test(input)) {
        $('#errorMessage1').text('');
    } else {
        $('#errorMessage1').text('全角カタカナのみを入力してください。');
        event.preventDefault();
    }
});

//
// パスワード一致チェック
//
$('#submit').on('click', function(event){
    let input1 = $('#password1')[0].value;
    let input2 = $('#password2')[0].value;
    if (input1 != input2){
        $('#errorMessage2').text('パスワードの入力値が一致しません。');
        event.preventDefault();
    } else {
        $('#errorMessage2').text('');
    }
});

//
// パスワード強度チェック
//
$('#password1').on('keyup', function() {
    // 入力値取得
    const value = $(this).val();
    // 入力値をもとに強度を確認
    const result = checkStrength(value);
    // 結果を出力
    $('#result').text(result);
    });

    const checkStrength = (password) => {

    let strength = 0 //強さ

    if (password.length < 6) {
        return '短すぎる！！'
    }

    // 文字数が7より大きいければ+1
    if (password.length > 7) strength += 1
    // 英字の大文字と小文字を含んでいれば+1
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
    // 英字と数字を含んでいれば+1
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
   // 記号を含んでいれば+1
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    // 記号を2つ含んでいれば+1
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1

    // 点数を元に強さを計測
    if (strength < 2) {
        return '弱いです〜'
    } else if (strength == 2) {
        return '良い感じ！！'
    } else {
        return '強いです！!'
    }
    }