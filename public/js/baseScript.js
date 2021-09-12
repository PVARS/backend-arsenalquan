function showMessage(messages){
    $('.alert-danger').removeClass('d-none').html(messages);
}

function removeMessage(){
    $('.alert-danger').addClass('d-none');
}

function handleError(errors){
    let error = '';

    errors.forEach(messages => {
        error += messages + '<br>';
    });

    return error;
}