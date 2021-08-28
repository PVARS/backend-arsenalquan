<template>
    <CCol sm="12">
        <CCard>
          <CCardHeader>
            <strong>Thông tin vai trò </strong>
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol sm="12">
                <CInput
                  label="Tên vai trò"
                  placeholder="Tên vai trò"
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
    name: 'DetailPosition',
}
</script>
