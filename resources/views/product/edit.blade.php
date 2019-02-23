@extends("layouts.master")

@section('title') Cupcake | แก้ไขข้อมูลสินค้า@stop

@section('content')
{!! Form::model($product, array('action' => 'ProductController@update','method' => 'post','enctype' => 'multipart/form-data' )) !!}
<input type="hidden" name="id" value="{{ $product->id }}">
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>แก้ไขข้อมูล</h1>
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
                <li class="active">แก้ไขสินค้า</li>
            </ul>
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)<div>{{ $error }}</div>@endforeach
            </div>
            @endif
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>ข้อมูลสินค้า</strong>
                    </div>
                </div>
                <div class="panel-body">
                <br>
                <table>
                    <tr>
                        <td>{{ Form::label('code','รหัสสินค้า') }}</td>
                        <td>{{ Form::text('code',Input::old('code'),['class' => 'form-control' ]) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('name','ชื่อสินค้า') }}</td>
                        <td>{{ Form::text('name',Input::old('name'),['class' => 'form-control' ]) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('category_id','ประเภทสินค้า') }}</td>
                        <td>{{ Form::select('category_id',$category,Input::old('category_id'),['class' => 'form-control' ]) }}
                        </td>
                    </tr>

                    <tr>
                        <td>{{ Form::label('stock_qty','คงเหลือ') }}</td>
                        <td>{{ Form::text('stock_qty',Input::old('stock_qty'),['class' => 'form-control' ]) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('price','ราคาต่อหน่วย') }}</td>
                        <td>{{ Form::text('price',Input::old('price'),['class' => 'form-control' ]) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('image','เลือกรูปภาพสินค้า') }}</td>
                        <td>{{ Form::file('image',Input::old('image'),['class' => 'form-control' ]) }}</td>
                    </tr>
                    @if($product->image_url)
                    <tr>
                        <td><strong>รูปสินค้า</strong></td>
                        <td><img src="{{ URL::to($product->image_url )}}" ></td>
                    </tr>
                    @endif
                </table>
            </div>
                <br>
    
        <div class="panel-footer">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>บันทึก</button>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection