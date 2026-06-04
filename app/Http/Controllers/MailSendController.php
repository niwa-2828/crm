<?php

namespace App\Http\Controllers;

use App\Models\MailSend;
use Inertia\Inertia;

use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function index()
    {
        return Inertia::render('MailSend/Dashboard');
    }
    
    public function create()
    {
        return Inertia::render('MailSend/Send');
    }
}
