<template>
  <CCol sm="12">
    <CCard>
      <CCardHeader>
        <strong>Thông tin tài khoản</strong>
      </CCardHeader>
      <CCardBody>
        <CRow class="mb-3">
          <CCol sm="12">
            <label>Vị trí</label>
            <b-form-select
              v-model="skill"
              :options="skillOptions"
            ></b-form-select>
          </CCol>
        </CRow>
        <CRow class="mb-3">
          <CCol sm="12">
            <label>Chi nhánh</label>
            <b-form-select
              v-model="branch"
              :options="branchOptions"
            ></b-form-select>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12">
            <CInput label="Kinh nghiệm" placeholder="Kinh nghiệm" />
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12">
            <CInput placeholder="Lương" label="Lương"> </CInput>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12" class="mb-3">
            <label>Hình ảnh</label>
            <b-form-file
              v-model="thumbnail"
              placeholder="Chọn file..."
            ></b-form-file>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12">
            <label>Nội dung</label>
            <vue-editor v-model="content"></vue-editor>
          </CCol>
        </CRow>
      </CCardBody>
      <CCardFooter>
        <CButton type="submit" size="sm" color="primary" class="float-right"
          ><CIcon name="cil-check-circle" /> Lưu</CButton
        >
      </CCardFooter>
    </CCard>
  </CCol>
</template>

<script>
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import { VueEditor } from "vue2-editor";

Vue.use(BootstrapVue);

export default {
  name: "DetailRecruitment",
  components: {
      VueEditor
    },
  data() {
    return {
      branch: null,
      skill: null,
      thumbnail: null,
      content: "",
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
};
</script>