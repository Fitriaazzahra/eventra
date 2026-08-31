@extends('layouts.admin')

@section('title', 'Profil Admin')
@section('breadcrumb', 'Profil Saya')

@section('content')
<div style="background: white; border-radius: 12px; padding: 24px; max-width: 600px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
    <h2 style="font-weight: 700; font-size: 18px; margin-bottom: 20px; color: #0f172a;">Pengaturan Profil</h2>

    <form action="{{ route('admin.profile.avatar.update', ['locale' => app()->getLocale()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px;">
            {{-- Preview Foto NAS atau Inisial --}}
            @if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('nas')->exists($user->avatar))
                <img src="{{ route('admin.profile.avatar.show', ['locale' => app()->getLocale()]) }}" 
                     alt="{{ $user->name }}" 
                     style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
            @else
                <div style="width: 80px; height: 80px; border-radius: 50%; background: #6366f1; color: white; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 700;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div>
                <label style="display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; color: #334155;">Foto Profil</label>
                <input type="file" name="avatar" accept="image/jpeg,image/png,image/jpg,image/webp" required style="font-size: 13px;">
                <p style="font-size: 12px; color: #64748b; margin-top: 4px;">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 4px;">Nama Lengkap</label>
            <input type="text" value="{{ $user->name }}" disabled style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; color: #64748b; font-size: 14px;">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 4px;">Email</label>
            <input type="email" value="{{ $user->email }}" disabled style="width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1; background: #f8fafc; color: #64748b; font-size: 14px;">
        </div>

        <button type="submit" class="eventra-add-btn" style="cursor: pointer; padding: 8px 16px; background: #6366f1; color: white; border: none; border-radius: 6px; font-weight: 600;">Simpan ke NAS</button>
    </form>
</div>
@endsection