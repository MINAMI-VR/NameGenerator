<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<link rel="stylesheet" href="css/name-generator.css">
<head>
    <title>ハンドルネームジェネレータ</title>
</head>

<body>
<form action="name-generator.php" method="POST">
    文字数
    <br>
    <label>最小
        <select name=" min">
            <?php for ($i = 1; $i < 6; $i++): ?>
                <option value=<?php echo $i ?> <?php if (selected('min', $i)) {
                    echo 'selected';
                } ?>><?php echo $i + 1 ?></option>
            <?php endfor; ?>
        </select>
    </label>
    <br/>

    <label>最大
        <select name="max">
            <?php for ($i = 1; $i < 6; $i++): ?>
                <option value=<?php echo $i ?> <?php if (selected('max', $i)) {
                    echo 'selected';
                } ?>><?php echo $i + 1 ?></option>
            <?php endfor; ?>
        </select>
    </label>
    <br/>
    <br>

    <label>生成する量
        <br>
        <input type="number" name="quantity" value=
               <?php if (isset($_POST['quantity'])): ?>"<?php echo $_POST['quantity']; ?>"<?php else: ?>"10"<?php endif; ?> min="1" max="1000" required>
    </label>

    <input type="submit" value="generate"/>
</form>

<?php
$str0 = '';
if (isset($_POST['min']) && isset($_POST['max'])) {
    if ($_POST['min'] > $_POST['max']) {
        echo '<font color="red">最大値が最小値より大きくなるように選択してください</font>';
    } else {
        $base = ['あ', 'い', 'う', 'え', 'お', 'か', 'き', 'く', 'け', 'こ', 'さ', 'し', 'す', 'せ', 'そ', 'た', 'ち', 'つ', 'て', 'と', 'な', 'に', 'ぬ', 'ね', 'の', 'は', 'ひ', 'へ', 'ほ', 'ま', 'み', 'む', 'め', 'も', 'や', 'ゆ', 'よ', 'ら', 'り', 'る', 'れ', 'ろ', 'わ'];
        $arr0 = $base;
        $arr1 = array_merge($base, ['ん', 'ぁ', 'ぃ', 'ぅ', 'ぇ', 'ぉ', 'ゃ', 'ゅ', 'ょ', 'ー']);
        for ($i = 0; $i < $_POST['quantity']; $i++) {
            $initial = implode(ArrayShuffle($arr0, 0, 1));
            echo '<div class="handlename">';
            echo $initial;
            $str0 .= $initial;
            for ($j = 0; $j < rand($_POST['min'], $_POST['max']); $j++) {
                $str = implode(ArrayShuffle($arr1, 0, 1));
                echo $str;
                $str0 .= $str;
            }
            echo '</div>';
            //echo '<br>';
            echo "\n";
            $str0 .= "\n";
        }
        file_put_contents('./log/' . strval(time()) . '.txt', $str0);
    }
}

function ArrayShuffle($arr, $offset, $length)
{
    shuffle($arr);
    return array_slice($arr, $offset, $length);
}

function selected($target, $val)
{
    if (isset($_POST[$target])) {
        if ($_POST[$target] == $val) {
            return true;
        } else {
            return false;
        }
    }
}

?>

</body>
</html>
