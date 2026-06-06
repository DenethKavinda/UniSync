<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryManagementController extends Controller
{
    public function viewInquiryManagementPage()
    {
        return view('admin.inquiryManagement');
    }
}
