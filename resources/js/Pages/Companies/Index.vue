<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue"
import { router, Link } from "@inertiajs/vue3"
import FlashMessage from '@/Components/FlashMessage.vue'

defineProps({
  companies: Array,
})

const deleteCompany = id => {
  router.delete(route('companies.destroy', id), {
    onBefore: () => confirm('本当に削除しますか？')
  })
}

</script>

<template>
  <FlashMessage />
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">会社一覧</h1>

      <div class="flex gap-1">
        <button @click="router.get(route('companies.create'))" class="rounded bg-blue-600 px-4 py-2 text-white">
          会社登録
        </button>

        <!--CSV出力-->
        <a :href="route('companies.export-csv')" class="rounded bg-green-600 px-4 py-2 text-white">
          CSV出力
        </a>
        
        <!--PDFダウンロード-->
        <a :href="route('companies.export-pdf')" class="rounded bg-yellow-600 px-4 py-2 text-white hover:bg-yellow-700">
          PDFダウンロード
        </a>
      </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
      <table class="min-w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-4 text-left">会社名</th>

            <th class="p-4 text-center">操作</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="company in companies" :key="company.id" class="border-t">
            <td class="p-4">
              {{ company.name }}
            </td>

            <td class="p-4 text-center">
              <button @click="router.get(route('companies.edit', company.id))"
                class="mr-2 rounded bg-yellow-500 px-3 py-1 text-white">
                修正
              </button>

              <button @click="deleteCompany(company.id)" class="rounded bg-red-600 px-3 py-1 text-white">
                削除
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="mt-3 flex justify-end">
      <Link :href="route('mailsend.index')" class="rounded bg-pink-300 px-4 py-2 text-white">
        戻る
      </Link>
    </div>
  </MailSendLayout>
</template>
