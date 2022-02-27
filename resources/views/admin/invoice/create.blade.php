@extends('layouts.app')
@section('page_title')
Add Invoice
    
@endsection

@section('page_title_extra')
<div class="d-flex justify-content-between">
    <h1 class="m-0"><span></span></h1>
    <a href="{{ url('admin/invoice') }}" class="btn btn-md btn-blue">Back to Invoice List</a>
</div>
@endsection

@section('content')
    <div class="container-fluid wrapper">

        @if (session('success'))
            <div class="alert alert-success  alert-dismissible  fade show" role="alert">
                <span style="color: darkblue"> {{ session('success') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span style="color: red" aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('invoice.store') }}" class="needs-validation" novalidate method="POST">
            @csrf


            <div class="card">
                <div class="card-body">
                    <div class="form-row flex-nowrap">
                        <div class="form-group col-md-6">
                            <label for="customer_name">Select Customer</label><br>
                            <select id="customer_name" class="custom-select" name="customer_id" required>
                                <option value="">Select Customer</option>
                                @forelse ($all_customers as $all)
                                    <option value="{{ $all->id }}">{{ $all->user->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if ($errors->has('customer_id'))
                                <div style="color:red;font-weight: bold">{{ $errors->first('customer_id') }}</div>
                            @endif
                        </div>

                        .<div class="form-group col-md-6">
                            <label for="invoice_no">Invoice Number</label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">INV-</span>
                                </div>
                                <input type="text" class="form-control" name="invoice_no" readonly
                                    value="{{ $newId }}">
                            </div>
                        </div>

                    </div>



                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="invoice_date">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                value="{{ $due_date }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="invoice_type">Invoice Type</label><br>
                            <select id="invoice_type" class="custom-select invoice-type" name="invoice_type" required>
                                <option value="">Select Invoice Type</option>
                                <option value="regular">Regular</option>
                                <option value="recurring">Recurring</option>
                            </select>
                            @if ($errors->has('invoice_type'))
                                <div style="color:red;font-weight: bold">{{ $errors->first('invoice_type') }}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 recurring-block" style="display: none;">
                            <label for="recurring "></label>
                            <input type="number" step="1" min="1" required name="recurring" id="recurring" class="form-control recurring "
                                style="margin-top: 7px" placeholder="type(in days)">
                                @if ($errors->has('recurring'))
                                      <div style="color: red; font-weight:bold">{{ $errors->first('recurring') }}</div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="country">Select Item</label><br>
                            <select class="custom-select get-item" id="invoice_item" name="invoice_item">
                                <option value="">Select Item</option>
                                @foreach ($Item as $items)
                                    <option value="{{ $items }}">{{ $items->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="table-responsive ">
                                <table class="table " id="invoice-table" style="width:100%">
                                    <thead class=" bg-primary">
                                        <tr>
                                            <th class="text-white">Item Name</th>
                                            <th class="text-white">Quantity</th>
                                            <th class="text-white">Price</th>
                                            <th class="text-white">tax (%)</th>
                                            <th class="text-white">DisCount (%)</th>
                                            <th class="text-white">Total</th>
                                            <th class="text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="invoice-item-tbody py-2">


                                        <tr class="text-right">
                                            <td colspan="5"><strong>SubTotal </strong></td>
                                            <td><input type="text" readonly class="form-control subTotal" value="0"></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5"><strong>Total Tax</strong></td>
                                            <td><input type="text" readonly class="form-control subTax" value="0"></td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5"><strong>Total Discount</strong></td>
                                            <td><input type="text" readonly class="form-control total-discount" value="0">
                                            </td>
                                        </tr>
                                        <tr class="text-right">
                                            <td colspan="5"><strong>GrandTotal (Only)</strong></td>
                                            <td><input type="text" readonly class="form-control Total" name="grandTotal"
                                                    value="0"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-block btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script>
        $(document).ready(function() {

            $("#recurring").on('keyup change', function() {
           var floatValue = parseFloat($(this).val());
           var intValue = parseInt($(this).val());
            if (intValue == 0 || $(this).val() == "") {
                toastr.warning("Recurring days must be 1 or greater !", "Oops !");
                // $(this).val(1)
                return false;
            }

           if (floatValue - intValue != 0) {
               toastr.warning("Recurring days must be integer !", "Oops !");
               $(this).val(intValue)
           }
        });



            $('.invoice-type').on('change', function() {
                var selected = $(this).val();
                if (selected == 'recurring') {
                    $('.recurring-block').show();
                    $('.recurring').val('').attr('disabled', false);
                } else {
                    $('.recurring-block').hide();
                    $('.recurring').val('').attr('disabled', true);
                }
            });

            var items = [];

            $('.get-item').on('change', function() {

                var data = JSON.parse($(this).val());
                var duplicate = false;
                if (items.length > 0) {
                    items.forEach(function(value) {
                        if (value == data.id) {
                            $("#quantity-" + value).val(parseFloat($("#quantity-" + data.id)
                            .val()) + 1);
                            $("#quantity-" + value).trigger('keyup');
                            var qty = $("#quantity-" + data.id).val();
                            var price = $("#price-" + data.id).val();
                            var tax = $("#tax-" + data.id).val();
                            var amount = qty * price;
                            var taxDecimal = amount * tax / 100;
                            $("#taxCount-" + data.id).val(taxDecimal);
                            updateSubTax();
                            duplicate = true
                        } else {
                            items.push(data.id);
                        }
                    });
                } else {
                    //if items array is empty
                    items.push(data.id);
                }
                // make items array unique
                items = items.filter((element, index) => {
                    return items.indexOf(element) === index;
                });

                if (!duplicate) {
                    if (data.tax.rules) {
                        var tax = data.tax.rules;
                    } else {
                        tax = 0;
                    }

                    // console.log(items)
                    var html = '<tr>' +
                        '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<input type="text" readonly class="form-control" name="item_name[]"   value="' +
                        data.name + '">' +
                        '<input type="hidden"  name="item_id[]"   value="' + data.id + '">' +
                        '</td>' +
                        '<td style="padding-left:0 !important" class="col-md-1">' +
                        '<input type="number" id="quantity-' + data.id +
                        '" class="form-control qty-custom" name="qty[]"  value="1">' +
                        '</td>' +
                        '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text">TK-</span>' +
                        '</div>' +
                        '<input type="number" id="price-' + data.id +
                        '"  class="form-control price-custom"  name="rate[]"  value="' + data.rate + '">' +

                        '</div>' +
                        '</td>' +

                        '<td style="padding-left:0 !important" class="col-md-1">' +
                        '<input type="number" id="tax-' + data.id +
                        '"   class="form-control tax-custom" name="tax[]"   value="' + tax + '">' +
                        '<input type="hidden" readonly  id="taxCount-' + data.id +
                        '"  class="form-control tax-default"    value="0">' +
                        '</td>' +

                        '<td style="padding-left:0 !important" class="col-md-1">' +
                        '<input type="number"  class="form-control discount" name="discount[]"  value="0">' +
                        '<input type="hidden" readonly  id="disCount-' + data.id +
                        '" class="form-control discount-default"  value="0">' +
                        '</td>' +
                        '<td style="padding-left:0 !important" class="col-md-2">' +
                        '<div class="input-group">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text">Tk</span>' +
                        '</div>' +
                        '<input type="text" readonly class="form-control total-custom net-amount" name="amount[]"  value="0">' +
                        '</div>' +
                        '</td>' +
                        '<td style="padding-left:0 !important" class="col-md-1">' +
                        '<button type="button" class="btn btn-danger btn-md remove-item" data-id="' + data
                        .id + '" id="close-tr"><i class="fa fa-window-close"></i></button>' +
                        '</td>' +
                        '</tr>';

                    $('.invoice-item-tbody ').prepend(html);
                    $("#quantity-" + data.id).trigger('keyup');
                    updateSubTotal();
                    updateGrandTotal();
                    updateDisTotal();


                    var qty = $("#quantity-" + data.id).val();
                    var price = $("#price-" + data.id).val();
                    var tax = $("#tax-" + data.id).val();
                    var amount = qty * price;
                    var taxDecimal = amount * tax / 100;
                    $("#taxCount-" + data.id).val(taxDecimal);

                    updateSubTax();
                }
            });


            //remove selected item
            $(document).on('click', '#close-tr', function() {
                $(this).closest('tr').remove();
                var id = $(this).data('id')
                items = items.filter(function(value) {
                    return value != id;
                });

                updateSubTotal();
                updateSubTax();
                updateDisTotal();
                updateGrandTotal();
            });


            //calculation
            $(document).on('keyup change', '.qty-custom', function() {

                var thisAttr = $(this);
                if (parseFloat(thisAttr.val()) < 0) {
                    thisAttr.val(0)
                }

                var qty = $(this).val();
                var rate = $(this).closest('tr').find('.price-custom').val();
                var tax = $(this).closest('tr').find('.tax-custom').val();
                var discount = $(this).closest('tr').find('.discount').val();

                var total = qty * rate;
                var taxDecimal = total * tax / 100;
                var discountDecimal = total * discount / 100;


                $(this).closest('tr').find('.discount-default').val(discountDecimal);

                $(this).closest('tr').find('.tax-default').val(taxDecimal);
                $(this).closest('tr').find('.total-custom').val(total);

                updateSubTotal();
                updateGrandTotal();
                updateDisTotal();
                updateSubTax();

            });

            $(document).on('keyup change', '.price-custom', function() {

                var thisAttr = $(this);
                if (parseFloat(thisAttr.val()) < 0) {
                    thisAttr.val(0)
                }

                var rate = $(this).val();
                var qty = $(this).closest('tr').find('.qty-custom').val();
                var tax = $(this).closest('tr').find('.tax-custom').val();
                var discount = $(this).closest('tr').find('.discount').val();

                var total = qty * rate;
                var tax_amount = total * tax / 100;
                var discountDecimal = total * discount / 100;

                $(this).closest('tr').find('.total-custom').val(total);
                $(this).closest('tr').find('.tax-default').val(tax_amount);
                $(this).closest('tr').find('.discount-default').val(discountDecimal);



                updateSubTotal();
                updateGrandTotal();
                updateDisTotal();
                updateSubTax();
            });

            $(document).on('keyup change', '.tax-custom', function() {
                var thisAttr = $(this);
                if (parseFloat(thisAttr.val()) < 0) {
                    thisAttr.val(0)
                }


                var tax_default = 0;
                var tax = $(this).val();
                var qty = $(this).closest('tr').find('.qty-custom').val();
                var rate = $(this).closest('tr').find('.price-custom').val();
                var total = qty * rate;
                var tax_amount = total * tax / 100;

                tax_default += tax_amount;
                $(this).closest('tr').find('.tax-default').val(tax_default);

                updateSubTax();
                updateGrandTotal();

            });

            function updateSubTax() {

                var amount = 0.00
                $('.tax-default').each(function() {
                    var currentElement = $(this);
                    var value = parseFloat(currentElement.val());
                    amount += value
                });

                $(".subTax").val(amount)
            }

            $(document).on('keyup change', '.discount', function() {

                var thisAttr = $(this);

                if (parseFloat(thisAttr.val()) < 0 || thisAttr.val() == '') {
                    thisAttr.val(0)
                }
                var discount = $(this).val();
                var qty = $(this).closest('tr').find('.qty-custom').val();
                var rate = $(this).closest('tr').find('.price-custom').val();
                var tax = $(this).closest('tr').find('.tax-custom').val();
                var total = qty * rate;
                var discountDecimal = total * (discount / 100);


                $(this).closest('tr').find('.discount-default').val(discountDecimal);
                updateDisTotal();
                updateGrandTotal();
            })
        });

        function updateSubTotal() {
            var amount = 0.00
            $('.net-amount').each(function() {
                var currentElement = $(this);
                var value = parseFloat(currentElement.val());
                amount += value
            });

            $(".subTotal").val(amount)
        }



        function updateDisTotal() {
            var amount = 0.00;
            $('.discount-default').each(function() {

                var currentElement = $(this);
                var value = parseFloat(currentElement.val());
                amount += value;
            });
            $(".total-discount").val(amount)
        }

        function updateGrandTotal() {
            var subTotal = $('.subTotal').val();
            var subTax = $('.subTax').val();
            var subDiscount = $('.total-discount').val();
            var grossTotal = (parseFloat(subTotal) + parseFloat(subTax)) - parseFloat(subDiscount);
            $('.Total').val(grossTotal);
        }
    </script>

@endsection
