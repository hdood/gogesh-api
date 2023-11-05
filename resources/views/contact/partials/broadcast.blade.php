<div class="row message-body">
    <div class="col-sm-12 message-main-sender">
        <div class="sender">
            <div class="message-text"> {{ $message->message }}</div>
            @if (!empty($message->attachment))
                <div class="message-text">
                    <img src="{{ asset($message->attachment) }}" alt="" srcset="">
                </div>
            @endif
            <span class="message-time pull-right"> {{ $message->created_at->format('h:i') }} </span>
        </div>
    </div>
</div>
