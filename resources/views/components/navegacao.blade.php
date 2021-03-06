<form method="POST" action="{{ route($rota) }}">
    @csrf
    <div class="input-group mb-3">
        <div class="input-group">

            <select class="form-select" id="mes" name="mes">
                <option value="1"  {{$data->mes == 1 ?  "selected='selected'" : ""}} > Janeiro </option>
                <option value="2"  {{$data->mes == 2 ?  "selected='selected'" : ""}} > Fevereiro </option>
                <option value="3"  {{$data->mes == 3 ?  "selected='selected'" : ""}} > Março </option>
                <option value="4"  {{$data->mes == 4 ?  "selected='selected'" : ""}} > Abril </option>
                <option value="5"  {{$data->mes == 5 ?  "selected='selected'" : ""}} > Maio </option>
                <option value="6"  {{$data->mes == 6 ?  "selected='selected'" : ""}} > Junho </option>
                <option value="7"  {{$data->mes == 7 ?  "selected='selected'" : ""}} > Julho </option>
                <option value="8"  {{$data->mes == 8 ?  "selected='selected'" : ""}} > Agosto </option>
                <option value="9"  {{$data->mes == 9 ?  "selected='selected'" : ""}} > Setembro </option>
                <option value="10" {{$data->mes == 10 ? "selected='selected'" : ""}} > Outubro </option>
                <option value="11" {{$data->mes == 11 ? "selected='selected'" : ""}} > Novembro </option>
                <option value="12" {{$data->mes == 12 ? "selected='selected'" : ""}} > Dezembro </option>
            </select>

            <input id="ano" type="text" class="form-control @error('ano') is-invalid @enderror" name="ano" value="{{$data->ano?? ''}}{{old('ano')}}" autocomplete="ano" autofocus placeholder="Ano" min="4" max="4" >

            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>

        </div>
    </div>
</form>