export default [
  {
    title: 'Dashboard',
    route: 'dashboard',
    resource: 'Web',
    action: 'read',
  },
  {
    title: 'Dashboards',
    icon: 'HomeIcon',
    tag: '2',
    tagVariant: 'light-warning',
    children: [
      {
        title: 'eCommerce',
        route: 'dashboard-ecommerce',
      },
      {
        title: 'Analytics',
        route: 'dashboard-analytics',
      },
    ],
  },
]
