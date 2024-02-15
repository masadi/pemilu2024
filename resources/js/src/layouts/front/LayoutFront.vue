<template>
  <layout-front>
    <router-view />
  </layout-front>

</template>

<script>
import LayoutFront from '@core/layouts/layout-front/LayoutFront.vue'

export default {
  components: {
    LayoutFront,
  },
}
</script>
