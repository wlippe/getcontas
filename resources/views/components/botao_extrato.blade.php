<!-- Button trigger modal -->
<div class="group">
    <button type="button" id="botao_movimentar" class="btn btn-secondary btn-sm" disabled data-bs-toggle="modal" data-bs-target="#simuladorModal" style="color:white;">
    <i class="bi bi-file-earmark-text"></i> </i> Extrato
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="simuladorModal" tabindex="-1" aria-labelledby="simuladorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simuladorModalLabel"> Movimentar </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_aplicar" id="id_aplicar">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="valor" class="form-label"> Valor </label>
                <input id="valor" type="number" class="form-control @error('valor') is-invalid @enderror" name="valor" value="{{ $receita->valor?? ''}}" required autocomplete="valor" 
                onchange="this.value = parseFloat(this.value).toFixed(2)" placeholder="0,00" step=".01">
            </div>
        
            <div class="col-md-6">
                <label for="data" class="form-label"> Data </label>
                <input id="data" type="date" class="form-control" name="data" required autocomplete="data" value="{{ $receita->data?? ''}}">
            </div>
        
            <div class="col-md-12">
                <label for="customRange2" class="form-label">Example range</label>
                <input type="range" class="form-range" min="0" max="10" id="botaoRange">
                <input type="range" class="form-range" min="0" max="10" id="botaoRange">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
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