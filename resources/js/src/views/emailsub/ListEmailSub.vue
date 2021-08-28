<template>
  <div>
    <search-mail></search-mail>
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
import SearchMail from './SearchMail.vue';

Vue.use(BootstrapVue);

export default {
  components: { SearchMail },
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
          key: "email",
          label: "Email",
          thClass: "text-center ",
          tdClass: "text-center ",
        },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        {
          index: "1",
          email: "System@Admin.com",
        },
        {
          index: "2",
          email: "System@Admin.com",
        },
        {
          index: "3",
          email: "System@Admin.com",
        }
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
