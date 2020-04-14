import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const account = {
    state:{
        username: '',
        password: ''
    }
}

const ckpt = {
    state:{
        jenis_kegiatan: [
            'Utama',
            'Tambahan',
            
          ],
          uraian_kegiatan: '',
          satuan: '',
          target_kuantitas: '',
          kode_butir_kegiatan: '',
          angka_kredit: '',
          keterangan:'',
          bulan: ''
    }
}

export const store = new Vuex.Store({
    modules:{
        ckpt: ckpt
    },
    state:{
        loader: false
    },
    mutations:{
        LOADER(state, payload){
            state.loader = payload
        }
    }
})