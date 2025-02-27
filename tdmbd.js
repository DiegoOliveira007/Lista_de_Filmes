const API_KEY = '12511f01e01ceb7d4a5d8c872e3aa020';
const URL = 'https://api.themoviedb.org/3';
const IMG = 'https://image.tmdb.org/t/p/w200';

DetalhesFilmes();

async function DetalhesFilmes(){
    const pagina = new URLSearchParams(window.location.search);
    const filmeselec = pagina.get("id");

    try{
        const informacao = await fetch(`detalhesdofilmes.php?id=${filmeselec}`);
        const dados = await informacao.json();

        document.title = dados.nome_filme 

        document.getElementById("titulofilme").textContent = dados.nome_filme;
        document.getElementById("imagemfilme").src = `${IMG}${dados.imagem_poster}`;
        document.getElementById("imagemfilme").alt = dados.nome_filme;
        document.getElementById("sinopsefilme").textContent = dados.sinopse;
        

        const genero = document.getElementById("genero");
        genero.textContent = dados.genero ? dados.genero: "";
        

        const nota = document.getElementById("nota");
        nota.textContent = `Quant. Aval: ${dados.quant_avaliacao ?? 0}`;
        
    }catch(error){
        console.error("Erro aos detalhes do filme");
    }

}

