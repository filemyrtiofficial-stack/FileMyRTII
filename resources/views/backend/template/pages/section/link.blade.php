<li class="{{$template['key']}}-section" data-key="">
    <h3>Hero Banner</h3>
    <div class="answer">
        <!-- <div class="card">
            <div class="card-body"> -->
                <div class="row">
                    <div class="col-12">
                        @foreach($template['fields'] as $field)
                            <div class="form-group">
                                <label class="form-label">{{$field['lable'] ??''}}</label>
                                <div class="input-group">
                                    @if($field['type'] == 'input')
                                    <input type="text" class="form-control" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}-0">
                                    @if($field['type'] == 'link')
                                        <div class="row">
                                            
                                            <div class="col-6">
                                                <input type="text" >
                                            </div>
                                        </div>
                                    @elseif($field['type'] == 'image')
                                    <input type="file" class=" upload-image" id="{{$template['key']}}_{{$field['name']}}_id-0">
                                    <div class="image-collection" style="display:none">
                                        <input hidden type="text" class="form-control image-input" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}-0">
                                        <img src="" class="img-preview" id="{{$template['key']}}_{{$field['name']}}-0" width="100" height="100">
                                        <input type="text" id="{{$template['key']}}_{{$field['name']}}_alt-0" name="{{$template['key']}}_{{$field['name']}}_alt-0" class="form-control">
                                    </div>
                                    @elseif($field['type'] == 'textarea')
                                    <textarea class="form-control" name="{{$template['key']}}_{{$field['name']}}" data-lable="{{$template['key']}}_{{$field['name']}}" id="{{$template['key']}}_{{$field['name']}}-0"></textarea>
                                    @elseif($field['type'] == 'section')
                                        @include('backend.template.pages.section.'.$field['key'],['template' => $field, 'prefix_key' => $template['key']])
                                    @endif
                                </div>
                            </div>
                        
                        @endforeach
                    </div>
                </div>
            <!-- </div>
        </div> -->
    </div>
</li>