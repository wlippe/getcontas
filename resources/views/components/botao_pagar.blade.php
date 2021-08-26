 <!-- Botão de Excluir-->
<div class="group">
    <button type="button" class="btn btn-warning btn-sm" id="{{$id}}" data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="bi bi-wallet2"></i> Pagar
    </button>
</div>

 <!-- Model de Pagamento-->
<form action="{{ route('contas.pagar.pagamento') }}" method="POST" id="form_excluir">
    @csrf
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Pagar Conta </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row g-3">
                <div class="col-md-12"> 
                    <label for="data" class="form-label"> Data do Pagamento </label>
                    <input id="data"  name="data" type="date" max="50" class="form-control" value="{{ date("Y-m-d") }}" autocomplete="data" autofocus >
                </div>

                <div class="col-md-12"> 
                    <label for="nome" class="form-label"> Pagar com </label>
                    <select id="conta_id" name="conta_id" class="form-control" >
                        @foreach($conta as $registro)
                            <option value="{{ $registro->id }}"> {{ $registro->tipo .' - '. $registro->nome }} </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <input id="despesa_id" name="despesa_id" type="hidden" value="">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm " data-bs-dismiss="modal"> Cancelar </button>
            <button type="submit" name="pagar" class="btn btn-primary btn-sm"> Pagar </button>
            </form> 
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('button').click( function() {

            if( $(this).attr('id')) {
                $(document).find('#despesa_id').attr('value', $(this).attr('id'));
            }
        });
    });

</script>