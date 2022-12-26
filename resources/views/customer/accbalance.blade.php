@extends('adminlte::page')

@section('title', 'Users')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Dự Nợ</h1>
@stop
@section('plugins.Sweetalert2', true);
@section('content')
<div>
<h6>Mã Khách hàng: {{auth()->user()->cardcode}}</h6>
<h6>Tên Khách hàng: {{auth()->user()->name}}</h6>
<h6 id="duno">Dư nợ hiện tại: </h6>
</div>

@stop
@push('js')
<script> 
              $.ajax({
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", "Basic eyJDb21wYW55REIiOiAiU0JPREVNT0FVIiwiVXNlck5hbWUiOiAibWFuYWdlciIgfToxMTEx");
                },
                url:"https://115.84.182.179:50000/b1s/v1/BusinessPartners?$select=CurrentAccountBalance,Currency&$count=true&$filter=CardCode eq'{{auth()->user()->cardcode}}'",
                xhrFields: {
                    withCredentials: true
                }, 
            // whether this is a POST or GET request
            type: "get",
            // the type of data we expect back
            dataType : "json",
                headers:{
                    "Prefer": "odata.maxpagesize=all",
                },
            // code to run if the request succeeds;
            // the response is passed to the function
            success: function( response ) {
                var duno=response.value[0].CurrentAccountBalance+" "+response.value[0].Currency
        $('#duno').append(document.createTextNode(duno));
            },
            error: function( xhr, status, errorThrown ) {
              console.log( "Error: " + errorThrown );
              console.log( "Status: " + status );
              console.dir( xhr );
              connected = false;
            },
        });

    </script>
@endpush   



