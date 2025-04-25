import { createRouter, createWebHistory } from "vue-router"
import { getUser } from "./auth";


const routes = [
  {
    path: '/',
    component: () => import('./views/Login.vue'),
    name: 'login'
  },
  {
    path: '/dashboard',
    meta: {
      requiresAuth: true
    },
    children: [
      {
        path: '',
        component: () => import('./views/Dashboard.vue'),
      },
      {
        path: 'consultation',
        component: () => import('./views/Consultation.vue'),

      },
      {
        path: 'vaccination',
        component: () => import('./views/Vaccination.vue'),

      },
      {
        path: 'vaccination/:id',
        component: () => import('./views/VaccinationDetail.vue'),

      }
    ]
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: { name: 'login' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  const user = getUser();
  if (to.meta.requiresAuth && !user) {
    next('/login')
  } else if (to.name == 'login' && user) {
    next('/dashboard')
  } else {
    next()
  }
})

export default router