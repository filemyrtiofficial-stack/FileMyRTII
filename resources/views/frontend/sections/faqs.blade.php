<section class="faq_section">
            <div class="container">
                <div class="section_heading">
                    <h2>{{$data['title'] ?? ''}}</h2>
                </div>
                <div class="faq_wrapper">
                @if(isset($data['question']))
                    @foreach($data['question'] as $key =>  $value)
                        <div class="single_faq">
                            <div class="faq_title @if($key == 0) active @endif">
                                <h4>{{$value}}</h4>
                            </div>
                            <div class="faq_content">
                                {!! $data['answer'][$key] ?? '' !!}
                            </div>
                        </div>
                        @endforeach
                        @endif
                   
                </div>
            </div>
        </section>