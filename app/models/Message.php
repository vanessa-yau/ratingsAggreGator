<?php
class Message extends extends Pichkrement\Messenger\Models\Message implements UserInterface, RemindableInterface {

    protected $table = 'messages';

    protected $fillable = [
    'user_id', 
    'content',
    'conversation_id'
    ];

    public function conversation(){
       return $this->belongsTo('\Pichkrement\Messenger\Models\Conversation');      
    }

    public function user(){
       return $this->belongsTo('\Pichkrement\Messenger\Models\User');
    }
}