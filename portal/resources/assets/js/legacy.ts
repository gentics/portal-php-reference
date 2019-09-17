export class Legacy {

	itemstock = document.querySelectorAll('.text-muted');

	constructor() {
		this.init();
		this.autocompleteInit();
	}

	init() {
		for (let i = 0; i < this.itemstock.length; i++) {
			let elem = this.itemstock[i] as HTMLElement;

			if (elem.textContent == "in stock") {
				elem.style.cssText = "color: green !important;";
			} else if (elem.textContent == "low stock number") {
				elem.style.cssText = "color: darkorange !important;";
			} else {
				elem.style.cssText = "color: red !important;";
			}
		}


	}

	autocompleteInit() {
		if(document.createElement("datalist").options) {
			const searchInput = document.querySelector('#searchInput') as any;
			searchInput.addEventListener('input', (e: any) => {
				let val = (e.target as HTMLInputElement).value;
				if(val === "") {
					this.emptyDataList();
					return;
				}

				const url = '/api/search/autocomplete?q=' + val;

				fetch(url)
				.then((response) => {
						if (response.status !== 200) {
							console.warn('Looks like there was a problem. Status Code: ' +
								response.status);
							return;
						}

						// Examine the text in the response
						response.json().then((data) => {
							let option;
							const dataList = document.getElementById('autocompleteresults') as HTMLDataListElement;
							this.emptyDataList();

							for (let i = 0; i < data.length; i++) {
								option = document.createElement('option');
								option.text = data[i].name;
								option.value = data[i].name;
								dataList.appendChild(option);
							}
						});
					}
				)
				.catch(function(err) {
					console.error('Fetch Error -', err);
				});
			}, true);
		}
	}

	emptyDataList() {
		const dataList = document.getElementById('autocompleteresults') as HTMLDataListElement;

		let child = dataList.lastElementChild;
		while (child) {
			dataList.removeChild(child);
			child = dataList.lastElementChild;
		}
	}
}
