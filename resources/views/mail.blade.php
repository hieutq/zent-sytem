<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ZentGroup</title>
	<style>
		*{
			margin: 0 auto;
			padding: 0;
		}
		.container{
			width: 1000px;

		}

	</style>
	<link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="container">
		<table align="center"  width="1000px" >
			<tr height="250px" align="center">
				<td colspan="4"  width="100%" height="250px"  rowspan="2"><img height="100%" width="50%" src="{{url('img/LogoFix-01.png')}}" alt=""></td>

			</tr>
			<tr>
			</tr>
			<tr align="center">
				<td colspan="4"> <font size="4px" style="color: orange; font-family: tahoma;" >Zent Group - Khác biệt để thành công !</font> </td>
			</tr>
			<tr align="center">
				<td colspan="4">******************************</td>
			</tr>
			<tr>
				<td>Xin Chào : {{ $nameStudent }} </td>
				<td colspan="3"></td>
			</tr>
			
			<tr>
				<td class="content" colspan="4">{!! $content !!}</td>
				
			</tr>
			<tr>
				<td colspan="2" width="400px">
					<br>
					- <b>Tạ Quang Hiếu</b> <br>
					- <b>Zent Group Student Service</b> <br>
					-<i class="fa fa-phone-square" aria-hidden="true"></i> : 0968706683
				</td>
				<td colspan="2" width="600px">
					<br>
					- <b>CS1: Số nhà 9, ngách 23 ngõ 37 Đại Đồng, Thanh Trì, Hoàng Mai, Hà Nội.</b> <br>
					- <b>CS2: Tầng 3,4 số 52 Thanh Nhàn, Hai Bà Trưng, Hà Nội.</b> <br>
					- <i style="color:#861E1E;" class="fa fa-envelope-o" aria-hidden="true"></i>: zentgroup@gmail.com <br>
					- <a href="http://zentgroup.net" title="http://zentgroup.net"><i style="font-size: 20px" class="fa fa-globe " aria-hidden="true"></i> : http://zentgroup.net</a> <br>  
					- <a href="https://www.facebook.com/zent.academy/" title="https://www.facebook.com/zent.academy/"><i style="font-size: 20px" class="fa fa-facebook-square" aria-hidden="true"></i> : https://www.facebook.com/zent.academy/
					</a> 
				</td>
			</tr>
		</table>
	</div>
	


	<script src="{{url('js/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>
</body>
</html>