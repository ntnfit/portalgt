@extends('adminlte::page')

@section('title', 'Users')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Danh sách khách hàng</h1>
@stop

@section('content')
    <p style="float:right"><a href="{{route('user.add')}}"><x-adminlte-button label="Tạo mới" theme="primary" icon="fas fa-plus"/> </a> </p>
    {{-- Setup data for datatables --}}
    
   
    @php
$heads = [
    'STT',
    ['label' => 'Họ & Tên', 'width' => 28],
    ['label' => 'Số ĐT'],
    ['label' => 'Tài Khoản','width' => 10],
    ['label' => 'email', 'width' => 20],
    ['label' => 'Địa chỉ', 'width' => 50],
    ['label' => 'Hành động', 'no-export' => true, 'width' => 5],
];



        $items = array();
        foreach($data as $key) {
            $btnEdit = '<a href="'.route('users.edit',$key->id).'">
                <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button> </a>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
            $id=++$i;
        $items[] = [$id,$key->name, $key->phone,$key->username,$key->email,$key->address,'<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'];
        }
 
$config = [
    'data' => $items,
    'order' => [[0, 'asc']],
    'searching'=>true,
    "language" =>[
            "lengthMenu"=>"Hiện thị _MENU_ bản ghi trên trang",
            "zeroRecords"=> "Nothing found - sorry",
            "info"=> "Hiện thị trang _PAGE_ / _PAGES_",
            "infoEmpty"=> "No records available",
            "infoFiltered"=> "(filtered from _MAX_ total records)",
            "search"=>"Tìm kiếm:",
            "paginate"=> [
                "first"=>"Đầu",
                "last"=>"Cuối",
                "next"=>"Tiếp",
                "previous"=> "Trước"
                ]
            
            ],
           
            

    'columns' => [null,null,null,null,null,null,['orderable' => false]],
];
@endphp
<x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"
    striped hoverable bordered compressed/>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop