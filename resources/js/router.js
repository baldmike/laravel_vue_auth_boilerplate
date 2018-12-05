import VueRouter from 'vue-router' 
import store from './store'
import mainApp from './mainApp'
import HomeComponent from './components/HomeComponent'
import DashboardComponent from './components/DashboardComponent'
import DogsComponent from './components/DogsComponent'
import LoginComponent from './components/LoginComponent'

export const router = new VueRouter({ 
    mode: 'history', 
    
    routes: [ 
        {
            path: '/', 
            component: mainApp,
            props: {component: LoginComponent},
    
            children: [
                {
                    path: 'home',
                    component: HomeComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: 'login'
                            });
                            return;
                        }
                        next();
                    }
                    
                },
                {
                    path: 'dashboard',
                    component: DashboardComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: 'login'
                            });
                            return;
                        }
                        next();
                    }
                },
                {
                    path: 'dogs',
                    component: DogsComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: 'login'
                            });
                            return;
                        }
                        next();
                    }
                }
            ]
        },
    ]
})



router.beforeEach((to, from, next) => {
        // Start the route progress bar.
    NProgress.start()
    
    next()

    
})





router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})