/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('v-paginator',require('laravel-vue-pagination'));
Vue.component('form-component',require('./components/FormComponent.vue').default);
Vue.component('work-order-component',require('./components/WorkOrderComponent.vue').default);
Vue.component('converter-component',require('./components/ConverterComponent.vue').default);
Vue.component('bom-component',require('./components/BomComponent.vue').default);
Vue.component('lead-time-component',require('./components/LeadTimeComponent.vue').default);
Vue.component('routing-component',require('./components/RoutingComponent.vue').default);
Vue.component('line-component',require('./components/LineComponent.vue').default);
Vue.component('op-component',require('./components/OpComponent.vue').default);
Vue.component('part-component',require('./components/PartComponent.vue').default);
Vue.component('model-component',require('./components/ModelComponent.vue').default);
Vue.component('size-component',require('./components/SizeComponent.vue').default);
Vue.component('transaction-component',require('./components/TransactionComponent.vue').default);
Vue.component('defect-component',require('./components/DefectComponent.vue').default);
Vue.component('dashboard-management-component',require('./components/DashboardManagementComponent.vue').default);
Vue.component('transaction-info-component',require('./components/TransactionInfo.vue').default);
Vue.component('transaction-defect-info-component',require('./components/TransactionDefectInfo.vue').default);
Vue.component('wip-info-component',require('./components/WipInfo.vue').default);
Vue.component('production-info-component',require('./components/ProductionInfo.vue').default);
Vue.component('defect-master-component',require('./components/DefectMaster.vue').default);
Vue.component('toggler-item-component',require('./components/item/TogglerItemComponent.vue').default);

Vue.component('dashboard-admin-component',require('./components/admin/DashboardAdminComponent.vue').default);
Vue.component('data-user-component',require('./components/admin/UserComponent.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
const aside = new Vue({
    el: '#aside',
});
