export default {
	state: {
		showLogin: true,
		title: true
	},

	getters: {
		showLogClass(state, getters) {
			return state.showLogin ? 'logincontain' : 'registercontain'
		},

		accessState(state, getters) {
			return state.showLogin
		}
	},

	mutations: {
		ubahAuth(state) {
			state.showLogin = !state.showLogin
		}
	},

	actions:{
		clickLogin( {commit} ) {
			 commit('ubahAuth')
		}
	}

} // end of export module