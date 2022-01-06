<template>
    <div>
       
        <v-container fluid>

            <v-card style="background-color: #283046;" class="pa-md-4 mx-lg-auto raised" elevation=8>
                <v-row dense>


                    <v-col cols="12">
                        <v-card-title style="color: white;" >
                            Daftar Bulan
                            <v-spacer></v-spacer>
                            <v-text-field dark v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field>

                        </v-card-title>
                        <!-- {{ this.ckpt_view }} -->
                        <!-- loading loading-text="Loading... Please wait" -->
                        <v-data-table dark style="background-color: #161d31; color: white;" :headers="headers" :items="daftar_bulan_view" class="elevation-1"
                            :search="search">

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
                                        <v-icon color="#7367f0" @click="showCkpRatarata(item)" v-on="on">mdi-eye
                                        </v-icon>
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

        </v-container>


        <!-- rincian ckp -->
        <v-container fluid v-if="show">
<!-- {{this.ckpt_view[0][1]}} -->
            <v-card class="pa-md-4 mx-lg-auto raised" style="background-color: #283046" elevation=8>
                <v-row dense>


                    <v-col cols="12">
                        <v-card-title style="color: white;">
                             Rekap Nilai CKP {{this.bulan}}
                        </v-card-title>
                        <v-card-title>
                           
                            <v-btn small class="ma-2" tile outlined color="#28c76f" @click="downloadExcel()">
                                <v-icon left>mdi-file-excel</v-icon> Download Excel
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-text-field dark v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field>

                        </v-card-title>
                        
                        <!-- {{ this.ckpt_view }} -->
                        <!-- loading loading-text="Loading... Please wait" -->
                        <v-data-table dark style="background-color: #161d31; color: white;" :headers="headers2" :items="ckpt_view[0]" class="elevation-1" :search="search">
                            <!-- <template v-slot:item.aksi="{ item }">

                                <v-btn color="primary" fab x-small dark @click="editDialog(item)">
                                    <v-icon small @click="editDialog(item)">mdi-pencil</v-icon>
                                </v-btn>

                                <v-btn color="error" fab x-small dark @click="deleteDialog(item)">
                                    <v-icon small @click="deleteDialog(item)">mdi-delete</v-icon>
                                </v-btn>
                            </template> -->
                            <template v-slot:item.nama="{ item }">

                                {{ item.name }}
                            </template>

                            <template v-slot:item.ratarata="{ item }">

                                {{ item.ratarata }}
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

        <!-- edit dialog -->
       



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
        props: ['ratarata', 'daftar_bulan'],
        
        

        data: () => ({
            show: false,

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
            daftar_bulan_view: [],
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
                    text: 'Bulan',
                    align: 'left',
                    sortable: false,
                    value: 'bulan',
                },
                {
                    text: 'Aksi',
                    value: 'aksi',
                    width: 100
                },


            ],

            headers2: [
                // {
                //     text: 'Aksi',
                //     value: 'aksi',
                //     width: 100
                // },
                {
                    text: 'Nama',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {
                    text: 'Nilai CKP',
                    value: 'ratarata'
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
            }

        },

        methods: {
             async downloadExcel(){
                console.log(this.ckpt_view)
                await axios.post('/download_excel/rekap' , {
                    ckp: this.ckpt_view,
                    bulan: this.bulan
                }) 
                //  window.location.href = "/download_excel/"+this.ckpt_view[0].id
                 window.location.href = "/download_excel/rekap/"+this.bulan
            },
            async showCkpRatarata(item) {
                console.log(item)
                this.show = true
                this.bulan = item.bulan
                await axios.get('/get_ckp_ratarata/' + item.bulan).then(response => {

                    //Logic goes here
                    this.tes = response.data


                }).catch(error => {
                    alert(error);
                });
                this.ckpt_view = this.tes
            },

            //liat ke atas aja
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
                this.ckpt_view = this.tes[0][0]
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
            }
        },
        beforeMount() {
            this.ckpt_view = this.ratarata
            console.log('ratarata', this.ratarata)
            this.daftar_bulan_view = this.daftar_bulan.reverse()
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




                default:
                    break;
            }

            var dateStr2 = month2 + " " + year2;
            var dateStr3 = month3 + " " + year3;
            var dateStr1 = month1 + " " + year1;


            console.log(a)
            this.pilihan_bulan = [dateStr1, dateStr2, dateStr3]
            this.bulan = this.pilihan_bulan[1]
        },
    }

</script>
