// We haven't added icon's computed property because it makes this mixin coupled with UI
export const togglePasswordVisibility = {
  data() {
    return {
      passwordFieldType: 'password',
      passwordConfirmFieldType: 'password',
    }
  },
  methods: {
    togglePasswordVisibility() {
      this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
    },
    togglePasswordConfirmVisibility() {
      this.passwordConfirmFieldType = this.passwordConfirmFieldType === 'password' ? 'text' : 'password'
    },
  },
}
export const togglePasswordConfirmVisibility = {
  data() {
    return {
      passwordConfirmFieldType: 'password',
    }
  },
  methods: {
    togglePasswordConfirmVisibility() {
      this.passwordConfirmFieldType = this.passwordConfirmFieldType === 'password' ? 'text' : 'password'
    },
  },
}
export const _ = null
