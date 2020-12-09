<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RecordBundle;
use App\RecordDocument;
use Session;
use Redirect;

class RecordController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword');
        $data['keyword'] = $keyword;
        $data['bundles'] = RecordBundle::all();

        if (isset($keyword)){
            $bundles = RecordBundle::where('serial_no','like','%'.$keyword.'%')->orWhere('name','like','%'.$keyword.'%')->get();
            $data['bundles'] = $bundles;
            $documents = RecordDocument::where('number','like','%'.$keyword.'%')->orWhere('name','like','%'.$keyword.'%')->with('bundle')->get();
            $data['documents'] = $documents;
            //dd($documents);
        }
        
        return view('cms.record.records')->with($data);
    }

    public function newBundle(){
        return view('cms.record.new_bundle');
    }

    public function addBundle(Request $request){
        
        $request->validate([
            'serial_no'=>'required',
            'name'=>'required|unique:record_bundles',
            'number'=>'required|unique:record_bundles',
        ]);
        
        $bundle = New RecordBundle;
        $bundle->serial_no = $request->input('serial_no');
        $bundle->name = $request->input('name');
        $bundle->number = $request->input('number');
        $bundle->year = $request->input('year');
        $bundle->color = $request->input('color');
        $bundle->branch = $request->input('branch');
        $bundle->note = $request->input('note');
        $bundle->save();
        Session::flash('success', 'Bundle added');
        return Redirect::back();
    }

    public function updateBundle(Request $request){
        $request->validate([
            'id'=>'required',
            'bundle_id'=>'required',
            'name'=>'required',
            'number'=>'required'
        ]);

        $bundle = RecordBundle::find($request->input('id'));
        $bundle->serial_no = $request->input('bundle_id');
        $bundle->name = $request->input('name');
        $bundle->number = $request->input('number');
        $bundle->year = $request->input('year');
        $bundle->color = $request->input('color');
        $bundle->branch = $request->input('branch');
        $bundle->note = $request->input('note');
        $bundle->save();
        
        Session::flash('success', 'Bundle updated');
        return Redirect::back();
    }

    public function addDocument(Request $request){
        $request->validate([
            'id' => 'required',
            'bundle_id' => 'required',
            'number'=>'required|unique:record_documents',
        ]);
        
        $bundle = RecordBundle::find($request->input('id'));

        $document = New RecordDocument;
        
        $document->bundle_id = $request->input('id');
        $document->name = $request->input('name');
        $document->number = $request->input('number');
        $document->year = $request->input('year');
        $document->color = $request->input('color');
        $document->decription = $request->input('decription');
        $bundle->document = $document;

        $bundle->document->save();

        Session::flash('success', 'Document added');
        return Redirect::back();
    }

    public function bundle($serial_no){
        $bundle = RecordBundle::find($serial_no);
        $data['bundle'] = $bundle;
        return view('cms.record.record')->with($data);
    }

}
