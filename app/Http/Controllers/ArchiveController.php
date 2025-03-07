<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Helpers\Encrypt;
use App\Helpers\Mimetype;
use DataTables;
use DB;

class ArchiveController extends Controller
{
    public function getArchive(Request $request)
    {
        $encrypt = new Encrypt;

        if($request->ajax()) {				
			$model = Archive::orderBy('id', 'desc')->get();
		
            return Datatables::of($model)
			->editColumn('id', function ($model) use ($encrypt){
				return $encrypt->encrypt_decrypt($model->id, 'encrypt');
            })
            ->editColumn('file_name', function ($model) {
                $filePath = asset('archive/' . $model->file_name);
                return '<a href="' . $filePath . '" target="_blank">' . $model->file_name . '</a>';
            })
			
			->addIndexColumn()
			->addColumn('action', function($row){

			})
			->rawColumns(['action','file_name'])
			->make(true);
        }
    }

    public function addArchive()
    {
        $model = new Archive();

        return view('addArchive', compact('model'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'file' 	    => 'required',
            'remark'    => 'required|min:3'
        ]);

        $file = $request->file('file');
        $content = file_get_contents($file->getRealPath());
        $filename = $file->getClientOriginalName();

        if (!MimeType::whiteList($filename) || !MimeType::whiteListBytes($content, $filename)) {
            $errors = 'File tidak valid atau tidak diizinkan!';
            return response()->json([
                'error' => $errors,
            ], 415);
        }
		
		$kode = DB::table('archives')->max('id');
        $filename = str_replace(" ", "_", $kode."_".$file->getClientOriginalName());

        $data = array(
            'file_name' => $filename,
            'remark'    => $request->remark ??  null,
        );

        $file->move(public_path().'/archive/', $filename);

        Archive::create($data);
        return json_encode($data);
    }
}
