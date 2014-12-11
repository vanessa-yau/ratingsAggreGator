<?php
class Conversation extends extends Pichkrement\Messenger\Models\Conversation implements UserInterface, RemindableInterface {

    protected $table = 'conversations';

    public static $rules = [
        'name' => 'required|min:4',
    ];

    protected $fillable = ['name'];

    public function messages(){
        return $this->hasMany('\Pichkrement\Messenger\Models\Message');     
    }

    public function users(){
        return $this->belongsToMany('\Pichkrement\Messenger\Models\User');
    }
    
    public function foo(){
        return $this->messages()->orderBy('created_at', 'DESC')->first();
    }
}