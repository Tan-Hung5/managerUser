<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', '');

require __DIR__ .'/../../includes/vendor/autoload.php'; // Đảm bảo đường dẫn đúng

use League\Csv\Reader;

if (isset($_POST['submit'])) {
    $targetDirectory = "uploads/";
    
    // Kiểm tra xem thư mục "uploads" có tồn tại không
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true); // Tạo thư mục nếu nó không tồn tại
    }

    $targetFile = $targetDirectory . basename($_FILES['file']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Kiểm tra nếu tệp là tệp CSV
    if ($fileType != "csv") {
        echo "Xin lỗi, chỉ chấp nhận tệp CSV.";
        $uploadOk = 0;
    }

    // Kiểm tra xem tệp có được tải lên thành công không
    if ($uploadOk == 0) {
        echo "Xin lỗi, tệp của bạn không được tải lên.";
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            // Bây giờ bạn có thể đọc tệp CSV
            $csv = Reader::createFromPath($targetFile, 'r');
            $csv->setHeaderOffset(0); // Đặt vị trí của hàng tiêu đề (nếu có)

            // Lấy dữ liệu từ tệp CSV
            $records = $csv->getRecords();

            // Hiển thị dữ liệu CSV (bạn có thể tùy chỉnh phần này)
            foreach ($records as $record) {
                $record = setTime($record,'create_at');
                insert('user', $record);
            }
            $url= '/Project/manager_user/?module=&action=';
            header("Location:".$url."");
        } else {
            echo "Xin lỗi, có lỗi khi tải lên tệp của bạn.";
        }
    }
}
?>
