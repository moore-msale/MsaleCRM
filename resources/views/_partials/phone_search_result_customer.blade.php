<nav class="nav flex-column text-left scrollbar" style="max-height: 500px;overflow-y: auto; width: 100%; overflow-x: hidden;">
    @if($count)
    @foreach($result as $key => $items)
        <div class="position-relative">
            <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                @foreach($items as $value)
                    @if($value->task->user_id==auth()->id() or auth()->user()->role=='admin')
                        @if(auth()->user()->role=='admin')
                            <div class="nav-link products px-2 close-search" data-toggle="modal" data-target="#EditCustomerAdmin-{{$value->task->id}}">
                        @else
                            <div class="nav-link products px-2 close-search" data-toggle="modal" data-target="#EditCustomer-{{$value->task->id}}">
                        @endif
                            <div class="row border-bottom pb-1 mx-2" style="cursor: pointer;">
                                <div class="col-7 border-right">
                                    {{str_limit($value->name,15)  }}
                                </div>
                                <div class="col-8">
                                    {{str_limit($value->company,15) }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                        </div>
            </div>
            @endforeach
            @else
                <p class="text-center m-0 py-4">Нет результата</p>
     @endif
</nav>
