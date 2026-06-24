<script setup>
import AttendanceLayout from "@/Layouts/AttendanceLayout.vue"
import { router, Link } from "@inertiajs/vue3"
import FlashMessage from '@/Components/FlashMessage.vue'

const props = defineProps({
  attendances: Array,
  attendanceStatuses: String,
})


const deleteAttendance = id => {
  router.delete(route('attendance.destroy', id)), {
    onBefore: () => confirm('本当に削除しますか？')
  }
}

const getCorrectionStatusClass = (status) => {
  if (status === null) {
    return 'bg-gray-100 text-gray-600'
  }

  if (status === 'pending') {
    return 'bg-yellow-100 text-yellow-700'
  }

  if (status === 'approved') {
    return 'bg-green-100 text-green-700'
  }

  if (status === 'rejected') {
    return 'bg-red-100 text-red-700'
  }

  return 'bg-gray-100 text-gray-600'
}

const getAttendanceStatusClass = (status) => {
  if (status === 'clockIn') {
    return 'bg-blue-100 text-blue-700'
  }

  if (status === 'breakIn') {
    return 'bg-yellow-100 text-yellow-700'
  }

  if (status === 'breakOut') {
    return 'bg-green-100 text-green-700'
  }

  if (status === 'clockOut') {
    return 'bg-gray-100 text-gray-700'
  }

  return 'bg-gray-100 text-gray-600'
}

</script>

<template>
  <FlashMessage />
  <AttendanceLayout>
    <div class="min-h-screen bg-gray-50 p-6 text-gray-800">
      <!-- Header -->
      <div class="mb-6 flex items-start justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">勤怠一覧</h1>
          <p class="mt-1 text-sm text-gray-500">勤怠記録の確認と管理</p>
        </div>

        <Link :href="route('attendances.create')"
          class="rounded-lg bg-green-500 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-green-600">
          出退勤登録へ
        </Link>
      </div>

      <!-- Search Filter -->
      <section class="mb-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="mb-5 text-lg font-bold text-gray-900">検索・フィルター</h2>

        <div class="grid gap-4 md:grid-cols-[1fr_1fr_1fr_auto_auto] md:items-end">
          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">年月</label>
            <input type="month" value="2026-06"
              class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" />
          </div>

          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">ステータス</label>
            <select
              class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
              <option>すべて</option>
              <option>通常</option>
              <option>遅刻</option>
              <option>休日</option>
              <option>有給</option>
            </select>
          </div>

          <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">曜日</label>
            <select
              class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
              <option>すべて</option>
              <option>月</option>
              <option>火</option>
              <option>水</option>
              <option>木</option>
              <option>金</option>
              <option>土</option>
              <option>日</option>
            </select>
          </div>

          <button type="button" class="rounded-md bg-blue-600 px-5 py-2 text-sm font-bold text-white hover:bg-blue-700">
            検索
          </button>

          <button type="button" class="rounded-md bg-gray-500 px-5 py-2 text-sm font-bold text-white hover:bg-gray-600">
            リセット
          </button>
        </div>
      </section>

      <!-- Summary Cards -->
      <section class="mb-5 grid gap-4 md:grid-cols-5">
        <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
          <p class="text-2xl font-bold text-blue-600">20</p>
          <p class="mt-1 text-sm text-gray-500">出勤日数</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
          <p class="text-2xl font-bold text-green-600">160:00</p>
          <p class="mt-1 text-sm text-gray-500">総勤務時間</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
          <p class="text-2xl font-bold text-orange-600">10:30</p>
          <p class="mt-1 text-sm text-gray-500">残業時間</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
          <p class="text-2xl font-bold text-red-600">2</p>
          <p class="mt-1 text-sm text-gray-500">遅刻回数</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-5 text-center shadow-sm">
          <p class="text-2xl font-bold text-purple-600">1</p>
          <p class="mt-1 text-sm text-gray-500">有給取得</p>
        </div>
      </section>

      <!-- Attendance Table -->
      <section class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex items-center justify-between">
          <h2 class="text-lg font-bold text-gray-900">勤怠記録</h2>
          <p class="text-sm text-gray-500"></p>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full min-w-[900px] border-collapse text-sm">
            <thead>
              <tr class="border-b border-gray-200 bg-gray-50 text-left text-xs font-bold text-gray-500">
                <th class="px-4 py-3">日付</th>
                <th class="px-4 py-3">曜日</th>
                <th class="px-4 py-3">出勤</th>
                <th class="px-4 py-3">退勤</th>
                <th class="px-4 py-3">休憩</th>
                <th class="px-4 py-3">勤務時間</th>
                <th class="px-4 py-3">残業</th>
                <th class="px-4 py-3">ステータス</th>
                <th class="px-4 py-3">申請状況</th>
                <th class="px-4 py-3 text-center">操作</th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
              <tr v-for="attendance in attendances" :key="attendance.id" class="hover:bg-gray-50">
                <td class="px-4 py-4">{{ attendance.workDate }}</td>
                <td class="px-4 py-4">金</td>
                <td class="px-4 py-4">{{ attendance.clockInTime }}</td>
                <td class="px-4 py-4">{{ attendance.clockOutTime }}</td>
                <td class="px-4 py-4">60</td>
                <td class="px-4 py-4 font-medium text-blue-600">8:00</td>
                <td class="px-4 py-4 text-orange-600">1:00</td>
                <td class="px-4 py-3 text-center">
                  <span class="inline-block rounded-lg px-3 py-1 text-xs font-bold"
                    :class="getAttendanceStatusClass(attendance.type)">
                    {{ attendance.typeLabel }}
                  </span>
                </td>
                <td class="px-4 py-3 text-center">
                  <span class="inline-block rounded-lg px-3 py-1 text-xs font-bold"
                    :class="getCorrectionStatusClass(attendance.correctionStatus)">
                    {{ attendance.correctionStatusLabel }}
                  </span>
                </td>
                <td class="px-4 py-4 text-center">
                  <button type="button" @click="router.get(route('attendances.edit', attendance.id))"
                    class="font-bold text-blue-500 hover:text-blue-600">
                    編集申請
                  </button>
                  <button @click="deleteAttendance(attendance.id)"
                    class="ml-3 font-bold text-red-500 hover:text-red-600">
                    削除申請
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex items-center justify-between">
          <p class="text-sm text-gray-500">件を表示 / 全 件</p>

          <div class="flex items-center gap-2">
            <button type="button" class="rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-400">
              前へ
            </button>

            <!-- ページ表記は、表示のみ。-->
            <div class="rounded-md bg-blue-600 px-3 py-2 text-sm font-bold text-white">
              1
            </div>


            <button type="button"
              class="rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
              次へ
            </button>
          </div>
        </div>
      </section>
    </div>
  </AttendanceLayout>
</template>
