
function setup(){
	// set up loading screen
	let heading = $('#heading');
	heading.css({
		"margin": "auto",
		"padding-top": (window.innerHeight/2.4) + "px",
		"display": "inline-block"
	});

	// loading bar
	let loader = $('#loader');
	loader.css({
		"margin": "auto",
		"width": (heading.width()*0.9),
		"display": "block"
	});
}


function loadFinished() {
	let loader = $('#loader');
	let heading = $('#heading');

	loader.css("display", "none");
	heading.animate({
	    paddingTop: (window.innerHeight/15) + "px"
	}, 1000);

	// animate articles
	let articles = $('#app');
	articles.css({
		"display": "block"
	});
}


function getArticles() {
	$.ajax({
		dataType: "json",
		url: 'get-articles.php',
		success: function(data) {

			data.sort(function(a, b){
			  return new Date(b.pubDate) - new Date(a.pubDate);
			});

			for (var i=0; i<data.length; i++) {
				data[i]['pubDate'] = moment(data[i]['pubDate'], "YYYY-MM-DD hh:mm").fromNow();
			}
			
			app.articles = data;
			loadFinished();
		}
	});
}


function initVue() {
	app = new Vue({
		el: '#app',
		data: {
			articles: []
		}
	})
}


var app = null;
setup();
initVue();
getArticles();
