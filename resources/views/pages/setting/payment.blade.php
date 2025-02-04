@extends('layouts.app')

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
                                                    <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="{{$data['amount'][$key] ?? 0}}" id="amount_{{$key}}"></span>
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
                                                <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" id="amount_0"></span>
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

<form action="{{route('settings.store')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="payment">
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
                                                    <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="{{$data['amount'][$key] ?? 0}}" id="amount_{{$key}}"></span>
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
                                                <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0" id="amount_0"></span>
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
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
        $('#payment-list').append(`<tr>
                                        <td>
                                            <span><input type="text" name="amount_type[]" class="form-control type-input"></span>
                                        </td>
                                        <td>
                                            <span><input type="number" name="amount[]" class="form-control update-amount amount-input" value="0"></span>
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
            $('.remove').hide();
        }
        calculate();

    });
    $(document).on('change', '.update-amount', function(){
        calculate();

    });
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
</script>
@endpush
