<?php

$max_page = ceil($count / 10);
if (!isset($_GET['page_id'])) {
    $now = 1;
} else {
    $now = $_GET['page_id'];
}
$start_no = ($now - 1) * 10;
$disp_data = array_slice($count, $start_no, 10, true);
?>