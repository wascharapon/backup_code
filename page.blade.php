@extends('layouts.test_menu')
@section('content')
@php
function DateThai($strDate)
{
   $strYear = date("Y",strtotime($strDate))+543;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("d",strtotime($strDate));
   $strHour= date("H",strtotime($strDate));
   $strMinute= date("i",strtotime($strDate));
   $strSeconds= date("s",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   return "$strDay $strMonthThai $strYear , $strHour:$strMinute";
}
@endphp

  <script>
    /* Formatting function for row details - modify as you need */
    function format(d) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>email:</td>' +
            '<td>' + d.email + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td> created_at:</td>' +
            '<td>' + d.created_at + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td> updated_at:</td>' +
            '<td>' + d.updated_at + '</td>' +
            '</tr>' +
            '</table>';
    }
    $(document).ready(function() {
        //select data
        $('#block_click').hide();
        //datatable
        var table = $('#example').DataTable({
        
            "ajax": {
                "url": 'http://192.168.0.60:7777/ssksystem/test_data',
                "cache": false,
                "error": function(e) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'ไม่สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                "beforeSend": function(e) {
                    $('#block_click').show();
                    setTimeout(function() {
                        $('#block_click').hide();
                    }, 2000);
                },
            },
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
            ],
            "mark":true,
            "colReorder":true,
            "lengthMenu":[[25,50,100,500,-1],[25,50,100,500]],
            "language": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดงหน้า _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "sInfoEmpty": "แสดงหน้า 0 ถึง 0 จาก 0 รายการ",
            "sInfoFiltered": "( กรองข้อมูล _MAX_ ทุกรายการ )",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ รายการ",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา : ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            },
        },
        "button":[],
        "initComplete":function(){
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        },
            "order": [
                [1, 'asc']
            ]
        });
        $('#example tfoot th').each( function () {
         var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
    function search_date() {
        date_begin = $('#date_begin').val();
        date_end = $('#date_end').val();
        if (date_begin == '' || date_end == '') {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาเลือกวันที่ให้ครบถ้วน',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            window.location.href = 'data/' + date_begin + '/' + date_end;
        }
    }
</script>
<div id="block_click" class="bg-primary w-100" style="opacity:0.5;height:100%;position: absolute;z-index: 1">&nbsp;</div>
<div class="content-wrapper text-xs">
  <section class="content-header">
  <div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>ผู้ใช้งานระบบ</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
        <li class="breadcrumb-item active">ผู้ใช้งานระบบ</li>
      </ol>
    </div>
  </div>
  </div><!-- /.container-fluid -->
  </section>
  
  <section class="content">
  <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
          <strong class="show_bt">
            <!-- ช่องเลือกวันที่ -->
                <div class="d-flex flex-column bd-highlight  mt-2 bt-2 text-center">
        <div class="p-2 bd-highlight">
            <div class="container">
                <div class="row">
                    <div class="col-sm ">
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa fa-calendar "></i></span>
                                    <input type="date" id="date_begin" class="form-control" name="date_begin" value="{{ date("Y-m-d") }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa fa-calendar  "></i></span>
                                    <input type="date" id="date_end" class="form-control" name="date_end" value="{{ date("Y-m-d") }}">
                                </div>
                            </div>
                            <div class="col-4">
                            <button type="button" onclick="search_date()" class="btn btn-primary btn-sm w-100">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- ช่องเลือกวันที่ -->
          </strong>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <table id="example" class="table table-hover table-bordered display" style="width:100%">
          <thead>
              <tr>
                  <th>&nbsp;&nbsp;</th>
                  <th>ID</th>
                  <th>Name</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                <th>&nbsp;&nbsp;</th>
                <th>ID</th>
                <th>Name</th>
              </tr>
          </tfoot>
      </table>
      </div>
      <!-- /.card-body -->
    </div>

  </div>
  <!-- /.row -->
 
  </section>
</div>
@endsection
@section('js')
  <script src="{{ asset('public/js/member.js') }}" defer></script>
@endsection

