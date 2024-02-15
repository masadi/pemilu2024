<template>
  <div class="navbar-container main-menu-content">
    <front-nav-menu-items :items="navMenuItems" />
  </div>
</template>

<script>
import navMenuItems from '@/navigation/front'
import FrontNavMenuItems from './components/front-nav-menu-items/FrontNavMenuItems.vue'

export default {
  components: {
    FrontNavMenuItems,
  },
  setup() {
    return {
      navMenuItems,
    }
  },
}
</script>

<style lang="scss">
@import "~@resources/scss/base/core/menu/menu-types/front-menu.scss";
</style>
