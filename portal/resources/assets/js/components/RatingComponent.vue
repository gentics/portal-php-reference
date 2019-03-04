<template>
	<div>
		<div v-if="(!rates || rates.length === 0) && !ratingActive" class="feature-need-action">
			To activate ratings, you need to install and configure the <b>Likes Plugin</b> for Gentics Mesh.
		</div>
		<div :class="{ 'invisible': (!rates || rates.length === 0) }">
			<rating-stars :rates="rates" @toggle:rating-details="toggleRatingDetails"></rating-stars>
			<rating-details :rates="rates" :posted="posted" v-model="detailsVisible" @post:rating="postRating"></rating-details>
		</div>
	</div>
</template>

<script lang="ts">
	import { Vue, Component, Prop } from 'vue-property-decorator';
	import ApiService from '../api/ApiService';
	import RatingStarsComponent from "./RatingStarsComponent.vue";
	import RatingDetailsComponent from "./RatingDetailsComponent.vue";

	Vue.component('rating-stars', RatingStarsComponent);
	Vue.component('rating-details', RatingDetailsComponent);

	@Component
	export default class RatingComponent extends Vue {
		@Prop()
		nodeUuid!: string;

		@Prop()
		lang!: string;

		rates: any[] = [];
		posted: any;

		detailsVisible = false;
		ratingActive = true;

		toggleRatingDetails(value: boolean)
		{
			this.detailsVisible = value;
		}

		mounted()
		{
			this.loadRatings();
		}

		loadRatings()
		{
			ApiService
				.getRating(this.nodeUuid, this.lang)
				.then((response) => {
					this.rates = [];

					const data = response.data;
					const ratings = data.statistics.ratings;

					this.ratingActive = data.configuration ? data.configuration.active : false;
					this.posted = data.posted ? data.posted.rating : null;

					for ( let i in ratings ) {
						const rate = Number(i);
						const count = Number(ratings[i]);

						this.rates.push({ rate, count });
					}
				})
				.catch((err: any) => {
					if ( err.response.status >= 400 ) {
						this.ratingActive = false;
					}
				});
		}

		postRating(rating: number)
		{
			ApiService
				.postRating(this.nodeUuid, this.lang, Number(rating))
				.then((response) => {

					// Refresh ratings
					this.loadRatings();
				});
		}
	}
</script>
