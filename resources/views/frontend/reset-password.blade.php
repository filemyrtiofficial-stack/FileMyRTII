@extends('frontend.layout.layout')

@section('content')




<form action="{{route('customer.update-password')}}" class="authentication" method="post">
    <input type="hidden" name="key" value="{{encryptString($customer->id)}}">
@csrf
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <label for="">Confirm Password</label>
        <input type="password" name="confirm_password">
    </div>
    <button>Update</button>
</form>
      

     




@endsection
@push('js')

@endpush