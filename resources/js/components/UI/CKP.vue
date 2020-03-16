<template>
    <div>
        pilih bulan apa
        <v-menu transition="slide-x-transition">
        <v-card class="d-flex flex-column justify-space-between mb-6" flat tile>


            <v-card class="pa-md-4 raised" width="400px" elevation="8">

                <form>
                    <v-select v-model="jenis_kegiatan" :items="items" :error-messages="jenis_kegiatanErrors"
                        label="Jenis Kegiatan" required @change="$v.jenis_kegiatan.$touch()"
                        @blur="$v.jenis_kegiatan.$touch()"></v-select>

                    <v-text-field v-model="uraian_kegiatan" :error-messages="uraian_kegiatanErrors"
                        label="Uraian Kegiatan " required @input="$v.uraian_kegiatan.$touch()"
                        @blur="$v.uraian_kegiatan.$touch()"></v-text-field>

                    <v-text-field v-model="satuan" :error-messages="satuanErrors" label="Satuan" required
                        @input="$v.satuan.$touch()" @blur="$v.satuan.$touch()"></v-text-field>

                    <v-text-field v-model="target_kuantitas" :error-messages="target_kuantitasErrors"
                        label="Target Kuantitas" required @input="$v.target_kuantitas.$touch()"
                        @blur="$v.target_kuantitas.$touch()"></v-text-field>

                    <v-text-field v-model="kode_butir_kegiatan" label="Kode Butir Kegiatan"></v-text-field>

                    <v-text-field v-model="angka_kredit" label="Angka Kredit"></v-text-field>

                    <v-text-field v-model="keterangan" label="Keterangan"></v-text-field>

                    <br><br>





                    <v-btn class="mr-4" @click="submit">submit</v-btn>
                    <v-btn @click="clear">clear</v-btn>


                    <v-snackbar v-model="snackbar" :timeout="timeout" top color="red">
                        {{ text }}
                        <v-btn color="white" text @click="snackbar = false">
                            Close
                        </v-btn>
                    </v-snackbar>
                </form>
            </v-card>

            <v-card class="pa-md-4  raised" width="1600px">
                <!-- {{ this.ckpt_view }} -->
                <v-data-table :headers="headers" :items="ckpt_view" class="elevation-1">
                    <template v-slot:item.aksi="{ item }">

                        <v-btn color="primary" fab x-small dark @click="edit_ckp(item)">
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>

                        <v-btn color="error" fab x-small dark @click="delete_ckp(item)">
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
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

                    <template v-slot:item.kode_butir_kegiatan="{ item }">

                        {{ item.kode_butir_kegiatan }}
                    </template>

                    <template v-slot:item.angka_kredit="{ item }">

                        {{ item.angka_kredit }}
                    </template>

                    <template v-slot:item.keterangan="{ item }">

                        {{ item.keterangan }}
                    </template>
                </v-data-table>
            </v-card>



        </v-card>
        </v-menu>

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
        props: ['ckpt'],
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
            checkbox: {
                checked(val) {
                    return val
                },
            },
        },

        data: () => ({
            ckpt_view: [],
            name: '',
            email: '',

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
            headers: [{
                    text: 'Aksi',
                    value: 'aksi'
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
        !this.$v.uraian_kegiatan.required && errors.push('Uraian kegiatan jangan lupda diisi.')
        return errors
      },
      satuanErrors () {
        const errors = []
        if (!this.$v.satuan.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.satuan.required && errors.push('Satuan jangan lupda diisi.')
        return errors
      },
      target_kuantitasErrors () {
        const errors = []
        if (!this.$v.target_kuantitas.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.target_kuantitas.required && errors.push('Target kuantitas jangan lupda diisi.')
        return errors
      },
      
      kode_butir_kegiatanErrors () {
        const errors = []
        if (!this.$v.name.$dirty) return errors
        !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.name.required && errors.push('Name is required.')
        return errors
      },


            // emailErrors () {
            //   const errors = []
            //   if (!this.$v.email.$dirty) return errors
            //   !this.$v.email.email && errors.push('Must be valid e-mail')
            //   !this.$v.email.required && errors.push('E-mail is required')
            //   return errors
            // },




        },

        methods: {
            delete_ckp(item) {
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
                        //     Vue.swal({
                        //     title: 'Yakin?',
                        //     text: "Kamu akan menghapusnya selama-lamanya",
                        //     type: 'warning',
                        //     showCancelButton: true,
                        //     confirmButtonColor: '#3085d6',
                        //     cancelButtonColor: '#d33',
                        //     confirmButtonText: 'Iya beneran',
                        //     cancelButtonText: 'Ga jadi!',
                        // })
                        console.log('item id', item.id)
                        console.log('element id', element.id)

                        // axios.delete('/home/atribut/' + id + '/harga_barang/delete')
                        //     .then(this.datas_view.splice(index, 1));
                        // .then(Vue.delete(this.datas, idx))
                        // this.$emit('Deleted');

                        axios.delete('/ckpt_delete/' + element.id + '/delete', {
                            ckpt: item,
                        })
                        this.ckpt_view.splice(index, 1)

                        // .then((result) => {
                        //     if (result) {
                        //         // const idx = this.ckpt_view.indexOf(data)
                        //         // console.log(data)
                        //         console.log('result', result)

                        //          axios.delete('/ckpt_delete', {
                        //         ckpt: item,
                        //     })


                        //         // axios.delete('/home/atribut/' + id + '/harga_barang/delete')
                        //         //     .then(this.datas_view.splice(index, 1));
                        //         // .then(Vue.delete(this.datas, idx))
                        //         // this.$emit('Deleted');


                        //         // if (result.value) {
                        //         //     Vue.swal(
                        //         //         'Hilang!',
                        //         //         'Data berhasil dihapus',
                        //         //         'success'
                        //         //     )
                        //         // }
                        //     }


                        // })
                    }
                }
            },
            submit() {
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
                    this.keterangan_x = this.keterangan_x

                    this.$store.state.loader = true;
                    axios.post('/ckpt', {
                            ckpt: this.$store.state.ckpt,
                        })
                        .then(function (response) {
                            console.log(response);
                        })
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
            this.ckpt_view = this.ckpt
        },
    }

</script>
