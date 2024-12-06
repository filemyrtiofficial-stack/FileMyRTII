@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-10 mt-lg-0 mt-4">
        <div class="card mt-4">
         
            <div class="card-body pt-0">
								
				<div class="row">
					<div class="col-md-4">
						<div class="panel mt-5">
							<div class="panel-body">
								<h4 class="mb-20">{{ __('Menu List') }}</h4>
								<div class="row">
									<div class="col-lg-12">
										<div class="alert alert-danger none">
											<ul id="errors"></ul>
										</div>	
										<form id="frmEdit" class="form-horizontal">
											<div class="custom-form">
												<div class="form-group">
													<label for="text">{{ __('Text') }}</label>
													<!--<div class="input-group">-->
														<input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text" autocomplete="off">
														<!--<div class="input-group-append">
															<button type="button" id="myEditor_icon" class="btn btn-primary btn-sm"></button>
														</div>
													</div>-->
													<input type="hidden" name="icon" class="item-menu">
												</div>
												<div class="form-group">
													<label for="href">{{ __('URL') }}</label>
													<input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL" required autocomplete="off">
												</div>
												<div class="form-group">
													<label for="target">{{ __('Target') }}</label>
													<select name="target" id="target" class="custom-select mr-sm-2 item-menu form-control">
														<option value="_self">{{ __('Self') }}</option>
														<option value="_blank">{{ __('Blank') }}</option>
														{{-- <option value="_top">{{ __('Top') }}</option> --}}
													</select>
												</div>
												<div class="form-group">
													<label for="type">{{ __('Type') }}</label>
													<select type="text" name="type" id="type" class="custom-select mr-sm-2 item-menu form-control"  onchange="showDiv(this)">                                    
														<option value="blank">Text</option>
													<option value="image">Image </option>
													<option value="hidden">Hidden </option>

													
													</select>
												</div>
											
												
											</div>
										</form>
										<div class="menu-add-update d-flex">
											<button type="button" id="btnUpdate" class="btn btn-update  btn-warning text-white col-6 mr-2" disabled><i class="fas fa-sync-alt"></i> {{ __('Update') }}</button>
											<button type="button" id="btnAdd" class="btn btn-success col-6 "><i class="fas fa-plus"></i> {{ __('Add') }}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8  mt-5">
						<div class="panel mb-3">
							<div class="panel-body">
								<div class="row mb-10">
									<div class="col-sm-9">
										<h4>{{ __('Menu structure') }}</h4>
									</div>
									<div class="col-sm-3">

										
											<form id="basicform" class="f-right" method="post" action="{{ route('menu.MenuNodeStore') }}"> 
												@csrf
												<input type="hidden" name="data" id="data">
												<input type="hidden" name="menu_id" value="{{ $info->id }}"> 
												<button id="form-button" class="btn btn-primary" type="submit">{{ __('Save Changes') }}</button>
												</form>
										
									</div>
								</div>
								<ul id="myEditor" class="sortableLists list-group">
								</ul>	
								
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" value="{{ $info->data }}" id="arrayjson">
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script  src="{{ asset('assets/js/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js') }}"></script>
<script  src="{{ asset('assets/js/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
<script  src="{{ asset('assets/js/menu/jquery-menu-editor.min.js') }}"></script>
<script  src="{{ asset('assets/js/menu/form.js') }}"></script>
<script  src="{{ asset('assets/js/menu/menu.js') }}"></script>

@endpush