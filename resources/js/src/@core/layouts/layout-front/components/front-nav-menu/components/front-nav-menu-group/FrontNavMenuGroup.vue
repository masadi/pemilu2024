<template>
  <li
    v-if="canViewVerticalNavMenuGroup(item)"
    class="dropdown dropdown-submenu"
    :class="{
      'show': isOpen,
      'disabled': item.disabled,
      'sidebar-group-active active open': isActive,
      'openLeft': openChildDropdownOnLeft
    }"
    @mouseenter="() => updateGroupOpen(true)"
    @mouseleave="() => updateGroupOpen(false)"
  >
    <b-link
      class="dropdown-item"
      href="#"
      :class="{'dropdown-toggle': item.children}"
      @click="() => updateGroupOpen(!isOpen)"
    >
      <feather-icon :icon="item.icon || 'CircleIcon'" />
      <span class="menu-title">{{ t(item.title) }}</span>
    </b-link>
    <ul
      ref="refChildDropdown"
      class="dropdown-menu"
    >
      <component
        :is="resolveNavItemComponent(child)"
        v-for="child in item.children"
        :key="child.header || child.title"
        ref="groupChild"
        :item="child"
      />
    </ul>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { resolveFrontNavMenuItemComponent as resolveNavItemComponent } from '@core/layouts/utils'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { useUtils as useAclUtils } from '@core/libs/acl'
import FrontNavMenuLink from '../front-nav-menu-link/FrontNavMenuLink.vue'

// Composition Function
import useFrontNavMenuGroup from './useFrontNavMenuGroup'
import mixinFrontNavMenuGroup from './mixinFrontNavMenuGroup'

export default {
  name: 'FrontNavMenuGroup',
  components: {
    FrontNavMenuLink,
    BLink,
  },
  mixins: [mixinFrontNavMenuGroup],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const {
      refChildDropdown,
      isActive,
      isOpen,
      updateGroupOpen,
      updateIsActive,
      openChildDropdownOnLeft,
    } = useFrontNavMenuGroup(props.item)

    const { t } = useI18nUtils()
    const { canViewVerticalNavMenuGroup } = useAclUtils()

    return {
      refChildDropdown,
      openChildDropdownOnLeft,
      resolveNavItemComponent,
      isOpen,
      isActive,
      updateGroupOpen,
      updateIsActive,

      // ACL
      canViewVerticalNavMenuGroup,

      // i18n
      t,
    }
  },
}
</script>

<style>

</style>
