// Initialize Legacy code, refactored to TypeScript
import { Legacy } from './legacy';

new Legacy();

// Initialize Vue Components
import Vue from "vue";
import RatingComponent from "./components/RatingComponent.vue";

Vue.component('rating', RatingComponent);

new Vue({
	el: '#app'
});
