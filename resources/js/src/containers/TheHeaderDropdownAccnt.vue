<template>
  <CDropdown
    inNav
    class="c-header-nav-items"
    placement="bottom-end"
    add-menu-classes="pt-0"
  >
    <template #toggler>
      <CHeaderNavLink>
        <div class="c-avatar">
            <CIcon name="cil-user" />
        </div>
      </CHeaderNavLink>
    </template>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>Thông tin cá nhân</strong>
    </CDropdownHeader>
    <CDropdownItem>
      <CIcon name="cil-user" />&nbspTrang cá nhân
    </CDropdownItem>
    <CDropdownDivider/>
    <CDropdownItem @click="logout()">
      <CIcon name="cil-lock-locked" />&nbspĐăng xuất
    </CDropdownItem>
  </CDropdown>
</template>

<script>
export default {
  name: 'TheHeaderDropdownAccnt',
  data () {
    return {}
  },
  methods: {
    logout(){
      let data = JSON.parse(localStorage.getItem('user_info'));

      axios.get('/api/v1/admin/user/logout', {headers: {'Authorization': 'Bearer ' + data['access_token']}}).then(()=> {
          localStorage.removeItem('user_info');
          this.$router.push({path: '/login'});
      }).catch(()=> {
          alert("Đã xảy ra lỗi");
      })
    }
  }
}
</script>

<style scoped>
  .c-avatar{
    font-size: 20px;
  }
</style>
