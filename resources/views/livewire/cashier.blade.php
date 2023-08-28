<div>


    <div class="row">

        <div class="col-6 col-md-4">
            <div class="card card-statistics h-100">
                <div class="card-body">


                    <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Reciept</p>

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
                    {{-- foeeach --}}
                    <div class="row">
                        <div class="col mb-3">

                            <p>10 April 2021</p>
                        </div>

                        <div class="col mb-3">

                            <p>10 April 2021</p>
                        </div>
                        <div class="col mb-3">

                            <p>10 April 2021</p>
                        </div>
                        <div class="col mb-3">

                            <p>012j1gvs356c</p>
                        </div>
                    </div>
                    {{-- end  --}}
                    <div class="row">
                        <div class="col mb-3">
                            <p class="lead fw-bold mb-0" style="color: #f37a27;">£262.99</p>
                        </div>

                    </div>
                    <button type="button" class="btn btn-outline-success" data-mdb-toggle="modal"
                        data-mdb-target="#exampleModal">Print Invoice Order</button>






                </div>
                {{-- model --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start text-black p-4">
                                <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">Johnatan Miller</h5>
                                <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                                <p class="mb-0" style="color: #35558a;">Payment summary</p>
                                <hr class="mt-2 mb-4"
                                    style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">

                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold mb-0">Ether Chair(Qty:1)</p>
                                    <p class="text-muted mb-0">$1750.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="small mb-0">Shipping</p>
                                    <p class="small mb-0">$175.00</p>
                                </div>


                                <div class="d-flex justify-content-between pb-1">
                                    <p class="small">Tax</p>
                                    <p class="small">$200.00</p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold" style="color: #35558a;">$2125.00</p>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                                <button type="button" class="btn btn-primary btn-lg mb-1"
                                    style="background-color: #35558a;">
                                    Track your order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- model --}}
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <!--begin::Repeater-->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    {{-- <form method="POST"> --}}
                    {{-- @csrf --}}
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
                                                    <select name="sections[]" wire:model="sections"
                                                        class="form-control form-control-sm">
                                                        <option disabled selected>
                                                            اختر قسم</option>
                                                        @foreach (\App\Models\Section::all() as $section)
                                                            <option value="{{ $section->id }}">
                                                                {{ $section->section_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label>المنتج</label>
                                                    <select name="products[]" class="form-control form-control-sm">

                                                        <option disabled selected>
                                                            اختر منتج</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label>الكمية</label>
                                                    <input class="form-control form-control-sm" name="mounts[]"
                                                        wire:model="mounts" type="number" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-1">
                                                <div class="form-group">
                                                    @foreach ($prices as $price)
                                                    <p class="small text-muted mb-1">   {{ $price }}</p>

                                                @endforeach
                                                    <label>الخصم</label>
                                                    <input class="form-control form-control-sm" name="discounts[]"
                                                        wire:model="discounts" type="number" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label>السعر</label>

                                                    <input class="form-control form-control-sm" value="0"
                                                        wire:model="prices" name="prices[]"
                                                        type="number" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-2">
                                                <div class="form-group">
                                                    <label>الاجمالي</label>
                                                    <input class="form-control form-control-sm" name="totals[]"
                                                        wire:model="totals" type="number" placeholder="">
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
                    {{-- </form> --}}
                    {{-- </div> --}}
                </div>


            </div>
