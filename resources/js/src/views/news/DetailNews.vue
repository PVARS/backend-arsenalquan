<template>
  <CCol sm="12">
    <CCard>
      <CCardHeader>
        <strong>Thông tin bài viết</strong>
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
              label="Tiêu đề"
              placeholder="Tiêu đề"/>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12" class="mb-3">
            <label>Thumbnail</label>
            <b-form-file
              v-model="thumbnail"
              placeholder="Chọn file..."
            ></b-form-file>
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
          <CCol sm="12">
            <label>Nội dung</label>
            <vue-editor v-model="content"></vue-editor>
          </CCol>
        </CRow>
      </CCardBody>
      <CCardFooter>
        <CButton type="submit" size="sm" color="primary" class="float-right"><CIcon name="cil-check-circle"/> Lưu</CButton>
        <CButton size="sm" color="danger"><CIcon name="cil-lock-locked"/> Khóa</CButton>
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
    name: 'DetailNews',
    components: {
      VueEditor
    },
    data(){
      return {
        options: [
          { value: null, text: 'Vui lòng chọn', disabled: true},
          { value: '1', text: 'Quản trị viên hệ thống' },
          { value: '2', text: 'Quản trị viên' }
        ],
        thumbnail: null,
        category: null,
        content: null,
        value: []
      }
    }
}
</script>