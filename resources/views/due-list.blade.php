@extends('default')

@section('title')
    Listagem
@endsection

@section('content')
<div class="row align-items-center justify-content-center">

    <div class="d-inline-flex my-3">
        <a type="button" class="btn" onclick="history.back()"><i class="bi bi-arrow-left"></i></a>
        <button class="btn btn-success ms-auto" id="create" onclick="window.location.href = '/cadastro/due/novo'">Cadastrar</button>
    </div>

    <div class="col-12">
        <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="table-responsive">
                <h4 class="text-center">Listagem de DU-Es</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Declarante</th>
                            <th>Identificação</th>
                            <th>Número</th>
                            <th>Moeda</th>
                            <th>VMCV Moeda</th>
                            <th>VMLE Moeda</th>
                            <th>Peso Líquido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dues as $due)
                            <tr onclick="window.location='/due/{{ $due['id'] }}';" style="cursor: pointer;">
                                <td>{{ $due['declarante_cpf_cnpj'] }}</td>
                                <td>{{ $due['identificacao'] }}</td>
                                <td>{{ $due['numero'] }}</td>
                                <td>{{ $due['moeda'] }}</td>
                                <td>{{ $due['total_vmle_moeda'] }}</td>
                                <td>{{ $due['total_vmcv_moeda'] }}</td>
                                <td>{{ $due['total_peso_liquido'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection