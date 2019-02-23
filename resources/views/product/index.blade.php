@extends("layouts.master")

@section('title') Cupcake | รายการสินค้า@stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>รายการสินค้า</h1>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="panel-title">
                        <strong>รายการ</strong>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ URL::to('product/search') }}" method="post" class="form-inline">
                        {{ csrf_field() }}
                        <input type="text" name="s" class="form-control" value="{{ Input::get('s')}}" placeholder="ใส่คำหรือข้อความที่จะค้นหา">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> ค้นหา</button>
                    </form>
                    <a href="{{ URL::to('product/edit')}}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
                </div>
            <table class="table table-bordered bs_table">
                <thead>
                    <tr>
                        <th>รูปสินค้า</th>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า</th>
                        <th>ประเภท</th>
                        <th>คงเหลือ</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>การทำงาน</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $p)
                    <tr>
                        <td><img src="{{ asset($p->image_url) }}" ></td>
                        <td>{{ $p->code }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category->name }}</td>
                        <td class="bs_price">{{number_format($p->stock_qty,0) }}</td>
                        <td class="bs_price">{{number_format($p->price,2) }}</td>
                        <td class="bs_center">
                            <a href="{{ URL::to('product/edit/'.$p->id) }}" class="btn btn-info"><i class="fa fa-edit"></i>แก้ไข</a>
                            <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}"><i class="fa fa-trush"></i>ลบ</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">รวม</th>
                        <th class="bs_price">{{ $products->sum('stock_qty') }}</th>
                        <th class="bs_price">{{ number_format($products->sum('price'),2) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
                  {{-- ส่วนการแจ้งเตือนว่าต้องการลบหรือมั้ย? --}}
                  <script>
                        $('.btn-delete').on('click', function(){
                            if(confirm("คุณต้องการลบข้อมูลสินค้าหรือไม่?")){
                                var url = "{{ URL::to('product/remove') }}"
                                + '/' + $(this).attr('id-delete');
                                window.location.href = url;
                            }
                        });
                </script>
            </table>
            <div class="panel-footer">
                <p align="right">แสดงข้อมูลจำนวน {{ count($products) }} รายการ</p>
            </div>
        </div>
        <center>{{ $products->links() }}
        </div>
    </div>
</div>




@endsection