<?php

namespace App\Http\Controllers\API;

use App\Enums\VisitRequestStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreVisitRequest;
use App\Http\Requests\API\UpdateVisitRequestStatusRequest;
use App\Models\VisitRequest;
use Illuminate\Http\Request;

class VisitRequestController extends Controller
{

    public function index(Request $request)
    {
        $requests = VisitRequest::query()
            ->with(['property', 'property.images'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $requests
        ]);
    }


    public function store(StoreVisitRequest $request)
    {
        $visitRequest = VisitRequest::create([
            'user_id' => $request->user()->id,
            'property_id' => $request->property_id,
            'preferred_date' => $request->preferred_date,
            'preferred_time_slot' => $request->preferred_time_slot,
            'note' => $request->note,
            'status' => VisitRequestStatus::PENDING,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visit request submitted successfully.',
            'data' => $visitRequest->load('property')
        ], 201);
    }


    public function updateStatus(UpdateVisitRequestStatusRequest $request, VisitRequest $visitRequest)
    {
        $visitRequest->update([
            'status' => $request->status,
            'agent_note' => $request->agent_note,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visit request status updated successfully.',
            'data' => $visitRequest
        ]);
    }


    public function cancel(Request $request, VisitRequest $visitRequest)
    {
        if ($visitRequest->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($visitRequest->status !== VisitRequestStatus::PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'Only pending visit requests can be cancelled.'
            ], 422);
        }

        $visitRequest->update([
            'status' => VisitRequestStatus::CANCELLED
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visit request cancelled successfully.',
            'data' => $visitRequest
        ]);
    }
}
