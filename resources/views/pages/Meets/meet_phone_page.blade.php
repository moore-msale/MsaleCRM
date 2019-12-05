@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Встречи
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateMeetAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить встречу
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateMeet"  style="text-decoration: underline;font-size:14px;">
                    добавить встречу
                </a>
            @endif
        </div>
    </div>
    <div >
        <div class="blog-scroll" id="meetings-scroll">
            @include('tasks.list', ['meetings3' => $tasks])
        </div>
    </div>
@endsection
@push('scripts')
  <script>
         $(document).on("click", '.editMeetAdmin',function( event ) {
             event.preventDefault();
             let btn = $(event.currentTarget);
             let id = btn.data('id');
             let user = btn.data('parent');
             let title = $('#meet_name-' + id);
             let desc = $('#meet_desc-' + id);
             let date = $('#meet_date-' + id);
             let manage = $('#meet_manager-' + id);
             let status = $('#meet_status-' + id);
             if(desc.val().length < 20)
             {
                 Swal.fire({
                     position: 'top-end',
                     icon: 'info',
                     title: 'Заполните описание, описание должно быть больше 20 символов!',
                     showConfirmButton: true,
                     // timer: 700
                 });
             }
             else {
                 $.ajax({
                     url: 'EditMeetAdmin',
                     method: 'POST',
                     data: {
                         "_token": "{{ csrf_token() }}",
                         "title": title.val(),
                         "desc": desc.val(),
                         "date": date.val(),
                         "manage": manage.val(),
                         "status": status.val(),
                         "id": id,
                     },
                     success: data => {
                         if(data.status == "success"){
                             Swal.fire({
                                 position: 'top-end',
                                 icon: 'success',
                                 title: 'Данные изменены!',
                                 showConfirmButton: false,
                                 timer: 700
                             });
                             console.log(data);
                             $('#meet-' + id).find('.meet-name').html(data.meet.title);
                             $('#meet-' + id).find('.meet-company').html(data.customer.company);
                             $('#meet-' + id).find('.meet-manager').html(data.user);
                             $('#meet-' + id).find('.meet-desc').html(data.meet.description);
                             $('#meet-' + id).find('.meet-date1').html(data.date1);
                             $('#meet-' + id).find('.meet-date2').html(data.date2);
                             $('#EditMeet-' + id).find('.modal-title').html(data.meet.title);

                             if(data.status_id){
                                 $('#meet-' + id).find('.status-meet').css("background-color",data.status_id.color);
                                 $('#meet-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                             }else{
                                 $('#meet-' + id).find('.status-meet').css("background-color",'#C4C4C4');
                                 $('#meet-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
                             }
                         } else{
                             Swal.fire({
                                 position: 'top-end',
                                 icon: 'info',
                                 title: 'Изменение не найдены!',
                                 showConfirmButton: false,
                                 timer: 700
                             });
                             console.log(data);
                         }
                     },
                     error: () => {
                         console.log(0);
                         Swal.fire({
                             position: 'top-end',
                             icon: 'error',
                             title: 'Что-то пошло не так!',
                             showConfirmButton: false,
                             timer: 700
                         });
                     }
                 })
             }
         })
     </script>
 <script>
    $(document).on("click", '.deleteMeet',function( event ) {
        event.preventDefault();
        let btn = $(event.currentTarget);
        let id = btn.data('id');
        let user = btn.data('parent');
        console.log(id);
            $.ajax({
                url: 'DeleteTaskAdmin',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Встреча удалена!',
                        showConfirmButton: false,
                        timer: 700
                    });
                    $('#meet-' + id).hide();
                    $('#DeleteMeetAdmin-' + id).modal('hide');
                    console.log(data);
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })
    })
 </script>
 <script>
     $(document).on("click", '.editMeet',function( event ) {
         event.preventDefault();
         let btn = $(event.currentTarget);
         let id = btn.data('id');
         let user = btn.data('parent');
         let title = $('#meet_name-' + id);
         let desc = $('#meet_desc-' + id);
         let date = $('#meet_date-' + id);
         let status = $('#meet_status-' + id);
         if(desc.val().length < 20)
         {
             Swal.fire({
                 position: 'top-end',
                 icon: 'info',
                 title: 'Заполните описание, описание должно быть больше 20 символов!',
                 showConfirmButton: true,
                 // timer: 700
             });
         }
         else {
             $.ajax({
                 url: 'meeting/'+id,
                 method: 'PUT',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "title": title.val(),
                     "desc": desc.val(),
                     "date": date.val(),
                     "status": status.val(),
                     "id": id,
                 },
                 success: data => {
                     if(data.status == "success"){
                         Swal.fire({
                             position: 'top-end',
                             icon: 'success',
                             title: 'Данные изменены!',
                             showConfirmButton: false,
                             timer: 700
                         });
                         console.log(data);
                         $('#meet-' + id).find('.meet-name').html(data.meet.title);
                         $('#meet-' + id).find('.meet-deadline').html(data.deadline_date);
                         $('#meet-' + id).find('.meet-manager').html(data.user);
                         $('#EditMeet-' + id).find('.modal-title').html(data.meet.title);
                         if (data.meet.description.length > 25)
                             $('#meet-' + id).find('.meet-desc').html(data.meet.description.substring(0,25) + '...');
                         else
                             $('#meet-' + id).find('.meet-desc').html(data.meet.description);
                         if(data.status_id){
                             $('#meet-' + id).find('.status-meet').css("background-color",data.status_id.color);
                             $('#meet-' + id).find('.change-color').attr('fill',data.status_id.color).css("color",data.status_id.color);
                         }else{
                             $('#meet-' + id).find('.status-meet').css("background-color",'#C4C4C4');
                             $('#meet-' + id).find('.change-color').attr('fill','#C4C4C4').css("color",'#C4C4C4');
                         }
                     } else{
                         Swal.fire({
                             position: 'top-end',
                             icon: 'info',
                             title: 'Изменение не найдены!',
                             showConfirmButton: false,
                             timer: 700
                         });
                         console.log(data);
                     }
                 },
                 error: () => {
                     console.log(0);
                     Swal.fire({
                         position: 'top-end',
                         icon: 'error',
                         title: 'Что-то пошло не так!',
                         showConfirmButton: false,
                         timer: 700
                     });
                 }
             })
         }
     })
 </script>
@endpush
