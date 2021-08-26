<!-- Button trigger modal -->
<div class="group">
    <button type="button" id="botao_movimentar" class="btn btn-success btn-sm" disabled data-bs-toggle="modal" data-bs-target="#movimentarModal" style="color:white;">
        <i class="bi bi-currency-dollar"></i> Movimentar
    </button>
</div>

<!-- Modal -->
<form action="{{ route('aplicacao.movimentar') }}" method="POST" id="form_movimentar">
    @csrf
<div class="modal fade" id="movimentarModal" tabindex="-1" aria-labelledby="simuladorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simuladorModalLabel"> Movimentar </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_movimentar" id="id_movimentar">
        <div class="row g-3">
                    
            <div class="col-md-12">
                <label for="data" class="form-label"> Data </label>
                <input id="data" type="date" class="form-control" name="data" required autocomplete="data" value="{{ date("Y-m-d") }}">
            </div>

            <div class="col-md-12">
              <label for="tipo" class="form-label"> Tipo </label>
              <select id="tipo" name="tipo" class="form-control" @error('tipo') is-invalid @enderror required >
                  <option value="1" > Aplicar </option>
                  <option value="2" > Resgatar </option>
              </select>
            </div>

            <div class="col-md-12"> 
                <label for="nome" class="form-label"> Conta </label>
                <select id="conta_id" name="conta_id" class="form-control" >
                    @foreach($contas as $registro)
                        <option value="{{ $registro->id }}"> {{ $registro->tipo .' - '. $registro->nome }} </option>
                    @endforeach
                </select>
            </div>
          
            <div class="col-md-12">
                <label for="valor" class="form-label"> Valor </label>
                <input id="valor" type="number" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Confirmar</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('tr').click( function() {
            if( $(this).attr('id')) {
                $(document).find('#id_movimentar').attr('value', $(this).attr('id'));
                document.getElementById('botao_movimentar').disabled = false;
            }
        });
    });

</script>