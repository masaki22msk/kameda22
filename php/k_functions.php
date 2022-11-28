<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=kasedasaba;host=localhost';
    try {
        $pdo = new PDO($param, 'kame', 'kamekame');
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>