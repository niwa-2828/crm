<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Mail\CompanyMail;
use App\Http\Requests\ConfirmMailSendRequest;
use Illuminate\Support\Facades\Mail;

use Inertia\Inertia;

use Illuminate\Http\Request;

class MailSendController extends Controller
{
  public function index()
  {
    return Inertia::render('MailSend/Index');
  }


  public function create()
  {
    return Inertia::render('MailSend/Create');
  }


  public function confirm(ConfirmMailSendRequest $request)
  {
    $subject = $request->subject;
    $body = $request->body;

    return Inertia::render('MailSend/Confirm', [
      'subject' => $subject,
      'body' => $body,
    ]);
  }

  public function send(ConfirmMailSendRequest $request)
  {
    $subject = $request->subject;
    $body = $request->body;

    $companies = Company::where('mail', 'yt.starry.night@gmail.com')
      ->select('mail')
      ->get();

    foreach ($companies as $company) {
      // デバッグ用 storage-logs-laravel.logを見てね
      \Log::info('メール送信テスト', [
            'to' => $company->mail,
            'subject' => $subject,
            'body' => $body,
        ]);
      Mail::to($company->mail)->send(new CompanyMail($subject, $body));
    }

    return to_route('mailsend.create');
  }
}
