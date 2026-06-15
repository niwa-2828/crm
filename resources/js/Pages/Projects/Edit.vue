<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  project: Object,
  companies: Array,
  languages: Array,
})

const form = reactive({
  title: props.project.title,
  company_id: props.project.company_id,
  detail: props.project.detail,

  // 中間テーブルの言語idを呼び出す。
  language_ids: props.project.languages.map(
    language => language.id
  ),
})

const submit = () => {

  if (!form.title) {
    alert('案件名を入力してください')
    return
  }

  router.patch(route('projects.update', props.project.id), form)
}

</script>

<template>
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">案件情報編集</h1>
    </div>


    <form @submit.prevent="submit">
      <div class="overflow-hidden rounded-lg bg-white shadow">

        <div class="bg-gray-100 p-4 font-medium">
          案件名
        </div>

        <div class="p-4">
          <input v-model="form.title" type="text" class="w-full rounded border p-2" />
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          取扱会社
        </div>

        <div class="p-4">
          <select v-model="form.company_id" class="w-full rounded border p-2">
            <option v-for="company in props.companies" :key="company.id" :value="company.id">
              {{ company.name }}
            </option>
          </select>
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          案件詳細
        </div>

        <div class="p-4">
          <textarea v-model="form.detail" rows="10" class="w-full rounded border p-2" />
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          使用言語
        </div>

        <div class="p-4">
          <div class="w-full rounded border p-3">
            <label v-for="language in props.languages" :key="language.id" class="mr-4 inline-flex items-center gap-2">
              <input type="checkbox" :value="language.id" v-model="form.language_ids" />
              <span>{{ language.language }}</span>
            </label>
          </div>
        </div>

      </div>

      <div class="mt-6 flex justify-center">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">
          更新
        </button>
        <Link :href="route('projects.index')" class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
          戻る
        </Link>
      </div>
    </form>

  </MailSendLayout>
</template>
