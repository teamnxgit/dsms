<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consumable;
use App\ConsumableReceive;
use App\ConsumableIssue;
use App\Branch;
use Session;
use Redirect;

class ConsumableController extends Controller
{
    public function index(){
        return view('cms.consumable.dashboard');
    }

    public function consumables(){
        $data['consumables'] = Consumable::all();
        $data['low_consumables_count']=0;
        $data['reorder_consumables']=0;
        $data['branches']=Branch::all();
        return view('cms.consumable.consumables')->with($data);
    }

    public function add(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'maximum_level'=>'required',
            'reorder_level'=>'required',
            'minimum_level'=>'required'
        ]);
        $consumable = New Consumable;
        $consumable->name = $request->input('name');
        $consumable->description= $request->input('description');
        $consumable->icon = $request->input('icon');
        $consumable->maximum_level = $request->input('maximum_level');
        $consumable->reorder_level = $request->input('reorder_level');
        $consumable->minimum_level = $request->input('minimum_level');
        $consumable->balance = 0;

        $consumable->save();

        Session::flash('success','Consumable Item Created');

        return Redirect::back();
    }

    public function editstock(Request $request){
        $request->validate([
            'id'=>'required',
            'balance'=>'required',
        ]);

        $consumable = Consumable::findOrFail($request->input('id'));

        $consumable->balance = $request->input('balance');
        $consumable->page_no = $request->input('page_no');
        $consumable->save();

        Session::flash('success','Consumable inventory updated');

        return Redirect::back();
    }

    public function rem(Request $request){
        $request->validate([
            'id'=>'required',
        ]);
        $consumable = Consumable::findOrFail($request->input('id'));
        $consumable->delete();

        Session::flash('success','Consumable item removed');

        return Redirect::back();
    }

    public function receive(Request $request){
        $request->validate([
            'consumable_id'=>'required',
            'date'=>'required',
            'from'=>'required',
            'bill_no'=>'required',
            'qty'=>'required',
        ]);

        $consumable = Consumable::findOrFail($request->input('consumable_id'));
        $balance = $consumable->balance + $request->input('qty');
        $consumable->receives()->create([
            'consumable_id'=>$request->input('consumable_id'),
            'date'=>$request->input('date'),
            'from'=>$request->input('from'),
            'bill_no'=>$request->input('bill_no'),
            'qty_received'=>$request->input('qty'),
            'balance'=> $balance
        ]);
        $consumable->balance = $balance;
        $consumable->save();
        Session::flash('success','Consumable item received');
        return Redirect::back();
    }

    public function issue(Request $request){
        
        $request->validate([
            'consumable_id'=>'required',
            'date'=>'required',
            'to'=>'required',
            'req_no'=>'required',
            'qty'=>'required',
        ]);

        $consumable = Consumable::findOrFail($request->input('consumable_id'));
        $balance = $consumable->balance - $request->input('qty');
        $consumable->issues()->create([
            'consumable_id'=>$request->input('consumable_id'),
            'date'=>$request->input('date'),
            'to'=>$request->input('to'),
            'req_no'=>$request->input('req_no'),
            'qty_issued'=>$request->input('qty'),
            'balance'=>$balance
        ]);
        $consumable->balance = $balance;
        $consumable->save();
        Session::flash('success','Consumable item issued');
        return Redirect::back();
    }

    public function item($id){
        $consumable = Consumable::findOrFail($id);
        $data['consumable'] = $consumable;

        $consumable_receives = $consumable->receives()->orderBy('date')->orderBy('created_at')->get();
        $consumable_issues = $consumable->issues()->orderBy('date')->orderBy('created_at')->get();

        $transactions=[];

        foreach ($consumable_receives as $receives) {
            array_push($transactions,$receives);
        }

        foreach($consumable_issues as $issues) {
            array_push($transactions,$issues);
        }

        ksort($transactions);

        $data['transactions']=$transactions;

        return view('cms.consumable.consumable')->with($data);
    }
}
