<?php

namespace App\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadMessageRequest;
use App\Jobs\SendMailMessageLeadsJob;
use App\Mail\MessageLeadMail;
use App\Models\Distribution;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function index(): View
    {
        $leads = Lead::query()->paginate();

        return view('admin.leads.index', compact('leads'));
    }
}
