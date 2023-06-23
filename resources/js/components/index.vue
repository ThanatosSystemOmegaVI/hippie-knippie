<template>
	<div class="row">
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
			<h1 class="groupheader text-center w-100">Prijzen lijst</h1>
		</div>
		<!-- ----------------- Alle diensten ----------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 my-4">
			<div class="row">
				<!-- ----------------- Dienst ----------------- -->
				<div v-for="dienst in diensten" class="col-12 col-md-12 col-lg-12 col-xl-12 mb-4">
					<div id="homeDienst" class="homeDienst">
						<div class="d-flex">
							<span class="homeDienstNaam p-2 fs-4 bg-white w-100 fw-bold">{{ dienst.naam }}</span>
							<span class="homeDienstPrijs p-2 fs-3 bg-dark-purple fw-bold">€{{ dienst.prijs.includes('.00') ? dienst.prijs : dienst.prijs+'.00' }}</span>
						</div>
						<div class="d-flex" v-if="dienst.omschrijving.length > 0">
							<span class="homeDienstOmschrijving bg-light-purple p-2 w-100">{{ dienst.omschrijving }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import '../../css/index.css';
export default {
	name: "Home",
	data() {
		return {
			diensten: {},
		}
	},
	created() {
		this.getDiensten();
	},
	methods: {
		getDiensten: function () {
			this.axios.post("/getdiensten", {}).then(response => {
				this.diensten = response['data']['diensten'];
			});
		},
	}
}
</script>