  import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  

  { path: '/teams', name: 'teams', component: page('auth/get-started/userteams.vue') },
  { path: '/team/switcher/:team_id', name: 'team.switcher', component: page('team/switcher/index.vue') },


  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },


  { path: '/get-started', name: 'getStarted', component: page('auth/starter.vue') },
  { path: '/get-started/create', name: 'get-started-create', component: page('auth/get-started/create.vue') },
  { path: '/create/comfirmemail', name: 'create-confirmemail', component: page('auth/get-started/comfirmemail.vue') },
  
  { path: '/create/teamname', name: 'teamname', component: page('team/create-steps/teamname.vue') },
  { path: '/create/teamchannel', name: 'teamchannel', component: page('team/create-steps/teamchannel.vue') },
  { path: '/create/teaminvites', name: 'teaminvites', component: page('team/create-steps/teaminvites.vue') },
  { path: '/create/teamrole', name: 'teamrole', component: page('team/create-steps/teamrole.vue') },
  { path: '/create/tada', name: 'teamtada', component: page('team/create-steps/teamtada.vue') },


  { path: '/invite/accept/:token', name: 'accept.invite', component: page('auth/invites/accept.vue') },


  { path: '/client/home', 
    component: page('home.vue'),
    children: [
      { path: '', redirect: { name: 'welcome-home' } },
      { path: ':team_id', name: 'welcome-home', component: page('team/welcome/index.vue') },
      { path: ':team_id/threads', 
        name: 'threads',
        component: page('team/channels/threads/index.vue'),
        children:[
            { path: 'thread/:thread_id', name: 't-threads', 
            component: page('team/channels/_thread/index.vue') },
        ]
      },
      { path: ':team_id/:channel_id', 
        name: 'channel',
        component: page('team/channels/index.vue'),
        children:[
            { path: 'thread/:thread_id', name: 'single-thread', component: page('team/channels/_thread/index.vue') },
            { path: 'activities', name: 'activities', component: page('team/channels/activities/index.vue') },
            { path: 'share/:thread_id', name: 'share', component: page('team/channels/share_to/index.vue') },
            { path: 'file/:file_id', name: 'file', component: page('team/channels/_file/index.vue') },
            { path: 'files', name: 'files', component: page('team/channels/files/index.vue') },
        ]
      },
      { path: ':team_id/:channel_id/post', 
        name: 'post',
        component: page('team/channels/post/post.vue'),
        children:[
            { path: 'thread/:thread_id', name: 'p-thread', component: page('team/channels/_thread/index.vue') },
        ]
      },
    ] 
  },


  
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ] }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
