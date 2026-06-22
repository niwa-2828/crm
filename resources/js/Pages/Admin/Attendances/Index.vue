<script setup>
import AttendanceLayout from "@/Layouts/AttendanceLayout.vue"
import { Link } from "@inertiajs/vue3"


const props = defineProps({
  attendanceCorrectionRequests: Array,
})

</script>

<template>
  <AttendanceLayout>
    <div class="min-h-screen bg-gray-50 p-6 text-gray-800">
      <div class="mx-auto max-w-6xl">
        <div class="mb-6 flex items-start justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">勤怠承認一覧</h1>
            <p class="mt-1 text-sm text-gray-500">
              勤怠修正申請の確認と承認管理
            </p>
          </div>

        </div>

        <div class="mb-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <h2 class="mb-5 text-base font-bold text-gray-900">検索・フィルター</h2>

          <div class="grid gap-4 md:grid-cols-4">
            <div>
              <label class="mb-2 block text-sm font-bold text-gray-700">
                年月
              </label>
              <input type="month" value="2026-06"
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
            </div>

            <div>
              <label class="mb-2 block text-sm font-bold text-gray-700">
                申請ステータス
              </label>
              <select
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                <option>申請中</option>
                <option>承認済み</option>
                <option>却下済み</option>
                <option>すべて</option>
              </select>
            </div>

            <div>
              <label class="mb-2 block text-sm font-bold text-gray-700">
                申請者
              </label>
              <select
                class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none">
                <option>すべて</option>
                <option>一般ユーザー</option>
                <option>管理者</option>
              </select>
            </div>

            <div class="flex items-end gap-3">
              <button type="button"
                class="rounded-md bg-blue-600 px-5 py-2 text-sm font-bold text-white hover:bg-blue-700">
                検索
              </button>

              <button type="button"
                class="rounded-md bg-gray-500 px-5 py-2 text-sm font-bold text-white hover:bg-gray-600">
                リセット
              </button>
            </div>
          </div>
        </div>

        <div class="mb-5 grid gap-4 md:grid-cols-4">
          <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
            <div class="text-2xl font-bold text-blue-600">5</div>
            <div class="mt-1 text-sm text-gray-500">申請中</div>
          </div>

          <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
            <div class="text-2xl font-bold text-green-600">12</div>
            <div class="mt-1 text-sm text-gray-500">承認済み</div>
          </div>

          <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
            <div class="text-2xl font-bold text-red-600">2</div>
            <div class="mt-1 text-sm text-gray-500">却下済み</div>
          </div>

          <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
            <div class="text-2xl font-bold text-purple-600">19</div>
            <div class="mt-1 text-sm text-gray-500">総申請数</div>
          </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <h2 class="mb-5 text-base font-bold text-gray-900">勤怠修正申請</h2>

          <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead>
                <tr class="border-b bg-gray-50 text-xs text-gray-500">
                  <th class="px-4 py-3">申請日時</th>
                  <th class="px-4 py-3">申請者</th>
                  <th class="px-4 py-3">対象日</th>
                  <th class="px-4 py-3">出勤</th>
                  <th class="px-4 py-3">退勤</th>
                  <th class="px-4 py-3">休憩</th>
                  <th class="px-4 py-3">ステータス</th>
                  <th class="px-4 py-3">理由</th>
                  <th class="px-4 py-3 text-center">操作</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <tr v-for="correctionRequest in props.attendanceCorrectionRequests" :key="correctionRequest.id"
                  class="hover:bg-gray-50">
                  <td class="px-4 py-4">{{ correctionRequest.requestedAt }}</td>
                  <td class="px-4 py-4 font-medium text-gray-900">{{ correctionRequest.user_id }}</td>
                  <td class="px-4 py-4">{{ correctionRequest.requestedWorkDate }}</td>
                  <td class="px-4 py-4 text-blue-600">{{ correctionRequest.requestedClockInTime }}</td>
                  <td class="px-4 py-4 text-blue-600">{{ correctionRequest.requestedClockOutTime }}</td>
                  <td class="px-4 py-4">60分</td>

                  <!--承認フラグ-->
                  <td class="px-4 py-3">
                    <span v-if="correctionRequest.status === 'pending'"
                      class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700">
                      承認待ち
                    </span>

                    <span v-if="correctionRequest.status === 'approved'"
                      class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                      承認済み
                    </span>

                    <span v-if="correctionRequest.status === 'rejected'"
                      class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">
                      却下済み
                    </span>
                  </td>
                  <td class="px-4 py-4 text-gray-500">{{ correctionRequest.reason }}</td>
                  <td class="px-4 py-4 text-center">
                    <Link :href="route('admin.attendances.show', correctionRequest.id)"
                      class="font-bold text-blue-600 hover:text-blue-700">
                      詳細
                    </Link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-6 flex items-center justify-between text-sm text-gray-500">
            <div>件を表示 / 全 2 件</div>

            <div class="flex items-center gap-2">
              <button type="button" class="rounded-md border border-gray-300 px-3 py-2 text-gray-500 hover:bg-gray-50">
                前へ
              </button>

              <button type="button" class="rounded-md bg-blue-600 px-3 py-2 font-bold text-white">
                1
              </button>

              <button type="button" class="rounded-md border border-gray-300 px-3 py-2 text-gray-500 hover:bg-gray-50">
                次へ
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AttendanceLayout>
</template>
