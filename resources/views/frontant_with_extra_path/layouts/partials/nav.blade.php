@foreach($menu as $value)
<li class="{{count($value->sub) > 0 ? 'dropdown': ''}} ">
    <a href="{{ route('page.firstlavel', ['firstparam'=> $value->slug]) }}" class="dropdown-toggle">{{$value->name}}</a>
    @if(count($value->sub) > 0)
    <ul class="dropdown-menu">
        @foreach($value->sub as $chield)
        <li class="{{count($chield->sub) > 0 ? 'dropdown':''}} ">
            <a href="{{ route('page.secondlavel', ['firstparam'=>$value->slug,'secondparam'=>$chield->slug])}}"
                class="dropdown-toggle">{{$chield->name}}</a>
            @if(count($chield->sub) > 0)
            <ul class="dropdown-menu">
                @foreach($chield->sub as $subtosun)
                <li><a
                        href="{{route('page.thirdlavel', ['firstparam'=>$value->slug,'secondparam'=>$chield->slug, 'thirdparam'=> $subtosun->slug])}}">{{$subtosun->name}}</a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
</li>
@endforeach