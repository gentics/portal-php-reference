// Initialize Legacy code, refactored to TypeScript
import { Legacy } from './legacy';

// Initialize Vue Components
import Vue from "vue";
import RatingComponent from "./components/RatingComponent.vue";

// Components
Vue.component('rating', RatingComponent);

// Start Vue
new Vue({
	el: '#app',
    mounted: () => {
	    // Load legacy code after Vue initialized
        // Because some event listeners need to be created
        new Legacy();
    }
});
