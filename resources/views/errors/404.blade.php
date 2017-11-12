<!DOCTYPE html>
<html>
    <head>
        <title>404 not found</title>

        <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Opps ! Trang không tìm thấy.</div>
                <a href="{{URL::asset('')}}dashboard"><button type="button" class="btn">Trang chủ</button></a>

            </div>
        </div>
    </body>
      <script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>
</html>
