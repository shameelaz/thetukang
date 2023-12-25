
@extends('web::frontend.layouts.base')

@section('content')


<div class="section" id="knowledge">
  <div class="row knowledge-content">
    <div class="col s12">
      <div id="search-wrapper" class="card z-depth-0 search-image center-align p-35">
        <div class="card-content">
          <h5 class="center-align mb-3">How can we help you?</h5>
          <input placeholder="Srart typing your search..." id="first_name" class="search-box validate white search-circle search-shadow">
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card card-hover z-depth-0 card-border-gray">
        <a href="page-knowledge/licensing">
          <div class="card-content center-align">
            <h5><b>Support</b></h5>
            <i class="material-icons md-48 red-text">favorite_border</i>
            <p class="mb-2 black-text">Synonyms for support with free <br> online thesaurus, antonyms.</p>
          </div>
        </a>
      </div>
    </div>
    
    <div class="col s12 m6">
      <div class="card card-hover z-depth-0 card-border-gray">
        <a href="auth/login">
          <div class="card-content center-align">
            <h5><b>Login Laravolt Admin</b></h5>
            <i class="material-icons md-48 blue-text">aspect_ratio</i>
            <p class="mb-2 black-text">Theme <br> overide</p>
          </div>
        </a>
      </div>
    </div>

    <!-- Getting started -->
    <div class="col s12 card-content-link">
      <div class="card z-depth-0 card-border-gray pb-3">
        <div class="card-content">
          <div class="row">
            <div class="col s12">
              <h5><i class="material-icons purple-text vertical-text-bottom"> grade </i> Getting started</h5>
              <br>
            </div>
            <div class="col s12 m6">
              <p class="mb-3"><a href="page-knowledge/licensing">Where is my purchase code?</a></p>
              <p class="mb-3"><a href="page-knowledge/licensing">How Does The Envato Market Affiliate
                  Program
                  Work?</a></p>
              <p><a href="page-knowledge/licensing">Where Is My Purchase Code?</a></p>
            </div>
            <div class="col s12 m6">
              <p class="mb-3"><a href="page-knowledge/licensing">How do i purchase this item?</a></p>
              <p class="mb-3"><a href="page-knowledge/licensing">View and Download invoices</a></p>
              <p><a href="page-knowledge/licensing">How do I change my password?</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Item Support -->
    <div class="col s12 card-content-link">
      <div class="card z-depth-0 card-border-gray pb-3">
        <div class="card-content">
          <div class="row">
            <div class="col s12">
              <h5><i class="material-icons purple-text vertical-text-bottom"> local_offer </i> Item Support</h5>
              <br>
            </div>
            <div class="col s12 m6">
              <p class="mb-3"><a href="page-knowledge/licensing">Theme is missing the style.css stylesheet
                  error </a></p>
              <p class="mb-3"><a href="page-knowledge/licensing">How Does The Envato Market Affiliate
                  Program
                  Work?</a></p>
              <p><a href="page-knowledge/licensing">Rating or review removal policy</a></p>
            </div>
            <div class="col s12 m6">
              <p class="mb-3"><a href="page-knowledge/licensing">An author’s introduction</a></p>
              <p class="mb-3"><a href="page-knowledge/licensing">What is Item Support?</a></p>
              <p><a href="page-knowledge/licensing">I'm trying to find a specific item</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
          
@endsection
