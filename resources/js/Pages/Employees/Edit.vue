<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  employee: Object,
  companies:Array
})

const form = reactive({
  name: props.employee.name,
  company_id: props.employee.company_id
})

const submit = () => {

  if (!form.name) {
    alert('社員名を入力してください')
    return
  }

  router.patch(route('employees.update', props.employee.id), form)
}

</script>

<template>
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">社員情報編集</h1>
    </div>


    <form @submit.prevent="submit">
      <div class="overflow-hidden rounded-lg bg-white shadow">

        <div class="bg-gray-100 p-4 font-medium">
          社員名
        </div>

        <div class="p-4">
          <input v-model="form.name" type="text" class="w-full rounded border p-2" />
        </div>

        <div class="bg-gray-100 p-4 font-medium border-t">
          所属会社
        </div>

        <div class="p-4">
          <select v-model="form.company_id" class="w-full rounded border p-2">
            <option v-for="company in props.companies" :key="company.id" :value="company.id">
              {{ company.name }}
            </option>
          </select>
        </div>

      </div>

      <div class="mt-6 flex justify-center">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">
          更新
        </button>
        <Link :href="route('employees.index')" class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
          戻る
        </Link>
      </div>
    </form>

  </MailSendLayout>
</template>
