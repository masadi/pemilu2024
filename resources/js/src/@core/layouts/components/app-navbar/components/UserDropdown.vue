<template>
  <b-nav-item-dropdown right toggle-class="d-flex align-items-center dropdown-user-link" class="dropdown-user">
    <template #button-content v-if="userData">
      <b-avatar size="40" :src="userData.avatar" variant="light-primary" badge class="badge-minimal" badge-variant="success">
        <feather-icon v-if="!userData.name" icon="UserIcon" size="22" />
      </b-avatar>
    </template>

    <b-dropdown-item :to="{ name: 'pages-profile'}" link-class="d-flex align-items-center">
      <feather-icon size="16" icon="UserIcon" class="mr-50" />
      <span>Profile</span>
    </b-dropdown-item>
    <b-dropdown-item :to="{ name: 'setting' }" link-class="d-flex align-items-center">
      <feather-icon size="16" icon="SettingsIcon" class="mr-50" />
      <span>Settings</span>
    </b-dropdown-item>
    <b-dropdown-item :to="{ name: 'faq' }" link-class="d-flex align-items-center">
      <feather-icon size="16" icon="HelpCircleIcon" class="mr-50" />
      <span>FAQ</span>
    </b-dropdown-item>
    <b-dropdown-item link-class="d-flex align-items-center" @click="logout">
      <feather-icon size="16" icon="LogOutIcon" class="mr-50" />
      <span>Logout</span>
    </b-dropdown-item></b-nav-item-dropdown>
</template>

<script>
import {
  BNavItemDropdown, BDropdownItem, BDropdownDivider, BAvatar,
} from 'bootstrap-vue'
import { initialAbility } from '@/libs/acl/config'
import useJwt from '@/auth/jwt/useJwt'
import { avatarText } from '@core/utils/filter'

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,
  },
  data() {
    return {
      userData: JSON.parse(localStorage.getItem('userData')),
      avatarText,
    }
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
      this.$router.push({ name: 'homepage' })
    },
  },
}
</script>
