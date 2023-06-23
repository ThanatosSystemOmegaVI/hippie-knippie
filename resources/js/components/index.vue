<template>
	<div class="row">
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
			<img src="../../img/banner.png" class="img-fluid">
		</div>
		<!-- ----------------- Alle diensten ----------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-4">
			<div class="row">
				<!-- ----------------- Dienst ----------------- -->
				<div v-for="dienst in diensten" class="col-12 col-md-12 col-lg-12 col-xl-12 mb-4">
					<div id="dienst" class="shadow dienst h-100">
						<div class="d-flex">
							<span class="dienstNaam p-2 bg-white w-100 fw-bold">{{ dienst.naam }}</span>
							<span class="dienstPrijs p-2 bg-dark-purple fw-bold">€{{ dienst.prijs.includes('.00') ? dienst.prijs : dienst.prijs+'.00' }}</span>
						</div>
						<div class="d-flex h-100" v-if="dienst.omschrijving.lenght">
							<span class="dienstOmschrijving bg-light-purple p-2 w-100">{{ dienst.omschrijving }}</span>
								<div class="bg-light-purple d-flex options p-2 justify-content-between">
							</div>
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