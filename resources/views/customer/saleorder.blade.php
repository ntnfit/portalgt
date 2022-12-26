@extends('adminlte::page')

@section('title', 'Users')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Danh sách đơn hàng</h1>
@stop
@section('plugins.Sweetalert2', true);
@section('content')
	<div id="myGrid" class="ag-theme-alpine" style="height: 100%">
	</div>
    <style media="only screen">
            html, body {
                height: 100%;
                width: 100%;
                margin: 0;
                box-sizing: border-box;
                -webkit-overflow-scrolling: touch;
            }

           

           
        </style>
 
<script>var __basePath = './';</script>
<script src="https://cdn.jsdelivr.net/npm/ag-grid-community@28.2.1/dist/ag-grid-community.min.js"> </script>
@stop
@vite(['resources/js/connect.js'])
@push('js')
<script> 
  var filterParams = {
  comparator: (filterLocalDateAtMidnight, cellValue) => {
    var dateAsString = cellValue;
    if (dateAsString == null) return -1;
    var dateParts = dateAsString.split('/');
    var cellDate = new Date(
      Number(dateParts[2]),
      Number(dateParts[1]) - 1,
      Number(dateParts[0])
    );

    if (filterLocalDateAtMidnight.getTime() === cellDate.getTime()) {
      return 0;
    }

    if (cellDate < filterLocalDateAtMidnight) {
      return -1;
    }

    if (cellDate > filterLocalDateAtMidnight) {
      return 1;
    }
  },
  browserDatePicker: true,
};

const columnDefs = [
  { headerName: 'Số Hóa đơn',field: 'DocNum' },
  {headerName: 'Ngày chứng từ', field: 'DocDate', filter: 'agNumberColumnFilter' },
  {headerName: 'Tổng giá trị', field: 'DocTotal' },
  { headerName: 'đơn vị tiền tệ',field: 'DocCurrency', },
];

const gridOptions = {
  columnDefs: columnDefs,
  pagination: true,
  defaultColDef: {
    flex: 1,
    minWidth: 150,
    filter: true,
    resizable: true,
  },
};
function onBtExport() {
  gridOptions.api.exportDataAsExcel();
}
// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function () { 
  var gridDiv = document.querySelector('#myGrid');
  new agGrid.Grid(gridDiv, gridOptions);
  var jData =  JSON.stringify({UserName: 'manager', Password: '1111', CompanyDB: 'SBODEMOAU'});
      $.ajax({
            // the URL for the request
            url: "https://115.84.182.179:50000/b1s/v1/Login",

            xhrFields: {
                withCredentials: true
            },
            data: jData,
            type: "POST",
            dataType : "json",
            success: function( json ) {
              $.ajax({
                url:"https://115.84.182.179:50000/b1s/v1/Invoices?$select=DocNum,DocDate,DocTotal,DocCurrency&$count=true&$filter=CardCode eq '{{auth()->user()->cardcode}}'&$orderby= DocNum desc",
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
                  gridOptions.api.setRowData(response.value)
                  console.log("hi")
            },
            error: function( xhr, status, errorThrown ) {
              console.log( "Error: " + errorThrown );
              console.log( "Status: " + status );
              console.dir( xhr );
              connected = false;
            },
        });

        },
        error: function( xhr, status, errorThrown ) {
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        }
  
});
});
    </script>
@endpush   



