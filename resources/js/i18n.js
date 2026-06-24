import { createI18n } from 'vue-i18n';

const messages = {
    ja: {
        login: 'ログイン',
        Name: '名前',
        email: 'メールアドレス',
        password: 'パスワード',
        remember: 'ログイン状態を保持する',
        forgot: 'パスワードをお忘れですか？',
        already: 'すでに登録済みですか？',
        Confirm: 'パスワードの再入力',
        Register: '登録',
        login_success: 'ログイン成功'
    },
    en: {
        login: 'Log in',
        Name: 'Name',
        email: 'Email',
        password: 'Password',
        remember: 'Remember me',
        forgot: 'Forgot your password?',
        already: 'Already registered?',
        Confirm: 'Confirm Password',
        Register: 'Register',
        login_success: "You're logged in!"
    }
};

export const i18n = createI18n({
    locale: 'ja', // デフォルト日本語
    fallbackLocale: 'en',
    messages,
});