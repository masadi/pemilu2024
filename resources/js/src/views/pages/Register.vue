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
          <b-img fluid :src="imgUrl" alt="Register V2" />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Register-->
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <b-card-title class="mb-1">
            Adventure starts here 🚀
          </b-card-title>
          <b-card-text class="mb-2">
            Make your app management easy and fun!
          </b-card-text>
          <b-alert variant="success" show v-if="message">
            <div class="alert-body">
              {{ message }}
            </div>
          </b-alert>
          <!-- form -->
          <validation-observer ref="registerForm" #default="{invalid}">
            <b-form class="auth-register-form mt-2" @submit.prevent="register">
              
              <!-- email -->
              <b-form-group label="Email" label-for="email">
                <validation-provider name="Email" vid="email" rules="required|email">
                  <b-form-input id="email" v-model="form.email" name="email" :state="state.email" placeholder="email@example.com" />
                  <small class="text-danger" v-if="feedback.email">{{ feedback.email }}</small>
                </validation-provider>
              </b-form-group>

              <!-- password -->
              <b-form-group label-for="password" label="Password">
                <validation-provider  name="Password" vid="password" rules="required">
                  <b-input-group class="input-group-merge" :class="feedback.password ? 'is-invalid':null">
                    <b-form-input id="password" v-model="form.password" class="form-control-merge" :type="passwordFieldType" :state="state.password" name="password" placeholder="············" />
                    <b-input-group-append is-text>
                      <feather-icon :icon="passwordToggleIcon" class="cursor-pointer" @click="togglePasswordVisibility" />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger" v-if="feedback.password">{{ feedback.password }}</small>
                </validation-provider>
              </b-form-group>

              <!-- password_confirmation -->
              <b-form-group label-for="password_confirmation" label="Konfirmasi Password">
                <validation-provider  name="Password" vid="password_confirmation" rules="required">
                  <b-input-group class="input-group-merge" :class="feedback.password_confirmation ? 'is-invalid':null">
                    <b-form-input id="password_confirmation" v-model="form.password_confirmation" class="form-control-merge" :type="passwordConfirmFieldType" :state="state.password_confirmation" name="password_confirmation" placeholder="············" />
                    <b-input-group-append is-text>
                      <feather-icon :icon="passwordConfirmToggleIcon" class="cursor-pointer" @click="togglePasswordConfirmVisibility" />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger" v-if="feedback.password_confirmation">{{ feedback.password_confirmation }}</small>
                </validation-provider>
              </b-form-group>

              <b-form-group>
                <b-form-checkbox id="register-privacy-policy" v-model="form.status" name="checkbox-1">
                  I agree to
                  <b-link>privacy policy & terms</b-link>
                </b-form-checkbox>
              </b-form-group>

              <b-button variant="primary" block type="submit" :disabled="invalid">
                Sign up
              </b-button>
            </b-form>
          </validation-observer>

          <p class="text-center mt-2">
            <span>Already have an account?</span>
            <b-link :to="{name:'auth-login'}">
              <span>&nbsp;Sign in instead</span>
            </b-link>
          </p>

          <!-- divider -->
          <div class="divider my-2">
            <div class="divider-text">
              or
            </div>
          </div>

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
    <!-- /Register-->
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
  BButton,
  BForm,
  BFormCheckbox,
  BFormGroup,
  BFormInput,
  BInputGroup,
  BInputGroupAppend,
  BImg,
  BCardTitle,
  BCardText,
  BAlert,
} from 'bootstrap-vue'
import { required, email } from '@validations'
import { togglePasswordVisibility, togglePasswordConfirmVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'
import useJwt from '@/auth/jwt/useJwt'

export default {
  components: {
    VuexyLogo,
    BRow,
    BImg,
    BCol,
    BLink,
    BButton,
    BForm,
    BCardText,
    BCardTitle,
    BFormCheckbox,
    BFormGroup,
    BFormInput,
    BInputGroup,
    BInputGroupAppend,
    BAlert,
    // validations
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility, togglePasswordConfirmVisibility],
  data() {
    return {
      sideImg: '/images/pages/register-v2.svg',
      // validation
      required,
      email,
      app: store.state.appConfig.app,
      message: '',
      form: {
        email: 'masadi.com@gmail.com',
        password: '',
        password_confirmation: '',
        status: false,
      },
      state: {
        email: null,
        password: null,
        password_confirmation: null,
        status: null,
      },
      feedback: {
        email: '',
        password: '',
        password_confirmation: '',
        status: '',
      }
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    passwordConfirmToggleIcon() {
      return this.passwordConfirmFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = '/images/pages/register-v2-dark.svg'
        return this.sideImg
      }
      return this.sideImg
    },
  },
  methods: {
    register() {
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          /*useJwt
            .register({
              email: this.form.email,
              password: this.form.password,
              password_confirmation: this.form.password_confirmation,
              status: this.form.status,
            })
            .then(response => {
              useJwt.setToken(response.data.accessToken)
              useJwt.setRefreshToken(response.data.refreshToken)
              localStorage.setItem('userData', JSON.stringify(response.data.userData))
              this.$ability.update(response.data.userData.ability)
              this.$router.push('/')
            })
            .catch(error => {
              this.$refs.registerForm.setErrors(error.response.data.error)
            })*/
          this.$http.post('/auth/register', this.form).then(response => {
            const getData = response.data
            this.state.email = null
            this.feedback.email = ''
            this.state.password = null
            this.feedback.password = ''
            this.state.password_confirmation = null
            this.feedback.password_confirmation = ''
            this.message = getData.message
          }).catch(error => {
            let errors = error.response.data.errors
            this.message = ''
            if(errors){
              this.state.email = (errors.email) ? false : null
              this.feedback.email = (errors.email) ? errors.email.join(' ') : ''
              this.state.password = (errors.password) ? false : null
              this.feedback.password = (errors.password) ? errors.password.join(' ') : ''
              this.state.password_confirmation = (errors.password_confirmation) ? false : null
              this.feedback.password_confirmation = (errors.password_confirmation) ? errors.password_confirmation.join(' ') : ''
            }
          })
        }
      })
    },
  },
}
/* eslint-disable global-require */
</script>

<style lang="scss">
@import '~@resources/scss/vue/pages/page-auth.scss';
</style>
