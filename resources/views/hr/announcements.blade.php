@extends('layouts.app')

@section('title', 'Corporate Announcements')
@section('subtitle', 'Company news, policy updates, and executive bulletins.')

@section('content')
<div class="card" style="padding: 1.5rem; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05); border: 1px solid #f1f5f9;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
        <h3 style="margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 700;">Broadcast Feed</h3>
        <span class="badge" style="background: #eef2ff; color: #4338ca; font-weight: 600;">
            {{ $announcements->count() }} Posts
        </span>
    </div>

    @if($announcements->isEmpty())
        <div class="empty" style="padding: 3.5rem 1rem; text-align: center;">
            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📢</div>
            <h4 style="margin: 0 0 0.5rem; color: #1e293b; font-weight: 700;">No company announcements yet</h4>
            <p style="margin: 0; color: #64748b;">Important organizational notifications will appear here for all employees.</p>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.25rem;">
            @foreach($announcements as $announcement)
                <div class="card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <span class="badge" style="background: #e0e7ff; color: #4338ca; font-weight: 600; font-size: 0.75rem;">Announcement</span>
                            <span style="font-size: 0.75rem; color: #94a3b8;">{{ $announcement->created_at?->diffForHumans() }}</span>
                        </div>
                        <h4 style="margin: 0 0 0.5rem; font-size: 1.1rem; color: #0f172a; font-weight: 700;">{{ $announcement->title }}</h4>
                        <p style="margin: 0; color: #475569; font-size: 0.9rem; line-height: 1.6;">{{ $announcement->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
