@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Menu Setting</li>
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Menu Management'])

<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Menu</h4>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">

					<div class="row" id="category_body">
						<div class="col-lg-4">
							<div class="card">
								<div class="card-body">
									<div class="alert alert-danger none">
										<ul id="errors">
										</ul>
									</div>
									<div class="alert alert-success none">
										<ul id="success">
										</ul>
									</div>
									<form class="form-submit" method="post" action="{{ route('menu-setting.store') }}">
										@csrf
										<div class="custom-form">
											<div class="form-group">
												<label for="name">{{ __('Menu Name') }}</label>
												<input type="text" name="name" class="form-control" id="name" placeholder="Menu Name">
											</div>
											<div class="form-group">
												<label for="position">{{ __('Menu Position') }}</label>
												<select class="custom-select mr-sm-2 form-control" id="position" name="position">
													@if(!empty($positions))

													@foreach($positions as $key=>$row)
													<option value="{{ $key }}">{{ $row }}</option>
													@endforeach
													@else
													<option value="header">{{ __('Header') }}</option>
													<option value="footer">{{ __('Footer') }}</option>
													@endif
												</select>
											</div>

											<div class="form-group">
												<label for="position">{{ __('Menu Status') }}</label>
												<select class="custom-select mr-sm-2 form-control" id="status" name="status">
													<option value="1">{{ __('Active') }}</option>
													<option value="0" selected="">{{ __('Draft') }}</option>
												</select>
											</div>
											<div class="form-group mt-20">
												<button class="btn btn-primary col-12" type="submit">{{ __('Add New Menu') }}</button>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div>

						<div class="col-lg-8" >
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<!-- <div class="card-action-filter">
											<form id="basicform1" method="post" action="">
												@csrf
												<div class="card-filter-content d-flex">
													<div class="single-filter">
														<div class="form-group">
															<select class="form-control" name="method">
																<option >{{ __('Select Actions') }}</option>
																<option value="delete">{{ __('Delete Permanently') }}</option>
															</select>
														</div>
													</div>
													<div class="single-filter mt-1 ml-1">
														<button type="submit" class="btn btn-primary">{{ __('Apply') }}</button>
													</div>
												</div>
											</div> -->
											<div id="menuArea">
												<table class="table text-center category">
													<thead>
														<tr>
															<th class="am-select">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input checkAll" id="checkAll">
																	<label class="custom-control-label" for="checkAll"></label>
																</div>
															</th>
															<th class="am-title">{{ __('Title') }}</th>
															<th class="am-title">{{ __('Postion') }}</th>
															<th class="am-title">{{ __('Status') }}</th>
															<th class="am-title">{{ __('Customize') }}</th>
															<th class="am-title">{{ __('Action') }}</th>

														</tr>
													</thead>
													<tbody>
														@foreach($menus as $menu)
														<td>

															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="ids[]" class="custom-control-input" id="customCheck{{ $menu->id }}" value="{{ $menu->id }}">
																<label class="custom-control-label" for="customCheck{{ $menu->id }}"></label>
															</div>
														</td>
														<td>{{ $menu->name }} </td>
														<td>{{ $menu->position }}</td>
														<td>@if($menu->status==1) <p class="badge badge-success">{{ __('Active Menu') }}</p> @else <p class="badge badge-danger">{{ __('Draft Menu') }}</p> @endif</td>
														<td><a href="{{ route('menu-setting.show',$menu->id) }}"><i class="fas fa-arrows-alt"></i> {{ __('Customize') }}</a></td>
														<td>
                                                            <a href="{{route('menu-setting.destroy', $menu->id)}}"
                                                                class=" delete-btn text-danger"><i class="fa fa-trash"></i></a>
                                                            <a  class="text-success" href="{{ route('menu-setting.edit',$menu->id) }}" ><i class="far fa-edit"></i></a>
                                                        </td>
													</tr>
													@endforeach
												</tbody>
											</form>

										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



                </div>
            </div>
        </div>
    </div>

</div>

@endsection
