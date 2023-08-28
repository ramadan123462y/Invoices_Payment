@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@section('title')
    تقرير الطلبات -
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الطلبات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الطلبات
            </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')


<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">



            <div class="card-body">
                <div class="table-responsive">
                    <x-error-validation></x-error-validation>
                    <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                        <thead>
                            <tr>

                                <th class="border-bottom-0">رقم الطلب </th>
                                <th class="border-bottom-0">تاريخ الطلب</th>
                                <th class="border-bottom-0">الهاتف </th>
                                <th class="border-bottom-0">وسيله الدفع </th>
                                <th class="border-bottom-0">حاله الطلب</th>
                                <th class="border-bottom-0">تفاصيل الطلب</th>


                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if (!empty($order->phone))
                                            {{ $order->phone }}
                                        @else
                                            <span class="text-danger">{{ 'غير موجود' }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->payment_type }}</td>

                                    <td>
                                        <span class="text-success">{{ 'مدفوعه~' }}</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success" data-mdb-toggle="modal"
                                            data-mdb-target="#exampleModal{{ $order->id }}"> <span
                                                class="text-warning">{{ 'التفاصيل' }}</span></button>


                                    </td>
                                </tr>
                                {{-- model --}}
                                <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom-0">
                                            <button type="button" class="btn-close"
                                                data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start text-black p-4" id="myDiv">
                                            <h5 class="modal-title text-uppercase mb-5"
                                                id="exampleModalLabel">
                                                Johnatan
                                                Miller</h5>
                                            <h4 class="mb-5" style="color: #35558a;">Thanks for your order
                                            </h4>
                                            <p class="mb-0" style="color: #35558a;">Payment summary</p>
                                            <hr class="mt-2 mb-4"
                                                style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                            @foreach ($order->order_details as $orderback)
                                                <div class="d-flex justify-content-between">
                                                    <p class="fw-bold mb-0">
                                                        {{ $orderback->product->Product_name }}(Qty:{{ $orderback->mount }})
                                                    </p>
                                                    <p class="small mb-0"> ££ {{ $orderback->total }}</p>
                                                </div>
                                            @endforeach





                                            <div class="d-flex justify-content-between">
                                                <p class="fw-bold">Total</p>
                                                <p class="fw-bold" style="color: #35558a;">
                                                    ££{{ $order->order_details->sum('total') }}</p>
                                            </div>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center border-top-0 py-4"
                                            id="printButtonSection">
                                            <button type="button" class="btn btn-primary btn-lg mb-1"
                                                style="background-color: #35558a;"
                                                onclick="PrintElem('myDiv')">
                                                Print order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function PrintElem(elemId) {
                                    var element = document.getElementById(elemId);
                                    var printButtonSection = document.getElementById("printButtonSection");
                                    printButtonSection.style.display = "none"; // إخفاء العنصر الذي يحتوي على الزرار
                                    window.print();
                                    printButtonSection.style.display = "block"; // إعادة عرض العنصر بعد الطباعة
                                }
                            </script>
                                {{-- -----end model --}}
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal Select2.min js -->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
<!-- Ionicons js -->
<script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
<!--Internal  pickerjs js -->
<script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>



<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
@endsection
