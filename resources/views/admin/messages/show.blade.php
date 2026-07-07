@extends('layouts.admin')

@section('page_title', 'Read Message')

@section('content')
<div class="max-w-2xl bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
    <!-- Header -->
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <div class="flex items-center gap-1 text-xs font-bold text-slate-500">
            <a href="{{ route('admin.messages.index') }}" class="hover:text-slate-700">Inbox</a>
            <span>/</span>
            <span class="text-slate-400">Read</span>
        </div>
        
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3.5 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 text-xs font-semibold transition-colors flex items-center gap-1">
                <i class="fas fa-trash-alt"></i> Delete Message
            </button>
        </form>
    </div>

    <!-- Body -->
    <div class="p-8 space-y-6">
        <!-- Metadata -->
        <div class="flex justify-between items-start gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-900">{{ $message->name }}</h3>
                <a href="mailto:{{ $message->email }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                    {{ $message->email }}
                </a>
            </div>
            <span class="text-xs font-semibold text-slate-400">
                {{ $message->created_at->format('M d, Y \a\t g:i A') }} ({{ $message->created_at->diffForHumans() }})
            </span>
        </div>

        <hr class="border-slate-100">

        <!-- Subject -->
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Subject</p>
            <p class="font-bold text-slate-800 text-base">{{ $message->subject }}</p>
        </div>

        <!-- Content -->
        <div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Message Body</p>
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-slate-750 text-sm leading-relaxed whitespace-pre-wrap font-medium">
                {{ $message->message }}
            </div>
        </div>
    </div>

    <!-- Footer actions -->
    <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
        <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-50 rounded-lg text-xs font-bold text-slate-600 transition-colors">
            <i class="fas fa-arrow-left text-[10px] mr-1"></i> Back to Inbox
        </a>
        
        <form action="{{ route('admin.messages.toggle-read', $message) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 border border-slate-200 bg-white hover:bg-slate-50 rounded-lg text-xs font-bold text-slate-600 transition-colors">
                Mark as Unread
            </button>
        </form>
    </div>
</div>
@endsection
