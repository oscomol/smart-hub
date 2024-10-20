@extends(auth()->user()->userType === 'administrator' ? 'layout.admin' : 'layout.xtian.facultyLayout')


@section('adminContent')
<div class="container-fluid">
    <form method="GET" action="{{ route('chat.show') }}" class="mb-3">
        <div class="form-group">
            <label for="userSelect">Select Recipient:</label>
            <select name="user" id="userSelect" class="form-control" onchange="this.form.submit()">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($selectedUserId) && $selectedUserId == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if(isset($selectedUserId))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chat with {{ optional($users->find($selectedUserId))->username }}</h3>
            </div>
            <div class="card-body chat" id="chat">
                <div class="direct-chat-messages" id="messages">
                    @if($messages->isNotEmpty())
                        @foreach($messages as $message)
                            <div class="direct-chat-msg {{ $message->sender_id == Auth::id() ? 'right' : '' }}">
                                <div class="direct-chat-infos clearfix">
                                    @if ($message->sender_id == Auth::id())
                                        <span class="direct-chat-name float-right">{{ optional($users->find($message->sender_id))->username }}</span>
                                        <span class="direct-chat-timestamp float-right">{{ $message->created_at->format('H:i') }}</span>
                                    @else
                                        <span class="direct-chat-name float-left">{{ optional($users->find($message->sender_id))->username }}</span><br>
                                        <span class="direct-chat-timestamp float-left">{{ $message->created_at->format('H:i') }}</span>
                                    @endif
                                </div>
                                <img class="direct-chat-img" src="https://via.placeholder.com/50" alt="User Image">
                                <div class="direct-chat-text {{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 60%; border-radius: 20px; {{ $message->sender_id == Auth::id() ? 'margin-left:auto;' : '' }}">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No messages yet with this user.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('chat.send') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p class="text-muted">Please select a user to start chatting.</p>
    @endif
</div>
@endsection

@section('content')
<div class="container-fluid">
    <form method="GET" action="{{ route('chat.show') }}" class="mb-3">
        <div class="form-group">
            <label for="userSelect">Select Recipient:</label>
            <select name="user" id="userSelect" class="form-control" onchange="this.form.submit()">
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($selectedUserId) && $selectedUserId == $user->id ? 'selected' : '' }}>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if(isset($selectedUserId))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chat with {{ optional($users->find($selectedUserId))->username }}</h3>
            </div>
            <div class="card-body chat" id="chat">
                <div class="direct-chat-messages" id="messages">
                    @if($messages->isNotEmpty())
                        @foreach($messages as $message)
                            <div class="direct-chat-msg {{ $message->sender_id == Auth::id() ? 'right' : '' }}">
                                <div class="direct-chat-infos clearfix">
                                    @if ($message->sender_id == Auth::id())
                                        <span class="direct-chat-name float-right">{{ optional($users->find($message->sender_id))->username }}</span>
                                        <span class="direct-chat-timestamp float-right">{{ $message->created_at->format('H:i') }}</span>
                                    @else
                                        <span class="direct-chat-name float-left">{{ optional($users->find($message->sender_id))->username }}</span><br>
                                        <span class="direct-chat-timestamp float-left">{{ $message->created_at->format('H:i') }}</span>
                                    @endif
                                </div>
                                <img class="direct-chat-img" src="https://via.placeholder.com/50" alt="User Image">
                                <div class="direct-chat-text {{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light text-dark' }}" style="max-width: 60%; border-radius: 20px; {{ $message->sender_id == Auth::id() ? 'margin-left:auto;' : '' }}">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No messages yet with this user.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('chat.send') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $selectedUserId }}">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Type your message..." required>
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    @else
        <p class="text-muted">Please select a user to start chatting.</p>
    @endif
</div>
@endsection

@section('styles')
<style>
    .direct-chat-msg {
        margin-bottom: 1rem; 
        display: flex;
    }

    .direct-chat-msg.right {
        justify-content: flex-end; 
    }

    .direct-chat-name {
        font-weight: bold;
    }

    .direct-chat-infos {
        margin-bottom: 0.5rem; 
    }

    .direct-chat-text {
        max-width: 60%; 
        border-radius: 20px;
        padding: 10px; 
    }

    .direct-chat-text.bg-primary {
        background-color: #007bff;
        color: #fff; 
    }

    .direct-chat-text.bg-light {
        background-color: #f1f1f1;
        color: #000; 
    }
</style>
@endsection

@section('scripts')
<script>
    const userId = '{{ $selectedUserId }}';

    if (userId) {
        // Fetch messages every 3 seconds
        setInterval(() => {
            fetchMessages(userId);
        }, 3000);
    }

    function fetchMessages(userId) {
        fetch('{{ route('chat.fetchMessages') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ user_id: userId }),
        })
        .then(response => response.json())
        .then(messages => {
            const messagesContainer = document.getElementById('messages');
            messagesContainer.innerHTML = '';

            messages.forEach(message => {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('direct-chat-msg', message.sender_id == '{{ Auth::id() }}' ? 'right' : '');
                messageDiv.innerHTML = `
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name ${message.sender_id == '{{ Auth::id() }}' ? 'float-right' : 'float-left'}">
                            ${message.sender.username}
                        </span>
                        <span class="direct-chat-timestamp ${message.sender_id == '{{ Auth::id() }}' ? 'float-right' : 'float-left'}">
                            ${new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}
                        </span>
                    </div>
                    <img class="direct-chat-img" src="https://via.placeholder.com/50" alt="User Image">
                    <div class="direct-chat-text ${message.sender_id == '{{ Auth::id() }}' ? 'bg-primary text-white' : 'bg-light text-dark'}" style="max-width: 60%; border-radius: 20px; ${message.sender_id == '{{ Auth::id() }}' ? 'margin-left:auto;' : ''}">
                        ${message.message}
                    </div>
                `;
                messagesContainer.appendChild(messageDiv);
            });
        });
    }
</script>
@endsection