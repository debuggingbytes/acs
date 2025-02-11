<?php

namespace App\Livewire\Quotes;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\System\Quote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class CreateQuote extends Component
{
    #[Layout('dashboard.app')]
    public $todaysDate;
    public $inventory;


    public $price;
    public $currency;

    public $clientName;
    public $quantity;
    public $clientCompany;
    public $clientEmail;
    public $clientPhone;
    public $clientAddress;
    public $listPrice;
    public $lineItem;
    public $shippingPrice;
    public $quoteNumber;
    public $quoteErrors;


    public function getTodaysDateProperty()
    {
        return Carbon::today()->format('F j, Y'); // Example: October 26, 2023
    }

    public function updated($property)
    {
        $propertiesToFormat = ['price', 'listPrice', 'shippingPrice'];

        if (in_array($property, $propertiesToFormat)) {
            $this->$property = Number::currency(Str::replace(',', '', $this->$property));
        }
    }

    // save function
    public function generateQuote()
    {
        $this->validate([
            'clientName' => 'required',
            'clientCompany' => 'required',
            'clientEmail' => 'required|email',
            'clientPhone' => 'required',
            'clientAddress' => 'required',
            'listPrice' => 'required',
            'lineItem' => 'required',
            'shippingPrice' => 'required',
            'currency' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        try {

            $quote = $this->saveQuote();

            if (! isset($quote)) {
                throw new \Exception('Failed to save quote.');
            }

            $this->generatePDF($quote);


            DB::commit();
            session()->flash('status', [
                'type' => 'success',
                'message' => 'Quote created successfully.',
                'title' => 'Success'
            ]);
            $this->dispatch('refresh-status');
            // $this->resetExcept('inventory');

        } catch (\Exception $e) {
            DB::rollBack();

            // Only attempt to delete if quote was created
            if (isset($quote)) {
                $quote->delete();
            }

            $this->quoteErrors = $e->getMessage();
            session()->flash('status', [
                'type' => 'error',
                'message' => 'An error occurred. Please try again. <br> Error: '.$e->getMessage(),
                'title' => 'Error'
            ]);
            $this->dispatch('refresh-status');
        }

        return redirect()->route('quotes.home');

    }
    private function generatePDF(Quote $quote)
    {
        try {
            // Generate a UUID for the folder
            $uuid = (string) Str::uuid();
            // Create the storage path
            $storagePath = "clients/quote/{$uuid}";
            $fileName = "Quote-{$quote->quote_number}.pdf";
            // Generate the PDF
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf = PDF::loadView('pdf.quote', ['quote' => $quote]);
            // Save to storage
            Storage::disk('public')->makeDirectory($storagePath);
            Storage::disk('public')->put("{$storagePath}/{$fileName}", $pdf->output());
            // Update quote with the file path
            $quote->update([
                'pdf_path' => "{$storagePath}/{$fileName}"
            ]);

        } catch (\Exception $e) {
            session()->flash('status', [
                'type' => 'error',
                'message' => 'Failed to generate PDF. Please try again. <br> Error: '.$e->getMessage(),
                'title' => 'Error'
            ]);
            $this->dispatch('refresh-status');
            return $e->getMessage();
        }
    }
    private function saveQuote()
    {
        DB::beginTransaction();

        try {
            $year = date('Y');

            // Use a database-level lock to prevent race conditions
            DB::select('SELECT GET_LOCK("quote_creation_'.$year.'", 10)'); // 10-second timeout

            // Now that we have the lock, check for existing quotes
            $lastQuote = Quote::whereYear('created_at', $year)
                ->orderBy('quote_number', 'desc')
                ->first();

            if (! $lastQuote) {
                $quoteNumber = "ACS-$year-00001";
            } else {
                $nextNumber = (int) substr($lastQuote->quote_number, 9) + 1;
                $paddedNumber = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
                $quoteNumber = "ACS-$year-$paddedNumber";
            }

            $quote = Quote::create([ // No need for createOrFirst here
                'quote_number' => $quoteNumber,
                'client_name' => $this->clientName,
                'client_company' => $this->clientCompany,
                'client_email' => $this->clientEmail,
                'client_phone' => $this->clientPhone,
                'client_address' => $this->clientAddress,
                'list_price' => $this->listPrice,
                'line_item' => $this->lineItem,
                'shipping_price' => $this->shippingPrice,
                'currency' => $this->currency,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'inventory_id' => $this->inventory->id,
                'todays_date' => $this->getTodaysDateProperty(),
            ]);

            DB::commit();
            DB::select('SELECT RELEASE_LOCK("quote_creation_'.$year.'")'); // Release the lock
            return $quote;

        } catch (\Exception $e) {
            DB::rollBack();
            DB::select('SELECT RELEASE_LOCK("quote_creation_'.$year.'")'); // Release lock even on failure
            throw $e; // Re-throw the exception so your error handling works
        }
    }

    public function mount(Inventory $inventory, $id = null)
    {
        $this->todaysDate = $this->getTodaysDateProperty();
        $this->inventory = $inventory::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.quotes.create-quote');
    }
}
