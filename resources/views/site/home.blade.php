@include('site.header')

    <main role="main" class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="pb-4"><b><i class="fas fa-home ml-3 text-oficial"></i> Relatório</b></h1>

            <form class="needs-validation pb-4" id="filter" name="filter" action="{{route('contract.report')}}" method="POST">
                <div class="row g-3">
                    <div class="col-12 pt-2">
                        <h6 class="pb-2 pt-4"><b>Filtros</b></h6>
                    </div>
                    <div class="col-5 pt-2 pb-2">                        
                        <label for="filter_date" class="form-label">Mês/Ano de fechamento</label>
                        <input type="text" class="form-control" id="filter_date" name="filter_date" placeholder="00/0000">
                    </div>

                    <div class="col-5 pt-2 pb-2">
                        <label for="commission" class="form-label">Vendedor</label>
                        <select class="form-control form-select" id="filter_salesman" name="filter_salesman">
                            <option value="" selected>Selecionar</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @csrf
                    <div class="col-2 pt-4 mt-3 text-right">
                        <button class="btn btn-oficial btn-sm w-100 pb-2 pt-2" type="submit">Filtrar</button>
                    </div>
                </div>
            </form>

            <table class="table table-striped table-relatorio">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Empresa</th>
                        <th class="text-right">Fechamento</th>
                        <th class="text-right">1º Vendedor</th>
                        <th class="text-right">1º Vendedor - Comissão</th>
                        <th class="text-right">2º Vendedor</th>
                        <th class="text-right">2º Vendedor - Comissão</th>
                        <th class="text-right">Total Comissão</th>
                        <th class="text-right">Valor do Contrato</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY); ?>
                    @foreach ($contracts as $contract)
                    <tr>
                        <td>{{ $contract->id }}</td>
                        <td>{{ $contract->name }}</td>
                        <td class="text-right">{{ $contract->closure_at }}</td>
                        <td class="text-right">
                            <?php
                                if(isset($contract->salesman_one) && !empty($contract->salesman_one)){
                                    echo $contract->salesman_one;
                                }else{
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                                echo $formatter->formatCurrency($contract->commission_one_value, 'BRL');
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                                if(isset($contract->salesman_two) && !empty($contract->salesman_two)){
                                    echo $contract->salesman_two;
                                }else{
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                                echo $formatter->formatCurrency($contract->commission_two_value, 'BRL');
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                                echo $formatter->formatCurrency($contract->commission_value_sum, 'BRL');
                            ?>
                        </td>
                        <td class="text-right">
                            <?php
                                echo $formatter->formatCurrency($contract->contract_value, 'BRL');
                            ?>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfooter>
                    <tr class="bg-dark text-white">
                        <td class="text-right" colspan="7"><b>Total</</td>
                        <td class="text-right">
                            <b>
                            <?php
                                echo $formatter->formatCurrency($sum_commission, 'BRL');
                            ?>
                            </b>
                        </td>
                        <td class="text-right">
                            <b>
                            <?php
                                echo $formatter->formatCurrency($sum_contracts, 'BRL');
                            ?>
                            </b>
                        </td>
                    </tr>
                </tfooter>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </main>
@include('site.footer')