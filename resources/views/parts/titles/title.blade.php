<div class="title">

    <div class="title__main">
        {{ $main }}
    </div>

    <div class="title__additional">
        {{ $additional }}
    </div>

    @if(!empty($buttons) && count($buttons) > 0)

        <div class="title__buttons">

            @foreach($buttons as $button)

                <a href="{{ $button['link'] }}" class="btn btn-lg btn-{{ $button['class'] }}">
                    <i class="fas fa-{{ $button['icon'] }}"></i>
                    <span class="responsive-hide">{{ $button['text'] }}</span>
                </a>

            @endforeach

        </div>
        
    @endif

</div>