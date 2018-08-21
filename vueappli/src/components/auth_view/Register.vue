<template>
    <div>

        <v-form ref="formregister" @submit.prevent="submitLogin">
            <v-flex sm10>
                <v-text-field
                @keydown="changeName"
                :append-icon=" toggleName ? 'check' : '' "
                type="text"
                v-model="registerInput.name"
                label="Masukkan Nama"
                data-vv-name="name"
                v-validate=" 'required' "
                :error-messages="errors.collect('name')"
                :success="checkName"
                required
                ></v-text-field>
            </v-flex>
            <v-flex sm10>
                <v-text-field
                @keydown="changeEmail"
                :append-icon=" toggleEmail ? 'check' : '' "
                type="email"
                v-model="registerInput.email"
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
                v-model="registerInput.password"
                label="Masukkan Password"
                data-vv-name="password"
                name="pw_confirm"
                ref="pw_confirm"
                v-validate=" 'required|min:8' "
                :error-messages="errors.collect('password')"
                @click:append="togglePassword = !togglePassword"
                required
                :success="isPassPassed"
                ></v-text-field>
            </v-flex>
            <v-flex sm10>
                <v-text-field
                :append-icon=" toggleConfirmPassword ? 'visibility' : 'visibility_off' "
                :type=" toggleConfirmPassword ? 'text' : 'password' "
                v-model="confirmPassword"
                label="Konfirmasi Password"
                data-vv-name="confirmPassword"
                v-validate=" 'required|confirmed:pw_confirm' "
                :error-messages="errors.collect('confirmPassword')"
                @click:append="toggleConfirmPassword = !toggleConfirmPassword"
                :success="isPassPassed"
                required
                ></v-text-field>
                <v-progress-linear v-if="progressRegister" :indeterminate="true" />
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
                            {{ errors[0] }}
                        </li>
                    </ul>
                </v-alert>
                <v-alert 
                v-if="dataBenar"
                type="success" 
                :value="true"
                icon="check"
                outline>
                    Berhasil Registrasi
                </v-alert>
            </v-flex>
            <v-btn
            type="submit"
            :disabled = "!isComplete"
            >
            Submit
            </v-btn>
            <v-btn @click="resetForm">clear</v-btn>
        </v-form>
        <v-divider class="divided"></v-divider>
        <v-flex>
            <div class="balikkedaftar">
                <a @click="$store.dispatch('clickLogin')">Kembali Ke Login</a>
            </div>
        </v-flex>
    </div>
</template>

<script>
    import 'animate.css'

    export default {

        name: 'Register',

        data () {
            return {
                registerInput: {
                    name: '',
                    email: '',
                    password: '',
                },                
                confirmPassword: '',
                checkName: false,
                checkEmail: false,
                isEmptyErrors: false,
                errorsForm: {},
                checkPass: false,
                toggleName: false,
                toggleEmail: false,
                togglePassword: false,
                toggleConfirmPassword: false,
                dataBenar: false,
                dataTidakBenar: false,
                progressRegister: false,
                dictionary: {
                    custom: {
                        name: {
                            required: () => 'Nama tidak boleh kosong'
                        },
                        email: {
                            required: () => 'Email tidak boleh kosong',
                            email: () => 'Harus diisi dengan email'
                        },
                        password: {
                            required: () => 'Password tidak boleh kosong',
                            min:() => 'Password Minimal 8 Karakter'
                        },
                        confirmPassword: {
                            required: () => 'Harus diisi',
                            confirmed: () => 'Password Harus Sama'
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
                return this.registerInput.name && this.registerInput.email && this.registerInput.password && this.confirmPassword
            },
            isPassPassed() {
                return (this.registerInput.password != '' || this.confirmPassword != '') ? this.checkPass = true : this.checkPass = false
            },
        },
        methods: {
            changeName() {
                this.$validator.validate('name', this.registerInput.name)
                .then((result) => {
                    if (result) {
                        this.checkName = true
                        this.toggleName = true
                    } else {
                        this.checkName = false
                        this.toggleName = false
                    }
                })
            },
            changeEmail() {
                this.$validator.validate('email', this.registerInput.email)
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
                        this.progressRegister = true
                        this.dataBenar = false
                        this.dataTidakBenar = false
                        this.isEmptyErrors = false
                        this.emailExists = ''
                        this.$axios.post('/register', this.registerInput)
                        .then(response => localStorage.setItem('api_token', response.data.api_token))
                        .then(() => this.progressRegister = false)
                        .then(() => this.dataBenar = true)
                        .then(() => this.isEmptyErrors = false)
                        .then(() => {
                            setTimeout(() => { 
                                this.$router.push('/home')
                            }, 1500)
                        })
                        .catch((error) => {
                            this.errorsForm = error.response.data
                            this.isEmptyErrors = true
                            this.progressRegister = false 
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
                this.$refs.formregister.reset()
                this.$validator.reset()
                this.toggleName = false
                this.togglePassword = false
                this.toggleEmail = false
                this.toggleConfirmPassword = false
                this.progressRegister = false
                this.dataTidakBenar = false
                this.textDataTidakBenar = false
                this.isEmptyErrors = false
                this.emailExists = ''
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

    .balikkedaftar {
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