function getMensagemErro(codigoErro) {
    switch (codigoErro) {
        case 403:
            return 'Acesso não autorizado';
        case 404:
            return 'Funcionalidade não encontrada';
        case 500:
            return 'O servidor está com dificuldades para processar a sua requisição';
        default:
            return 'Não foi possível executar a requisição';
    }
}

function ucfirst(string) {
    return string.charAt().toUpperCase() + string.slice(1);
}