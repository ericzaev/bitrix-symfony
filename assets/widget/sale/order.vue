<script>
import basket from '../../components/widget/sale/order/basket';

export default {
  data() {
    return {
      process: false
    };
  },
  props: {
    id: {
      type: Number,
      required: true
    },
    list: {
      type: Array,
      required: true
    }
  },
  components: {basket}
};
</script>

<style lang="scss">
.test {
  color: red;
}
</style>

<template>
  <div class="bootstrap-styles">
    <b-alert color="success" show>this is widget</b-alert>
    <basket :list="list"></basket>
  </div>
</template>
