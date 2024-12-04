<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class WordExportController extends Controller
{
    public function export()
    {
        // Define the file name and directory
        $fileName = 'sample_document.docx'; // Fixed file name
        $publicDirectoryName = 'Downloads'; // Directory name to save in public
        $storageDirectoryName = 'documents'; // Directory name to save in storage
        $publicFilePath = public_path($publicDirectoryName . '/' . $fileName); // Public path
        $storageFilePath = storage_path($storageDirectoryName . '/' . $fileName); // Storage path
    
        // Ensure the directories exist
        if (!file_exists(public_path($publicDirectoryName))) {
            mkdir(public_path($publicDirectoryName), 0755, true); // Create public directory if it doesn't exist
        }
    
        if (!file_exists(storage_path($storageDirectoryName))) {
            mkdir(storage_path($storageDirectoryName), 0755, true); // Create storage directory if it doesn't exist
        }
    
        // Create a new instance of PhpWord
        $phpWord = new PhpWord();
    
        // Check if the file already exists in either location
        if (!file_exists($publicFilePath) && !file_exists($storageFilePath)) {
            // Adding a new section to the document
            $section = $phpWord->addSection();
            
            // Adding a title
            $section->addTitle('Document Title', 1);
            
            // Adding some text
            $section->addText('This is a sample Word document created using PhpWord in Laravel.');
    
            // Adding a table
            $table = $section->addTable();
            $table->addRow();
            $table->addCell(2000)->addText('Header 1');
            $table->addCell(2000)->addText('Header 2');
    
            // Adding data to the table
            for ($i = 1; $i <= 5; $i++) {
                $table->addRow();
                $table->addCell(2000)->addText('Row ' . $i . ' Col 1');
                $table->addCell(2000)->addText('Row ' . $i . ' Col 2');
            }
    
            // Save the document to both locations
            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($publicFilePath); // Save to public/Downloads
            $objWriter->save($storageFilePath); // Save to storage/documents
            
            Log::info('Document saved at: ' . $publicFilePath);
            Log::info('Document also saved at: ' . $storageFilePath);
        } else {
            Log::info('Document already exists at public: ' . $publicFilePath);
            Log::info('Document already exists at storage: ' . $storageFilePath);
        }
    
        // Prepare the URL for the download
        $downloadUrl = url($publicDirectoryName . '/' . $fileName);
    
        // Sending the file as a download
        return response()->download($publicFilePath)->deleteFileAfterSend(false);
    }
}