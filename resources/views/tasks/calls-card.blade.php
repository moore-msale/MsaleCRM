<div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
     style="text-transform: uppercase;">
    <div class="position-absolute bg-danger"
         style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
    <div style="border-bottom:1px solid #DCDCDC;">
        <p class="deal-text sf-bold mb-2">
            <i class="far fa-building"></i><span class="pl-1">
                {{ $call->name ?? "No name" }}
            </span>
        </p>
        <p class="deal-text sf-bold mb-2">
            <i class="far fa-building"></i><span class="pl-1">
                {{ $call->company ?? "No company" }}
            </span>
        </p>
        <a href="tel:{{ $call->phone }}" class="deal-text call-btn sf-bold mb-3">
            <i class="fas fa-phone"></i></i><span class="pl-1">{{ $call->phone ?? "No phone" }}</span>
        </a>
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
