<template>
  <div>
    <search-branch></search-branch>
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
import SearchBranch from "./SearchBranch.vue";
Vue.use(BootstrapVue);

export default {
  components: { SearchBranch },
  name: "Branchs",
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

          sortable: true,
        },
        {
          key: "Name",
          label: "Tên chi nhánh",
          thClass: "text-center width-col-50",
          tdClass: "text-center width-col-50",
        },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        { index: "1", Name: "Đà nẵng" },
        { index: "2", Name: "Huế" },
        { index: "3", Name: "HCM" },
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
