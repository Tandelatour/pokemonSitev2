
function messageCatch() {
    let img = document.querySelector('.imgcatch');
    if (img.src.includes('pokeball-ko.jpg')) {
        alert('Pokémon capturé');
    } else if (img.src.includes('pokeball-ok.jpg')) {
        alert('Pokémon relâché');
    }
}
