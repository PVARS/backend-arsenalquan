<template>
  <CCol sm="12">
    <CCard>
      <CCardHeader>
        <strong>Thông tin tài khoản</strong>
      </CCardHeader>
      <CCardBody>
        <CRow>
          <CCol sm="12">
            <CInput
                label="Họ tên"
                placeholder="Họ tên"/>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12">
            <CInput
                label="Email"
                placeholder="Email"/>
          </CCol>
        </CRow>
        <CRow class="mb-3">
          <CCol sm="12">
            <label>Vai trò</label>
            <b-form-select v-model="role" :options="options"></b-form-select>
          </CCol>
        </CRow>
        <CRow>
          <CCol sm="12">
            <CInput
                placeholder="Mật khẩu"
                type="password"
                label="Mật khẩu">
            </CInput>
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
export default {
    name: 'DetailAccount',
    data(){
      return {
        options: [
          { value: null, text: 'Vui lòng chọn', disabled: true},
          { value: '1', text: 'Quản trị viên hệ thống' },
          { value: '2', text: 'Quản trị viên' }
        ],
        role: null,
      }
    }
}
</script>