<template>
	<div>
		
		<v-form ref="formlogin" @submit.prevent="submitLogin">
			<v-flex sm10>
				<v-text-field
				@keydown="changeEmail"
				:append-icon=" toggleEmail ? 'check' : '' "
				type="email"
				v-model="loginInput.email"
				label="Masukkan Email"
				data-vv-validate-on="keydown|changeEmail"
				data-vv-name="email"
				v-validate=" 'required|email' "
				:error-messages="errors.collect('email')"
				:success="checkEmail"
				></v-text-field>
			</v-flex>
			<v-flex sm10>
				<v-text-field
				:append-icon=" togglePassword ? 'visibility' : 'visibility_off' "
				:type=" togglePassword ? 'text' : 'password' "
				v-model="loginInput.password"
				label="Masukkan Password"
				data-vv-name="password"
				v-validate=" 'required|min:8' "
				:error-messages="errors.collect('password')"
				@click:append="togglePassword = !togglePassword"
				required
				:success="isPassPassed"
				></v-text-field>
				<v-progress-linear v-if="progressLogin" :indeterminate="true" />
                <v-alert 
                v-if="dataTidakBenar"
                type="error" 
                :value="true"
                icon="warning"
                outline>
                    Mohon isi data dengan benar
                </v-alert>
                <v-alert 
                v-if="isEmptyErrors"
                type="error" 
                :value="true"
                icon="warning"
                outline>
                    <ul>
                        <li v-for="errors in errorsForm">
                            {{ errors.toString() }}
                        </li>
                    </ul>
                </v-alert>
               	<v-alert 
                v-if="dataBenar"
                type="success" 
                :value="true"
                icon="check"
                outline>
                    Berhasil Masuk
                </v-alert>
			</v-flex>
			<div>
				<v-btn
				type="submit"
				:disabled = "!isComplete"
				>
				Submit
				</v-btn>
				<v-btn @click="resetForm">clear</v-btn>
			</div>
		</v-form>
		<v-divider class="divided"></v-divider>
		<v-flex>
			<div class="belumdaftar">
				Belum daftar?
				<a @click="$store.dispatch('clickLogin')">Daftar disini</a>
			</div>
		</v-flex>
        		
	</div> <!-- end of root parent -->
</template>

<script>
	import 'animate.css'

	export default {
		
		name: 'Login',
		
		data () {
			return {
				loginInput : {
					email: '',
					password: '',
				},
				checkEmail: false,
				checkPass: false,
				isEmptyErrors: false,
                errorsForm: {},
				toggleEmail: false,
				togglePassword: false,
				dataBenar: false,
				progressLogin: false,
				dataTidakBenar: false,
				dictionary: {
					custom: {
						email: {
							required: () => 'Email tidak boleh kosong',
							email: () => 'Harus diisi dengan email'
						},
						password: {
							required: () => 'Password tidak boleh kosong',
							min: () => 'Password minimal 8 karakter',
						}
					}
				}
			}
		},
		mounted() {
			this.$validator.localize('en', this.dictionary)
		},
		computed: {
			isComplete() {
				return this.loginInput.email && this.loginInput.password
			},
			isPassPassed() {
				return this.loginInput.password != '' ? this.checkPass = true : this.checkPass = false
			},
		},
		methods: {
			changeEmail() {
				this.$validator.validate('email', this.loginInput.email)
				.then((result) => {
					if (result) {
						this.checkEmail = true
						this.toggleEmail = true
					} else {
						this.checkEmail = false
						this.toggleEmail = false
					}
				})
			},
			submitLogin() {
        		this.$validator.validateAll()
        		.then((isValid) => {
                    if (isValid) {
                    	this.progressLogin = true
                    	this.dataBenar = false
                    	this.dataTidakBenar = false
                    	this.isEmptyErrors = false
                        this.$axios.post('/login', this.loginInput)
                        .then(response => localStorage.setItem('api_token', response.data.api_token))
                        .then(() => this.progressLogin = false)
                        .then(() => this.dataBenar = true)
                        .then(() => this.dataTidakBenar = false)
                        .then(() => this.isEmptyErrors = false)
                        .then(() => 
                        	setTimeout(() => { 
                        		this.$router.push('/home')
                        	}, 1500)
                        )
                        .catch((error) => {
                        	this.errorsForm = error.response.data
                            this.isEmptyErrors = true
                        	this.progressLogin = false 
                        	return this.dataBenar = false 
                        })
                    } else {
                        this.dataTidakBenar = true
                        this.isEmptyErrors = false
                        this.dataBenar = false
                    }
                })
			},
			resetForm() {
				this.$refs.formlogin.reset()
				this.$validator.reset()
				this.togglePassword = false
				this.toggleEmail = false
				this.progressLogin = false 
            	this.dataTidakBenar = false
            	this.isEmptyErrors = false
            	this.dataBenar = false 
				return false
			}

		}

	}
</script>

<style lang="css" scoped>
	.divided {
		border-color: green;
		margin-top: 10px;
	}

	.belumdaftar {
		margin-top: 12px;
		font-size: 20px;
	}

	a {
		text-decoration: none;
		color: teal;
	}

	li {
		list-style: none;
	}

</style>