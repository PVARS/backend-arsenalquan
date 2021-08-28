<template>
  <CCol sm="12">
    <CCard>
      <CCardHeader>
        <strong>Thông tin danh mục</strong>
      </CCardHeader>
      <CCardBody>
        <CRow>
          <CCol sm="12">
            <CInput
              label="Tên danh mục"
              placeholder="Tên danh mục"
            />
          </CCol>
        </CRow>
      </CCardBody>
      <CCardFooter>
        <CButton type="submit" size="sm" color="primary"><CIcon name="cil-check-circle"/> Lưu</CButton>
      </CCardFooter>
    </CCard>
  </CCol>
</template>

<script>
export default {
    name: 'DetailCategory',
}
</script>