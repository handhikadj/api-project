<template>
    <div>

        <!-- Sidebar -->
        <v-navigation-drawer
        fixed
        app
        clipped
        v-model="drawer"
        :width="miniVariant"
        @mouseover.native="mini = false"
        @mouseleave.native="mini = true"
        >
            <v-list class="list-mar">

                <v-list-tile @click.stop="$router.push('/home')" class="">
                    <v-list-tile-action>
                        <v-icon>account_balance</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Home</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>
                <v-list-tile @click.stop="$router.push('/product')">
                    <v-list-tile-action>
                        <v-icon>account_balance_wallet</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Master Barang</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>
                <v-list-tile @click.stop="$router.push('/home')">
                    <v-list-tile-action>
                        <v-icon>shopping_cart</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Pembelian</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>
                <v-list-tile @click.stop="$router.push('/home')">
                    <v-list-tile-action>
                        <v-icon>add_shopping_cart</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Penjualan</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>
                <v-list-tile @click.stop="$router.push('/home')">
                    <v-list-tile-action>
                        <v-icon>book</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Inventory</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>
                <v-list-tile @click.stop="logOut">
                    <v-list-tile-action>
                        <v-icon>power_settings_new</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Log Out</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark></v-divider>

            </v-list>
        </v-navigation-drawer>

        <!-- Header -->
        <v-toolbar color="cyan darken-2" dark fixed app>
            <v-toolbar-side-icon @click.stop="mini = !mini"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
        </v-toolbar>

    </div>
</template>

<script>
    export default {

        name: 'HeaderSidebar',
        data() {
            return {
                drawer: true,
                mini: false,
            }
        },
        computed: {
            miniVariant() {
                return this.mini ? 250 : 300
            }
        },
        methods: {
            logOut() {
                localStorage.removeItem('api_token')
                this.$router.replace('/')
            }
        }

    } // end of export default

</script>

<style lang="css">
    .list-mar {
        margin-top: 30px;
        transition: all .2s ease-in;
    }
</style>