<?php
echo '<div>全件数' . $books_num . '件' . '　';
if ($books_num != 0) {
    if ($now > 1) { // リンクをつけるかの判定
        echo '<a href=' . $myURL . '?page_id=' . ($now - 1) . $option . '>前へ</a>' . '　';
    } else {
        echo '前へ' . '　';
    }

    for ($i = 1; $i <= $max_page; $i++) {
        if ($i == $now) {
            echo $now . '　';
        } else {
            echo '<a href=' . $myURL . '?page_id=' . $i . $option . '>' . $i . '</a>' . '　';
        }
    }

    if ($now < $max_page) { // リンクをつけるかの判定
        echo '<a href=' . $myURL . '?page_id=' . ($now + 1) . $option . '>次へ</a>' . '　';
    } else {
        echo '次へ';
    }
}
echo '</div>';
?>