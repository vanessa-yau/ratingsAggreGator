<?php 
// laravel testing: http://laravel.com/docs/4.2/testing

// testing all views
class PageLoadTest extends TestCase {

    // test #1 landing pg (P)
    public function testIndex() {
        $this->call('GET','/');

        $this->assertResponseOk();
        // assert the view has some data
        $this->assertViewHas('players');
    }

    public function testRegistration() {
        $this->call('GET','register');
    }

    public function testContactUs() {
        $this->call('GET','/help/contact-us');
    }

    public function testMeetTeam() {
        $this->call('GET','/about/meet-the-team');
    }

    // test #
    // create profile omitting id (F)
    public function testPlayerProfileWithoutID() {
        $this->action('GET', 'PlayerController@show');
    }

    // test # player-profile with skills (P)
    public function testPlayerProfileLoadSkills() {
        $players = Player::where('id', '<', '150')->get();
        $skills = Skill::all();
        
        foreach( $players as $player ) {
            $this->assertTrue($player != null);
            
            // test player pages load with param: id
            $this->action('GET',
                'PlayerController@show',
                [
                    'player' => $player->id,
                    'skills' => $skills
                ]
            );
            $this->assertResponseOk();
        }
    }

    // test # empty input search
    public function testSearchWithoutParams() {
        $this->action('GET', 'PlayerController@search', ['searchQuery' => null ]);
        $this->assertViewHas('players');
    }

    public function testEmptyStringSearch() {
        $this->action('GET', 'PlayerController@search', ['searchQuery' => '']);
        $this->assertViewHas('players');
    }

    public function testUnicodeSearch() {
        $this->action('GET', 'PlayerController@search', ['searchQuery' => '*(*$£(*%(!)%!%s' ]);
        // expect fail
        $this->assertViewHas('players');
    }

    public function testCorrectPlayerAverage(){
        $this->seed();
        $crawler = $this->client->request('GET', '/players/1');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(5, $crawler->filter('h3:contains("2/5")'));
    }

    public function testUserEditingDetails() {
        $this->be(User::first());
        // fill in when user settings on github
    }

    // expect redirect error
    public function testIncorrectLogin() {
        // $this->action('POST', 'UserController@login', ['username' => 'scrubwatch', 'password' => 'pass']);
        // $this->assertResponseOk();
        $this->action('POST', 'UserController@login', ['username' => '', 'password' => 'pass']);
    }

    // expect redirect error
    public function testCorrectLogin() {
        $this->action('POST', 'UserController@login', ['username' => 'scrubwatch', 'password' => 'pass1']);
    }
}