<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function showUploadForm()
    {
        return view('upload'); // Create this view for uploading files
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|mimes:docx']);

        // Store the uploaded file
        $file = $request->file('file');
        $filePath = $file->store('documents');

        return redirect()->route('doc.edit', ['filename' => basename($filePath)]);
    }

    public function edit($filename)
    {
        $fileUrl = 'http://127.0.0.1:8000/edit/YN1cP1Yx6IPfOnUf92ubYdR9xKAVwzHdEwUKYdeC.docx';
        // var_dump($fileUrl);
        $onlyofficeUrl = "http://127.0.0.1:8000/onlyoffice/api/office/document"; // Update with your server URL

        return view('edit', [
            'fileUrl' => $fileUrl,
            'onlyofficeUrl' => $onlyofficeUrl,
            'filename' => $filename,
        ]);
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        // Handle saving the document after editing
        $filePath = storage_path("app/documents/{$data['document']['title']}");
        file_put_contents($filePath, base64_decode($data['document']['data']));

        return response()->json(['status' => 'success']);
    }
}