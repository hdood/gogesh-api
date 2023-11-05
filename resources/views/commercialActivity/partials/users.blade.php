    <div class="row p-3">

        @foreach ($commercialActivity->users as $item)
            <div class="col-md-3 my-2">
                <div class="card"
                    style="
            align-items: center;
            border: 1pxs;
            box-shadow:
            inset 0px 0px 20px 9px rgba(229, 229, 229, 0.75);

            padding: 11px;
        ">
                    @if ($item->image)
                        <img class="card-img-top " src="{{ asset($item->image) }}" alt="Card image cap"
                            style="
border-radius: 50%;
height: 100px;
width: 100px;
">
                    @else
                        <img class="card-img-top " src="{{ asset('static/img/teacher.jpg') }}" alt="Card image cap"
                            style="
                border-radius: 50%;
                height: 100px;
                width: 100px;
            ">
                    @endif

                    <div class="card-body" style="box-shadow: none; text-align: center">
                        <h5 class="card-title">{{ $item->firstname . ' ' . $item->lastname }}</h5>
                        <span class="d-flex ">
                            <img src="{{ asset('static/icons/gmail.svg') }}" alt="" style="
    height: 20px;
">
                            <p class="card-title mx-2">{{ $item->email }}</p>
                        </span>
                        @if ($item->phone)
                            <span class="d-flex ">
                                <img src="{{ asset('static/icons/phone.svg') }}" alt=""
                                    style="
    height: 20px;
">

                                <p class="card-title mx-2">{{ $item->phone }}</p>
                            </span>
                        @endif
                        <a href="#" class="btn btn-primary mt-5">Go somewhere</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
