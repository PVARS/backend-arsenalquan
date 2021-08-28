<template>
  <CCard>
    <CCardHeader>
      <strong>Tìm kiếm</strong>
    </CCardHeader>
    <CCardBody>
      <CRow class="mb-3">
        <CCol sm="12">
          <label>Danh mục</label>
          <b-form-select v-model="category" :options="options"></b-form-select>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12">
          <CInput
              v-model="title"
              label="Tiêu đề"
              placeholder="Tiêu đề"/>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12">
          <CInput
              v-model="create_by"
              label="Người đăng"
              placeholder="Người đăng"/>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="12" class="mb-3">
          <label>Từ khóa</label>
          <b-form-tags v-model="value" no-outer-focus class="mb-2">
            <template v-slot="{ tags, inputAttrs, inputHandlers, tagVariant, addTag, removeTag }">
              <b-input-group class="mb-2">
                <b-form-input
                  v-bind="inputAttrs"
                  v-on="inputHandlers"
                  placeholder="Nhập từ khóa cho bài viết của bạn"
                  class="form-control"
                ></b-form-input>
                <b-input-group-append>
                  <b-button @click="addTag()" variant="primary">Thêm</b-button>
                </b-input-group-append>
              </b-input-group>
              <div class="d-inline-block" style="font-size: 1.5rem;">
                <b-form-tag
                  v-for="tag in tags"
                  @remove="removeTag(tag)"
                  :key="tag"
                  :title="tag"
                  :variant="tagVariant"
                  class="mr-1"
                >{{ tag }}</b-form-tag>
              </div>
            </template>
          </b-form-tags>
        </CCol>
      </CRow>
      <CRow>
        <CCol sm="4">
          <label>Từ</label>
          <CInput
              v-model="dateFrom"
              type="date"
              horizontal
          />
        </CCol>
        <CCol sm="4">
          <label>Đến</label>
          <CInput
              v-model="dateTo"
              type="date"
              horizontal
          />
        </CCol>
      </CRow>
    </CCardBody>
    <CCardFooter>
      <CButton type="submit" color="primary" class="float-right"><i class="fa fa-search"></i>&nbspTìm kiếm</CButton>
      <ButtonClear></ButtonClear>
    </CCardFooter>
  </CCard>
</template>

<script>
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import ButtonClear from "../ButtonClear";

Vue.use(VueSweetalert2);
window.Swal = swal;

export default {
  name: "SearchNews",
  components: {ButtonClear},
  data(){
    return {
      options: [
        { value: null, text: 'Vui lòng chọn', disabled: true},
        { value: '1', text: 'BAP Life' },
        { value: '2', text: 'Tuyển dụng' }
      ],
      title: "",
      create_by: "",
      fullName: "",
      email: "",
      category: null,
      dateFrom: "",
      dateTo: "",
      value: []
    }
  },
  methods: {},
}
</script>

<style scoped>

</style>
