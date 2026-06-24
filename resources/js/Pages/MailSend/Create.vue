<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref } from 'vue'

const subject = ref("");
const body = ref("");

const confirm = () => {
  // confirm : 送信確認ページへ、以下2つのデータをpost送信
  router.post(route("mailsend.confirm"), {
    subject: subject.value,
    body: body.value,
  });
};

</script>

<template>
  <MailSendLayout>
    <h1 class="mb-6 text-3xl font-bold">メール作成</h1>

    <form @submit.prevent="confirm">
      <div class="rounded-lg bg-white p-6 shadow space-y-6">
        <div>
          <label class="mb-2 block font-medium"> 件名 </label>

          <!--vue側の未入力エラー表示-->
          <input v-model="subject" type="text" required class="w-full rounded border p-3"
            oninvalid="this.setCustomValidity('件名を入力してください。')" oninput="this.setCustomValidity('')" />
        </div>

        <div>
          <label class="mb-2 block font-medium"> 本文 </label>

          <!--vue側の未入力エラー表示-->
          <textarea v-model="body" rows="10" required class="w-full rounded border p-3"
            oninvalid="this.setCustomValidity('本文を入力してください。')" oninput="this.setCustomValidity('')">
          </textarea>
        </div>

        <button type="submit" class="rounded bg-blue-600 px-6 py-3 text-white">
          メール確認
        </button>

        <Link :href="route('mailsend.index')" class="rounded bg-pink-300 ml-4 px-6 py-3 text-white">
          戻る
        </Link>

      </div>
    </form>
  </MailSendLayout>
</template>
