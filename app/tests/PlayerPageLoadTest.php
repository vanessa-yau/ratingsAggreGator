<?php 

class PlayerPageLoadTest extends TestCase {

    public function testSomethingIsTrue()
    {
 

        $player = Player::first();
        
        $this->action('GET',
            'PlayerController@show',
            [
                'player' => $player->id
            ]
        );

        $this->assertTrue($player != null);
    }

}