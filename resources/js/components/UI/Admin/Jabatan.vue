<template>
    <div>
        <v-card-title>

            <v-btn  small class="ma-2" tile style="background-color: #7367f0;color: white;"
                @click="addJabatanDialog()">
                <v-icon left>mdi-plus</v-icon> Jabatan
            </v-btn>

            <v-spacer></v-spacer>
            <v-text-field dark v-model="search2" append-icon="mdi-magnify" label="Search" single-line hide-details>
            </v-text-field>

        </v-card-title>

      <!-- <p style="color: white;">{{this.jabatan_view[0]}}</p> -->
        <v-data-table dark style="background-color: #161d31; color: white;" :headers="headers2" :items="jabatan_view"
            class="elevation-1" :search="search2">
            <template style="color:white;" v-slot:item.aksi="{ item }">

                <v-btn style="background-color: #7367f0;color: white;" fab x-small dark @click="editDialog(item)">
                    <v-icon small @click="editDialog(item)">mdi-pencil</v-icon>
                </v-btn>

                <v-btn style="background-color: #ea5455;color:white;" fab x-small dark @click="deleteDialog(item)">
                    <v-icon small @click="deleteDialog(item)">mdi-delete</v-icon>
                </v-btn>

            </template>
            <template v-slot:item.jabatan_kantor="{ item }">

                {{ item.jabatan_kantor }}
            </template>

            <template v-slot:item.role="{ item }">

                {{ item.role }}
            </template>
        </v-data-table>

        <!-- add edit -->
        <v-dialog v-model="addeditJabatanDialog" persistent max-width="600px">

            <v-card style="background-color: #161d31;" class="white--text">
                <v-card-title>
                    <span class="headline">{{addeditJabatanTitle}}</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>

                            <v-col cols="12" sm="12">
                                <v-text-field dark v-model="editedJabatanField.jabatan_kantor"
                                    :error-messages="jabatan_kantorErrors" label="Jabatan Kantor" required
                                    @input="$v.editedJabatanField.jabatan_kantor.$touch()"
                                    @blur="$v.editedJabatanField.jabatan_kantor.$touch()"></v-text-field>

                                <v-text-field  dark v-model="editedJabatanField.role"
                                    :error-messages="roleErrors" label="Role" required
                                    @input="$v.editedJabatanField.role.$touch()"
                                    @blur="$v.editedJabatanField.role.$touch()"></v-text-field>

                              
                            </v-col>

                        </v-row>
                    </v-container>
                    <small style="color: white;">*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn style="background-color: #ea5455;color:white;" text @click="addeditJabatanDialog = false">Close
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
        
    } from 'vuelidate/lib/validators'
export default {
    
    mixins: [validationMixin],

        validations: {

            editedJabatanField:{          
            jabatan_kantor: {
                required

            },
            role: {
                required,
              
            },
            }
         
        },
     props: ['jabatans'],
      beforeMount(){
        
            this.jabatan_view = this.jabatans
        },
     data: () => ({
         
           headers2: [{
                    text: 'Aksi',
                    value: 'aksi',
                    width: 100
                },
                {
                    text: 'Jabatan Kantor',
                    align: 'start',
                    sortable: false,
                    value: 'jabatan_kantor',
                },
                {
                    text: 'Role',
                    value: 'role'
                },
            ],
           search2: '',
           
           delete_dialog: false,
           addeditJabatanDialog: false,
           addeditJabatanTitle: '',

            editedJabatanField: {
                jabatan_kantor: '',
                role: '',
            },
            selected_item: null,
            users_view: null,
            delete_dialog: false,
            jabatan_view: false,
     }),
     computed:{
         
              jabatan_kantorErrors () {
        const errors = []
        if (!this.$v.editedJabatanField.jabatan_kantor.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedJabatanField.jabatan_kantor.required && errors.push('Jabatan antor lupa diisi.')
        return errors
      },
      roleErrors () {
        const errors = []
        if (!this.$v.editedJabatanField.role.$dirty) return errors
        // !this.$v.uraian_kegiatan.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.editedJabatanField.role.required && errors.push('Role jangan lupa diisi.')
        return errors
      },
     },
     methods: {
         addJabatanDialog(){
            this.addeditJabatanDialog = true,
            this.addeditJabatanTitle = 'Add Jabatan'

             this.editedJabatanField.jabatan_kantor = '',
            this.editedJabatanField.role = ''
         },
         editDialog(item){
             this.addeditJabatanDialog = true,
             this.addeditJabatanTitle = 'Edit Jabatan'
             this.selected_item = item
             this.editedJabatanField.jabatan_kantor = item.jabatan_kantor
             this.editedJabatanField.role = item.role
         },
           async submit(){
                console.log('submit', this.addeditJabatanTitle)
                if (this.addeditJabatanTitle == 'Add Jabatan') {
                    this.save()
                } 

                if (this.addeditJabatanTitle == 'Edit Jabatan') {
                    this.saveEdited(this.selected_item)
                } 
            },
            async save() {
                // ga perlu async await sebenrnya
                 this.$v.$touch()
                 console.log(this.$v.$touch)
                

                if(
              
                     this.editedJabatanField.jabatan_kantor == '' ||
                     this.editedJabatanField.role == '' 
                     
            
                ){
                    console.log('ada error')
                }else{
                await axios.post('/save_jabatan', {
                        editedField: this.editedJabatanField
                    }).then(response => {
                            console.log(response)
                             this.$v.$reset()

                            //  const currentIndex = this.users_view.indexOf(this.selected_item)
                            // this.users_view.splice(currentIndex, 1)
                            this.jabatan_view.push(this.editedJabatanField)
                            this.addeditJabatanDialog = false
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
            async saveEdited(item) {
                // ga perlu async await sebenrnya
                console.log('item edited', item)
                 this.$v.$touch()
                if(
              
                      this.editedJabatanField.jabatan_kantor == '' ||
                     this.editedJabatanField.role == '' 
            
                ){
                    console.log('ada error x')
                }else{
                await axios.post(`/save_edited_jabatan/${this.selected_item.id}`, {
                        editedField: this.editedJabatanField
                    }).then(response => {
                            console.log(response)
                             
                             const currentIndex = this.jabatan_view.indexOf(item)
                            
                            var currentJabatan = this.jabatan_view[currentIndex];
                            currentJabatan.jabatan_kantor = this.editedJabatanField.jabatan_kantor
                            currentJabatan.role = this.editedJabatanField.role
                            
                            
                            this.jabatan_view[currentIndex] = currentJabatan;
                           
                            this.addeditJabatanDialog = false
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


            },
              async deleteFinal(){
                console.log(this.selected_item.id)
                
               await axios.delete('/delete_jabatan/'+this.selected_item.id, {
                        item: this.selected_item
                    }).then(response => {
                            console.log(response)
                            // this.getCurrentUser()
                             this.$v.$reset()
                             
                          const currentIndex = this.jabatan_view.indexOf(this.selected_item)
                          
                            this.jabatan_view.splice(currentIndex, 1)
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
     }
}
</script>