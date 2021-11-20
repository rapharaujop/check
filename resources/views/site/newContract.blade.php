@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="pb-4"><b>Cadastrar Contrato</b></h1>
            <hr class="my-4">
            <form class="needs-validation" id="cadastro_vendedor" name="cadastro_vendedor" action="{{route('contract.store')}}" method="POST">
                <div class="row g-3">
                    <div class="col-6 pt-2">
                        <label for="name" class="form-label">Empresa</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="col-6 pt-2">
                        <label for="closure_at" class="form-label">Data de Fechamento</label>
                        <input type="date" class="form-control" id="closure_at" name="closure_at">
                    </div>

                    <div class="col-4 pt-2 pb-2">
                        <label for="commission" class="form-label">Primeiro Vendedor</label>
                        <select class="form-control form-select" id="salesman_one" name="salesman_one">
                            <option value="" selected>Selecionar</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->email }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 pt-2 pb-2">
                        <label for="commission" class="form-label">Segundo Vendedor</label>
                        <select class="form-control form-select" id="salesman_two" name="salesman_two">
                            <option value="" selected>Selecionar</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->email }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4 pt-2">
                        <label for="contract_value" class="form-label">Valor do Contrato</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="contractValue">R$</span>
                            </div>
                            <input type="text" class="form-control" aria-label="contractValue" id="contract_value" name="contract_value" aria-describedby="contractValue">
                        </div>                        
                    </div>
                    @csrf
                </div>

                <hr class="my-4">
                <div class="row g-3">
                    <div class="col-sm-12 pt-2 text-right">
                        <button class="btn btn-oficial btn-lg" type="submit">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@include('site.footer')