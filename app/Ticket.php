<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
     /**
        * Use this code to connet to the table associated with the model.
        */
        protected $table = 'tickets';

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = [        	
        	'movie_id',        
        	'user_id',
            'backing_id',   
            'donated',
            'donated_amount',
            'purchased',
            'purchased_amount',
            
        ];

         /**
        * The attributes that should be hidden for arrays.
        *
        * @var array
        */
        protected $hidden = [
            'user_id'
        ];

        public function user()
        {
            return $this->belongsTo('App\User');
        }

        public function movie()
        {
            return $this->belongsTo('App\Movie');
        }


        public function addTicket($backing_id, $donated_amount, $purchased_amount)
        {

        	//dd(request()->all());  

            //session()->flash('message', 'MovieID: ' . $this->id . '');
        	
            /* 
            
            if($backing_id == 1) {
                $donated = 0;
                $purchased = 1;
            } else {
                $donated = 1;
                $purchased = 0;
            }

            $ticket = new Ticket;
            $ticket->movie_id = $this->id;
            $ticket->user_id = auth()->user()->id;
            $ticket->backing_id = $backing_id;
            $ticket->donated = $donated;
            $ticket->donated_amount = $donated_amount;
            $ticket->purchased = $purchased;
            $ticket->purchased_amount = $purchased_amount;
            $ticket->save();
            
            if($request->backing_id == 1) {
               session()->flash('message', 'Succesfully purchased ticket!');
            } else {
               session()->flash('message', 'Succesfully donated!');
            }
            */
            
        }



}
