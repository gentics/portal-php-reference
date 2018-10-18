const deck = document.querySelector('.all-cards');
const cardtitles = document.querySelectorAll('.card-title');
const itemstock = document.querySelectorAll('.text-muted');
const searchfield = document.querySelector('.form-search');
const h1 = document.querySelector('h1');
const autocomplete = document.querySelector('.autocomplete');
const starreview = document.querySelector('.starReviews');

//MAKE THE WHOLE ITEM CARD CLICKABLE

deck.addEventListener('click', function (e) {
    if (e.target.parentNode.className == 'card' || e.target.parentNode.parentNode.className == 'card') {
        if (e.target.className == 'card-text' || e.target.className == 'price' || e.target.className == 'text-muted') {
            open(`${e.target.parentNode.parentNode.firstChild.nextSibling.textContent}.html`, '_self');
        } else {
            open(`${e.target.parentNode.firstChild.nextSibling.textContent}.html`, '_self');
        }
    }
});

//CHANGE STOCK TEXT COLORS ACCORDING TO STOCK LEVEL

for (var i = 0; i < itemstock.length; i++) {
    if (itemstock[i].textContent == "in stock") {
        itemstock[i].style = "color: green!important;";
    } else if (itemstock[i].textContent == "low stock number") {
        itemstock[i].style = "color: darkorange!important;";
    } else {
        itemstock[i].style = "color: red!important;";
    }
}

//BASIC SEARCH

searchfield.addEventListener('keyup', function (e) {
    for (var i = 0; i < cardtitles.length; i++) {
        if (searchfield.value == cardtitles[i].textContent) {
            cardtitles[i].parentNode.style = 'opacity: 1;';
        } else if (searchfield.value == '') {
            cardtitles[i].parentNode.style = '';
        }
        else {
            cardtitles[i].parentNode.style = 'opacity: 0.1;';
        }
    };
});

//SEARCH UI

function searchUi(e) {
    autocomplete.classList.remove('d-none');
}

function closeSearchUi(e) {
    autocomplete.classList.add('d-none');
}

//OPEN REVIEW

function openReview(e) {
    starreview.classList.remove('d-none');
}

var snapSlider = document.getElementById('slider-snap');

noUiSlider.create(snapSlider, {
	start: [ 0, 500 ],	
	connect: true,
	range: {
		'min': 0,
		'10%': 50,
		'20%': 100,
		'30%': 150,
		'40%': 500,
		'50%': 800,
		'max': 1000
	}
});