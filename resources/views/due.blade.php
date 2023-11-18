@extends('default')

@section('title')
    {{ $due['declarante_razao_social'] }}
@endsection

@section('content')
    <div class="row align-items-center justify-content-between">

        <nav class="d-inline-flex my-3">
            <a type="button" class="btn" onclick="history.back()"><i class="bi bi-arrow-left"></i></a>
            <a type="button" class="btn active" data-tab-value="#due">DU-E</a>
            <a type="button" class="btn" data-tab-value="#due-items">DU-E Itens</a>
            <button type="submit" id="save" class="btn btn-success ms-auto">Salvar alterações</button>
        </nav>

        <div class="col-12 mt-3 active-tab" id="due" data-tab-info>
            <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <h5 class="text-center border-bottom">Dados Gerais</h5>
                <form id="due-form">
                    <input type="text" id="id" name="id" value="{{ $due['id'] }}" hidden>
                    <div class="mb-3">
                        <label for="declarante">Declarante</label>
                        <input type="text" class="form-control" value="{{ $due['declarante_cpf_cnpj'] . ' / ' . $due['declarante_razao_social'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="identificacao">Identificação</label>
                        <input type="text" class="form-control" value="{{ $due['identificacao'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control" value="{{ $due['numero'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="moeda">Moeda</label>
                        <input type="text" class="form-control" value="{{ $due['moeda'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="incoterm">Incoterm</label>
                        <input type="text" class="form-control" value="{{ $due['incoterm']}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="total-vmle-moeda">VMLE Moeda</label>
                        <input type="text" class="form-control" value="{{ $due['total_vmle_moeda'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="total-vmcv-moeda">VMCV Moeda</label>
                        <input type="text" class="form-control" value="{{ $due['total_vmcv_moeda'] }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="total-peso-liquido">Peso Líquido</label>
                        <input type="text" class="form-control" value="{{ $due['total_peso_liquido'] }}" disabled>
                    </div>
                    <h5 class="text-center border-bottom">Informações Complementares</h5>
                    <div class="my-3">
                        <textarea class="form-control text-top" id="informacoes_complementares" name="informacoes_complementares">{{ $due['informacoes_complementares'] }}</textarea>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 mt-3" id="due-items" data-tab-info>
            <div class="shadow p-3 mb-5 bg-body-tertiary rounded">
                <h5 class="text-center">Itens</h5>
                <form id="due-items-form">
                    @foreach($due['due_items'] as $dueItem)

                        @php
                            $enquadramento = [];
                            if ($dueItem['enquadramento1']) array_push($enquadramento, $dueItem['enquadramento1']);
                            if ($dueItem['enquadramento2']) array_push($enquadramento, $dueItem['enquadramento2']);
                            if ($dueItem['enquadramento3']) array_push($enquadramento, $dueItem['enquadramento3']);
                            if ($dueItem['enquadramento4']) array_push($enquadramento, $dueItem['enquadramento4']);
                            $enquadramento = implode(',', $enquadramento);
                        @endphp

                        <div class="border-top border-bottom border-dark" style="border: ">
                            <input type="text" id="due-item-id" value="{{ $dueItem['id'] }}" hidden disabled>
                            <div class="mb-3">
                                <label for="item">Item</label>
                                <input type="text" name="item" class="form-control" value="{{ $dueItem['item'] }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="nota">Nota / Série / Item</label>
                                <input type="text" name="nota" class="form-control" value="{{ $dueItem['nfe_numero'] . ' / ' . $dueItem['nfe_serie'] . ' / ' . $dueItem['nfe_numero'] }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="descricao-complementar">Descrição Complementar</label>
                                <textarea name="descricao-complementar" class="form-control" disabled>{{ $dueItem['descricao_complementar'] }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ncm">NCM</label>
                                <input type="text" class="form-control" value="{{ $dueItem['ncm'] }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="enquadramentos">Enquadramento(s)</label>
                                <input type="text" class="form-control" value="{{ $enquadramento }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="vmle-moeda">VMLE Moeda</label>
                                <input type="text" class="form-control" value="{{ $dueItem['vmle_moeda'] }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="vmcv-moeda">VMCV Moeda</label>
                                <input type="text" class="form-control" value="{{ $dueItem['vmcv_moeda'] }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="peso-liquido">Peso Líquido</label>
                                <input type="text" class="form-control" value="{{ $dueItem['peso_liquido'] }}" disabled>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module" defer>
        import { Toast } from '../app.js';

        $(function() {
            $('#save').on('click', function (event) {
                $('#save').prop('disabled', true);

                event.preventDefault();

                $.ajax({
                    url: `/api/dues/${$('#id').val()}`,
                    type: "put",
                    data: $('#due-form').serialize(),
                    dataType: 'json',
                    success: res => new Toast().show('Registro atualizado com sucesso!'),
                    error: error => new Toast().show('Ocorreu um erro ao atualizar registro, tente novamente.')
                });

                $('#save').prop('disabled', false);
            })
        })
    </script>

    <script>
        const tabs = document.querySelectorAll('[data-tab-value]')
        const tabInfos = document.querySelectorAll('[data-tab-info]')

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(tab => {
                    tab.classList.remove('active');
                })

                const tabData = document
                    .querySelector(tab.dataset.tabValue);

                tabInfos.forEach(tabInfo => {
                    tabInfo.classList.remove('active-tab')
                })

                tab.classList.add('active');
                tabData.classList.add('active-tab');
            })
        })
    </script>
@endsection