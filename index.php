<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>longdo ajax dictionary</title>
<!--1.ส่วนของ css สำหรับกำหนดรูปแบบ สีข้อความ พื้นหลัง หรืออื่นๆ ตามต้องการ-->
<style type="text/css">
div#myblock_dict{
    font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
    font-size:12px; 
    margin:auto;
    width:350px;    
}
input#translate_it{
    background-color:#F6C;
    color:#FFF; 
    border:1px groove #F9C;
    cursor:pointer;
}
div#input_search{
    background-color:#000;
    color:#FFF;
    text-align:center;
}
div#context_search{
    border:1px solid #F9C;
    height:300px;
    overflow:auto;
}
div#context_search{
    font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
    font-size:12px; 
    padding:5px;
    background-color:#FDEDFE;
}
div#context_search a{
    margin-left:3px !important;
    color:#F09; 
}
div#context_search td{
    padding:5px !important;
}
</style>
</head>
 
<body>
 
 
<!--2.ส่วนของ element องค์ประกอบในการใช้งาน-->
<div id="myblock_dict">
<div id="input_search">คำค้น
  <input type="text" name="keyword_q" id="keyword_q" />
  <input type="button" name="translate_it" id="translate_it" value="แปล" />
</div>
<div id="context_search">
 
</div>
</div>
 
 
<!--3.ส่วนของ javascript โดยใช้งานผ่าน jQuery-->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(function(){
        // กำหนดตัวแปรสำหรับแสดงรูปกำลังโหลด
        var loading_img='<center>';
        loading_img+='<img src="http://static.ak.fbcdn.net/rsrc.php/z5R48/hash/ejut8v2y.gif">';
        loading_img+='</center>';
        $("#keyword_q").click(function(){ // เมื่อคลิกที่ช่องคำค้น 
            // เพื่อสะดวกในการพิมพ์คำค้นใหม่ได้เลย
            $(this).select(); //  ถ้ามีข้อความอยู่ ให้ทำการเลือกข้อความนั้น
            $("#context_search").html(""); //  ล้างค่าข้อความผลลัพธ์เดิม ถ้ามี
        });
        $("#translate_it").click(function(){  // เมื่อคลิกที่ปุ่มคำว่า แปล
            $("#context_search").html(loading_img); // แสดงรูปกำลังโหลดในส่วนผลลัพธ์
            // ใช้ ajax ใน jQuery ส่งข้อมูลแบบ get
            $.get("ajax_translate.php",{keyword:$.trim($("#keyword_q").val()) },function(data){
                $("#context_search").html(data); // แสดงผลลัพธ์จากการค้นหา
            });
        });
         
        $("#keyword_q").keyup(function(event){
            if(event.keyCode==13){ // เมื่อกดปุ่ม Enter ให้เริ่มการค้นหา
                $("#context_search").html(loading_img); // แสดงรูปกำลังโหลดในส่วนผลลัพธ์
                $.get("ajax_translate.php",{keyword:$.trim($("#keyword_q").val())},function(data){
                    $("#context_search").html(data); // แสดงผลลัพธ์จากการค้นหา
                });             
 
            }
        });
         
        // เมื่อคลิกที่ลิ้งค์ ในผลลัพธ์
        $("div#context_search a").live("click",function(){
            var text_search=$.trim($(this).text()); // นำคำจากลิ้งค์ที่คลิก มาเก็บในตัวแปร
            $("#context_search").html(loading_img); // แสดงรูปกำลังโหลดในส่วนผลลัพธ์
            $("#keyword_q").val(text_search); // นำคำจากลิ้งค์ไปแสดงที่ช่อง คำค้น
            $.get("ajax_translate.php",{keyword:text_search},function(data){
                $("#context_search").html(data); // แสดงผลลัพธ์จากการค้นหา
            });     
            return false;           
        });
});
</script>
 
 
</body>
</html>