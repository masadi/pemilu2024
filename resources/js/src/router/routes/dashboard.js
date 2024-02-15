export default [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      layout: 'vertical',
      resource: 'Web',
      action: 'read',
      title: 'Dashboard',
    },
  },
]
