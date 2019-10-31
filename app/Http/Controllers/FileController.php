<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function uploadXml(Request $request)
    {
        if ($request->file('fileXml')->isValid()) {
            Storage::delete(Storage::files('XmlFiles'));
            $request->file('fileXml')->store('XmlFiles');
            $uploadResponse = '<span style="color:green">File have been successfully Uploaded!</span>';
            $file = true;
        } else {
            $uploadResponse = '<span style="color:red">File have not been Uploaded :(</span>';
            $file = null;
        }
        return view('index', compact('uploadResponse', 'file'));
    }

    public function showOutputFiles()
    {
        $directory = 'outputCsv';
        $files = Storage::files($directory);
        return view('files', compact('files'));
    }
}
