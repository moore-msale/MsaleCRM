@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100" style="padding-top: 2em;">
            <div class="px-2 h-100 pb-2 col-3">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn purple darken-4">
                    <p class="text-white sf-bold mb-0">
                        ПЛАН НА ДЕНЬ
                    </p>
                </div>
                <div class="">

                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
                        <p class="head-text sf-bold mb-3">
                            ВЫПОЛНЕННЫЕ ЗВОНКИ
                        </p>
                        <p class="work-check sf-bold mb-0">
                        <span class="first-child">
                            30/
                        </span>
                            <span class="last-child">
                            80
                        </span>
                        </p>
                    </div>
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
                        <p class="head-text sf-bold mb-3">
                            ВЫПОЛНЕННЫЕ ЗВОНКИ
                        </p>
                        <p class="work-check sf-bold mb-0">
                        <span class="first-child">
                            30/
                        </span>
                            <span class="last-child">
                            80
                        </span>
                        </p>
                    </div>
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
                        <p class="head-text sf-bold mb-3">
                            ВЫПОЛНЕННЫЕ ЗВОНКИ
                        </p>
                        <p class="work-check sf-bold mb-0">
                        <span class="first-child">
                            30/
                        </span>
                            <span class="last-child">
                            80
                        </span>
                        </p>
                    </div>
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
                        <p class="head-text sf-bold mb-3">
                            ВЫПОЛНЕННЫЕ ЗВОНКИ
                        </p>
                        <p class="work-check sf-bold mb-0">
                        <span class="first-child">
                            30/
                        </span>
                            <span class="last-child">
                            80
                        </span>
                        </p>
                    </div>

                </div>
            </div>


            <div class="px-2 h-100 col-3">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn red accent-2">
                    <p class="text-white sf-bold mb-0">
                        ВСЕ ЗАДАЧИ
                    </p>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style="border-left:2px solid #ff5252; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                        Задачи
                    </p>
                    <a class="ml-auto" href="" data-toggle="modal" data-target="#TaskCreate">
                    <i class="fas fa-plus fa-xs ico-done"></i>
                    </a>
                </div>
                <div class="blog-scroll">
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
                         style="text-transform: uppercase;">
                        <div class="position-absolute bg-danger"
                             style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
                        <div style="border-bottom:1px solid #DCDCDC;">
                            <p class="deal-text sf-bold mb-3">
                                Позвонить Сергею с Оптима Банк
                            </p>
                        </div>
                        <div class="toner">
                            <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordionEx1"
                                 role="tablist">
                                <a data-toggle="collapse" href="#collapse1" aria-expanded="false"
                                   aria-controls="collapse1">
                                    <i class="far fa-check-circle fa-sm mr-1 ico-done" title="Завершить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse2" aria-expanded="false"
                                   aria-controls="collapse2">
                                    <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse3" aria-expanded="false"
                                   aria-controls="collapse3">
                                    <i class="far fa-calendar fa-sm mr-1 ico-update" title="Изменить дату"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse4" aria-expanded="false"
                                   aria-controls="collapse4">
                                    <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
                                </a>
                                <i class="fas fa-flag fa-sm mr-1 ico-change" title="Какая-та фигня"></i>
                                <div id="collapse1" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx1" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите детали"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse1" data-toggle="collapse"
                                           class="bg-success px-2 py-1 border-0 confirm-but text-white btn">
                                            Завершить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse2" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx1" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse2" data-toggle="collapse"
                                           class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn">
                                            Удалить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse3" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx1" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input placeholder="Выберите дату" type="text"
                                                   class="form-control date">
                                        </div>
                                        <a href="#collapse3" data-toggle="collapse"
                                           class="bg-info px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse4" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx1" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input type="text" id="name"
                                                   class="form-control sf-light textarea-font-size"
                                                   value="СРОЧНО ПОЗВОНИТЬ СЕРГЕЮ ИЗ ОПТИМА БАНКА!!! АЙДАЙ ТЫ ЧЕ ?????!?!?!">
                                        </div>
                                        <a href="#collapse4" data-toggle="collapse"
                                           class="bg-warning px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                            </div>
                            <div>
                                <p class="sf-light textarea-font-size mt-2 mb-0 content-text">
                                    СРОЧНО ПОЗВОНИТЬ СЕРГЕЮ ИЗ ОПТИМА БАНКА!!! АЙДАЙ ТЫ ЧЕ ?????!?!?!
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>





            {{--Третий блок--}}



            <div class="px-2 h-100 col-3">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn indigo accent-3">
                    <p class="text-white sf-bold mb-0">
                        ВСЕ ЗВОНКИ
                    </p>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style="border-left:2px solid #3d5afe; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                        Звонки
                    </p>
                    <i class="fas fa-plus ml-auto fa-xs ico-done"></i>
                </div>
                <div class="blog-scroll">
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
                         style="text-transform: uppercase;">
                        <div class="position-absolute bg-danger"
                             style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
                        <div style="border-bottom:1px solid #DCDCDC;">
                            <p class="deal-text sf-bold mb-2">
                                <i class="far fa-building"></i><span class="pl-1"> ОАО 'Кыргыз Алтын'</span>
                            </p>
                            <p class="deal-text sf-bold mb-3">
                                <i class="fas fa-phone"></i></i><span class="pl-1"> 0700 00 00 00</span>
                            </p>
                        </div>
                        <div class="toner">
                            <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordionEx5"
                                 role="tablist">
                                <a data-toggle="collapse" href="#collapse17" aria-expanded="false"
                                   aria-controls="collapse17">
                                    <i class="far fa-check-circle fa-sm mr-1 ico-done" title="Завершить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse18" aria-expanded="false"
                                   aria-controls="collapse18">
                                    <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse19" aria-expanded="false"
                                   aria-controls="collapse19">
                                    <i class="far fa-calendar fa-sm mr-1 ico-update" title="Изменить дату"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse20" aria-expanded="false"
                                   aria-controls="collapse20">
                                    <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
                                </a>
                                <i class="fas fa-flag fa-sm mr-1 ico-change" title="Какая-та фигня"></i>
                                <div id="collapse17" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx5" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите детали"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse17" data-toggle="collapse"
                                           class="bg-success px-2 py-1 border-0 confirm-but text-white btn">
                                            Завершить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse18" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx5" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse18" data-toggle="collapse"
                                           class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn">
                                            Удалить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse19" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx5" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input placeholder="Выберите дату" type="text"
                                                   class="date form-control">
                                        </div>
                                        <a href="#collapse19" data-toggle="collapse"
                                           class="bg-info px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse20" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx5" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input type="text" id="name"
                                                   class="form-control sf-light textarea-font-size"
                                                   value="ОАО 'Кыргыз Алтын'">
                                        </div>
                                        <div class="md-form">
                                            <input type="text" id="phone"
                                                   class="form-control sf-light textarea-font-size"
                                                   value="0700 00 00 00">
                                        </div>
                                        <a href="#collapse20" data-toggle="collapse"
                                           class="bg-warning px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{--Четвертый блок--}}

            <div class="px-2 h-100 col-3">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn yellow darken-1">
                    <p class="text-white sf-bold mb-0">
                        ВСЕ ВСТРЕЧИ
                    </p>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style="border-left:2px solid #fdd835; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                        ВСТРЕЧИ
                    </p>
                    <i class="fas fa-plus ml-auto fa-xs ico-done"></i>
                </div>
                <div class="blog-scroll">
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
                         style="text-transform: uppercase;">
                        <div class="position-absolute bg-danger"
                             style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
                        <div style="border-bottom:1px solid #DCDCDC;">
                            <p class="deal-text sf-bold mb-2">
                                <i class="far fa-building"></i><span class="pl-1"> ОАО 'Кыргыз Алтын'</span>
                            </p>
                            <p class="deal-text sf-bold mb-3">
                                <i class="fas fa-clock"></i></i><span class="pl-1"> 2.09.2019 15:00</span>
                            </p>
                        </div>
                        <div class="toner">
                            <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordionEx6"
                                 role="tablist">
                                <a data-toggle="collapse" href="#collapse21" aria-expanded="false"
                                   aria-controls="collapse21">
                                    <i class="far fa-check-circle fa-sm mr-1 ico-done" title="Завершить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse22" aria-expanded="false"
                                   aria-controls="collapse22">
                                    <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse23" aria-expanded="false"
                                   aria-controls="collapse23">
                                    <i class="far fa-calendar fa-sm mr-1 ico-update" title="Изменить дату"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse24" aria-expanded="false"
                                   aria-controls="collapse24">
                                    <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
                                </a>
                                <i class="fas fa-flag fa-sm mr-1 ico-change" title="Какая-та фигня"></i>
                                <div id="collapse21" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx6" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите детали"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse1" data-toggle="collapse"
                                           class="bg-success px-2 py-1 border-0 confirm-but text-white btn">
                                            Завершить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse22" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx6" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse2" data-toggle="collapse"
                                           class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn">
                                            Удалить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse23" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx6" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input placeholder="Выберите дату" type="text"
                                                   class="form-control date">
                                        </div>
                                        <a href="#collapse3" data-toggle="collapse"
                                           class="bg-info px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse24" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx6" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input type="text" id="name"
                                                   class="form-control sf-light textarea-font-size"
                                                   value="ОАО 'Кыргыз Алтын'">
                                        </div>
                                        <div class="md-form">
                                            <input type="text" placeholder="Время встречи"
                                                   class="form-control sf-light textarea-font-size date-format">
                                        </div>
                                        <a href="#collapse4" data-toggle="collapse"
                                           class="bg-warning px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


{{--ПЯТЫЙ БЛОК--}}


            <div class="px-2 h-100 col-3">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn light-green accent-4">
                    <p class="text-white sf-bold mb-0">
                        ВСЕ ПОТЕНЦИАЛЬНЫЕ ВСТРЕЧИ
                    </p>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style="border-left:2px solid #64dd17; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                        КЛИЕНТЫ
                    </p>
                    <i class="fas fa-plus ml-auto fa-xs ico-done"></i>
                </div>
                <div class="blog-scroll">
                    <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
                         style="text-transform: uppercase;">
                        <div class="position-absolute bg-danger"
                             style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
                        <div style="border-bottom:1px solid #DCDCDC;">
                            <p class="deal-text sf-bold mb-2">
                                <i class="far fa-building"></i><span class="pl-1"> ОАО 'Кыргыз Алтын'</span>
                            </p>
                        </div>
                        <div class="toner">
                            <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordionEx7"
                                 role="tablist">
                                <a data-toggle="collapse" href="#collapse25" aria-expanded="false"
                                   aria-controls="collapse25">
                                    <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
                                </a>
                                <a data-toggle="collapse" href="#collapse26" aria-expanded="false"
                                   aria-controls="collapse26">
                                    <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
                                </a>

                                <div id="collapse25" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx7" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <a href="#collapse25" data-toggle="collapse"
                                           class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn">
                                            Удалить
                                        </a>
                                    </form>
                                </div>
                                <div id="collapse26" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                                     data-parent="#accordionEx7" style="border-bottom:1px solid #DCDCDC;">
                                    <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="" style="outline: none;"></textarea>
                                        <div class="md-form">
                                            <input type="text" id="name"
                                                   class="form-control sf-light textarea-font-size"
                                                   value="ОАО 'Кыргыз Алтын'">
                                        </div>
                                        <a href="#collapse26" data-toggle="collapse"
                                           class="bg-warning px-2 py-1 border-0 confirm-but text-white btn">
                                            Изменить
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
@include('modals.create_task')
@endsection
