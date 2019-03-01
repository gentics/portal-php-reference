import Vue from "vue";
import RatingComponent from "./components/RatingComponent.vue";

Vue.component('rating', RatingComponent);

new Vue({
	el: '#app'
});
