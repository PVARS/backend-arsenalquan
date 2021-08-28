<template>
  <div>
    <SearchAccount></SearchAccount>
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
          <b-button variant="danger"><i class="fa fa-lock"></i></b-button>
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
import SearchAccount from "./SearchAccount";
Vue.use(BootstrapVue);

export default {
  name: "ListAccount",
  components: { SearchAccount },
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
          key: "fullName",
          label: "Họ tên",
          thClass: "text-center",
          tdClass: "text-center",
        },
        { key: "email", class: "text-center" },
        { key: "role", label: "Vai trò", class: "text-center" },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        {
          index: "1",
          fullName: "Phan Văn Vũ",
          email: "vupv@bap.jp",
          role: "Quản trị viên hệ thống",
        },
        {
          index: "2",
          fullName: "Nguyễn Hoài Sơn",
          email: "sonnh2@bap.jp",
          role: "Quản trị viên hệ thống",
        },
        {
          index: "3",
          fullName: "Nguyễn Văn A",
          email: "vupv@bap.jp",
          role: "Quản trị viên",
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
