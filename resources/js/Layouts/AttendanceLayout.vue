<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow-sm">
      <div class="mx-auto max-w-6xl px-4 py-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h1 class="text-xl font-bold text-gray-800">
              勤怠管理システム
            </h1>
            <p class="text-sm text-gray-500">
              出勤・休憩・退勤を管理します。
            </p>
          </div>

          <nav class="flex gap-2">
            <Link
              :href="route('dashboard')"
              class="rounded-md px-4 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-900"
            >
              Home
            </Link>

            <Link
              :href="route('attendances.index')"
              class="rounded-md px-4 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-900"
            >
              勤怠一覧
            </Link>

            <!--日付を任意に選んで申請-->
            <Link
              :href="route('attendances.show')"
              class="rounded-md px-4 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-900"
            >
              勤怠編集
            </Link>

          </nav>
        </div>
      </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8">
      <slot />
    </main>
  </div>
</template>
