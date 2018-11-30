import Vue from 'vue' 
import Vuex from 'vuex' 

Vue.use(Vuex)

export default new Vuex.Store({ 
    state: { 
        x: "5", 
        y: "5", 
        z: "5" 
    },
    getters: { 

    },
    mutations: { 
        makeXDouble(state) {
            state.x *= 2;
        },
        makeYDouble(state) {
            state.y *= 2;
        },
        makeZDouble(state) {
            state.z *= 2;
        }
    },
    actions: { 
        doubleX(context) {
            context.commit('makeXDouble');
        },
        doubleY(context) {
            context.commit('makeYDouble');
        },
        doubleZ(context) {
            context.commit('makeZDouble');
        }

    }

})