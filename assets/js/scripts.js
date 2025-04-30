document.getElementById("formLivro").addEventListener("submit", function(event) {
    let titulo = document.getElementById("titulo").value;
    let autor = document.getElementById("autor").value;
    let preco = document.getElementById("preco").value;

    if (titulo.length < 3) {
        alert("O título deve ter pelo menos 3 caracteres.");
        event.preventDefault();
    }

    if (autor.length < 3) {
        alert("O autor deve ter pelo menos 3 caracteres.");
        event.preventDefault();
    }

    if (isNaN(parseFloat(preco)) || parseFloat(preco) <= 0) {
        alert("O preço deve ser um número válido e maior que 0.");
        event.preventDefault();
    }
});