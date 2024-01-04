<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
  errors: Object,
});
// computed は値を監視して変更があった際に処理を実行する
const hasErrors = computed(() => Object.keys(props.errors || {}).length > 0);
</script>

<template>
  <div v-if="hasErrors">
    <div class="font-medium text-red-600">問題が発生しました。</div>

    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
      <li v-for="(error, key) in props.errors" :key="key">{{ error }}</li>
    </ul>
  </div>
</template>