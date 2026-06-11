<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';


const form = useForm({
  language: '',
})

const submit = () => {
  if (!form.language) {
    alert('言語名を入力してください')
    return
  }

  router.post(route('languages.store'), form, {
    onSuccess: () => {
      form.language = ''
    }
  })
}


</script>

<template>
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">言語登録</h1>
    </div>


    <form @submit.prevent="submit">
      <div class="overflow-hidden rounded-lg bg-white shadow">

        <div class="bg-gray-100 p-4 font-medium">
          言語名
        </div>

        <div class="p-4">
          <input v-model="form.language" type="text" placeholder="入力してください。" class="w-full rounded border p-2" />
        </div>

      </div>

      <div class="mt-6 flex justify-center">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">
          登録
        </button>
        <Link :href="route('languages.index')" class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
          戻る
        </Link>
      </div>
    </form>

  </MailSendLayout>
</template>
