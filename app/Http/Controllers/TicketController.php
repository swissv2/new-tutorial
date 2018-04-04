<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Movie;
use DB;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$tickets = Ticket::all();
        $getUserID = auth()->user()->id;

        $tickets = DB::table('tickets')
            ->join('movies', 'movies.id', '=', 'tickets.movie_id')
            ->where('user_id',  [$getUserID])
            ->get();

        return view('tickets.index', compact('tickets', $tickets));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());  

        $request->validate([
                'backing_id' => 'required',
                'donated_amount' => 'min:1',                
                'purchased_amount' => 'min:1',
        ], [
                'backing_id.required' => 'Choose (Purchase Movie Ticket) or (Donate Amount).'
            ]);

        

        if($request->backing_id == 1) {
            $donated = 0;
            $purchased = 1;
        } else {
            $donated = 1;
            $purchased = 0;
        }
        /**
         * Don't like the method of using hidden values for Movie_ID. Must research
         *
         */

        $ticket = Ticket::create([

            'movie_id' => $request->preference_amount,
            'user_id' => auth()->user()->id,
            'backing_id' => $request->backing_id,
            'donated' => $donated,
            'donated_amount' => $request->donated_amount,
            'purchased' => $purchased,
            'purchased_amount' => $request->purchased_amount,           

        ]);

        $movie = Movie::where('id', $request->preference_amount)->first();       

        if($request->backing_id == 1) {

            //handle the per-ticket purchase

            if($ticket->movie) {
                $ticket->movie->movie_money_raised += $request->purchased_amount;
                if($ticket->movie->movie_money_raised >= $ticket->movie->movie_goal) {
                    $ticket->movie->active = 1;
                }
                $ticket->movie->save();
            }

        } else {

            //handle the per donation
            if($ticket->movie) {
                $ticket->movie->movie_money_raised += $request->donated_amount;
                if($ticket->movie->movie_money_raised >= $ticket->movie->movie_goal) {
                    $ticket->movie->active = 1;
                }
                $ticket->movie->save();
            }
        }

      
        if($request->backing_id == 1) {
            $request->session()->flash('message', 'Successfully purchased movie ticket!');
        } else {
            $request->session()->flash('message', 'Successfully donated $' . $request->donated_amount . ' to the project!');
        }

        return redirect('tickets');    
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
