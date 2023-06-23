function checkStatus(checkbox) {
    var data = new FormData();
    data.append("checkbox", checkbox.name);
    data.append("marcado", checkbox.checked);
    data.append("valor", checkbox.value);

    fetch('index.php', {
            method: 'POST',
            body: data
        })
        .then(retorno => {
            console.log("sucesso" + checkbox.name + checkbox.checked + checkbox.value);
        })
        .catch(
            retorno => {
                console.error(retorno);
            }
        )
}