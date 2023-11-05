<?php

use App\Enum\EnumGeneral;

?>
<div class="media p-3" onclick="openChat(this)" data-id="{{ $contact->id }}"
    data-url="{{ route('contact.show', $contact->id) }}" id="contact">
    <div class="item-img bg-skyblue author-online  rounded-circle position-relative">
        <img src="{{ asset($account->image) }}" alt="img" style="width: 50px;height: 50px;" class="rounded-circle">
        <span class="position-absolute"
            style="
            left: 0;
            background: blue;
            border-radius: 50%;
            padding: 2px;
            width: 15px;
            height: 15px;
        "
            id="active"></span>

    </div>
    <div class="media-body space-sm">
        <div class="item-title">
            <a style="
            display: flex;
            justify-content: space-between;
        ">
                <span class="item-name" id="contact_title">{{ $account->firstname . ' ' . $account->lastname }}
                    <span class="text-info">{{ $contact->id }}</span>
                </span>
                <span class="item-time">{{ \Carbon\Carbon::parse($contact->created_at)->format('h:i') }}</span>
            </a>
        </div>
        <p class="m-1">{{ $contact->subject }}</p>
    </div>
</div>
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
