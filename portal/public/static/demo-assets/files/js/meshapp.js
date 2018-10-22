const deck = document.querySelector('.all-cards');
const cardtitles = document.querySelectorAll('.card-title');
const itemstock = document.querySelectorAll('.text-muted');
const searchfield = document.querySelector('.form-search');
const starreview = document.querySelector('.starReviews');

//MAKE THE WHOLE ITEM CARD CLICKABLE

if (deck) {
	deck.addEventListener('click', function (e) {
		if (e.target.parentNode.className == 'card' || e.target.parentNode.parentNode.className == 'card') {
			if (e.target.className == 'card-text' || e.target.className == 'price' || e.target.className == 'text-muted') {
				open(`${e.target.parentNode.parentNode.firstChild.nextSibling.textContent}.html`, '_self');
			} else {
				open(`${e.target.parentNode.firstChild.nextSibling.textContent}.html`, '_self');
			}
		}
	});
}

// //CHANGE STOCK TEXT COLORS ACCORDING TO STOCK LEVEL

// for (var i = 0; i < itemstock.length; i++) {
// 	if (itemstock[i].textContent == "in stock") {
// 		itemstock[i].style = "color: green!important;";
// 	} else if (itemstock[i].textContent == "low stock number") {
// 		itemstock[i].style = "color: darkorange!important;";
// 	} else {
// 		itemstock[i].style = "color: red!important;";
// 	}
// }

//BASIC SEARCH

searchfield.addEventListener('keyup', function (e) {
	for (var i = 0; i < cardtitles.length; i++) {
		if (searchfield.value == cardtitles[i].textContent) {
			cardtitles[i].parentNode.style = 'opacity: 1;';
		} else if (searchfield.value == '') {
			cardtitles[i].parentNode.style = '';
		} else {
			cardtitles[i].parentNode.style = 'opacity: 0.1;';
		}
	};
});

//OPEN REVIEW

function openReview(e) {
	starreview.classList.remove('d-none');
}
