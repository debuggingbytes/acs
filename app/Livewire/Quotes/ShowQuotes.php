<?php

namespace App\Livewire\Quotes;

use App\Models\System\Quote;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShowQuotes extends Component
{
    use WithPagination;
    // public $quotes;

    public function streamPdf($quoteId)
    {
        $quote = Quote::findOrFail($quoteId);

        if (! $quote->pdf_path) {
            abort(404, 'PDF not found.'); // Or handle the error as you see fit
        }

        $path = Storage::disk('public')->path($quote->pdf_path); // Get full path

        if (! file_exists($path)) {
            abort(404, 'PDF file not found on disk.');
        }


        // Stream the PDF
        $response = new StreamedResponse(function () use ($path) {
            readfile($path); // Output the file content
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.basename($path).'"', // Display in browser
            // 'Content-Disposition' => 'attachment; filename="' . basename($path) . '"', // Download instead
        ]);

        return $response;
    }
    public function deleteQuote($quoteId)
    {
        try {
            DB::beginTransaction();

            $quote = Quote::findOrFail($quoteId);

            // Check if PDF path exists
            if ($quote->pdf_path) {
                // Get the folder path (everything before the last slash)
                $folderPath = Str::beforeLast($quote->pdf_path, '/');

                // First try to delete the folder and all its contents
                if (! Storage::disk('public')->deleteDirectory($folderPath)) {
                    throw new \Exception('Failed to delete quote files.');
                }
            }

            // If we got here, the file deletion was successful, so delete the database record
            $quote->delete();

            DB::commit();

            session()->flash('status', [
                'type' => 'success',
                'message' => 'Quote deleted successfully.',
                'title' => 'Success'
            ]);

            $this->dispatch('quote-deleted');
            $this->dispatch('refresh-status');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('status', [
                'type' => 'error',
                'message' => 'Failed to delete quote. '.$e->getMessage(),
                'title' => 'Error'
            ]);

            $this->dispatch('refresh-status');
        }
    }
    public function loadQuotes()
    {
        // $this->quotes = Quote::all();
    }
    public function mount()
    {
        // $this->loadQuotes();
    }
    #[Layout('dashboard.app')]
    public function render()
    {
        return view('livewire.quotes.show-quotes',
            [
                'quotes' => Quote::paginate(10),
            ]);
    }
}
