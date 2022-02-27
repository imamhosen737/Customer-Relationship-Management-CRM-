<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\customers;
use App\Models\Item;
use Carbon\Carbon;

class Helper
{
    public static function getRecurringInvoice()
    {
        return Invoice::with('customer', 'items', 'customer.user', 'items.unit', 'items.tax')
            ->where('customer_id', auth()->user()->customer->id)
            ->where('invoice_type', 'recurring')
            ->get()
            ->filter(function($q) {
                $intervalDate = Carbon::createFromFormat('Y-m-d H:i:s',  $q->due_date.' 00:00:00')
                    ->addDays($q->interval);
                $diff = $intervalDate->diffInDays(now()) + 1;
                if ($diff > 0 && $diff <= 3) {
                    return $q;
                }
            });
    }
}
