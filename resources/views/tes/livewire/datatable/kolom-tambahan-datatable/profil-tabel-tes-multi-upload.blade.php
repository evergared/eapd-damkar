<div class="flex items-center justify-center">


    @if(is_null($img))

    <a href="{{asset('storage/img/avatar/placeholder/avatar.jpg')}}" target="_blank">
        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
            src=" {{asset('storage/img/avatar/placeholder/avatar.jpg')}}">
    </a>

    @elseif (count($img)<2) <a href="{{ asset('storage/img/tes' . '/'. $img[0]) }}" target="_blank">
        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
            src="{{asset('storage/img/tes' . '/'. $img[0])}}" />
        </a>

        @elseif(count($img)===2)
        <a href="{{ asset('storage/img/tes' . '/'. $img[0]) }}" target="_blank">
            <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
                src="{{asset('storage/img/tes' . '/'. $img[0])}}" />
        </a>

        <a href="{{ asset('storage/img/tes' . '/'. $img[1]) }}" target="_blank">
            <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                src="{{asset('storage/img/tes' . '/'. $img[1])}}" />
        </a>

        @elseif(count($img)>2) <a href="{{ asset('storage/img/tes' . '/'. $img[0]) }}" target="_blank">
            <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"
                src="{{asset('storage/img/tes' . '/'. $img[0])}}" />
        </a>

        <a href="{{ asset('storage/img/tes' . '/'. $img[1]) }}" target="_blank">
            <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                src="{{asset('storage/img/tes' . '/'. $img[1])}}" />
        </a>

        <a href="{{ asset('storage/img/tes' . '/'. $img[2]) }}" target="_blank">
            <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125"
                src="{{asset('storage/img/tes' . '/'. $img[2])}}" />
        </a>


        @endif
</div>