<template>
    <div>

        <!-- Sidebar -->
        <v-navigation-drawer
        fixed
        app
        clipped
        v-model="drawer"
        :mini-variant.sync="mini"
        miniVariantWidth="200"
        @mouseover.native="mini = false"
        @mouseleave.native="mini = true"
        >
            <v-list class="list-mar">

                <v-list-tile @click.stop="homeView" class="">
                    <v-list-tile-action>
                        <v-icon>account_balance</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Home</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>
                <v-list-tile @click.stop="productView">
                    <v-list-tile-action>
                        <v-icon>account_balance_wallet</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Master Barang</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>
                <v-list-tile @click.stop="purchaseView">
                    <v-list-tile-action>
                        <v-icon>shopping_cart</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Pembelian</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>
                <v-list-tile @click.stop="saleView">
                    <v-list-tile-action>
                        <v-icon>add_shopping_cart</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Penjualan</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>
                <v-list-tile @click.stop="inventoryView">
                    <v-list-tile-action>
                        <v-icon>book</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Inventory</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>
                <v-list-tile @click.stop="logOut">
                    <v-list-tile-action>
                        <v-icon color="red">power_settings_new</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Log Out</v-list-tile-title>
                </v-list-tile>
                <v-divider inset dark class="divided"></v-divider>

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
                drawer: null,
                mini: false,
            }
        },
        methods: {
            homeView() {
                this.$router.push('/home') 
                document.title = "Home"
            },
            productView() {
                this.$router.push('/product') 
                document.title = "Master Barang"
            },
            purchaseView() {
                this.$router.push('/purchase') 
                document.title = "Pembelian"
            },
            saleView() {
                this.$router.push('/sale') 
                document.title = "Penjualan"
            },
            inventoryView() {
                this.$router.push('/inventory') 
                document.title = "Inventory"
            },
            logOut() {
                localStorage.removeItem('api_token')
                this.$router.replace('/')
                document.title = "Login"
            }
        }

    } // end of export default

</script>

<style lang="css" scoped>
    .list-mar {
        margin-top: 30px;
        transition: all .2s ease-in;
    }

    .divided {
        padding: 0.5px;
        background-color: green;
    }
</style>