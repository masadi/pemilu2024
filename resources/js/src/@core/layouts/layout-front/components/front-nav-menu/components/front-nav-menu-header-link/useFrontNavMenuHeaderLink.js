import { ref } from '@vue/composition-api'
import { isNavLinkActive } from '@core/layouts/utils'

export default function useFrontNavMenuHeaderGroup(item) {
  // ------------------------------------------------
  // isActive
  // ------------------------------------------------
  const isActive = ref(false)

  const updateIsActive = () => {
    isActive.value = isNavLinkActive(item)
  }

  return {
    isActive,
    updateIsActive,
  }
}
