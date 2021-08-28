<template>
  <div class="c-app flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol md="8">
          <CAlert
            show
            color="danger"
            v-html="messagesHtml"
            v-show="showAlert"
            >{{ messagesHtml }}</CAlert
          >
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm>
                  <h1>Đăng nhập</h1>
                  <CInput
                    placeholder="Tên đăng nhập"
                    autocomplete="off"
                    v-model="form.login_id"
                  >
                    <template #prepend-content>
                      <CIcon name="cil-user" />
                    </template>
                  </CInput>
                  <CInput
                    placeholder="Mật khẩu"
                    type="password"
                    autocomplete="off"
                    v-model="form.password"
                  >
                    <template #prepend-content>
                      <CIcon name="cil-lock-locked" />
                    </template>
                  </CInput>
                  <CRow>
                    <CCol col="6" class="text-left">
                      <CButton color="primary" class="px-4" @click="login()"
                        >Đăng nhập</CButton
                      >
                    </CCol>
                  </CRow>
                </CForm>
              </CCardBody>
            </CCard>
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
import BootstrapVue from "bootstrap-vue";
import VueSweetalert2 from "vue-sweetalert2";
import swal from "sweetalert2";

Vue.use(BootstrapVue);
Vue.use(VueSweetalert2);
window.Swal = swal;

export default {
  name: "Login",
  data() {
    return {
      messagesHtml: "",
      form: {
        login_id: "",
        password: "",
      },
      showAlert: false,
    };
  },
  methods: {
    login() {
      let self = this;

      axios
        .post("/api/v1/admin/login", this.form)
        .then((response) => {
          localStorage.setItem("user_info", JSON.stringify(response.data));
          this.$router.push({ path: "/" });
        })
        .catch((errors) => {
          let errorConnect = "Error: Network Error";
          let errorDb = "Error: Request failed with status code 500";

          if (errors === errorConnect || errors === errorDb) {
            Swal.fire("LỖI", "Lỗi kết nối. Vui lòng thử lại sau !", "error");
            return false;
          } else {
            let strMsg = "";
            self.showAlert = true;
            self.messagesHtml = errors.response.data.errors;

            if (self.messagesHtml === undefined) {
              self.messagesHtml = errors.response.data.message;
            } else {
              for (const [k, v] of Object.entries(self.messagesHtml)) {
                v.forEach((errorValidation) => {
                  strMsg += errorValidation + "<br>";
                });
              }
              self.messagesHtml = strMsg;
            }
          }
        });
    },
  },
};
</script>
