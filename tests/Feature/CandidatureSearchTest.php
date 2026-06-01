<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Candidature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidatureSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_search_candidatures_by_entreprise(): void
    {
        $user = User::factory()->create();

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'en_cours',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Apple',
            'poste' => 'Frontend Developer',
            'statut' => 'envoyée',
            'priorite' => 'moyenne',
            'date_candidature' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('candidatures.index', ['search' => 'Google']));

        $response->assertStatus(200);
        $response->assertSee('Google');
        $response->assertDontSee('Apple');
    }

    public function test_user_can_search_candidatures_by_poste(): void
    {
        $user = User::factory()->create();

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Backend Engineer',
            'statut' => 'en_cours',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Apple',
            'poste' => 'Designer',
            'statut' => 'envoyée',
            'priorite' => 'moyenne',
            'date_candidature' => now()->toDateString(),
        ]);

        $response = $this->actingAs($user)->get(route('candidatures.index', ['search' => 'Backend']));

        $response->assertStatus(200);
        $response->assertSee('Google');
        $response->assertDontSee('Apple');
    }

    public function test_user_can_filter_by_status_and_priority_with_search(): void
    {
        $user = User::factory()->create();

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Backend Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google Inc',
            'poste' => 'Frontend Developer',
            'statut' => 'refusée',
            'priorite' => 'faible',
            'date_candidature' => now()->toDateString(),
        ]);

        // Search Google, but filter by statut 'entretien'
        $response = $this->actingAs($user)->get(route('candidatures.index', [
            'search' => 'Google',
            'statut' => 'entretien',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Backend Engineer');
        $response->assertDontSee('Frontend Developer');
    }
}
