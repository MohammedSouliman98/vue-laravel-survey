import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import store from '../store'
import SurveyPublicViewer from '../views/SurveyPublicViewer.vue'


const routes = [
   {
      path : '/view/survey/:slug',
      name : SurveyPublicViewer ,
      component: SurveyPublicViewer
   },
   {
      path: '/',
      redirect: '/dashboard',
      meta: {requersAuth: true},
      component: ()=> import('../components/defaultLayout.vue'),
      children: [
         {path: '/dashboard', name: 'Dashboard', component: ()=> import('../views/Dashboard.vue')},
         {path: '/surveys', name: 'Surveys', component: ()=> import('../views/Survey.vue')},
         {path: '/create/survey', name: 'createsurvey', component:  ()=> import('../views/surveyview.vue')},
         {path: '/update/survey/:id', name: 'viewsurvey', component:  ()=> import('../views/surveyview.vue')},
      ]
      
   },
   {
      path: '/auth',
      redirect: '/login',
      name: 'Auth',
      meta : {isauth : true},
      component: ()=> import('../components/authLayout.vue'), 
      children : [
         {
            path: '/login',
            name: 'Login',
            component: Login
         },
         {
            path: '/register',
            name: 'Register',
            component: Register
         }
      ]
   }
]
const router = createRouter({
   history : createWebHistory(),
   routes
})

router.beforeEach((to , form, next )=>{
   if(to.meta.requersAuth && !store.state.user.token){
      next('/login')
   }
   else if(to.meta.isauth && store.state.user.token){
      next('/dashboard')
   }else{
      next()
   }
})

export default router