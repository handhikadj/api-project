<template>    
    <div class="animated fadeIn" ref="homevue">
        <header-dash />
            <v-content>
                <v-container grid-list-lg>
                    
                    <transition name="fadeUp"
                    mode="out-in">
                        <router-view />
                    </transition>
                        
                </v-container>
            </v-content>
        <footer-dash />
    </div>
</template>

<script>
    import 'animate.css'
    import Header from '@/components/base_layout/HeaderSidebar'
    import Footer from '@/components/base_layout/FooterVue'

    export default {
        name: 'Dashboard',
        components: {
            'header-dash': Header,
            'footer-dash': Footer,
        },
        props: {
          source: String
        }
    }
</script>

<style lang="css" scoped>
	a {                                       
        text-decoration: none;
    }

    .fadeUp-enter-active {
        animation: fades 0.25s linear;
    }

    .fadeUp-leave-active {
        animation: fades-up 0.25s ease-out;
    }

    .fadeouts {
        animation: fadedout 0.4s ease-out;
    }

    @keyframes fades {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fades-up {
        from {
            transform: translateY(0);
            opacity: 1;
        }
        to {
            transform: translateY(-10px);   
            opacity: 0;
        }
    }

    @keyframes fadedout {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>