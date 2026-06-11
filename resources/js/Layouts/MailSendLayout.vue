<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-6">
        <nav class="flex h-16 items-center gap-8">

          <Link v-bind:href="route('dashboard.index')" class="font-medium text-gray-700">
            Home
          </Link>

          <Link v-bind:href="route('companies.index')" class="font-medium text-gray-700 hover:text-blue-600">
            会社一覧
          </Link>

          <Link v-bind:href="route('employees.index')" class="font-medium text-gray-700 hover:text-blue-600">
            社員一覧
          </Link>

          <Link v-bind:href="route('projects.index')" class="font-medium text-gray-700 hover:text-blue-600">
            案件一覧
          </Link>

          <Link v-bind:href="route('languages.index')" class="font-medium text-gray-700 hover:text-blue-600">
              言語一覧
          </Link>

          <Link v-bind:href="route('send.create')" class="font-medium text-gray-700 hover:text-blue-600">
            メール作成
          </Link>

        </nav>
      </div>
    </header>

    <main class="mx-auto max-w-7xl p-6">
      <slot />
    </main>

  </div>
</template>
