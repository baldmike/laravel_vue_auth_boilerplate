import VueRouter from 'vue-router' 
import mainApp from './mainApp'
import HomeComponent from './components/HomeComponent'
import DashboardComponent from './components/DashboardComponent'
import AboutComponent from './components/AboutComponent'
import LoginComponent from './components/LoginComponent'

export const router = new VueRouter({ 
    mode: 'history', 
    
    routes: [ 
        {
            path: '/', 
            component: mainApp,
    
            children: [
                {
                    path: 'login',
                    component: LoginComponent
                },
                {
                    path: 'home',
                    component: HomeComponent
                },
                {
                    path: 'dashboard',
                    component: DashboardComponent
                },
                {
                    path: 'about',
                    component: AboutComponent
                }
            ]
        },
    ]
})

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
})
  
router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})