$(document).ready(function(){
    $("#menu").click(function(){
        $("#LayoutMenu").animate({right: "0"}, 100);
    });

    $("#fechamenu").click(function(){
        $("#LayoutMenu").animate({right: "-219"}, 100);
    });

});


$(document).ready(function() {
    $(".setad").click(function(){
        console.log("legal");
        $(this).siblings(".filmes").animate({scrollLeft: "-=400px" }, 100, "swing");
    });

    $(".setae").click(function(){
        console.log("legal");
        $(this).siblings(".filmes").animate({scrollLeft: "+=400px" }, 100, "swing")
    });
});


$(document).ready(function(){

    if(localStorage.getItem("avatar")){
        var fotoarquivo = localStorage.getItem("avatar");

        $(".avatar").attr("src", fotoarquivo);
    }

    $("#fotoform").submit(function(event){
        event.preventDefault();

        var fotoavatar = $("#fotoinput")[0].files[0];
        if (fotoavatar) {
            var novoarquivo = new FileReader();

            novoarquivo.onload = function(e) {
                var fotoavt = e.target.result;

                localStorage.setItem("avatar", fotoavt)

                $(".avatar").attr("src", e.target.result);
            };

            novoarquivo.readAsDataURL(fotoavatar);
        }else{
            alert("Testando!");
        }
    });
});

$(document).ready(function () {
    $(".estrela").hover(
        function () {
            let value = $(this).data("value");
            $(".estrela").each(function () {
                $(this).removeClass("hover");
                if ($(this).data("value") <= value) {
                    $(this).addClass("hover");
                }
            });
        },
        function () {
            $(".estrela").removeClass("hover");
        }
    );

    $(".estrela").click(function () {
        let value = $(this).data("value");
        $(".estrela").removeClass("selecionado");
        $(".estrela").each(function () {
            if ($(this).data("value") <= value) {
                $(this).addClass("selecionado");
            }
        });
    });
});



