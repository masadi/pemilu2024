<template>
  <div class="d-flex justify-content-between">
    <ul
      id="main-menu-navigation"
      class="nav navbar-nav"
    >
    <li class="nav-item">
      <span class="brand-logo">
        <b-img :src="appLogoImage" alt="logo" height="36" class="mr-1" />
      </span>
    </li>
      <component
        :is="resolveNavComponent(item)"
        v-for="item in items"
        :key="item.header"
        :item="item"
      />
    </ul>
    <ul id="main-menu-navigation" class="nav navbar-nav">
      <li class="nav-item">
        <b-link class="nav-link" :to="{ name: 'auth-login' }" v-if="!userData"><span>Login</span></b-link>
        <b-link class="nav-link" :to="{ name: 'dashboard' }" v-else><span>Dashboard</span></b-link>
      </li>
      <li class="nav-item">
        <b-link class="nav-link" :to="{ name: 'auth-register' }" v-if="!userData"><span>Register</span></b-link>
        <b-link class="nav-link" @click="logout" v-else><span>Logout</span></b-link>
      </li>
      <!--
        <li class="nav-item">
        <b-link class="nav-link" :to="{ name: 'auth-login' }">
        <span>judul</span>
      </b-link>
      </li>
      -->
    </ul>
  </div>
</template>

<script>
import { BLink, BImg } from 'bootstrap-vue'
import FrontNavMenuHeaderLink from '../front-nav-menu-header-link/FrontNavMenuHeaderLink.vue'
import FrontNavMenuHeaderGroup from '../front-nav-menu-header-group/FrontNavMenuHeaderGroup.vue'
import { $themeConfig } from '@themeConfig'
import useJwt from '@/auth/jwt/useJwt'
import { initialAbility } from '@/libs/acl/config'

export default {
  components: {
    BLink,
    BImg,
    FrontNavMenuHeaderLink,
    FrontNavMenuHeaderGroup,
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  methods: {
    logout() {
      // Remove userData from localStorage
      // ? You just removed token from localStorage. If you like, you can also make API call to backend to blacklist used token
      localStorage.removeItem(useJwt.jwtConfig.storageTokenKeyName)
      localStorage.removeItem(useJwt.jwtConfig.storageRefreshTokenKeyName)

      // Remove userData from localStorage
      localStorage.removeItem('userData')

      // Reset ability
      this.$ability.update(initialAbility)

      // Redirect to login page
      //this.$router.push({ name: 'homepage' })
      window.location.reload()
    },
  },
  setup() {
    const resolveNavComponent = item => {
      if (item.children) return 'front-nav-menu-header-group'
      return 'front-nav-menu-header-link'
    }
    const { appName, appLogoImage } = $themeConfig.app
    const userData = JSON.parse(localStorage.getItem('userData'))
    return {
      resolveNavComponent,
      appName,
      appLogoImage,
      userData
    }
  },
}
</script>
