@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Sections</li>

@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Section Management'])
<div class="row mt-4 mx-4">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header list-header">
                <h4>Section</h4>
                @if(auth()->user()->can('Create Section Data'))
                <button  class="btn btn-primary float-end" data-toggle="modal" data-target="#sectionSelectionModalCenter">Add
                Section</button>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                </th>

                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Create Date</th>
                                    <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Update Date</th>
                                @if(auth()->user()->can('Edit Section Data') || auth()->user()->can('Delete Section Data'))
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{sectionTypeList()[$item->type]['title'] ?? ''}}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                   {{ stringLimit($item->title, 20) }}
                                </td>
                                <td>
                                    <span class="{{commonStatus()[$item->status]['class'] ??''}}"><b>{{commonStatus()[$item->status]['name'] ??''}}</b></span>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                </td>

                                <td class="align-middle text-center text-sm">
                                    {{Carbon\Carbon::parse($item->updated_at)->format('d M, Y')}}
                                </td>
                                @if(auth()->user()->can('Edit Section Data') || auth()->user()->can('Delete Section Data'))
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center">

                                        @if(auth()->user()->can('Edit Section Data'))
                                            <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                            href="{{route('template-section.edit', $item->id)}}">Edit</a>
                                        @endif
                                        @if(auth()->user()->can('Delete Section Data'))
                                        <a href="{{route('template-section.destroy', $item->id)}}"
                                            class="text-sm font-weight-bold mb-0 ps-2 delete-btn btn btn-sm btn-danger ml-2">Delete</a>
                                        @endif
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        {{ $list->links('pagination::bootstrap-4') }}
        </div>
</div>


<!-- Modal -->
<div class="modal fade" id="sectionSelectionModalCenter" tabindex="-1" role="dialog" aria-labelledby="sectionSelectionModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Section List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @foreach(sectionTypeList() as $key => $section)
          <div class="col-md-4"  >

            <div class="card add-section1" data-key="{{$key}}" data-name="{{$section['title']}}">
              <div class="card-body">
                <img src="{{asset('assets/ref'.$key.'.png')}}" alt="" width="100">
                    <a href="{{route('template-section.create')}}?type={{ $key}}">{{$section['title']}}</a>

              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
