<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  authUser: Object,
})

</script>

<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">You're logged in!</div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <Link :href="route('dashboard.index')"
            class="flex items-center gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:ring-blue-500 transition">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-2xl">
              🏢
            </div>
            <div>
              <div class="font-semibold text-gray-800">会社ダッシュボード</div>
              <div class="text-sm text-gray-500">会社一覧を表示</div>
            </div>
          </Link>

          <Link :href="route('attendances.index')"
            class="flex items-center gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:ring-blue-500 transition">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-2xl">
              ⏰
            </div>
            <div>
              <div class="font-semibold text-gray-800">勤怠管理</div>
              <div class="text-sm text-gray-500">勤怠管理システムを表示</div>
            </div>
          </Link>

          <Link 
          v-if = "props.authUser.role === 'admin'"
          :href="route('admin.attendances.index')"
            class="flex items-center gap-4 rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:ring-blue-500 transition">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-2xl">
              🖋
            </div>
            <div>
              <div class="font-semibold text-gray-800">管理者用勤怠管理</div>
              <div class="text-sm text-gray-500">管理者用勤怠管理システムを表示</div>
            </div>
          </Link>
          
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
