<template>
	<div>
		<v-layout wrap fill-height>
			<v-flex xs12 sm3>
				<v-card class="card-bordered">
					<v-container pb-0>
						<v-layout row wrap>
							<v-flex sm6 pt-0>
								<v-icon size="45" color="black">person</v-icon>  
							</v-flex>
							<v-flex sm6 pt-0>
								<v-card-title primary-title class="card-fonting">
									50
								</v-card-title>	
							</v-flex>
						</v-layout>	
					</v-container>
					<v-divider class="divided"></v-divider>
					<v-card-title primary-title class="title-pads">
						User
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs12 sm3>
				<v-card class="card-bordered">
					<v-container pb-0>
						<v-layout row wrap>
							<v-flex sm6 pt-0>
								<v-icon size="45" color="black">person</v-icon>  
							</v-flex>
							<v-flex sm6 pt-0>
								<v-card-title primary-title class="card-fonting">
									50
								</v-card-title>	
							</v-flex>
						</v-layout>	
					</v-container>
					<v-divider class="divided"></v-divider>
					<v-card-title primary-title class="title-pads">
						User
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs12 sm3>
				<v-card class="card-bordered">
					<v-container pb-0>
						<v-layout row wrap>
							<v-flex sm6 pt-0>
								<v-icon size="45" color="black">person</v-icon>  
							</v-flex>
							<v-flex sm6 pt-0>
								<v-card-title primary-title class="card-fonting">
									50
								</v-card-title>	
							</v-flex>
						</v-layout>	
					</v-container>
					<v-divider class="divided"></v-divider>
					<v-card-title primary-title class="title-pads">
						User
					</v-card-title>
				</v-card>
			</v-flex>
			<v-flex xs12 sm3>
				<v-card class="card-bordered">
					<v-container pb-0>
						<v-layout row wrap>
							<v-flex sm6 pt-0>
								<v-icon size="45" color="black">person</v-icon>  
							</v-flex>
							<v-flex sm6 pt-0>
								<v-card-title primary-title class="card-fonting">
									50
								</v-card-title>	
							</v-flex>
						</v-layout>	
					</v-container>
					<v-divider class="divided"></v-divider>
					<v-card-title primary-title class="title-pads">
						User
					</v-card-title>
				</v-card>
			</v-flex>
		</v-layout>
	</div>
</template>

<script>
	import 'animate.css'

	export default {

		name: 'Dashboard',
		mounted() {
			document.title = "Home"
		},
		data () {
			return {

			}
		}
	}
</script>

<style lang="css" scoped>
	.card-bordered {
		box-shadow: 0px 7px 10px -3px rgba(0,0,0,0.75);
	}

	.card-fonting {
		font-weight: bold;
		padding-top: 0;
		font-size: 35px;
		padding-bottom: 5px;
	}

	.title-pads {
		padding-top: 0;
		justify-content: center;
		font-size: 25px;
		font-weight: bold;
		padding-bottom: 5px;
	}

	.divided {
		background-color: cyan;
		padding: 1.3px;
	}

</style>