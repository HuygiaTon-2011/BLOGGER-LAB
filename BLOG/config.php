<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "weblab");
mysqli_set_charset($conn, "utf8mb4");

/*
|--------------------------------------------------------------------------
| ✅ CẤU HÌNH LAB
|--------------------------------------------------------------------------
*/
define("LAB_MODE", true); 

/*
|--------------------------------------------------------------------------
| ✅ FLAG CHO TỪNG LAB
|--------------------------------------------------------------------------
*/
define("SQLI_FLAG",   "FLAG{blind_sqli_time_based_success}");
define("XSS_LV2_FLAG","FLAG{filter_bypass_xss_success}");
define("BROKEN_FLAG", "FLAG{broken_access_control_success}");
define("ADMIN_FLAG",  "FLAG{login_admin_success}");

/*
|--------------------------------------------------------------------------
| ✅ BLIND SQLi TIME-BASED QUA COOKIE – FIX CHUẨN
|--------------------------------------------------------------------------
*/
if (LAB_MODE && isset($_COOKIE['TrackingId'])) {

    $tid = $_COOKIE['TrackingId'];

    mysqli_report(MYSQLI_REPORT_OFF);
    ini_set('display_errors', 0);

    // ✅ BẮT ĐẦU ĐO THỜI GIAN TRƯỚC
    $start = microtime(true);

    // ✅ TEST MODE: GỬI force-delay → TỰ ĐỘNG NGỦ 5 GIÂY
    if ($tid === "admin") {
        sleep(5);
    }

    // ❌ LỖ HỔNG SQLi CỐ TÌNH
    $sql = "SELECT * FROM tracking WHERE tracking_id = '$tid' LIMIT 1";
    @mysqli_query($conn, $sql);

    $end  = microtime(true);
    $time = $end - $start;

    // ✅ CHỈ CẦN ≥ 3 GIÂY LÀ HIỆN FLAG
    if ($time >= 3) {
        echo "
        <div style='
            background:black;
            color:#00ff00;
            padding:25px;
            margin:30px auto;
            text-align:center;
            font-weight:bold;
            font-size:22px;
            border:4px solid #00ff00;
            border-radius:12px;
            max-width:800px;
        '>
            Bạn đã tìm thấy lỗi khi sử dụng SQL BLIND!<br><br>
            🚩 FLAG: " . SQLI_FLAG . "
        </div>";
    }
}
?>
