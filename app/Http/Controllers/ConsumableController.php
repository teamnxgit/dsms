<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consumable;
use App\ConsumableTransaction;
use App\Branch;
use Session;
use Redirect;

class ConsumableController extends Controller
{
    public function index(){
        $consumables = Consumable::all();

        $low_count=0;
        $reorder_count=0;
        $sufficient_count=0;
        $excessive_count=0;

        foreach ($consumables as $consumable) {
            if ($consumable->balance <= $consumable->minimum_level) {
                $low_count++;
            }
            elseif ($consumable->balance <= $consumable->reorder_level) {
                $reorder_count++;
            }
            elseif ($consumable->balance <= $consumable->maximum_level) {
                $sufficient_count++;
            }
            else {
                $excessive_count++;
            }
        }

        $data['low_count']=$low_count;
        $data['reorder_count']=$reorder_count;
        $data['sufficient_count'] = $sufficient_count;
        $data['excessive_count'] = $excessive_count;
        return view('cms.consumable.dashboard')->with($data);
    }

    public function consumables(){

        $consumables = Consumable::all();

        $low_count=0;
        $reorder_count=0;

        foreach ($consumables as $consumable) {
            if ($consumable->balance <= $consumable->minimum_level) {
                $low_count++;
            }
            elseif ($consumable->balance <= $consumable->reorder_level) {
                $reorder_count++;
            }
        }

        $data['low_count']=$low_count;
        $data['reorder_count']=$reorder_count;
        $data['consumables'] = $consumables;

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
        $consumable->page_no= $request->input('page_no');
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
            'page_no'=>'required',
            'maximum_level'=>'required',
            'reorder_level'=>'required',
            'minimum_level'=>'required',
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
        $consumable->transactions()->create([
            'consumable_id'=>$request->input('consumable_id'),
            'type'=>'receive',
            'date'=>$request->input('date'),
            'from_or_to'=>$request->input('from'),
            'ref_no'=>$request->input('bill_no'),
            'qty'=>$request->input('qty'),
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
        $consumable->transactions()->create([
            'consumable_id'=>$request->input('consumable_id'),
            'type'=>'issue',
            'date'=>$request->input('date'),
            'from_or_to'=>$request->input('to'),
            'ref_no'=>$request->input('req_no'),
            'qty'=>$request->input('qty'),
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
        $transactions=$consumable->transactions()->orderBy('date')->orderBy('created_at')->get();
        $data['transactions']=$transactions;
        return view('cms.consumable.consumable')->with($data);
    }

    public function remTransaction(Request $request){
        $request->validate([
            'id'=>'required'
        ]);
        $transactions = ConsumableTransaction::findOrFail($request->input('id'));
        $transactions->delete();

        Session::flash('success','Transaction removed');
        return Redirect::back();
    }
}
