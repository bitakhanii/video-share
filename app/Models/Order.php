<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'code',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateInvoice()
    {
        $view = view('pdfs.invoice', ['order' => $this]);
        Browsershot::html($view->render())->setChromePath('C:\Program Files\Google\Chrome\Application\chrome.exe')
            ->save($this->invoicePath());
    }

    public function isPaid()
    {
        return $this->payment->status;
    }

    public function downloadInvoice()
    {
        $filePath = 'public/invoices/order' . $this->id . '.pdf';

        if (!Storage::exists($filePath)) {
            abort(404, 'Invoice not found.');
        }

        return Storage::download($filePath, 'invoice-order-' . $this->id . '.pdf');
    }

    public function invoicePath()
    {
        return storage_path('app/public/invoices/order'. $this->id . '.pdf');
    }
}
