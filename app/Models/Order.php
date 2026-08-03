<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'code',
    ];

    /* Relation Methods */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* End Relation Methods */

    /**
     * @throws \Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function generateInvoice(): void
    {
        $view = view('pdfs.invoice', ['order' => $this]);
        Browsershot::html($view->render())->setChromePath('C:\Program Files\Google\Chrome\Application\chrome.exe')
            ->save($this->invoicePath());
    }

    public function isPaid(): bool
    {
        return $this->payment->status;
    }

    public function downloadInvoice(): StreamedResponse
    {
        $filePath = 'invoices/order' . $this->id . '.pdf';

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'Invoice not found.');
        }

        return Storage::disk('public')->download($filePath, 'invoice-order-' . $this->id . '.pdf');
    }

    public function invoicePath(): string
    {
        return storage_path('app/public/invoices/order'. $this->id . '.pdf');
    }
}
