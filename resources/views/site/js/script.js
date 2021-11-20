$(document).ready(function() {
    $('#contract_value').mask("#.##0,00", { reverse: true });
    $('#filter_date').mask("00/0000", { reverse: true });
    $("#cadastro_vendedor").validate({
        rules: {
            name: { required: true, minlength: 5 },
            email: { required: true, email: true },
            commission: { required: true }
        },
        messages: {
            name: {
                required: '<div class="alert alert-danger p-1" role="alert">Informação é obrigatória</div>',
                minlength: '<div class="alert alert-warning p-1" role="alert">O campo deve possuir pelo menos 5 caracteres</div>'
            },
            email: {
                required: '<div class="alert alert-danger p-1" role="alert">Informação é obrigatória</div>',
                email: '<div class="alert alert-warning p-1" role="alert">E-mail inválido</div>'
            },
            commission: {
                required: '<div class="alert alert-danger p-1" role="alert">Informação é obrigatória</div>'
            }
        }
    });
});