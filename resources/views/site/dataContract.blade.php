@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h2 class="pb-2 border-bottom"><b>Dados do Contrato</b></h2>
            <div class="row pt-4">
                <div class="col-12">
                    <div class="d-flex align-items-start">
                        <div class="icon-square bg-light text-dark flex-shrink-0 me-3 pr-4 pb-4 text-oficial">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h2>Contrato #{{ $contract->id }}</h2>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="25%"><b>Empresa:</b></td>
                                <td>{{ $contract->name }}</td>
                                <td width="25%" class="text-right"><b>Data de fechamento do contrato:</b></td>
                                <td width="15%" class="text-right">{{ $contract->closure_at }}</td>
                            </tr>
                            <?php
                                $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);
                            ?>
                            @if(isset($contract->salesman_one))
                            <tr>
                                <td width="25%"><b>1º Vendedor:</b></td>
                                <td>{{ $contract->salesman_one }}</td>
                                <td width="25%" class="text-right"><b>Comissão:</b></td>
                                <td width="15%" class="text-right">
                                    <small>{{ $contract->commission_one }}%</small> = 
                                    <?php
                                        echo $formatter->formatCurrency($contract->commission_one_value, 'BRL');
                                    ?>
                                </td>
                            </tr>
                            @endif
                            @if(isset($contract->salesman_two))
                            <tr>
                                <td width="25%"><b>2º Vendedor:</b></td>
                                <td>{{ $contract->salesman_two }}</td>
                                <td width="25%" class="text-right"><b>Comissão:</b></td>
                                <td width="15%" class="text-right"><small>{{ $contract->commission_two }}%</small> = 
                                    <?php
                                        echo $formatter->formatCurrency($contract->commission_two_value, 'BRL');
                                    ?>
                                </td>
                            </tr>
                            @endif
                            <tr class="bg-dark text-white">
                                <td colspan="3" class="text-right"><b>Valor da(s) Comissão(ões):</b></td>
                                <td width="15%" class="text-right">
                                    <?php
                                        echo $formatter->formatCurrency($contract->commission_value_sum, 'BRL');
                                    ?>
                                </td>
                            </tr>
                            <tr class="bg-dark text-white">
                                <td colspan="3" class="text-right"><b>Valor do Contrato:</b></td>
                                <td width="15%" class="text-right">
                                    <?php
                                        echo $formatter->formatCurrency($contract->contract_value, 'BRL');
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@include('site.footer')