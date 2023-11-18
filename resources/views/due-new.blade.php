@extends('default')

@section('title')
    Nova DU-E
@endsection

@section('content')
    <div class="row align-items-center justify-content-center">
        <div class="d-inline-flex my-3">
            <a type="button" class="btn" onclick="history.back()"><i class="bi bi-arrow-left"></i></a>
            <button class="btn btn-success ms-auto" id="create" disabled>Cadastrar</button>
        </div>
        <div class="col-6">
            <h5 class="text-center">Insira aqui o JSON da sua DU-E para cadastro</h5>
            <textarea class="form-control text-top" id="json"></textarea>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module" defer>
        import { Toast } from '../../app.js';

        $(function() {
            $('#json').on('input', function () {
                const data = $(this).val()

                try {
                    JSON.parse(data)
                } catch (error) {
                    $(this).addClass('is-invalid')
                    $('#create').prop('disabled', true)

                    return
                }

                $(this).removeClass('is-invalid')
                $(this).addClass('is-valid')
                $('#create').prop('disabled', false)
            })

            $('#create').on('click', function () {
                $('#create').prop('disabled', true);

                let dataVal = null
                try {
                    dataVal = JSON.parse($('#json').val())
                } catch (error) {}

                if (!dataVal) new Toast().show('JSON inválido, tente novamente.')

                $.ajax({
                    url: `/api/dues`,
                    type: "post",
                    data: dataVal,
                    dataType: 'json',
                    success: res => window.location.href = `/due/${res.id}`,
                    error: error => new Toast().show('Ocorreu um erro ao criar registro, tente novamente.')
                });

                $('#create').prop('disabled', false);
            })
        })
    </script>
@endsection