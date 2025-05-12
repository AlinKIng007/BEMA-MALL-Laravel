@extends('layouts.auth')

@section('content')
<div class="container">
    <header>
        <h1 class="text-center mb-4">Signup Form</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0" style="color: red; font-size: 14px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </header>

    <div class="progress-bar mb-4">
        <div class="step">
            <p>Name</p>
            <div class="bullet">
                <span>1</span>
                <i class="check fas fa-check"></i>
            </div>
        </div>
        <div class="step">
            <p>Contact</p>
            <div class="bullet">
                <span>2</span>
                <i class="check fas fa-check"></i>
            </div>
        </div>
        <div class="step">
            <p>Address</p>
            <div class="bullet">
                <span>3</span>
                <i class="check fas fa-check"></i>
            </div>
        </div>
        <div class="step">
            <p>Submit</p>
            <div class="bullet">
                <span>4</span>
                <i class="check fas fa-check"></i>
            </div>
        </div>
    </div>

    <div class="form-outer">
    <form id="signupForm" method="POST" action="{{ route('signup') }}">
        @csrf

        <div class="page slide-page">
            <div class="title">Basic Info:</div>
            <div class="field">
                <div class="label">First Name</div>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div class="field">
                <div class="label">Last Name</div>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
            </div>
            <div class="field">
                <button type="button" class="firstNext next">Next</button>
            </div>
        </div>

        <div class="page">
            <div class="title">Contact Info:</div>
            <div class="field">
                <div class="label">Email Address</div>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <div class="label">Phone Number</div>
                <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required>
            </div>
            <div class="field btns">
                <button type="button" class="prev-1 prev">Previous</button>
                <button type="button" class="next-1 next">Next</button>
            </div>
        </div>

        <div class="page">
            <div class="title">Address Information</div>
            <div class="field">
                <div class="label">City</div>
                <input type="text" name="city" value="{{ old('city') }}" required>
            </div>
            <div class="field">
                <div class="label">Country</div>
                <select name="country_id" required>
                    <option value="">Select a country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <div class="label">Address</div>
                <input type="text" name="address" value="{{ old('address') }}" required>
            </div>
            <div class="field">
                <div class="label">ZIP Code</div>
                <input type="text" name="zip_code" value="{{ old('zip_code') }}" required>
            </div>
            <div class="field btns">
                <button type="button" class="prev-2 prev">Previous</button>
                <button type="button" class="next-2 next">Next</button>
            </div>
        </div>

        <div class="page">
            <div class="title">Login Details:</div>
            <div class="field">
                <div class="label">Username</div>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
            <div class="field">
                <div class="label">Password</div>
                <input type="password" name="hash" required>
            </div>
            <div class="field btns">
                <button type="button" class="prev-3 prev">Previous</button>
                <button type="submit" class="submit">Submit</button>
            </div>
        </div>
    </form>
</div>


    <div class="signup-link text-center mt-3">
        Already a Member? <a href="{{ route('login') }}" class="text-orange-600 font-bold">Login now</a>
    </div>
</div>

@push('styles')
<style>
    .container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .step {
        text-align: center;
        position: relative;
        width: 25%;
    }

    .step p {
        font-weight: 500;
        letter-spacing: 0.3px;
        margin-bottom: 8px;
    }

    .bullet {
        height: 25px;
        width: 25px;
        border: 2px solid #000;
        display: inline-block;
        border-radius: 50%;
        position: relative;
        transition: 0.2s;
        font-weight: 600;
        font-size: 17px;
        line-height: 25px;
    }

    .bullet.active {
        border-color: #ff6b00;
        background: #ff6b00;
    }

    .bullet span {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .bullet.active span {
        display: none;
    }

    .check {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        display: none;
        color: white;
        font-size: 14px;
    }

    .bullet.active .check {
        display: block;
    }

    .bullet:before,
    .bullet:after {
        position: absolute;
        content: '';
        bottom: 11px;
        right: -51px;
        height: 3px;
        width: 44px;
        background: #262626;
    }

    .step:last-child .bullet:before,
    .step:last-child .bullet:after {
        display: none;
    }

    .bullet.active:after {
        background: #ff6b00;
        transform: scaleX(0);
        transform-origin: left;
        animation: animate 0.3s linear forwards;
    }

    @keyframes animate {
        100% {
            transform: scaleX(1);
        }
    }

    .form-outer {
        width: 100%;
        overflow: hidden;
    }

    .form-outer form {
        display: flex;
        width: 400%;
    }

    .page {
        width: 25%;
        transition: margin-left 0.3s ease-in-out;
    }

    .title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 25px;
        letter-spacing: -0.3px;
    }

    .field {
        margin-bottom: 1.5rem;
    }

    .field .label {
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .field input,
    .field select {
        width: 96%;
        padding: 0.75rem;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .field input:focus,
    .field select:focus {
        border-color: #ff6b00;
        outline: none;
    }

    .field button {
        width: 100%;
        padding: 0.75rem;
        border: none;
        border-radius: 6px;
        background: #ff6b00;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        letter-spacing: 0.3px;
    }

    .field button:hover {
        background: #ff8533;
    }

    .btns {
        display: flex;
        gap: 1rem;
    }

    .btns button {
        flex: 1;
    }

    .prev {
        background: #666 !important;
    }

    .prev:hover {
        background: #777 !important;
    }

    .error-field {
        border-color: #ff0000 !important;
    }

    header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slidePage = document.querySelector("#signupForm .slide-page");
    const nextBtnFirst = document.querySelector("#signupForm .firstNext");
    const prevBtnSec = document.querySelector("#signupForm .prev-1");
    const nextBtnSec = document.querySelector("#signupForm .next-1");
    const prevBtnThird = document.querySelector("#signupForm .prev-2");
    const nextBtnThird = document.querySelector("#signupForm .next-2");
    const prevBtnFourth = document.querySelector("#signupForm .prev-3");
    const progressText = document.querySelectorAll(".progress-bar .step p");
    const bullet = document.querySelectorAll(".progress-bar .step .bullet");
    let current = 1;

    function validateCurrentPage(step) {
        const form = document.getElementById('signupForm');
        const pages = form.querySelectorAll('.page');
        const currentPage = pages[step - 1];
        const inputs = currentPage.querySelectorAll('input, select');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                isValid = false;
                input.classList.add('error-field');
            } else {
                input.classList.remove('error-field');
            }
        });

        return isValid;
    }

    function updateProgress(currentStep, action) {
        if (action === 'next') {
            bullet[currentStep - 1].classList.add("active");
            progressText[currentStep - 1].classList.add("active");
        } else if (action === 'prev') {
            bullet[currentStep - 2].classList.remove("active");
            progressText[currentStep - 2].classList.remove("active");
        }
    }

    nextBtnFirst.addEventListener("click", function(e) {
        e.preventDefault();
        if (validateCurrentPage(current)) {
            slidePage.style.marginLeft = "-25%";
            updateProgress(current, 'next');
            current += 1;
        }
    });

    nextBtnSec.addEventListener("click", function(e) {
        e.preventDefault();
        if (validateCurrentPage(current)) {
            slidePage.style.marginLeft = "-50%";
            updateProgress(current, 'next');
            current += 1;
        }
    });

    nextBtnThird.addEventListener("click", function(e) {
        e.preventDefault();
        if (validateCurrentPage(current)) {
            slidePage.style.marginLeft = "-75%";
            updateProgress(current, 'next');
            current += 1;
        }
    });

    prevBtnSec.addEventListener("click", function(e) {
        e.preventDefault();
        slidePage.style.marginLeft = "0%";
        updateProgress(current, 'prev');
        current -= 1;
    });

    prevBtnThird.addEventListener("click", function(e) {
        e.preventDefault();
        slidePage.style.marginLeft = "-25%";
        updateProgress(current, 'prev');
        current -= 1;
    });

    prevBtnFourth.addEventListener("click", function(e) {
        e.preventDefault();
        slidePage.style.marginLeft = "-50%";
        updateProgress(current, 'prev');
        current -= 1;
    });
});
</script>
@endpush
@endsection
