<template>
  <CCard>
    <CCardHeader>
      <slot name="header"> <CIcon name="cil-grid" />Danh sách vai trò</slot>
    </CCardHeader>
    <CCardBody>
      <CDataTable
        :hover="hover"
        :striped="striped"
        :border="border"
        :small="small"
        :fixed="fixed"
        :items="items"
        :fields="fields"
        :items-per-page="small ? 10 : 5"
        :dark="dark"
        pagination>
        <template #status="{ item }">
          <td>
            {{ item.status }}
          </td>
        </template>
      </CDataTable>
    </CCardBody>
  </CCard>
</template>

<script>
export default {
  name: "Table",
  props: {
    items: Array,
    fields: {
      type: Array,
      default() {
        return ["username", "registered", "role", "status"];
      },
    },
    hover: Boolean,
    striped: Boolean,
    border: Boolean,
    small: Boolean,
    fixed: Boolean,
    dark: Boolean,
  },
  methods: {},
};
</script>
