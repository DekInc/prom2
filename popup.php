<div class="modal fade2" id="modalPop1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content modalContentMessageBox">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel1"></h5>                
            </div>
            <div class="modal-body modalMessageBoxBody">
                <div id="divMensajePop1">
                </div>
            </div>
            <div class="modal-footer modalMessageBoxButtons">
                <button id="btnOkMessageBox" type="button" class="btn btn-success btnModal" data-dismiss="modal">Aceptar</button>                
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalPop1').on("shown.bs.modal", function () {
        $('#btnOkMessageBox').css({ top: ($('#btnOkMessageBox').closest('div').height() - ($('#btnOkMessageBox').height())) * 0.466 + 'px' });
        //$('#btnOkMessageBox').position().top
        $('#btnOkMessageBox').focus();
    });
    $('#btnOkMessageBox').on('click', function () {
        if (typeof funcbtnOkMessageBox === 'function')
            funcbtnOkMessageBox();
    });
</script>