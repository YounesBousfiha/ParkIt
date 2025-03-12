<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function login_admin() {
        $data = [
            'email' => 'admin@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/login', $data);

        $token = $response['token'];

        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }
    private function login_user() {
        $data = [
            'email' => 'user@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('api/login', $data);

        $token = $response['token'];

        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }

    public function test_make_reservation() {
        $headers = $this->login_user();

        $data = [
            'start_date' => '2025-03-11 23:49',
            'end_date' => '2025-03-11 23:51',
            'parking_id' => 6
        ];

        $response = $this->withHeaders($headers)->postJson('api/reservations', $data);

        $response->assertStatus(201)
            ->assertJson([
                'reservation' => true
            ]);
    }

    public function test_update_reservation() {
        $header = $this->login_user();

        $data = [
            'start_date' => '2025-03-12 23:49',
            'end_date' => '2025-03-12 23:50',
            'parking_id' => 2
        ];

        $dataUpdated = [
            'start_date' => '2025-03-13 23:49',
            'end_date' => '2025-03-13 23:50',
        ];

        $insertionRes = $this->withHeaders($header)->postJson('api/reservations', $data);

        $response = $this->withHeaders($header)->putJson("api/reservations/{$insertionRes->json('reservation.id')}", $dataUpdated);

        $response->assertStatus(200)
            ->assertJson([
                'reservation' => true
            ]);
    }

    public function test_get_all_reservation() {
        $headers = $this->login_admin();

        $response = $this->withHeaders($headers)->getJson('api/reservations');

        $response->assertStatus(200)
            ->assertJson([
                'reservations' => true
            ]);
    }

   public function test_get_user_reservations() {
        $headers = $this->login_user();

        $response = $this->withHeaders($headers)->getJson('api/myreservations');

        $response->assertStatus(200)
            ->assertJson([
                'MyReservation' => true
            ]);
    }

    public function test_delete_reservation_notowned() {
        $headers = $this->login_user();

        $response = $this->withHeaders($headers)->delete('api/reservations/26');

        $response->assertStatus(401)
            ->assertJson([
                'message' => true
            ]);
    }

    public function test_delete_reservation() {
        $headers = $this->login_user();

        $response = $this->withHeaders($headers)->deleteJson('api/reservations/30');

        $response->assertStatus(200)
            ->assertJson([
                'message' => true
            ]);
    }

    public function test_get_one_reservation() {
        $headers = $this->login_admin();

        $reservationsRes = $this->withHeaders($headers)->getJson('api/reservations');
        $reservations = json_decode($reservationsRes->getContent(), true);

        $id = $reservations['reservations'][0]['id'];

        $response = $this->withHeaders($headers)->getJson("api/reservations/$id");

        $response->assertStatus(200)
            ->assertJson([
                'reservation' => true
            ]);
    }
}
