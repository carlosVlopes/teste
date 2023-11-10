$(function() {

    $("#meuPrimeiroDropzone").dropzone({
        url: "galeria-instagram/upload",
        paramName: "file",
        dictDefaultMessage: "Selecione ou arraste as imagens aqui!",
        maxFilesize: 300
    });

});
