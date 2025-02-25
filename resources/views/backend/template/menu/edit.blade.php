@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('menu-setting.index')}}">Menu Setting</a></li>

<li class="breadcrumb-item active" aria-current="page">Edit</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-8 mt-lg-0 mt-4">
		<div class="card">
			<div class="card-body">
				<h4 class="mb-20">{{ __('Edit Menu') }}</h4>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger none errorarea">
							<ul id="errors">

							</ul>
						</div>
						<form method="post" class="form-submit" action="{{ route('menu-setting.update',$info->id) }}">
							@csrf
							@method('PUT')
							<div class="custom-form">
								<div class="form-group">
									<label for="name">{{ __('Menu Name') }}</label>
									<input type="text" name="name" class="form-control" id="name" value="{{ $info->name }}">

								</div>
								<div class="form-group">
									<label for="position">{{ __('Menu Position') }}</label>
									<select class="custom-select mr-sm-2 form-control" id="position" name="position">
										@if(!empty($positions))

										@foreach($positions as $key=>$row)
										<option value="{{ $key }}" @if($info->position == $key) selected="" @endif>{{ $row }}</option>
										@endforeach
										@else
										<option value="header" @if($info->position=='header') selected="" @endif>{{ __('Header') }}</option>
										<option value="footer" @if($info->position=='footer') selected="" @endif>{{ __('Footer') }}</option>
										@endif
									</select>
									
								</div>
								
								<div class="form-group">
									<label for="position">{{ __('Menu Status') }}</label>
									<select class="custom-select mr-sm-2 form-control" id="status" name="status">
										<option value="1" @if($info->status==1) selected="" @endif>{{ __('Active') }}</option>
										<option value="0"  @if($info->status==0) selected="" @endif>{{ __('Draft') }}</option>
									</select>
								</div>
								<div class="mt-5 text-right">
							  <button class="btn  btn-primary">{{ __('Update') }}</button>
							  <a class="btn  btn-primary" href="{{ route('menu-setting.index') }}">{{ __('Back') }}</a>
                          </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection