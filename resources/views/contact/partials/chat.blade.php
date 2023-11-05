@forelse ($replies as $replie)
    @if ($replie->type == get_class(Auth::user()))
        <div class="row message-body">
            <div class="col-sm-12 message-main-sender">
                <div class="sender">
                    <div class="message-text"> {{ $replie->message }}</div>
                    @if (!empty($replie->attachment))
                        <div class="message-text">
                            <img src="{{ asset($replie->attachment) }}" alt="" srcset="">
                        </div>
                    @endif
                    <span class="message-time pull-right"> {{ $replie->created_at->format('h:i') }} </span>
                </div>
            </div>
        </div>
    @else
        <div class="row message-body">
            <div class="col-sm-12 message-main-receiver">
                <div class="receiver">
                    <div class="message-text">{{$replie->message}} </div>
                    @if (!empty($replie->attachment))
                        <div class="message-text">
                            <img src="{{ asset($replie->attachment) }}" alt="" srcset="">
                        </div>
                    @endif
                    <span class="message-time pull-right"> {{ $replie->created_at->format('h:i') }} </span>
                </div>
            </div>
        </div>
    @endif
@empty

@endforelse
