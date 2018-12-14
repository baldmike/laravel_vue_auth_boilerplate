import VueRouter from 'vue-router' 
import store from './store'
import mainApp from './mainApp'
import CreateAnimalComponent from './components/CreateAnimalComponent'
import DashboardComponent from './components/DashboardComponent'
import AnimalsComponent from './components/AnimalsComponent'
import LoginComponent from './components/LoginComponent'
import NotFound from './components/NotFound'

export const router = new VueRouter({ 
    mode: 'history', 
    
    routes: [ 
        {
            path: '/', 
            component: mainApp,
            props: {loginComponent: LoginComponent},
    
            children: [
                {
                    path: 'dashboard',
                    component: DashboardComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: '/'
                            });
                            return;
                        }
                        next();
                    }
                },
                {
                    path: 'animals',
                    component: AnimalsComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: '/'
                            });
                            return;
                        }
                        next();
                    }
                },
                {
                    path: 'createAnimal',
                    component: CreateAnimalComponent,
                    beforeEnter: (to, from, next) => {
                        if (!window.auth.check()) {
                            next({
                                path: '/'
                            });
                            return;
                        }
                        next();
                    }
                },
                {path: '*', component: NotFound}
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