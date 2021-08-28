<template>
  <div>
    <search-position></search-position>
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
import SearchPosition from "./SearchPosition.vue";
Vue.use(BootstrapVue);

export default {
  components: { SearchPosition },
  name: "Positions",
  data() {
    return {
      perPage: 5,
      currentPage: 1,
      fields: [
        {
          key: "index",
          label: "STT",
          thClass: "text-center",
          tdClass: "text-center",
          sortable: true,
        },
        {
          key: "Name",
          label: "Tên vị trí",
          thClass: "text-center",
          tdClass: "text-center",
        },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        { index: "1", Name: "System Admin" },
        { index: "2", Name: "Admin" },
        { index: "3", Name: "Member" }
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
