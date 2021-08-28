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
        :current-page="currentPage">
        <template #cell(actions)="data">
          <b-button variant="danger">
              <i class="fa fa-trash"></i>
          </b-button>
        </template>
      </b-table>
      <b-pagination
        align="center"
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="table">
      </b-pagination>
    </CCard>
  </div>
</template>

<script>
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import SearchInfor from "./SearchInfor.vue";

Vue.use(BootstrapVue);

export default {
  components: { SearchInfor },
  data() {
    return {
      perPage: 5,
      currentPage: 1,
      fields: [
        { key: "index", label: "STT", thClass: "text-center width-col-5", tdClass: "text-center width-col-5", sortable: true },
        { key: "skillname", label: "Tên vị trí", thClass: "text-center ", tdClass: "text-center " },
        { key: "email", label: "Email", thClass: "text-center ", tdClass: "text-center " },
        { key: "fullname", label: "Tên đầy đủ", thClass: "text-center ", tdClass: "text-center " },
        { key: "phone", label: "Số điện thoại", thClass: "text-center ", tdClass: "text-center " },
        { key: "actions", label: "", class: "text-center" },
      ],
      items: [
        { index: "1", skillname: "JAVA", email: "System@Admin.com", fullname: "Văn A", phone: "0124512456" },
        { index: "2", skillname: "Python", email: "System@Admin.com", fullname: "Văn B", phone: "0124512456" },
        { index: "3", skillname: "PHP", email: "System@Admin.com", fullname: "Văn C", phone: "0124512456" }
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
