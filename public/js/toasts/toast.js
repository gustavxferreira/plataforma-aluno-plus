import toastr from 'https://cdn.jsdelivr.net/npm/toastr@2.1.4/+esm'

toastr.options = {
    progressBar: true, 
    timeOut: 1500, 
};

// success
export function toastCadastration() {
    toastr.success('Cadastrado com sucesso!', 'Sucesso', {timeOut: 1000});
}

export function updateToast() {
    toastr.success('Alterado com sucesso!', 'Sucesso', {timeOut: 2500});
}

export function toastDelete() {
    toastr.success('Item excluído com sucesso!', 'Sucesso');
}

// error
export function toastErrorInServer() {
    toastr.error('Ocorreu um erro ao se conectar com o servidor. Tente novamente mais tarde.', 'Erro');
}

export function toastIdNotFound() {
    toastr.error('O ID solicitado não foi encontrado. Verifique e tente novamente.', 'Erro');
}

// warning
export function toastFieldsWarning(message = "Insira Campos Válidos") {
    toastr.warning(message, 'Aviso');
}

export function toastConflict() {
    toastr.warning('Este registro já está presente no sistema', 'Aviso');
}