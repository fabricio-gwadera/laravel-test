<?php

namespace App\Services;

use App\Models\GuestbookEntry;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GuestbookEntryService
{
    public function getAllWithUsers()
    {
        return GuestbookEntry::with('user')
            ->get();
    }

    public function create(User $user, Request $request)
    {
        return $user->guestbookEntries()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
    }

    public function update(String $id, Request $request)
    {
        $entry = GuestbookEntry::where('id', $id)
            ->where('user_id', $request->user()?->id)
            ->first();

        if(!$entry)
            return response("Unauthorized", 401);

        $entry->fill($request->validated())->save();

        return $entry;
    }

    public function destroy(GuestbookEntry $entry)
    {
        $entry->delete();

        $this->notifyUserOfDeletion($entry->user->email);
        $this->generateNewReport($entry);
        $this->performCleanupTasks();
    }

    private function notifyUserOfDeletion(String $email)
    {
        Log::info('Deleted guestbook entry for user ' . $email);
    }

    private function generateNewReport()
    {
        Log::info('Generating new guestbook report');
    }

    private function performCleanupTasks()
    {
        Log::info('Performing cleanup tasks');
    }
}
