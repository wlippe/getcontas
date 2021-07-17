<div class="group">
    <form action="{{ route($rota) }}" method="POST" id="form_editar">
        @csrf
            <button 
                type  = "submit" 
                name  = "editar"
                id    = "botao_editar"
                class = "btn btn-primary btn-sm"
                style = "color:white" 
                disabled >
                <i class="bi bi-pencil-square"></i>
            </button>
            <input type="hidden" name="id_editar" id="id_editar">
    </form>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('tr').click( function() {
            if( $(this).attr('id')) {
                $(document).find('#id_editar').attr('value', $(this).attr('id'));
                document.getElementById('botao_editar').disabled = false;
            }
        });
    });

</script>