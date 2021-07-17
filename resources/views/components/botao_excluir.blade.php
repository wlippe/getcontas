 <!-- Botão de Excluir-->
<div class="group">
    <button type="button" class="btn btn-danger btn-sm" id="botao_excluir" disabled data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="bi bi-trash" disabled readonly ></i>
    </button>
</div>

 <!-- Mensagem de Confirmação-->
<form action="{{ route($rota) }}" method="POST" id="form_excluir">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Excluir</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Deseja realmente excluir o registro?
            <input id="id_excluir"  name="id_excluir" type="hidden" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm " data-bs-dismiss="modal"> Cancelar </button>
            <button type="submit" name="excluir" class="btn btn-danger btn-sm">
               <i class="bi bi-trash"></i> Excluir </button>
            </form> 
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('tr').click( function() {

            if( $(this).attr('id')) {
                $(document).find('#id_excluir').attr('value', $(this).attr('id'));
                document.getElementById('botao_excluir').disabled = false;
            }
        });
    });

</script>