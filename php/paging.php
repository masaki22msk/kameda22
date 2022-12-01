<?php
$books_num = count($result);
$max_page = ceil($books_num / MAX);
if (!isset($_GET['page_id'])) {
    $now = 1;
} else {
    $now = $_GET['page_id'];
}
$start_no = ($now - 1) * MAX;
$disp_data = array_slice($result, $start_no, MAX, true);
?>