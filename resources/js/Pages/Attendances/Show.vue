<script setup>
import { router, Link } from "@inertiajs/vue3"
import AttendanceLayout from '@/Layouts/AttendanceLayout.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

</script>


<template>
  <AttendanceLayout>
    <FlashMessage />
    <div class="min-h-screen bg-gray-50 p-6 text-gray-800">
      <div class="mx-auto max-w-3xl">
        <div class="mb-6">
          <h1 class="text-2xl font-bold text-gray-900">勤怠編集申請（承認未実装）</h1>
          <p class="mt-1 text-sm text-gray-500">
            勤怠情報を、修正して申請します。
          </p>
        </div>

        <div class="rounded-lg bg-white p-6 shadow">
          <div class="space-y-5">
            <div>
              <label class="mb-1 block text-sm font-bold text-gray-700">
                勤務日
              </label>
              <input type="date"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
            </div>

            <div class="grid gap-4 md:grid-cols-2">
              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  出勤時間
                </label>
                <input type="datetime-local"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
              </div>

              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  退勤時間
                </label>
                <input type="datetime-local"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
              </div>

              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  休憩開始時間
                </label>
                <input type="datetime-local"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
              </div>

              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  休憩終了時間
                </label>
                <input type="datetime-local"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
              </div>
            </div>

            <div>
              <label class="mb-1 block text-sm font-bold text-gray-700">
                申請理由
              </label>
              <textarea rows="4" placeholder="修正理由を入力してください"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-center gap-3 pt-4">
              <button type="button"
                class="rounded bg-blue-600 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700">
                編集申請
              </button>

              <button type="button"
                class="rounded bg-gray-500 px-4 py-2 text-sm font-bold text-white hover:bg-gray-600">
                戻る
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AttendanceLayout>
</template>
