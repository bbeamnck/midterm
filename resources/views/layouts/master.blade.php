<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title", "Cupcake | รสชาติอ่อนหวานน่ารับประทาน")</title>
    {{-- <title>Document</title> --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('vendor/toastr/toastr.min.js')}}"></script> 
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"> Cupcake</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="#">หน้าแรก</a></li>
                            <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า</a></li>
                            <li><a href="#">รายงาน</a></li>
                        </ul>
        </div>
    </nav>
    @yield("content")
    {{-- <a href="#" class="btn btn-primary"><i class="fa fa-home"></i>หน้าหลัก</a>
    <a href="#" class="btn btn-info"><i class="fa fa-save"></i>บันทึก</a>
    <a href="#" class="btn btn-danger"><i class="fa fa-edit"></i>แก้ไข</a> --}}
    @if(session('msg'))
        @if(session('ok'))
            <script>toastr.success("{{session('msg')}}")</script>
        @else
            <script>toastr.error("{{ session('msg') }}")</script>
        @endif
    @endif
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    
</body>
</html>