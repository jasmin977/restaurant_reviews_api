<?php

namespace App\Http\Controllers;

use App\Events\PromotionMadeEvent;
use App\Models\Promotion;
use App\Notifications\PromotionNotification;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function create(Request $request)
    {
        $promotion = Promotion::create([
            'meal_id' => $request->input('meal_id'),
            'discount' => $request->input('discount'),
        ]);

        // Add logic for notifying users or any other actions

        // Dispatch the event for making a promotion
        event(new PromotionMadeEvent($promotion));
        // Dispatch the PromotionNotification
        $promotion->notify(new PromotionNotification($promotion));
        return response()->json(['promotion' => $promotion], 201);
    }
}
