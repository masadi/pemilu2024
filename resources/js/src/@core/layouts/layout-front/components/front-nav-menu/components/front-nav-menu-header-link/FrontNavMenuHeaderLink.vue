<template>
  <li
    v-if="canViewFrontNavMenuHeaderLink(item)"
    class="nav-item"
    :class="{'sidebar-group-active active': isActive}"
  >
    <b-link
      class="nav-link"
      :to="{ name: item.route }"
    >
      <!--feather-icon size="14" :icon="item.icon" /-->
      <!--font-awesome-icon :icon="item.icon || 'fa-solid fa-house'" /-->
      <span>{{ t(item.title) }}</span>
    </b-link>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { useUtils as useAclUtils } from '@core/libs/acl'
import useFrontNavMenuHeaderLink from './useFrontNavMenuHeaderLink'
import mixinFrontNavMenuHeaderLink from './mixinFrontNavMenuHeaderLink'

export default {
  components: {
    BLink,
  },
  mixins: [mixinFrontNavMenuHeaderLink],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const { isActive, updateIsActive } = useFrontNavMenuHeaderLink(props.item)

    const { t } = useI18nUtils()
    const { canViewFrontNavMenuHeaderLink } = useAclUtils()

    return {
      isActive,
      updateIsActive,

      // ACL
      canViewFrontNavMenuHeaderLink,

      // i18n
      t,
    }
  },
}
</script>
