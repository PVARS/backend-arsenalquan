<template>
  <CCard>
    <CCardHeader>
      <strong>Tìm kiếm</strong>
    </CCardHeader>
    <CCardBody>
      <CRow>
        <CCol sm="12">
          <CInput
            v-model="fullName"
            id="fullName"
            label="Họ tên"
            placeholder="Họ tên"
          />
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12">
          <CInput v-model="email" label="Email" placeholder="Email" />
        </CCol>
      </CRow>

      <CRow class="mb-3">
        <CCol sm="12">
          <label>Vai trò</label>
          <b-form-select v-model="role" :options="options"></b-form-select>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="4">
          <label>Từ</label>
          <CInput v-model="dateFrom" type="date" horizontal />
        </CCol>
        <CCol sm="4">
          <label>Đến</label>
          <CInput v-model="dateTo" type="date" horizontal />
        </CCol>
      </CRow>
    </CCardBody>
    <CCardFooter>
      <CButton type="submit" size="sm" color="primary" class="float-right">
          <i class="fa fa-search"></i>&nbspTìm kiếm</CButton
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
import ButtonClear from "../ButtonClear.vue";

Vue.use(VueSweetalert2);
window.Swal = swal;

export default {
  components: {
    ButtonClear,
  },
  name: "SearchAccount",
  data() {
    return {
      options: [
        {
          value: null,
          text: "Vui lòng chọn",
          disabled: true,
        },
        {
          value: "1",
          text: "Quản trị viên hệ thống",
        },
        {
          value: "2",
          text: "Quản trị viên",
        },
      ],
      fullName: "",
      email: "",
      role: null,
      dateFrom: "",
      dateTo: "",
    };
  },
  methods: {},
};
</script>
