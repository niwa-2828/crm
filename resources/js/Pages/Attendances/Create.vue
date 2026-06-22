<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import AttendanceLayout from '@/Layouts/AttendanceLayout.vue'
import axios from 'axios'

const message = ref('')

const currentTime = ref('--:--:--')
const currentDate = ref('----')

const props = defineProps({
  attendanceInfo: Object,
  attendanceStatuses: String,
})

const clockInTime = ref(
  props.attendanceInfo?.clockInTime ? props.attendanceInfo.clockInTime : '--:--'
)

const breakInTime = ref(
  props.attendanceInfo?.breakInTime ? props.attendanceInfo.breakInTime : '--:--'
)

const breakOutTime = ref(
  props.attendanceInfo?.breakOutTime ? props.attendanceInfo.breakOutTime : '--:--'
)

const clockOutTime = ref(
  props.attendanceInfo?.clockOutTime ? props.attendanceInfo.clockOutTime : '--:--'
)

const workTime = ref(
  props.attendanceInfo?.workTime ? props.attendanceInfo.workTime : '--:--'
)

const statusLabel = ref(
  props.attendanceStatuses ? props.attendanceStatuses : '未出勤'
)

let timerId = null

function updateCurrentTime() {
  const now = new Date()

  currentTime.value = now.toLocaleTimeString('ja-JP', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
  })

  currentDate.value = now.toLocaleDateString('ja-JP', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    weekday: 'short',
  })
}

// このページについたとき、最初に実行する関数
onMounted(() => {
  updateCurrentTime()

  timerId = setInterval(updateCurrentTime, 1000)
})

// このページを離れるとき、最後に実行する関数
onUnmounted(() => {
  clearInterval(timerId)
})

async function store(type) {

  const nowTime = new Date().toLocaleString('ja-JP')

  const response = await axios.post(route('attendances.store'), {
    type: type,
    nowTime: nowTime,
  })

  if (response.data.time === null) {
    message.value = response.data.message
    return
  }

  if (type === 'clockIn') {
    clockInTime.value = response.data.time
  }

  if (type === 'breakIn') {
    breakInTime.value = response.data.time
  }

  if (type === 'breakOut') {
    breakOutTime.value = response.data.time

  }

  if (type === 'clockOut') {
    clockOutTime.value = response.data.time
  }

  if (response.data.workTime) {
    workTime.value = response.data.workTime
  }

  if (response.data.statusLabel) {
    statusLabel.value = response.data.statusLabel
  }
}


</script>

<template>
  <AttendanceLayout>
    <div class="min-h-screen bg-slate-50 p-6 text-slate-900">
      <h1 class="text-2xl font-bold">出退勤登録</h1>
      <p class="mt-2 text-sm text-slate-600">
        出勤・退勤の打刻を行います
      </p>

      <section class="mt-6 rounded-xl border border-slate-200 bg-white p-8 text-center shadow-sm">
        <p class="text-sm text-slate-500">現在時刻</p>

        <p class="mt-2 text-5xl font-bold tracking-wide">
          {{ currentTime }}
        </p>

        <p class="mt-2 text-base text-slate-700">
          {{ currentDate }}
        </p>
      </section>

      <!-- フラッシュメッセージ -->
      <p v-if="message" class="mt-4 rounded bg-red-100 px-4 py-3 text-center text-sm font-bold text-red-700">
        {{ message }}
      </p>

      <section class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">今日の勤怠状況</h2>

        <div class="mt-5 grid grid-cols-4 gap-4">
          <div class="rounded-lg bg-green-50 p-4 text-center text-green-600">
            <p class="text-sm font-bold">出勤時刻</p>
            <p class="mt-2 text-xl font-bold">{{ clockInTime }}</p>
          </div>

          <div class="rounded-lg bg-red-50 p-4 text-center text-red-600">
            <p class="text-sm font-bold">退勤時刻</p>
            <p class="mt-2 text-xl font-bold">{{ clockOutTime }}</p>
          </div>

          <div class="rounded-lg bg-blue-50 p-4 text-center text-blue-600">
            <p class="text-sm font-bold">勤務時間</p>
            <p class="mt-2 text-xl font-bold">--:--</p>
          </div>

          <div class="rounded-lg bg-purple-50 p-4 text-center text-purple-600">
            <p class="text-sm font-bold">ステータス</p>
            <p class="mt-2 text-xl font-bold">{{ statusLabel }}</p>
          </div>
        </div>

        <div class="mt-6 flex justify-center gap-4">
          <button @click="store('clockIn')" type="button"
            class="rounded-lg bg-green-600 px-7 py-4 font-bold text-white">
            出勤する
          </button>

          <button @click="store('clockOut')" type="button"
            class="rounded-lg bg-slate-400 px-7 py-4 font-bold text-white">
            退勤する
          </button>
        </div>
      </section>

      <section class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">休憩時間</h2>

        <div class="mt-5 grid grid-cols-2 gap-4">
          <div class="rounded-lg bg-yellow-50 p-4 text-center text-orange-500">
            <p class="text-sm font-bold">休憩開始</p>
            <p class="mt-2 text-xl font-bold">{{ breakInTime }}</p>
          </div>

          <div class="rounded-lg bg-yellow-50 p-4 text-center text-orange-500">
            <p class="text-sm font-bold">休憩終了</p>
            <p class="mt-2 text-xl font-bold">{{ breakOutTime }}</p>
          </div>
        </div>

        <div class="mt-4 flex justify-center gap-4">
          <button @click="store('breakIn')" type="button"
            class="rounded-lg bg-slate-400 px-6 py-3 font-bold text-white">
            休憩開始
          </button>

          <button @click="store('breakOut')" type="button"
            class="rounded-lg bg-slate-400 px-6 py-3 font-bold text-white">
            休憩終了
          </button>
        </div>
      </section>
    </div>
  </AttendanceLayout>
</template>
