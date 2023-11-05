<?php

use App\Enum\EnumGeneral;

?>
@foreach ($data as $item)
    <div class="media p-3" onclick="openContact(this)" data-id="{{ $item->id }}"
        data-url="{{ route('contact.show', $item->id) }}">
        <div class="item-img bg-skyblue author-online rounded-circle position-relative">
            @if (!empty($item->seller_id))
                <img src="{{ asset($item->seller->image) }}" width="50" class="rounded-circle"
                    style="
            width: 50px;
            height: 50px;
        " alt="img">
            @elseif (!empty($item->customer_id))
                <img src="{{ asset($item->customer->image) }}" width="50" class="rounded-circle"
                    style="
            width: 50px;
            height: 50px;
        " alt="img">
            @else
                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" width="50" class="rounded-circle"
                    alt="img">
            @endif
            @if ($item->status == EnumGeneral::UNREAD)
                <span class="position-absolute" id="active"
                    style="
                                        left: 0;
                                        background: blue;
                                        border-radius: 50%;
                                        padding: 2px;
                                        width: 15px;
                                        height: 15px;
                                    "></span>
            @endif
        </div>
        <div class="media-body space-sm">
            <div class="item-title">
                <a class="d-flex justify-content-between ">
                    <span class="item-name" id="contact_title">
                        @if (!empty($item->seller_id))
                            {{ $item->seller->firstname . ' ' . $item->seller->lastname }}
                        @else
                            {{ $item->customer->firstname . ' ' . $item->customer->lastname }}
                        @endif
                        <span class="text-info">{{ $item->id }}</span>

                    </span>
                    <span class="item-time">{{ $item->updated_at->format('h:i') }}</span>
                </a>
            </div>
            <p class="m-1">{{ $item->last_message }}</p>
        </div>
    </div>
@endforeach
<script>
    function openChat(element) {
        var contactElement = $(element);
        var contactID;

        $(contactElement).find("#active").remove();

        $(".messages").addClass("d-block");
        $("#message_title").text($(contactElement).find("#contact_title").text());

        const id = $(contactElement).data("id");
        const url = $(contactElement).data("url");

        $.get(url, function(data, textStatus, jqXHR) {
            $("#conversation").empty();
            $(".answer-send-button").data("id", id);
            $("#conversation").data("url", url);
            $("#conversation").data("id", id);
            $("#conversation").append(data);
            contactID = $("#conversation").data("id");
            $("#conversation").scrollTop(
                $("#conversation").prop("scrollHeight")
            );
        }).done(function() {
            subscribeToChannel(contactID);
        });

        page = 2;
        has_data = true;
    }
</script>
