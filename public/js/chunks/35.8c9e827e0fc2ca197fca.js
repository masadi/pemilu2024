(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{zzNg:function(e,t,a){"use strict";a.r(t);a("rB9j"),a("hByQ");var r=a("IF94"),s=a("YZfj"),n=a("AeMN"),i=(a("UxlC"),a("07d7"),a("JfAA"),a("LvDl")),o=a.n(i),l=a("oVt+"),c=a("sove"),p=a("R5cT"),u=a("g2Gq"),d=a("6kxU"),m=a("KaE5"),h=a("JtJI"),_=a("GUe+"),b=a("mwM1"),y=a("3Zo4"),g=a("nqqA"),v=a("6Ytq"),f={components:{BRow:l.a,BCol:c.a,BFormInput:p.a,BFormSelect:u.a,BFormSelectOption:d.a,BTable:m.a,BSpinner:n.a,BPagination:h.a,BButton:_.a,BOverlay:b.a,BDropdown:y.a,BDropdownItem:g.a,BBadge:v.a},props:{items:{type:Array,required:!0},fields:{type:Array,required:!0},meta:{required:!0},isBusy:{type:Boolean,default:function(){return!0}},loading:{type:Boolean,default:function(){return!1}},data_tingkat:{type:Array},data_jurusan:{type:Array},data_rombel:{type:Array}},data:function(){return{sortBy:null,sortDesc:!1,opsi:null,data_opsi:[{value:null,text:"Semua Data"},{value:1,text:"DPT > 300"}]}},watch:{sortBy:function(e){this.$emit("sort",{sortBy:this.sortBy,sortDesc:this.sortDesc})},sortDesc:function(e){this.$emit("sort",{sortBy:this.sortBy,sortDesc:this.sortDesc})}},methods:{numberWithCommas:function(e){return e.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,".")},edit:function(e){this.$emit("edit",e)},hapus:function(e){this.$emit("hapus",e)},loadPerPage:function(e){this.$emit("per_page",this.meta.per_page)},changeOpsi:function(e){this.$emit("opsi",e)},changePage:function(e){this.$emit("pagination",e)},search:o.a.debounce((function(e){this.$emit("search",e)}),500)}},B=a("KHd+"),k=Object(B.a)(f,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("b-row",[a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-select",{attrs:{options:[10,25,50,100]},on:{change:e.loadPerPage},model:{value:e.meta.per_page,callback:function(t){e.$set(e.meta,"per_page",t)},expression:"meta.per_page"}})],1),e._v(" "),a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-select",{attrs:{options:e.data_opsi},on:{change:e.changeOpsi},model:{value:e.opsi,callback:function(t){e.opsi=t},expression:"opsi"}})],1),e._v(" "),a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-input",{attrs:{placeholder:"Cari data..."},on:{input:e.search}})],1)],1),e._v(" "),a("b-overlay",{attrs:{show:e.loading,rounded:"",opacity:"0.6",size:"lg","spinner-variant":"warning"}},[a("b-table",{attrs:{responsive:"",bordered:"",striped:"",items:e.items,fields:e.fields,"sort-by":e.sortBy,"sort-desc":e.sortDesc,"show-empty":"",busy:e.isBusy},on:{"update:sortBy":function(t){e.sortBy=t},"update:sort-by":function(t){e.sortBy=t},"update:sortDesc":function(t){e.sortDesc=t},"update:sort-desc":function(t){e.sortDesc=t}},scopedSlots:e._u([{key:"table-busy",fn:function(){return[a("div",{staticClass:"text-center text-danger my-2"},[a("b-spinner",{staticClass:"align-middle"}),e._v(" "),a("strong",[e._v("Loading...")])],1)]},proxy:!0},{key:"cell(provinsi)",fn:function(t){return[t.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive?[e._v("\n          "+e._s(t.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.nama)+"\n        ")]:[e._v("\n          "+e._s(t.item.wilayah.parrent_recursive.parrent_recursive.nama)+"\n        ")]]}},{key:"cell(kabupaten)",fn:function(t){return[t.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive?[e._v("\n          "+e._s(t.item.wilayah.parrent_recursive.parrent_recursive.nama)+"\n        ")]:[e._v("\n          "+e._s(t.item.wilayah.parrent_recursive.nama)+"\n        ")]]}},{key:"cell(kecamatan)",fn:function(t){return[e._v("\n        "+e._s(t.item.wilayah.parrent_recursive.nama)+"\n      ")]}},{key:"cell(desa)",fn:function(t){return[e._v("\n        "+e._s(t.item.wilayah.nama)+"\n      ")]}},{key:"cell(opsi_sikap)",fn:function(t){return[t.item.opsi_id?a("b-badge",{attrs:{variant:"success"}},[e._v("Positif")]):a("b-badge",{attrs:{variant:"danger"}},[e._v("Negati")])]}},{key:"cell(link)",fn:function(t){return[a("b-button",{attrs:{variant:"outline-primary",size:"sm",href:"https://pemilu2024.kpu.go.id/pilpres/hitung-suara/"+t.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.kode+"/"+t.item.wilayah.parrent_recursive.parrent_recursive.kode+"/"+t.item.wilayah.parrent_recursive.kode+"/"+t.item.wilayah.kode+"/"+t.item.kode,target:"_blank"}},[e._v("Kunjungi")])]}}])})],1),e._v(" "),a("b-row",{staticClass:"mt-2"},[a("b-col",{attrs:{md:"6"}},[a("p",[e._v("Menampilkan "+e._s(e.meta.from?e.numberWithCommas(e.meta.from):0)+" sampai "+e._s(e.numberWithCommas(e.meta.to))+" dari "+e._s(e.numberWithCommas(e.meta.total))+" entri")])]),e._v(" "),a("b-col",{attrs:{md:"6"}},[a("b-pagination",{attrs:{"total-rows":e.meta.total,"per-page":e.meta.per_page,align:"right","aria-controls":"dw-datatable"},on:{change:e.changePage},model:{value:e.meta.current_page,callback:function(t){e.$set(e.meta,"current_page",t)},expression:"meta.current_page"}})],1)],1)],1)}),[],!1,null,null,null).exports,C={components:{BCard:r.a,BCardBody:s.a,BSpinner:n.a,Datatable:k},data:function(){return{isBusy:!0,loading:!0,fields:[{key:"provinsi",label:"Provinsi",sortable:!1,thClass:"text-center"},{key:"kabupaten",label:"Kab/Kota",sortable:!1,thClass:"text-center"},{key:"kecamatan",label:"Kecamatan/Distrik",sortable:!1,thClass:"text-center"},{key:"desa",label:"Desa/Kelurahan",sortable:!1,thClass:"text-center"},{key:"nama",label:"TPS",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_1",label:"01",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_2",label:"02",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_3",label:"03",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"link",label:"Link KPU",sortable:!1,thClass:"text-center",tdClass:"text-center"}],items:[],meta:{},current_page:1,per_page:10,search:"",sortBy:"created_at",sortByDesc:!1,opsi:null}},created:function(){this.loadPostsData()},methods:{loadPostsData:function(){var e=this;this.loading=!0;var t=this.current_page;this.$http.get("/rekap",{params:{page:t,per_page:this.per_page,q:this.search,sortby:this.sortBy,sortbydesc:this.sortByDesc?"DESC":"ASC",opsi:this.opsi}}).then((function(t){var a=t.data.data;e.loading=!1,e.isBusy=!1,e.items=a.data,e.meta={total:a.total,current_page:a.current_page,per_page:a.per_page,from:a.from,to:a.to,role_id:e.role_id,roles:t.data.roles}}))},handlePerPage:function(e){this.per_page=e,this.loadPostsData()},handleRole:function(e){this.role_id=e,this.loadPostsData()},handlePagination:function(e){this.current_page=e,this.loadPostsData()},handleSearch:function(e){this.search=e,this.loadPostsData()},handleOpsi:function(e){this.opsi=e,this.loadPostsData()}}},w=Object(B.a)(C,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("b-card",{attrs:{"no-body":""}},[a("b-card-body",[e.isBusy?a("div",{staticClass:"text-center text-danger my-2"},[a("b-spinner",{staticClass:"align-middle"}),e._v(" "),a("strong",[e._v("Loading...")])],1):a("div",[a("h2",[e._v("Data diambil dari website pemilu2024.kpu.go.id dan di update secara berkala")]),e._v(" "),a("datatable",{attrs:{isBusy:e.isBusy,loading:e.loading,items:e.items,fields:e.fields,meta:e.meta},on:{per_page:e.handlePerPage,pagination:e.handlePagination,search:e.handleSearch,opsi:e.handleOpsi}})],1)])],1)}),[],!1,null,null,null);t.default=w.exports}}]);