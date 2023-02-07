<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestbookEntryStoreRequest;
use App\Http\Requests\GuestbookEntryUpdateRequest;
use App\Models\GuestbookEntry;
use App\Models\User;
use App\Services\GuestbookEntryDeletionService;
use App\Services\GuestbookEntryService;
use App\Services\UserService;
use Illuminate\Http\Request;

class GuestbookEntryController extends Controller
{
    private GuestbookEntryService $guestbookEntryService;
    private UserService $userService;

    public function __construct(GuestbookEntryService $guestbookEntryService, UserService $userService)
    {
        $this->guestbookEntryService = $guestbookEntryService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return $this->guestbookEntryService->getAllWithUsers();
    }

    public function my(Request $request)
    {
        return GuestbookEntry::whereHas('user', function ($query) use ($request) {
            $query->where('email', $request->user()?->email);
        })
            ->with('user')
            ->get();
    }

    public function show(GuestbookEntry $entry)
    {
        return $entry;
    }

    public function create(GuestbookEntryStoreRequest $request)
    {
        $user = $this->userService->firstOrCreate($request);

        if (!$user)
            return response("Failed to find user", 500);

        $entry = $this->guestbookEntryService->create($user, $request);

        return $entry;
    }

    public function update(GuestbookEntryUpdateRequest $request, $id)
    {
        return $this->guestbookEntryService->update($id, $request);
    }

    public function destroy(GuestbookEntry $entry)
    {
        $this->guestbookEntryService->destroy($entry);

        return response("Deleted");
    }
}
