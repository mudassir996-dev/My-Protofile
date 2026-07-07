@extends('layouts.admin')

@section('page_title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card: Projects -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fas fa-folder-open"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Projects</p>
                <p class="text-2xl font-black text-slate-800">{{ $stats['projects'] }}</p>
            </div>
        </div>

        <!-- Stat Card: Skills -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl">
                <i class="fas fa-laptop-code"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Skills</p>
                <p class="text-2xl font-black text-slate-800">{{ $stats['skills'] }}</p>
            </div>
        </div>

        <!-- Stat Card: Blogs -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fas fa-newspaper"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Blog Posts</p>
                <p class="text-2xl font-black text-slate-800">{{ $stats['blogs'] }}</p>
            </div>
        </div>

        <!-- Stat Card: Contact Messages -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl relative">
                <i class="fas fa-envelope"></i>
                @if($stats['unread_messages'] > 0)
                    <span class="absolute -top-1.5 -right-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-rose-600 text-[10px] font-bold text-white ring-2 ring-white">
                        {{ $stats['unread_messages'] }}
                    </span>
                @endif
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Messages</p>
                <p class="text-2xl font-black text-slate-800">{{ $stats['messages'] }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Messages section -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center">
            <h2 class="font-bold text-slate-800">Recent Contact Messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 uppercase tracking-wider">
                View Inbox
            </a>
        </div>
        
        @if(count($recentMessages) > 0)
            <div class="divide-y divide-slate-100">
                @foreach($recentMessages as $msg)
                    <div class="p-6 flex items-start justify-between gap-6 hover:bg-slate-50 transition-colors {{ !$msg->is_read ? 'bg-slate-50/50' : '' }}">
                        <div class="space-y-1.5 min-w-0 flex-grow">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800 text-sm">{{ $msg->name }}</span>
                                <span class="text-xs text-slate-400">({{ $msg->email }})</span>
                                @if(!$msg->is_read)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 border border-indigo-200 text-indigo-700 uppercase tracking-wider">New</span>
                                @endif
                            </div>
                            <p class="font-semibold text-slate-700 text-sm truncate">{{ $msg->subject }}</p>
                            <p class="text-xs text-slate-500 truncate max-w-2xl">{{ $msg->message }}</p>
                        </div>
                        
                        <div class="flex items-center gap-4 flex-shrink-0 text-xs">
                            <span class="text-slate-400 font-semibold">{{ $msg->created_at->diffForHumans() }}</span>
                            <a href="{{ route('admin.messages.show', $msg) }}" class="px-3.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 hover:text-indigo-600 font-semibold transition-colors">
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-slate-400 font-medium">
                <i class="fas fa-inbox text-4xl mb-2 text-slate-300"></i>
                <p>No messages received yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
