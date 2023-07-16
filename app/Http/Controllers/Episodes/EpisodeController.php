<?php

namespace App\Http\Controllers\Episodes;

use App\DataTables\EpisodesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Episode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EpisodeController extends Controller
{
    public function index(EpisodesDataTable $dataTable)
    {
        return $dataTable->render('episodes.index');
    }

    public function syncEpisodes()
    {
        do {
            if (isset($responseObject->info->next)) {
                $response = Http::get($responseObject->info->next);
            } else {
                $response = Http::get(env('API_URL') . '/episode');
            }
            $responseObject = json_decode($response->body());

            foreach ($responseObject->results as $result) {
                /**
                 * @var $episode Episode
                 */
                $episode = Episode::firstOrNew(['id_episode' => $result->id], [
                        'name' => $result->name,
                        'air_date' => $result->air_date,
                        'episode' => $result->episode
                ]);

                if ($episode->isValid()) {

                    if ($episode->isDirty()) {
                        $episode->save();
                    }

                    foreach ($result->characters as $characterUrl) {
                        $characterResponse = Http::get($characterUrl);
                        $characterResponseResult = json_decode($characterResponse);

                        /**
                         * @var $character Character
                         */
                        $character = Character::firstOrNew(['id_character' => $characterResponseResult->id], [
                            'name' => $characterResponseResult->name,
                            'status' => $characterResponseResult->status,
                            'species' => $characterResponseResult->species,
                            'type' => $characterResponseResult->type,
                            'gender' => $characterResponseResult->gender
                        ]);

                        if ($character->isValid() && $character->isDirty()) {
                            $character->save();
                        }
                        $episode->characters()->attach($character->getKey());
                    }
                } else {
                    foreach ($episode->getValidationErrorMessages() as $validationErrorMessage) {
                        Log::error($validationErrorMessage);
                    }
                }

            }

        } while ($responseObject->info->next);

        return redirect()->to(route('indexEpisodes'));
    }

    public function getCharacters()
    {
        $episodeId = request()->get('id');

        /**
         * @var $episode Episode
         */
        $episode = Episode::findOrFail($episodeId);


        return JsonResponse::fromJsonString(json_encode($episode->characters), 200);
    }
}
