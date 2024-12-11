<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        if(auth()->check()){

            $my_user = auth()->user();
            $branches = DB::table('branches')->orderBy('id')->get();
            $reports = DB::table('reports')->orderBy('id')->get();

            return view('main', [
                'my_user' => $my_user,
                'branches' => $branches,
                'reports' => $reports,
            ])
            ->with('header_title', 'Reports')
            ->with('subview', 'dashboard-contents.modules.reports');

        } else {
            return redirect('/');
        }
    }

    public function generate(Request $request)
    {

        // Get Request Data
        $validated = $request->validate([
            "type" => ['required'],
            "branch" => ['required']
        ]);

        $my_user = auth()->user();
        $branches = DB::table('branches')->orderBy('id')->get();
        $users = DB::table('users')->orderBy('id')->get();
        $name = '';
        $pdf = new PDF();

        foreach($branches as $branch){
            if($branch->id == $validated['branch']){
                $name = $branch->branch;
                break;
            }
        }

        if($validated["type"] == "daily"){

            // New Sales
            $new_sales = DB::table('members')->where('created_at', '<', date('Y-m-d'));

            // Collection
            $collection = DB::table('entries')->where('created_at', '<', date('Y-m-d'));

            $filename = 'daily_report_'. date('m_d_Y') .'.pdf';

            $pdf = Pdf::loadView('forms.daily_report', [
                'branches' => $branches,
                'users' => $users,
                'monthAndYear' => date('F Y'),
                'date' => date('m/d/Y'),
                'branch' => $name,
                'cashier' => $my_user->lname.' '.$my_user->fname,
            ])->setOptions(['defaultFont' => 'Courier']);

            $content = $pdf->download()->getOriginalContent();
            Storage::put('public/daily/'.$filename,$content);

        } else if($validated["type"] == "weekly"){

        } else if($validated["type"] == "monthly"){

        }

        return $pdf->download($filename);
    }

    public function store(Request $request){
    }

    public function update(Request $request){
        
    }

    public function destroy(Request $request){
        
    }
}
