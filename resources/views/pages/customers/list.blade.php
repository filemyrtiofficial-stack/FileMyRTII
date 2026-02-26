@foreach($list as $item)
    <tr>
        <td>
            <input type="checkbox" name="ids[]" value="{{$item->id}}" class="item-checkbox">
        </td>
        <td>

            <div class="d-flex px-3 py-1">

                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ stringLimit($item->fullName, 20) }}</h6>
                </div>
            </div>
        </td>
        <td class="align-middle text-sm">{{$item->phone_no?? ''}}</td>
        <td class="align-middle text-sm">{{$item->email?? ''}}</td>
        <td>{{count($item->rtiApplications)}}</td>

        <td class="align-middle text-center text-sm">
            {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
        </td>
        <td class="align-middle text-end">
            <div class="d-flex px-3 py-1 justify-content-center align-items-center">

                <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                    href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal_{{$item->id}}">Edit</a>

            </div>
            
        </td>
        
    </tr>
@endforeach