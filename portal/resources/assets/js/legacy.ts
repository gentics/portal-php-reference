export class Legacy {

	itemstock = document.querySelectorAll('.text-muted');

	constructor() {
		this.init();
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
}
