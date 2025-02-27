const API_KEY = '12511f01e01ceb7d4a5d8c872e3aa020';
const URL = 'https://api.themoviedb.org/3';
const IMG = 'https://image.tmdb.org/t/p/w200';

const CATEGORIAS = {
    filmesp: 1,
    filmesre: 2,
    filmesrr: 3
};


async function salvarFilmes(categoria, pontofinal) {
    try {
        const informacao = await fetch(`${URL}${pontofinal}?api_key=${API_KEY}&language=pt-BR&region=BR`);
        const dados = await informacao.json();

        const filmes = dados.results.slice(0, 8);

        for (const filme of filmes) {
            await fetch(`adicionarfilmes.php?id=${filme.id}&categoria=${CATEGORIAS[categoria]}`);
        }

        console.log("Filmes salvos com sucesso!");
    } catch (error) {
        console.error("Erro ao buscar e salvar filmes:", error);
    }
}


async function MostrarFilmesBD(categoria) {
    try {
        const resposta = await fetch(`buscafilmes.php?categoria=${CATEGORIAS[categoria]}`);
        const filmes = await resposta.json();
        
        
        const conteiner = document.getElementById(categoria);
        conteiner.innerHTML = '';

        filmes.forEach(filme => {
            const imagem = document.createElement("img");
            imagem.src = `${IMG}${filme.imagem_poster}`;
            imagem.alt = filme.nome_filme;

            const inicial = document.createElement("a");
            inicial.href = `infofilme.html?id=${filme.cod_filme}`;

            inicial.appendChild(imagem);
            conteiner.appendChild(inicial);

            
        });
    } catch (error) {
        console.error("Erro ao buscar os filmes do banco:", error);
    }
}


salvarFilmes('filmesp', '/movie/popular');
salvarFilmes('filmesre', '/movie/now_playing');
salvarFilmes('filmesrr', '/movie/top_rated');

setTimeout(() => { 
    MostrarFilmesBD('filmesp');
    MostrarFilmesBD('filmesre');
    MostrarFilmesBD('filmesrr');
}, 3000);
