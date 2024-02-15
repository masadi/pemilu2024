<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">

      <!-- Brand logo-->
      <b-link class="brand-logo">
        <vuexy-logo />
        <h2 class="brand-text text-primary ml-1">
          {{app.name}}
        </h2>
      </b-link>
      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col lg="8" class="d-none d-lg-flex align-items-center p-5">
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
          <b-img fluid :src="imgUrl" alt="Login V2" />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <b-card-title class="mb-1 font-weight-bold" title-tag="h2">
            Welcome to {{app.name}}! 👋
          </b-card-title>
          <b-card-text class="mb-2">
            Please sign-in to your account and start the adventure
          </b-card-text>
          <!-- form -->
          <validation-observer ref="loginForm" #default="{invalid}">
            <b-form class="auth-login-form mt-2" @submit.prevent="login">
              <!-- email -->
              <b-form-group label="Email" label-for="email">
                <validation-provider name="Email" vid="email" rules="required|email">
                  <b-form-input id="email" v-model="userEmail" :state="state.email" name="email" placeholder="email@example.com"/>
                  <small class="text-danger" v-if="feedback.email">{{ feedback.email }}</small>
                </validation-provider>
              </b-form-group>

              <!-- forgot password -->
              <b-form-group>
                <div class="d-flex justify-content-between">
                  <label for="password">Password</label>
                  <b-link :to="{name:'auth-forgot-password'}">
                    <small>Forgot Password?</small>
                  </b-link>
                </div>
                <validation-provider name="Password" vid="password" rules="required">
                  <b-input-group class="input-group-merge" :class="feedback.password ? 'is-invalid':null">
                    <b-form-input id="password" v-model="password" :state="state.password" class="form-control-merge" :type="passwordFieldType" name="password" placeholder="Password" />
                    <b-input-group-append is-text>
                      <feather-icon class="cursor-pointer" :icon="passwordToggleIcon" @click="togglePasswordVisibility" />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger" v-if="feedback.password">{{ feedback.password }}</small>
                </validation-provider>
              </b-form-group>

              <!-- checkbox -->
              <b-form-group>
                <b-form-checkbox id="remember-me" v-model="status" name="checkbox-1">
                  Remember Me
                </b-form-checkbox>
              </b-form-group>

              <!-- submit buttons -->
              <b-button type="submit" variant="primary" block :disabled="invalid">
                Sign in
              </b-button>
            </b-form>
          </validation-observer>

          <b-card-text class="text-center mt-2">
            <span>New on our platform? </span>
            <b-link :to="{name:'auth-register'}">
              <span>&nbsp;Create an account</span>
            </b-link>
          </b-card-text>

          <!-- divider -->
          <div class="divider my-2">
            <div class="divider-text">
              or
            </div>
          </div>

          <!-- social buttons -->
          <div class="auth-footer-btn d-flex justify-content-center">
            <b-button variant="facebook" href="javascript:void(0)">
              <feather-icon icon="FacebookIcon" />
            </b-button>
            <b-button variant="twitter" href="javascript:void(0)">
              <feather-icon icon="TwitterIcon" />
            </b-button>
            <b-button variant="google" href="javascript:void(0)">
              <feather-icon icon="MailIcon" />
            </b-button>
            <b-button variant="github" href="javascript:void(0)">
              <feather-icon icon="GithubIcon" />
            </b-button>
          </div>
        </b-col>
      </b-col>
    <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import VuexyLogo from '@core/layouts/components/Logo.vue'
import {
  BRow,
  BCol,
  BLink,
  BFormGroup,
  BFormInput,
  BInputGroupAppend,
  BInputGroup,
  BFormCheckbox,
  BCardText,
  BCardTitle,
  BImg,
  BForm,
  BButton,
  BAlert,
  VBTooltip,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'
import { getHomeRouteForLoggedInUser } from '@/auth/utils'

import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  directives: {
    'b-tooltip': VBTooltip,
  },
  components: {
    BRow,
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
    BFormCheckbox,
    BCardText,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    BAlert,
    VuexyLogo,
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      status: false,
      password: '5C4F:>BjCM:kGg%',
      userEmail: 'masadi.com@gmail.com',
      sideImg: '/images/pages/login-v2.svg',

      // validation rules
      required,
      email,
      app: store.state.appConfig.app,
      state: {
        email: null,
        password: null,
      },
      feedback: {
        email: '',
        password: '',
      }
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = '/images/pages/login-v2-dark.svg'
        return this.sideImg
      }
      return this.sideImg
    },
  },
  created() {
    console.log(this.app)
  },
  methods: {
    login() {
      this.$refs.loginForm.validate().then(success => {
        if (success) {
          /*useJwt
            .login({
              email: this.userEmail,
              password: this.password,
            })
            .then(response => {
              const { userData } = response.data
              useJwt.setToken(response.data.accessToken)
              useJwt.setRefreshToken(response.data.refreshToken)
              localStorage.setItem('userData', JSON.stringify(userData))
              this.$ability.update(userData.ability)

              // ? This is just for demo purpose as well.
              // ? Because we are showing eCommerce app's cart items count in navbar
              this.$store.commit('app-ecommerce/UPDATE_CART_ITEMS_COUNT', userData.extras.eCommerceCartItemsCount)

              // ? This is just for demo purpose. Don't think CASL is role based in this case, we used role in if condition just for ease
              this.$router.replace(getHomeRouteForLoggedInUser(userData.role)).then(() => {
                this.$toast({
                  component: ToastificationContent,
                  position: 'top-right',
                  props: {
                    title: `Welcome ${userData.fullName || userData.username}`,
                    icon: 'CoffeeIcon',
                    variant: 'success',
                    text: `You have successfully logged in as ${userData.role}. Now you can start to explore!`,
                  },
                })
              })
            })
            .catch(error => {
              this.$refs.loginForm.setErrors(error.response.data.error)
            })*/
          this.$http.post('/auth/login', {
            email: this.userEmail,
            password: this.password,
            remember_me: this.status,
            //c_password: this.password
          }).then(response => {
            const userData = response.data
            if(userData.user){
              localStorage.setItem('accessToken', userData.accessToken)
              localStorage.setItem('refreshToken', userData.accessToken)
              localStorage.setItem('userData', JSON.stringify(userData.user))
              this.$ability.update(userData.user.ability)
              /*var replace = '/';
              this.$router.replace(replace).then(() => {
                this.$toast({
                  component: ToastificationContent,
                  position: 'bottom-center',
                  props: {
                    title: `Selamat Datang ${userData.user.name}`,
                    icon: 'CoffeeIcon',
                    variant: 'success',
                    text: `Anda telah berhasil masuk sebagai ${userData.user.role}. Sekarang Anda dapat mulai berselancar di Aplikasi e-Presensi!`,
                  },
                })
              })*/
              this.$router.replace(getHomeRouteForLoggedInUser(userData.user.role)).then(() => {
                this.$toast({
                  component: ToastificationContent,
                  position: 'top-right',
                  props: {
                    title: `Welcome ${userData.fullName || userData.username}`,
                    icon: 'CoffeeIcon',
                    variant: 'success',
                    text: `You have successfully logged in as ${userData.user.role.join(' ')}. Now you can start to explore!`,
                  },
                })
              })
            } else {
              console.log('atas');
              if(userData.errors){
                if((userData.errors.username)){
                  this.$refs.loginForm.setErrors({email: userData.errors.username[0]})
                }
                if((userData.errors.email)){
                  this.$refs.loginForm.setErrors({email: userData.errors.email[0]})
                }
              }
              this.$refs.loginForm.setErrors(userData.message)
            }
          }).catch(error => {
            console.log('bawah');
            console.log(error.response.data);
            let errors = error.response.data.errors
            console.log(errors);
            if(errors){
              this.state.email = (errors.email) ? false : null
              this.feedback.email = (errors.email) ? errors.email.join(', ') : ''
            }
          })
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import '~@resources/scss/vue/pages/page-auth.scss';
</style>
