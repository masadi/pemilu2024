(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{zzNg:function(t,e,a){"use strict";a.r(e);a("rB9j"),a("hByQ");var r=a("IF94"),s=a("YZfj"),n=a("AeMN"),i=(a("UxlC"),a("07d7"),a("JfAA"),a("LvDl")),o=a.n(i),l=a("oVt+"),c=a("sove"),p=a("R5cT"),u=a("g2Gq"),d=a("6kxU"),m=a("KaE5"),h=a("JtJI"),_=a("GUe+"),b=a("mwM1"),y=a("3Zo4"),g=a("nqqA"),f=a("6Ytq"),v={components:{BRow:l.a,BCol:c.a,BFormInput:p.a,BFormSelect:u.a,BFormSelectOption:d.a,BTable:m.a,BSpinner:n.a,BPagination:h.a,BButton:_.a,BOverlay:b.a,BDropdown:y.a,BDropdownItem:g.a,BBadge:f.a},props:{items:{type:Array,required:!0},fields:{type:Array,required:!0},meta:{required:!0},isBusy:{type:Boolean,default:function(){return!0}},loading:{type:Boolean,default:function(){return!1}},data_tingkat:{type:Array},data_jurusan:{type:Array},data_rombel:{type:Array}},data:function(){return{sortBy:null,sortDesc:!1,opsi:null,data_opsi:[{value:null,text:"Semua Data"},{value:1,text:"DPT > 300"}]}},watch:{sortBy:function(t){this.$emit("sort",{sortBy:this.sortBy,sortDesc:this.sortDesc})},sortDesc:function(t){this.$emit("sort",{sortBy:this.sortBy,sortDesc:this.sortDesc})}},methods:{numberWithCommas:function(t){return t.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,".")},edit:function(t){this.$emit("edit",t)},hapus:function(t){this.$emit("hapus",t)},loadPerPage:function(t){this.$emit("per_page",this.meta.per_page)},changeOpsi:function(t){this.$emit("opsi",t)},changePage:function(t){this.$emit("pagination",t)},search:o.a.debounce((function(t){this.$emit("search",t)}),500)}},B=a("KHd+"),k=Object(B.a)(v,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("b-row",[a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-select",{attrs:{options:[10,25,50,100]},on:{change:t.loadPerPage},model:{value:t.meta.per_page,callback:function(e){t.$set(t.meta,"per_page",e)},expression:"meta.per_page"}})],1),t._v(" "),a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-select",{attrs:{options:t.data_opsi},on:{change:t.changeOpsi},model:{value:t.opsi,callback:function(e){t.opsi=e},expression:"opsi"}})],1),t._v(" "),a("b-col",{staticClass:"mb-2",attrs:{md:"4"}},[a("b-form-input",{attrs:{placeholder:"Cari data..."},on:{input:t.search}})],1)],1),t._v(" "),a("b-overlay",{attrs:{show:t.loading,rounded:"",opacity:"0.6",size:"lg","spinner-variant":"warning"}},[a("b-table",{attrs:{responsive:"",bordered:"",striped:"",items:t.items,fields:t.fields,"sort-by":t.sortBy,"sort-desc":t.sortDesc,"show-empty":"",busy:t.isBusy},on:{"update:sortBy":function(e){t.sortBy=e},"update:sort-by":function(e){t.sortBy=e},"update:sortDesc":function(e){t.sortDesc=e},"update:sort-desc":function(e){t.sortDesc=e}},scopedSlots:t._u([{key:"table-busy",fn:function(){return[a("div",{staticClass:"text-center text-danger my-2"},[a("b-spinner",{staticClass:"align-middle"}),t._v(" "),a("strong",[t._v("Loading...")])],1)]},proxy:!0},{key:"cell(provinsi)",fn:function(e){return[e.item.wilayah.parrent_recursive.parrent_recursive?[t._v("\n          "+t._s(e.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.nama)+"\n        ")]:[t._v("\n          "+t._s(e.item.wilayah.parrent_recursive.parrent_recursive.nama)+"\n        ")]]}},{key:"cell(kabupaten)",fn:function(e){return[e.item.wilayah.parrent_recursive.parrent_recursive?[t._v("\n          "+t._s(e.item.wilayah.parrent_recursive.parrent_recursive.nama)+"\n        ")]:[t._v("\n          "+t._s(e.item.wilayah.parrent_recursive.nama)+"\n        ")]]}},{key:"cell(kecamatan)",fn:function(e){return[t._v("\n        "+t._s(e.item.wilayah.parrent_recursive.nama)+"\n      ")]}},{key:"cell(desa)",fn:function(e){return[t._v("\n        "+t._s(e.item.wilayah.nama)+"\n      ")]}},{key:"cell(opsi_sikap)",fn:function(e){return[e.item.opsi_id?a("b-badge",{attrs:{variant:"success"}},[t._v("Positif")]):a("b-badge",{attrs:{variant:"danger"}},[t._v("Negati")])]}},{key:"cell(link)",fn:function(e){return[a("b-button",{attrs:{variant:"outline-primary",size:"sm",href:"https://pemilu2024.kpu.go.id/pilpres/hitung-suara/"+e.item.wilayah.parrent_recursive.parrent_recursive.parrent_recursive.kode+"/"+e.item.wilayah.parrent_recursive.parrent_recursive.kode+"/"+e.item.wilayah.parrent_recursive.kode+"/"+e.item.wilayah.kode+"/"+e.item.kode,target:"_blank"}},[t._v("Kunjungi")])]}}])})],1),t._v(" "),a("b-row",{staticClass:"mt-2"},[a("b-col",{attrs:{md:"6"}},[a("p",[t._v("Menampilkan "+t._s(t.meta.from?t.numberWithCommas(t.meta.from):0)+" sampai "+t._s(t.numberWithCommas(t.meta.to))+" dari "+t._s(t.numberWithCommas(t.meta.total))+" entri")])]),t._v(" "),a("b-col",{attrs:{md:"6"}},[a("b-pagination",{attrs:{"total-rows":t.meta.total,"per-page":t.meta.per_page,align:"right","aria-controls":"dw-datatable"},on:{change:t.changePage},model:{value:t.meta.current_page,callback:function(e){t.$set(t.meta,"current_page",e)},expression:"meta.current_page"}})],1)],1)],1)}),[],!1,null,null,null).exports,C={components:{BCard:r.a,BCardBody:s.a,BSpinner:n.a,Datatable:k},data:function(){return{isBusy:!0,loading:!0,fields:[{key:"provinsi",label:"Provinsi",sortable:!1,thClass:"text-center"},{key:"kabupaten",label:"Kab/Kota",sortable:!1,thClass:"text-center"},{key:"kecamatan",label:"Kecamatan/Distrik",sortable:!1,thClass:"text-center"},{key:"desa",label:"Desa/Kelurahan",sortable:!1,thClass:"text-center"},{key:"nama",label:"TPS",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_1",label:"01",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_2",label:"02",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"paslon_3",label:"03",sortable:!1,thClass:"text-center",tdClass:"text-center"},{key:"link",label:"Link KPU",sortable:!1,thClass:"text-center",tdClass:"text-center"}],items:[],meta:{},current_page:1,per_page:10,search:"",sortBy:"created_at",sortByDesc:!1,opsi:null}},created:function(){this.loadPostsData()},methods:{loadPostsData:function(){var t=this;this.loading=!0;var e=this.current_page;this.$http.get("/rekap",{params:{page:e,per_page:this.per_page,q:this.search,sortby:this.sortBy,sortbydesc:this.sortByDesc?"DESC":"ASC",opsi:this.opsi}}).then((function(e){var a=e.data.data;t.loading=!1,t.isBusy=!1,t.items=a.data,t.meta={total:a.total,current_page:a.current_page,per_page:a.per_page,from:a.from,to:a.to,role_id:t.role_id,roles:e.data.roles}}))},handlePerPage:function(t){this.per_page=t,this.loadPostsData()},handleRole:function(t){this.role_id=t,this.loadPostsData()},handlePagination:function(t){this.current_page=t,this.loadPostsData()},handleSearch:function(t){this.search=t,this.loadPostsData()},handleOpsi:function(t){this.opsi=t,this.loadPostsData()}}},w=Object(B.a)(C,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("b-card",{attrs:{"no-body":""}},[a("b-card-body",[t.isBusy?a("div",{staticClass:"text-center text-danger my-2"},[a("b-spinner",{staticClass:"align-middle"}),t._v(" "),a("strong",[t._v("Loading...")])],1):a("div",[a("h2",[t._v("Data diambil dari website pemilu2024.kpu.go.id dan di update secara berkala")]),t._v(" "),a("datatable",{attrs:{isBusy:t.isBusy,loading:t.loading,items:t.items,fields:t.fields,meta:t.meta},on:{per_page:t.handlePerPage,pagination:t.handlePagination,search:t.handleSearch,opsi:t.handleOpsi}})],1)])],1)}),[],!1,null,null,null);e.default=w.exports}}]);