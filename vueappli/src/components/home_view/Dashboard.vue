<template>
    <div>
        <header-dash />
            <transition name="custom"
            enter-active-class="animated bounce"
            leave-active-class="animated fadeOut"
            mode="out-in">
                <dashboard-content />
            </transition>

        <footer-dash />
    </div>
</template>

<script>
    import 'animate.css'
    import Header from '@/components/base_layout/HeaderSidebar'
    import Footer from '@/components/base_layout/FooterVue'
    import Content from '@/components/home_view/DashboardContent'

    export default {

        name: 'Dashboard',
        components: {
            'header-dash': Header,
            'footer-dash': Footer,
            'dashboard-content': Content
        },
        data () {
            return {
        	   msgme: 'vue'
            }
        }
    }
</script>

<style lang="css" scoped>
	a {
        text-decoration: none;
    }
/*
    .fade-enter-active {
        opacity: 1
    }

    .fade-leave-active {
        opacity: 0;
    }*/
</style>