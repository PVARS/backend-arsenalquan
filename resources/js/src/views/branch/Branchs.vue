<template>
    <CCol sm="12">
        <CCard>
          <CCardHeader>
            <strong>Thông tin chi nhánh </strong>
          </CCardHeader>
          <CCardBody>
            <CRow>
              <CCol sm="12">
                <CInput
                  label="Tên chi nhánh"
                  placeholder="Tên chi nhánh"
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
    name: 'DetailBranch',
}
</script>