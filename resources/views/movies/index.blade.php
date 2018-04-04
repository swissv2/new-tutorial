@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Movies</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- begin movie listing -->

                        <main role="main">

                          <div class="album py-5 bg-light">
                            <div class="container">

                              <div class="row">
                                <!-- begin movie posters -->
                                @foreach($movies as $movie)
                                <div class="col-md-4">
                                  <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="{{ asset('img/posters/' . $movie->movie_poster) }}" alt="{{ $movie->movie_title }}">
                                    <div class="card-body">
                                      <p class="card-text"><?php 

                                           if(strlen('' .  $movie->movie_title .'') > 20) 
                                           {
                                                echo "<b>" . substr(" " .$movie->movie_title. "   ", 0, 20) . "...</b>"; 
                                           } else {
                                                echo "<b>" . $movie->movie_title . "</b>";
                                           }

                                            ?>
                                          <br />
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
                                           <div class="progress">                                          
                                              <div class="progress-bar <?=$barcolor?>" role="progressbar" style="width: <?=$display?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=$display?></div>
                                           </div>
                                        <small>
                                        <div style=" color: green;"><b>Goal: ${{ number_format($movie->movie_goal, 0) }}</b></div>
                                        <div style="color: <?=$textcolor?> ">Raised: ${{ number_format($movie->movie_money_raised, 0) }}</div>
                                        </small>
                                      </p>
                                      @auth                                       
                                      <div class="d-flex justify-content-between align-items-center">                                        
                                        <div class="btn-group" style="align-content: center;" align="center">                                    
                                            <a href="/movies/{{$movie->id}}"><button type="button" class="btn btn-sm btn-outline-secondary">Back this movie project</button></a>             
                                        </div>                                        
                                      </div>
                                      @endauth  
                                    </div>
                                  </div>
                                </div>                  
                                @endforeach
                                <!-- end movie posters -->
                              </div>
                            </div>
                          </div>

                        </main>

                    <!-- end movie listing -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
