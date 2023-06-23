<template>
	<section class="p-4">
		<div class="row">
			<!-- ----------------- Titel ----------------- -->
			<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
				<h1 class="bg-white rounded-1 text-primary text-center">DASHBOARD</h1>
			</div>

			<!-- ----------------- Buttons ----------------- -->
			<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
				<div class="row">
					<div class="col-12 col-md-12 col-lg-6 col-xl-6">
						<button class="btn button btn-blocked btn-secondary w-100 mb-1" @click="toPage('/dashboard/diensten')">Diensten</button>
					</div>
					<div class="col-12 col-md-12 col-lg-6 col-xl-6">
						<button class="btn button btn-blocked btn-secondary w-100 mb-1" @click="toPage('/dashboard/contactverzoeken')">Contact Verzoeken</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	name: "Contactverzoeken",
	data() {
		return {
			//
		}
	},
	created() {
	},
	methods: {
		toPage: function (link) {
			location.href = link;
		}
	}
}
</script>