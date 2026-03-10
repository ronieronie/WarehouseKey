<?php

namespace App\Http\Controllers;
use App\Models\Borrower;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getBorrowers()
    {
        $data = Borrower::select('name', 'date_borrowed', 'time_borrowed', 'time_return', 'id')->get();
        return DataTables::of($data)
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('date_borrowed', function ($row) {
                return $row->date_borrowed;
            })
            ->addColumn('time_borrowed', function ($row) {
                return date('h:i A', strtotime($row->time_borrowed));
            })
            ->addColumn('time_return', function ($row) {
                // 
                if($row->time_return==null){
                    return "Pending";
                }
                return date('h:i A', strtotime($row->time_return));
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-primary btn_update" id="" 
                                data-id="' . $row->id . '" 
                                data-name="' . $row->name . '"  
                                data-date="' . $row->date_borrowed . '"  
                                data-time_borrowed="' . date('h:i A', strtotime($row->time_borrowed)) . '"   
                                data-time_return="' . $row->time_return . '" 
                 data-role="' . $row->role_id . '" 
                >Update</button>
            <button type="button" class="btn btn-danger btn_delete" id="" data-id="' . $row->id . '">Delete</button>
            ';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function add_borrower(Request $request)
    {
        $name = $request->name;
        $date_borrowed = $request->date_borrowed;
        $time_borrowed = Carbon::parse($request->time_borrowed)->format('H:i:s');
        $time_return = $request->time_return === 'Pending' ? null :
            Carbon::createFromFormat('h:i A', $request->time_return)->format('H:i:s');

        $pending = Borrower::whereNull('time_return')->exists(); // 
        if ($pending) {
            return response()->json([
                'success' => false,
                'message' => 'The key is still borrowed.'
            ], 400);
        } else {
            Borrower::create([
                'name' => $name,
                'date_borrowed' => $date_borrowed,
                'time_borrowed' => $time_borrowed,
                'time_return' => $time_return // stores null when Pending
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function update_borrower(Request $request)
    {
        $id = $request->id;
        Borrower::where('id', $id)->update([
            'name' => $request->name,
            'date_borrowed' => $request->date_borrowed,
            'time_borrowed' => Carbon::parse($request->time_borrowed)->format('H:i:s'),
            'time_return' => Carbon::parse($request->time_return)->format('H:i:s')
        ]);
        return response()->json(['success' => true]);
    }

    public function delete_borrower(Request $request)
    {
        $id = $request->delete_id;
        Borrower::where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
