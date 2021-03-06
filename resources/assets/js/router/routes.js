const Welcome = () => import('~/pages/welcome').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
// const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const Settings = () => import('~/pages/settings/index').then(m => m.default || m)
const SettingsProfile = () => import('~/pages/settings/profile').then(m => m.default || m)
const SettingsPassword = () => import('~/pages/settings/password').then(m => m.default || m)

const Projects = () => import('~/pages/projects').then(m => m.default || m)
const Tasks = () => import('~/pages/tasks').then(m => m.default || m)
const Issues = () => import('~/pages/issues').then(m => m.default || m)
const Logs = () => import('~/pages/activities').then(m => m.default || m)
const Users = () => import('~/pages/users').then(m => m.default || m)

export default [
  { path: '/', name: 'welcome', component: Welcome },

  { path: '/login', name: 'login', component: Login },
  // { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  { path: '/home', name: 'home', component: Home },

  { path: '/projects', name: 'projects', component: Projects },
  { path: '/tasks', name: 'tasks', component: Tasks },
  { path: '/issues', name: 'issues', component: Issues },
  { path: '/logs', name: 'logs', component: Logs },
  { path: '/users', name: 'users', component: Users },
  
  { path: '/settings',
    component: Settings,
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: SettingsProfile },
      { path: 'password', name: 'settings.password', component: SettingsPassword }
    ] },

  // { path: '*', component: NotFound }
]
