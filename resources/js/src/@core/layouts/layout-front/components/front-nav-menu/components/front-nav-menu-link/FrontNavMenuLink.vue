<template>
  <li
    v-if="canViewFrontNavMenuLink(item)"
    :class="{
      'active': isActive,
      'disabled': item.disabled
    }"
  >
    <b-link
      v-bind="linkProps"
      class="dropdown-item"
    >
      <!--feather-icon :icon="item.icon || 'CircleIcon'" size="24" /-->
      <!--font-awesome-icon :icon="item.icon || 'fa-solid fa-house'" /-->
      <span class="menu-title">{{ t(item.title) }}</span>
    </b-link>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { useUtils as useAclUtils } from '@core/libs/acl'
import useFrontNavMenuLink from './useFrontNavMenuLink'
import mixinFrontNavMenuLink from './mixinFrontNavMenuLink'

export default {
  components: {
    BLink,
  },
  mixins: [mixinFrontNavMenuLink],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const { isActive, linkProps, updateIsActive } = useFrontNavMenuLink(props.item)

    const { t } = useI18nUtils()
    const { canViewFrontNavMenuLink } = useAclUtils()

    return {
      isActive,
      linkProps,
      updateIsActive,

      // ACL
      canViewFrontNavMenuLink,

      // i18n
      t,
    }
  },

}
</script>
