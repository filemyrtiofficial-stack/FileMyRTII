<p>
    Query :  {{$query->message}}
</p>
<p>
    Reply :  {{$query->reply}}
</p>
    @if($query->documents)
<div class="modal_area v_scroll">


    @foreach($query->documents ?? [] as $key => $value)
        <div class="relative">
            <embed src="{{$value}}" width="200" height="200" />
            <div class="preview-btn">
            <a href="{{filePreview($value)}}" target="blank"> Preview
                                        </a>
                                        </div>
            
        </div>
    @endforeach
  
</div>
  @endif