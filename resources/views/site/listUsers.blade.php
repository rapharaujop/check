@include('site.header')

    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="pb-4"><b>Lista de Vendedores</b></h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Comissão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td><small>{{ $user->id }}</small></td>
                        <td><small>{{ $user->name }}</small></td>
                        <td><small>{{ $user->email }}</small></td>
                        <td><small>{{ $user->commission }}%</small></td>
                        <td>
                            <form action="{{route('user.destroy', ['user' => $user->id])}}" method="post"> 
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{route('user.show', ['user' => $user->id])}}" class="btn btn-secondary" title="Dados do Vendedor">
                                        <small><i class="fas fa-info-circle"></i></small>
                                    </a>
                                    <a href="{{route('user.edit', ['user' => $user->id])}}" class="btn btn-secondary" title="Editar dados do Vendedor">
                                        <small><i class="fas fa-user-edit"></i></small>
                                    </a>                                                        
                                    @csrf
                                    @method("delete")
                                    <button type="submit" class="btn btn-secondary" title="Remover Vendedor">
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