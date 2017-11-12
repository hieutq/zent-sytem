<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::create(
        	
        	array(
                    'name'=>'LẬP TRÌNH WEB FRONT-END',
                    'short_name'=>'Web Front-End',
                    'slogan'=>'Lập trình giao diện chuyên nghiệp cho website - Học cùng chuyên gia đến từ Viettel',
                    'code'=>'web-front-end',
                    // 'class_img'=>'img/bg_course/web_basic.jpg',
                    'capacity'=>'20',
                    'class_info'=>'Khóa học cung cấp cho các bạn kiến thức quan trọng trên con đường trở thành một web developer như HTML, CSS, JS, Jquery
                 </br></br>Các bạn còn được tiếp cận với các công nghệ mới nhất như HTML5, CSS3, Boostrap, Ajax </br> </br><strong>Được thực tập và làm việc tại Zent Group và các công ty đối tác của Zent Group sau khóa học </strong><br><br>Thời lượng: <b>24 buổi </b> học gồm 16 buổi học cùng giảng viên, 8 buổi học cùng trợ giảng và học nhóm + không giới hạn các buổi tự học nhóm tại Zent Group (Zent Group luôn mở phòng học cho các bạn học nhóm) <br> <br>
                Lịch học: Tuần 2 buổi học cùng giảng viên + 1 buổi học nhóm cùng trợ giảng <br>
                 Nhận chứng chỉ <b>ĐÃ HOÀN THÀNH KHOÁ HỌC</b> sau buổi bảo vệ Project cuối khoá.','student_object'=>'<ul>
                    <li><i class="icon-idea"></i>​ Chưa có kiến thức về lập trình web</li><br>
                    <li><i class="icon-idea"></i>Có mong muốn trở thành lập trình web tương lai</li><br>
                    <li><i class="icon-idea"></i>C&oacute; mong muốn trở th&agrave;nh lập tr&igrave;nh vi&ecirc;n của c&aacute;c tập đo&agrave;n như Viettel, VNPT, VTC...&nbsp;</li><br>
                    <li><i class="icon-idea"></i>C&oacute; mong muốn được giới thiệu thực tập v&agrave; việc l&agrave;m sau tốt nghiệp</li><br>
                    <li><i class="icon-idea"></i>Đang l&agrave;m đồ &aacute;n m&ocirc;n học tr&ecirc;n trường</li>
                </ul>
                ',
                'content'=>'<i class="icon-idea"></i> HTML, CSS, Java Script <br><br>
                <i class="icon-idea"></i> HTML5, CSS3  <br><br>
                <i class="icon-idea"></i> Jquery, Ajax  <br><br>',
                'orientation_time'=>'2016-08-20 19:00:00',
                'time_table'=>'19H-21H thứ 4, thứ 7 hàng tuần (sẽ thống nhất với cả lớp sau buổi khai giảng)',
                'class_desire_detail'=>'',
                'tuition'=>'2,999,000 VND',
                'status'=>'1',
                // 'header_bg_img'=>'img/bg_course/header-wb03.jpg',
                // 'register_bg_img'=>'img/bg_course/register-wb03.jpg',
                // 'footer_bg_img'=>'img/bg_course/header-wb03.jpg',
                'register_info'=>'Đăng ký tham gia khóa học. Các bạn có thể học thử xem có phù hợp thì tham gia nhé. <br><br> HOÀN TRẢ 100% HỌC PHÍ nếu sau khóa học bạn không thu được kiến thức gì.',
                'class_fb_group'=>'https://www.facebook.com/groups/195391050857422/',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'Trở thành Java Developer tương lai',
                'short_name'=>'Java Core',
                'slogan'=>'Java Developer - Lập trình viên tương lai',
                'code'=>'java-core',
                // 'class_img'=>'img/bg_course/java_basic.jpg','capacity'=>'20',
                'class_info'=>'Khóa học nhằm giúp các bạn sinh viên chưa có nhiều kiến thức về lập trình có cái nhìn toàn diện hơn về lập trình, đặc biệt là ngôn ngữ lập trình Java.
                <br><br>
                Sau khóa học, học viên biết cách tư duy giải quyết một bài toán cũng như xây dựng ứng dụng từ đầu.
                <br><br>
                Không chỉ dừng lại ở các kiến thức đơn thuần, học viên còn được chia sẻ các case study từ các giảng viên đến từ các công ty, tập đoàn về phần mềm lớn như Viettel, VNPT, VTC...</br> </br><strong>Được thực tập và làm việc tại Zent Group và các công ty đối tác của Zent Group sau khóa học </strong><br><br>Thời lượng: <b>27 buổi </b> học gồm 18 buổi học cùng giảng viên, 9 buổi học cùng trợ giảng và học nhóm + không giới hạn các buổi tự học nhóm tại Zent Group (Zent Group luôn mở phòng học cho các bạn học nhóm) <br> <br>
                Lịch học: Tuần 2 buổi học cùng giảng viên + 1 buổi học nhóm cùng trợ giảng
                 Nhận chứng chỉ <b>ĐÃ HOÀN THÀNH KHOÁ HỌC</b> sau buổi bảo vệ Project cuối khoá.','student_object'=>'<ul>
                <li><i class="icon-idea"></i>​Sinh vi&ecirc;n chưa c&oacute; kỹ năng về lập tr&igrave;nh&nbsp;</li><br>
                <li><i class="icon-idea"></i>C&oacute; mong muốn l&agrave;m chủ ng&ocirc;n ngữ lập tr&igrave;nh&nbsp;</li><br>
                <li><i class="icon-idea"></i>C&oacute; mong muốn trở th&agrave;nh lập tr&igrave;nh vi&ecirc;n của c&aacute;c tập đo&agrave;n như Viettel, VNPT, VTC...&nbsp;</li><br>
                <li><i class="icon-idea"></i>C&oacute; mong muốn được giới thiệu thực tập v&agrave; việc l&agrave;m sau tốt nghiệp</li><br>
                <li><i class="icon-idea"></i>Đang l&agrave;m đồ &aacute;n m&ocirc;n học tr&ecirc;n trường</li>
            </ul>
            ',
            'content'=>'<i class="icon-idea"></i><b>Java Core </b>: Kiến thức nền tảng của lập trình Java <br><br> <i class="icon-idea"></i><b>Java Swing</b>: Xây dựng giao diện ứng dụng trong Java<br><br><i class="icon-idea"></i><b>Java JDBC</b>: Kết nối cơ sở dữ liệu với ứng dụng Java<br><br><i class="icon-idea"></i><b>SQL Server</b>: Xây dựng cơ sở dữ liệu cho ứng dụng<br>',
            'orientation_time'=>'2016-09-20 19:00:00',
            'time_table'=>'19H-21H thứ 5, chủ nhật hàng tuần (sẽ thống nhất với cả lớp sau buổi khai giảng)',
            'class_desire_detail'=>'',
            'tuition'=>'3,999,000 VND',
            'status'=>'1',
            // 'header_bg_img'=>'img/bg_course/header-wb03.jpg',
            // 'register_bg_img'=>'img/bg_course/register-wb03.jpg',
            // 'footer_bg_img'=>'img/bg_course/header-wb03.jpg',
            'register_info'=>'Đăng ký tham gia khóa học. Các bạn có thể <b>học thử 02 buổi</b> xem phù hợp thì tham gia nhé. <br><br> HOÀN TRẢ 100% HỌC PHÍ nếu sau khóa học bạn không thu được kiến thức gì.',
            'class_fb_group'=>'https://www.facebook.com/groups/674933555997454/',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"
            ))
        );
    }
}
