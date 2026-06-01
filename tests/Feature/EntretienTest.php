<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Candidature;
use App\Models\Entretien;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EntretienTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_their_own_interview(): void
    {
        $user = User::factory()->create();
        $candidature = Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        $entretien = Entretien::create([
            'candidature_id' => $candidature->id,
            'type' => 'téléphonique',
            'date_heure' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'statut' => 'En attente',
            'resultat' => 'en_attente',
            'notes_preparation' => 'Initial prep',
        ]);

        $response = $this->actingAs($user)->put(
            route('candidatures.entretiens.update', [$candidature, $entretien]),
            [
                'type' => 'visio',
                'date_heure' => now()->addDays(3)->format('Y-m-d H:i:s'),
                'statut' => 'accepté',
                'resultat' => 'positif',
                'notes_preparation' => 'Updated prep notes',
            ]
        );

        $response->assertRedirect(route('candidatures.show', $candidature));
        $this->assertDatabaseHas('entretiens', [
            'id' => $entretien->id,
            'type' => 'visio',
            'statut' => 'accepté',
            'resultat' => 'positif',
            'notes_preparation' => 'Updated prep notes',
        ]);
    }

    public function test_user_cannot_update_another_users_interview(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $candidature = Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        $entretien = Entretien::create([
            'candidature_id' => $candidature->id,
            'type' => 'téléphonique',
            'date_heure' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'statut' => 'En attente',
            'resultat' => 'en_attente',
        ]);

        $response = $this->actingAs($otherUser)->put(
            route('candidatures.entretiens.update', [$candidature, $entretien]),
            [
                'type' => 'visio',
                'date_heure' => now()->addDays(3)->format('Y-m-d H:i:s'),
                'statut' => 'accepté',
                'resultat' => 'positif',
            ]
        );

        $response->assertStatus(403);
    }

    public function test_user_can_delete_their_own_interview(): void
    {
        $user = User::factory()->create();
        $candidature = Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        $entretien = Entretien::create([
            'candidature_id' => $candidature->id,
            'type' => 'téléphonique',
            'date_heure' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'statut' => 'En attente',
            'resultat' => 'en_attente',
        ]);

        $response = $this->actingAs($user)->delete(
            route('candidatures.entretiens.destroy', [$candidature, $entretien])
        );

        $response->assertRedirect(route('candidatures.show', $candidature));
        $this->assertDatabaseMissing('entretiens', ['id' => $entretien->id]);
    }

    public function test_user_cannot_delete_another_users_interview(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $candidature = Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        $entretien = Entretien::create([
            'candidature_id' => $candidature->id,
            'type' => 'téléphonique',
            'date_heure' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'statut' => 'En attente',
            'resultat' => 'en_attente',
        ]);

        $response = $this->actingAs($otherUser)->delete(
            route('candidatures.entretiens.destroy', [$candidature, $entretien])
        );

        $response->assertStatus(403);
        $this->assertDatabaseHas('entretiens', ['id' => $entretien->id]);
    }

    public function test_validation_errors_when_updating_interview(): void
    {
        $user = User::factory()->create();
        $candidature = Candidature::create([
            'user_id' => $user->id,
            'entreprise' => 'Google',
            'poste' => 'Software Engineer',
            'statut' => 'entretien',
            'priorite' => 'haute',
            'date_candidature' => now()->toDateString(),
        ]);

        $entretien = Entretien::create([
            'candidature_id' => $candidature->id,
            'type' => 'téléphonique',
            'date_heure' => now()->addDays(2)->format('Y-m-d H:i:s'),
            'statut' => 'En attente',
            'resultat' => 'en_attente',
        ]);

        $response = $this->actingAs($user)->put(
            route('candidatures.entretiens.update', [$candidature, $entretien]),
            [
                'type' => 'invalid-type',
                'date_heure' => 'not-a-date',
                'statut' => 'invalid-status',
                'resultat' => 'invalid-result',
            ]
        );

        $response->assertSessionHasErrors(['type', 'date_heure', 'statut', 'resultat']);
    }
}
