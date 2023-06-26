<template>
	<section class="p-4"> 
		<div class="row">
			<!-- ----------------- Alle diensten ----------------- -->
			<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 my-4">
				<div class="row">
					<!-- ----------------- Dienst ----------------- -->
					<div v-for="dienst in diensten" class="col-12 col-md-12 col-lg-12 col-xl-12 mb-4">
						<div id="homeDienst" class="homeDienst">
							<div class="d-flex">
								<span class="homeDienstNaam p-2 fs-4 bg-white w-100 fw-bold">{{ dienst.naam }}</span>
								<span class="homeDienstPrijs p-2 fs-3 bg-dark-purple fw-bold">€{{ dienst.prijs.includes('.00') ?
									dienst.prijs : dienst.prijs + '.00' }}</span>
							</div>
							<div class="d-flex" v-if="dienst.omschrijving.length > 0">
								<span class="homeDienstOmschrijving bg-light-purple p-2 w-100">{{ dienst.omschrijving }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- ----------------- contact formulier ----------------- -->
			<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-2 mb-5">
				<div id="contactform" class="contactform">
					<div class="row">
						<div class="col-12 col-md-12 col-lg-6 col-xl-6">
							<img src="../../img/contact.webp" class="img-fluid" @click="toPage('/')" alt="logo">
						</div>
						<div class="col-12 col-md-12 col-lg-6 col-xl-6">
							<h1 class="text-center mb-2">Neem contact op</h1>
							<!-- Name -->
							<div class="mb-2">
								<input type="text" id="formName" v-model="contactverzoek.naam" class="form-control form-control-lg thick" placeholder="Naam">
							</div>
							<!-- E-mail -->
							<div class="mb-2">
								<input type="email" id="formEmail" v-model="contactverzoek.email" class="form-control form-control-lg thick" placeholder="E-mail">
							</div>
							<!-- Onderwerp -->
							<div class="mb-2">
								<input type="email" id="formEmail" v-model="contactverzoek.onderwerp" class="form-control form-control-lg thick" placeholder="Onderwerp">
							</div>
							<!-- Message -->
							<div class="mb-2">
								<textarea id="formMessage" v-model="contactverzoek.bericht" class="form-control form-control-lg" rows="5" placeholder="Bericht"></textarea>
							</div>
							<!-- Submit -->
							<button type="submit" @click="submitContactForm()" class="btn btn-dark-purple secondary w-100" tabIndex="-1">Send message</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
import '../../css/index.css';
export default {
	name: "Home",
	data() {
		return {
			diensten: {},
			contactverzoek: {
				naam: "",
				email: "",
				onderwerp: "",
				bericht: "",
			},
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

		submitContactForm: function () {
			if (this.contactverzoek.naam !== "" && this.contactverzoek.email !== "" && this.contactverzoek.onderwerp !== "" && this.contactverzoek.bericht !== "") {
				this.axios.post("/addcontactverzoek", this.contactverzoek).then(response => {
					if (response['data']['bool'] == "true") {
						this.$notify({ text: response['data']['message'], type: 'success', duration: 3000 });
						this.refreshContactVerzoek();
					} else {
						this.$notify({ text: response['data']['message'], type: 'error', duration: 3000 });
					}
				});
			} else {
				let messages = [];
				this.contactverzoek.bericht === "" ? messages.push('het "Text" veld is verplicht') : null;
				this.contactverzoek.onderwerp === "" ? messages.push('het "Onderwerp" veld is verplicht') : null;
				this.contactverzoek.email === "" ? messages.push('het "E-mail" veld is verplicht') : null;
				this.contactverzoek.naam === "" ? messages.push('het "Naam" veld is verplicht') : null;

				messages.forEach(element => {
					this.$notify({ text: element, type: 'warn', duration: 3000 });
				});
			}
		},

		refreshContactVerzoek: function () {
			this.contactverzoek = {
				naam: "",
				email: "",
				onderwerp: "",
				bericht: "",
			};
		},
	}
}
</script>