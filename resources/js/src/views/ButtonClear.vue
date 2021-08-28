<template>
  <CButton color="secondary" @click="sweetConfirm"><i class="fa fa-eraser"></i>&nbspXóa</CButton>
</template>

<script>
export default {
  name: "ButtonClear",
  methods: {
    sweetConfirm(){
      Swal.fire({
        title: "Xoá",
        text: "Đặt màn hình tìm kiếm về trạng thái ban đầu?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.reload();
        }
      })
    },
  },
}
</script>
