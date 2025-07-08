@extends('layouts.app')
@section('content')
<div class="container">
    <div class="left-column">
        <h1>Elevate Your Search Rankings</h1>
        <p class="subtitle">Instantly check your keyword position on Google.</p>

        <form class="rank-checker-form">
            <div class="inputs-wrapper">
                <div class="form-group">
                    <label for="domain">DOMAIN</label>
                    <input type="text" id="domain" value="example.com" />
                </div>
                <div class="form-group">
                    <label for="keyword">KEYWORD</label>
                    <input type="text" id="keyword" value="prompt" />
                </div>
            </div>
            <button type="submit" class="check-button">Check position</button>
        </form>
    </div>

    <div class="right-column">
        <div class="result-box">
            <span class="rank">12 <sup>th</sup></span>
            <p class="on-google">on Google</p>
        </div>
        <div class="timeline-line"></div>
    </div>
</div>
@endsection
