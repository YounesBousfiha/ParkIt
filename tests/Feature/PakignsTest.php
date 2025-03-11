<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PakignsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function login()
    {
        $creds = [
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ];

        $resLogin = $this->postJson('api/login', $creds);

        $token = $resLogin['token'];

        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }

    public function test_create_parking() {

        $data = [
            'name' => 'Eljadida Parking',
            'location' => 'ElJadida',
            'total_places' => 25
        ];

        $headers = $this->login();

        $response = $this->withHeaders($headers)->postJson('api/parkings', $data);

        $response->assertStatus(201)
            ->assertJson([
                'park' => true
            ]);
    }

    public function test_display_all_parkings() {

        $headers = $this->login();

        $response = $this->withHeaders($headers)->getJson('api/parkings');

        $response->assertStatus(200)->assertJsonFragment([
            'name' => 'Eljadida Parking'
        ]);
    }

    public function test_display_one_parking() {

        $headers = $this->login();

        $allparksRes = $this->withHeaders($headers)->getJson('api/parkings');

        $allparks = json_decode($allparksRes->getContent(), true);

        $park_id = $allparks[1]['id'];

        $response = $this->withHeaders($headers)->getJson('api/parkings/' . $park_id);

        $response->assertStatus(200)->assertJson([
            'park' => true
        ]);
    }

    public function test_update_parking() {
        $headers = $this->login();

        $allParksRes = $this->withHeaders($headers)->getJson('api/parkings');

        $allparks = json_decode($allParksRes->content(), true);

        $park_id = $allparks[1]['id'];

        $data = [
            'total_places' => 8
        ];

        $response = $this->withHeaders($headers)->putJson("api/parkings/$park_id", $data);

        $response->assertStatus(200)->assertJson([
            'park' => true
        ]);
    }

    public function test_supprimer_parking_with_reservations() {
        $headers = $this->login();

        $allparksRes = $this->withHeaders($headers)->getJson('api/parkings');

        $allparks = json_decode($allparksRes->getContent(), true);

        $park_id = $allparks[0]['id'];

        $response = $this->withHeaders($headers)->deleteJson("api/parkings/$park_id");

        $response->assertStatus(400)->assertJson([
            'message' => true
        ]);
    }

    public function test_delete_parking_without_reservations() {
        $headers = $this->login();

        $allparksRes = $this->withHeaders($headers)->getJson('api/parkings');

        $allparks = json_decode($allparksRes->getContent(), true);

        $park_id = $allparks[3]['id'];

        $response = $this->withHeaders($headers)->deleteJson("api/parkings/$park_id");

        $response->assertStatus(200)->assertJson([
            'message' => true
        ]);
    }

        public function test_parking_search() {

            $headers = $this->login();

            $keyword = "Jadida";

            $response = $this->withHeaders($headers)->getJson("api/parkings/avalability?zone=$keyword");

            $response->assertStatus(200)
                ->assertJson([
                    'parkings' => []
                ]);


        }

    public function test_parking_statistiques () {

        $headers = $this->login();

        $response = $this->withHeaders($headers)->getJson('api/parkings/stats');

        $response->assertStatus(200)
            ->assertJson([
                'total_places' => true
            ]);

    }
}
