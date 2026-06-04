<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";
</script>

<template>
    <MailSendLayout>
        <h1 class="mb-6 text-3xl font-bold">メール作成</h1>

        <div class="rounded-lg bg-white p-6 shadow space-y-6">
            <button class="rounded bg-green-600 px-4 py-2 text-white">
                送信一覧取得
            </button>

            <div>
                <label class="mb-2 block font-medium"> 宛先 </label>

                <textarea
                    rows="5"
                    class="w-full rounded border p-3"
                    placeholder="取得したメールアドレス一覧"
                />
            </div>

            <div>
                <label class="mb-2 block font-medium"> 件名 </label>

                <input type="text" class="w-full rounded border p-3" />
            </div>

            <div>
                <label class="mb-2 block font-medium"> 本文 </label>

                <textarea rows="10" class="w-full rounded border p-3" />
            </div>

            <button class="rounded bg-blue-600 px-6 py-3 text-white">
                メール確認
            </button>

            <button class="rounded bg-pink-300 ml-4 px-6 py-3 text-white">
                戻る
            </button>
            
        </div>
    </MailSendLayout>
</template>
