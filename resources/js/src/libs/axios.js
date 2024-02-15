import Vue from 'vue'

// axios
import axios from 'axios'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  // baseURL: 'https://some-domain.com/api/',
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
  baseURL: app_url+'/api/',
})
axiosIns.interceptors.request.use(function (config) {
  return config;
}, function (error) {
  return Promise.reject(error);
});

axiosIns.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 401) {
      localStorage.removeItem('userData')
      localStorage.removeItem('accessToken')
      localStorage.removeItem('userAbilities')
      this.$router.push('/login')
    }
    else {
      //return error.response
      return Promise.reject(error)
    }
  }
);
Vue.prototype.$http = axiosIns

export default axiosIns
