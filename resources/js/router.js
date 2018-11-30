import VueRouter from 'vue-router' 
import MainComponent from './components/MainComponent'
import HomeComponent from './components/HomeComponent'
import DashboardComponent from './components/DashboardComponent'
import AboutComponent from './components/AboutComponent'

export const router = new VueRouter({ 
    mode: 'history', 
    
    routes: [ 
        {
            path: '/', 
            component: MainComponent,
    
            children: [ 
                {
                    path: '',
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