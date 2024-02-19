<template>
  <div>
    <b-row>
      <b-col md="4" class="mb-2">
        <b-form-select v-model="meta.per_page" :options="[10, 25, 50, 100]" @change="loadPerPage"></b-form-select>
      </b-col>
      <template v-if="meta.luar">
        <b-col md="4" offset-md="4">
          <b-form-input @input="search" placeholder="Cari data..."></b-form-input>
        </b-col>
      </template>
      <template v-else>
        <b-col md="4" class="mb-2">
          <b-form-select v-model="opsi" :options="data_opsi" @change="changeOpsi"></b-form-select>
        </b-col>
        <b-col md="4" class="mb-2">
          <b-form-input @input="search" placeholder="Cari data..."></b-form-input>
        </b-col>
      </template>
    </b-row>
    <b-overlay :show="loading" rounded opacity="0.6" size="lg" spinner-variant="warning">
      <b-table responsive bordered striped :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty :busy="isBusy">
        <template #table-busy>
          <div class="text-center text-danger my-2">
            <b-spinner class="align-middle"></b-spinner>
            <strong>Loading...</strong>
          </div>
        </template>
        <template v-slot:cell(provinsi)="row">
          <template v-if="row.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive">
            {{row.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.nama}}
          </template>
          <template v-else>
            {{row.item.wilayah.parrent_recursive.parrent_recursive.nama}}
          </template>
        </template>
        <template v-slot:cell(kabupaten)="row">
          <template v-if="row.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive">
            {{row.item.wilayah.parrent_recursive.parrent_recursive.nama}}
          </template>
          <template v-else>
            {{row.item.wilayah.parrent_recursive.nama}}
          </template>
        </template>
        <template v-slot:cell(kecamatan)="row">
          {{row.item.wilayah.parrent_recursive.nama}}
        </template>
        <template v-slot:cell(desa)="row">
          {{row.item.wilayah.nama}}
        </template>
        <template v-slot:cell(opsi_sikap)="row">
          <b-badge variant="success" v-if="row.item.opsi_id">Positif</b-badge>
          <b-badge variant="danger" v-else>Negati</b-badge>
        </template>
        <template v-slot:cell(link)="row">
          <b-button variant="outline-primary" size="sm" :href="`https://pemilu2024.kpu.go.id/pilpres/hitung-suara/${row.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.kode}/${row.item.wilayah.parrent_recursive.parrent_recursive.kode}/${row.item.wilayah.parrent_recursive.kode}/${row.item.wilayah.kode}/${row.item.kode}`" target="_blank">Kunjungi</b-button>
        </template>
        <template v-slot:cell(actions)="row">
          <b-button variant="outline-warning" size="sm" @click="edit(row.item)">Update</b-button>
        </template>
      </b-table>
    </b-overlay>
    <b-row class="mt-2">
      <b-col md="6">
        <p>Menampilkan {{ (meta.from) ? numberWithCommas(meta.from) : 0 }} sampai {{ numberWithCommas(meta.to) }} dari {{ numberWithCommas(meta.total) }} entri</p>
      </b-col>
      <b-col md="6">
        <b-pagination v-model="meta.current_page" :total-rows="meta.total" :per-page="meta.per_page" align="right" @change="changePage" aria-controls="dw-datatable"></b-pagination>
      </b-col>
    </b-row>
    <b-modal id="modal-prevent-closing" v-model="modalEdit" title="Update Perolehan Suara" @hidden="resetModal" @ok="handleOk" ok-title="Submit">
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group label="Token" label-for="token" invalid-feedback="Token tidak boleh kosong" :state="state.token">
          <b-form-input id="token" v-model="form.token" :state="state.token" required></b-form-input>
        </b-form-group>
        <b-form-group label="Paslon 01" label-for="paslon_1" invalid-feedback="Suara Paslon 01 tidak boleh kosong" :state="state.paslon_1">
          <b-form-input id="paslon_1" v-model="form.paslon_1" :state="state.paslon_1" required></b-form-input>
        </b-form-group>
        <b-form-group label="Paslon 02" label-for="paslon_2" invalid-feedback="Suara Paslon 03 tidak boleh kosong" :state="state.paslon_2">
          <b-form-input id="paslon_2" v-model="form.paslon_2" :state="state.paslon_2" required></b-form-input>
        </b-form-group>
        <b-form-group label="Paslon 03" label-for="paslon_3" invalid-feedback="Suara Paslon 03 tidak boleh kosong" :state="state.paslon_3">
          <b-form-input id="paslon_3" v-model="form.paslon_3" :state="state.paslon_3" required></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </div>
</template>

<script>
import _ from 'lodash' //IMPORT LODASH, DIMANA AKAN DIGUNAKAN UNTUK MEMBUAT DELAY KETIKA KOLOM PENCARIAN DIISI
import { BRow, BCol, BFormGroup, BFormInput, BFormSelect, BFormSelectOption, BTable, BSpinner, BPagination, BButton, BOverlay, BDropdown, BDropdownItem, BBadge } from 'bootstrap-vue'
export default {
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormInput, BFormSelect, BFormSelectOption,
    BTable,
    BSpinner,
    BPagination,
    BButton,
    BOverlay,
    BDropdown, BDropdownItem, BBadge,
  },
  props: {
    items: {
      type: Array,
      required: true
    },
    fields: {
      type: Array,
      required: true
    },
    meta: {
      required: true
    },
    isBusy: {
      type: Boolean,
      default: () => true,
    },
    loading: {
      type: Boolean,
      default: () => false,
    },
    data_tingkat: {
      type: Array,
      //required: true
    },
    data_jurusan: {
      type: Array,
      //required: true
    },
    data_rombel: {
      type: Array,
      //required: true
    },
  },
  data() {
    return {
      sortBy: null,
      sortDesc: false,
      opsi: null,
      data_opsi: [
        { value: null, text: 'Semua Data' },
        { value: 1, text: 'DPT > 300' }
      ],
      form: {
        id: '',
        token: '',
        paslon_1: '',
        paslon_2: '',
        paslon_3: '',
      },
      feedback: {
        token: '',
        paslon_1: '',
        paslon_2: '',
        paslon_3: '',
      },
      state: {
        token: null,
        paslon_1: null,
        paslon_2: null,
        paslon_3: null,
      },
      modalEdit: false,
    }
  },
  watch: {
    sortBy(val) {
      this.$emit('sort', {
        sortBy: this.sortBy,
        sortDesc: this.sortDesc
      })
    },
    sortDesc(val) {
      this.$emit('sort', {
        sortBy: this.sortBy,
        sortDesc: this.sortDesc
      })
    }
  },
  methods: {
    numberWithCommas(x) {
      return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    },
    edit(item){
      this.$emit('edit', item)
    },
    hapus(nilai_budaya_kerja_id){
      this.$emit('hapus', nilai_budaya_kerja_id)
    },
    loadPerPage(val) {
      this.$emit('per_page', this.meta.per_page)
    },
    changeOpsi(val){
      this.$emit('opsi', val)
    },
    changePage(val) {
      this.$emit('pagination', val)
    },
    search: _.debounce(function (e) {
      this.$emit('search', e)
    }, 500),
    edit(item){
      this.modalEdit = true
      this.form.id = item.id
      console.log(item.id);
      console.log(item);
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity()
      this.state.token = valid
      this.state.paslon_1 = valid
      this.state.paslon_2 = valid
      this.state.paslon_3 = valid
      return valid
    },
    resetModal() {
      this.form.id = ''
      this.form.token = ''
      this.form.paslon_1 = ''
      this.form.paslon_2 = ''
      this.form.paslon_3 = ''
      this.state.token = null
      this.state.paslon_1 = null
      this.state.paslon_2 = null
      this.state.paslon_3 = null
      this.feedback.token = ''
      this.feedback.paslon_1 = ''
      this.feedback.paslon_2 = ''
      this.feedback.paslon_3 = ''
    },
    handleOk(bvModalEvent) {
      // Prevent modal from closing
      bvModalEvent.preventDefault()
      // Trigger submit handler
      this.handleSubmit()
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return
      }
      this.$http.post('/update-suara', this.form).then(response => {
        let getData = response.data
        console.log(getData);
        this.modalEdit = false
        this.loadPerPage(this.meta.per_page)
      });
      // Push the name to submitted names
      //this.submittedNames.push(this.name)
      // Hide the modal manually
      /*this.$nextTick(() => {
        //this.$bvModal.hide('modal-prevent-closing')
        this.modalEdit = false
        this.loadPerPage(this.meta.per_page)
      })*/
    },
  },
}
</script>