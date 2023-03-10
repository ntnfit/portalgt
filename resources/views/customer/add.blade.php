@extends('adminlte::page')

@section('title', 'Users')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Tạo tài khoản cho Khách hàng</h1>
@stop
@section('plugins.Sweetalert2', true);
@section('content')
<div class="container-fluid"> 
<form action="{{route('users.store')}}" method="post">
@csrf
<div class="row">
    <x-adminlte-input label="Full name" label-class="text-lightblue" type="text" name="name" id="" placeholder="Nguyen van A"  fgroup-class="col-md-6" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-id-card text-lightblue"></i>
        </div>
    </x-slot>
    </x-adminlte-input>
    <x-adminlte-input label="Email"  label-class="text-lightblue" name="email" type="email" placeholder="mail@example.com"  fgroup-class="col-md-6" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-envelope text-lightblue"></i>
        </div>
    </x-slot>
    </x-adminlte-input>
</div>
<div class="row">
    
    <x-adminlte-input name="username" label="User" placeholder="username" label-class="text-lightblue"  fgroup-class="col-md-6" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-user text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>
<x-adminlte-input name="password" type="password" label="password" placeholder="password" label-class="text-lightblue"  fgroup-class="col-md-6" >
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-lock text-lightblue"></i>
        </div>
    </x-slot>
</x-adminlte-input>
</div>
<div class="row">
<x-adminlte-input label="Phone" type="text" name="phone" id="" placeholder="0987654321" label-class="text-lightblue" fgroup-class="col-md-6" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text">
            <i class="fas fa-phone text-lightblue"></i>
        </div>
    </x-slot>
    </x-adminlte-input>
<x-adminlte-input name="address" label="Address" fgroup-class="col-md-6" label-class="text-lightblue" placeholder="561A Điện Biên Phủ, Bình Thạnh, Hồ Chí Minh" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text text-purple">
            <i class="fas fa-address-card"></i>
        </div>
    </x-slot>
    <x-slot name="bottomSlot">
        <span class="text-sm text-gray">
          
        </span>
    </x-slot>
</x-adminlte-input>

</div>
@php
    $config = [
        "title" => "Select cardcode...",
        "liveSearch" => true,
        "liveSearchPlaceholder" => "Search...",
        "showTick" => true,
        "actionsBox" => true,
    ];
@endphp
<div class="row">
<x-adminlte-select-bs id="cardcode" name="cardcode" label="Assign Card Code"
    label-class="text-danger" igroup-size="sm" :config="$config" fgroup-class="col-md-6" enable-old-support>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-red">
            <i class="fas fa-cannabis"></i>
        </div>
    </x-slot>
</x-adminlte-select-bs>
<x-adminlte-select label="Vai trò" name="roles" fgroup-class="col-md-6" enable-old-support disabled>
@foreach($roles as $role)
      @if($role=="client"))
        <option value="{{$role}}" selected>{{$role}}</option>
    @else
    <option value="{{$role}}">{{$role}}</option>
    @endif
    @endforeach
</x-adminlte-select>
</div>
<x-adminlte-button class="btn-flat" style="float: right" type="submit" label="save" theme="success" icon="fas fa-lg fa-save"/>

</form>
@stop

@section('css')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@stop
@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@stop
@push('js')
<script>
    $(document).ready(function() {
//alert
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if(Session::has('success'))
        {
            Swal.fire({
                icon: 'success',
                text: 'Create user success!'
            }
            );
        }
        @endif
    loadata();
    function loadata(){
    $.ajax({
        beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", "Basic eyJDb21wYW55REIiOiAiU0JPREVNT0FVIiwiVXNlck5hbWUiOiAibWFuYWdlciIgfToxMTEx");
                },
            url:"https://115.84.182.179:50000/b1s/v1/BusinessPartners?$select=CardCode,CardName&$filter=CardType eq 'cCustomer'",
            xhrFields: {
                withCredentials: true
            }, 
            type: "get",
            dataType : "json",
            headers:{
                "Prefer": "odata.maxpagesize=all",
            },
        
            success: function( response ) {     
        var toAppend = '';
            $.each(response.value,function(i,o){
                toAppend += '<option value="'+o.CardCode+'">'+o.CardCode+'-'+o.CardName+'</option>';
            });
            $('#cardcode').append(toAppend);
            $('#cardcode').selectpicker('refresh')
        //   $('#sessions').append(toAppend);
            },
            error: function( xhr, status, errorThrown ) {
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
            }
        });
    } 

 });
        
  

</script>
@endpush