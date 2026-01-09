<?php

namespace App\Http\Controllers\V2;

use App\Faq;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::query();

        $query = request()->input('query');
        if ($query) {
            $faqs->where('pertanyaan', 'like', "%{$query}%")
                ->orWhere('jawaban', 'like', "%{$query}%");
        }
        $faqs = $faqs->get();

        return view('v2.faq', compact('faqs'));
    }
}
