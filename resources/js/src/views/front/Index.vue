<template>
  <b-card no-body>
    <b-card-body>
      <div v-if="isBusy" class="text-center text-danger my-2">
        <b-spinner class="align-middle"></b-spinner>
        <strong>Loading...</strong>
      </div>
      <div v-else>
        <h2>Data diambil dari website pemilu2024.kpu.go.id dan di update secara berkala</h2>
        <b-card no-body>
          <b-tabs pills card @input="changeTab">
            <b-tab title="Dalam Negeri" active>
              <b-card-text>
                <datatable :isBusy="isBusy" :loading="loading" :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @opsi="handleOpsi" />
              </b-card-text>
            </b-tab>
            <b-tab title="Luar Negeri">
              <b-card-text>
                <datatable :isBusy="isBusy" :loading="loading" :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @opsi="handleOpsi" />
              </b-card-text>
            </b-tab>
          </b-tabs>
        </b-card>
      </div>
    </b-card-body>
  </b-card>
</template>

<script>
/* eslint-disable global-require */
import { BCard, BCardBody, BCardText, BSpinner, BTabs, BTab } from 'bootstrap-vue'
import Datatable from './Datatable.vue'
export default {
  components: {
    BCard,
    BCardBody,
    BCardText,
    BSpinner,
    BTabs,
    BTab,
    Datatable
  },
  data() {
    return {
      isBusy: true,
      loading: true,
      fields: [],
      items: [],
      meta: {},
      current_page: 1, //DEFAULT PAGE YANG AKTIF ADA PAGE 1
      per_page: 10, //DEFAULT LOAD PERPAGE ADALAH 10
      search: '',
      sortBy: 'kode', //DEFAULT SORTNYA ADALAH CREATED_AT
      sortByDesc: false, //ASCEDING
      opsi: null,
      luar: 0,
    }
  },
  created() {
    this.changeTab(0)
    //this.loadPostsData()
  },
  methods: {
    loadPostsData() {
      this.loading = true
      //let current_page = this.search == '' ? this.current_page : this.current_page != 1 ? 1 : this.current_page
      let current_page = this.current_page//this.search == '' ? this.current_page : 1
      //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
      this.$http.get('/rekap', {
        params: {
          luar: this.luar,
          page: current_page,
          per_page: this.per_page,
          q: this.search,
          sortby: this.sortBy,
          sortbydesc: this.sortByDesc ? 'DESC' : 'ASC',
          opsi: this.opsi,
        }
      }).then(response => {
        //this.items = response.data.all_pd
        let getData = response.data.data
        this.loading = false
        this.isBusy = false
        this.items = getData.data//MAKA ASSIGN DATA POSTINGAN KE DALAM VARIABLE ITEMS
        //DAN ASSIGN INFORMASI LAINNYA KE DALAM VARIABLE META
        this.meta = {
          total: getData.total,
          current_page: getData.current_page,
          per_page: getData.per_page,
          from: getData.from,
          to: getData.to,
          role_id: this.role_id,
          roles: response.data.roles,
          luar: this.luar,
        }
      })
    },
    //JIKA ADA EMIT TERKAIT LOAD PERPAGE, MAKA FUNGSI INI AKAN DIJALANKAN
    handlePerPage(val) {
      this.per_page = val //SET PER_PAGE DENGAN VALUE YANG DIKIRIM DARI EMIT
      this.loadPostsData() //DAN REQUEST DATA BARU KE SERVER
    },
    handleRole(val){
      this.role_id = val
      this.loadPostsData()
    },
    //JIKA ADA EMIT PAGINATION YANG DIKIRIM, MAKA FUNGSI INI AKAN DIEKSEKUSI
    handlePagination(val) {
      this.current_page = val //SET CURRENT PAGE YANG AKTIF
      this.loadPostsData()
    },
    //JIKA ADA DATA PENCARIAN
    handleSearch(val) {
      this.search = val //SET VALUE PENCARIAN KE VARIABLE SEARCH
      this.loadPostsData() //REQUEST DATA BARU
    },
    handleOpsi(val){
      this.opsi = val
      this.loadPostsData() //REQUEST DATA BARU
    },
    changeTab(val){
      this.luar = val
      if(val){
        this.fields = [
          {
            key: 'provinsi',
            label: 'Wilayah',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'kabupaten',
            label: 'Negara',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'kecamatan',
            label: 'Negara',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'nama',
            label: 'TPS',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_1',
            label: '01',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_2',
            label: '02',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_3',
            label: '03',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'actions',
            label: 'Edit',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'link',
            label: 'Link KPU',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
        ];
      } else {
        this.fields = [
          {
            key: 'provinsi',
            label: 'Provinsi',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'kabupaten',
            label: 'Kab/Kota',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'kecamatan',
            label: 'Kecamatan/Distrik',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'desa',
            label: 'Desa/Kelurahan',
            sortable: false,
            thClass: 'text-center',
          },
          {
            key: 'nama',
            label: 'TPS',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_1',
            label: '01',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_2',
            label: '02',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'paslon_3',
            label: '03',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'actions',
            label: 'Edit',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
          {
            key: 'link',
            label: 'Link KPU',
            sortable: false,
            thClass: 'text-center',
            tdClass: 'text-center'
          },
        ];
      }
      this.loadPostsData()
      console.log(this.loading)
      console.log(val);
    },
  },
}
</script>