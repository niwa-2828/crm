<!--POST通信専用！画面更新はエラーになります-->

<script setup>
import { router , Link } from "@inertiajs/vue3";
import MailSendLayout from "@/Layouts/MailSendLayout.vue";

const props = defineProps({
  subject: String,
  body: String,
});

const send = () => {
  router.post(route("mailsend.send"), {
    subject: props.subject,
    body: props.body,
  });
};

</script>

<template>
  <MailSendLayout>
    <h1 class="mb-6 text-3xl font-bold">メール確認</h1>

    <div class="space-y-6 rounded-lg bg-white p-6 shadow">
      <div>
        <label class="mb-2 block font-medium">件名</label>

        <div class="w-full rounded border bg-gray-50 p-3">
          {{ subject }}
        </div>
      </div>

      <div>
        <label class="mb-2 block font-medium">本文</label>

        <div class="min-h-[240px] w-full whitespace-pre-line rounded border bg-gray-50 p-3">
          {{ body }}
        </div>
      </div>

      <div>
        <button @click="send" type="button" class="rounded bg-blue-600 px-6 py-3 text-white" >
          送信
        </button>

        <Link :href="route('mailsend.create')" class="ml-4 rounded bg-pink-300 px-6 py-3 text-white" >
          戻る
        </Link>
      </div>
    </div>
  </MailSendLayout>
</template>
