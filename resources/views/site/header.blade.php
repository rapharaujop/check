<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChecklistFácil</title>
    <link rel="stylesheet" href="{{ url(mix('site/css/style.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('site/css/bootstrap/bootstrap.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('site/js/node_modules/fontawesome/css/all.css')) }}">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-nav-oficial mb-4">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none" href="{{route('contract.report')}}">
                <img src="http://localhost/checklistfacil.com/public/site/img/logo.svg" alt="Logo" width="150px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">                                    
                    <li class="nav-item pr-2">
                        <a class="nav-link" href="{{route('contract.report')}}"><i class="fas fa-home pt-1 ml-3 font-12"></i> Relatório</a>
                    </li>
                    <li class="nav-item dropdown pr-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle pt-1 ml-3 font-12"></i> Vendedor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('user.create')}}">Cadastro</a>
                            <a class="dropdown-item" href="{{route('user.index')}}">Lista</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown pr-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-industry pt-1 ml-3 font-12"></i> Contrato
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('contract.create')}}">Cadastro</a>
                            <a class="dropdown-item" href="{{route('contract.index')}}">Lista</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>