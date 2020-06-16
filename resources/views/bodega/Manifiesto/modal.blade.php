<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{ $man->id_manifiesto }}">
    {{Form::Open(array('action'=>array('ManifiestoController@destroy',$man->id_manifiesto),'method'=>'delete'))}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Recibir Manifiesto</h4>
                </div>
                <div class="modal-body">
                    <p>Confirme si desea recibir el manifiesto</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    {{Form::Close()}}
</div>