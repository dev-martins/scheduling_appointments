<template>
  <a :class="`${class_button_page}`" :style="`${text_color || 'color: #fff'}`">
    <i :class="`${class_icon_button}`"></i>
    {{ text_button }}
  </a>
</template>
<script>
export default {
  name: "ButtonPage",
  props: [
    "class_button_page",
    "text_color",
    "class_icon_button",
    "text_button",
  ],
  data() {
    return {};
  },
};
</script>