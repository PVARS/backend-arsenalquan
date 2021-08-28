<template>
  <div>
    <SearchNews></SearchNews>
    <CCard>
      <b-table
        id="table"
        striped
        bordered
        fixed
        hover
        :fields="fields"
        :items="items"
        :per-page="perPage"
        :current-page="currentPage"
      >
        <template #cell(actions)="data">
          <b-button class="mr-3"><i class="fa fa-edit"></i></b-button>
          <b-button variant="danger"><i class="fa fa-trash"></i></b-button>
        </template>
      </b-table>

      <b-pagination
        align="center"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="table"
      >
      </b-pagination>
    </CCard>
  </div>
</template>

<script>
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import SearchNews from "./SearchNews"
Vue.use(BootstrapVue);

export default {
  name: "ListNews",
  components: { SearchNews },
  data() {
    return {
      perPage: 5,
      currentPage: 1,
      fields: [
        {
          key: "index",
          label: "STT",
          thClass: "text-center width-col-5",
          tdClass: "text-center width-col-5",
        },
        {
          key: "title",
          label: "Họ tên",
          thClass: "text-center",
          tdClass: "text-center",
        },
        { key: "create_at", label: "Ngày đăng", class: "text-center" },
        { key: "create_by", label: "Người đăng", class: "text-center" },
        { key: "view", label: "Lượt xem", class: "text-center" },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        {
          index: "1",
          title: "Phan Văn Vũ",
          create_at: "vupv@bap.jp",
          create_by: "Quản trị viên hệ thống",
          view: "10",
        },
        {
          index: "2",
          title: "Phan Văn Vũ",
          create_at: "vupv@bap.jp",
          create_by: "Quản trị viên hệ thống",
          view: "10",
        },
        {
          index: "3",
          title: "Phan Văn Vũ",
          create_at: "vupv@bap.jp",
          create_by: "Quản trị viên hệ thống",
          view: "10",
        },
        {
          index: "4",
          title: "Phan Văn Vũ",
          create_at: "vupv@bap.jp",
          create_by: "Quản trị viên hệ thống",
          view: "10",
        },
        {
          index: "5",
          title: "Phan Văn Vũ",
          create_at: "vupv@bap.jp",
          create_by: "Quản trị viên hệ thống",
          view: "10",
        },
      ],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
  },
};
</script>
