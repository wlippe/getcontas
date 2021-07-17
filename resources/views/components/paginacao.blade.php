@if($consulta->lastPage() > 1)
    <nav>
        <ul class="pagination">
            <li class="page-item {{$consulta->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $consulta->previousPageUrl()}}">Voltar</a>
            </li>
            <li class="page-item {{$consulta->currentPage() == $consulta->lastPage() ? 'disabled' : '' }}" >
                <a class="page-link" href="{{ $consulta->nextPageUrl() }}">Avançar</a>
            </li>
        </ul>
    </nav>
@endif