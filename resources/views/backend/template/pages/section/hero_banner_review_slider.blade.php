
<div>
<label class="form-label">{{$template['title'] ??''}}</label><br>
</div>
<div>

    @if($id != null)
        @for($i = 0; $i < $data[$template['key'].'_row_count']; $i++)
        <div class="row ml-5 add-new-section" id="{{$template['key'] }}" data-key="0">
            <div class="col-12 row-item border ==" >
                @foreach($template['fields'] as $key => $field)
                    <?php
                    $title = $prefix_key.'_'.($field['name'] ?? '' );
                    ?>

                    <div class="form-group">
                        <label class="form-label">{{$field['lable'] ??''}}</label>
                        <div class="input-group">
                            @if($field['type'] == 'input')
                            <input type="text" class="form-control" value="{{$data[$title][$i]}}" name="{{$prefix_key}}_{{$field['name']}}[]" value="" data-lable="{{$prefix_key}}_{{$field['name']}}[]">
                            @elseif($field['type'] == 'image')
                            <input type="file" class="upload-image {{$prefix_key}}_{{$field['name']}}" data-key="{{$prefix_key}}_{{$field['name']}}" id="{{$prefix_key}}_{{$field['name']}}_{{$i}}" >
                            <div class="image-collection" style="display:display">
                                <input hidden type="text" class="form-control image-input" value="{{$data[$title][$i]}}" name="{{$prefix_key}}_{{$field['name']}}[]" data-lable="{{$prefix_key}}_{{$field['name']}}" id="{{$prefix_key}}_[{{$field['name']}}]-0">
                                <img src="{{asset($data[$title][$i])}}" class="img-preview"  width="100" height="100">
                                <input type="text" id="{{$prefix_key}}_{{$field['name']}}" value="{{$data[$title.'_alt'][$i] ?? ''}}"  name="{{$prefix_key}}_{{$field['name']}}_alt[]" data-lable="{{$prefix_key}}_{{$field['name']}}" class="form-control">
                            </div>

                            @elseif($field['type'] == 'textarea')
                            <textarea class="form-control" name="{{$prefix_key}}_{{$field['name']}}[]" data-lable="{{$prefix_key}}_{{$field['name']}}[]">{{$data[$title][$i]}}</textarea>
                            @elseif($field['type'] == 'section')
                                @include('backend.template.pages.section.'.$field['key'],['template' => $field])
                            @endif
                        </div>
                    </div>
                
                @endforeach
            </div>
        </div>
        @endfor
        <input type="hidden" name="{{$template['key']}}_row_count" id="{{$template['key']}}_row_count" value="{{$data[$template['key'].'_row_count'] ?? 1}}">
    @else
        <div class="row ml-5 add-new-section" id="{{$template['key']}}" data-key="0">
            <div class="col-12 row-item border ==" >
                @foreach($template['fields'] as $key => $field)
                    <?php
                    $title = $prefix_key.'_'.$template['key'].'_'.($field['name'] ?? '' );
                    ?>

                    <div class="form-group">
                        <label class="form-label">{{$field['lable'] ??''}}</label>
                        <div class="input-group">
                            @if($field['type'] == 'input')
                            <input type="text" class="form-control" name="{{$prefix_key}}_{{$field['name']}}[]" value="" data-lable="{{$prefix_key}}_{{$field['name']}}[]">
                            @elseif($field['type'] == 'image')
                            <input type="file" class=" upload-image {{$prefix_key}}_{{$field['name']}}" data-key="{{$prefix_key}}_{{$field['name']}}" id="{{$prefix_key}}_{{$field['name']}}"  >
                            <div class="image-collection" style="display:none">
                                <input hidden type="text" class="form-control image-input" name="{{$prefix_key}}_{{$field['name']}}[]" data-lable="{{$prefix_key}}_{{$field['name']}}" id="{{$prefix_key}}_[{{$field['name']}}]-0">
                                <img src="" class="img-preview"  width="100" height="100">
                                <input type="text" id="{{$prefix_key}}_{{$field['name']}}" name="{{$prefix_key}}_{{$field['name']}}[]_alt[]" data-lable="{{$prefix_key}}_{{$field['name']}}_alt" class="form-control">
                            </div>

                            @elseif($field['type'] == 'textarea')
                            <textarea class="form-control" name="{{$prefix_key}}_{{$field['name']}}[]" data-lable="{{$prefix_key}}_{{$field['name']}}[]"></textarea>
                            @elseif($field['type'] == 'section')
                                @include('backend.template.pages.section.'.$field['key'],['template' => $field])
                            @endif
                        </div>
                    </div>
                
                @endforeach
            </div>
            <input type="hidden" name="{{$template['key']}}_row_count" id="{{$template['key']}}_row_count" value="1">
        </div>
    @endif
    <button type="button" class="btn btn-primary btn-sm add-module-section" limit="{{$template['repeat']}}" data-target="{{$template['key']}}" data-key="0">Add More</button>
</div>
