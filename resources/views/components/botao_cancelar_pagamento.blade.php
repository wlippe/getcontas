 <!-- Botão de Excluir-->
<div class="group">
    <button type="button" class="btn btn-secondary btn-sm" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#cancelarPagamento">
        Cancelar
    </button>
</div>

 <!-- Model de Pagamento-->
<form action="{{ route('contas.pagar.cancelar') }}" method="POST" id="form_excluir">
    @csrf
    <div class="modal fade" id="cancelarPagamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cancelar Pagamento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Deseja realmente cancelar este Pagamento?
            <input id="id_despesa"  name="id_despesa" type="hidden" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm " data-bs-dismiss="modal"> Fechar </button>
            <button type="submit" name="excluir" class="btn btn-primary btn-sm"> Confirmar </button>
            </form> 
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('button').click( function() {

            if( $(this).attr('id')) {
                $(document).find('#id_despesa').attr('value', $(this).attr('id'));
            }
        });
    });

</script>