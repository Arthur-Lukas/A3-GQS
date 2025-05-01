function navegar(url) {
    if (url && typeof url === "string") {
        window.location.href = url;
    } else {
        console.error("URL inválida!");
    }
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
