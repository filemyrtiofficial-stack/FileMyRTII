<li>
   
   <div>
   <h3>{{$template->section}}</h3>
   </div>
    <div class="answer">
        <div class="row">
        @foreach($data as $item)
    
    <?php
    $field_validation = json_decode($item->field_data, true);
    $field_data = getTypeDetails($item->field_key);
    print_r(json_encode(    $field_data));
    ?>
    <div>
    </div>
    <br><br>

    <div class="col-12">
        <div class="form-group">
            <label for=""><strong>{{$item->field_lable}}</strong></label>
            <div class="input-group">
               
            </div>
          
        </div>
        @if(isset($field_validation['section_list']))
            @foreach($field_validation['section_list'] as $section_id)
                <?php
                    $template = App\Models\TemplateSection::get($section_id);
                    $data = App\Models\TemplateSectionField::list(false,['template_section_id' =>  $section_id]);
                ?>
                @include('backend.template.pages.section.fields', ['template' => $template, 'data' => $data])
            @endforeach
        @endif
    </div>


    @endforeach
        </div>
    </div>
</li>