<template>
	<div class="slideUp">

		<v-container :class="showLogClass">
            <v-layout row wrap>
                <v-flex offset-sm2>

			        <div v-if="accessState">
			        	<transition 
                        name="slide"
                        mode="out-in"
                        >
                            <login/>
                    	</transition>
			        </div>
			        <div v-else>
	                    <transition 
	                    name="slide"
	                    mode="out-in"
	                    >
	                        <register />
	                    </transition>
                	</div>

				</v-flex>
        	</v-layout>
    	</v-container>

	</div>
</template>

<script>
	import 'animate.css'

	import Login from '@/components/auth_view/Login'
	import Register from '@/components/auth_view/Register'

	import { mapGetters } from 'vuex'

	export default {

		name: 'Home',
		components: {
			'login' : Login,
			'register': Register

		},
		computed: {
			...mapGetters ([
                'showLogClass',
                'accessState'
            ])
		}
	}
</script>

<style lang="css" scoped>
    .slideUp {
        animation: slides-up 0.25s ease-in;
    }

	.logincontain {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0px 5px 17px -3px rgba(0,0,0,0.75);
        width: 450px;
        margin-top: 100px;
        transition: all 0.3s ease-in;
    }

    .registercontain {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0px 5px 17px -3px rgba(0,0,0,0.75);
        width: 450px;
        margin-top: 85px;
        transition: all 0.2s ease-in;
    }

    .slide-enter-active{
        animation: slide-left 0.052s ease-in;
    }

    .slide-leave-active{
        animation: slide-right 0.052s ease-in;
    }

    @keyframes slides-up {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);   
            opacity: 1;
        }
    }

    @keyframes slide-left {
        from {
            transform: translateX(100px);
            opacity: 0;
        }
        to {
            transform: translateX(0);   
            opacity: 1;
        }
    }

    @keyframes slide-right {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(-100px);   
            opacity: 0;
        }
    }

    @media (min-width: 250px) and (max-width: 500px) {
        .registercontain {
            max-width: 335px;
            margin-top: 20px;
        }

        .logincontain {
            max-width: 335px;
            margin-top: 75px;
        }   
    }
</style>