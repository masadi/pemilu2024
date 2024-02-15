export default [
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/pages/Error404.vue'),
    meta: {
      layout: 'full',
      resource: 'Web',
      action: 'read',
    },
  },
  {
    path: '/login',
    name: 'auth-login',
    component: () => import('@/views/pages/Login.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/register',
    name: 'auth-register',
    component: () => import('@/views/pages/Register.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/forgot-password',
    name: 'auth-forgot-password',
    component: () => import('@/views/pages/ForgotPassword.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
    },
  },
  {
    path: '/reset-password',
    name: 'auth-reset-password',
    component: () => import('@/views/pages/ResetPassword.vue'),
    meta: {
      layout: 'full',
    },
  },
  /*{
    path: '/pages/authentication/login-v1',
    name: 'auth-login-v1',
    component: () => import('@/views/pages/authentication/Login-v1.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/login-v2',
    name: 'auth-login-v2',
    component: () => import('@/views/pages/authentication/Login-v2.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/register-v1',
    name: 'auth-register-v1',
    component: () => import('@/views/pages/authentication/Register-v1.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/register-v2',
    name: 'auth-register-v2',
    component: () => import('@/views/pages/authentication/Register-v2.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/forgot-password-v1',
    name: 'auth-forgot-password-v1',
    component: () => import('@/views/pages/authentication/ForgotPassword-v1.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/forgot-password-v2',
    name: 'auth-forgot-password-v2',
    component: () => import('@/views/pages/authentication/ForgotPassword-v2.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
    },
  },
  {
    path: '/pages/authentication/reset-password-v1',
    name: 'auth-reset-password-v1',
    component: () => import('@/views/pages/authentication/ResetPassword-v1.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/authentication/reset-password-v2',
    name: 'auth-reset-password-v2',
    component: () => import('@/views/pages/authentication/ResetPassword-v2.vue'),
    meta: {
      layout: 'full',
    },
  },
  */
  {
    path: '/pages/miscellaneous/coming-soon',
    name: 'misc-coming-soon',
    component: () => import('@/views/pages/miscellaneous/ComingSoon.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/miscellaneous/not-authorized',
    name: 'misc-not-authorized',
    component: () => import('@/views/pages/miscellaneous/NotAuthorized.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
    },
  },
  {
    path: '/pages/miscellaneous/under-maintenance',
    name: 'misc-under-maintenance',
    component: () => import('@/views/pages/miscellaneous/UnderMaintenance.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/pages/miscellaneous/error',
    name: 'misc-error',
    component: () => import('@/views/pages/miscellaneous/Error.vue'),
    meta: {
      layout: 'full',
    },
  },
  {
    path: '/setting',
    name: 'setting',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Setting',
      breadcrumb: [
        {
          text: 'Setting',
          active: true,
        },
      ],
    },
  },
  {
    path: '/faq',
    name: 'faq',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'FAQ',
      breadcrumb: [
        {
          text: 'FAQ',
          active: true,
        },
      ],
    },
  },
  {
    path: '/profile',
    name: 'pages-profile',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Profile',
      breadcrumb: [
        {
          text: 'Pages',
        },
        {
          text: 'Profile',
          active: true,
        },
      ],
    },
  },
  {
    path: '/pages/blog/:id',
    name: 'pages-blog-detail',
    component: () => import('@/views/pages/blog/BlogDetail.vue'),
    meta: {
      layout: 'front',
      resource: 'Front',
      action: 'read',
      title: 'Blog Detail',
      breadcrumb: [
        {
          text: 'Pages',
        },
        {
          text: 'Blog',
        },
        {
          text: 'Detail',
          active: true,
        },
      ],
      navActiveLink: 'blog',
    },
  },
  {
    path: '/pages/blog/edit/:id',
    name: 'pages-blog-edit',
    component: () => import('@/views/pages/blog/BlogEdit.vue'),
    meta: {
      pageTitle: 'Blog Edit',
      breadcrumb: [
        {
          text: 'Pages',
        },
        {
          text: 'Blog',
        },
        {
          text: 'Edit',
          active: true,
        },
      ],
    },
  },
  {
    path: '/qr',
    name: 'qrcode',
    component: () => import('@/views/pages/QrCode.vue'),
    meta: {
      pageTitle: 'Scan QR Code',
      layout: 'full',
      resource: 'Front',
      action: 'read',
      pageTitle: 'QrCode',
    },
  },
]
