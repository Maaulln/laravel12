{{--
    About / Portfolio Page
    Refactored to use layout, components, and partials
--}}
@extends('layouts.portfolio')

@section('title', 'Maulana Chandra Irawan – Portfolio')
@section('brand', 'MAULANA.EXE v1.0')
@section('xp', '2450 / 3000')
@section('level', '03')

@section('content')
    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="avatar-frame">
            <div class="avatar-placeholder">MCI</div>
        </div>
        <div class="hero-text">
            <div class="hero-name">MAULANA<br>CHANDRA<br>IRAWAN<span class="typing-cursor"></span></div>
            <div class="hero-title">🤖 AI / ML ENGINEER</div>
            <div class="hero-location">Malang, East Java, Indonesia</div>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <div class="menu-nav">
        <button class="menu-btn active">📜 PROFILE</button>
        <button class="menu-btn">⚔️ SKILLS</button>
        <button class="menu-btn">🏆 QUESTS</button>
        <button class="menu-btn">📚 TRAINING</button>
        <button class="menu-btn">📡 CONTACT</button>
    </div>

    {{-- Content Panels --}}
    @include('about.partials.panel-about')
    @include('about.partials.panel-skills')
    @include('about.partials.panel-experience')
    @include('about.partials.panel-education')
    @include('about.partials.panel-contact')
@endsection
