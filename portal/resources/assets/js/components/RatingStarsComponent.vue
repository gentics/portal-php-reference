<template>
	<div>
		<div class="rating-stars text-left d-inline-block">
			<i v-for="rate in ratesReversed" :class="getRateClass(rate)" @click="toggleDetails"></i>
		</div>
		<a class="reviews" href="#" @click="toggleDetails">{{ ratingCount }} {{ ratingCount | pluralize('en', ['rating', 'ratings']) }}</a>
	</div>
</template>

<script lang="ts">
	import { Vue, Component, Prop, Watch } from 'vue-property-decorator';
	import VueFilterPluralize from 'vue-filter-pluralize';
	Vue.use(VueFilterPluralize);

	@Component
	export default class RatingStarsComponent extends Vue {
		@Prop()
		rates!: any[];

		@Prop()
		detailsTrigger!: boolean;

		ratingCount = 0;
		avgRating = 0;

		get ratesReversed()
		{
			return this.rates.slice().reverse();
		}

		@Watch('rates')
		onRatesChanged(rates: any[])
		{
			let rateCount = 0;
			let rateSum = 0;

			for ( let i in rates ) {
				const rate = rates[i];

				rateSum += rate.rate * rate.count;
				rateCount += rate.count;
			}

			this.ratingCount = rateCount;
			this.avgRating = rateSum / rateCount;
		}

		toggleDetails()
		{
			// Workaround: to prevent closing before its opened
			setTimeout(() => {
				this.$emit("toggle:rating-details", true);
			});
		}

		getRateClass(rate: any)
		{
			if (rate.rate <= this.avgRating) {
				return 'fas fa-star';
			} else if (rate.rate > Math.floor(this.avgRating) && rate.rate === Math.ceil(this.avgRating)) {
				return 'fas fa-star-half-alt';
			} else {
				return 'far fa-star';
			}
		}
	}
</script>
