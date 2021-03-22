<template>
  <div :id="`${id_modal}`" class="modal fade" role="dialog">
    <div :class="`modal-dialog ${size_modal || 'modal-sm'}`">
      <form>
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title">{{ text_header_modal }}</h6>
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>
          <div class="modal-body">
            <slot name="modal_body"></slot>
          </div>
          <div class="modal-footer">
            <slot name="modal_footer"></slot>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  name: "ButtonPage",
  props: ["text_header_modal", "id_modal", "size_modal"],
  data() {
    return {};
  },
};
</script>