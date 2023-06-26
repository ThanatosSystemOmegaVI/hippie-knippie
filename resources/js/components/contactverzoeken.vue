<template>
	<div class="row">
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
			<h1 class="groupheader text-center w-100 mt-4">Contact verzoeken</h1>
		</div>

		<!-- ----------------- Alle contact verzoeken ----------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-4">
			<div class="row">
				<!-- ----------------- Contact Verzoeken ----------------- -->
				<div v-for="verzoek in contactVerzoeken" class="col-12 col-md-12 col-lg-12 col-xl-12 mb-2">
					<div id="verzoek" class="shadow-sm verzoek h-100">
						<div class="row pointer" data-bs-toggle="collapse" v-bind:data-bs-target="'#bericht' + verzoek.id">
							<div class="col-12 col-md-12 col-lg-6 col-xl-6 pe-lg-0 pe-xl-0">
								<p class="verzoekNaam p-2 bg-white w-100 fw-bold truncate m-0">{{  verzoek.naam }}</p>
							</div>
							<div class="col-12 col-md-12 col-lg-6 col-xl-6 ps-lg-0 ps-xl-0">
								<p class="dverzoekPrijs p-2 bg-dark-purple w-100 fw-bold truncate m-0">{{ verzoek.email }}</p>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-md-12 col-lg-12 col-xl-12">
								<p class="verzoekOndnerwerp bg-light-purple p-2 w-100 m-0 pointer" data-bs-toggle="collapse" v-bind:data-bs-target="'#bericht' + verzoek.id"> <b>{{verzoek.date }}:</b> {{ verzoek.onderwerp }}</p>
							</div>
							<div class="col-12 col-md-12 col-lg-12 col-xl-12">
								<p class="verzoekBericht p-2 w-100 collapse m-0 pointer" v-bind:id="'bericht' + verzoek.id">{{ verzoek.bericht }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</template>

<script>
import '../../css/contactverzoeken.css';
export default {
	name: "Contactverzoeken",
	data() {
		return {
			contactVerzoeken: {},
		}
	},
	created() {
		// Haal alle diensten op
		this.getContactVerzoeken();
	},
	methods: {
		getContactVerzoeken: function () {
			this.axios.post("/getcontactverzoeken", {}).then(response => {
				this.contactVerzoeken = response['data']['contactverzoeken'];
			});
		},
	}
}
</script>