<?php

$csvFile = 'test.csv';

// Mở file để đọc
$file = fopen($csvFile, 'r');
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
    
} else {
    echo "Failed to open the CSV file.";
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose a file:</label>
        <input type="file" name="file" id="file">
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>  