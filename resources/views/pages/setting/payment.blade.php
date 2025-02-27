@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Payment Settings</li>

@endsection
@section('content')
<form action="{{route('settings.store')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="payment">
    <div class="d-flex  mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Payment Settings</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5 table-repsonsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Basic</th>
                                        <th>Advance</th>
                                    </tr>
                                </thead>
                                <tbody id="payment-list">
                                    @if(isset($data['amount_type']))
                                        @foreach($data['amount_type'] as $key =>  $value)
                                            <tr>
                                                <td>
                                                <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_{{$key}}" value="{{$data['amount_type'][$key] ?? ''}}"></span>
                                                </td>
                                                <td>
                                                    <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="{{$data['amount'][$key] ?? 0}}" id="amount_{{$key}}" max="1000"></span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <select type="text" name="basic[]" class="form-control update-amount basic-input" id="basic_{{$key}}">
                                                            @foreach(BooleanList() as $basic_key => $value)
                                                                <option value="{{$basic_key}}" @if(isset($data['basic'][$key]) && $data['basic'][$key] == $basic_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                     
                                                        <select type="text" name="advance[]" class="form-control update-amount advance-input" id="advance_{{$key}}">
                                                            @foreach(BooleanList() as $advance_key => $value)
                                                                <option value="{{$advance_key}}" @if(isset($data['advance'][$key]) && $data['advance'][$key] == $advance_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove" @if(count($data['amount_type']) == 0) style="display:none;" @endif><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                            <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_0"></span>
                                            </td>
                                            <td>
                                                <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" id="amount_0" max="1000"></span>
                                            </td>
                                            <td>
                                                <span>
                                                    <select type="text" name="basic[]" class="form-control update-amount basic-input" id="basic_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <select type="text" name="advance[]" class="form-control update-amount advance-input" id="advance_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove" style="display:none;"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th>
                                            <input type="text" readonly id="basic_total" name="basic_total" class="form-control" value="{{$data['basic_total'] ?? 0}}">
                                        </th>
                                        <th>
                                            <input type="text" readonly id="advance_total" name="advance_total" class="form-control" value="{{$data['advance_total'] ?? 0}}">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button class="btn btn-sm btn-secondary add-more" type="button">Add More</button>
    
                    </div>
                </div>
            </div>
            <div class="mt-5 float-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

<form action="{{route('settings.store.firstappealpayment')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="first_appeal_payment">
    <div class="d-flex  mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>First Appeal Payment Settings</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5 table-repsonsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <!-- <th>Basic</th> -->
                                        <th>Advance</th>
                                    </tr>
                                </thead>
                                <tbody id="first-appeal-list">
                                    @if(isset($first_appeal_payment['amount_type']))
                                        @foreach($first_appeal_payment['amount_type'] as $key =>  $value)
                                            <tr>
                                                <td>
                                                <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_{{$key}}" value="{{$first_appeal_payment['amount_type'][$key] ?? ''}}"></span>
                                                </td>
                                                <td>
                                                    <span><input type="number" name="amount[]" class="form-control first-appeal-update-amount amount-input" value="{{$first_appeal_payment['amount'][$key] ?? 0}}" id="amount_{{$key}}" max="1000"></span>
                                                </td>
                                                <!-- <td>
                                                    <span>
                                                        <select type="text" name="basic[]" class="form-control first-appeal-update-amount basic-input" id="basic_{{$key}}">
                                                            @foreach(BooleanList() as $basic_key => $value)
                                                                <option value="{{$basic_key}}" @if(isset($first_appeal_payment['basic'][$key]) && $first_appeal_payment['basic'][$key] == $basic_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td> -->
                                                <td>
                                                    <span>
                                                     
                                                        <select type="text" name="advance[]" class="form-control first-appeal-update-amount advance-input" id="advance_{{$key}}">
                                                            @foreach(BooleanList() as $advance_key => $value)
                                                                <option value="{{$advance_key}}" @if(isset($first_appeal_payment['advance'][$key]) && $first_appeal_payment['advance'][$key] == $advance_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove" @if(count($first_appeal_payment['amount_type']) == 0) style="display:none;" @endif><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                            <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_0"></span>
                                            </td>
                                            <td>
                                                <span><input type="number" name="amount[]" class="form-control first-appeal-update-amount amount-input" value="0" id="amount_0" max="1000"></span>
                                            </td>
                                            <!-- <td>
                                                <span>
                                                    <select type="text" name="basic[]" class="form-control first-appeal-update-amount basic-input" id="basic_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td> -->
                                            <td>
                                                <span>
                                                    <select type="text" name="advance[]" class="form-control first-appeal-update-amount advance-input" id="advance_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger first-remove" style="display:none;"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                        <!-- <th>
                                            <input type="text" readonly id="first_basic_total" name="basic_total" class="form-control" value="{{$first_appeal_payment['basic_total'] ?? 0}}">
                                        </th> -->
                                        <th>
                                            <input type="text" readonly id="first_advance_total" name="advance_total" class="form-control" value="{{$first_appeal_payment['advance_total'] ?? 0}}">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button class="btn btn-sm btn-secondary first-add-more" type="button">Add More</button>
    
                    </div>
                </div>
            </div>
            <div class="mt-5 float-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

<form action="{{route('settings.store.firstappealpayment')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="second_appeal_payment">
    <div class="d-flex  mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Second Appeal Payment Settings</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5 table-repsonsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <!-- <th>Basic</th> -->
                                        <th>Advance</th>
                                    </tr>
                                </thead>
                                <tbody id="second-appeal-list">
                                    @if(isset($second_appeal_payment['amount_type']))
                                        @foreach($second_appeal_payment['amount_type'] as $key =>  $value)
                                            <tr>
                                                <td>
                                                <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_{{$key}}" value="{{$second_appeal_payment['amount_type'][$key] ?? ''}}"></span>
                                                </td>
                                                <td>
                                                    <span><input type="number" name="amount[]" class="form-control second-appeal-update-amount amount-input" value="{{$second_appeal_payment['amount'][$key] ?? 0}}" id="amount_{{$key}}" max="1000"></span>
                                                </td>
                                                <!-- <td>
                                                    <span>
                                                        <select type="text" name="basic[]" class="form-control second-appeal-update-amount basic-input" id="basic_{{$key}}">
                                                            @foreach(BooleanList() as $basic_key => $value)
                                                                <option value="{{$basic_key}}" @if(isset($second_appeal_payment['basic'][$key]) && $second_appeal_payment['basic'][$key] == $basic_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td> -->
                                                <td>
                                                    <span>
                                                     
                                                        <select type="text" name="advance[]" class="form-control second-appeal-update-amount advance-input" id="advance_{{$key}}">
                                                            @foreach(BooleanList() as $advance_key => $value)
                                                                <option value="{{$advance_key}}" @if(isset($second_appeal_payment['advance'][$key]) && $data['advance'][$key] == $advance_key) selected @endif>{{$value['name'] ?? ''}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger second-remove" @if(count($second_appeal_payment['amount_type']) == 0) style="display:none;" @endif><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                            <span> <input type="text" name="amount_type[]" class="form-control type-input" id="amount_type_0"></span>
                                            </td>
                                            <td>
                                                <span><input type="number" name="amount[]" class="form-control second-appeal-update-amount amount-input" value="0" id="amount_0" max="1000"></span>
                                            </td>
                                            <!-- <td>
                                                <span>
                                                    <select type="text" name="basic[]" class="form-control second-appeal-update-amount basic-input" id="basic_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td> -->
                                            <td>
                                                <span>
                                                    <select type="text" name="advance[]" class="form-control second-appeal-update-amount advance-input" id="advance_0">
                                                        @foreach(BooleanList() as $key => $value)
                                                            <option value="{{$key}}">{{$value['name'] ?? ''}}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger second-remove" style="display:none;"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2"></th>
                                        <!-- <th>
                                            <input type="text" readonly id="second_basic_total" name="basic_total" class="form-control" value="{{$second_appeal_payment['basic_total'] ?? 0}}">
                                        </th> -->
                                        <th>
                                            <input type="text" readonly id="second_advance_total" name="advance_total" class="form-control" value="{{$second_appeal_payment['advance_total'] ?? 0}}">
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <button class="btn btn-sm btn-secondary second-add-more" type="button">Add More</button>
    
                    </div>
                </div>
            </div>
            <div class="mt-5 float-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
        $('#payment-list').append(`<tr>
                                        <td>
                                            <span><input type="text" name="amount_type[]" class="form-control type-input"></span>
                                        </td>
                                        <td>
                                            <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" max="1000"></span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="basic[]" class="form-control update-amount basic-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="advance[]" class="form-control update-amount advance-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                         <td>
                                            <button type="button" class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`);
        if($('#payment-list').find('tr').length > 1) {
            $('.remove').show();
        }
        calculate();


    });
    $(document).on('click', '.remove', function(e){
        $(this).parents().eq(1).remove();
        if($('#payment-list').find('tr').length <= 1) {
            $('#payment-list').find('.remove').hide();
        }

        if($('#first-appeal-list').find('tr').length <= 1) {
            $('#first-appeal-list').find('.remove').hide();
        }
        if($('#second-appeal-list').find('tr').length <= 1) {
            $('#second-appeal-list').find('.remove').hide();
        }
        calculate();
        second_appeal_calculate();
        first_appeal_calculate();

    });
    $(document).on('change', '.update-amount', function(){
        calculate();
        second_appeal_calculate();
        first_appeal_calculate();

    });
    $(document).on('change', '.amount-input', function(){
        let max = $(this).attr('max');
        if(parseFloat($(this).val()) > parseFloat(max)) {
            $(this).val(max)
        }
        else if(parseFloat($(this).val())  < 0) {
            $(this).val(0)

        }
    })
    function calculate() {
        var basic = 0;
        var advance = 0;
        let index = 0;
        $('#payment-list tr').each(function() {
            $(this).find('.amount-input').attr('id', 'amount_'+index);
            $(this).find('.basic-input').attr('id', 'basic_'+index);
            $(this).find('.advance-input').attr('id', 'advance_'+index);
            $(this).find('.type-input').attr('id', 'amount_type_'+index);

            let amount = $(this).find('.amount-input').val();
            let basic_input = $(this).find('.basic-input').val();
            let advance_input = $(this).find('.advance-input').val();
            amount = parseFloat(amount);
            if(basic_input == 'yes') {
                basic =parseFloat(basic) + amount;
            }
            if(advance_input == 'yes') {
                advance =parseFloat(advance) + amount;
            }
            index = index+1;
        })

        
        $('#basic_total').val(basic);
        $('#advance_total').val(advance);
    }

    //-----------------------------------------------Start first appeal-------------------------//
    $(document).on('click', '.first-add-more', function(e){
        $('#first-appeal-list').append(`<tr>
                                        <td>
                                            <span><input type="text" name="amount_type[]" class="form-control type-input"></span>
                                        </td>
                                        <td>
                                            <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" max="1000"></span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="basic[]" class="form-control update-amount basic-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="advance[]" class="form-control update-amount advance-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                         <td>
                                            <button type="button" class="btn btn-sm btn-danger first-remove"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`);
        if($('#first-appeal-list').find('tr').length > 1) {
            $('.first-remove').show();
        }
        first_appeal_calculate();


    });
    $(document).on('click', '.first-remove', function(e){
        $(this).parents().eq(1).remove();
        if($('#first-appeal-list').find('tr').length <= 1) {
            $('.first-remove').hide();
        }
        first_appeal_calculate();

    });
    $(document).on('change', '.first-appeal-update-amount', function(){
        first_appeal_calculate();

    });
    function first_appeal_calculate() {
        var basic = 0;
        var advance = 0;
        let index = 0;
        $('#first-appeal-list tr').each(function() {
            $(this).find('.amount-input').attr('id', 'amount_'+index);
            $(this).find('.basic-input').attr('id', 'basic_'+index);
            $(this).find('.advance-input').attr('id', 'advance_'+index);
            $(this).find('.type-input').attr('id', 'amount_type_'+index);

            let amount = $(this).find('.amount-input').val();
            let basic_input = $(this).find('.basic-input').val();
            let advance_input = $(this).find('.advance-input').val();
            amount = parseFloat(amount);
            if(basic_input == 'yes') {
                basic =parseFloat(basic) + amount;
            }
            if(advance_input == 'yes') {
                advance =parseFloat(advance) + amount;
            }
            index = index+1;
        })

        
        $('#first_basic_total').val(basic);
        $('#first_advance_total').val(advance);
    }
      //-----------------------------------------------end first appeal-------------------------//

        //-----------------------------------------------Start Second appeal-------------------------//

        $(document).on('click', '.second-add-more', function(e){
        $('#second-appeal-list').append(`<tr>
                                        <td>
                                            <span><input type="text" name="amount_type[]" class="form-control type-input"></span>
                                        </td>
                                        <td>
                                            <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" max="1000"></span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="basic[]" class="form-control update-amount basic-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                <select type="text" name="advance[]" class="form-control update-amount advance-input">
                                                <?=booleanListOptions()?>
                                                </select>
                                            </span>
                                        </td>
                                         <td>
                                            <button type="button" class="btn btn-sm btn-danger second-remove"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`);
        if($('#second-appeal-list').find('tr').length > 1) {
            $('.second-remove').show();
        }
        second_appeal_calculate();


    });
    $(document).on('click', '.second-remove', function(e){
        $(this).parents().eq(1).remove();
        if($('#second-appeal-list').find('tr').length <= 1) {
            $('.second-remove').hide();
        }
        second_appeal_calculate();

    });
    $(document).on('change', '.second-appeal-update-amount', function(){
        second_appeal_calculate();

    });
    function second_appeal_calculate() {
        var basic = 0;
        var advance = 0;
        let index = 0;
        $('#second-appeal-list tr').each(function() {
            $(this).find('.amount-input').attr('id', 'amount_'+index);
            $(this).find('.basic-input').attr('id', 'basic_'+index);
            $(this).find('.advance-input').attr('id', 'advance_'+index);
            $(this).find('.type-input').attr('id', 'amount_type_'+index);

            let amount = $(this).find('.amount-input').val();
            let basic_input = $(this).find('.basic-input').val();
            let advance_input = $(this).find('.advance-input').val();
            amount = parseFloat(amount);
            if(basic_input == 'yes') {
                basic =parseFloat(basic) + amount;
            }
            if(advance_input == 'yes') {
                advance =parseFloat(advance) + amount;
            }
            index = index+1;
        })

        
        $('#second_basic_total').val(basic);
        $('#second_advance_total').val(advance);
    }
      //-----------------------------------------------end Second appeal-------------------------//
</script>
@endpush
