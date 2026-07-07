@extends('layouts.admin')

@section('page_title', 'Contact Messages')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest font-bold">Inbox</h2>
    </div>

    <!-- Messages Inbox -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if(count($messages) > 0)
            <div class="divide-y divide-slate-100">
                @foreach($messages as $msg)
                    <div class="p-6 flex items-start justify-between gap-6 hover:bg-slate-50/50 transition-colors {{ !$msg->is_read ? 'bg-indigo-50/10' : '' }}">
                        <div class="space-y-1.5 min-w-0 flex-grow">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-bold text-slate-800 text-sm">{{ $msg->name }}</span>
                                <span class="text-xs text-slate-400">({{ $msg->email }})</span>
                                @if(!$msg->is_read)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 border border-indigo-200 text-indigo-700 uppercase tracking-wider">New</span>
                                @endif
                            </div>
                            <p class="font-semibold text-slate-700 text-sm truncate">{{ $msg->subject }}</p>
                            <p class="text-xs text-slate-500 truncate max-w-3xl">{{ $msg->message }}</p>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-center gap-4 flex-shrink-0 text-xs">
                            <span class="text-slate-400 font-semibold hidden sm:inline">{{ $msg->created_at->format('M d, Y') }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 hover:text-indigo-600 font-semibold transition-colors flex items-center gap-1">
                                    <i class="fas fa-envelope-open"></i> Read
                                </a>
                                
                                <form action="{{ route('admin.messages.toggle-read', $msg) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 font-semibold transition-colors" title="Toggle read status">
                                        {{ $msg->is_read ? 'Mark Unread' : 'Mark Read' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-colors" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-slate-400 font-medium">
                <i class="fas fa-inbox text-5xl text-slate-200 mb-2"></i>
                <p>Your inbox is empty.</p>
            </div>
        @endif
    </div>
</div>
@endsection
