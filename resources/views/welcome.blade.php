@extends('layouts.app')

@section('title', ' | Welcome')

@section('content')

  <section id="hero">
    <div class="container">
      <h1>Welcome to My Landing Page</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit magna sed purus consequat.</p>
      <a href="#contact" class="btn">Get Started</a>
    </div>
  </section>

  <section id="about">
    <div class="container">
      <h2>About</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit magna sed purus consequat.</p>
    </div>
  </section>

  <section id="services">
    <div class="container">
      <h2>Services</h2>
      <ul>
        <li>Service 1</li>
        <li>Service 2</li>
        <li>Service 3</li>
      </ul>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <h2>Contact</h2>
      <form>
        <input type="text" placeholder="Name">
        <input type="email" placeholder="Email">
        <textarea placeholder="Message"></textarea>
        <button type="submit">Send</button>
      </form>
    </div>
  </section>




@endsection