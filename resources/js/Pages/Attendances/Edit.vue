<script setup>
import { router, Link } from "@inertiajs/vue3"
import { reactive } from 'vue'
import AttendanceLayout from '@/Layouts/AttendanceLayout.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

const props = defineProps({
  attendance: Object,
})

const form = reactive({
  attendance_id: props.attendance.id,
  requested_work_date: props.attendance.workDate,
  requested_clock_in: props.attendance.clockInTime,
  requested_break_in: props.attendance.breakInTime,
  requested_break_out: props.attendance.breakOutTime,
  requested_clock_out: props.attendance.clockOutTime,
  reason: ''
})

const submit = () => {

  if (!form.requested_work_date) {
    alert('申請する勤務日を入力してください')
    return
  }

  router.post(route('attendances.correction-requests.store'), form)
}

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

        <form @submit.prevent="submit">
          <div class="rounded-lg bg-white p-6 shadow">
            <div class="space-y-5">
              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  勤務日
                </label>
                <input type="date" v-model="form.requested_work_date"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
              </div>

              <div class="grid gap-4 md:grid-cols-2">
                <div>
                  <label class="mb-1 block text-sm font-bold text-gray-700">
                    出勤時間
                  </label>
                  <input type="time" v-model="form.requested_clock_in"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                  <label class="mb-1 block text-sm font-bold text-gray-700">
                    退勤時間
                  </label>
                  <input type="time" v-model="form.requested_clock_out"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                  <label class="mb-1 block text-sm font-bold text-gray-700">
                    休憩開始時間
                  </label>
                  <input type="time" v-model="form.requested_break_in"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                  <label class="mb-1 block text-sm font-bold text-gray-700">
                    休憩終了時間
                  </label>
                  <input type="time" v-model="form.requested_break_out"
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none">
                </div>
              </div>

              <div>
                <label class="mb-1 block text-sm font-bold text-gray-700">
                  申請理由
                </label>
                <textarea v-model="form.reason" rows="4" placeholder="修正理由を入力してください"
                  class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"></textarea>
              </div>

              <div class="flex justify-center gap-3 pt-4">
                <button type="submit"
                  class="rounded bg-blue-600 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700">
                  編集申請
                </button>

                <Link :href="route('attendances.index')"
                  class="rounded bg-gray-500 px-4 py-2 text-sm font-bold text-white hover:bg-gray-600">
                  戻る
                </Link>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </AttendanceLayout>
</template>
