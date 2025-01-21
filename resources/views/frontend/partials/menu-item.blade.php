<div class="mega_menu_wrapper">
    <div class="container">
        <ul class="mega_menu">
            @foreach($submenu as $item)
            <li class="has-dropdown"><a class="fs-28" href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}</a>
                <ul>
                @foreach($item['children'] ?? '' as $item)
                    <li class="fs-20"><a href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}</a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
           
        </ul>
    </div>
</div>