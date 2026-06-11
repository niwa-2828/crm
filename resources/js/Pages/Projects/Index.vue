<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue"
import { router } from "@inertiajs/vue3"
import FlashMessage from '@/Components/FlashMessage.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  projects: Array,
})

const deleteProject = id => {
  router.delete(route('projects.destroy', id ), {
    onBefore: () => confirm('本当に削除しますか？')
  })
}

</script>

<template>
  <FlashMessage />
  <MailSendLayout>
    <div class="mb-6 flex items-center justify-between">
      <h1 class="text-3xl font-bold">案件一覧</h1>

      <div class="flex gap-1">
        <Link :href="route('projects.create')" class="rounded bg-blue-600 px-4 py-2 text-white">
          案件登録
        </Link>

        <Link :href="route('dashboard.index')" class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
          戻る
        </Link>
      </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
      <table class="min-w-full">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-4 text-left">案件名</th>

            <th class="p-4 text-left">取扱会社</th>

            <th class="p-4 text-center">操作</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="project in projects" :key="project.id" class="border-t">
            <td class="p-4">
              {{ project.title }}
            </td>

            <td class="p-4">
              {{ project.company.name }}
            </td>

            <td class="p-4 text-center">
              <button @click="router.get(route('projects.edit',project.id))" class="mr-2 rounded bg-yellow-500 px-3 py-1 text-white">
                修正
              </button>

              <button @click="deleteProject(project.id)" class="rounded bg-red-600 px-3 py-1 text-white">
                削除
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </MailSendLayout>
</template>
