<template>
  <div>
    <search-recruitment></search-recruitment>
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
import SearchRecruitment from "./SearchRecruitment.vue";
Vue.use(BootstrapVue);

export default {
  components: { SearchRecruitment },
  name: "ListRecruitment",
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
          key: "skillid",
          label: "Vị trí",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "branch",
          label: "Chi nhánh",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "exp",
          label: "Kinh nghiệm",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "salary",
          label: "Lương",
          thClass: "text-center",
          tdClass: "text-center",
        },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        {
          index: "1",
          skillid: "Java",
          branch: "Đà nẵng",
          exp: "1 năm",
          salary: "1000$",
        },
        {
          index: "2",
          skillid: "Python",
          branch: "Japan",
          exp: "1 năm",
          salary: "1000$",
        },
        {
          index: "3",
          skillid: "PHP",
          branch: "HCM",
          exp: "2 năm",
          salary: "5000$",
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
