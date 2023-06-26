<template>
	<div class="row">
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10">
			<h1 class="groupheader text-center w-100 mt-4">Diensten</h1>
		</div>
		<!-- ------------------------------------- Add ship button ------------------------------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-4">
			<div class="row">
				<div id="addbutton"
					class="offset-6 col-6 offset-md-6 col-md-6 offset-lg-8 col-lg-4 offset-xl-9 col-xl-3 addbutton position-relative" @click="dienstToevoegen()">
					<div class="button-default button-slanted bg-dark-purple text-white fw-bold pointer">
						<span class="button-slanted-content"><font-awesome-icon icon="fa-solid fa-plus" /> Dienst toevoegen</span>
					</div>
				</div>
			</div>
		</div>

		<!-- ----------------- Alle diensten ----------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-4">
			<div class="row">
				<!-- ----------------- Dienst ----------------- -->
				<div v-for="dienst in diensten" class="col-12 col-md-12 col-lg-4 col-xl-4 mb-4">
					<div id="dienst" class="shadow-sm dienst h-100">
						<div class="d-flex">
							<span class="dienstNaam p-2 bg-white w-100 fw-bold">{{ dienst.naam }}</span>
							<span class="dienstPrijs p-2 bg-dark-purple fw-bold">€{{ dienst.prijs.includes('.00') ? dienst.prijs : dienst.prijs+'.00' }}</span>
						</div>
						<div class="d-flex h-100">
							<span class="dienstOmschrijving bg-light-purple p-2 w-100">{{ dienst.omschrijving }}</span>
							<div class="bg-light-purple d-flex options p-2 justify-content-between">
								<font-awesome-icon icon="fa-solid fa-trash" class="deleteDienst" @click="deleteDienst(dienst)" />
								<font-awesome-icon icon="fa-solid fa-pen" class="editDienst" @click="editDienst(dienst)" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ----------------- Nieuwe dienst toevoegen POPUP ----------------- -->
		<div class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-1 col-xl-10 mt-4">
			<div class="popup shadow-sm p-2 bg-white rounded-2" v-if="showAddDienst">
				<!-- ----------------- Titel ----------------- -->
				<div class="row">
					<div class="col-12 position-relative">
						<h2 class="text-center text-dark-purple" v-if="this.editDienstID == 0">Dienst toevoegen</h2>
						<h2 class="text-center text-dark-purple" v-else>Edit ship</h2>
						<font-awesome-icon icon="fa-solid fa-xmark" class="position-absolute closepopup text-dark-purple fs-1" @click="this.showAddDienst = false" />
					</div>
				</div>
				<!-- ----------------- Inputs ----------------- -->
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
						<div class="row">
							<div class="col-12 col-md-12 col-lg-6 col-xl-6">
								<div class="input-group mb-1">
									<span class="input-group-text" id="basic-addon1"><font-awesome-icon icon="fa-solid fa-heading" /></span>
									<input type="text" id="title" class="form-control" placeholder="Dienst" v-model="nieuweDienst.naam">
								</div>
							</div>
							<div class="col-12 col-md-12 col-lg-6 col-xl-6">
								<div class="input-group mb-1">
									<span class="input-group-text" id="basic-addon1"><font-awesome-icon icon="fa-solid fa-euro-sign" /></span>
									<input type="text" id="prijs" class="form-control" placeholder="Prijs" v-model="nieuweDienst.prijs">
								</div>
							</div>
							<div class="col-12 col-md-12 col-lg-12 col-xl-12">
								<div class="input-group">
									<span class="input-group-text" id="basic-addon1"><font-awesome-icon icon="fa-solid fa-heading" /></span>
									<textarea id="omschrijving" class="form-control" row="4" placeholder="Omschrijving (optioneel)" v-model="nieuweDienst.omschrijving"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ----------------- Submit ----------------- -->
				<div class="row">
					<div class="col-12">
						<button class="btn button btn-dark-purple w-100 mt-2" v-if="this.editDienstID == 0" @click="dienstToevoegenSubmit()"><font-awesome-icon icon="fa-solid fa-plus" /> Dienst toevoegen</button>
						<button class="btn button btn-dark-purple w-100 mt-2" v-else @click="editDienstSubmit()"><font-awesome-icon icon="fa-solid fa-pen" />  Dienst aanpassen</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import '../../css/diensten.css';
export default {
	name: "Prijzen",
	data() {
		return {
			diensten: {},
			nieuweDienst: {
				naam: "",
				prijs: "",
				omschrijving: "",
			},
			showAddDienst: false,
			editDienstID: 0,
		}
	},
	created() {
		// Haal alle diensten op
		this.getDiensten();
	},
	methods: {
		dienstToevoegen: function () {
			this.refreshInputs();
			this.showAddDienst = true;
		},

		dienstToevoegenSubmit: function () {
			if (this.nieuweDienst.naam !== "" && this.nieuweDienst.prijs !== "") {
				//ajax
				this.axios.post("/adddienst", this.nieuweDienst).then(response => {
					if (response['data']['bool'] == "true") {
						this.$notify({ text: response['data']['message'], type: 'success', duration: 3000 });
						this.getDiensten();
						this.showAddDienst = false;
					} else {
						this.$notify({ text: response['data']['message'], type: 'error', duration: 3000 });
					}
				});
			} else {
				let messages = [];
				this.nieuweDienst.prijs === "" ? messages.push('het "Prijs" veld is verplicht') : null;
				this.nieuweDienst.naam === "" ? messages.push('het "Naam" veld is verplicht') : null;

				messages.forEach(element => {
					this.$notify({ text: element, type: 'warn', duration: 3000 });
				});
			}
		},

		// Edit ship in database
		editDienst: function (dienst) {
			if (dienst !== undefined && dienst !== null && dienst.id != "0") {
				this.refreshInputs();
				this.showAddDienst = true;
				this.editDienstID = dienst.id;
				this.nieuweDienst = Object.assign({}, dienst);
			}
		},

		editDienstSubmit: function () {
			if (this.nieuweDienst.naam !== "" && this.nieuweDienst.prijs !== "") {
				//ajax
				this.axios.post("/editdienst", this.nieuweDienst).then(response => {
					if (response['data']['bool'] == "true") {
						this.$notify({ text: response['data']['message'], type: 'success', duration: 3000 });
						this.getDiensten();
						this.showAddDienst = false;
					} else {
						this.$notify({ text: response['data']['message'], type: 'error', duration: 3000 });
					}
				});
			} else {
				let messages = [];
				this.nieuweDienst.prijs === "" ? messages.push('het "Prijs" veld is verplicht') : null;
				this.nieuweDienst.naam === "" ? messages.push('het "Naam" veld is verplicht') : null;

				messages.forEach(element => {
					this.$notify({ text: element, type: 'warn', duration: 3000 });
				});
			}
		},

		// Delete ship from database
		deleteDienst: function (dienst) {
			if (dienst !== undefined && dienst !== null && dienst.id != "0") {
				this.$swal({
					title: "Verwijderen",
					text: "Weet je het zeker dat je : " + dienst.naam + " wilt verwijderen?",
					type: "warning",
					showCancelButton: true,
					cancelButtonText: "Nee, toch niet!",
					confirmButtonColor: "#a10000",
					confirmButtonText: "Ja, verwijder!"
				}).then((result) => {
					if (result.value) {
						this.axios.post("/deletedienst", dienst).then(response => {
							if (response['data']['bool'] == "true") {
								this.$notify({ text: response['data']['message'], type: 'success', duration: 3000 });
								this.getDiensten();
							} else {
								this.$notify({ text: response['data']['message'], type: 'error', duration: 3000 });
							}
						});
					}
				});
			}
		},

		getDiensten: function () {
			this.axios.post("/getdiensten", {}).then(response => {
				this.diensten = response['data']['diensten'];
			});
		},

		refreshInputs: function () {
			this.editDienstID = 0;
			this.nieuweDienst = {
				naam: "",
				prijs: "",
				omschijving: "",
			}
		}
	}
}
</script>