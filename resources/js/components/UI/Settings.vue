<template>
    <v-col cols="12" md="6">
        <v-card class="mx-auto" max-width="400">
            <v-card-title>
                <v-icon large left>
                    mdi-key
                </v-icon>
                <span class="title ">Ganti Password</span>
            </v-card-title>

            <v-card-text class=" ">
                <v-text-field v-model="password_lama" :error-messages="password_lamaErrors" required
                    @input="$v.password_lama.$touch()" @blur="$v.password_lama.$touch()" type="password"
                    label="Password Lama"></v-text-field>

                <v-text-field v-model="password_baru" :error-messages="password_baruErrors" required
                    @input="$v.password_baru.$touch()" @blur="$v.password_baru.$touch()" type="password"
                    label="Password Baru"></v-text-field>

                <v-text-field v-model="ulangi_password_baru" :error-messages="ulangi_password_baruErrors" required
                    @input="$v.ulangi_password_baru.$touch()" @blur="$v.ulangi_password_baru.$touch()" type="password"
                    label="Ulangi Password Baru"></v-text-field>
            </v-card-text>

            <v-row justify="center">
                <br><br><br><br>

                <v-btn class="mr-4" color="red darken-1" tile outlined @click="clear">
                    <v-icon left>mdi-eraser</v-icon>
                    clear
                </v-btn>
                <v-btn class="mr-4" color="primary" tile outlined @click="submit">
                    <v-icon left>mdi-send</v-icon>submit
                </v-btn>
            </v-row>
            <br><br>

        </v-card>

        <v-snackbar  v-model="snackbar"   :timeout="timeout" :color="snackbar_color" top>
      {{ text }}
      <v-btn
        color="white"
        text
        @click="snackbar = false"
      >
        Close
      </v-btn>
    </v-snackbar>

    </v-col>
</template>

<script>
    import {
        validationMixin
    } from 'vuelidate'
    import {
        required,
        minLength,
        email
    } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],

        validations: {
            password_lama: {
                required,
                minLength: minLength(8)
            },
            password_baru: {
                required,
                minLength: minLength(8)
            },
            ulangi_password_baru: {
                required,
                minLength: minLength(8)
            },
        },
        data: () => ({
            password_lama:'',
            password_baru:'',
            ulangi_password_baru:'',
            
            // notif
            snackbar: false,
            text: 'Ada error',
            timeout: 2000,
            snackbar_color: 'red'

        }),
        computed: {
            password_lamaErrors() {
                const errors = []
                if (!this.$v.password_lama.$dirty) return errors
                !this.$v.password_lama.minLength && errors.push('minimal 8 karakter') 
                !this.$v.password_lama.required && errors.push('Password is required.')
                return errors
            },
            password_baruErrors() {
                const errors = []
                if (!this.$v.password_baru.$dirty) return errors
                !this.$v.password_baru.minLength && errors.push('minimal 8 karakter') 
                !this.$v.password_baru.required && errors.push('Password is required.')
                return errors
            },
             ulangi_password_baruErrors() {
                const errors = []
                if (!this.$v.ulangi_password_baru.$dirty) return errors
                !this.$v.ulangi_password_baru.minLength && errors.push('minimal 8 karakter') 
                !this.$v.ulangi_password_baru.required && errors.push('Password is required.')
                return errors
            },
        },
            methods: {
                async submit(){
                    this.$v.$touch()
                    
                    if (this.password_lama === null || this.password_baru === null || this.ulangi_password_baru === null) {

                        this.snackbar = true
                    }
                    if (this.password_baru != this.ulangi_password_baru){
                         this.text = 'Password baru yang kamu ketik ga sama :('
                         this.snackbar = true   
                         
                    } 
                    else {
                        var resp
                        await axios.post('/ganti_password', {
                            password_lama: this.password_lama,
                            password_baru: this.password_baru,
                            ulangi_password_baru: this.ulangi_password_baru
                        }).then(function (response) {
                            console.log(response);
                            console.log('response data',response.data);
                            resp=response.data
                        })
                          if (resp === 'berhasil') {
                                this.text = 'Password berhasil diubah'
                                this.snackbar_color = 'green'
                                this.snackbar = true   
                            } else {
                                this.text = 'Password gagal diubah'
                                this.snackbar = true   
                            }
                        // this.clear()
                    }
                },
                clear() {
                    this.$v.$reset()
                    this.password_lama = null,
                    this.password_baru = null,
                    this.ulangi_password_baru = null
                       
                }
            }

        }

    

</script>
