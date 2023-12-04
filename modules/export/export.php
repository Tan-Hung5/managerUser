<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;


$sql = "SELECT * FROM user";
$res = selectAllRaw($sql);

    $csvFileName = 'output.csv';

    // Mở hoặc tạo file CSV
    $csvFile = fopen($csvFileName, 'w');

    // Ghi tiêu đề (header) vào file CSV
    fputcsv($csvFile, array_keys($res[0]));

    // Ghi dữ liệu vào file CSV
    foreach ($res as $row) {
        fputcsv($csvFile, $row);
    }

    // Đóng file CSV
    fclose($csvFile);
    
    // Tải file CSV
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');
    readfile($csvFileName);

    // Xóa file sau khi đã tải về (tùy chọn)
    unlink($csvFileName);
    exit;
// $url= '/Project/manager_user/?module=&action=';
// header("Location:".$url."");
?>