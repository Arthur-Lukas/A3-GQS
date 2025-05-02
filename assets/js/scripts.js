function navegar(url) {
    window.location.href = url;
}

// Adiciona efeito hover nos botões
document.addEventListener("DOMContentLoaded", function() {
    let botoes = document.querySelectorAll("button");
    botoes.forEach(botao => {
        botao.addEventListener("mouseenter", () => {
            botao.style.transform = "scale(1.05)";
        });

        botao.addEventListener("mouseleave", () => {
            botao.style.transform = "scale(1)";
        });
    });
});