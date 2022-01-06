<template>
    <div>
        <v-card-title>

            <v-btn small class="ma-2" tile style="background-color: #7367f0;color: white;" @click="addUserDialog()">
                <v-icon left>mdi-plus</v-icon> User
            </v-btn>


            <v-spacer></v-spacer>
            <v-text-field dark v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details>
            </v-text-field>

        </v-card-title>
        <!-- <p style="color: white;">{{this.users_view[0]}}</p> -->
        <v-data-table dark style="background-color: #161d31; color: white;" :headers="headers" :items="users_view"
            class="elevation-1" :search="search" >
            <template style="color:white;" v-slot:item.aksi="{ item }">
                
                <v-btn style="background-color: #7367f0;color: white;" fab x-small dark @click="editUserDialog(item)">
                    <v-icon small @click="editUserDialog(item)">mdi-pencil</v-icon>
                </v-btn>

                <v-btn style="background-color: #ea5455;color:white;" fab x-small dark @click="deleteDialog(item)">
                    <v-icon small @click="deleteDialog(item)">mdi-delete</v-icon>
                </v-btn>

            </template>
            <template v-slot:item.name="{ item }">

                {{ item.name }}
            </template>

            <template v-slot:item.email="{ item }">

                {{ item.email }}
            </template>

            <template v-slot:item.nip_pendek="{ item }">

                {{ item.nip_pendek }}
            </template>

            <template v-slot:item.nip_panjang="{ item }">

                {{ item.nip_panjang }}
            </template>

            <template v-slot:item.jabatan.jabatan_kantor="{ item }">

                {{ item.jabatan.jabatan_kantor }}
            </template>

            <template v-slot:item.is_admin="{ item }">

                {{ item.is_admin }}
            </template>
        </v-data-table>

        <!-- add edit -->
        <v-dialog v-model="addeditUserDialog" persistent max-width="600px">

            <v-card style="background-color: #161d31;" class="white--text">
                <v-card-title>
                    <span class="headline">{{addeditUserTitle}}</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>

                            <v-col cols="12" sm="12">
                                <v-text-field dark v-model="editedUserField.edited_nama"
                                    :error-messages="edited_namaErrors" label="Nama *" required
                                    @input="$v.editedUserField.edited_nama.$touch()"
                                    @blur="$v.editedUserField.edited_nama.$touch()"></v-text-field>

                                <v-text-field type='email' dark v-model="editedUserField.edited_email"
                                    :error-messages="edited_emailErrors" label="Email *" required
                                    @input="$v.editedUserField.edited_email.$touch()"
                                    @blur="$v.editedUserField.edited_email.$touch()"></v-text-field>

                                <v-text-field type='number' dark v-model="editedUserField.edited_nip9digit" counter="9" 
                                    :error-messages="edited_nip9digitErrors" label="NIP 9 Digit *" required maxlength="9"
                                    @input="$v.editedUserField.edited_nip9digit.$touch()"
                                    @blur="$v.editedUserField.edited_nip9digit.$touch()"></v-text-field>

                                <v-text-field type='number' dark v-model="editedUserField.edited_nip18digit" counter="18"
                                    :error-messages="edited_nip18digitErrors" label="NIP 18 Digit *" required :rules="[v => v.length == 18 || 'Harus 18 digit']" maxlength="18"
                                    @input="$v.editedUserField.edited_nip18digit.$touch()"
                                    @blur="$v.editedUserField.edited_nip18digit.$touch()"></v-text-field>

                                <v-select dark v-model="editedUserField.edited_jabatan" :items="jabatans"
                                    item-text='jabatan_kantor' item-value='id'
                                    :error-messages="edited_jabatanErrors" label="Jabatan *" required
                                    @change="$v.editedUserField.edited_jabatan.$touch()"
                                    @blur="$v.editedUserField.edited_jabatan.$touch()"></v-select>

                                <v-select dark v-model="editedUserField.edited_isAdmin" :items="adminOptions"
                                    :error-messages="edited_isAdminErrors" label="Admin *" required
                                    @change="$v.editedUserField.edited_isAdmin.$touch()"
                                    @blur="$v.editedUserField.edited_isAdmin.$touch()"></v-select>
                            </v-col>

                        </v-row>
                    </v-container>
                    <small style="color: white;">*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn style="background-color: #ea5455;color:white;" text @click="addeditUserDialog = false">Close
                    </v-btn>
                    <v-btn style="background-color: #7367f0;color:white;" text @click="submit()">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- delete -->
        <v-dialog v-model="delete_dialog" max-width="290">
            <v-card style="background-color: #161d31; color: white;">
                <v-card-title class="headline">Yakin ?</v-card-title>

                <v-card-text class="white--text">
                    Kamu akan menghapusnya untuk selama - lamanya
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn style="background-color: #ea5455;color:white;" text @click="delete_dialog = false">
                        Ngga jadi deh
                    </v-btn>

                    <v-btn style="background-color: #28c76f;color: white;" text @click="deleteFinal()">
                        Iya beneran
                    </v-btn>
                </v-card-actions>
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
        minLength,
        email
    } from 'vuelidate/lib/validators'
    export default {
        
        props: ['users', 'jabatans'],
        mixins: [validationMixin],

        validations: {

            editedUserField:{          
            edited_nama: {
                required

            },
            edited_email: {
                required,
                email
            },
            edited_nip9digit: {
                required,
                 maxLength: maxLength(9),
                 minLength: minLength(9)

            },
            edited_nip18digit: {
                required
            },
           
            edited_jabatan: {
                required
            },
            edited_isAdmin: {
                required
            },},
            
            checkbox: {
                checked(val) {
                    return val
                },
            },
        },
        beforeMount(){
            this.users_view = this.users
            this.jabatan_view = this.jabatans
        },
        mounted(){
            // this.users_view = this.users
        },
        data: () => ({
            adminOptions: ['admin', 'non admin'],
            addeditUserDialog: false,
            addeditUserTitle: '',
            search: '',
            headers: [{
                    text: 'Aksi',
                    value: 'aksi',
                    width: 100
                },
                {
                    text: 'Nama',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                {
                    text: 'Email',
                    align: 'start',
                    sortable: false,
                    value: 'email',
                },
                {
                    text: 'NIP 9 digit',
                    value: 'nip_pendek'
                },
                {
                    text: 'NIP 18 Digit',
                    value: 'nip_panjang'
                },
                {
                    text: 'Jabatan',
                    value: 'jabatan.jabatan_kantor'
                },
                {
                    text: 'Admin',
                    value: 'is_admin'
                },



            ],
          
            // edited field
            editedUserField: {
                edited_nama: '',
                edited_email: '',
                edited_nip9digit: '',
                edited_nip18digit: '',
                edited_jabatan: '',
                edited_isAdmin: '',
            },
            selected_item: null,
            users_view: null,
            delete_dialog: false,
            jabatan_view: false,

        }),
        computed: {
              edited_namaErrors () {
        const errors = []
        if (!this.$v.editedUserField.edited_nama.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedUserField.edited_nama.required && errors.push('Nama jangan lupa diisi.')
        return errors
      },
      edited_emailErrors () {
        const errors = []
        if (!this.$v.editedUserField. edited_email.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedUserField. edited_email.required && errors.push('Email jangan lupa diisi.')
        return errors
      },
      edited_nip9digitErrors () {
        const errors = []
        if (!this.$v.editedUserField.edited_nip9digit.$dirty) return errors
        !this.$v.editedUserField.edited_nip9digit.maxLength && errors.push('NIP harus 9 digit')
           !this.$v.editedUserField.edited_nip9digit.minLength && errors.push('NIP harus 9 digit')
        !this.$v.editedUserField.edited_nip9digit.required && errors.push('NIP harus 9 digit')
        return errors
      },
      edited_nip18digitErrors () {
        const errors = []
        if (!this.$v.editedUserField.edited_nip18digit.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedUserField.edited_nip18digit.required && errors.push('NIP harus 18 digit')
        return errors
      },
       edited_jabatanErrors () {
        const errors = []
        if (!this.$v.editedUserField.edited_jabatan.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedUserField.edited_jabatan.required && errors.push('Jabatan jangan lupa diisi.')
        return errors
      },
       edited_isAdminErrors () {
        const errors = []
        if (!this.$v.editedUserField.edited_isAdmin.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedUserField.edited_isAdmin.required && errors.push('Status Admin jangan lupa diisi.')
        return errors
      },
        },
        methods: {
           
            async deleteFinal(){
                console.log(this.selected_item.id)
                
               await axios.delete('/delete_user/'+this.selected_item.id, {
                        item: this.selected_item
                    }).then(response => {
                            console.log(response)
                            // this.getCurrentUser()
                             this.$v.$reset()
                             
                          const currentIndex = this.users_view.indexOf(this.selected_item)
                          
                            this.users_view.splice(currentIndex, 1)
                            this.delete_dialog = false
                        }
                    )
                    .catch(error => {
                        console.error(error);
                    })
                      
            },
            deleteDialog(item){
                this.selected_item = item
                this.delete_dialog = true
            },
            addUserDialog() {
                this.addeditUserDialog = true,
                    this.addeditUserTitle = 'Add User',

                    this.editedUserField.edited_nama = '',
                    this.editedUserField.edited_email = '',
                    this.editedUserField.edited_nip9digit = '',
                    this.editedUserField.edited_nip18digit = '',
                    this.editedUserField.edited_jabatan = '',
                    this.editedUserField.edited_isAdmin = ''
            },
            editUserDialog(item) {
                console.log(item.email)
                this.selected_item = item
                this.addeditUserDialog = true,
                    this.addeditUserTitle = 'Edit User'

                this.editedUserField.edited_nama = item.name,
                    this.editedUserField.edited_email = item.email,
                    this.editedUserField.edited_nip9digit = item.nip_pendek,
                    this.editedUserField.edited_nip18digit = item.nip_panjang,
                    this.editedUserField.edited_jabatan = item.jabatan.id,


                    this.editedUserField.edited_isAdmin = Boolean(item.is_admin) ? 'admin' : 'non admin'

                    console.log(this.editedUserField)

            },
            async submit(){
                console.log('submit', this.addeditUserTitle)
                if (this.addeditUserTitle == 'Add User') {
                    this.saveUser()
                } 

                if (this.addeditUserTitle == 'Edit User') {
                    this.saveEditedUser(this.selected_item)
                } 
            },
            async saveUser() {
                // ga perlu async await sebenrnya
                 this.$v.$touch()
                 console.log(this.$v.$touch)
                console.log('title',this.addeditUserTitle)

                if(
              
                     this.editedUserField.edited_nama == '' ||
                     this.editedUserField.edited_email == '' ||
                     this.editedUserField.edited_nip9digit == '' ||
                     this.editedUserField.edited_nip18digit == '' ||
                     this.editedUserField.edited_jabatan == '' ||
                     this.editedUserField.edited_isAdmin == '' ||
                      this.editedUserField.edited_nip9digit.length !== 9 ||
                     this.editedUserField.edited_nip18digit.length !== 18 
            
                ){
                    console.log('ada error')
                }else{
                await axios.post('/save_user', {
                        editedField: this.editedUserField
                    }).then(response => {
                            console.log(response)
                             this.$v.$reset()

                            //  const currentIndex = this.users_view.indexOf(this.selected_item)
                            // this.users_view.splice(currentIndex, 1)
                            this.users_view.push(this.editedUserField)
                            this.addeditUserDialog = false
                        }
                    )
                    .catch(error => {
                        console.error(error);
                    })
                }

                //option
                // try {
                //     var response = 
                //     await axios.post('/save_user' , {
                //     editedField: this.editedUserField
                // })
                //     console.log(response)
                //  this.addeditUserDialog = false
                // } catch (error) {
                //      console.error(error);
                // }


            },
            async saveEditedUser(item) {
                // ga perlu async await sebenrnya
                console.log('item edited', item)
                 this.$v.$touch()
                if(
              
                     this.editedUserField.edited_nama == '' ||
                     this.editedUserField.edited_email == '' ||
                     this.editedUserField.edited_nip9digit == '' ||
                     this.editedUserField.edited_nip18digit == '' ||
                     this.editedUserField.edited_jabatan == '' ||
                     this.editedUserField.edited_isAdmin == '' ||
                      this.editedUserField.edited_nip9digit.length !== 9 ||
                     this.editedUserField.edited_nip18digit.length !== 18 
            
                ){
                    console.log('ada error x')
                }else{
                await axios.post(`/save_edited_user/${this.selected_item.id}`, {
                        editedField: this.editedUserField
                    }).then(response => {
                            console.log(response)
                             
                             const currentIndex = this.users_view.indexOf(item)
                            console.log('currentINdex :', currentIndex)
                            var currentUser = this.users_view[currentIndex];
                            currentUser.name = this.editedUserField.edited_nama
                            currentUser.email = this.editedUserField.edited_email
                             
                            currentUser.nip_pendek =    this.editedUserField.edited_nip9digit,
                            currentUser.nip_panjang =    this.editedUserField.edited_nip18digit,
                            currentUser.jabatan_id =     this.editedUserField.edited_jabatan,
                            currentUser.is_admin =    this.editedUserField.edited_isAdmin == 'admin' ? 1 : 0

                            console.log('jv', this.jabatan_view)
                            // console.log('idj', this.editedUserFieldedited_jabatan)
                            var sj = this.jabatan_view.find(jabatan => jabatan.id == this.editedUserField.edited_jabatan  )
                            console.log('sj',sj)
                            currentUser.jabatan = sj
                            this.users_view[currentIndex] = currentUser;
                            console.log('current user : ', this.users_view[currentIndex])
                            this.addeditUserDialog = false
                            this.$v.$reset()

                        }
                    )
                    .catch(error => {
                        console.error(error);
                    })
                }

                //option
                // try {
                //     var response = 
                //     await axios.post('/save_user' , {
                //     editedField: this.editedUserField
                // })
                //     console.log(response)
                //  this.addeditUserDialog = false
                // } catch (error) {
                //      console.error(error);
                // }


            }
        }
    }

</script>
