

function renderBackground() {
	var pattern = Trianglify({
        width: window.innerWidth,
        height: window.innerHeight,
        x_colors: 'BrBG'
    });
	document.body.style.backgroundImage = "url(" + pattern.png() + ")";
}

renderBackground();

window.addEventListener('resize', function(event){
	renderBackground();
});