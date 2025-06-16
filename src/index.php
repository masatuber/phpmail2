<?php
ob_start(); // ヘッダーエラー防止

session_start();
$error = [];
$post = [];

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    // エラーチェック
    if (empty($post['name'])) {
        $error['name'] = 'blank';
    }
    if (empty($post['email'])) {
        $error['email'] = 'blank';
    } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }
    if (empty($post['contact'])) {
        $error['contact'] = 'blank';
    }

    // エラーがなければ確認画面へ
    if (count($error) === 0) {
        $_SESSION['form'] = $post;
        header("Location: /confirm.php");
        exit();
    }
} else {
    // セッションから値を取得
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問合せフォーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="contact.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" novalidate>
            <p>お問い合わせ</p>
            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputName">お名前</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="name" id="inputName" class="form-control" 
                               value="<?php echo htmlspecialchars($post['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                               required autofocus>
                        <?php if (($error['name'] ?? '') === 'blank'): ?>
                            <p class="error_msg">※お名前をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputEmail">メールアドレス</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <input type="email" name="email" id="inputEmail" class="form-control" 
                               value="<?php echo htmlspecialchars($post['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
                               required>
                        <?php if (($error['email'] ?? '') === 'blank'): ?>
                            <p class="error_msg">※メールアドレスをご記入下さい</p>
                        <?php elseif (($error['email'] ?? '') === 'email'): ?>
                            <p class="error_msg">※メールアドレスを正しくご記入ください</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="inputContent">お問い合わせ内容</label>
                    </div>
                    <div class="col-2">
                        <p class="require_item">必須</p>
                    </div>
                    <div class="col-8">
                        <textarea name="contact" id="inputContent" rows="10" class="form-control" required><?php echo htmlspecialchars($post['contact'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <?php if (($error['contact'] ?? '') === 'blank'): ?>
                            <p class="error_msg">※お問い合わせ内容をご記入下さい</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8 offset-4">
                    <button type="submit">確認画面へ</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
