@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h2 class="pb-2 border-bottom"><b>Dados do Vendedor</b></h2>
            <div class="row pt-4">
            <div class="col-12">
                    <div class="d-flex align-items-start">
                        <div class="icon-square bg-light text-dark flex-shrink-0 me-3 pr-4 pb-4 text-oficial">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h2>#{{ $user->id }}</h2>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="10%"><b>Vendedor:</b></td>
                                <td>{{ $user->name }}</td>
                                <td width="10%" class="text-right"><b>E-mail:</b></td>
                                <td>{{ $user->email }}</td>
                                <td width="10%" class="text-right"><b>Comissão:</b></td>
                                <td>{{ $user->commission }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if(isset($contracts))
                <div class="col-12">
                    <div class="d-flex align-items-start pt-4">
                        <h4><b>Contratos fechados pelo Vendedor</b></h4>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th width="40%">Empresa</th>
                                <th class="text-right">Fechamento</th>
                                <th class="text-right">Valor</th>
                                <th class="text-right">Comissão(%)</th>
                                <th class="text-right">Valor da Comissão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $key => $contract)
                                <tr>
                                    <td>{{ $contract->id }}</td>
                                    <td>{{ $contract->name }}</td>
                                    <td class="text-right">{{ $contract->closure_at }}</td>
                                    <td class="text-right">
                                        <?php
                                            $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);
                                            echo $formatter->formatCurrency($contract->contract_value, 'BRL');
                                        ?>
                                    </td>
                                    <td class="text-right">{{ $contract->commission }}%</td>
                                    <td class="text-right">
                                        <?php
                                            echo $formatter->formatCurrency($contract->commission_value, 'BRL');
                                        ?>
                                    </td>
                                </tr>
                                @if(sizeof($contracts) == ($key+1))
                                <tr class="bg-secondary text-white">
                                    <td colspan="5" class="text-right"><b>Valor Total das Comissões</b></td>
                                    <td class="text-right">
                                        <b>
                                        <?php
                                            echo $formatter->formatCurrency($contract->commission_total, 'BRL');
                                        ?>
                                        </b>
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </main>
@include('site.footer')