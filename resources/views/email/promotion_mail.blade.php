@extends('email.layout')
    @section('content')

{!! $data['html'] ?? ''!!}
@endsection
