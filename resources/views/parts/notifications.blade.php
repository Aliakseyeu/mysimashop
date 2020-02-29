@if(!empty($news) && $news->count() > 0)
    <section class="notifications">
        <div class="container">
            <div class="row">
                <ul>
                    @foreach($news as $new)
                        <li>{{ $new->text }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endif