@extends('layouts.master')
@section('css')
    <!-- Font Awesome -->



    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .horizontal-timeline .items {
            border-top: 2px solid #ddd;
        }

        .horizontal-timeline .items .items-list {
            position: relative;
            margin-right: 0;
        }

        .horizontal-timeline .items .items-list:before {
            content: "";
            position: absolute;
            height: 8px;
            width: 8px;
            border-radius: 50%;
            background-color: #ddd;
            top: 0;
            margin-top: -5px;
        }

        .horizontal-timeline .items .items-list {
            padding-top: 15px;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />

    {{-- @livewireStyles --}}
@section('title')
    الكاشير
@stop

<!-- Internal Data table css -->


<!--Internal   Notify -->


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الكاشيير </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                الكاشيير</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<div>


    <div class="row">
        <x-error-validation></x-error-validation>
        <div class="col-6 col-md-4">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    {{-- @if (isset($orderbacks))

                        @endif --}}
                    <p class="lead fw-bold mb-5" style="color: #f37a27;"> نوع العميل :نقدي</p>
                    <div class="row">
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Total price</p>

                        </div>

                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Mount</p>

                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Product</p>

                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Order No.</p>

                        </div>

                    </div>

                    @if (isset($orderbacks))
                        @foreach ($orderbacks as $orderback)
                            <div class="row">
                                <div class="col mb-3">

                                    <p>{{ $orderback->total }}</p>
                                </div>

                                <div class="col mb-3">

                                    <p>{{ $orderback->mount }}</p>
                                </div>
                                <div class="col mb-3">

                                    <p>{{ $orderback->product->Product_name }}</p>
                                </div>
                                <div class="col mb-3">

                                    <p>{{ $orderback->id }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- end  --}}
                        <div class="row">
                            <div class="col mb-3">
                                <p class="lead fw-bold mb-0" style="color: #f37a27;">
                                    ££{{ $orderbacks->sum('total') }}
                                </p>
                            </div>

                        </div>
                        {{-- model --}}


                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            {{-- <div class="modal-dialog"> --}}
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start text-black p-4" id="myDiv">

                                        <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">
                                            نوع العميل :نقدي</h5>
                                        <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                                        <p class="mb-0" style="color: #35558a;">Payment summary</p>
                                        <hr class="mt-2 mb-4"
                                            style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                                        @foreach ($orderbacks as $orderback)
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
                                                ££{{ $orderbacks->sum('total') }}</p>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        {!! QrCode::size(200)->generate('https://www.facebook.com/profile.php?id=100007189206926&mibextid=b06tZ0') !!}
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center border-top-0 py-4"
                                        id="printButtonSection">
                                        <button type="button" class="btn btn-primary btn-lg mb-1"
                                            style="background-color: #35558a;" onclick="PrintElem('myDiv')">
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
                        {{-- model --}}
                    @endif

                    <button type="button" class="btn btn-outline-success" data-mdb-toggle="modal"
                        data-mdb-target="#myModal">Print Invoice Order</button>




                </div>

            </div>

        </div>
        <div class="col-md-8">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!--begin::Repeater-->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <form method="POST" action="{{ url('cashier/store_order') }}">
                        @csrf
                        <div class="row targetDiv" id="div0">
                            <div class="col-md-12">
                                <div id="group1" class="fvrduplicate">
                                    <div data-repeater-list="kt_docs_repeater_basic">
                                        <div data-repeater-item>
                                            {{-- --------first --}}
                                            <div class="row entry">
                                                <div class="col-xs-12 col-md-2">
                                                    <div class="form-group">
                                                        <label>القسم</label>
                                                        <select name="sections[]" required
                                                            class="form-control form-control-sm">
                                                            <option disabled selected>
                                                                اختر قسم</option>
                                                            @foreach (\App\Models\Section::all() as $section)
                                                                <option value="{{ $section->id }}">
                                                                    {{ $section->section_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-2">
                                                    <div class="form-group">
                                                        <label>المنتج</label>
                                                        <select name="products[]" required
                                                            class="form-control form-control-sm">


                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-2">
                                                    <div class="form-group">
                                                        <label>الكمية</label>
                                                        <input class="form-control form-control-sm" required
                                                            name="mounts[]" type="number" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-1">
                                                    <div class="form-group">

                                                        <label>الخصم</label>
                                                        <input class="form-control form-control-sm" required
                                                            name="discounts[]" type="number" value="0"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-2">
                                                    <div class="form-group">
                                                        <label>السعر</label>

                                                        <input class="form-control form-control-sm" required
                                                            value="0" name="prices[]" type="number"
                                                            placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-2">
                                                    <div class="form-group">
                                                        <label>الاجمالي</label>
                                                        <input class="form-control form-control-sm" required
                                                            name="totals[]" type="number" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-1">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-success btn-sm btn-add">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end::Repeater-->
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success">make order</button>
                    </form>
                    {{-- </div> --}}
                </div>


            </div>

            {{-- @livewire('cashier') --}}
            {{-- @livewireScripts --}}
            {{-- </div> --}}
            <!-- row closed -->
        @endsection
        @section('js')

            <script>
                $(function() {
                    $(document).on('click', '.btn-add', function(e) {
                        e.preventDefault();
                        var controlForm = $(this).closest('.fvrduplicate'),
                            currentEntry = $(this).parents('.entry:first'),
                            newEntry = $(currentEntry.clone()).appendTo(controlForm);
                        newEntry.find('input').val('');
                        controlForm.find('.entry:not(:last) .btn-add')
                            .removeClass('btn-add').addClass('btn-remove')
                            .removeClass('btn-success').addClass('btn-danger')
                            .html('<i class="fa fa-minus" aria-hidden="true"></i>');
                    }).on('click', '.btn-remove', function(e) {
                        $(this).closest('.entry').remove();
                        return false;
                    });
                });
            </script>

            <script>
                $(document).ready(function() {

                    $(document).on('change', 'select[name="sections[]"]', function() {

                        var selector = $(this).closest('.entry');
                        var section_id = $(this).val();

                        if (section_id) {
                            $.ajax({
                                url: "{{ url('gete_product') }}/" + section_id,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    selector.find('select[name="products[]"]').empty();
                                    selector.find('select[name="products[]"]').append(
                                        '<option disabled selected>' + "  اختر منتج   " +
                                        '</option>');
                                    $.each(data, function(key, value) {
                                        selector.find('select[name="products[]"]').append(
                                            '<option value="' +
                                            value + '">' + key + '</option>');
                                    });
                                },
                                error: function() {
                                    console.log('AJAX request failed');
                                }
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

                $(document).ready(function() {

                    $(document).on('change', 'select[name="sections[]"]', function() {
                        $('input[name="discounts[]"]').val(0);

                        var selector = $(this).closest('.entry');



                    });
                });
            </script>

            <script>
                $(document).ready(function() {

                    $(document).on('change', 'select[name="products[]"]', function() {
                        var selector = $(this).closest('.entry');
                        var product = $(this).val();

                        if (product) {
                            $.ajax({

                                url: "{{ url('get_price') }}/" + product,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    // حذف الخيارات الحالية
                                    selector.find('input[name="prices[]"]').val(data);
                                },
                                error: function() {
                                    console.log('AJAX request failed');
                                }
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });
            </script>
            <script>
                $(document).on('change', 'input[name="mounts[]"]', function() {
                    var $row = $(this).closest('.entry');
                    var mount = $row.find('input[name="mounts[]"]').val();
                    var price = $row.find('input[name="prices[]"]').val();
                    var discount = $row.find('input[name="discounts[]"]').val();

                    var newprice = (price) - (discount);
                    var total = newprice * mount;

                    $row.find('input[name="totals[]"]').val(total);

                    $('input[name="discounts[]"]').on('change', function() {
                        var $row = $(this).closest('.entry');
                        var mount = $row.find('input[name="mounts[]"]').val();
                        var price = $row.find('input[name="prices[]"]').val();
                        var discount = $row.find('input[name="discounts[]"]').val();

                        var newprice = (price) - (discount);
                        var total = newprice * mount;

                        $row.find('input[name="totals[]"]').val(total);
                    });
                    $('input[name="products[]"]').on('change', function() {
                        var $row = $(this).closest('.entry');
                        var mount = $row.find('input[name="mounts[]"]').val();
                        var price = $row.find('input[name="prices[]"]').val();
                        var discount = $row.find('input[name="discounts[]"]').val();

                        var newprice = (price) - (discount);
                        var total = newprice * mount;

                        $row.find('input[name="totals[]"]').val(total);
                    });
                });
            </script>
            <script>
                $(document).on('change', '.entry input[name="prices[]"]', function() {
                    var tr = $(this).closest('.col-xs-12');
                    var quantity = tr.find('input[name="mounts[]"]').val();
                    var price = tr.find('input[name="prices[]"]').val();
                    var discount = tr.find('input[name="discounts[]"]').val();

                    var total = parseFloat(price) * parseFloat(quantity) - parseFloat(discount);
                    tr.find('input[name="totals[]"]').val(total);
                });
            </script>
            <script>
                function PrintElem(elemId) {
                    var element = document.getElementById(elemId);
                    var printButtonSection = document.getElementById("printButtonSection");
                    printButtonSection.style.display = "none"; // إخفاء العنصر الذي يحتوي على الزرار
                    window.print();
                    printButtonSection.style.display = "block"; // إعادة عرض العنصر بعد الطباعة
                }
            </script>
            <!-- MDB -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
        @endsection
