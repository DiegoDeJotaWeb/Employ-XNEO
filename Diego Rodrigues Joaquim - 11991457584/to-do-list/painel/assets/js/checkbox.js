$(document).ready(function() {
    $(".meuCheckbox").click(function() {
        var index = $(".meuCheckbox").index(this);
        var paragrafo = $(".meuParagrafo").eq(index);

        if ($(this).is(":checked")) {
            paragrafo.addClass("marcado");
        } else {
            paragrafo.removeClass("marcado");
        }
    });
});