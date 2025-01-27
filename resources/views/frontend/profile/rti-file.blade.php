<div>
 <style>
    /* body {
        height: 842px;
        width: 595px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
    } */
    .signature {
        position: absolute;
    right: 0px;
    }
    .title {
        text-align:center;
    }
    /* .text-span {
        display:none;
    } */
</style>

<form action="{{route('lawyer.send-for-approval', $data->application_no)}}" class="draft-form authentication">
    @csrf
<input type="hidden" name="template_id" value="{{$data->service->templates[0]['id'] ?? ''}}">

    <table>
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="first_name" class="change-value" value="{{$data->first_name}}">
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="last_name" class="change-value" value="{{$data->last_name}}">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="text" name="email" class="change-value" value="{{$data->email}}">
                </td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>
                    <input type="text" name="phone_number" class="change-value" value="{{$data->phone_number}}">
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" class="change-value" value="{{$data->address}}">
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td>
                    <input type="text" name="city" class="change-value" value="{{$data->city ?? ''}}">
                </td>
            </tr>
            <tr>
                <td>State</td>
                <td>
                    <input type="text" name="state" class="change-value" value="{{$data->state ?? ''}}">
                </td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td>
                    <input type="text" name="pincode" class="change-value" value="{{$data->pincode ?? ''}}">
                </td>
            </tr>

          

            @foreach($service_fields['field_type'] ?? '' as $key => $value)
            @php
                $field_key =  Illuminate\Support\Str::slug($service_fields['field_lable'][$key]);
                $label_key = str_replace('-', '_',$field_key);
            @endphp
                <tr>
                    <td>{{$service_fields['field_lable'][$key] ?? ''}}</td>
                    <th><input type="text" name="{{$label_key }}" value="{{$revision_data[$label_key ] ?? ( $fields[$field_key]['value'] ?? '')}}"> </th>


                </tr>
            @endforeach
            
        </tbody>
    </table>
    <button class="send-for-approval">Send For Approval</button>
</form>

<div class="draft-rti-html">


</div>    


</div>
   

