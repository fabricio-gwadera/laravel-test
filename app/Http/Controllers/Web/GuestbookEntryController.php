<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestbookEntryStoreRequest;
use App\Jobs\GuestbookEntriesReportJob;
use App\Models\GuestbookEntry;
use App\Models\User;
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

    public function index()
    {
        $entries = $this->guestbookEntryService->getAllWithUsers();

        return view('index', ["entries" => $entries]);
    }

    public function create()
    {
        return view('form');
    }

    public function store(GuestbookEntryStoreRequest $request)
    {
        $user = $this->userService->firstOrCreate($request);

        if (!$user)
            return back()->with('error', 'Failed to find user');

        $entry = $this->guestbookEntryService->create($user, $request);

        if (!$entry)
            return back()->with('error', 'Failed to add new entry');

        return back()->with('success', 'New entry added successfully!');
    }
}
