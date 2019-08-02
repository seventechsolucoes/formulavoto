$(() => $('[data-toggle="tooltip"]').tooltip());

function getMensagemErro(codigoErro) {
    switch (codigoErro) {
        case 403:
            return '[403] - Acesso não autorizado';
        case 404:
            return '[404] - Funcionalidade não encontrada';
        case 500:
            return '[500] - O servidor está com dificuldades para processar a sua requisição';
        default:
            return 'Não foi possível executar a requisição';
    }
}

function ucfirst(string) {
    return string.charAt().toUpperCase() + string.slice(1);
}