(window.webpackJsonp=window.webpackJsonp||[]).push([[3],{15:function(e,i,t){"use strict";t.r(i);var d=t(0),n=t.n(d),a=t(5),r=t(1);function s(e,i,t,d,n,a,r){try{var s=e[a](r),l=s.value}catch(e){return void t(e)}s.done?i(l):Promise.resolve(l).then(d,n)}function l(e){return function(){var i=this,t=arguments;return new Promise((function(d,n){var a=e.apply(i,t);function r(e){s(a,d,n,r,l,"next",e)}function l(e){s(a,d,n,r,l,"throw",e)}r(void 0)}))}}var o={props:["users","jabatans"],mixins:[a.validationMixin],validations:{editedUserField:{edited_nama:{required:r.required},edited_email:{required:r.required,email:r.email},edited_nip9digit:{required:r.required,maxLength:Object(r.maxLength)(9),minLength:Object(r.minLength)(9)},edited_nip18digit:{required:r.required},edited_jabatan:{required:r.required},edited_isAdmin:{required:r.required}},checkbox:{checked:function(e){return e}}},beforeMount:function(){this.users_view=this.users,this.jabatan_view=this.jabatans},mounted:function(){},data:function(){return{adminOptions:["admin","non admin"],addeditUserDialog:!1,addeditUserTitle:"",search:"",headers:[{text:"Aksi",value:"aksi",width:100},{text:"Nama",align:"start",sortable:!1,value:"name"},{text:"Email",align:"start",sortable:!1,value:"email"},{text:"NIP 9 digit",value:"nip_pendek"},{text:"NIP 18 Digit",value:"nip_panjang"},{text:"Jabatan",value:"jabatan.jabatan_kantor"},{text:"Admin",value:"is_admin"}],editedUserField:{edited_nama:"",edited_email:"",edited_nip9digit:"",edited_nip18digit:"",edited_jabatan:"",edited_isAdmin:""},selected_item:null,users_view:null,delete_dialog:!1,jabatan_view:!1}},computed:{edited_namaErrors:function(){var e=[];return this.$v.editedUserField.edited_nama.$dirty?(!this.$v.editedUserField.edited_nama.required&&e.push("Nama jangan lupa diisi."),e):e},edited_emailErrors:function(){var e=[];return this.$v.editedUserField.edited_email.$dirty?(!this.$v.editedUserField.edited_email.required&&e.push("Email jangan lupa diisi."),e):e},edited_nip9digitErrors:function(){var e=[];return this.$v.editedUserField.edited_nip9digit.$dirty?(!this.$v.editedUserField.edited_nip9digit.maxLength&&e.push("NIP harus 9 digit"),!this.$v.editedUserField.edited_nip9digit.minLength&&e.push("NIP harus 9 digit"),!this.$v.editedUserField.edited_nip9digit.required&&e.push("NIP harus 9 digit"),e):e},edited_nip18digitErrors:function(){var e=[];return this.$v.editedUserField.edited_nip18digit.$dirty?(!this.$v.editedUserField.edited_nip18digit.required&&e.push("NIP harus 18 digit"),e):e},edited_jabatanErrors:function(){var e=[];return this.$v.editedUserField.edited_jabatan.$dirty?(!this.$v.editedUserField.edited_jabatan.required&&e.push("Jabatan jangan lupa diisi."),e):e},edited_isAdminErrors:function(){var e=[];return this.$v.editedUserField.edited_isAdmin.$dirty?(!this.$v.editedUserField.edited_isAdmin.required&&e.push("Status Admin jangan lupa diisi."),e):e}},methods:{deleteFinal:function(){var e=this;return l(n.a.mark((function i(){return n.a.wrap((function(i){for(;;)switch(i.prev=i.next){case 0:return console.log(e.selected_item.id),i.next=3,axios.delete("/delete_user/"+e.selected_item.id,{item:e.selected_item}).then((function(i){console.log(i),e.$v.$reset();var t=e.users_view.indexOf(e.selected_item);e.users_view.splice(t,1),e.delete_dialog=!1})).catch((function(e){console.error(e)}));case 3:case"end":return i.stop()}}),i)})))()},deleteDialog:function(e){this.selected_item=e,this.delete_dialog=!0},addUserDialog:function(){this.addeditUserDialog=!0,this.addeditUserTitle="Add User",this.editedUserField.edited_nama="",this.editedUserField.edited_email="",this.editedUserField.edited_nip9digit="",this.editedUserField.edited_nip18digit="",this.editedUserField.edited_jabatan="",this.editedUserField.edited_isAdmin=""},editUserDialog:function(e){console.log(e.email),this.selected_item=e,this.addeditUserDialog=!0,this.addeditUserTitle="Edit User",this.editedUserField.edited_nama=e.name,this.editedUserField.edited_email=e.email,this.editedUserField.edited_nip9digit=e.nip_pendek,this.editedUserField.edited_nip18digit=e.nip_panjang,this.editedUserField.edited_jabatan=e.jabatan.id,this.editedUserField.edited_isAdmin=Boolean(e.is_admin)?"admin":"non admin",console.log(this.editedUserField)},submit:function(){var e=this;return l(n.a.mark((function i(){return n.a.wrap((function(i){for(;;)switch(i.prev=i.next){case 0:console.log("submit",e.addeditUserTitle),"Add User"==e.addeditUserTitle&&e.saveUser(),"Edit User"==e.addeditUserTitle&&e.saveEditedUser(e.selected_item);case 3:case"end":return i.stop()}}),i)})))()},saveUser:function(){var e=this;return l(n.a.mark((function i(){return n.a.wrap((function(i){for(;;)switch(i.prev=i.next){case 0:if(e.$v.$touch(),console.log(e.$v.$touch),console.log("title",e.addeditUserTitle),""!=e.editedUserField.edited_nama&&""!=e.editedUserField.edited_email&&""!=e.editedUserField.edited_nip9digit&&""!=e.editedUserField.edited_nip18digit&&""!=e.editedUserField.edited_jabatan&&""!=e.editedUserField.edited_isAdmin&&9===e.editedUserField.edited_nip9digit.length&&18===e.editedUserField.edited_nip18digit.length){i.next=7;break}console.log("ada error"),i.next=9;break;case 7:return i.next=9,axios.post("/save_user",{editedField:e.editedUserField}).then((function(i){console.log(i),e.$v.$reset(),e.users_view.push(e.editedUserField),e.addeditUserDialog=!1})).catch((function(e){console.error(e)}));case 9:case"end":return i.stop()}}),i)})))()},saveEditedUser:function(e){var i=this;return l(n.a.mark((function t(){return n.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(console.log("item edited",e),i.$v.$touch(),""!=i.editedUserField.edited_nama&&""!=i.editedUserField.edited_email&&""!=i.editedUserField.edited_nip9digit&&""!=i.editedUserField.edited_nip18digit&&""!=i.editedUserField.edited_jabatan&&""!=i.editedUserField.edited_isAdmin&&9===i.editedUserField.edited_nip9digit.length&&18===i.editedUserField.edited_nip18digit.length){t.next=6;break}console.log("ada error x"),t.next=8;break;case 6:return t.next=8,axios.post("/save_edited_user/".concat(i.selected_item.id),{editedField:i.editedUserField}).then((function(t){console.log(t);var d=i.users_view.indexOf(e);console.log("currentINdex :",d);var n=i.users_view[d];n.name=i.editedUserField.edited_nama,n.email=i.editedUserField.edited_email,n.nip_pendek=i.editedUserField.edited_nip9digit,n.nip_panjang=i.editedUserField.edited_nip18digit,n.jabatan_id=i.editedUserField.edited_jabatan,n.is_admin="admin"==i.editedUserField.edited_isAdmin?1:0,console.log("jv",i.jabatan_view);var a=i.jabatan_view.find((function(e){return e.id==i.editedUserField.edited_jabatan}));console.log("sj",a),n.jabatan=a,i.users_view[d]=n,console.log("current user : ",i.users_view[d]),i.addeditUserDialog=!1,i.$v.$reset()})).catch((function(e){console.error(e)}));case 8:case"end":return t.stop()}}),t)})))()}}},c=t(2),u=Object(c.a)(o,(function(){var e=this,i=e.$createElement,t=e._self._c||i;return t("div",[t("v-card-title",[t("v-btn",{staticClass:"ma-2",staticStyle:{"background-color":"#7367f0",color:"white"},attrs:{small:"",tile:""},on:{click:function(i){return e.addUserDialog()}}},[t("v-icon",{attrs:{left:""}},[e._v("mdi-plus")]),e._v(" User\n        ")],1),e._v(" "),t("v-spacer"),e._v(" "),t("v-text-field",{attrs:{dark:"","append-icon":"mdi-magnify",label:"Search","single-line":"","hide-details":""},model:{value:e.search,callback:function(i){e.search=i},expression:"search"}})],1),e._v(" "),t("p",{staticStyle:{color:"white"}},[e._v(e._s(this.users[0]))]),e._v(" x \n    "),t("v-data-table",{staticClass:"elevation-1",staticStyle:{"background-color":"#161d31",color:"white"},attrs:{dark:"",headers:e.headers,items:e.users_view,search:e.search},scopedSlots:e._u([{key:"item.aksi",fn:function(i){var d=i.item;return[t("v-btn",{staticStyle:{"background-color":"#7367f0",color:"white"},attrs:{fab:"","x-small":"",dark:""},on:{click:function(i){return e.editUserDialog(d)}}},[t("v-icon",{attrs:{small:""},on:{click:function(i){return e.editUserDialog(d)}}},[e._v("mdi-pencil")])],1),e._v(" "),t("v-btn",{staticStyle:{"background-color":"#ea5455",color:"white"},attrs:{fab:"","x-small":"",dark:""},on:{click:function(i){return e.deleteDialog(d)}}},[t("v-icon",{attrs:{small:""},on:{click:function(i){return e.deleteDialog(d)}}},[e._v("mdi-delete")])],1)]}},{key:"item.name",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.name)+"\n        ")]}},{key:"item.email",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.email)+"\n        ")]}},{key:"item.nip_pendek",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.nip_pendek)+"\n        ")]}},{key:"item.nip_panjang",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.nip_panjang)+"\n        ")]}},{key:"item.jabatan.jabatan_kantor",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.jabatan.jabatan_kantor)+"\n        ")]}},{key:"item.is_admin",fn:function(i){var t=i.item;return[e._v("\n\n            "+e._s(t.is_admin)+"\n        ")]}}])}),e._v(" "),t("v-dialog",{attrs:{persistent:"","max-width":"600px"},model:{value:e.addeditUserDialog,callback:function(i){e.addeditUserDialog=i},expression:"addeditUserDialog"}},[t("v-card",{staticClass:"white--text",staticStyle:{"background-color":"#161d31"}},[t("v-card-title",[t("span",{staticClass:"headline"},[e._v(e._s(e.addeditUserTitle))])]),e._v(" "),t("v-card-text",[t("v-container",[t("v-row",[t("v-col",{attrs:{cols:"12",sm:"12"}},[t("v-text-field",{attrs:{dark:"","error-messages":e.edited_namaErrors,label:"Nama *",required:""},on:{input:function(i){return e.$v.editedUserField.edited_nama.$touch()},blur:function(i){return e.$v.editedUserField.edited_nama.$touch()}},model:{value:e.editedUserField.edited_nama,callback:function(i){e.$set(e.editedUserField,"edited_nama",i)},expression:"editedUserField.edited_nama"}}),e._v(" "),t("v-text-field",{attrs:{type:"email",dark:"","error-messages":e.edited_emailErrors,label:"Email *",required:""},on:{input:function(i){return e.$v.editedUserField.edited_email.$touch()},blur:function(i){return e.$v.editedUserField.edited_email.$touch()}},model:{value:e.editedUserField.edited_email,callback:function(i){e.$set(e.editedUserField,"edited_email",i)},expression:"editedUserField.edited_email"}}),e._v(" "),t("v-text-field",{attrs:{type:"number",dark:"",counter:"9","error-messages":e.edited_nip9digitErrors,label:"NIP 9 Digit *",required:"",maxlength:"9"},on:{input:function(i){return e.$v.editedUserField.edited_nip9digit.$touch()},blur:function(i){return e.$v.editedUserField.edited_nip9digit.$touch()}},model:{value:e.editedUserField.edited_nip9digit,callback:function(i){e.$set(e.editedUserField,"edited_nip9digit",i)},expression:"editedUserField.edited_nip9digit"}}),e._v(" "),t("v-text-field",{attrs:{type:"number",dark:"",counter:"18","error-messages":e.edited_nip18digitErrors,label:"NIP 18 Digit *",required:"",rules:[function(e){return 18==e.length||"Harus 18 digit"}],maxlength:"18"},on:{input:function(i){return e.$v.editedUserField.edited_nip18digit.$touch()},blur:function(i){return e.$v.editedUserField.edited_nip18digit.$touch()}},model:{value:e.editedUserField.edited_nip18digit,callback:function(i){e.$set(e.editedUserField,"edited_nip18digit",i)},expression:"editedUserField.edited_nip18digit"}}),e._v(" "),t("v-select",{attrs:{dark:"",items:e.jabatans,"item-text":"jabatan_kantor","item-value":"id","error-messages":e.edited_jabatanErrors,label:"Jabatan *",required:""},on:{change:function(i){return e.$v.editedUserField.edited_jabatan.$touch()},blur:function(i){return e.$v.editedUserField.edited_jabatan.$touch()}},model:{value:e.editedUserField.edited_jabatan,callback:function(i){e.$set(e.editedUserField,"edited_jabatan",i)},expression:"editedUserField.edited_jabatan"}}),e._v(" "),t("v-select",{attrs:{dark:"",items:e.adminOptions,"error-messages":e.edited_isAdminErrors,label:"Admin *",required:""},on:{change:function(i){return e.$v.editedUserField.edited_isAdmin.$touch()},blur:function(i){return e.$v.editedUserField.edited_isAdmin.$touch()}},model:{value:e.editedUserField.edited_isAdmin,callback:function(i){e.$set(e.editedUserField,"edited_isAdmin",i)},expression:"editedUserField.edited_isAdmin"}})],1)],1)],1),e._v(" "),t("small",{staticStyle:{color:"white"}},[e._v("*indicates required field")])],1),e._v(" "),t("v-card-actions",[t("v-spacer"),e._v(" "),t("v-btn",{staticStyle:{"background-color":"#ea5455",color:"white"},attrs:{text:""},on:{click:function(i){e.addeditUserDialog=!1}}},[e._v("Close\n                ")]),e._v(" "),t("v-btn",{staticStyle:{"background-color":"#7367f0",color:"white"},attrs:{text:""},on:{click:function(i){return e.submit()}}},[e._v("Save")])],1)],1)],1),e._v(" "),t("v-dialog",{attrs:{"max-width":"290"},model:{value:e.delete_dialog,callback:function(i){e.delete_dialog=i},expression:"delete_dialog"}},[t("v-card",{staticStyle:{"background-color":"#161d31",color:"white"}},[t("v-card-title",{staticClass:"headline"},[e._v("Yakin ?")]),e._v(" "),t("v-card-text",{staticClass:"white--text"},[e._v("\n                Kamu akan menghapusnya untuk selama - lamanya\n            ")]),e._v(" "),t("v-card-actions",[t("v-spacer"),e._v(" "),t("v-btn",{staticStyle:{"background-color":"#ea5455",color:"white"},attrs:{text:""},on:{click:function(i){e.delete_dialog=!1}}},[e._v("\n                    Ngga jadi deh\n                ")]),e._v(" "),t("v-btn",{staticStyle:{"background-color":"#28c76f",color:"white"},attrs:{text:""},on:{click:function(i){return e.deleteFinal()}}},[e._v("\n                    Iya beneran\n                ")])],1)],1)],1)],1)}),[],!1,null,null,null);i.default=u.exports}}]);
//# sourceMappingURL=3.js.map