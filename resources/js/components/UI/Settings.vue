<template>
<v-row dense>
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

    <v-col cols="12" md="6">
        <v-card class="mx-auto" max-width="400">
            <v-card-title>
                <v-icon large left>
                    mdi-feather
                </v-icon>
                <span class="title ">Upload Tanda Tangan</span>
            </v-card-title>

             <v-card-text>
                                <!-- <v-form >
                                    <input  label="Regular" type="file" v-on:change="onFileChange">
                                    <v-text-field label="Regular" type="file" v-on:change="onImageChange"></v-text-field>
                                    <q-input @input="val => { file = val[0] }" filled type="file" hint="File Scan" @change="uploadFile" />
                                </v-form> -->

                                <form @submit="formSubmit" enctype="multipart/form-data">
                                    
                                    <!-- <strong>Name:</strong>

                        <input type="text" class="form-control" v-model="name"> -->

                                    <strong>File:</strong>

                                    <input type="file" class="form-control" @change="onFileChange">



                                    <!-- <button class="btn btn-success">Submit</button> -->
                                     <v-card-actions>
                                <v-spacer />
                                <v-btn color="primary" @click="formSubmit">Proses</v-btn>
                            </v-card-actions>
                                </form>
                            </v-card-text>

            <!-- <v-row justify="center">
                <br><br><br><br>

                <v-btn class="mr-4" color="red darken-1" tile outlined @click="clear">
                    <v-icon left>mdi-eraser</v-icon>
                    clear
                </v-btn>
                <v-btn class="mr-4" color="primary" tile outlined >
                    <v-icon left>mdi-send</v-icon>submit
                </v-btn>
            </v-row> -->
            <!--     -->

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
    <v-snackbar  v-model="snackbar2"   :timeout="timeout" color="primary" top>
      <p>Upload tanda tangan berhasil</p>
      <v-btn
        color="white"
        text
        @click="snackbar2 = false"
      >
        Close
      </v-btn>
    </v-snackbar>

    

    </v-col>
</v-row>
    
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
            file: null,
            password_lama:'',
            password_baru:'',
            ulangi_password_baru:'',
            
            // notif
            snackbar: false,
            snackbar2: false,
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
                onFileChange(e) {

                console.log(e.target.files[0]);

                this.file = e.target.files[0];

            }, async formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                const configx = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        // 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                        //  Authorization: 'Bearer ' + localStorage.getItem('token')
                    }

                }
                let formData = new FormData();

                formData.append('file', this.file);

                // let data = new FormData(); 
                // data.append('file', this.avatar);
                // data.append('_method', 'put'); // add this
                // formData.append('_method', 'put'); 


                console.log('formData', formData)
                await axios.post('/upload_ttd',  formData, configx)
            //    await axios.post('/upload_ttd', {
            //        formDataX: formData
            //    })
                    .then(response => {
                        console.log(response)
                        this.snackbar2 = true
                    }).catch(error => {
                        console.log('error', error.response)
                    })
                   
            //    window.location.href = "/download_excel"
                

            },
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
