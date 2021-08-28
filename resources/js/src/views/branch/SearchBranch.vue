<template>
  <CCard>
    <CCardHeader>
      <strong>Tìm kiếm</strong>
    </CCardHeader>
    <CCardBody>
      <CRow>
        <CCol sm="12">
          <CInput v-model="name" label="Tên chi nhánh" placeholder="Tên chi nhánh" />
        </CCol>
      </CRow>
    </CCardBody>
    <CCardFooter>
      <CButton type="submit" color="primary" class="float-right"
        ><i class="fa fa-search"></i>&nbspTìm kiếm</CButton
      >
      <button-clear></button-clear>
    </CCardFooter>
  </CCard>
</template>

<script>
import Vue from "vue";
import VueSweetalert2 from "vue-sweetalert2";
import swal from "sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import ButtonClear from '../ButtonClear.vue';

Vue.use(VueSweetalert2);
window.Swal = swal;

export default {
  components: { ButtonClear },
  data() {
    return {
      name: null,
    };
  },
  methods: {

  },
};
</script>
