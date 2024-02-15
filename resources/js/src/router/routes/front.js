export default [
  {
    path: '/fitur',
    name: 'fitur',
    component: () => import('@/views/front/Fitur.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Fitur',
    },
  },
  {
    path: '/harga',
    name: 'harga',
    component: () => import('@/views/front/Harga.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Harga',
    },
  },
  {
    path: '/blog',
    name: 'blog',
    component: () => import('@/views/front/Blog.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Blog',
    },
  },
  {
    path: '/kontak',
    name: 'kontak',
    component: () => import('@/views/front/Kontak.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Kontak',
    },
  },
  {
    path: '/kebijakan-privasi',
    name: 'kebijakan-privasi',
    component: () => import('@/views/front/Kebijakan.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Kebijakan & Privasi',
    },
  },
]
