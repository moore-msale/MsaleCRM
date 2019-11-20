@if(count(\App\History::where('customer_id', $customer->taskable->id)->get()) != 0)
    @foreach(\App\History::where('customer_id', $customer->taskable->id)->get() as $history)
        <div class="pt-2 pb-3">
            <div class="d-flex justify-content-between">
                <div class="sf-light" style="color:#772FD2;">
                    {{\Carbon\Carbon::parse($history->date)->format('d.m.Y - H:i')}}
                </div>
                <div class="sf-light" style="color:rgba(0,0,0,0.4);">
                    {{\App\User::find($history->user_id)->name}}
                </div>
            </div>
            <div class="w-100 p-2 sf-light" style="background: rgba(196,196,196,0.22)">
                {{$history->description}}
            </div>
            <div>
                <img src="{{ asset('images/arrow.svg') }}" alt=""><span class="ml-3 sf-light">{{$history->status}}</span>
            </div>
        </div>
    @endforeach
@else
    <div class="pt-2 pb-3">
        <div class="d-flex justify-content-center align-items-center" style="height:300px;">
            <p class="sf-light">
                У данного клиента нету истории.
            </p>
        </div>
    </div>
@endif
