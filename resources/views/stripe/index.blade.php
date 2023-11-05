@extends('stripe.layoute')

@section('content')
    <div class="card-container">

        <div class="front">
            <div class="image">
                <img src="{{ asset('static/img/chip.png') }}" alt="">
                <span id="type-card"
                    style="
                font-size: 24px;
                font-weight: bold;
                color: white;
            "></span>
            </div>
            <div class="card-number-box">################</div>
            <div class="flexbox">
                <div class="box">
                    <span>card holder</span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="image/visa.png" alt="">
            </div>
        </div>

    </div>
    @if (Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif
    <form class="new-added-form require-validation" role="form" action="{{ route('stripe.post') }}" method="post"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="queryParams" placeholder="" value="{{ $queryParams }}" required>
        <input type="hidden" name="url" placeholder="" value="{{ $current }}" required>

        <div class="inputBox">
            <span>card number</span>
            <input type="text" maxlength="20" class="card-number-input card-number" required>
        </div>
        <div class="inputBox">
            <span>card holder</span>
            <input type="text" class="card-holder-input" required>
        </div>
        <div class="flexbox">
            <div class="inputBox">
                <span>expir mm</span>
                <select name="" id="" class="month-input card-expiry-month" required>
                    <option value="month" selected disabled>month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="inputBox">
                <span>expir yy</span>
                <select name="" id="" class="year-input card-expiry-year" required>
                    <option value="year" selected disabled>year</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    <option value="32">32</option>
                    <option value="33">33</option>
                    <option value="34">34</option>
                    <option value="35">35</option>
                    <option value="36">36</option>
                    <option value="37">37</option>
                    <option value="38">38</option>
                    <option value="39">39</option>
                    <option value="40">40</option>
                </select>
            </div>
            <div class="inputBox">
                <span>cvv</span>
                <input type="text" maxlength="4" class="cvv-input card-cvc" required>
            </div>
        </div>
        <input type="submit" value="submit {{ decrypt($amount) }}$" class="submit-btn">
    </form>
@endsection
@section('script')
    <script src="{{ asset('static/js/stripe/input.js') }}"></script>
    <script src="{{ asset('static/js/stripe/stripe.main.js') }}"></script>
    <script src="{{ asset('static/js/stripe/stripe.js') }}"></script>
    <script>
        document.querySelector('.card-number-input').oninput = () => {
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }

        document.querySelector('.card-holder-input').oninput = () => {
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () => {
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
        }

        document.querySelector('.year-input').oninput = () => {
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () => {
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () => {
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }
    </script>
@endsection
