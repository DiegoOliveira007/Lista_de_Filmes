$(document).ready(function () { 
    $(".estrela").click(function () {
        let rating = $(this).data("value"); 
        let filme_id = new URLSearchParams(window.location.search).get("id"); 
        let usuario_id = 8;
        

        $.post("salvamento_nota.php", { nota: rating, filme_id: filme_id, usuario_id: usuario_id }, function (res) {
            let resposta = JSON.parse(res);
            if (resposta.success) {
                alert("Avaliação salva com sucesso!");
            } else {
                alert("Erro ao salvar avaliação.");
            }
        });
    });
});
