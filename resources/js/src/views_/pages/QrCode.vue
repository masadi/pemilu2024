<template>
  <b-container fluid class="h-100 d-inline-block mt-4">
    <b-card no-body>
      <b-card-body class="text-center">
        <div v-if="isBusy" class="text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
        <div v-else>
          <b-img :src="`/storage/qrcodes/${qrcode}.svg`" fluid alt="Responsive image"></b-img>
        </div>
      </b-card-body>
    </b-card>
  </b-container>
</template>

<script>
import { BCard, BCardBody, BSpinner, BContainer, BImg } from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BCardBody,
    BSpinner,
    BContainer,
    BImg,
  },
  mounted () {
    console.log('mounted')
    window.Echo.channel('presensi-channel').listen('PresensiEvent', (e) => {
      this.qrcode = e.qrcode.qrcode
      console.log(e);
    })
  },
  data() {
    return {
      qrcode: '',
      isBusy: true,
    }
  },
  created() {
    this.getQr()
  },
  methods: {
    getQr(){
      this.isBusy = true
      this.$http.get('/qr-code').then(response => {
        this.isBusy = false
        let getData = response.data
        this.qrcode = getData.nama
      })
    },
  },
}
</script>