<template>
    <div>
        <!-- <v-container>
            <v-card elevation=8 class="pa-md-4 mx-lg-auto">
                <v-select :items="pilihan_bulan" label="Bulan" v-model="bulan" @input="pilihBulan(bulan)"></v-select>
            </v-card>
        </v-container> -->

         <v-container>
            <v-hover  v-slot:default="{ hover }"
        open-delay="200">
                
                    <v-card  class="pa-md-4 mx-lg-auto" :elevation="hover ? 24 : 6">
                        <v-select :items="pilihan_pegawai" name="name" item-text="name" item-value="id" label="Pilih Pegawai" v-model="pegawai" @input="pilihPegawai(pegawai)"></v-select>
                    </v-card>
              
            </v-hover>
        </v-container>

         <v-container fluid>
            <v-hover v-slot:default="{ hover }">
               
                    <v-card class="pa-md-4 mx-lg-auto raised" :elevation="hover ? 24 : 6">
                        <v-row dense>


                            <v-col cols="12">
                                <v-card-title class="primary--text">
                                      <v-icon large color="primary">mdi-account-tie</v-icon> Daftar CKP {{selected_pegawai}}
                                    <v-spacer></v-spacer>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                        hide-details></v-text-field>

                                </v-card-title>
                                
                                <!-- {{ this.ckpt_view }} -->
                                <!-- loading loading-text="Loading... Please wait" -->
                                <v-data-table :headers="headers2" :items="daftar_bulan_view" class="elevation-1" :search="search">
                                
                                    <template v-slot:item.jenis_kegiatan="{ item }">

                                        {{ item.bulan }}
                                    </template>

                                    <template v-slot:item.aksi="{ item }">

                                        <!-- <v-btn color="primary" fab x-small dark @click="editDialog(item)"> -->
                                            <!-- <v-icon  color="primary" @click="show(item)">mdi-eye</v-icon> -->
                                        <!-- </v-btn> -->

                                        <!-- <v-btn color="error" fab x-small dark @click="deleteDialog(item)">
                                            <v-icon small @click="deleteDialog(item)">mdi-delete</v-icon>
                                        </v-btn> -->
                                        <v-tooltip bottom>
                                            <template v-slot:activator="{ on }">
                                                <v-icon  color="primary" @click="showCkp(item)" v-on="on">mdi-eye</v-icon>
                                            </template>
                                            <span>Lihat CKP Bulan ini</span>
                                        </v-tooltip>
                                    </template>

                                

                                    <!-- <template v-slot:item.bulan="{ item }">

                                        {{ item.bulan }}
                                    </template> -->
                                </v-data-table>

                            </v-col>
                        </v-row>
                    </v-card>
               
            </v-hover>
        </v-container>

        

        <br>
        <v-container fluid>
            <v-hover v-slot:default="{ hover }">
            <v-card class="pa-md-4 mx-lg-auto raised" :elevation="hover ? 24 : 6">
                <v-row dense>


                    <v-col cols="12">
                        <v-card-title class="primary--text">
                            <v-icon large color="primary">mdi-account-tie</v-icon>Daftar CKP {{selected_pegawai}}
                            <!-- <br>
                            <v-btn class="ma-2" tile outlined color="success">
                            <v-icon left>mdi-pencil</v-icon> Edit
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field> -->

                        </v-card-title>
                        <v-card-title class="primary--text">
                             <v-icon large color="primary">mdi-numeric-9-plus-box-multiple-outline</v-icon> Nilai CKP : {{ratarata_ckp_view}} 
                        </v-card-title>
                        <v-card-title>

                            <v-btn small class="ma-2" tile outlined color="primary" @click="realisasiDialog()">
                                <v-icon left>mdi-pencil</v-icon> Penilaian
                            </v-btn>
                              <!-- <v-btn small class="ma-2" tile outlined color="success" @click="downloadExcel()">
                                <v-icon left>mdi-file-excel</v-icon> Download Excel
                            </v-btn> -->
                            
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field>

                        </v-card-title>
                        <!-- {{ this.ckpt_view }} -->
                        <!-- loading loading-text="Loading... Please wait" -->
                       <v-data-table :headers="headers" :items="ckpt_view" class="elevation-1" :search="search">
                           
                            <template v-slot:item.jenis_kegiatan="{ item }">

                                {{ item.jenis_kegiatan }}
                            </template>

                            <template v-slot:item.uraian_kegiatan="{ item }">

                                {{ item.uraian_kegiatan }}
                            </template>

                            <template v-slot:item.satuan="{ item }">

                                {{ item.satuan }}
                            </template>

                            <template v-slot:item.target_kuantitas="{ item }">

                                {{ item.target_kuantitas }}
                            </template>

                            <template v-slot:item.kode_butir_kegiatan="{ item }">

                                {{ item.kode_butir_kegiatan }}
                            </template>

                            <template v-slot:item.angka_kredit="{ item }">

                                {{ item.angka_kredit }}
                            </template>

                            <template v-slot:item.keterangan="{ item }">

                                {{ item.keterangan }}
                            </template>

                            <!-- <template v-slot:item.bulan="{ item }">

                                {{ item.bulan }}
                            </template> -->
                        </v-data-table>

                    </v-col>
                </v-row>
            </v-card>
            </v-hover>
        </v-container>

        <!-- delete dialog -->
        <v-dialog v-model="delete_dialog" max-width="290">
            <v-card>
                <v-card-title class="headline">Yakin ?</v-card-title>

                <v-card-text>
                    Kamu akan menghapusnya untuk selama - lamanya
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="red darken-1" text @click="delete_dialog = false">
                        Ngga jadi deh
                    </v-btn>

                    <v-btn color="green darken-1" text @click="delete_ckp()">
                        Iya beneran
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- edit dialog -->
        <v-dialog v-model="edit_dialog" persistent max-width="600px">

            <v-card>
                <v-card-title>
                    <span class="headline">Edit CKP</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>

                            <v-col cols="12" sm="6">
                                <v-select v-model="edited_jenis_kegiatan" :items="items"
                                    :error-messages="edited_jenis_kegiatanErrors" label="Jenis Kegiatan *" required
                                    @change="$v.edited_jenis_kegiatan.$touch()"
                                    @blur="$v.edited_jenis_kegiatan.$touch()"></v-select>

                                <v-text-field v-model="edited_uraian_kegiatan"
                                    :error-messages="edited_uraian_kegiatanErrors" label="Uraian Kegiatan *" required
                                    @input="$v.edited_uraian_kegiatan.$touch()"
                                    @blur="$v.edited_uraian_kegiatan.$touch()"></v-text-field>

                                <v-text-field v-model="edited_satuan" :error-messages="edited_satuanErrors"
                                    label="Satuan *" required @input="$v.edited_satuan.$touch()"
                                    @blur="$v.edited_satuan.$touch()"></v-text-field>

                                <v-text-field v-model="edited_target_kuantitas"
                                    :error-messages="edited_target_kuantitasErrors" label="Target Kuantitas *" required
                                    @input="$v.edited_target_kuantitas.$touch()"
                                    @blur="$v.edited_target_kuantitas.$touch()"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field v-model="edited_kode_butir_kegiatan" label="Kode Butir Kegiatan">
                                </v-text-field>

                                <v-text-field v-model="edited_angka_kredit" label="Angka Kredit"></v-text-field>

                                <v-text-field v-model="edited_keterangan" label="Keterangan"></v-text-field>

                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="edit_dialog = false">Close</v-btn>
                    <v-btn color="blue darken-1" text @click="updateCkp()">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- penilaian -->
        <v-dialog v-model="realisasi_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click="realisasi_dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Penilaian CKP {{this.bulan}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark text @click="submitPenilaian()">Save</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-list three-line subheader v-for="(item, index) in this.ckpt_view" :key="index">
                    <!-- <v-subheader>User Controls</v-subheader> -->

                    <v-list-item >
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="3">
                                        <v-list-item-content>
                                            <v-list-item-title>Jenis Kegiatan</v-list-item-title>
                                            <v-list-item-subtitle>{{item.jenis_kegiatan}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-list-item-content>
                                            <v-list-item-title>Uraian Kegiatan</v-list-item-title>
                                            <v-list-item-subtitle>{{item.uraian_kegiatan}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                         <v-list-item-content>
                                            <v-list-item-title>Satuan</v-list-item-title>
                                            <v-list-item-subtitle>{{item.satuan}}</v-list-item-subtitle>
                                        </v-list-item-content>
                                    </v-col>
                                     <v-col cols="12" sm="3">
                                        <v-list-item-content>
                                            <v-list-item-title>Target Kuantitas</v-list-item-title>
                                            <v-list-item-subtitle>{{item.target_kuantitas}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                         <v-list-item-content>
                                            <v-list-item-title>Realisasi</v-list-item-title>
                                            <v-list-item-subtitle>{{item.realisasi}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-text-field v-model="item.kualitas" label="Kualitas">
                                        </v-text-field>

                                       

                                    </v-col>
                                </v-row>
                            </v-container>

                            
                    </v-list-item>
                    <v-divider></v-divider>
                </v-list>
                <v-row justify="center">
                    <br><br><br><br>

                    <v-btn small class="ma-2" tile outlined color="primary" @click="submitPenilaian()">
                                <v-icon left>mdi-zip-disk</v-icon> Save
                            </v-btn>
                </v-row>
                 
            </v-card>
        </v-dialog>




    </div>



</template>

<script>
    import {
        validationMixin
    } from 'vuelidate'
    import {
        required,
        maxLength,
        email
    } from 'vuelidate/lib/validators'

    export default {
        props: ['ckpt', 'daftar_pegawai', 'daftar_bulan'],
        mixins: [validationMixin],

        validations: {
            name: {
                required,
                maxLength: maxLength(10)
            },
            uraian_kegiatan: {
                required

            },
            email: {
                required,
                email
            },
            jenis_kegiatan: {
                required
            },
            satuan: {
                required
            },
            target_kuantitas: {
                required
            },
            // kode_butir_kegiatan:{
            //   required
            // },

            edited_uraian_kegiatan: {
                required

            },
            edited_email: {
                required,
                email
            },
            edited_jenis_kegiatan: {
                required
            },
            edited_satuan: {
                required
            },
            edited_target_kuantitas: {
                required
            },
            checkbox: {
                checked(val) {
                    return val
                },
            },
        },

        data: () => ({
            //hover
            hover:'',
            hover2: '',
            //bulan
            daftar_bulan_view:[],

            //pegawai
            pegawai: '',
            pilihan_pegawai: '',
            selected_pegawai: '',

            //ratarata
            ratarata_ckp: '',
            ratarata_ckp_view: '',

            //realisasi
            realisasi_dialog: '',
            notifications: false,
            sound: true,
            widgets: false,


            delete_dialog: '',
            edit_dialog: '',

            selected_item: '',

            edited_jenis_kegiatan: null,
            edited_uraian_kegiatan: '',
            edited_satuan: '',
            edited_target_kuantitas: '',
            edited_kode_butir_kegiatan: '',
            edited_angka_kredit: '',
            edited_keterangan: '',

            search: '',
            tes: '',
            ckpt_view: [],
            name: '',
            email: '',
            pilihan_bulan: '',
            bulan: '',

            jenis_kegiatan: null,
            uraian_kegiatan: '',
            satuan: '',
            target_kuantitas: '',
            kode_butir_kegiatan: '',
            angka_kredit: '',
            keterangan: '',

            checkbox: false,
            items: [
                'Utama',
                'Tambahan',

            ],

            //notif
            snackbar: false,
            text: 'Ada error',
            timeout: 2000,


            //tabel
            headers: [
                {
                    text: 'Jenis Kegiatan',
                    align: 'start',
                    sortable: false,
                    value: 'jenis_kegiatan',
                },
                {
                    text: 'Uraian Kegiatan',
                    value: 'uraian_kegiatan'
                },
                {
                    text: 'Satuan',
                    value: 'satuan'
                },
                {
                    text: 'Target Kuantitas',
                    value: 'target_kuantitas'
                },
                {
                    text: 'Realisasi',
                    value: 'realisasi'
                },
                {
                    text: 'Kualitas',
                    value: 'kualitas'
                },
                {
                    text: 'Kode Butir Kegiatan',
                    value: 'kode_butir_kegiatan'
                },
                {
                    text: 'Angka Kredit',
                    value: 'angka_kredit'
                },
                {
                    text: 'Keterangan',
                    value: 'keterangan'
                },
                // {
                //     text: 'Bulan',
                //     value: 'bulan'
                // },


            ],

             headers2: [
                
                {
                    text: 'Bulan',
                    align: 'left',
                    sortable: false,
                    value: 'bulan',
                },
                {
                    text: 'Aksi',
                    value: 'aksi',
                     sortable: false,
                    width: 100
                },
              

            ],

        }),

        computed: {
            // variabel ckpt
            jenis_kegiatan_x: {
                set(val) {
                    this.$store.state.ckpt.jenis_kegiatan = val
                },
                get() {
                    return this.$store.state.ckpt.jenis_kegiatan
                }
            },
            uraian_kegiatan_x: {
                set(val) {
                    this.$store.state.ckpt.uraian_kegiatan = val
                },
                get() {
                    return this.$store.state.ckpt.uraian_kegiatan
                }
            },
            satuan_x: {
                set(val) {
                    this.$store.state.ckpt.satuan = val
                },
                get() {
                    return this.$store.state.ckpt.satuan
                }
            },
            target_kuantitas_x: {
                set(val) {
                    this.$store.state.ckpt.target_kuantitas = val
                },
                get() {
                    return this.$store.state.ckpt.target_kuantitas
                }
            },
            kode_butir_kegiatan_x: {
                set(val) {
                    this.$store.state.ckpt.kode_butir_kegiatan = val
                },
                get() {
                    return this.$store.state.ckpt.kode_butir_kegiatan
                }
            },
            angka_kredit_x: {
                set(val) {
                    this.$store.state.ckpt.angka_kredit = val
                },
                get() {
                    return this.$store.state.ckpt.angka_kredit
                }
            },
            keterangan_x: {
                set(val) {
                    this.$store.state.ckpt.keterangan = val
                },
                get() {
                    return this.$store.state.ckpt.keterangan
                }
            },
            bulan_x: {
                set(val) {
                    this.$store.state.ckpt.bulan = val
                },
                get() {
                    return this.$store.state.ckpt.bulan
                }
            },
             checkboxErrors () {
                const errors = []
                if (!this.$v.checkbox.$dirty) return errors
                !this.$v.checkbox.checked && errors.push('You must agree to continue!')
                return errors
            },
            jenis_kegiatanErrors () {
                const errors = []
                if (!this.$v.jenis_kegiatan.$dirty) return errors
                !this.$v.jenis_kegiatan.required && errors.push('Jenis kegiatan jangan lupa diisi')
                return errors
            },
            uraian_kegiatanErrors () {
                const errors = []
                if (!this.$v.uraian_kegiatan.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.uraian_kegiatan.required && errors.push('Uraian kegiatan jangan lupa diisi.')
                return errors
            },
            satuanErrors () {
                const errors = []
                if (!this.$v.satuan.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.satuan.required && errors.push('Satuan jangan lupa diisi.')
                return errors
            },
            target_kuantitasErrors () {
                const errors = []
                if (!this.$v.target_kuantitas.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.target_kuantitas.required && errors.push('Target kuantitas jangan lupa diisi.')
                return errors
            },
            
            kode_butir_kegiatanErrors () {
                const errors = []
                if (!this.$v.name.$dirty) return errors
                !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.name.required && errors.push('Name is required.')
                return errors
            },

            edited_jenis_kegiatanErrors () {
                const errors = []
                if (!this.$v.edited_jenis_kegiatan.$dirty) return errors
                !this.$v.edited_jenis_kegiatan.required && errors.push('Jenis kegiatan jangan lupa diisi')
                return errors
            },
            edited_uraian_kegiatanErrors () {
                const errors = []
                if (!this.$v.edited_uraian_kegiatan.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.edited_uraian_kegiatan.required && errors.push('Uraian kegiatan jangan lupa diisi.')
                return errors
            },
            edited_satuanErrors () {
                const errors = []
                if (!this.$v.edited_satuan.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.edited_satuan.required && errors.push('Satuan jangan lupa diisi.')
                return errors
            },
            edited_target_kuantitasErrors () {
                const errors = []
                if (!this.$v.edited_target_kuantitas.$dirty) return errors
                // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.edited_target_kuantitas.required && errors.push('Target kuantitas jangan lupa diisi.')
                return errors
            },
            
            edited_kode_butir_kegiatanErrors () {
                const errors = []
                if (!this.$v.name.$dirty) return errors
                !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
                !this.$v.name.required && errors.push('Name is required.')
                return errors
            }

        },

        methods: {
              async downloadExcel(){
                console.log(this.ckpt_view)
                await axios.post('/download_excel' , {
                    ckp: this.ckpt_view
                }) 
                //  window.location.href = "/download_excel2/"+this.ckpt_view[0].id
            },

                async ratarata(){
                var rata=0
                var id = this.ckpt_view[0].user_id
                console.log('id', id)
                console.log('count', this.ckpt_view.length)
                if ( this.ckpt_view.length == 0) {
                    this.ratarata_ckp = 0
                    this.ratarata_ckp_view = 0
                } else {
                    
                    this.ckpt_view.forEach(element => {
                        if (element.realisasi === null) {
                            element.realisasi = 0;
                        }
                        if (element.target_kuantitas === null) {
                            element.target_kuantitas = 0;
                        }
                        if (element.kualitas === null) {
                            element.kualitas = 0;
                        }
                        
                    console.log(element)
                    rata = rata + ((parseInt(element.realisasi) / parseInt(element.target_kuantitas) * 100) + parseInt(element.kualitas) ) / 2
                    console.log('x',rata);
                });
                    console.log('rata a',rata);
                    console.log('f', rata/this.ckpt_view.length)
                this.ratarata_ckp = rata/this.ckpt_view.length
                
                 this.ratarata_ckp_view = this.ratarata_ckp.toString().substring(0,5)
                }
                await axios.post('ckp/ratarata2' , {
                    id: id,
                    ratarata: this.ratarata_ckp,
                    bulan: this.bulan
                })
           


        },

              async showCkp(item){
                console.log(item)
                this.show = true
                this.bulan = item.bulan
                console.log('item.bulan = ', item.bulan)
                console.log('this.pegawai = ', this.pegawai)
                await axios.get('/get_ckp_bulan_pegawai/'+item.bulan+'/'+this.pegawai).then(response => {

                    //Logic goes here
                    this.tes = response.data


                }).catch(error => {
                    alert(error);
                });
                 this.ckpt_view = this.tes[0]
                 this.ratarata()
            },

             async pilihPegawai(pegawai) {
                await console.log(pegawai)
                for (let index = 0; index < this.daftar_pegawai.length; index++) {
                    const element = this.daftar_pegawai[index];
                    if (element.id === pegawai) {
                        
                        var selected = this.daftar_pegawai[index]
                    }
                    
                }
                this.selected_pegawai = selected.name
                console.log(this.selected_pegawai)
                // var b = ''
                // await axios.get('/get_ckp/' + bulan).then(response => {

                //     //Logic goes here
                //     this.tes = response.data


                // }).catch(error => {
                //     alert(error);
                // });
                // // console.log('tes',this.tes[0][0]['id'])
                // this.ckpt_view = this.tes[0]
                // console.log('tes', this.tes[0])

            },
            async submitPenilaian(){
                console.log(this.ckpt_view) 
                  this.realisasi_dialog = false
                 await axios.post('penilaian' , {
                    ckp: this.ckpt_view
                })
                this.ratarata()
                // await this.pilihBulan(this.bulan)
              
            },
            realisasiDialog() {
                this.realisasi_dialog = true
                console.log('bulan',this.bulan)
                console.log('ckp',this.ckpt_view)
               


            },
            async updateCkp() {
                this.edit_dialog = false
                var item = this.selected_item
                await axios.post('/ckp/update/' + item.id, {
                    id: item.id,
                    edited_ckp: [{
                            jenis_kegiatan: this.edited_jenis_kegiatan,
                            uraian_kegiatan: this.edited_uraian_kegiatan,
                            satuan: this.edited_satuan,
                            target_kuantitas: this.edited_target_kuantitas,
                            kode_butir_kegiatan: this.edited_kode_butir_kegiatan,
                            angka_kredit: this.edited_angka_kredit,
                            keterangan: this.edited_keterangan

                        }

                    ]
                })

                await this.pilihBulan(this.bulan)

            },
            editDialog(item) {
                this.selected_item = item
                console.log('ts', this.selected_item.jenis_kegiatan)

                this.edited_jenis_kegiatan = this.selected_item.jenis_kegiatan
                this.edited_uraian_kegiatan = this.selected_item.uraian_kegiatan
                this.edited_satuan = this.selected_item.satuan
                this.edited_target_kuantitas = this.selected_item.target_kuantitas
                this.edited_kode_butir_kegiatan = this.selected_item.kode_butir_kegiatan
                this.edited_angka_kredit = this.selected_item.angka_kredit
                this.edited_keterangan = this.selected_item.keterangan

                this.edit_dialog = true
            },
            async pilihBulan(bulan) {
                console.log(bulan)
                var b = ''
                await axios.get('/get_ckp/' + bulan).then(response => {

                    //Logic goes here
                    this.tes = response.data


                }).catch(error => {
                    alert(error);
                });
                // console.log('tes',this.tes[0][0]['id'])
                this.ckpt_view = this.tes[0]
                console.log('tes', this.tes[0])

            },
            deleteDialog(item) {
                this.selected_item = item
                console.log(this.selected_item)
                this.delete_dialog = true


            },
            delete_ckp() {
                var item = this.selected_item
                console.log(item)

                console.log('length ', this.ckpt_view.length)
                // axios.post('/ckpt_delete', {
                //         ckpt: item,
                //     })

                //    console.log(id)
                for (let index = 0; index < this.ckpt_view.length; index++) {
                    const element = this.ckpt_view[index];
                    console.log(element.id)
                    if (item.id == element.id) {

                        console.log('item id', item.id)
                        console.log('element id', element.id)



                        axios.delete('/ckpt_delete/' + element.id + '/delete', {
                            ckpt: item,
                        })
                        this.ckpt_view.splice(index, 1)

                    }
                }
                this.delete_dialog = false
            },
            async submit() {
                this.$v.$touch()
                if (
                    this.jenis_kegiatan === null ||
                    this.uraian_kegiatan === null ||
                    this.satuan === null ||
                    this.target_kuantitas === null

                ) {
                    this.snackbar = true

                } else {
                    this.jenis_kegiatan_x = this.jenis_kegiatan
                    this.uraian_kegiatan_x = this.uraian_kegiatan
                    this.satuan_x = this.satuan
                    this.target_kuantitas_x = this.target_kuantitas
                    this.kode_butir_kegiatan_x = this.kode_butir_kegiatan
                    this.angka_kredit_x = this.angka_kredit
                    this.keterangan_x = this.keterangan
                    this.bulan_x = this.bulan

                    this.$store.state.loader = true;
                    await axios.post('/ckpt', {
                            ckpt: this.$store.state.ckpt,
                        })
                        .then(function (response) {
                            console.log(response);
                        })
                    await this.pilihBulan(this.bulan)
                    this.clear()
                }

            },
            clear() {
                this.$v.$reset()
                this.jenis_kegiatan = null,
                    this.uraian_kegiatan = '',
                    this.satuan = '',
                    this.target_kuantitas = '',
                    this.kode_butir_kegiatan = '',
                    this.angka_kredit = '',
                    this.keterangan = ''
            },
             
        },
        beforeMount() {
            
             this.daftar_bulan_view = this.daftar_bulan.reverse()  
           
            
            console.log(this.daftar_pegawai)
            this.pilihan_pegawai = this.daftar_pegawai
            this.ratarata()
           
        },
    }

</script>
