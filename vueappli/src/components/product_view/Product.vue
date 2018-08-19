<template>
    <div>
        <header-dash />

        	<transition name="custom"
            enter-active-class="animated fadeIn"
            mode="out-in">
        	   <product-content />
            </transition>               

        <footer-dash />
    </div>
</template>

<script>
    import 'animate.css'
    import Header from '@/components/base_layout/HeaderSidebar'
    import Footer from '@/components/base_layout/FooterVue'
    import Content from '@/components/product_view/ProductContent'

    export default {

    name: 'Dashboard',
    components: {
        'header-dash': Header,
        'footer-dash': Footer,
        'product-content': Content
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
</style>