<script setup>
import AttendanceLayout from "@/Layouts/AttendanceLayout.vue"
import { router, Link } from "@inertiajs/vue3"
import { reactive } from "vue"

const props = defineProps({
  attendanceCorrectionRequest: Object,
  attendance: Object,
})

const form = reactive({
  admin_comment: '',
})

const approve = () => {
  router.patch(route('admin.attendances.approve', props.attendanceCorrectionRequest.id), form)
}

const reject = () => {
  router.patch(route('admin.attendances.reject', props.attendanceCorrectionRequest.id), form)
}

</script>

<template>
  <AttendanceLayout>
    <div class="min-h-screen bg-gray-50 p-6 text-gray-800">
      <div class="mx-auto max-w-5xl">
        <div class="mb-6 flex items-start justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">勤怠承認</h1>
            <p class="mt-1 text-sm text-gray-500">
              勤怠修正申請の内容を確認し、承認または却下を行います。
            </p>
          </div>

          <Link :href="route('admin.attendances.index')"
            class="rounded-lg bg-gray-600 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-gray-700">
            一覧へ戻る
          </Link>
        </div>

        <div class="mb-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <div class="flex items-center justify-between">
            <div>
              <h2 class="text-base font-bold text-gray-900">申請情報</h2>
              <p class="mt-1 text-sm text-gray-500">申請者と申請状況</p>
            </div>

            <span class="rounded-full bg-yellow-100 px-4 py-2 text-sm font-bold text-yellow-700">
              {{ props.attendanceCorrectionRequest.status }}
            </span>
          </div>

          <div class="mt-6 grid gap-4 md:grid-cols-3">
            <div class="rounded-lg bg-gray-50 p-4">
              <div class="text-xs font-bold text-gray-500">申請者</div>
              <div class="mt-2 text-base font-bold text-gray-900">{{ props.attendanceCorrectionRequest.user_id }}</div>
            </div>

            <div class="rounded-lg bg-gray-50 p-4">
              <div class="text-xs font-bold text-gray-500">申請日時</div>
              <div class="mt-2 text-base font-bold text-gray-900">{{ props.attendanceCorrectionRequest.requestedAt }}
              </div>
            </div>

            <div class="rounded-lg bg-gray-50 p-4">
              <div class="text-xs font-bold text-gray-500">対象勤務日</div>
              <div class="mt-2 text-base font-bold text-gray-900">{{ props.attendanceCorrectionRequest.requestedWorkDate
                }}</div>
            </div>
          </div>
        </div>

        <div class="mb-5 grid gap-5 md:grid-cols-2">
          <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-base font-bold text-gray-900">現在の勤怠情報</h2>

            <div class="space-y-4">
              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">勤務日</span>
                <span class="text-sm font-bold text-gray-900">{{ props.attendance.workDate }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">出勤時間</span>
                <span class="text-sm font-bold text-gray-900">{{ props.attendance.clockInTime }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">休憩開始</span>
                <span class="text-sm font-bold text-gray-900">{{ props.attendance.breakInTime }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">休憩終了</span>
                <span class="text-sm font-bold text-gray-900">{{ props.attendance.breakOutTime }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">退勤時間</span>
                <span class="text-sm font-bold text-gray-900">{{ props.attendance.clockOutTime }}</span>
              </div>

              <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-gray-500">ステータス</span>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700">
                  {{ props.attendance.type }}
                </span>
              </div>
            </div>
          </div>

          <div class="rounded-xl border border-blue-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-base font-bold text-gray-900">申請された修正内容</h2>

            <div class="space-y-4">
              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">勤務日</span>
                <span class="text-sm font-bold text-blue-600">{{ props.attendanceCorrectionRequest.requestedWorkDate
                  }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">出勤時間</span>
                <span class="text-sm font-bold text-blue-600">{{ props.attendanceCorrectionRequest.requestedClockInTime
                  }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">休憩開始</span>
                <span class="text-sm font-bold text-blue-600">{{ props.attendanceCorrectionRequest.requestedBreakInTime
                  }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">休憩終了</span>
                <span class="text-sm font-bold text-blue-600">{{ props.attendanceCorrectionRequest.requestedBreakOutTime
                  }}</span>
              </div>

              <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <span class="text-sm font-bold text-gray-500">退勤時間</span>
                <span class="text-sm font-bold text-blue-600">{{ props.attendanceCorrectionRequest.requestedClockOutTime
                  }}</span>
              </div>

              <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-gray-500">申請状況</span>
                <span v-if="props.attendanceCorrectionRequest.status === 'pending'"
                  class="rounded-full bg-yellow-100 px-4 py-2 text-sm font-bold text-yellow-700">
                  承認待ち
                </span>

                <span v-if="props.attendanceCorrectionRequest.status === 'approved'"
                  class="rounded-full bg-green-100 px-4 py-2 text-sm font-bold text-green-700">
                  承認済み
                </span>

                <span v-if="props.attendanceCorrectionRequest.status === 'rejected'"
                  class="rounded-full bg-red-100 px-4 py-2 text-sm font-bold text-red-700">
                  却下済み
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <h2 class="mb-4 text-base font-bold text-gray-900">申請理由</h2>

          <div class="rounded-lg bg-gray-50 p-4 text-sm leading-7 text-gray-700">
            {{ props.attendanceCorrectionRequest.reason }}
          </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
          <h2 class="mb-5 text-base font-bold text-gray-900">承認操作</h2>

          <div class="mb-5">
            <label class="mb-2 block text-sm font-bold text-gray-700">
              管理者コメント
            </label>
            <textarea v-model="form.admin_comment" rows="4" placeholder="承認・却下理由やメモを入力してください"
              class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none"></textarea>
          </div>

          <div class="flex justify-center gap-4">
            <button type="button" @click="approve"
              class="rounded-lg bg-green-600 px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-green-700">
              承認する
            </button>

            <button type="button" @click="reject"
              class="rounded-lg bg-red-600 px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-red-700">
              却下する
            </button>

            <button type="button"
              class="rounded-lg bg-gray-500 px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-gray-600">
              戻る
            </button>
          </div>
        </div>
      </div>
    </div>
  </AttendanceLayout>
</template>
