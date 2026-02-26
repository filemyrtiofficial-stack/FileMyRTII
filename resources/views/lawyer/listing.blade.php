 @foreach($list as $item)
<tr>
        <td><a href="{{route('lawyer.my-rti', $item->application_no.'-'.$item->id)}}"> <div class="date_month_table"> <span class="date_table"> {{Carbon\Carbon::parse($item->created_at)->format('d')}} </span> <span class="month_table"> {{Carbon\Carbon::parse($item->created_at)->format('M y')}} </span> </div> </a> </td>
        <td><a href="{{route('lawyer.my-rti', $item->application_no.'-'.$item->id)}}"> {{$item->application_no}} </a></td>
        <td><a href="{{route('lawyer.my-rti', $item->application_no.'-'.$item->id)}}"> <div class="strong_data">{{$item->fullName}}</div></a> </td>
        <td><a href="{{route('lawyer.my-rti', $item->application_no.'-'.$item->id)}}">{{$item->appeal_no == 0 ? "Initial Appeal" : ($item->appeal_no == 1 ? "First Appeal" : "Second Appeal")}}</a></td>
        <td><a href="{{route('lawyer.my-rti', $item->application_no.'-'.$item->id)}}"><div class="status_btn"> {{lawyerApplicationStatus()[$item->status]['name'] ?? ''}} <span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83928 23.6492C6.32516 24.1169 7.11186 24.1169 7.5965 23.6492L17.8721 13.7329C18.8426 12.7964 18.8426 11.277 17.8721 10.3404L7.52209 0.350952C7.04119 -0.111943 6.26429 -0.117941 5.77717 0.338959C5.27886 0.805452 5.27409 1.57414 5.76369 2.04783L15.2365 11.1882C15.7224 11.6571 15.7224 12.4162 15.2365 12.8851L5.83928 21.9535C5.3534 22.4212 5.3534 23.1815 5.83928 23.6492Z" fill="#0384D4"/>
            </svg> </span></a> </div>
        </td>
</tr>
@endforeach
