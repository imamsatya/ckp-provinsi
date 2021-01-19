<template>
    <div>
        <v-container>
            <v-card elevation=8 class=" pa-md-4 mx-lg-auto">
                <v-select :items="pilihan_bulan" label="Bulan" v-model="bulan" @input="pilihBulan(bulan)"></v-select>
            </v-card>
        </v-container>

        <v-container>
            <v-card  elevation=8 class="rounded-card pa-md-4 mx-lg-auto">
                
                <v-card-title class="primary--text">
                        <v-icon large color="primary">mdi-clipboard-text</v-icon>Form CKP
                    <v-spacer></v-spacer>

                </v-card-title>
                <v-row>
                  <!-- {{this.user.jabatan_id}} -->
                    <v-col cols="12" md="6">
                        <v-select v-if="this.user.jabatan_id == 2" v-model="jenis_bidang" :items="bidang" :error-messages="jenis_bidangErrors"
                            label="Kegiatan Bidang *" required @change="$v.jenis_bidang.$touch()"
                            @blur="$v.jenis_bidang.$touch()"></v-select>

                        <v-select v-model="jenis_kegiatan" :items="items" :error-messages="jenis_kegiatanErrors"
                            label="Jenis Kegiatan *" required @change="$v.jenis_kegiatan.$touch()"
                            @blur="$v.jenis_kegiatan.$touch()"></v-select>

                        <v-text-field v-model="uraian_kegiatan" :error-messages="uraian_kegiatanErrors"
                            label="Uraian Kegiatan *" required @input="$v.uraian_kegiatan.$touch()"
                            @blur="$v.uraian_kegiatan.$touch()"  autocomplete="on">></v-text-field>

                        <v-text-field v-model="satuan" :error-messages="satuanErrors" label="Satuan *" cache-items autocomplete="on" required
                            @input="$v.satuan.$touch()" @blur="$v.satuan.$touch()"></v-text-field>

                        <v-text-field v-model="target_kuantitas" :error-messages="target_kuantitasErrors"
                            label="Target Kuantitas *" required @input="$v.target_kuantitas.$touch()"
                            @blur="$v.target_kuantitas.$touch()"></v-text-field>


                    </v-col>

                    <v-col cols="12" md="6">
                        <v-text-field v-model="kode_butir_kegiatan" label="Kode Butir Kegiatan"></v-text-field>

                        <v-text-field v-model="angka_kredit" label="Angka Kredit"></v-text-field>

                        <v-text-field v-model="keterangan" label="Keterangan"></v-text-field>

                        <!-- <br><br><br><br>
                         
                        <v-btn @click="clear">clear</v-btn>
                        <v-btn class="mr-4" @click="submit">submit</v-btn> -->

                    </v-col>
                </v-row>
                <v-row justify="center">
                    <br><br><br><br>

                    <v-btn class="mr-4" color="red darken-1" tile outlined @click="clear"> 
                         <v-icon left>mdi-eraser</v-icon>
                         clear
                    </v-btn>
                    <v-btn :disabled="disable" class="mr-4" color="primary" tile outlined @click="submit">
                         <v-icon left>mdi-send</v-icon>submit</v-btn>
                </v-row>
            </v-card>
        </v-container>


        <br>


        <v-container fluid>

            <v-card class="pa-md-4 mx-lg-auto raised " elevation=8>
                <v-row dense>


                    <v-col cols="12">
                        <v-card-title class="primary--text">
                             <v-icon large color="primary">mdi-calendar</v-icon> Daftar CKP {{this.bulan}}
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
                        <!-- <v-card-subtitle class="primary--text">
                            Nilai CKP : {{ratarata_ckp}} 
                        </v-card-subtitle> -->
                        <v-card-title>

                            <v-btn :disabled="disable" small class="ma-2" tile outlined color="primary" @click="realisasiDialog()">
                                <v-icon left>mdi-pencil</v-icon> Realisasi
                            </v-btn>
                            <v-btn small class="ma-2" tile outlined color="success" @click="downloadExcel()">
                                <v-icon left>mdi-file-excel</v-icon> Download Excel
                            </v-btn>
                            <v-btn :disabled="disable" small class="ma-2" tile outlined color="primary" @click="copyCkp()">
                                <v-icon left>mdi-content-copy</v-icon> Copy ?
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field>

                        </v-card-title>
                        
                        <!-- <p>Nilai CKP : {{ratarata_ckp}} </p> -->
                        <!-- {{ this.ckpt_view }} -->
                        <!-- loading loading-text="Loading... Please wait" -->
                        <v-alert
      v-model="copyAlert"
      border="left"
      close-text="Close Alert"
      
      dark
      dismissible
      dense
      text
      type="success"
    >
     Yeay, Copy Berhasil :)
    </v-alert>
                        <v-data-table :headers="headers" :items="ckpt_view" class="elevation-1" :search="search">
                            <template v-slot:item.aksi="{ item }">
                                <div v-if="disable==false">
                                <v-btn  color="primary" fab x-small dark @click="editDialog(item)">
                                    <v-icon small @click="editDialog(item)">mdi-pencil</v-icon>
                                </v-btn>

                                <v-btn color="error" fab x-small dark @click="deleteDialog(item)">
                                    <v-icon small @click="deleteDialog(item)">mdi-delete</v-icon>
                                </v-btn>
                                </div>
                                <div v-else>
                                    <!-- <v-btn color="primary" fab x-small dark > -->
                                    <v-icon small >mdi-lock</v-icon>
                                <!-- </v-btn> -->
                                </div>
                            </template>
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

                            <template v-slot:item.realisasi="{ item }">

                                {{ item.realisasi }}
                            </template>

                            <template v-slot:item.persentase="{ item }">
                                
                                {{persentase(item)}}
                               <!-- {{item.realisasi/item.target_kuantitas*100 + '%'}} -->
                            </template>

                            <template v-slot:item.kualitas="{ item }">

                                {{ item.kualitas }}
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

                                <v-select v-if="this.user.jabatan_id == 2" v-model="edited_jenis_bidang" :items="bidang" :error-messages="edited_jenis_bidangErrors"
                            label="Kegiatan Bidang *" required @change="$v.edited_jenis_bidang.$touch()"
                            @blur="$v.edited_jenis_bidang.$touch()"></v-select>

                                <v-select v-model="edited_jenis_kegiatan" :items="items"
                                    :error-messages="edited_jenis_kegiatanErrors" label="Jenis Kegiatan *" required
                                    @change="$v.edited_jenis_kegiatan.$touch()"
                                    @blur="$v.edited_jenis_kegiatan.$touch()" ></v-select>

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

        <!-- realisasi -->
        <v-dialog v-model="realisasi_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click="realisasi_dialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Realisasi CKP {{this.bulan}}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn  dark text @click="submitRealissai()" >Save</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-list three-line subheader v-for="(item, index) in this.ckpt_view" :key="index">
                    <!-- <v-subheader>User Controls</v-subheader> -->

                    <v-list-item >
                        <!-- <v-list-item-content>
                            <v-list-item-title>Content filtering</v-list-item-title>
                            <v-list-item-subtitle>Set the content filtering level to restrict apps that can be
                                downloaded</v-list-item-subtitle>
                        </v-list-item-content> -->
                            <v-container>
                               
                                <v-row>

                                    <v-col cols="12" sm="6">
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

                                        <v-list-item-content>
                                            <v-list-item-title>Target Kuantitas</v-list-item-title>
                                            <v-list-item-subtitle>{{item.target_kuantitas}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <!-- <v-select v-model="edited_jenis_kegiatan" :items="items"
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
                                            @blur="$v.edited_target_kuantitas.$touch()"></v-text-field> -->
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                         <v-list-item-content>
                                            <v-list-item-title>Persentase</v-list-item-title>
                                            <v-list-item-subtitle>{{persentase(item)}}</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-text-field v-model="item.realisasi" label="Realisasi">
                                        </v-text-field>



                                       

                                    </v-col>
                                </v-row>
                            </v-container>

                            
                    </v-list-item>
                    <v-divider></v-divider>
                </v-list>
                <v-row justify="center">
                    <br><br><br><br>

                    <v-btn small class="ma-2" tile outlined color="primary" @click="submitRealissai()" >
                                <v-icon left>mdi-zip-disk</v-icon> Save
                            </v-btn>
                </v-row>
              
            </v-card>
        </v-dialog>

        <!-- copy -->
        <v-dialog v-model="copy_dialog" persistent max-width="290">
            
            <v-card>
                <v-container>
                <v-card-title class="headline">Dari Bulan Apa ?</v-card-title>

               <v-select :items="daftar_bulan_view" label="Bulan" v-model="bulan_copy" @input="pilihBulan(bulan_copy)"></v-select>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="red darken-1" text @click="copy_dialog = false">
                        Ngga jadi deh
                    </v-btn>

                    <v-btn color="green darken-1" text @click="submitCopy(bulan_copy)">
                        Copy :)
                    </v-btn>
                </v-card-actions>
                </v-container>
            </v-card>
        </v-dialog>

         <v-dialog v-model="alertTtd" max-width="290">
            
            <v-card>
                <v-container>
                <v-card-title class="headline">Pengumuman</v-card-title>
                Halo semuanya, jangan lupa untuk upload scan tanda tangan dengan format .png di menu settings. Terima kasih, selamat beraktivitas :)
               <!-- <v-select :items="daftar_bulan_view" label="Bulan" v-model="bulan_copy" @input="pilihBulan(bulan_copy)"></v-select> -->

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="red darken-1" text @click="alertTtd = false">
                        Close
                    </v-btn> 

                    <v-btn color="green darken-1" text @click="goTo()">
                        Settings
                    </v-btn>
                </v-card-actions>
                </v-container>
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
        props: ['ckpt', 'daftar_bulan', 'user'],
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
            jenis_bidang:{
                required
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
            edited_jenis_bidang:{
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

            //disable
            disable: false,

            //bidang
            bidang: [
                'Tata Usaha (TU)',
                'Statistik Sosial (Sosial)',
                'Statistik Produksi (Produksi)',
                'Statistik Distribusi (Distribusi)',
                'Neraca Wilayah dan Analisis Statistik (Neraca)',
                'Integrasi Pengolahan dan Diseminasi Statistik (IPDS)'

            ],
            jenis_bidang: '',


            //copy
            copy_dialog: '',
            copyAlert: false,
            bulan_copy: '',
            daftar_bulan_view:[],

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
            
            edited_jenis_bidang: '',
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
            alertTtd: false,
            text: 'Ada error',
            timeout: 2000,


            //tabel
            headers: [{
                    text: 'Aksi',
                    value: 'aksi',
                    width: 100
                },
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
                    text: 'Persentase',
                    value: 'persentase'
                   
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

        }),
        mounted(){
            console.log('mount')
            console.log('bulan', this.bulan)
            this.alertTtd = true

             
            
        },
        watch:{
            bulan: function (){
                            var d = new Date();
                 var date = d.getDate();
            var year = d.getFullYear();

            var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
            console.log('subtring', this.bulan.substring(-5, this.bulan.length-4))
            console.log('date', date)
            var selectedMonth = this.bulan.substring(-5, this.bulan.length-5)
            
            
            switch (selectedMonth) {
                case 'Januari':
                    selectedMonth = 1
                    break;

                case 'Februari':
                    selectedMonth = 2
                    break;

                case 'Maret':
                    selectedMonth = 3
                    break;

                case 'April':
                    selectedMonth = 4
                    break;

                case 'Mei':
                    selectedMonth = 5
                    break;

                case 'Juni':
                    selectedMonth = 6
                    break;

                case 'Juli':
                    selectedMonth = 7
                    break;

                case 'Agustus':
                    selectedMonth = 8
                    break;

                case 'September':
                    selectedMonth = 9
                    break;

                case 'Oktober':
                    selectedMonth = 10
                    break;

                case 'November':
                    selectedMonth = 11
                    break;

                case 'Desember':
                    selectedMonth = 12
                    break;




                default:
                    break;
            }
           console.log('month', month, 'current Month', selectedMonth)
        //    if ((date >= 15 &&  selectedMonth < month) || selectedMonth < month) {
            if ((date >= 15 &&  selectedMonth < month) ) {
                this.disable = true
                console.log('disable true')
            } else {
                 this.disable = false
            }

         
                 
        }
        },


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
      jenis_bidangErrors () {
        const errors = []
        if (!this.$v.jenis_bidang.$dirty) return errors
        !this.$v.jenis_bidang.required && errors.push('Jenis bidang jangan lupa diisi')
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
       edited_jenis_bidangErrors () {
        const errors = []
        if (!this.$v.edited_jenis_bidang.$dirty) return errors
        !this.$v.edited_jenis_bidang.required && errors.push('Jenis kegiatan jangan lupa diisi')
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
            goTo() {
                // console.log(item.route)
                window.location.href = '/settings'
            },

            persentase(item){
                
                var a = item.realisasi/item.target_kuantitas*100 
                if (a > 100) {
                    a = 100
                }
                return a
            
            },
            async submitCopy(bulan){
                console.log(this.bulan)
                await axios.post('/copy_ckp' , {
                    bulan_copy: this.bulan_copy,
                    bulan: this.bulan
                }) 
                this.copy_dialog = false;
                this.copyAlert = true
               await this.pilihBulan(this.bulan)
               await this.ratarata()
               
            },
            copyCkp(){
                this.copy_dialog = true;
            },
            async downloadExcel(){
                console.log(this.ckpt_view)
                // console.log(this.ckpt_view[0].id) 
                await axios.post('/download_excel' , {
                    ckp: this.ckpt_view
                })
                
                 window.location.href = "/download_excel/"+this.ckpt_view[0].id
            },
            async submitRealissai(){
                console.log(this.ckpt_view) 
                  this.realisasi_dialog = false
                 await axios.post('ckp/realisasi' , {
                    ckp: this.ckpt_view
                })
                await this.ratarata()
              
              
            },
            realisasiDialog() {
                this.realisasi_dialog = true
                console.log('bulan',this.bulan)
                console.log('ckp',this.ckpt_view)
               


            },
            async updateCkp() {
                this.edit_dialog = false
                var item = this.selected_item
                if (this.user.jabatan_id == 2) {
                    this.edited_uraian_kegiatan = this.edited_jenis_bidang+ ' - '+this.edited_uraian_kegiatan
                }
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
                await this.ratarata()

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

                if (this.user.jabatan_id == 2) {
                    var n = this.selected_item.uraian_kegiatan.indexOf(" - ")
                    this.edited_jenis_bidang = this.selected_item.uraian_kegiatan.substring(0, n)
                    console.log(this.edited_jenis_bidang)

                    this.edited_uraian_kegiatan = this.selected_item.uraian_kegiatan.substring(n+3)
                    console.log('edited uraian', this.edited_uraian_kegiatan)
                }

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
                })
                // console.log('tes',this.tes[0][0]['id'])
                .then()
                this.ckpt_view = this.tes[0];
                console.log('tes', this.tes[0])
                await  this.ratarata()

            },
            deleteDialog(item) {
                this.selected_item = item
                console.log(this.selected_item)
                this.delete_dialog = true


            },
            async delete_ckp() {
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
               await this.ratarata()
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

                    

                    
                    
                    if (this.user.jabatan_id == 2) {
                        this.uraian_kegiatan_x = this.jenis_bidang+ ' - '+this.uraian_kegiatan
                    }else{
                        this.uraian_kegiatan_x = this.uraian_kegiatan
                    }

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
            async ratarata(){
                var rata=0
                var rata_temp=0
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
                    rata_temp = (parseInt(element.realisasi) / parseInt(element.target_kuantitas))
                    if (rata_temp >= 1) {
                        rata_temp = 1
                    }
                    rata = rata + (( rata_temp * 100) + parseInt(element.kualitas) ) / 2
                    console.log('x',rata);
                });
                    console.log('rata a',rata);
                    console.log('f', rata/this.ckpt_view.length)
                this.ratarata_ckp = rata/this.ckpt_view.length
                this.ratarata_ckp_view = this.ratarata_ckp.toString().substring(0,5)
                }
                await axios.post('ckp/ratarata' , {
                    ratarata: this.ratarata_ckp,
                    bulan: this.bulan
                })
           


              },
        },
       
        beforeMount() {
            // console.log('daftar_bulan', this.daftar_bulan[0].bulan)
            // this.daftar_bulan.forEach(element => {
                
            // });
        //   this.daftar_bulan_view = this.daftar_bulan.reverse() 
        // console.log('daftar_bulan',this.daftar_bulan);
        if (this.daftar_bulan.length != 0) {
             this.daftar_bulan.reverse().forEach(element => {
              this.daftar_bulan_view.push(element.bulan)
          }); 
        }
         
          console.log('daftar bulan view', this.daftar_bulan_view)
            // this.ckpt_view = this.ckpt
            var d = new Date();



            var date = d.getDate();
            var year = d.getFullYear();

            var month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12


            var month2 = month
            var year2 = year

            switch (month2) {
                case 1:
                    month2 = 'Januari'
                    break;

                case 2:
                    month2 = 'Februari'
                    break;

                case 3:
                    month2 = 'Maret'
                    break;

                case 4:
                    month2 = 'April'
                    break;

                case 5:
                    month2 = 'Mei'
                    break;

                case 6:
                    month2 = 'Juni'
                    break;

                case 7:
                    month2 = 'Juli'
                    break;

                case 8:
                    month2 = 'Agustus'
                    break;

                case 9:
                    month2 = 'September'
                    break;

                case 10:
                    month2 = 'Oktober'
                    break;

                case 11:
                    month2 = 'November'
                    break;

                case 12:
                    month2 = 'Desember'
                    break;

                case 13:
                    month2 = 'Januari'
                    break;




                default:
                    break;
            }

            var month3 = month + 1
            var year3 = year

            var month1 = month - 1
            var year1 = year

            var a = year + 1


            if (month2 === 11) {
                month3 = 1
                year3 = year + 1
            }

            if (month2 === 1) {
                month1 = 11
                year1 = year - 1
            }


            switch (month1) {
                case 0:
                    month1 = 'Desember'
                    year1 = year1-1
                    break;
                case 1:
                    month1 = 'Januari'
                    break;

                case 2:
                    month1 = 'Februari'
                    break;

                case 3:
                    month1 = 'Maret'
                    break;

                case 4:
                    month1 = 'April'
                    break;

                case 5:
                    month1 = 'Mei'
                    break;

                case 6:
                    month1 = 'Juni'
                    break;

                case 7:
                    month1 = 'Juli'
                    break;

                case 8:
                    month1 = 'Agustus'
                    break;

                case 9:
                    month1 = 'September'
                    break;

                case 10:
                    month1 = 'Oktober'
                    break;

                case 11:
                    month1 = 'November'
                    break;

                case 12:
                    month1 = 'Desember'
                    break;

                case 13:
                    month1 = 'Januari'
                    break;




                default:
                    break;
            }

            switch (month3) {
                case 1:
                    month3 = 'Januari'
                    break;

                case 2:
                    month3 = 'Februari'
                    break;

                case 3:
                    month3 = 'Maret'
                    break;

                case 4:
                    month3 = 'April'
                    break;

                case 5:
                    month3 = 'Mei'
                    break;

                case 6:
                    month3 = 'Juni'
                    break;

                case 7:
                    month3 = 'Juli'
                    break;

                case 8:
                    month3 = 'Agustus'
                    break;

                case 9:
                    month3 = 'September'
                    break;

                case 10:
                    month3 = 'Oktober'
                    break;

                case 11:
                    month3 = 'November'
                    break;

                case 12:
                    month3 = 'Desember'
                    break;

                 case 13:
                    month3 = 'Januari'
                    year3 = year3 + 1
                    break;





                default:
                    break;
            }

            var dateStr2 = month2 + " " + year2;
            var dateStr3 = month3 + " " + year3;
            var dateStr1 = month1 + " " + year1;


            console.log(a)
            this.pilihan_bulan = [dateStr1, dateStr2, dateStr3]
            this.bulan = this.pilihan_bulan[1]
            this.pilihBulan(this.bulan)
            console.log(this.bulan)
            console.log('user',this.user)
              this.ratarata()
        },
    }

</script>
