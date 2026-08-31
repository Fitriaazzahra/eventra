<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Participant;
use App\Models\SiteAboutSetting;
use App\Models\SiteMenu;
use App\Models\Speaker;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SidebarPageController extends Controller
{
    public function categories()
    {
        $categories = EventCategory::orderBy('name')->get();

        return view('admin.sidebar.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.sidebar.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        EventCategory::create($data);

        return redirect()->route('admin.categories.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Kategori berhasil dibuat.' : 'Category created successfully.');
    }

    public function editCategory(string $locale, EventCategory $category)
    {
        return view('admin.sidebar.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, string $locale, EventCategory $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Kategori berhasil diperbarui.' : 'Category updated successfully.');
    }

    public function destroyCategory(string $locale, EventCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Kategori berhasil dihapus.' : 'Category deleted successfully.');
    }

    public function speakers()
    {
        $speakers = Speaker::orderBy('name')->get();

        return view('admin.sidebar.speakers', compact('speakers'));
    }

    public function createSpeaker()
    {
        return view('admin.sidebar.speakers.create');
    }

    public function storeSpeaker(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'biography' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Speaker::create($data);

        return redirect()->route('admin.speakers.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pembicara berhasil dibuat.' : 'Speaker created successfully.');
    }

    public function editSpeaker(string $locale, Speaker $speaker)
    {
        return view('admin.sidebar.speakers.edit', compact('speaker'));
    }

    public function updateSpeaker(Request $request, string $locale, Speaker $speaker)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'biography' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $speaker->update($data);

        return redirect()->route('admin.speakers.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pembicara berhasil diperbarui.' : 'Speaker updated successfully.');
    }

    public function destroySpeaker(string $locale, Speaker $speaker)
    {
        $speaker->delete();

        return redirect()->route('admin.speakers.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pembicara berhasil dihapus.' : 'Speaker deleted successfully.');
    }

    public function venues()
    {
        $venues = Venue::orderBy('name')->get();

        return view('admin.sidebar.venues', compact('venues'));
    }

    public function createVenue()
    {
        return view('admin.sidebar.venues.create');
    }

    public function storeVenue(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Venue::create($data);

        return redirect()->route('admin.venues.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Venue berhasil dibuat.' : 'Venue created successfully.');
    }

    public function editVenue(string $locale, Venue $venue)
    {
        return view('admin.sidebar.venues.edit', compact('venue'));
    }

    public function updateVenue(Request $request, string $locale, Venue $venue)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $venue->update($data);

        return redirect()->route('admin.venues.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Venue berhasil diperbarui.' : 'Venue updated successfully.');
    }

    public function destroyVenue(string $locale, Venue $venue)
    {
        $venue->delete();

        return redirect()->route('admin.venues.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Venue berhasil dihapus.' : 'Venue deleted successfully.');
    }

    public function participants()
    {
        $participants = Participant::with('event')->orderBy('registration_date', 'desc')->get();

        return view('admin.sidebar.participants', compact('participants'));
    }

    public function createParticipant()
    {
        $events = Event::orderBy('name')->get();

        return view('admin.sidebar.participants.create', compact('events'));
    }

    public function storeParticipant(Request $request)
    {
        $data = $request->validate([
            'participant_code' => ['required', 'string', 'max:50', 'unique:participants,participant_code'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'event_id' => ['required', 'exists:events,id'],
            'ticket_type' => ['required', 'string', 'max:50'],
            'registration_date' => ['required', 'date'],
            'status' => ['required', 'in:Registered,Confirmed,Cancelled,Attended,registered,confirmed,cancelled,attended'],
        ]);

        Participant::create($data);

        return redirect()->route('admin.participants.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Peserta berhasil dibuat.' : 'Participant created successfully.');
    }

    public function editParticipant(string $locale, Participant $participant)
    {
        $events = Event::orderBy('name')->get();

        return view('admin.sidebar.participants.edit', compact('participant', 'events'));
    }

    public function updateParticipant(Request $request, string $locale, Participant $participant)
    {
        $data = $request->validate([
            'participant_code' => ['required', 'string', 'max:50', 'unique:participants,participant_code,' . $participant->id],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'event_id' => ['required', 'exists:events,id'],
            'ticket_type' => ['required', 'string', 'max:50'],
            'registration_date' => ['required', 'date'],
            'status' => ['required', 'in:Registered,Confirmed,Cancelled,Attended,registered,confirmed,cancelled,attended'],
        ]);

        $participant->update($data);

        return redirect()->route('admin.participants.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Peserta berhasil diperbarui.' : 'Participant updated successfully.');
    }

    public function destroyParticipant(string $locale, Participant $participant)
    {
        $participant->delete();

        return redirect()->route('admin.participants.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Peserta berhasil dihapus.' : 'Participant deleted successfully.');
    }

    public function documents()
    {
        $documents = Document::with('event')->orderBy('created_at', 'desc')->get();

        return view('admin.sidebar.documents', compact('documents'));
    }

    public function createDocument()
    {
        $events = Event::orderBy('name')->get();

        return view('admin.sidebar.documents.create', compact('events'));
    }

    public function storeDocument(Request $request)
    {
        $data = $request->validate([
            'event_id' => ['nullable', 'exists:events,id'],
            'document_name' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('documents', 'public');

        Document::create([
            'event_id' => $data['event_id'] ?? null,
            'document_name' => $data['document_name'],
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $uploadedFile->getClientMimeType() ?: 'application/octet-stream',
            'file_size' => $uploadedFile->getSize(),
            'storage_disk' => 'public',
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.documents.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Dokumen berhasil diupload.' : 'Document uploaded successfully.');
    }

    public function editDocument(string $locale, Document $document)
    {
        $events = Event::orderBy('name')->get();

        return view('admin.sidebar.documents.edit', compact('document', 'events'));
    }

    public function updateDocument(Request $request, string $locale, Document $document)
    {
        $data = $request->validate([
            'event_id' => ['nullable', 'exists:events,id'],
            'document_name' => ['required', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'max:10240'],
        ]);

        $payload = [
            'event_id' => $data['event_id'] ?? null,
            'document_name' => $data['document_name'],
        ];

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $payload['file_name'] = $uploadedFile->getClientOriginalName();
            $payload['file_path'] = $uploadedFile->store('documents', 'public');
            $payload['file_type'] = $uploadedFile->getClientMimeType() ?: 'application/octet-stream';
            $payload['file_size'] = $uploadedFile->getSize();
            $payload['storage_disk'] = 'public';
        }

        $document->update($payload);

        return redirect()->route('admin.documents.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Dokumen berhasil diperbarui.' : 'Document updated successfully.');
    }

    public function destroyDocument(string $locale, Document $document)
    {
        $document->delete();

        return redirect()->route('admin.documents.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Dokumen berhasil dihapus.' : 'Document deleted successfully.');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pengguna berhasil dibuat.' : 'User created successfully.');
    }

    public function editUser(string $locale, User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, string $locale, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $payload = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $payload['password'] = Hash::make($data['password']);
        }

        $user->update($payload);

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pengguna berhasil diperbarui.' : 'User updated successfully.');
    }

    public function destroyUser(string $locale, User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])
                ->with('error', app()->getLocale() === 'id' ? 'Anda tidak dapat menghapus akun sendiri.' : 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pengguna berhasil dihapus.' : 'User deleted successfully.');
    }

    public function import()
    {
        return view('admin.sidebar.import');
    }

    public function export()
    {
        return view('admin.sidebar.export');
    }

    public function settings()
    {
        $menuItems = SiteMenu::orderBy('sort_order')->get();
        $aboutSettings = SiteAboutSetting::orderBy('sort_order')->get();

        return view('admin.sidebar.settings', compact('menuItems', 'aboutSettings'));
    }

    public function updateSettings(Request $request)
    {
        $menuItems = $request->input('menu', []);
        $aboutSettings = $request->input('about', []);

        foreach ($menuItems as $key => $data) {
            $record = SiteMenu::where('key', $key)->first();

            if (! $record) {
                continue;
            }

            $locale = app()->getLocale();
            $newLabel = $data['label'] ?? ($locale === 'id' ? ($data['label_id'] ?? $record->label_id) : ($data['label_en'] ?? $record->label_en));

            $record->update([
                'label_id' => $locale === 'id' ? $newLabel : ($data['label_id'] ?? $record->label_id),
                'label_en' => $locale === 'en' ? $newLabel : ($data['label_en'] ?? $record->label_en),
                'target_url' => $data['target_url'] ?? $record->target_url,
                'is_active' => ! empty($data['is_active']),
                'sort_order' => (int) ($data['sort_order'] ?? $record->sort_order),
            ]);
        }

        foreach ($aboutSettings as $key => $data) {
            $record = SiteAboutSetting::where('key', $key)->first();

            if (! $record) {
                continue;
            }

            $locale = app()->getLocale();
            $newValue = $data['value'] ?? ($locale === 'id' ? ($data['value_id'] ?? $record->value_id) : ($data['value_en'] ?? $record->value_en));

            $record->update([
                'value_id' => $locale === 'id' ? $newValue : ($data['value_id'] ?? $record->value_id),
                'value_en' => $locale === 'en' ? $newValue : ($data['value_en'] ?? $record->value_en),
                'sort_order' => (int) ($data['sort_order'] ?? $record->sort_order),
            ]);
        }

        return redirect()->route('admin.settings.index', ['locale' => app()->getLocale()])
            ->with('success', app()->getLocale() === 'id' ? 'Pengaturan menu dan halaman tentang berhasil diperbarui.' : 'Menu and about page settings updated successfully.');
    }
}
