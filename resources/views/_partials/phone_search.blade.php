<div class="modal fade right" id="phoneSearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right mx-0 mt-0" role="document" style="width:100%;!important;max-width: 700px;!important;">
        <div class="modal-content px-2 w-md-50" style="height: 100vh; min-height: 550px;">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light  overflow-hidden" id="myModalLabel">- поиск</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-header border-0">
                <input type="text" name="name" id="phone-search-input" class="form-control sf-light mt-4 rounded-0 border-top-0 border-left-0  border-right-0 btn-outline-0" style="border-bottom: 0.5px solid #000000;"  placeholder="Введите название" >
            </div>
            <div class="modal-body">
                <div class="position-absolute search-result mt-2" id="search-result" style="right: 0;width:100%; z-index:999;">
                </div>
            </div>
        </div>
    </div>
</div>
