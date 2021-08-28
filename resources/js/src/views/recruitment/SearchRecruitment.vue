<template>
  <CCard>
    <CCardHeader>
      <strong>Tìm kiếm</strong>
    </CCardHeader>
    <CCardBody>
         <CRow class="mb-3">
        <CCol sm="12">
          <label>Vị trí</label>
          <b-form-select v-model="skill" :options="skillOptions"></b-form-select>
        </CCol>
      </CRow>
       <CRow class="mb-3">
        <CCol sm="12">
          <label>Chi nhánh</label>
          <b-form-select v-model="branch" :options="branchOptions"></b-form-select>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12">
          <CInput
              v-model="exp"
              label="Kinh nghiệm"
              placeholder="Kinh nghiệm"/>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12">
          <CInput
              v-model="salary"
              label="Lương"
              placeholder="Lương"/>
        </CCol>
      </CRow>
    </CCardBody>
    <CCardFooter>
      <CButton type="submit" color="primary" class="float-right"><i class="fa fa-search"></i>&nbspTìm kiếm</CButton>
      <button-clear></button-clear>
    </CCardFooter>
  </CCard>
</template>

<script>
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import ButtonClear from '../ButtonClear.vue';

Vue.use(VueSweetalert2);
window.Swal = swal;

export default {
  components: { ButtonClear },
  name: "SearchRecruitment",
  data(){
    return {
      branch: null,
      skill: null,
      exp: "",
      salary: "",
      skillOptions: [
        { value: null, text: "Vui lòng chọn", disabled: true },
        { value: "1", text: "Java" },
        { value: "2", text: "PHP" },
      ],
      branchOptions: [
        { value: null, text: "Vui lòng chọn", disabled: true },
        { value: "1", text: "Huế" },
        { value: "2", text: "Đà nẵng" },
      ],
    };
  },
  methods: {

  }
}
</script>
