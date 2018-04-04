@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Tickets Purchased</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('layouts.success') 

                    <!-- begin ticket listing -->

                    @foreach($tickets as $ticket)

                      <div class="row mb-2">
                        <div class="col-md-12">
                          <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                              <h4 class="mb-0">
                                <a class="text-dark" href="#">{{ $ticket->movie_title }}</a>
                              </h4>
                              <div class="mb-1 text-muted">10 days left</div>

                              <?php

                                 $goal = $ticket->movie_goal;
                                 $raised = $ticket->movie_money_raised;

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
                                <div class="progress-bar <?=$barcolor?>" role="progressbar" style="width:<?=$display?>"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=$display?></div>
                              </div>
                               <div style=" color: green;"><b>Goal: ${{ number_format($ticket->movie_goal, 0) }}</b></div>
                              <div style="color: <?=$textcolor?> ">Raised: ${{ number_format($ticket->movie_money_raised, 0) }}</div>

                              <hr>

                              @if($ticket->backing_id == 1)
                                <p class="card-text mb-auto"><b>My Details: </b> You purchased a ticket for ${{ $ticket->purchased_amount }}</p>
                              @else
                                <p class="card-text mb-auto"><b>My Details: </b> You donated ${{ $ticket->donated_amount }} to this project!</p>
                              @endif

                            </div>
                            <img class="card-img-right flex-auto d-none d-md-block" style="width:25%; height: 25%;" src="{{ asset('img/posters/' . $ticket->movie_poster) }}" alt="{{ $ticket->movie_title }}">
                          </div>
                        </div>
                        </div>

                    @endforeach 
          

                    <!-- end ticket listing -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
