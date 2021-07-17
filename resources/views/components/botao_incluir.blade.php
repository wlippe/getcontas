<a href = "{{ route($rota) }}" >
    <button 
        type  = "button" 
        class = "btn btn-secondary btn-sm" >
       <i class="bi bi-plus"></i> {{ $nome?? 'Cadastrar' }} 
    </button>
</a>