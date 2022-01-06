<template>
    <div>
        <User :users="this.users" :jabatans="this.jabatans" ></User>
        <!-- Jabatan Tabel -->
        <br><br><br>
        <Jabatan :jabatans="this.jabatans"></Jabatan>
        
    </div>
</template>
<script>
    import Jabatan from './Admin/Jabatan.vue' 
    import User from './Admin/User.vue' 

    export default {
        components: {
             Jabatan:()=>import('./Admin/Jabatan.vue'),
             User:()=>import( './Admin/User.vue')
        },
        props: ['users', 'jabatans'],
        
       
    }

</script>
