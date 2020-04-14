<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
            <v-list dense>
                <template v-for="item in items">
                    <v-row v-if="item.heading" :key="item.heading" align="center">
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }} asdads
                            </v-subheader>
                        </v-col>
                        <v-col cols="6" class="text-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-col>
                    </v-row>
                    <v-list-group v-if="item.children" :key="item.text" v-model="item.model"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" color="primary">
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <v-list-item v-for="(child, i) in item.children" :key="i" link @click="goTo(child)">
                            <v-list-item-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ child.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>

                    <v-list-item v-else :key="item.text" link @click="goTo(item)">
                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="blue darken-3" dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
                <span class="hidden-sm-and-down">CKP Banget Deh</span>
            </v-toolbar-title>
            <!-- <v-text-field flat solo-inverted hide-details prepend-inner-icon="mdi-magnify" label="Search"
                class="hidden-sm-and-down" /> -->
            <v-spacer />
            <!-- <v-btn icon>
                <v-icon>mdi-apps</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-bell</v-icon>
            </v-btn> -->
            <v-menu transition="slide-y-reverse-transition">
                <template v-slot:activator="{ on }">

                    <v-btn rounded  color="white primary--text" class="ma-2 text-capitalize"  v-on="on">
                        <v-icon left>mdi-chevron-down</v-icon>{{user.name}}
                    </v-btn>
                </template>
                <v-list>
                    
                    <v-list-item link @click="logout()">
                        <v-list-item-action>
                            <v-icon>mdi-logout</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                Logout
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>


            </v-menu>
        </v-app-bar>
        <v-content class="grey lighten-3">

            <v-container>


                <slot></slot>

            </v-container>



        </v-content>
        <v-footer class="indigo justify-center pl-0" padless inset app>
            <v-card flat tile class="indigo  white--text text-center">
                <v-card-text class="white--text">
                    <p>Luaskan ilmu, luaskan manfaat <br>

                        [ ] dengan <span class="red--text"> ❤ </span>
                        <!-- <q-spinner-hearts class="animated 2s infinite fadeIn" color="red" size="2.5em" /> -->
                        di Palu</p>
                    ©2020 — Imam Satya Wedhatama 


                    <!-- {{ new Date().getFullYear() }} — <strong>Vuetify</strong> -->
                </v-card-text>
            </v-card>
        </v-footer>

     
    </v-app>
</template>

<script>
    export default {
        props: {
            source: String,
        },
        data: () => ({
            dialog: false,
            drawer: null,
            user: '',
            role:'',
            items: [
                {
                    icon: 'mdi-chevron-up',
                    'icon-alt': 'mdi-chevron-down',
                    text: 'CKP',
                    model: false,
                    children: [{
                            text: 'Form CKP',
                            icon: 'mdi-clipboard-text',
                            route: '/home'
                        },
                        {
                            text: 'CKP Setiap Bulan',
                            icon: 'mdi-calendar-range',
                            route: '/ckp_bulan'
                        },

                    ],
                },
                {
                    icon: 'mdi-sticker-check',
                    text: 'Penilaian',
                    route: '/penilaian',
                },
                {
                    icon: 'mdi-settings',
                    text: 'Settings',
                    route: '/settings'
                },
                {
                    icon: 'mdi-information',
                    text: 'About',
                    route: '/about'
                },
                // {
                //     icon: 'mdi-message',
                //     text: 'Send feedback'
                // },
                // {
                //     icon: 'mdi-help-circle',
                //     text: 'Help'
                // },
                // {
                //     icon: 'mdi-cellphone-link',
                //     text: 'App downloads'
                // },
                // {
                //     icon: 'mdi-keyboard',
                //     text: 'Go to the old version'
                // },
            ],
        }),
        methods: {
            goTo(item) {
                // console.log(item.route)
                window.location.href = item.route
            },
            async logout() {
                await axios.get('/logout')
                window.location.href = "/"

            },
            async get_user() {
                await axios.get('/get_user').then(response => {

                    //Logic goes here
                    this.tes = response.data
                    

                }).catch(error => {
                    alert(error);
                });
                this.user = this.tes[0]
                this.role = this.tes[1]
                console.log(this.user.name)
            }
        },
        beforeMount() {
            console.log('halo')
            this.get_user()


        },


    }

</script>
