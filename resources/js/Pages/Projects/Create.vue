<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';


const props = defineProps({
  companies: Array,
})

const form = useForm({
  title: '',
  company_id: '',
  detail: '',
})

const submit = () => {
  if (!form.title) {
    alert('案件名を入力してください')
    return
  }

  router.post(route('projects.store'), form, {
    onSuccess: () => {
      form.title = ''
      form.company_id = ''
      form.detail=''
    }
  })
}


</script>

<template>
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">案件登録</h1>
    </div>


    <form @submit.prevent="submit">
      <div class="overflow-hidden rounded-lg bg-white shadow">

        <div class="bg-gray-100 p-4 font-medium">
          案件名
        </div>

        <div class="p-4">
          <input v-model="form.title" type="text" placeholder="入力してください。" class="w-full rounded border p-2" />
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          取扱会社
        </div>

        <div class="p-4">
          <select v-model="form.company_id" class="w-full rounded border p-2">
           <option value="">選択してください。</option>
           <option v-for="company in props.companies" :key="company.id" :value="company.id">
            {{ company.name }}
           </option>
          </select>
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          案件詳細
        </div>

        <div class="p-4">
          <textarea v-model="form.detail" rows="10" placeholder="入力してください。" class="w-full rounded border p-2" />
        </div>

      </div>

      <div class="mt-6 flex justify-center">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">
          登録
        </button>
        <Link :href="route('projects.index')" class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
          戻る
        </Link>
      </div>
    </form>

  </MailSendLayout>
</template>
