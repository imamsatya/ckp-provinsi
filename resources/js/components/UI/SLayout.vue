<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" :clipped="$vuetify.breakpoint.lgAndUp" app>
            <v-list dense v-if="role != 6 && role != 2 && this.user.email != 'nyoman@bps.go.id' && this.user.email != 'rikarie@bps.go.id'">

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
                                <v-icon color="amber darken-3">{{ child.icon }}</v-icon>
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
                            <v-icon color="amber darken-3">{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>

            <v-list dense v-if="role == 6 && this.user.email != 'aw.murdan@bps.go.id'">

                <template v-for="item in items2">
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
                        :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" color="primary"
                        value="true">
                        <template v-slot:activator>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <!-- <v-list-group no-action  value="true"> -->

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
                        <!-- </v-list-group> -->
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

            

             <v-list dense v-if="role == 2 || this.user.email == 'nyoman@bps.go.id'">

                <template v-for="item in items3">
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
                        :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" color="primary"
                        value="true">
                        <template v-slot:activator>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }} 
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <!-- <v-list-group no-action  value="true"> -->

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
                        <!-- </v-list-group> -->
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

            <v-list dense v-if="role == 5 || this.user.email == 'rikarie@bps.go.id' || this.user.email == 'muznah@bps.go.id'">

                <template v-for="item in items3">
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
                        :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" color="primary"
                        value="true">
                        <template v-slot:activator>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }} 
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <!-- <v-list-group no-action  value="true"> -->

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
                        <!-- </v-list-group> -->
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

            <v-list dense v-if="this.user.email == 'aw.murdan@bps.go.id'">

                <template v-for="item in items4">
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
                        :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" color="primary"
                        value="true">
                        <template v-slot:activator>

                            <v-list-item-content>
                                <v-list-item-title>
                                    {{ item.text }} 
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <!-- <v-list-group no-action  value="true"> -->

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
                        <!-- </v-list-group> -->
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

        <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app color="primary" dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
                <span class="hidden-sm-and-down">CKP</span>
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

                    <v-btn rounded color="white primary--text" class="ma-2 text-capitalize" v-on="on">
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
        <!-- V1 -->
        <!-- <v-footer class="justify-center pl-0" padless inset app  hide-on-scroll  color="primary" dark>
            <v-card flat tile class="white--text text-center" color="primary" dark>
                <v-card-text class="white--text">
                    <p>Luaskan ilmu, luaskan manfaat <br>

                        [ ] dengan <span class="red--text animated 2s infinite fadeIn"> ❤ </span>
                        di Palu</p>
                    ©2020 — Imam Satya Wedhatama
                </v-card-text>
            </v-card>
        </v-footer> -->
        <!-- V2 -->
        <!-- <v-footer class=" pl-0" padless inset app color="primary" dark>
            <v-row>
                <v-col class="text-sm-left" cols="6">
                    <p style="padding: 10px">©2020 — Imam Satya Wedhatama</p>
                </v-col>
                <v-col class="text-sm-right" cols="6">
                    <p>Luaskan ilmu, luaskan manfaat <br>
                        [ ] dengan <span class="red--text animated 2s infinite fadeIn"> ❤ </span>
                        di Palu</p>
                </v-col>

            </v-row>
        </v-footer> -->

        <!-- V3 -->
        <!-- <v-footer class="justify-center pl-0" padless inset app color="primary" dark>
        <v-card-text class="py-2 white--text text-center">
         [ ] dengan <span class="red--text animated 2s infinite fadeIn"> ❤ </span>di Palu
        </v-card-text>
        </v-footer> -->

        <!-- V4 -->

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
            role: '',
            items: [{
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

            //staff
            items2: [{
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
                        }
                       

                    ],
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

            //kabid
            items3: [{
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
                        {
                            text: 'Rekap Nilai CKP',
                            icon: 'mdi-numeric-9-plus-box-multiple-outline',
                            route: '/ckp_ratarata'
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

            items4: [{
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
                        {
                            text: 'Rekap Nilai CKP',
                            icon: 'mdi-numeric-9-plus-box-multiple-outline',
                            route: '/ckp_ratarata'
                        },

                    ],
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
