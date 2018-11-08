<?php
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);       
// ตรวจสอบว่ามีการส่งคำค้นมาหรือไม่
if(isset($_GET['keyword']) && trim($_GET['keyword'])!=""){
    $keyword=trim($_GET['keyword']);
    // นำผลลัพธ์การค้นหา จาก longdo dictionary มาไว้ในตัวแปร
    $data=file_get_contents("http://dict.longdo.com/mobile.php?search=".$keyword);  //
    echo strip_tags($data,"<a><table><td><tr><font><style><meta><br>"); // แสดงส่วนของเนื้อหาที่จำเป็นต้องแสดง
}else{ // กรณีไม่มีการส่งคำค้นมา
    echo "โปรดระบุคำที่ต้องการแปล"; // แสดงข้อความแจ้งเตือน
}
?>