@extends('layouts.app')

<style>
      #donationGroup:checked ~ .conditional{
        list-style: none;
        clip: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        position: static;
        width: auto;
      }

      #donationGroup:not(:checked) ~ .conditional{
        list-style: none;
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
      }

</style>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Support this Movie Project <small>&laquo; <a href="/movies">back to movies</a></small></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                         

                      <div class="row mb-2">
                        <div class="col-md-12">
                          <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                              <h4 class="mb-0">
                                <a class="text-dark" href="#">{{ $movie->movie_title }}</a>
                              </h4>
                              <div class="mb-1 text-muted">10 days left</div>
                              <?php

                                 $goal = $movie->movie_goal;
                                 $raised = $movie->movie_money_raised;

                                 $percentage = $raised/$goal;
                                 $display = number_format($percentage * 100, 0) . '%';

                                if($percentage < 1) {
                                  $textcolor = "red";
                                  $barcolor = "bg-danger";
                                } else {
                                  $textcolor = "blue";
                                  $barcolor = "";
                                }

                              ?>     
                              <div class="progress" style="width:80%;">                                          
                                <div class="progress-bar <?=$barcolor?>" role="progressbar" style="width: <?=$display?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=$display?></div>
                              </div>
                              <div style=" color: green;"><b>Goal: ${{ number_format($movie->movie_goal, 0) }}</b></div>
                              <div style="color: <?=$textcolor?> ">Raised: ${{ number_format($movie->movie_money_raised, 0) }}</div>

                              <hr>
                              <p class="card-text mb-auto"><b>Synposis: </b>{{ $movie->movie_description }}</p>

                            </div>
                            <img class="card-img-right flex-auto d-none d-md-block" style="width:50%; height: 50%;" src="{{ asset('img/posters/' . $movie->movie_poster) }}" alt="{{ $movie->movie_title }}">
                          </div>
                        </div>

                    <!-- begin donate section -->

                        <form action="/movies/{{ $movie->id }}/tickets" method="post">                      
                        <fieldset>
                          @csrf
                          <ul style="list-style: none;">    
                              @include('layouts.success')                        
                            <h3>What would you like to do?</h3>
                            <li>
                              <input type="radio" name="backing_id" value="1" id="support" required>
                              <input type="hidden" name="purchased_amount" value="{{ $movie->ticket_price }}">
                              <input type="hidden" name="preference_amount" value="{{ $movie->id }}">
                              <label for="ticket">Purchase Movie Ticket ( ticket price: ${{ $movie->ticket_price }} )</label>
                            </li>
                            <li>
                              <input type="radio" name="backing_id" value="2" id="donationGroup" >
                              <label for="donation">Donate Amount (Donating will automatically purchase 1 movie ticket)</label>
                              <fieldset class="conditional">
                                <ul style="list-style: none;">
                                  <li>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Choose Amount</label>
                                      </div>
                                      <select class="custom-select" id="inputGroupSelect01" name="donated_amount">
                                        <option value="{{ $movie->ticket_price }}" >${{ $movie->ticket_price }}</option>
                                        <option value="10">$10</option>
                                        <option value="20">$20</option>
                                        <option value="30">$30</option>
                                        <option value="40">$40</option>
                                        <option value="50">$50</option>
                                      </select>
                                    </div>
                                  </li>
                                </ul>
                              </fieldset>
                            </li>
                            @include('layouts.errors')
                            <li> <button type="submit" class="btn btn-primary">Submit</button> <a href="/movies"><button type="button" class="btn btn-info">Cancel</button></a></li>
                          </ul>
                        </fieldset>

                      </form>                
                     



                    <!-- end movie listing -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

