<template>
  <div>
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
          <b-button variant="success" class="mr-3"
            ><i class="fa fa-plus"></i
          ></b-button>
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
Vue.use(BootstrapVue);

export default {
  name: "Categories",
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
          key: "category",
          label: "Danh mục",
          thClass: "text-center width-col-50",
          tdClass: "text-center width-col-50",
        },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        { index: "1", category: "System Admin" },
        { index: "2", category: "Admin" },
        { index: "3", category: "Member" },
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
