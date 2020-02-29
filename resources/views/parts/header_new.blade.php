<header class="">
    <div class="header__top">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center header__top_main">
                @include('parts/logo')

                <div class="account">
                    <div class="account__user">@guest Гость @else {{ ($user = Auth::user())->surname . ' ' . $user->name }} @endguest</div>
                    <div class="account__menu">
                        @include('parts/menu')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__bottom">
        <div class="container">
            <div class="row">
                @include('parts/titles/'.$title)
            </div>
        </div>
    </div>
</header>