<nav class="nav flex-column text-left scrollbar" id="search-result-ajax" style="max-height: 500px;overflow-y: auto; width: 350px; overflow-x: hidden;">

    @if($count)
        @foreach($result as $key => $items)
            <div class="position-relative">

                <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                    @foreach($items as $value)
                        <a class="nav-link products px-4" href="{{ route('book.show', $value->id) }}">
                <span class="d-flex align-items-center border-bottom pb-2">
                    <span class="col">
                        {{ $value->name }}
                    </span>
                </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

        {{--@if(count($result->collapse()) > 10)--}}
            {{--<button class="btn btn-primary position-absolute" style="bottom: 0; left: 0; width: 100%;">Показать все</button>--}}
        {{--@endif--}}

    @else

        <p class="text-center m-0 py-4">Нет результата</p>

    @endif

</nav>
