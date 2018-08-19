const authenticate = (to, from, next) =>
{
	if(!localStorage.api_token && to.name == 'login') next()
	else if(!localStorage.api_token) next('/login')
	else if (localStorage.api_token) {
		next() 
		if(from.name == 'login' || to.name == 'login') {
			next('/home')
		} else {
			next()
		}
	}
}

export default authenticate