<div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
     style="text-transform: uppercase;">
    <div class="position-absolute bg-danger"
         style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>
    <div style="border-bottom:1px solid #DCDCDC;">
        <p class="deal-text sf-bold mb-2">
            <i class="far fa-building"></i><span class="pl-1">
                {{ $customer->name  ?? "No name" }}
            </span>
        </p>
        <p class="deal-text sf-bold mb-2">
            <i class="far fa-building"></i><span class="pl-1">
                {{ $customer->company ?? "No company" }}
            </span>
        </p>
        <a href="tel:{{ $customer->contacts }}" class="deal-text sf-bold mb-3">
            <i class="fas fa-phone"></i></i><span class="pl-1">{{ $customer->phone ?? "No phone" }}</span>
        </a>
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
