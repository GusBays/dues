@extends('default')

@section('title')
    Menu
@endsection

@section('content')
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-12 col-lg-10">
            <h4 class="text-center pb-1 border-bottom">Menu principal</h4>
            <div class="d-flex justify-content-center">
                <a type="button" class="btn btn-success mx-1" href="/cadastro/due/novo">Cadastrar nova DU-E</a>
                <a type="button" class="btn btn-dark mx-1" href="/dues">Listagem de DU-Es</a>
                <form class="mx-1" id="edit-due">
                    <div class="input-group">
                        <input id="id" name="id" class="form-control" type="text" required placeholder="ID do registro para editar">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('#edit-due').submit(function (event) {
            event.preventDefault();

            const inputs = $(this).serialize().split("&");
 
            let result = {};
            for(let input in inputs)
            {
                const key = inputs[input].split("=")[0]
                const value = inputs[input].split("=")[1];

                result[key] = value
            }

            window.location.href = `/due/${result.id}`
        })
    })
</script>
@endsection