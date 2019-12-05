<nav class="nav flex-column text-left scrollbar" style="max-height: 500px;overflow-y: auto; width: 100%; overflow-x: hidden;">
    @if($count)
        @foreach($result as $key => $items)
            <div class="position-relative">
                    <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                @foreach($items as $value)
                    @if(auth()->user()->role=='admin')
                        <div class="nav-link products px-2 close-search" data-toggle="modal" data-target="#EditTaskAdmin-{{$value->id}}">
                    @else
                        <div class="nav-link products px-2 close-search" data-toggle="modal" data-target="#EditTask-{{$value->id}}">
                    @endif
                    <div class="row border-bottom pb-1 mx-2" style="cursor: pointer;">
                        <div class="col-7 border-right">
                            {{str_limit($value->title,15)  }}
                        </div>
                        <div class="col-8">
                            {{str_limit($value->description,15) }}
                        </div>
                    </div>
                     </div>
                @endforeach
                    </div>
            </div>
         @endforeach
    @else
        <p class="text-center m-0 py-4">Нет результата</p>
    @endif
</nav>
