<div class="group">
    <form action="{{ route($rota) }}" method="POST" id="form_visualizar">
        @csrf
            <button 
                type  = "submit" 
                name  = "editar"
                id    = "botao_visualizar"
                class = "btn btn-secondary btn-sm"
                style = "color:white" 
                disabled >
                <i class="bi bi-search"></i>
            </button>
            <input type="hidden" name="id_visualizar" id="id_visualizar">
    </form>
</div>

<script type="text/javascript">

    $(document).ready( function() {
        $('tr').click( function() {
            if( $(this).attr('id')) {
                $(document).find('#id_visualizar').attr('value', $(this).attr('id'));
                document.getElementById('botao_visualizar').disabled = false;
            }
        });
    });

</script>