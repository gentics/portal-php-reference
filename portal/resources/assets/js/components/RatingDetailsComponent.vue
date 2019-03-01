<template>
	<div class="starReviews col-xl-4 col-lg-3 col-sm-8 row" :class="{ 'd-none': !visible }" v-on-clickaway="close">
		<div class="review-left col-lg-6 col-sm-12">
			<div v-for="rate in ratesReversed" class="progress">
				<div class="progress-bar text-left pl-2" role="progressbar" :style="'width: ' + getRatePercentage(rate) + '%'" :aria-valuenow="getRatePercentage(rate)" aria-valuemin="0" aria-valuemax="100"
					 :title="getRatePercentage(rate) + '%'">{{ rate.rate }} star</div>
			</div>
		</div>
		<div class="review-right col-lg-6 col-sm-12">
			<p class="mb-0 mt-3">{{ posted !== null ? `You rated this for ${posted} stars` : 'Leave your rating' }}</p>
			<div class="rating-stars text-center pt-3">
				<a v-for="(rate, i) in ratesReversed" :class="['r' + (i + 1), { 'active': isStarActive(rate) }]" @click="setRate(rate)">
					<i class="fas fa-star"></i>
				</a>
			</div>
		</div>
	</div>
</template>

<script lang="ts">
	import { Component, Prop, Watch, Model } from 'vue-property-decorator';
	import { mixins } from 'vue-class-component'
	import { mixin as clickaway } from 'vue-clickaway';

	@Component
	export default class RatingDetailsComponent extends mixins(clickaway) {
		@Model('toggle:rating-details', { type: Boolean }) readonly visible!: boolean;

		@Prop()
		rates!: any[];

		@Prop()
		posted!: any;

		ratingCount = 0;
		avgRating = 0;

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

		getRatePercentage(rate: any)
		{
			const percentage = Number((rate.count / this.ratingCount) * 100);
			return !isNaN(percentage) ? percentage : 0;
		}

		get ratesReversed()
		{
			return this.rates.slice().reverse();
		}

		isStarActive(rate: any)
		{
			return Number(this.posted) >= rate.rate;
		}

		setRate(rate: any)
		{
			this.$emit("post:rating", Number(rate.rate));
		}

		close()
		{
			this.$emit("toggle:rating-details", false);
		}
	}
</script>
