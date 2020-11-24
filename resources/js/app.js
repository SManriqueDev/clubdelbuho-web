import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress/src'

// Vuei18n
import i18n from '../js/plugins/i18n'


// Globally Registered Components
import './globalComponents.js';

// Feather font icon
require('../css/iconfont.css');


Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(InertiaApp)
Vue.use(PortalVue)
Vue.use(VueMeta)

InertiaProgress.init()

let app = document.getElementById('app')

new Vue({
    i18n,
    metaInfo: {
        titleTemplate: (title) => title ? `${title} - Mundolector` : 'Mundolector'
    },
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`@/pages/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
