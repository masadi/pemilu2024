<template>
  <li
    v-if="canViewFrontNavMenuHeaderGroup(item)"
    class="dropdown nav-item"
    :class="{
      'sidebar-group-active active open': isActive,
      'show': isOpen,
    }"
    @mouseenter="() => updateGroupOpen(true)"
    @mouseleave="() => updateGroupOpen(false)"
  >
    <b-link class="nav-link dropdown-toggle d-flex align-items-center">
      <feather-icon
        size="14"
        :icon="item.icon"
      />
      <span>{{ t(item.header) }}</span>
    </b-link>
    <ul class="dropdown-menu">
      <component
        :is="resolveFrontNavMenuItemComponent(child)"
        v-for="child in item.children"
        :key="child.title"
        :item="child"
      />
    </ul>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { resolveFrontNavMenuItemComponent } from '@core/layouts/utils'
import { useUtils as useAclUtils } from '@core/libs/acl'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import useFrontNavMenuHeaderGroup from './useFrontNavMenuHeaderGroup'
import mixinFrontNavMenuHeaderGroup from './mixinFrontNavMenuHeaderGroup'

import FrontNavMenuGroup from '../front-nav-menu-group/FrontNavMenuGroup.vue'
import FrontNavMenuLink from '../front-nav-menu-link/FrontNavMenuLink.vue'

export default {
  components: {
    BLink,
    FrontNavMenuGroup,
    FrontNavMenuLink,
  },
  mixins: [mixinFrontNavMenuHeaderGroup],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const {
      isActive,
      updateIsActive,
      isOpen,
      updateGroupOpen,
    } = useFrontNavMenuHeaderGroup(props.item)

    const { t } = useI18nUtils()
    const { canViewFrontNavMenuHeaderGroup } = useAclUtils()

    return {
      isOpen,
      isActive,
      updateGroupOpen,
      updateIsActive,
      resolveFrontNavMenuItemComponent,

      // ACL
      canViewFrontNavMenuHeaderGroup,

      // i18n
      t,
    }
  },
}
</script>
