@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="pb-4"><b>Cadastrar Vendedor</b></h1>
            <hr class="my-4">
            <form class="needs-validation" id="cadastro_vendedor" name="cadastro_vendedor" action="{{route('user.store')}}" method="POST">                    
                <div class="row g-3">
                    @if(isset($alert))
                        <div class="col-12 pt-2"> 
                            <div class="alert alert-danger" role="alert">{{ $alert }}</div>
                        </div>
                    @endif
                    <div class="col-12 pt-2">
                        <label for="name" class="form-label">Nome do Vendedor</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="col-6 pt-2">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="col-6 pt-2 pb-2">
                        <label for="commission" class="form-label">Comissão do Vendedor</label>
                        <select class="form-control form-select" id="commission" name="commission">
                            <option value="" selected>Selecionar</option>
                            @for ($i = 1; $i < 11; $i++)
                            <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
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