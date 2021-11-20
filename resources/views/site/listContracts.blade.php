@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="pb-4"><b>Lista de Contratos</b></h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th width="20%">Empresa</th>
                        <th class="text-right">Data do Fechamento</th>
                        <th class="text-right">Primeiro Vendedor</th>
                        <th class="text-right">Segundo Vendedor</th>
                        <th class="text-right">Valor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contracts as $contract)
                    <tr>
                        <td><small>{{ $contract->id }}</small></td>
                        <td><small>{{ $contract->name }}</small></td>
                        <td class="text-right"><small>{{ $contract->closure_at }}</small></td>
                        <td class="text-right"><small>{{ $contract->salesman_one }}</small></td>
                        <td class="text-right"><small>{{ $contract->salesman_two }}</small></td>
                        <td class="text-right">
                            <small>
                            <?php
                                $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);
                                echo $formatter->formatCurrency($contract->contract_value, 'BRL');
                            ?>
                            </small>
                        </td>
                        <td class="text-center">
                            <form action="{{route('contract.destroy', ['contract' => $contract->id])}}" method="post"> 
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{route('contract.show', ['contract' => $contract->id])}}" class="btn btn-secondary" title="Dados do Contrato">
                                        <small><i class="fas fa-info-circle"></i></small>
                                    </a>
                                    <a href="{{route('contract.edit', ['contract' => $contract->id])}}" class="btn btn-secondary" title="Editar Contrato">
                                        <small><i class="fas fa-user-edit"></i></small>
                                    </a>                                                        
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-secondary" title="Remover Contrato">
                                        <small><i class="fas fa-trash-alt"></i></small>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@include('site.footer')