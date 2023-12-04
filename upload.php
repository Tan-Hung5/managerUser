
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
$targetDirectory = "uploads/"; // Thư mục lưu trữ file tải lên
$targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
    
}
$csv= "uploads/test.csv";
$file = fopen($csv, 'r');
$arr = [];
// Kiểm tra xem file có mở thành công không
if ($file !== false) {
    $header = fgetcsv($file, 0, ',');
    if (strpos($header[0], "\xEF\xBB\xBF") !== false) {
        $header[0] = substr($header[0], 3);
    }
    // Đọc từng dòng của file và chuyển thành mảng
    while (($data = fgetcsv($file, 0, ',')) !== false) {
        // $data là một mảng chứa các giá trị từ dòng hiện tại
        $rowData = array_combine($header, $data);
        // In ra mảng dữ liệu của mỗi dòng
        $arr[] = $rowData;
    }

    // Đóng file sau khi đọc xong
    echo '<pre>';
    Print_r($arr);
    echo '</pre>';
} else {
    echo "Failed to open the CSV file.";
}